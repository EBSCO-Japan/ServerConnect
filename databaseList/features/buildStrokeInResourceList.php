<?php
  ini_set("display_errors", 1);
  ini_set("track_errors", 1);
  ini_set("html_errors", 1);
  error_reporting(E_ALL);

  include '_header.php';
  include '_response.php';

  $jsonFile_resource_direct = '../data/eResourceList.json';
  $jsonFile_strokes_direct = '../data/strokeList.json';

  // get resource list
  $getResourceListJsonData = file_get_contents($jsonFile_resource_direct);
  $resourceList = json_decode($getResourceListJsonData, true);

  // Build the array for row and dan
  $ary_kataHira_list = [];
  $ary_kataHira_list["ア"] = "ぁあァアぃいィイぅうゥウぇえェエぉおォオ";
  $ary_kataHira_list["カ"] = "かがカガきぎキギくぐクグけげケゲこごコゴ";
  $ary_kataHira_list["サ"] = "さざサザしじシジすずスズせぜセゼそぞソゾ";
  $ary_kataHira_list["タ"] = "ただタダちぢチヂっつづッツヅてでテデとどトド";
  $ary_kataHira_list["ナ"] = "なナにニぬヌねネのノ";
  $ary_kataHira_list["ハ"] = "はばぱハバパひびぴヒビピふぶぷフブプへべぺヘベペほぼぽホボポ";
  $ary_kataHira_list["マ"] = "まマみミむムめメもモ";
  $ary_kataHira_list["ヤ"] = "ゃやャヤゅゆュユょよョヨ";
  $ary_kataHira_list["ラ"] = "らラりリるルれレろロ";
  $ary_kataHira_list["ワ"] = "ゎわヮワゐヰゑヱをヲんンヴヵヶ";

  // for local
  foreach($resourceList as $key_lang => $resource) {
    $resourceList[$key_lang]['local']['kanaRow'] = '';
    $resourceList[$key_lang]['local']['englishAlphabet'] = '';

    // process Kana
    if(trim($resource['local']['resourceKana']) !== '') {
      $chars = preg_split('/(?<!^)(?!$)/u', $resource['local']['resourceKana']);
      $firstChar = $chars[0];
  
      foreach($ary_kataHira_list as $kataHira_key => $kataHira_row) {
        $pos = strrpos($kataHira_row, $firstChar);
  
        // if found in a row
        if($pos) {
          $resourceList[$key_lang]['local']['kanaRow'] = $kataHira_key;
        }
      }
    }

    // process english alphabet
    if(trim($resource['local']['resourceName']) !== '') {
      $chars = preg_split('/(?<!^)(?!$)/u', $resource['local']['resourceName']);
      $firstChar = $chars[0];

      $alphas = array_merge(range('A', 'Z'), range('a', 'z'));
      
      if(in_array($firstChar, $alphas, TRUE)) {
        $resourceList[$key_lang]['local']['englishAlphabet'] = strtoupper($firstChar);
      }
    }
  }

  // for en
  $alphas = array_merge(range('A', 'Z'), range('a', 'z'));
  foreach($resourceList as $key_lang => $resource) {
    $chars = preg_split('/(?<!^)(?!$)/u', $resource['en']['resourceName']);
    $firstChar = $chars[0];

    if(!in_array($firstChar, $alphas, TRUE)) {
      $firstChar = '';
    }

    $resourceList[$key_lang]['en']['englishAlphabet'] = strtoupper($firstChar);
  }

  // overwrite the data in json file
  if(is_writable($jsonFile_resource_direct)) {
    file_put_contents($jsonFile_resource_direct, json_encode($resourceList, JSON_UNESCAPED_UNICODE));
  } else {
    responseError(1001);
  }

  // sleep 1sec
  sleep(1);

  ////////////////////////////// generate the atoz index ///////////////////////////////////////

  // get resource list
  $getNewResourceListJsonData = file_get_contents($jsonFile_resource_direct);
  $newResourceList = json_decode($getNewResourceListJsonData, true);

  $allKanaRow = 'アカサタナハマヤラワ';
  $allEnglishAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
  $ary_kanaRows = preg_split('/(?<!^)(?!$)/u', $allKanaRow);
  $englishAlphabets = str_split($allEnglishAlphabet);
  $kanaRow_local_map = [];
  $englishAlphabet_en_map = [];
  $englishAlphabet_local_map = [];

  // init map
  foreach($ary_kanaRows as $key => $row) {
    $kanaRow_local_map[$row] = false;
  }

  foreach($englishAlphabets as $key => $row) {
    $englishAlphabet_en_map[$row] = false;
    $englishAlphabet_local_map[$row] = false;
  }


  // match with the local map
  // The current Time is to check the expiry date of eResource
  $currentTime = strtotime(date("Y-m-d"));

  foreach($newResourceList as $key_lang => $row) {
    $isInExpiryDate = true;

    if (!filter_var($row['expiredChecking'], FILTER_VALIDATE_BOOLEAN) && $row['startDate'] !== '' && $row['expireDate'] !== '') {
      $temp_startTime = strtotime($row['startDate']);
      $temp_endTime = strtotime($row['expireDate']);

      if($currentTime > $temp_endTime || $currentTime < $temp_startTime) {
        $isInExpiryDate = false;
      }
    }

    // add the kana and english alphabet
    if($isInExpiryDate) {
      // match with the local map
      if(!empty(trim($row['local']['kanaRow']))) {
        $kanaRow_local_map[$row['local']['kanaRow']] = true;
      }
  
      if(preg_match("/^[a-zA-Z]$/", $row['local']['englishAlphabet'])) {
        $char_uppercase = strtoupper($row['local']['englishAlphabet']);
        $englishAlphabet_local_map[$char_uppercase] = true;
      }

      // match with the en map
      if(preg_match("/^[a-zA-Z]$/", $row['en']['englishAlphabet'])) {
        $char_uppercase = strtoupper($row['en']['englishAlphabet']);
        $englishAlphabet_en_map[$char_uppercase] = true;
      }
    }
  }

  // create the list
  $result = [];
  $result['local']['resourceKana'] = [];
  $result['local']['englishAlphabet'] = [];
  $result['en']['englishAlphabet'] = [];

  foreach($kanaRow_local_map as $key => $row) {
    if($row) {
      array_push($result['local']['resourceKana'], $key);
    }
  }

  foreach($englishAlphabet_local_map as $key => $row) {
    if($row) {
      array_push($result['local']['englishAlphabet'], $key);
    }
  }

  foreach($englishAlphabet_en_map as $key => $row) {
    if($row) {
      array_push($result['en']['englishAlphabet'], $key);
    }
  }

  // write back
  if(is_writable($jsonFile_strokes_direct)) {
    file_put_contents($jsonFile_strokes_direct, json_encode($result, JSON_UNESCAPED_UNICODE));
  } else {
    responseError(1001);
  }
  
  $res = array('status' => 'success', 'type' => 'success');
  echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>

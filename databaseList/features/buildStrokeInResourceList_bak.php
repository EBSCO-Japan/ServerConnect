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

  // for filter the first character
  // $str_hiragana = "ぁあぃいぅうぇえぉおかがきぎくぐけげこごさざしじすずせぜそぞただちぢっつづてでとどなにぬねのはばぱひびぴふぶぷへべぺほぼぽまみむめもゃやゅゆょよらりるれろゎわゐゑをん";
  // $str_katakana = "ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶ";
  $str_katakanaAndHiragana = "ぁあぃいぅうぇえぉおかがきぎくぐけげこごさざしじすずせぜそぞただちぢっつづてでとどなにぬねのはばぱひびぴふぶぷへべぺほぼぽまみむめもゃやゅゆょよらりるれろゎわゐゑをんァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶ";


  $ary_kataHira_list = [];
  array_push($ary_kataHira_list, "ぁあァアぃいィイぅうゥウぇえェエぉおォオ");
  array_push($ary_kataHira_list, "かがカガきぎキギくぐクグけげケゲこごコゴ");
  array_push($ary_kataHira_list, "さざサザしじシジすずスズせぜセゼそぞソゾ");
  array_push($ary_kataHira_list, "ただタダちぢチヂっつづッツヅてでテデとどトド");
  array_push($ary_kataHira_list, "なナにニぬヌねネのノ");
  array_push($ary_kataHira_list, "はばぱハバパひびぴヒビピふぶぷフブプへべぺヘベペほぼぽホボポ");
  array_push($ary_kataHira_list, "まマみミむムめメもモ");
  array_push($ary_kataHira_list, "ゃやャヤゅゆュユょよョヨ");
  array_push($ary_kataHira_list, "らラりリるルれレろロ");
  array_push($ary_kataHira_list, "ゎわヮワゐヰゑヱをヲんンヴヵヶ");

  // for local
  foreach($resourceList as $key_lang => $resource) {
    $resourceKana = $resource['local']['resourceKana'];

    $resultExist = false;
    foreach($ary_kataHira_list as $kataHira_key => $kataHira_row) {
      $pos = strrpos($kataHira_row, $resourceKana);

      // if found in row
      if ($pos) {
        echo $resourceKana."==".$pos.";;;;;";
        $resourceList[$key_lang]['local']['resourceKanaNumber'] = ($kataHira_key * 100) + $pos;
        $resultExist = true;
        break;
      }
    }
  }
  print_r($resourceList);
/*
  // for en
  $alphas = array_merge(range('A', 'Z'), range('a', 'z'));
  foreach($resourceList as $key_lang => $resource) {
    $chars = preg_split('/(?<!^)(?!$)/u', $resource['en']['resourceName']);
    $firstChar = $chars[0];

    if(!in_array($firstChar, $alphas, TRUE)) {
      $firstChar = '';
    }

    $resourceList[$key_lang]['en']['englishAlphabet'] = $firstChar;
    $resourceList[$key_lang]['en']['zhuyin'] = '';
    $resourceList[$key_lang]['en']['strokes'] = '0';
  }

  // write back
  if(is_writable($jsonFile_direct)) {
    file_put_contents($jsonFile_resource_direct, json_encode($resourceList, JSON_UNESCAPED_UNICODE));
  } else {
    responseError(1001);
  }

  // sleep 3sec
  sleep(3);

  ////////////////////////////// generate the alphabet list ///////////////////////////////////////

  // get resource list
  $getNewResourceListJsonData = file_get_contents($jsonFile_resource_direct);
  $newResourceList = json_decode($getNewResourceListJsonData, true);

  $allZhuYin = 'ㄅㄆㄇㄈㄉㄊㄋㄌㄍㄎㄏㄐㄑㄒㄓㄔㄕㄖㄗㄘㄙㄧㄨㄩㄚㄛㄜㄝㄞㄟㄠㄡㄢㄣㄤㄥㄦ';
  $allEnglishAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $zhuYins = preg_split('/(?<!^)(?!$)/u', $allZhuYin);
  $englishAlphabets = str_split($allEnglishAlphabet);
  $zhuyin_map = [];
  $englishAlphabet_en_map = [];
  $englishAlphabet_local_map = [];
  $strokes_map = [];

  // init map
  foreach($zhuYins as $key => $row) {
    $zhuyin_map[$row] = false;
  }

  foreach($englishAlphabets as $key => $row) {
    $englishAlphabet_en_map[$row] = false;
    $englishAlphabet_local_map[$row] = false;
  }

  for($loop = 1; $loop < 50; $loop++) {
    if($loop < 10) {
      $strokes_map['0'.strval($loop)] = false;
    } else {
      $strokes_map[strval($loop)] = false;
    }
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

    // add the stroke, zhuyin in list
    if($isInExpiryDate) {
      // match with the local map
      if(!empty(trim($row['local']['zhuyin']))) {
        $zhuyin_map[$row['local']['zhuyin']] = true;
      }
  
      if(preg_match("/^[a-zA-Z]$/", $row['local']['englishAlphabet'])) {
        $char_uppercase = strtoupper($row['local']['englishAlphabet']);
        $englishAlphabet_local_map[$char_uppercase] = true;
      }
  
      if($row['local']['strokes'] !== '0') {
        $strokes_map[$row['local']['strokes']] = true;
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
  $result['local']['zhuyin'] = [];
  $result['local']['englishAlphabet'] = [];
  $result['local']['strokes'] = [];
  $result['en']['englishAlphabet'] = [];

  foreach($zhuyin_map as $key => $row) {
    if($row) {
      array_push($result['local']['zhuyin'], $key);
    }
  }

  foreach($englishAlphabet_local_map as $key => $row) {
    if($row) {
      array_push($result['local']['englishAlphabet'], $key);
    }
  }

  foreach($strokes_map as $key => $row) {
    if($row) {
      array_push($result['local']['strokes'], $key);
    }
  }

  foreach($englishAlphabet_en_map as $key => $row) {
    if($row) {
      array_push($result['en']['englishAlphabet'], $key);
    }
  }
  
  // write back
  if(is_writable($jsonFile_direct)) {
    file_put_contents($jsonFile_strokes_direct, json_encode($result, JSON_UNESCAPED_UNICODE));
  } else {
    responseError(1001);
  }
  
  $res = array('status' => 'success', 'type' => 'success');
  echo json_encode($res, JSON_UNESCAPED_UNICODE);
*/
?>

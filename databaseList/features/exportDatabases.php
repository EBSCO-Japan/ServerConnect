<?php
  include '_header.php';
  include 'verifyToken.php';
  include '_response.php';

  $jsonFile_direct = '../data/eResourceList.json';
  $settingFile_direct = '../data/settings.json';
  $fileDir = '../csvFiles/exportResources.txt';

  // get resource list
  $getResourceListJsonData = file_get_contents($jsonFile_direct);
  $resourceList = json_decode($getResourceListJsonData, true);

  // get setting info and setting the param "exportContentIncludeHtml"
  $getSettingJsonData = file_get_contents($settingFile_direct);
  $settingInfo = json_decode($getSettingJsonData, true);
  $exportContentIncludeHtml = true;
  if(array_key_exists('exportContentIncludeHtml', $settingInfo)) {
    $exportContentIncludeHtml = $settingInfo['exportContentIncludeHtml'];
  }

  $resourceListLength = count($resourceList);

  $tempList = getMataData($resourceList[0]);

  foreach($resourceList as $rkey => $resource) {
    foreach($resource as $key => $value) {
      if(!(strcasecmp('local', $key) == 0) && !(strcasecmp('en', $key) == 0) && !(strcasecmp('tw', $key) == 0)) {
        array_push($tempList[$key], $value);
      } else if((strcasecmp('local', $key) == 0) || (strcasecmp('en', $key) == 0)) {
        foreach($value as $vkey => $vValue) {
          array_push($tempList[$key.'__'.$vkey], $vValue);
        }
      }
    }
  }

  // write the result in the file
  $content = '';
  $metaCounter = 0;
  foreach($tempList as $tkey => $tValue) {
    if($metaCounter == 0) {
      $content = $tkey;
    } else {
      $content = $content."\t".$tkey;
    }
    $metaCounter++;
  }
  $content = $content."\n";

  for ($index = 0; $index < $resourceListLength ; $index++ ) {
    $tempCounter = 0;
    foreach($tempList as $tkey => $tValue) {
      if(!$exportContentIncludeHtml) {
        $tempList[$tkey][$index] = preg_replace('/<[^>]*>/', '', $tempList[$tkey][$index]);
      }
      if($tempCounter == 0) {
        $content = $content."\"".preg_replace("/\r|\n/", "", $tempList[$tkey][$index])."\"";
      } else {
        $content = $content."\t"."\"".preg_replace("/\r|\n/", "", $tempList[$tkey][$index])."\"";
      }
      $tempCounter++;
    }
    $content = $content."\n";
  }
  $content = mb_convert_encoding($content, 'UTF-8', "auto");
  if(is_writable($jsonFile_direct)) {
    file_put_contents($fileDir, $content);
  } else {
    responseError(1001);
  }
  

  // download the file
  if (file_exists($fileDir)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($fileDir).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileDir));
    readfile($fileDir);
    exit;
    echo "<script>window.close();</script>";
  }

  function getMataData($resource) {
    $result = array();
    foreach($resource as $key => $value) {
      if(!(strcasecmp('local', $key) == 0) && !(strcasecmp('en', $key) == 0) && !(strcasecmp('tw', $key) == 0)) {
        $result[$key] = array();
      } else if((strcasecmp('local', $key) == 0) || (strcasecmp('en', $key) == 0)) {
        foreach($value as $vkey => $vValue) {
          $result[$key.'__'.$vkey] = array();
        }
      }
    }

    return $result;
  }
?>

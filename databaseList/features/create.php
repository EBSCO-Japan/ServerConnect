<?php
  ini_set("display_errors", 1);
  ini_set("track_errors", 1);
  ini_set("html_errors", 1);
  error_reporting(E_ALL);

  $jsonFile_direct = '../data/eResourceList.json';

  header("Access-Control-Allow-Origin: *");
  header("Content-Security-Policy: upgrade-insecure-requests");
  header('Content-Type: application/json');

  // for e resource
  // $jsonFile_direct = '../data/eResourceList.json';
  // $getResourceListJsonData = file_get_contents($jsonFile_direct);
  // $resourceList = json_decode($getResourceListJsonData, true);

  // foreach($resourceList['rows'] as $key => $row) {
  //   $id = $resourceList['rows'][$key]['id'];
  //   unset($resourceList['rows'][$key]['id']);
  //   $en = $resourceList['rows'][$key];
  //   $tw = $resourceList['rows'][$key];

  //   $resourceList['rows'][$key] = array();
  //   $resourceList['rows'][$key]['id'] = $id;
  //   $resourceList['rows'][$key]['en'] = $en;
  //   $resourceList['rows'][$key]['tw'] = $tw;
  // }

  // file_put_contents($jsonFile_direct, json_encode($resourceList, JSON_UNESCAPED_UNICODE));
?>

<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Security-Policy: upgrade-insecure-requests");
  header('Content-Type: application/json');

  $getJsonData = file_get_contents('../data/expiryCheckSetting.json');

  echo $getJsonData;
?>

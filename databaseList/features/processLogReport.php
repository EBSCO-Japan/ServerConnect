<?php
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

  header("Access-Control-Allow-Origin: *");
  header("Content-Security-Policy: upgrade-insecure-requests");
  header('Content-Type: application/json');

  $getResourceData = file_get_contents('../data/eResourceList.json');
  $resourceData = json_decode($getResourceData, true);
  
  $getLogJsonData = file_get_contents('../data/logUserCountClick.json');
  $logData = json_decode($getLogJsonData, true);

  $dateRange = json_decode($_GET["searchRange"], true);
  $startTime = new DateTime($dateRange["startDate"]);
  $endTime = new DateTime($dateRange["endDate"]);
  $endTime = date_modify($endTime, '+1 day');

  $generateType = $dateRange["type"];

  // filter the log data
  $clickedData_filtered_by_date = [];
  foreach($logData['log'] as $log) {
    $logDateTime = strtotime($log['clickedDateTime']);
    $processedStartTime = strtotime($startTime->format('Y-m-d'));
    $processedEndTime = strtotime($endTime->format('Y-m-d'));

    if($logDateTime >= $processedStartTime && $logDateTime <= $processedEndTime) {
      array_push($clickedData_filtered_by_date, $log);
    }
  }

  // create map and countable template
  // $resourceIdArray = [];
  $template = [];
  foreach($resourceData['rows'] as $resource) {
    // $resourceIdArray[$resource['id']] = $resource['resourceName'];
    $template[$resource['id']] = array(
      "name" => $resource['resourceName'],
      "clickTimes" => 0,
    );
  }

  if($generateType === 'month') {
    $interval= new DateInterval('P1M');
    $dateFormat = 'Y-m';
  } else if($generateType === 'day') {
    $interval= new DateInterval('P1D');
    $dateFormat = 'Y-m-d';
  }

  // create an array which the key is period of date/month
  $report = array_period($interval, $dateFormat, $startTime, $endTime);
  foreach($report as $rep) {
    $rep = new ArrayObject($template);
  }

  print_r($report);

  // create log counting array
  foreach($clickedData_filtered_by_date as $log) {
    $logDateTime = new DateTime($log['clickedDateTime']);
    $string_time = $logDateTime->format($dateFormat);
    // $ary_tempDate = explode(" ", $log['clickedDateTime']);
    // $date = $ary_tempDate[0];

    if (array_key_exists($log['id'], $report[$string_time])) {
      $report[$string_time][$log['id']]['clickTimes']++;
    } else {
      $report[$string_time][$log['id']]['name'] = $resourceIdArray[$log['id']];
      $report[$string_time][$log['id']]['clickTimes'] = 1;
    }
  }
  echo json_encode($report, JSON_UNESCAPED_UNICODE);

  function array_period($interval, $dateFormat, $startTime, $endTime) {
    $array_result = [];
    $period = new DatePeriod($startTime, $interval, $endTime);

    foreach ($period as $key => $value) {
      $array_result[$value->format($dateFormat)] = [];
    }
    return $array_result;
  }
?>

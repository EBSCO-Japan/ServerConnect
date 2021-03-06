<?php
// ini_set("display_errors", 1);
// ini_set("track_errors", 1);
// ini_set("html_errors", 1);
// error_reporting(E_ALL);

  header("Access-Control-Allow-Headers: *");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Origin: http://gss.ebscohost.com/");
  header("Content-Security-Policy: upgrade-insecure-requests");
  header('Content-Type: application/json;charset=UTF-8');
  date_default_timezone_set('Asia/Taipei');

  $jsonFile_direct = '../data/u5er.json';

  $getUserListJsonData = file_get_contents($jsonFile_direct);
  $userList = json_decode($getUserListJsonData, true);

  $received_user = '';
  if(isset($_POST['user'])) {
    $received_user = json_decode($_POST["user"], true);
  }

  // encrypted the password
  $encryptedPwd = sha1(md5($received_user['account'].$received_user['password']));

  // compare the pwd
  $auth = false;
  foreach($userList as $row) {
    if(strcasecmp($row['account'], $received_user['account']) == 0) {
      if(strcasecmp($row['pwd'], $encryptedPwd) == 0) {
        $auth = true;
      }
    }
  }

  // if pass, generate token and send it back
  if($auth) {
    session_start();

    // h/m/s
    $remainTime = 1 * 60 * 60;
    $expiredTime = date("Y-m-d H:i:s", time() + $remainTime);

    $_SESSION['userAccount'] = $received_user['account'];
    $_SESSION['expiredTime'] = $expiredTime;

    $tokenInfo = [];
    $tokenInfo['user'] = $received_user['account'];
    $tokenInfo['expiredTime'] = $expiredTime;

    $response = array('status' => 'success', 'type' => 'account', 'message' => $tokenInfo);

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
  } else {
    $response = array('status' => 'error', 'type' => 'account');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
  }

  // foreach (getallheaders() as $name => $value) {
  //   echo "$name: $value\n";
  // }

  // session_start();
  // // echo $_SESSION['UserName'];
  // if(isset($_SESSION['userAccount'])) {
  //   echo 'session is exist';
  //   echo $_SESSION['userAccount'];
  // } else {
  //   $_SESSION['UserName'] = 'Jordan';
  //   echo $_SESSION['userAccount'];
  // }
?>

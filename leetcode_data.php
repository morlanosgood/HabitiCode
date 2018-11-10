<?php

$cookieJar = dirname(__FILE__) . '/cookie.txt';

//Make Call to Login to get Cookies (Session ID)
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leetcode.com/accounts/login/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_COOKIEJAR => $cookieJar,
  CURLOPT_HTTPHEADER => array(
    "accept-language: en-US,en;q=0.5",
    "connection: keep-alive",
    "host: leetcode.com",
    "origin: https://leetcode.com",
    "referer: https://leetcode.com/accounts/login/",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0",
    "x-requested-with: XMLHttpRequest"
  ),
));

//Get Submissions
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leetcode.com/api/submissions/?offset=0&limit=20&lastkey=",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOP_COOKIEFILE => $cookieJar,
  CURLOPT_HTTPHEADER => array(
    "Content-type: application/json"
  //   "accept: */*",
  //   "accept-language: en-US,en;q=0.5",
  //   "cache-control: no-cache",
  //   "connection: keep-alive",
    // "cookie: $cookieJar"
  //   "host: leetcode.com",
  //   // "postman-token: 6ef6a0f2-99ac-0fd2-1979-d7c3a74a4ef8",
  //   "referer: https://leetcode.com/submissions/",
  //   "user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0",
  // //  "x-newrelic-id: UAQDVFVRGwEAXVlbBAg=",
  //   "x-requested-with: XMLHttpRequest"
  ),
));
$response = curl_exec($curl);
curl_close($curl);

echo $response

//https://leetcode.com/api/submissions/
// FITBIT CODE FOR REFERENCE
/*
$curl = curl_init();
$curlArray = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_HTTPHEADER => array(
        "Content-type: application/json",
        "Authorization: " . $_GET['token_type']. " " . $_GET['access_token']),
    CURLOPT_URL => "https://api.fitbit.com/1/user/". $_GET['user_id']."/activities/date/".$_GET['date'].".json");

curl_setopt_array($curl, $curlArray);

$resp = curl_exec($curl);

curl_close($curl);
echo $resp;
*/
?>

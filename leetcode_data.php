<?php

$cookieJar = dirname(__FILE__) . '/js/cookie.txt';

//Make Call to Login to get Cookies (Session ID)
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leetcode.com/accounts/login/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_HEADER => true,
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
$result = curl_exec($curl);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);

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
    "Content-type: application/json",
  //   "accept: */*",
  //   "accept-language: en-US,en;q=0.5",
  //   "cache-control: no-cache",
  //   "connection: keep-alive",
    "Cookie: __cfduid=d3c20efb0e9e3c294dd9c292f809ad06e1541623644; csrftoken=pawCO11wpFj0pd8LXKGhUx090aJ1RkmqCukTyNZilRaZjpg0JoC3lrZxaNiipkKg; _ga=GA1.2.1371157599.1541623728; _gid=GA1.2.2105353320.1542313597; _gat=1; messages="e1a52cb0d4d1dd2b9afb2061eb89ab322a3620bb$[[\"__json_message\"\0540\05425\054\"Successfully signed in as morlano.\"]]"; LEETCODE_SESSION=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJfYXV0aF91c2VyX2lkIjoiMTQzODExOCIsIl9hdXRoX3VzZXJfYmFja2VuZCI6ImRqYW5nby5jb250cmliLmF1dGguYmFja2VuZHMuTW9kZWxCYWNrZW5kIiwiX2F1dGhfdXNlcl9oYXNoIjoiZWZjMTE3NDhhNGU2NWM3Y2I2MzBmMGMyYWRlOWY5MTc1ODRiNjgzZCIsImlkIjoxNDM4MTE4LCJlbWFpbCI6Im1vcmxhbm9AcHJpbmNldG9uLmVkdSIsInVzZXJuYW1lIjoibW9ybGFubyIsInVzZXJfc2x1ZyI6Im1vcmxhbm8iLCJhdmF0YXIiOiJodHRwczovL3d3dy5ncmF2YXRhci5jb20vYXZhdGFyLzk4YTYzOGNmYWI4MWZlMzc4NjlmYzZhNjY4ZWRhYmEwLnBuZz9zPTIwMCIsInRpbWVzdGFtcCI6IjIwMTgtMTEtMTUgMjA6Mjg6MzAuNDI4NDE2KzAwOjAwIiwiUkVNT1RFX0FERFIiOiI2Ni4xODAuMTgyLjEwNyIsIklERU5USVRZIjoiZjRiMzQyNDI3ZGM5M2U2ZTVmZDVjMTRlZjFmYjc0ZWMiLCJfc2Vzc2lvbl9leHBpcnkiOjEyMDk2MDB9.ocNXGfFzhom4zWh6muSWYfMorgnXNSSE9jzzuqMCyOY"
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

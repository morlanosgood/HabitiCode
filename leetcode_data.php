<?php

$cookie = tempnam(sys_get_temp_dir(), 'cookie.txt');

//Get Session Info after logged in
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leetcode.com/accounts/login",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_COOKIEJAR => $cookie
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

echo file_get_contents($cookie);
// if ($err) {
//   echo "cURL Error in GET Login Call #:" . $err;
// }

//Get Submission Log
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leetcode.com/api/submissions/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_COOKIEFILE => $cookie
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  echo "cURL Error GET Submission Call #:" . $err;
} else {
  echo $response;
}

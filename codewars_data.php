<?php

$username = $_GET['username'];

//Get Session Info after logged in ---------------------------------------------
$curl = curl_init();
curl_setopt_array($curl, array(
  // CURLOPT_URL => "https://www.codewars.com/api/v1/users/" . $username . "/code-challenges/completed?page=0",
  CURLOPT_URL => "https://www.codewars.com/api/v1/users/" . $username,
  CURLOPT_RETURNTRANSFER => true));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

echo $response;

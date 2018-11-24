<?php

//Get Session Info after logged in ---------------------------------------------
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.codewars.com/api/v1/users/morlano/code-challenges/completed?page=0",
  CURLOPT_RETURNTRANSFER => true,
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

echo $response;

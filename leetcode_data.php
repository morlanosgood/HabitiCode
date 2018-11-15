<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leetcode.com/api/submissions/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Accept-Language: en-US,en;q=0.5",
    "Connection: keep-alive",
    "Cookie: __cfduid=d3c20efb0e9e3c294dd9c292f809ad06e1541623644; csrftoken=h3UCymyk6vS4SStiQe3mV1btIJlziCJm8fpUVrnidtsMOw0VEfe7pNr0MofvN8tw; _ga=GA1.2.1371157599.1541623728; _gid=GA1.2.2105353320.1542313597; LEETCODE_SESSION=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJfYXV0aF91c2VyX2lkIjoiMTQzODExOCIsIl9hdXRoX3VzZXJfYmFja2VuZCI6ImRqYW5nby5jb250cmliLmF1dGguYmFja2VuZHMuTW9kZWxCYWNrZW5kIiwiX2F1dGhfdXNlcl9oYXNoIjoiZWZjMTE3NDhhNGU2NWM3Y2I2MzBmMGMyYWRlOWY5MTc1ODRiNjgzZCIsImlkIjoxNDM4MTE4LCJlbWFpbCI6Im1vcmxhbm9AcHJpbmNldG9uLmVkdSIsInVzZXJuYW1lIjoibW9ybGFubyIsInVzZXJfc2x1ZyI6Im1vcmxhbm8iLCJhdmF0YXIiOiJodHRwczovL3d3dy5ncmF2YXRhci5jb20vYXZhdGFyLzk4YTYzOGNmYWI4MWZlMzc4NjlmYzZhNjY4ZWRhYmEwLnBuZz9zPTIwMCIsInRpbWVzdGFtcCI6IjIwMTgtMTEtMTUgMjA6Mjg6MzAuNDI4NDE2KzAwOjAwIiwiUkVNT1RFX0FERFIiOiI2Ni4xODAuMTgyLjEwNyIsIklERU5USVRZIjoiZjRiMzQyNDI3ZGM5M2U2ZTVmZDVjMTRlZjFmYjc0ZWMiLCJfc2Vzc2lvbl9leHBpcnkiOjEyMDk2MDB9.ocNXGfFzhom4zWh6muSWYfMorgnXNSSE9jzzuqMCyOY; _gat=1",
    "Host: leetcode.com",
    "Postman-Token: d7766433-2bc6-47c0-98d6-9aef446a2df5",
    "Referer: https://leetcode.com/submissions/",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0",
    "X-NewRelic-ID: UAQDVFVRGwEAXVlbBAg=",
    "X-Requested-With: XMLHttpRequest",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

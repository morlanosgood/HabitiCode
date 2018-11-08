<?php

// $cookieJar = tempnam(sys_get_temp_dir(), 'cookie.txt');

// $params = $_GET['data_params'];
// $user = $params['username'];
// $pass = $params['password'];

// // login to LeetCode
// $curl = curl_init();
// $curlArray = array(
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_HEADER => false,
//     CURLOPT_HTTPHEADER => "Content-type: application/json",
//     CURLOPT_URL => "https://leetcode.com/accounts/login/",
//     CURLOPT_COOKIEJAR => $cookieJar,
//     CURLOPT_POST => 2,
//     CURLOPT_POSTFIELDS => array(
//       'login': $user,
//       'password': $pass)
//   );
// curl_setopt_array($curl, $curlArray);
// $log = curl_exec($curl);
// debug_to_console("login end");
// debug_to_console($log);
// curl_close($curl);
// echo "yes";

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
  CURLOPT_HTTPHEADER => array(
    "accept: */*",
    "accept-language: en-US,en;q=0.5",
    "cache-control: no-cache",
    "connection: keep-alive",
    "cookie: __cfduid=ddef8704137127f5ab5fdaeef528d017c1541623271; csrftoken=rW5nAHgpKrYQjOlw5n50iVploJKXCagURGSXhgBESaFd6D9i7NvbUrIvXwiFWzdC; _ga=GA1.2.1663298689.1541623298; _gid=GA1.2.1223495219.1541623298;",
    "host: leetcode.com",
    // "postman-token: 6ef6a0f2-99ac-0fd2-1979-d7c3a74a4ef8",
    "referer: https://leetcode.com/submissions/",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0",
    "x-newrelic-id: UAQDVFVRGwEAXVlbBAg=",
    "x-requested-with: XMLHttpRequest"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
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

//LEETCODE CODE FOR REFERENCE
/*plugin.signin = function(user, cb) {
  log.debug('running leetcode.signin');
  const spin = h.spin('Signing in leetcode.com');
  request(config.sys.urls.login, function(e, resp, body) {
    spin.stop();
    e = checkError(e, resp, 200);
    if (e) return cb(e);

    user.loginCSRF = h.getSetCookieValue(resp, 'csrftoken');

    const opts = {
      url:     config.sys.urls.login,
      headers: {
        Origin:  config.sys.urls.base,
        Referer: config.sys.urls.login,
        Cookie:  'csrftoken=' + user.loginCSRF + ';'
      },
      form: {
        csrfmiddlewaretoken: user.loginCSRF,
        login:               user.login,
        password:            user.pass
      }
    };
    request.post(opts, function(e, resp, body) {
      if (e) return cb(e);
      if (resp.statusCode !== 302) return cb('invalid password?');

      user.sessionCSRF = h.getSetCookieValue(resp, 'csrftoken');
      user.sessionId = h.getSetCookieValue(resp, 'LEETCODE_SESSION');
      session.saveUser(user);
      return cb(null, user);
    });
  });
};*/
?>

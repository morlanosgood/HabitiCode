<?php

$cookieJar = tempnam('', 'cookie.txt');

$user = $_GET['username'];
$pass = $_GET['password'];

// login to LeetCode
$curl = curl_init();
debug_to_console("login start");
$curlArray = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_HTTPHEADER => "Content-type: application/json",
    CURLOPT_URL => "https://leetcode.com/accounts/login/",
    CURLOPT_COOKIEJAR => $cookieJar,
    CURLOPT_POST => 2,
    CURLOPT_POSTFIELDS => array(
      'login': $user,
      'password': $pass)
  );
curl_setopt_array($curl, $curlArray);
$log = curl_exec($curl);
debug_to_console("login end");
debug_to_console($log);
curl_close($curl);

//Get Submissions
$curl = curl_init();
debug_to_console("get subs start");
$curlArray = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_HTTPHEADER => "Content-type: application/json",
    CURLOPT_URL => "https://leetcode.com/api/submissions/",
    CURLOPT_COOKIEFILE => $cookieJar);

curl_setopt_array($curl, $curlArray);
$submissions = curl_exec($curl);
curl_close($curl);
debug_to_console("get subs end");
debug_to_console($submissions);
echo $submissions;




function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

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

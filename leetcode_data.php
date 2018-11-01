<?php

$user = $_GET['username'];
$pass = $_GET['password'];


$curl = curl_init();
$curlArray = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_HTTPHEADER => array(
      "Content-type: application/json"),
    CURLOPT_URL => "https://leetcode.com/api/submissions/");

curl_setopt_array($curl, $curlArray);
$submissions = curl_exec($curl);
curl_close($curl);

echo $submissions


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

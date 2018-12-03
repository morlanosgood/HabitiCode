<?php
$params = $_GET['data_params'];
$hab_user = $params['hab_user'];
$hab_key = $params['hab_key'];
$code_complete = $params['code_complete'];
$code_goal = $params['code_goal'];
$code_user = $params['code_user'];


$conn = pg_connect("host=ec2-54-225-196-122.compute-1.amazonaws.com port=5432 dbname=dcihbddtdtalab user=wcfbtrldbhrczk password=8752574ba71f85fc1023ab2befdd370ac7ad6c9c4c3e204a1055dd425cbbd01d connect_timeout=5");
if(!$conn){
  echo 'failed to establish connection';
  exit;
}
//get user's record
$result = pg_query($conn, "SELECT goal_num FROM users WHERE $hab_user = habitica_id");
//either there is no record or the call didn't work
if  (!$result) {
 echo "query did not execute";
}
//record does not exist, so create record
if (pg_num_rows($result) == 0) {
  $res = pg_query($conn, "INSERT INTO users (habitica_id, habitica_key, codewars_username, codewars_completed, codewars_goal, updated) VALUES ($hab_user, $hab_key, $code_user, $code_complete, $code_goal, time())");
  if(!$res){
    //Insert failed
    echo "insert failed";
    exit;
  }
}else { //check if need to update goal#
   $goal = pg_fetch_result($result, 0, 'codewars_goal');
   if ($goal != $code_goal){
     //update goal value in database
     $res = pg_query($conn, "UPDATE users SET codewars_goal = $code_goal WHERE $hab_user = habitica_id");
     if(!$res){
       //goal update failed
       echo "goal update failed";
       exit;
     }
   }
}
pg_close($conn);
echo "success";
?>

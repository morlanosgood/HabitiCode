<?php
$params = $_GET['data_params'];
$hab_user = $params['hab_user'];
$hab_key = $params['hab_key'];
$code_complete = $params['code_complete'];
$code_goal = $params['code_goal'];
$code_user = $params['code_user'];

$host = "ec2-54-225-196-122.compute-1.amazonaws.com";
$port = "5432";
$dbname = "dcihbddtdtalab";
$user = "wcfbtrldbhrczk";
$password = "8752574ba71f85fc1023ab2befdd370ac7ad6c9c4c3e204a1055dd425cbbd01d";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password connect_timeout=5") or die("could not connect to server");

//get user's record
$query = "SELECT codewars_goal FROM public.user WHERE habitica_id = $1";
$result = pg_query_params($conn, $query, array($hab_user)) or die("select query failed");

//record does not exist, so create record
if (pg_num_rows($result) == 0) {
  echo "record does not exist. will add now \n";
  $query = "INSERT INTO public.user (habitica_id, habitica_key, codewars_username, codewars_completed, codewars_goal, is_valid) VALUES ($1, $2, $3, $4, $5, $6)";
  $arr = array($hab_user, $hab_key, $code_user, $code_complete, $code_goal, 'true');
  $res = pg_query_params($conn, $query, $arr) or die("insert failed");
}

 //$quer = "SELECT codewars_goal FROM public.user WHERE habitica_id = 'him'";
// $result = pg_query($conn, $quer) or die("could not complete call");

//echo pg_fetch_result($result, 0, 'codewars_goal') . "\n";
pg_close($conn);



// // echo $result;
// // echo pg_fetch_result($result, 0, 'codewars_goal');
// //either there is no record or the call didn't work
// if  (!$result) {
//  echo "query did not execute";
//  exit;
// }

// }else { //check if need to update goal#
//    $goal = pg_fetch_result($result, 0, 'codewars_goal');
//    if ($goal != $code_goal){
//      //update goal value in database
//      $res = pg_query($conn, "UPDATE users SET codewars_goal = $code_goal WHERE $hab_user = habitica_id");
//      if(!$res){
//        //goal update failed
//        echo "goal update failed";
//        exit;
//      }
//    }
// }

//echo "success";
?>

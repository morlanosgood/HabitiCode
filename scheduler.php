<?php
require_once(__DIR__ . '/api/habitica_api.php');

echo "i am running \n";
$host = "ec2-54-225-196-122.compute-1.amazonaws.com";
$port = "5432";
$dbname = "dcihbddtdtalab";
$user = "wcfbtrldbhrczk";
$password = "8752574ba71f85fc1023ab2befdd370ac7ad6c9c4c3e204a1055dd425cbbd01d";
echo "bruh";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password connect_timeout=5") or die("could not connect to server");
echo "hi";

//get valid account entries
$query = "SELECT * FROM public.user WHERE is_valid = true";
$result = pg_query($conn, $query) or die("select query failed");
while ($row = pg_fetch_assoc($result)) {

      //make Codewars call---------------------------------------------------------------------
      echo "i am making codewars call\n";
      $curl = curl_init();
      curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.codewars.com/api/v1/users/" . $username . "/code-challenges/completed?page=0",
        CURLOPT_URL => "https://www.codewars.com/api/v1/users/" . $username,
        CURLOPT_RETURNTRANSFER => true));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      $obj = json_decode($response, true);
      $code_done = $obj['codeChallenges']['totalCompleted'];
      echo "i made codewars call\n";


    //----Do Increment Math------------------------------------------------------------------------------------
     echo " i am doing math\n";
      $change = intdiv($code_done, $row['codewars_goal']);
      $to_add = ($change * $row['codewars_goal']) + $row['codewars_completed'];
      echo "i have done math\n";
   //-----Change Habit if necessary
   echo "start habit process\n";
      if ($change > 1){
        $habit = new Habitica($row['habitica_id'], $row['habitica_key']);
        //check habit is there
        echo "check habit is there";
        $taskName = "Codewars - complete " . $row['codewars_goal'] . " challenges";
        $task_id = $habit->getTaskId($taskName);
        if($task_id == 'No task found with that name')
          {
              echo "create habit if not there";
            $newTaskParams = array( 'type'=> 'habit', 'text'=> $taskName, 'note'=> 'This task was created with HabitiCode.');
            $task_id = $habit->newTask($newTaskParams);
          }
        //call habitica increment
        echo "increment habitica";
        $scoringParams = array('taskId'=> $task_id, 'direction' => 'up');
        for ($x = 0; $x < $change; $x++)
        {
          $habit->taskScoring($scoringParams);
        }
        //change value in database
        echo "change value in db";
        $query = "UPDATE public.user SET codewars_completed = $1 WHERE habitica_id = $2";
        $arr = array($to_add, $row['habitica_id']);
        $res = pg_query_params($conn, $query, $arr) or die("goal update failed");
      }
}
echo "done";
?>

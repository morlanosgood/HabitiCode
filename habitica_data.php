<?php
require_once(__DIR__ . '/api/habitica_api.php');

$params = $_GET['data_params'];
$action = $_GET['action'];
$user_id = $params['user_id'];
$api_tok = $params['api_tok'];

$habit = new Habitica($user_id, $api_tok);

if($action == 'get_stats'){
    echo json_encode($habit->userStats());
} elseif ($action == 'check_habit') {
    //get taskId
    $task_name = $params['task_name'];
    $task_id = $habit->getTaskId($task_name);

    //if task not available, create it
    if($task_id == 'No task found with that name'){
      $newTaskParams = array( 'type': 'habit', 'text': $task_name, 'note': 'This task was created with HabitiCode.');
      $task_id = $habit->newTask($newTaskParams);
    }
    echo $task_id
} elseif ($action == 'change_habit') {
  // $dir = $params['direction'];
  // if(($task_id != 'No task found with that name') && ($dir == 'up' || $dir == 'down')){
  //     $params = array('taskId'=>$task_id,'direction'=>$dir);
  //     $rval = $habit->taskScoring($params);
  //     echo json_encode($rval);
  // }else{
  //     echo 'ERROR';
  // }
}

?>

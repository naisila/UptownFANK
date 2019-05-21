<?php
/**
 * View all teams where user is member Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $teamId = $_POST['teamId'];
  //-----------

  $teamId = (string) $teamId;

  $reg_query = "SELECT B.boardID, B.name, B.description, B.priority, B.color, B.requirements, B.estimatedTime FROM Board B JOIN WorksOn W ON (B.boardID = W.boardID) WHERE W.teamID = '$teamId';";
  
  $return_arr = array();

  if(mysqli_query($conn, $reg_query))
  {
    $result->status = "success";
    //$result = json_encode($result);
    //array_push($return_arr, $result);
    $mean = mysqli_query($conn, $reg_query);
    $rows = mysqli_fetch_all($mean, MYSQL_ASSOC);
    foreach ($rows as $row) {
      $row_array->boardID = $row['boardID'];
      $row_array->name = $row['name'];
      $row_array->description = $row['description'];
      $row_array->priority = $row['priority'];
      $row_array->color = $row['color'];
      $row_array->requirements = $row['requirements'];
      $row_array->estimatedTime = $row['estimatedTime'];
      array_push($return_arr, $row_array);
      $row_array = null;
    }
    $result->data = $return_arr;
  }
  else
  {
    $result->status = "fail";
    $result->data = "";// = json_encode($result);
    //array_push($return_arr, $result);
  }

  //output in this form
  //[{"status": "success"}, {"name": "Team1", "affiliation": "Bilkent", "supervisor": "Naisila", "isSupervisor": "True"}, ...]
  $result = json_encode($result);
  echo $result;
?>
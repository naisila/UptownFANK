<?php
/**
 * View all teams where user is member Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $userId = $_POST['userId'];
  //-----------

  $userId = (string) $userId;

  $reg_query = "SELECT * FROM Team;";
  
  $return_arr = array();

  $res = mysqli_query($conn, $reg_query);

  if($res)
  {
    $result->status = "success";
    //$result = json_encode($result);
    //array_push($return_arr, $result);
    while ($row = mysql_fetch_array($reg_query, MYSQL_ASSOC)) {
      $row_array->teamId = $row['teamID'];
      $row_array->name = $row['name'];
      $row_array->affiliation = $row['affiliation'];
      $row_array->supervisor = $row['supervisor'];
      $row_array->isSupervisor = $row['isSupervisor'];
      $row_array = json_encode($row_array);
      array_push($return_arr, $row_array);
    }
    $result->data = $res;
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
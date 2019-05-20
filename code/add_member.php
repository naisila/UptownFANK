<?php
/**
 * Add member Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $userId = $_POST['userId'];
  $teamId = $_POST['teamId'];
  //-----------

  $userId = (string) $userId;
  $teamId = (string) $teamId;

  $reg_query = "INSERT INTO Member(userID, teamID) VALUES('$userId', '$teamId');";

  if(mysqli_query($conn, $reg_query))
  {
    $result->status = "success";
  }
  else
  {
    $result->status = "fail";
  }

  //{"status": "success"}

  $json_res = json_encode($result);
  echo $json_res;
?>
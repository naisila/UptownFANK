<?php
/**
 * Add member Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */
  include('utils/config.php');
  //Give me inputs as in these POST functions
  //-----------
  $email = $_POST['email'];
  $teamId = $_POST['teamId'];
  //-----------
  $email = (string) $email;
  $teamId = (string) $teamId;
  $reg_query = "SELECT userID FROM BasicUser WHERE email = '$email';";
  $res = mysqli_query($conn, $reg_query);
  $userId = $res->fetch_assoc()["userID"];
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
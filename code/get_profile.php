<?php
/**
 * Create Board Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $userId = $_POST['userId'];
  //-----------

  $userId = (string) $userId;


  $reg_query = "SELECT * FROM BasicUser WHERE userID = '$userId';";
  $res = mysqli_query($conn, $reg_query);

  if(mysqli_query($conn, $reg_query))
  {
    $result->status = "success";
    $result->$name = $res->fetch_assoc()["name"];
    $result->$address = $res->fetch_assoc()["address"];
    $result->$email = $res->fetch_assoc()["email"];
  }
  else
  {
    $result->status = "fail";
    $result->name = "";
    $result->address = "";
    $result->email = "";
  }

  //{"status": "success", "boardId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
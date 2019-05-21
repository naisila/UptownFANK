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

  if(mysqli_query($conn, $reg_query))
  {
    $res = mysqli_query($conn, $reg_query);
    $rows = mysqli_fetch_all($res, MYSQL_ASSOC);

    $result->status = "success";
    $result->name = $rows[0]["name"];
    $result->address = $rows[0]["address"];
    $result->email = $rows[0]["email"];
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
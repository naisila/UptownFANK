<?php
/**
 * Performs Task Procedure
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $cardId = $_POST['cardId'];
  $userId = $_POST['userId'];
  //-----------

  $cardId = (string) $cardId;
  $userId = (string) $userId;

  $reg_query = "INSERT INTO Member(cardID, userID) VALUES('$cardId', '$userId');";

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
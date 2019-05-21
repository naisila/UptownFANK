<?php
/**
 * Creating card 
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $teamId = $_POST['teamId'];
  //-----------

  $teamId = (string) $teamId;

  $reg_query = "DELETE FROM Team WHERE teamID = '$teamId';";

  if(mysqli_query($conn, $reg_query))
  {
    $result->status = "success";
  }
  else
  {
    $result->status = "fail";
  }

  //output in the form
  //{"status": "success", "cardId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
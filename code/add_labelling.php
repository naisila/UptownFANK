<?php
/**
 * Performs Labelling Procedure
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $cardId = $_POST['cardId'];s
  $labelId = $_POST['labelId'];
  //-----------

  $cardId = (string) $cardId;
  $labelId = (string) $labelId;

  $reg_query = "INSERT INTO Member(cardID, labelID) VALUES('$cardId', '$labelId');";

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
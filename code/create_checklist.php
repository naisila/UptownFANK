<?php
/**
 * Checklist procedure
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------

checklistID, name, checkStatus, description, relatedCard
  $name = $_POST['name'];

  //Should be either 'True' or 'False'
  $checkStatus = $_POST['checkStatus'];
  $description = $_POST['description'];
  $relatedCard = $_POST['relatedCard'];
 
  $name = (string) $name;
  $checkStatus = (string) $checkStatus;
  $description = (string) $description;
  $relatedCard = (string) $relatedCard;

  $reg_query = "INSERT INTO List(name, checkStatus, description, relatedCard) VALUES ( '$name', '$checkStatus','$description','$relatedCard');";


  if(mysqli_query($conn, $reg_query))
  {
    $checklistId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->checklistId = $checklistId;
  }
  else
  {
    $result->status = "fail";
    $result->checklistId = "";
  }

  //output in the form
  //{"status": "success", "checklistId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
<?php
/**
 * Create Item Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $relatedCheckList = $_POST['relatedCheckList'];

  //Should be either 'True' or 'False'
  $completedStatus = $_POST['completedStatus'];
  $content = $_POST['content'];
  $completor = $_POST['completor'];
  //-----------

  $relatedCheckList = (string) $relatedCheckList;
  $completedStatus = (string) $completedStatus;
  $content = (string) $content;
  $completor = (string) $completor;
  
  //I NEED TO RESET DB, PUT AUTO_INCREMENT FOR ITEMID ---- DONE
  $reg_query = "INSERT INTO Item(relatedCheckList, completedStatus, content, completor) VALUES ( '$relatedCheckList', '$completedStatus', '$content', '$completor');";


  if(mysqli_query($conn, $reg_query))
  {
    $itemId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->itemId = $itemId;
  }
  else
  {
    $result->status = "fail";
    $result->itemId = "";
  }

  //output in the form
  //{"status": "success", "itemId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
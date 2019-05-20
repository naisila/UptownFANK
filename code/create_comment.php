<?php
/**
 * Create Comment Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $relatedCard = $_POST['relatedCard'];

  //CAUTION: TIMESTAMP FORMAT IN '2038-01-19 03:14:07'
  $timestamp = $_POST['timestamp'];

  //In form of 'True' or 'False'
  $resolvedStatus = $_POST['resolvedStatus'];

  $commenter = $_POST['commenter'];
  $text = $_POST['text'];
  //-----------

  $relatedCard = (string) $relatedCard;
  $timestamp = (string) $timestamp;
  $commenter = (string) $commenter;
  $text = (string) $text;
  $resolvedStatus = (string) $resolvedStatus;
  
  //I NEED TO RESET DB, PUT AUTO_INCREMENT FOR ITEMID
  $reg_query = "INSERT INTO Comment(relatedCard, timestamp, commenter, text, resolvedStatus) VALUES ( '$relatedCard', '$timestamp', '$commenter', '$text', '$resolvedStatus');";


  if(mysqli_query($conn, $reg_query))
  {
    $commentId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->commentId = $commentId;
  }
  else
  {
    $result->status = "fail";
    $result->commentId = "";
  }

  //output in the form
  //{"status": "success", "commentId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
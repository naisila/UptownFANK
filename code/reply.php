<?php
/**
 * Reply Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $commentId = $_POST['commentId'];
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
  $commentId = (string) $commentId;
  
  $reg_query = "INSERT INTO Comment(relatedCard, timestamp, commenter, text, resolvedStatus) VALUES ( '$relatedCard', '$timestamp', '$commenter', '$text', '$resolvedStatus');";


  if(mysqli_query($conn, $reg_query))
  {
    $replyId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->replyId = $replyId;
    $query = "INSERT INTO Replies(replyID, commentID, relatedCard) VALUES ('$replyId', '$commentId', '$relatedCard');";
    mysqli_query($conn, $query)
  }
  else
  {
    $result->status = "fail";
    $result->replyId = "";
  }

  //output in the form
  //{"status": "success", "replyId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
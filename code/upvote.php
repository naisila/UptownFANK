<?php
/**
 * Upvote Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $userId = $_POST['userId'];
  $commentId = $_POST['commentId'];
  $relatedCard = $_POST['relatedCard'];
  //-----------

  $relatedCard = (string) $relatedCard;
  $commentId = (string) $commentId;
  $userId = (string) $userId;
  
  $reg_query = "INSERT INTO Upvotes(userID, commentID, relatedCard) VALUES ( '$userId', '$commentId', '$relatedCard');";


  if(mysqli_query($conn, $reg_query))
  {
    $result->status = "success";
  }
  else
  {
    $result->status = "fail";
  }

  //output in the form
  //{"status": "success"}

  $json_res = json_encode($result);
  echo $json_res;
?>
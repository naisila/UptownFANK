<?php
/**
 * Creating Attachment
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $name = $_POST['name'];
  $size = $_POST['size'];
  $description = $_POST['description'];
  $attacher = $_POST['attacher'];
  $relatedCard = $_POST['relatedCard'];

  //Caution: DATETIME IS IN THIS FORMAT '2000-12-31 23:59:59'
  $uploadDate = $_POST['uploadDate'];

  //-----------

  $name = (string) $name;
  $size = (string) $size;
  $description = (string) $description;
  $attacher = (string) $attacher;
  $relatedCard = (string) $relatedCard;
  $uploadDate = (string) $uploadDate;

  $reg_query = "INSERT INTO List(name, size, uploadDate, description, attacher, relatedCard) VALUES ( '$name', '$size','$uploadDate','$description', '$attacher', '$relatedCard');";

  if(mysqli_query($conn, $reg_query))
  {
    $attachmentId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->attachmentId = $attachmentId;
  }
  else
  {
    $result->status = "fail";
    $result->attachmentId = "";
  }

  //output in the form
  //{"status": "success", "attachmentId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
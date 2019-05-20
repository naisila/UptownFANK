<?php
/**
 * Creating Label
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $color = $_POST['color'];
  $text = $_POST['text'];
  $adder = $_POST['adder'];

  //Caution: IMPORTANCE IS INTEGER 0 < X <= 5
  $importance = $_POST['importance'];
  
  //-----------

  $color = (string) $color;
  $text = (string) $text;
  $adder = (string) $adder;
  $importance = (string) $importance;

  $reg_query = "INSERT INTO List(color, text, importance, adder) VALUES ( '$color', '$text','$importance','$adder');";

  if(mysqli_query($conn, $reg_query))
  {
    $alabelId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->labelId = $labelId;
  }
  else
  {
    $result->status = "fail";
    $result->labelId = "";
  }

  //output in the form
  //{"status": "success", "attachmentId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>
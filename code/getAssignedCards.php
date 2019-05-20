<?php
/**
 * getting assigned cards to a user
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

   //Give me inputs as in these POST functions
  //-----------
  $userId = $_POST['userId'];
  $boardId= $_POST['boardId'];

  $userId = (string) $userId;
  $boardId = (string) $boardId;

  $reg_query = " CREATE VIEW AssignedCards AS ((SELECT C.name, C.priority, C.description, C.duedate FROM (SELECT cardID FROM PerformsTask P WHERE P.userID = '@userId' ) WHERE B.boardID = '@boardId' AND L.boardID = '@boardId') NATURAL JOIN Card C NATURAL JOIN List L NATURAL JOIN Board B);";

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
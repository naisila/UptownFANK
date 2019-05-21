<?php

    include('utils/config.php');

    mysqli_query($conn, 'DROP TABLE IF EXISTS membersNo;');
    mysqli_query($conn, 'CREATE TABLE membersNo AS SELECT teamID, COUNT(userID) as memberCount FROM Member GROUP BY teamID;');

    $result = mysqli_query($conn,'SELECT t.name, B.name as supervisor, m.memberCount FROM Team t NATURAL JOIN membersNo m JOIN BasicUser B ON B.userID = t.supervisor WHERE m.memberCount >= ALL (SELECT memberCount FROM membersNo);');

    echo '<table border="1">
        <tr>
          <th>Team Name</th>
          <th>Team Supervisor</th>
        <th>Number of Members</th>
        </tr>';

                                              while($row = mysqli_fetch_array($result))
                                              {
                                              echo '<tr>';
                                              echo '<td>' . $row["name"] . '</td>';
                                              echo '<td>' . $row["supervisor"] . '</td>';
                                              echo '<td>' . $row["memberCount"] . '</td>';
                                              echo '</tr>';
                                              }
                                              echo '</table>';
?>
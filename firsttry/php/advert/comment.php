<?php

    include "../../db_connect.php";

    $statement = $link->prepare("SELECT Text, Login, Ad_ID, CommentDate
                                       FROM Comment 
                                       JOIN User ON User.id = User_ID
                                       WHERE Ad_ID = ?");
    $statement->bind_param("i", $advert_id);
    $statement->execute();
    $statement =$statement->get_result();

?>

<?php while  ($comment = $statement->fetch_assoc()):?>

    <table>
        <tr>
            <td><?=$comment['Login']?></td>
            <td><?=$comment['CommentDate']?></td>
        </tr>
        <tr>
            <td><?= $comment['Text']; ?></td>
        </tr>
    </table>

<?php endwhile;?>


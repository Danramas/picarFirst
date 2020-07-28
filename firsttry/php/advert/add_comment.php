<?php

    include "../../db_connect.php";

    $statement = $link->prepare("INSERT INTO Comment (Text, Ad_ID, User_ID, CommentDate)
                                              VALUES (?, ?, ?, ?)");
    $statement->bind_param("siis", $text_comment, $advert_id, $user_id, $date);

    $user_id = (int)$_POST["User_id"];
    $advert_id = (int)$_POST["Ad_id"];
    $text_comment = htmlspecialchars($_POST["text_comment"]);
    date_default_timezone_set('UTC');
    $date = date('Y-m-d');

    $statement->execute();
    $statement->close();

    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: <#>\r\n";

    $statement = $link->prepare("SELECT email
                                        FROM User
                                        WHERE id = ?;");
    $statement->bind_param("s", $user_id);
    $statement->execute();
    $statement = $statement->get_result();
    $email = $statement->fetch_assoc();

    mail("$email", "New comment",
        "\n New comment was added to one of your advert
                    \n $text_comment 
                    \n picar.local/php/advert/advert_view.php?advert_id={$advert_id}", "$headers");

    header("Location: /php/advert/advert_view.php?advert_id={$advert_id}");
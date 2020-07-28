<?php

    $user_id = (int)$_POST['user_id'];

    date_default_timezone_set('UTC');
    $date = date('Y-m-d');

    include "../../db_connect.php";
    $statement = $link->prepare("SELECT isDeleted 
                                                  FROM User
                                                 WHERE id = ?;");
    $statement->bind_param("i", $user_id);
    $statement->execute();
    $statement =$statement->get_result();
    $data_id = $statement->fetch_assoc();

    if ($data_id['isDeleted'] == NULL){
        $statement = $link->prepare("UPDATE User 
                                     SET isDeleted =? 
                                    WHERE id = ?");
        $statement->bind_param("si", $date, $user_id);
        $statement->execute();


    } else {
        $statement = $link->prepare("UPDATE User 
                                     SET isDeleted = NULL
                                    WHERE id = ?");
        $statement->bind_param("i", $user_id);
        $statement->execute();
    }

    header('Location: /php/admin/admin_panel.php');
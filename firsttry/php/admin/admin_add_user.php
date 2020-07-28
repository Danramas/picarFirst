<?php

    if (isset($_POST['login'])){$user_login = $_POST['login'];}
    if (isset($_POST['email'])){$user_email = $_POST['email'];}
    if (isset($_POST['password'])){$user_password = $_POST['password'];}
    if (isset($_POST['admin'])){$user_isAdmin = $_POST['admin'];}

    include "../../db_connect.php";

    if($user_isAdmin !== '1') {
        $statement = $link->prepare("INSERT INTO User (login, password, email)
                                              VALUES (?, ?, ?)");
        $statement->bind_param("sss", $user_login, $user_password, $user_email);
        $statement->execute();
        $statement->close();
    } else {
        $statement = $link->prepare("INSERT INTO User (login, password, email, isAdmin)
                                              VALUES (?, ?, ?,?)");
        $statement->bind_param("sss", $user_login, $user_password, $user_email, $user_isAdmin);
        $statement->execute();
        $statement->close();
    }

    header('Location: /php/admin/admin_panel.php');

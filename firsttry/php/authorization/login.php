<?php

    session_start();

    $email = htmlspecialchars($_POST['email']);
    $password = (string)$_POST['password'];

    include "../../db_connect.php";

    $statement = $link->prepare("SELECT id, login, password, isDeleted, isAdmin
                                              FROM User
                                             WHERE isDeleted IS NULL and email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $statement =$statement->get_result();
    $data = $statement->fetch_assoc();

    if ($data['password'] == $password) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['name'] = $data['login'];
        $_SESSION['email'] = $email;
        $_SESSION['admin'] = $data['isAdmin'];
        $_SESSION['deleted'] = $data['isDeleted'];
        header('Location: /index.php');
    } else {
        header('Location: login_form.php');
    }

    mysqli_close($link);






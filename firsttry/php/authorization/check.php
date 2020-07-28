<?php

    session_start();

    $id = $_SESSION['id'];

    include "../../db_connect.php";

    $statement = $link->prepare("SELECT isDeleted 
                                         FROM User
                                         WHERE id = ?;");
    $statement->bind_param("s", $id);
    $statement->execute();
    $statement = $statement->get_result();
    $data = $statement->fetch_assoc();

    if ($data['isDeleted'] !== NULL){
        header("Location: /php/authorization/logout.php");
        exit;
    }
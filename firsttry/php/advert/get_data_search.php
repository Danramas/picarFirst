<?php

    include "../../db_connect.php";

    header('Content-Type: application/json');

    $filters = [];
    $advertBinds = [];

    if (!empty($_GET['year1'])) {
        $filters[] = 'year >= ?';
        $advertBinds[] = $_GET['year1'];
    }
    if (!empty($_GET['year2'])) {
        $filters[] = 'year <= ?';
        $advertBinds[] = $_GET['year2'];
    }

    if (!empty($_GET['id_modif'])) {
        $filters[] = 'Modification_ID = ?';
        $advertBinds[] = $_GET['id_modif'];
    } elseif (!empty($_GET['id_model'])) {
        $filters[] = "Modification_ID IN (SELECT id FROM Modification WHERE Model_ID = ?)";
        $advertBinds[] = $_GET['id_model'];
    } elseif (!empty($_GET['id_mark'])) {
        $filters[] = "Modification_ID IN (SELECT id FROM Modification WHERE Model_ID IN (SELECT id FROM Model WHERE Mark_ID = ?))";
        $advertBinds[] = $_GET['id_mark'];
    }

    if ($_GET['isChecked'] == 1) {
        $filters[] = '!isnull(img1)';
    }

    $requestPart = implode(' AND ', $filters);
    $query = "SELECT Ad.id, 
                     markName, 
                     modelName,
                     modifyName, 
                     year, 
                     img1, 
                     AdDate
                FROM Ad
                JOIN Modification ON Modification.id = Modification_ID 
                JOIN Model ON Model.id = Model_ID
                JOIN Mark ON Mark.id = Model.Mark_ID
                JOIN User ON User.id = User_ID 
                WHERE {$requestPart}";

    $statement_advert_info = $link->prepare($query);
    $statement_advert_info->bind_param(str_repeat("i", count($advertBinds)), ...$advertBinds);
    $statement_advert_info->execute();
    $statement_advert_info = $statement_advert_info->get_result();

    while ($advert_info = $statement_advert_info->fetch_assoc()) {
        $newDate = date("d-m-Y", strtotime($advert_info['AdDate']));
        $adverts[] = [
            'id' => $advert_info['id'],
            'markName' => $advert_info['markName'],
            'modelName' => $advert_info['modelName'],
            'modifyName' => $advert_info['modifyName'],
            'year' => $advert_info['year'],
            'img1' => $advert_info['img1'],
            'AdDate' => $newDate,
        ];
    }
    echo json_encode($adverts);

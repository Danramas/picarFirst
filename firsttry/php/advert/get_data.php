<?php

    session_start();

    include "../../db_connect.php";

    header('Content-Type: application/json');



switch($_GET['action']) {

        case 'get_models':

            $mark_id = $_GET['id_mark'];

            $statement = $link->prepare("SELECT  id, modelName FROM Model 
                                                    WHERE Mark_ID = ?");
            $statement->bind_param("i", $mark_id);
            $statement->execute();
            $statement =$statement->get_result();

            $models = [
                ['id' => "", 'name' => "Select a car model ..."]
            ];
            while ($model = $statement->fetch_assoc()) {
                $models[] = ['id' => $model['id'], 'name' => $model['modelName']];
            };
            echo json_encode($models);

            break;

        case 'get_modifs':

            $model_id = $_GET['id_model'];

            $statement = $link->prepare("SELECT  id, modifyName FROM Modification 
                                                    WHERE Model_ID = ?");
            $statement->bind_param("i", $model_id);
            $statement->execute();
            $statement =$statement->get_result();

            $modifs = [
                ['id' => "", 'name' => "Select a car modification ..."]
            ];
            while ($modif = $statement->fetch_assoc()) {
                $modifs[] = ['id' => $modif['id'], 'name' => $modif['modifyName']];
            };
            echo json_encode($modifs);
            break;
}


<?php

    session_start();

    include "../../db_connect.php";

    if (!empty($_POST['year'])){
        if (!empty($_POST['id_modif'])){

            $errors = [];

            $img_names = [];

            foreach ($_FILES["image"]["error"] as $key => $error) {

                $Random_Number = rand(0, 9999999999);

                if ($_FILES['image']['name'][$key]){
                    $file_name = $Random_Number;
                }
                $file_size = $_FILES['image']['size'][$key];
                $file_tmp = $_FILES['image']['tmp_name'][$key];
                $file_type = $_FILES['image']['type'][$key];
                $file_ext = strtolower(end(explode('.', $_FILES['image']['name'][$key])));

                $allowed = array("jpeg", "jpg", "png");


                if ($file_size > 2097152) {
                    $errors[] = 'Big size';
                }

                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, '../../img/' . "$file_name.$file_ext");
                    $img_names[$key] = "$file_name.$file_ext";
                } else {
                    print $errors;
                }

            }

            $mod_id = $_POST['id_modif'];
            $user_id = $_SESSION['id'];
            $AdDate = Date('Y-m-d');
            $car_year = $_POST['year'];
            $img1 = $img_names[0];
            $img2 = $img_names[1];
            $img3 = $img_names[2];
            $img4 = $img_names[3];
            $img5 = $img_names[4];

            $statement = $link->prepare("INSERT INTO Ad (Modification_ID, User_ID, AdDate, year, img1, img2, img3, img4, img5)
                                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("iisisssss", $mod_id, $user_id, $AdDate, $car_year, $img1, $img2, $img3, $img4, $img5);
            $statement->execute();
            $statement->close();

            $newAdvert_id = mysqli_insert_id($link);

            mysqli_close($link);
        }
    }

    header("Location: /php/advert/advert_view.php?advert_id={$newAdvert_id}");



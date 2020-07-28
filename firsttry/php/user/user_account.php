<?php

    include "../authorization/check.php";

    $user_id = $_SESSION['id'];

?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Picar, pick your car!</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" media="all">

</head>
<body>

<?php include "../../header.php";
      include "../authorization/login_check.php";
?>

<div class="content">
    <div class="mid">
        <div class="advert">
            <a href="/php/advert/advert_create.php">Add new advert</a>
            <h3>Your adverts</h3>


            <?php

                include "../../db_connect.php";

                $statement = $link->prepare("SELECT id
                                             FROM Ad
                                             WHERE User_ID = ?;");
                $statement->bind_param("s", $user_id);
                $statement->execute();
                $statement = $statement->get_result();

                $ids = [];

                echo "<table>";
                while($data = $statement->fetch_assoc()){

                    $ids[] = $data['id'];

                    $statement_name = $link->prepare("SELECT Ad.id, markName, modelName,
                                       ModifyName, year, img1, AdDate
                                       FROM Ad
                                       JOIN Modification ON Modification.id = Modification_ID 
                                       JOIN Model ON Model.id = Model_ID
                                       JOIN Mark ON Mark.id = Model.Mark_ID
                                       JOIN User ON User.id = User_ID WHERE Ad.id= ?");
                    $statement_name->bind_param("s", $data['id']);
                    $statement_name->execute();
                    $statement_name = $statement_name->get_result();
                    $data_name = $statement_name->fetch_assoc();

                    $newDate = date("d-m-Y", strtotime($data_name['AdDate']));

                        echo"<tr> 
                                <td>
                                    <a href='/php/advert/advert_view.php?advert_id=" . $data['id'] . "'>
                                    <img width='150' height='100' src='/img/".$data_name['img1']."'></a>
                                </td>
                            </tr>  
                            <tr>
                                <td>
                                    <a href='/php/advert/advert_view.php?advert_id=" . $data['id'] . "'> 
                                    ".$data_name['markName']." ".$data_name['modelName']." 
                                    ".$data_name['ModifyName']." ".$data_name['year']."
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Created: ".$newDate."                                  
                                </td>
                            </tr>  
                            <tr>
                                <td>
                                    Advert ID: ".$data_name['id']."                                  
                                </td>
                            </tr>";
                }
                echo "</table> </br>";

            ?>
        </div>
    </div>
</div> <div class="clear"></div>

<!--- JS scripts --->

</body>
</html>


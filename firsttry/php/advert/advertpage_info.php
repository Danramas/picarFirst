<?php

    include "../../db_connect.php";

    $statement = $link->prepare("SELECT Ad.id,markName,modelName,
                                       ModifyName,year,AdDate,login,
                                       img1,img2,img3,img4,img5
                                       FROM Ad
                                       JOIN Modification ON Modification.id = Modification_ID 
                                       JOIN Model ON Model.id = Model_ID
                                       JOIN Mark ON Mark.id = Model.Mark_ID
                                       JOIN User ON User.id = User_ID WHERE Ad.id= ?");
    $statement->bind_param("i", $advert_id);
    $statement->execute();
    $statement =$statement->get_result();

?>
<?php while  ($data = $statement->fetch_assoc()):?>
    <!-- container for processing information about the images -->
    <div class="images">
        <table>
            <th>
                <img width="492"  height="320"
                src="/img/<?=$data['img1'];?>" alt="car1">
            </th>
        </table>
        <table align="left">
            <td>
                <img width="120" height="96" src="/img/<?=$data['img2'];?>" alt="car2">
            </td>

            <td>
                <img width="120" height="96" src="/img/<?=$data['img3'];?>" alt="car3">
            </td>

            <td>
                <img width="120" height="96" src="/img/<?=$data['img4'];?>" alt="car4">
            </td>

            <td>
                <img width="120" height="96" src="/img/<?=$data['img5'];?>" alt="car5">
            </td>
        </table>
    </div>

    <!-- container for processing information about the ad-->
    <div class="info">
        <table>
            <tr>
                <td>Mark:</td>
                <td><?=$data['markName'];?></td>
            </tr>

            <tr>
                <td>Model:</td>
                <td><?=$data['modelName'];?></td>
            </tr>

            <tr>
                <td>Modification:</td>
                <td><?=$data['ModifyName'];?></td>
            </tr>

            <tr>
                <td>Year:</td>
                <td><?=$data['year'];?></td>
            </tr>
        </table>
    </div>

    <!-- container for processing information about the author-->
    <div class="author">
        <table>
            <tr>
                <td>Add:</td>
                <td><?=$data['login'];?></td>
            </tr>

            <tr>
                <td>Date:</td>
                <td><?=$data['AdDate'];?></td>
            </tr>
        </table>
    </div>

<?php endwhile; ?>

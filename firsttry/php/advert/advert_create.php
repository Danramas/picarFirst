<?php

    include "../authorization/check.php";

    include '../../db_connect.php';

    $mark_sql = mysqli_query($link, 'SELECT id, markName FROM Mark');

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advert page</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" media="all">
</head>
<body>

<?php

    include "../../header.php";
    $year = Date('Y');
    include "../authorization/login_check.php";
?>

<div class="create">
    <h1>Adding new advert:</h1>

    <form action="/php/advert/upload_data.php" method="post" enctype="multipart/form-data">
    <select required id="selectMark">
        <option value="">Select a car mark ...</option>
        <?php while($marks = mysqli_fetch_array($mark_sql)): ?>
            <option value="<?=$marks['id']?>"><?=$marks['markName']?></option>
        <?php endwhile; ?>
    </select>

    <select required id="selectModel">
        <option value="">Select a car model ...</option>
    </select>

    <select required id='selectModif' name="id_modif" onchange="selectId(this)">
        <option value=''>Select a car modification ...</option>
    </select>

    <form>
    <br>
        <input id="image1" type="file" name="image[]">
        <input id="image2" type="file" name="image[]">
        <input id="image3" type="file" name="image[]">
        <input id="image4" type="file" name="image[]">
        <input id="image5" type="file" name="image[]">
        <p><input name="year" type="number" id="inputYear" min="1900" max="<?= $year ?>" value="2000"></p>
        <p><input type="submit" id="Submit" value="Отправить"></p>
    </form>

</div>
<!--- JS Scripts --->

    <script type="text/javascript" src="/js/jQuery.js"></script>
    <script type="text/javascript" src="/js/data_send.js"></script>

</body>
</html>

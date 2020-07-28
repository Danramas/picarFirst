<?php

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

    $year = Date('Y');
    include "../../header.php";

?>
<div class="search">
    <h1>Search advert:</h1>

    <select id="selectMark">
        <option value="">Select a car mark ...</option>
        <?php while($marks = mysqli_fetch_array($mark_sql)): ?>
            <option value="<?=$marks['id']?>"><?=$marks['markName']?></option>
        <?php endwhile; ?>
    </select>

    <select id="selectModel">
        <option value="">Select a car model ...</option>
    </select>

    <select id='selectModif' onchange="selectId(this)">
        <option value=''>Select a car modification ...</option>
    </select>

    <p><input type="number" id="inputYear1" min="1900" max="<?= $year;?>" value="2000"> - <input type="number" id="inputYear2" min="1900" max="<?= $year;?>" value="<?= $year;?>"></p>
    Images: <input type="checkbox" id="checkImage" value="0"></br>
    <p><input type="submit" id="Submit" onclick="filterAdverts()" value="Search"></p>
    <hr>
    <p><table id="advertInfo" border="1px" width="1px"></table></p>

</div>
<!--- JS Scripts --->

<script type="text/javascript" src="/js/jQuery.js"></script>
<script type="text/javascript" src="/js/data_send.js"></script>
<script type="text/javascript" src="/js/data_search.js"></script>

</body>
</html>

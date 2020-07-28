<?php

    include "../authorization/check.php";

    if ($_SESSION['admin'] == NULL){
        header("Location: /index.php");
        exit;
    }
?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Picar, pick your car!</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" media="all">

</head>
<body>

<?php include "../../header.php"?>


<div class="content">
    <div class="mid">
        <div class="fon">
            <a href="/php/admin/admin_add_user_form.php">Add a new User</a><br>
            <?php include "admin_show_users.php"; ?>
        </div>
    </div>
</div>

<!--- JS scripts --->

</body>
</html>


<?php

    include "../authorization/check.php";

    $advert_id = $_GET['advert_id'];

?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Advert page</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="all">

</head>

<body>

<?php include "../../header.php" ?>

<div class="content">
    <div class="mid">
        <div class="advert">
            <h1>Information:</h1>
            <?php include 'advertpage_info.php';?>
        </div>
    </div>
</div> <div class="clear"></div>

<div class="comment">
    <h4>Comments:</h4>
    <hr>
    <?php

        include 'comment.php';

    $user_id = $_SESSION['id'];

    if ($isLogin == true){
        echo "<form name='comment' action='add_comment.php' method='post'>
                  <p>
                    <label>Comment:</label>
                    <br />
                    <textarea name='text_comment' cols='60' rows='5'></textarea>
                  </p>
                  <p>
                    <input type='hidden' name='Ad_id' value='$advert_id'>
                    <input type='hidden' name='User_id' value='$user_id' />
                    <input type='submit' value='Add' >
                  </p>
                </form>";
    }

    ?>
</div> <div class="clear"></div>

</body>
</html>


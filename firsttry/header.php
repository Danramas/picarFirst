<?php

    session_start();

    $isLogin = false;
    $isAdmin = false;

    if ($_SESSION['name'] !== NULL){
        $isLogin = true;
    }
    if ($_SESSION['admin'] !== NULL){
        $isAdmin = true;
    }

?>

<div class="header">
    <div class="mid">
        <header>
            <div class="topmenu">
                <div class="window">
                    <?php include "authorization.php";?>
                </div>
            </div>
            <h1>PICAR</h1>
            <a href="/index.php"><img src="/img/logo.jpg" alt="Logotip" title="Logotip"></a>
        </header>
    </div> <div class="clear"></div>
</div>
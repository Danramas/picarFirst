<?php

    session_start();
    
    $_SESSION['name'] = NULL;
    $_SESSION['admin'] = NULL;
    
    header('Location: /index.php');
    

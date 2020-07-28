<?php

    if ($isLogin == false){
        echo "<a href='/php/authorization/login_form.php'>Login</a>";
        } else {
        print "Hello, " .$_SESSION['name'];
        if ($isAdmin == true){
            print " (Admin)";
            echo "<a href='/php/admin/admin_panel.php'>Admin Panel</a>";
            } else {
            echo "<a href='/php/user/user_account.php'>Account</a>";
            }
            echo "<a href='/php/authorization/logout.php'>Logout</a>";
    }

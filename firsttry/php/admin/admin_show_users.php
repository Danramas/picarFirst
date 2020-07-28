<?php

include "../../db_connect.php";

$user_show = mysqli_query($link, "SELECT id, login, email, password, isDeleted, isAdmin 
                                      FROM User");

while ($data = mysqli_fetch_assoc($user_show)){
    echo "<table>
                <tr>
                    <td>Id: {$data['id']}</td> 
                </tr>                
                <tr>    
                    <td>Login: {$data['login']}</td>
                </tr>
                <tr>
                    <td>Email: {$data['email']}</td>
                </tr>
                <tr>
                    <td>Password: {$data['password']}</td>
                </tr>";
                    if ($data['isDeleted'] == NULL){
                        echo "<tr><td>Deleted: None </td></tr>";
                    } else {
                        echo "<tr><td>Deleted: $data[isDeleted]</td></tr>";
                    }
                    if ($data['isAdmin'] == NULL){
                        echo "<tr><td>Status: User </td></tr>";
                    } else {
                        echo "<tr><td>Status: Admin </td></tr>";
                    }
                    echo "<tr><td><form class='delete_form' action='admin_delete_user.php' method='post'>
                             <input type='hidden' name='user_id' value='$data[id]'>   
                             <input type='submit' name='submit' class='submit' value='Delete or restore'>
                          </form>";
                echo "</td></tr>
        </table>";

}


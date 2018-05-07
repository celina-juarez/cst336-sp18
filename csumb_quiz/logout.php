<?php 
    session_start();
    session_destroy();
    echo "You have successfully logged out. Want to Log back in click -> <a href = 'login.php'> here </a>";
?>
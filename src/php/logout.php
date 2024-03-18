<?php

SESSION_START();

if (isset ($_SESSION['login_user'])) {
    session_destroy();
    header("location:index.php");
} else {
    header("location:index.php");
}


?>
<?php
    if(!isset($_SESSION['username'])){ # kas sessiooni muutuja on määratu
        header("Location: login.php"); # suuna login lehele
    }
?>
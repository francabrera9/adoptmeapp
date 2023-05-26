<?php
session_start();
session_destroy();
#Redirecciona al login
header('Location: login.php');
?>
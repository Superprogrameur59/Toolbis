<?php

session_start();

unset($_SESSION['auth']);

$_SESSION['success'] = "Vous vous êtes déconnecté";

header('Location: login.php');

?>
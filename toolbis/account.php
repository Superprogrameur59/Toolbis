<?php 

require_once 'functions.php';

session_start();

only_logged();

require_once 'menus.php' ?>

    <h1>Votre compte</h1>

    <?php debug($_SESSION); ?>
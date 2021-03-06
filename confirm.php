<?php
$user_id = $_GET['id'];

$token = $_GET['token'];

require 'db.php';

$req = $pdo->prepare('SELECT * FROM users WHERE id =?');

$req->execute([$user_id]);

$user = $req->fetch();

session_start();


if($user && $user->confirmation_token == $token){
    
    $_SESSION['success'] = " Votre compte a bien été validé ";    
    
    $req = $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?');
    
    $req->execute([$user_id]);
    
    $_SESSION['auth'] = $user;
    
    header('Location: account.php');
    
    
}
else{
    
    $_SESSION['error'] = " Ce token n'est plus valide";
    
    header('Location: login.php');
}

?>
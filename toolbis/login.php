<br>
<br>
<br>
<br>
<?php 
require_once 'functions.php';

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    
    require_once 'db.php';      
    
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    
    $req->execute(['username' => $_POST['username']]);
    
    $user = $req->fetch();
    
    if(password_verify($_POST['password'], $user->password)){
        
        session_start();
        
        $_SESSION['auth'] = $user ;
        
        $_SESSION['success'] = " Vous êtes connecté";
        
        header('Location: account.php');
        
        exit();
    }
       else{
           
           $_SESSION['error'] = " Identifiants incorrects";
       }
    
    
}



require_once 'menus.php'; ?>

    <h1>Se connecter</h1>

    <form action="" method="POST">

        <label> Pseudo / Email</label>
        <br>
        <input type="text" name="username" />
        <br>

        <label> Mot de passe</label>
        <br>
        <input type="password" name="password" />
        <br>

        <button type="submit"> Se connecter </button>

    </form>


    <?php debug($_SESSION); ?>
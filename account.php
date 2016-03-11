<?php 

require_once 'functions.php';

session_start();

only_logged();

if(!empty($_POST)){
    
    if($_POST['password'] != $_POST['password_confirm']){
        
        $_SESSION['error'] = " Les mots de passe ne sont pas identiques.";
    }else{
        $user_id = $_SESSION['auth']->id;
        
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        require_once 'db.php';
        
        $req = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        
        $req->execute([$password, $user_id]);
        
        $_SESSION['succes'] = " Le mot de passe a bien été mis a jour";
    }
}

require_once 'menus.php' ?>

    <div id="conteneur">
        <h1>Bonjour <?php echo $_SESSION['auth']->username; ?></h1>

        <form action="" method="post">
            <input type="password" name="password" placeholder="Changer de mot de passe" />
            <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" />
            <button>Changer le mot de passe</button>
        </form>

        <?php debug($_SESSION); ?>
    </div>
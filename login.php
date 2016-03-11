<?php 
require_once 'functions.php';

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    
    $errors = array();
    
    require_once 'db.php';      
    
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    
    $req->execute(['username' => $_POST['username']]);
    
    $user = $req->fetch();
    
    if($user && password_verify($_POST['password'], $user->password)){
        
        session_start();
        
        $_SESSION['auth'] = $user ;
        
        $_SESSION['success'] = " Vous êtes connecté";
        
        header('Location: account.php');
        
        exit();
    }
       else{
           
          $errors['authentification'] = " Identifiants incorrects";
       }
    
    
}
else {
    $errors['authentification'] = " Tous les champs n'ont pas été remplis";
}

require_once 'menus.php'; ?>

    <div id="conteneur">

        <h1>Se connecter</h1>

        <?php if(!empty($errors)): ?>

            <p style=" color : red;">Le formulaire de connexion a mal été rempli :</p>

            <?php foreach($errors as $error):?>

                <?php echo '- ' .$error; ?>
                    <br>

                    <?php endforeach; ?>
                        <br>
                        <?php endif; ?>

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
    </div>
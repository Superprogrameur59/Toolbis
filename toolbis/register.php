<?php require_once 'functions.php ';
    require_once 'db.php';
    session_start();



    if(!empty($_POST)){
        $errors = array();
        
        if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['username'])){
            $errors['username'] = "Pseudo invalide (alphanumérique)";
        } else{
            
            $req = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            
            $req->execute([$_POST['username']]);
            
            $user = $req->fetch();
            
            if($user){
                
                $errors['username'] = "Ce pseudo est déjà utilisé";
            }
        }
        
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            
            $errors['email'] = "Email invalide";
        }else{
            
            $req = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            
            $req->execute([$_POST['email']]);
            
            $user = $req->fetch();
            
            if($user){
                
                $errors['email'] = "Cet email est déjà utilisé";
            }
        }
        
        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_comfirm']){
             $errors['password'] = "Mot de passe invalide";
        }
        
        if(empty($errors)){
            
        
            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
            
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            $token = str_random(60);
            
            $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
            
            $user_id = $pdo->lastInsertId();
            
            mail($_POST['email'], 'Confirmation de compte', "Merci de copier coller ce lien dans votre navigateur afin de confirmer votre compte \n\n http://localhost/tests/toolbis/confirm.php?id=$user_id&token=$token");
            
            $_SESSION['success'] = " Un email vous a été envoyé pour confirmer votre inscription";
            
            header('Location: login.php');
            
            exit();
        
        }
        
    }  

    
    ?>

    <?php require 'menus.php' ?>


        <h1> S'inscrire </h1>

        <?php if(!empty($errors)): ?>

            <p style=" color : red;">Le formulaire a mal été rempli :</p>

            <?php foreach($errors as $error):?>

                <?php echo '- ' .$error; ?>
                    <br>

                    <?php endforeach; ?>
                        <br>
                        <?php endif; ?>

                            <form action="" method="POST">

                                <label> Pseudo</label>
                                <br>
                                <input type="text" name="username" />
                                <br>

                                <label> Email</label>
                                <br>
                                <input type="text" name="email" />
                                <br>

                                <label> Mot de passe</label>
                                <br>
                                <input type="password" name="password" />
                                <br>

                                <label> Confirmation mot de passe</label>
                                <br>
                                <input type="password" name="password_comfirm" />
                                <br>

                                <button type="submit"> M'inscrire </button>

                            </form>
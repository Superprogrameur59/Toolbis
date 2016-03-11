<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
 ?>

    <!DOCTYPE html>

    <meta charset="utf-8">

    <link rel="stylesheet" href="accueil.css" />

    <div id="header">

        <ul>
            <?php if(isset($_SESSION['auth'])): ?>

                <a href="accueil.php"><img class="logo" src="logo.png" alt="logo" style="border-radius : 25px; width:50px; height : 50px; margin-top :-12px; margin-left: 200px;"> </a>

                <li> <a href="logout.php">Se déconnecter</a></li>

                <?php else: ?>

                    <a href="accueil.php"><img class="logo" src="logo.png" alt="logo" style="border-radius : 25px; width:50px; height : 50px; margin-top :-12px; margin-left: 200px;"> </a>

                    <ul style="margin-left: 700px; list-style-type:none;">

                        <li> <a href="annonces.php">Voir les annonces</a> </li>
                        <li> <a href="propos">A propos</a> </li>
                        <li style=" color : #BDBDBD;"> | </li>
                        <li> <a class="nav-login" href="login.php">Se connecter</a> </li>
                        <li> <a class="nav-login" href="register.php">S'inscrire </a></li>

                    </ul>
                    <?php endif; ?>

        </ul>

    </div>



    <?php if(isset($_SESSION['error'])){
        
            echo $_SESSION['error'] ;
    
            unset($_SESSION['error']);
}

if(isset($_SESSION['success'])){
        
            echo $_SESSION['success'] ;
    
            unset($_SESSION['success']);
}

?>
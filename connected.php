<?php
    session_start();
?>

<html>
    <head>
        <title>Login/Logout</title>
    </head>
    <body>
        <?php
        if($_SESSION["name"]) {
        ?>
        Bienvenue <?php echo $_SESSION["name"]; ?>. Cliquer ici pour vous <a href="logout.php" tite="Logout">Déconnecter.
        <?php
        }else echo "<h1>Veuiller vous connecter.</h1>";
        ?>
    </body>
</html>
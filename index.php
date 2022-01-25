<?php
    session_start();
    $message="";
    if(count($_POST)>0) {
        include_once "database.php";
        $result = mysqli_query($con,"SELECT * FROM users WHERE username='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        } else {
         $message = "Nom d'utilisateur ou mot de passe invalide!";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:connected.php");
    }
?>

<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form name="frmUser" method="post" action="" align="center">
            <div class="message"><?php if($message!="") { echo $message; } ?></div>
            <h3 align="center">Entrez vos information d'utilisateur</h3>
            Nom d'utilisateur:<br><input type="text" name="username">
            <br />
            Mot de passe:<br><input type="password" name="password">
            <br /><br />
            <input type="submit" name="submit">
            <input type="reset">
        </form>
    </body>
</html>
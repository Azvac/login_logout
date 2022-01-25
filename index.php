<?php
    session_start();
    $message = "";
    if( count( $_POST ) > 0 ) {

        // Récupération des information d'utilisateur
        $user_name = htmlspecialchars( $_POST[ "username" ] );
        $user_password = htmlspecialchars( $_POST[ "password" ] );

        // Connection a la base de données
        include_once "database.php";
        $result = mysqli_query( $con, "SELECT * FROM users WHERE username='" . $user_name ."'" );
        $row  = mysqli_fetch_array( $result );

        // Vérifie si l'utilisateur existe
        if( is_array( $row ) ) {
            // Vérification du mot de passe hasher
            if ( password_verify( $user_password, $row[ 'password' ] ) ) {

                $_SESSION[ "id" ] = $row[ 'id' ];
                $_SESSION[ "name" ] = $row[ 'name' ];

            } else {
                $message = "Nom d'utilisateur ou mot de passe invalide!";
            }
        } else {
            $message = "Nom d'utilisateur ou mot de passe invalide!";
        }
    }
    // Redirection
    if( isset( $_SESSION[ "id" ] ) ) {
        header( "Location:connected.php" );
    }
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form name="frmUser" method="post" action="" align="center">
            <div class="message"><?php if( $message != "" ) { echo $message; } ?></div>
            <h3 align="center">Entrez vos information d'utilisateur</h3>

            Nom d'utilisateur :<br><input type="text" name="username"><br />
            Mot de passe :<br><input type="password" name="password"><br />
            
            <br />
            <input type="submit">
            <input type="reset">
        </form>
    </body>
</html>
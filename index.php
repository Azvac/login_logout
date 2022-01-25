<?php
    session_start();
    $message = "";
    if( count( $_POST ) > 0 ) {

        // Récupération des information d'utilisateur
        $user_name = htmlspecialchars( $_POST[ "username" ] );
        $user_password = htmlspecialchars( $_POST[ "password" ] );
        $capchaToken = htmlspecialchars( $_POST[ "g-recaptcha-response" ] );

        // Connection a la base de données
        include_once "database.php";
        $result = mysqli_query( $con, "SELECT * FROM users WHERE username='" . $user_name ."'" );
        $row  = mysqli_fetch_array( $result );

        // Vérifie si l'utilisateur existe
        if( is_array( $row ) ) {
        
            // Vérifier le capcha
            $result = json_decode( file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret=6LcVBjgeAAAAAGWhgCm_gS0XFqNd9xdV5OE1QFXN&response=$capchaToken" ) );

            if ($result->success){
                // Vérification du mot de passe hasher
                if ( password_verify( $user_password, $row[ 'password' ] ) ) {

                    $_SESSION[ "id" ] = $row[ 'id' ];
                    $_SESSION[ "name" ] = $row[ 'name' ];

                } else {
                    $message = "Nom d'utilisateur ou mot de passe invalide!";
                }
            } else{
                $message = "Capcha invalide";
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
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
        <form name="frmUser" method="post" action="" align="center">
            <div class="message"><?php if( $message != "" ) { echo $message; } ?></div>
            <h3 align="center">Entrez vos information d'utilisateur</h3>

            Nom d'utilisateur :<br><input type="text" name="username"><br />
            Mot de passe :<br><input type="password" name="password"><br />
            
            <br />
            <div class="g-recaptcha" data-sitekey="6LcVBjgeAAAAAI2CPlX3Tqx6q4LbsBpmsiDCh4X3" align="center"></div>
            <br />
            <input type="submit">
            <input type="reset">
        </form>
    </body>
</html>
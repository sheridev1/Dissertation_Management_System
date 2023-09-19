<?php
session_start();
if ( isset( $_SESSION[ 'name' ] ) ) {
    if ( $_SESSION[ 'name' ] == 'admin' ) {
        header( 'Location: admin/admin.php' );
    } else {
        header( 'Location: user/userlogin.php' );
    }
}
?>

<?php
if ( isset( $_POST[ 'username' ] ) ) {

    $us = $_POST[ 'username' ];
    $pas = $_POST[ 'password' ];
    include 'connection.php';
    $sql = "select * from  `student` where  username='" . $us . "' and pass ='" . md5( $pas ) . "'";
    $result = $con->query( $sql );

    if ( $result->num_rows > 0 ) {

        // output data of each row
        while ( $row = $result->fetch_assoc() ) {
            if ( $row[ 'approve' ] == 0 ) {
                $error = 'User is not approved yet!';
                $kusername = $_POST[ 'username' ];
            } else if ( $row[ 'active' ] == 0 ) {
                $error = 'User is no longer active!';
                $kusername = $_POST[ 'username' ];
            } else {
                $_SESSION[ 'name' ] = $us;
                $_SESSION[ 'fullname' ] = $row[ 'fname' ] . ' ' . $row[ 'lname' ];
                $_SESSION[ 'id' ] = $row[ 'id' ];
                $_SESSION[ 'img' ] = $row[ 'img' ];
                $_SESSION[ 'university' ] = $row[ 'university' ];
                header( 'Location: user/userlogin.php' );
                exit();
            }
        }
    } else {

        $us = $_POST[ 'username' ];
        $pas = $_POST[ 'password' ];
        include 'connection.php';
        $sql = "select * from  `admin` where  username='" . $us . "' and pass ='" . md5( $pas ) . "'";
        $result = $con->query( $sql );

        if ( $result->num_rows > 0 ) {
            $_SESSION[ 'name' ] = $us;

            header( 'Location: admin/admin.php' );
            exit();
        } else {

            $sql = "select * from `supervisor` where  username='" . $us . "' and pass ='" . md5( $pas ) . "'";
            $result = $con->query( $sql ) or die( $con->error );

            if ( $result->num_rows > 0 ) {

                // output data of each row
                while ( $row = $result->fetch_assoc() ) {
                    if ( $row[ 'approve' ] == 0 ) {
                        $error = 'User is not approved yet!';
                        $kusername = $_POST[ 'username' ];
                    } else if ( $row[ 'active' ] == 0 ) {
                        $error = 'User is no longer active!';
                        $kusername = $_POST[ 'username' ];
                    } else {
                        $_SESSION[ 'name' ] = $us;
                        $_SESSION[ 'fullname' ] = $row[ 'fname' ] . ' ' . $row[ 'lname' ];
                        $_SESSION[ 'id' ] = $row[ 'id' ];
                        $_SESSION[ 'img' ] = $row[ 'img' ];
                        $_SESSION[ 'university' ] = $row[ 'university' ];
                        $_SESSION[ 'isSupervisor' ] = true;
                        header( 'Location: supervisor/userlogin.php' );
                        exit();
                    }
                }
            } else {

                $error = 'Username or password is incorrect!';
                $kusername = $_POST[ 'username' ];

            }
        }
    }
}

include 'header.php';
?>
<div id = 'titlebar' class = 'gradient'>
<div class = 'container'>
<div class = 'row'>
<div class = 'col-md-12'>

<h2>Log In</h2>

<!-- Breadcrumbs -->
<nav id = 'breadcrumbs' class = 'dark'>
<ul>
<li><a href = '/'>Home</a></li>
<li>Log In</li>
</ul>
</nav>

</div>
</div>
</div>
</div>

<div class = 'container'>
<div class = 'row'>
<div class = 'col-xl-5 offset-xl-3'>

<div class = 'login-register-page'>
<!-- Welcome Text -->
<div class = 'welcome-text'>
<h3>We're glad to see you again!</h3>
                    <span>Don't have an account? <a href = '/register.php'>Sign Up!</a></span>
</div>

<!-- Form -->
<form method = 'post' id = 'login-form'><?php if ( isset( $error ) )

echo   '<div class="notification error closeable">
                        <p>'.$error.'</p>
                        <a class="close" href="#"></a>
                    </div>';
?>
<div class = 'input-with-icon-left'>
<i class = 'icon-feather-user'></i>
<input type = 'text' class = 'input-text with-border' name = 'username' id = 'username'
placeholder = 'Username' required />
</div>

<div class = 'input-with-icon-left'>
<i class = 'icon-material-outline-lock'></i>
<input type = 'password' class = 'input-text with-border' name = 'password' id = 'password'
placeholder = 'Password' required />
</div>

<button class = 'button full-width button-sliding-icon ripple-effect margin-top-10' type = 'submit'
form = 'login-form'>Log In <i class = 'icon-material-outline-arrow-right-alt'></i></button>

</form>

</div>

</div>
</div>
</div>

<?php
include 'footer.php';
?>
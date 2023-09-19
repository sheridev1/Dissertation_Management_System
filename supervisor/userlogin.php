<?php
include 'sessions.php';

?>

<?php
if ( isset( $_POST[ 'username' ] ) ) {
    $us = $_POST[ 'username' ];
    $pas = $_POST[ 'password' ];
    include 'connection.php';
    $sql = "select * from  `student` where  username='".$us."' and pass ='".$pas."'";
    $result = $con->query( $sql );

    if ( $result->num_rows > 0 ) {

        // output data of each row
        while( $row = $result->fetch_assoc() ) {
            if ( $row[ 'username' ] == $us && $row[ 'pass' ] == $pas ) {
                if ( $row[ 'approve' ] == 0 ) {
                    $error = 'User is not approved yet!';
                    $kusername = $_POST[ 'username' ];
                } else if ( $row[ 'active' ] == 0 ) {
                    $error = 'User is no longer active!';
                    $kusername = $_POST[ 'username' ];
                } else {
                    $_SESSION[ 'name' ] = $username;
                    header( 'Location: userlogin.php' );
                    exit();

                }

            } else {
                $error = 'Username or password is incorrect!';
                $kusername = $_POST[ 'username' ];

            }

        }
    }

}

?>
<?php
include 'header.php';
?>
<?php
include '../connection.php';

$result1 = $con->query( 'SELECT COUNT(*) AS count FROM `projects` WHERE supervisor='.$_SESSION[ 'id' ].'' );

$result2=$con->query( 'SELECT COUNT(*) AS count FROM `members` WHERE fullname='.$_SESSION[ 'id' ].'' ); 
$projects = $result1->fetch_assoc()[ 'count' ]+ $result2->fetch_assoc()[ 'count' ];

$masseges = ( $result = $con->query( 'SELECT COUNT(*) AS message_count FROM message WHERE reciever_id = '.$_SESSION[ 'id' ].' AND reciever_is_teacher = 1' ) ) ? $result->fetch_assoc()[ 'message_count' ] : 'Error executing query: ' . $con->error;
?>

<div class = 'dashboard-headline'>
<h3>Hello,
<?php echo $_SESSION[ 'name' ];
?>
</h3>
<span>We are glad to see you again!</span>

<!-- Breadcrumbs -->
<nav id = 'breadcrumbs' class = 'dark'>
<ul>
<li><a href = '/'>Home</a></li>
<li>Dashboard</li>
</ul>
</nav>
</div>
<div class = 'fun-facts-container'>
    <div class = 'fun-fact' data-fun-fact-color = '#b81b7f'>
        <div class = 'fun-fact-text'>
            <span>Projects</span>
                <h4><?php echo $projects;?></h4>
        </div>
            <div class = 'fun-fact-icon'><i class = 'icon-material-outline-business-center'></i></div>
   
</div>
<div class = 'fun-fact' data-fun-fact-color = '#efa80f'>
        <div class = 'fun-fact-text'>
            <span>Messages</span>
                <h4><?php echo $masseges;?></h4>
        </div>
        <div class = 'fun-fact-icon'><i class = 'icon-material-outline-rate-review'></i></div>
</div>
<?php

include 'footer.php';
?>
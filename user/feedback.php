<?php
include '../connection.php';
include( 'sessions.php' );
$feedback = $_POST[ 'feedback' ];
$reply = $_POST[ 'reply' ];
$progress = $_POST['progress'];
$pid = $_POST[ 'p_id' ];
$action= $_POST[ 'action' ];
if($feedback){
mysqli_query( $con, "insert into `project_history` (`p_id`,`feedback`) values('$pid','$feedback')" )or die( mysqli_error() );}else{
mysqli_query( $con, "insert into `project_history`(`p_id`,`reply`) values('$pid','$reply')" )or die( mysqli_error() );

mysqli_query( $con, "UPDATE `projects`  SET `progress` ='$progress' where `pid` = '$pid'" )or die( mysqli_error() );
}
header("Location: /user/viewprojects.php");?>
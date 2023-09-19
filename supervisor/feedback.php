<?php
include '../connection.php';
include( 'sessions.php' );
$feedback = $_POST[ 'feedback' ];
$pid = $_POST[ 'p_id' ];
$action= $_POST[ 'action' ];
mysqli_query( $con, "insert into `project_history` (`p_id`,`feedback`,`status`) values('$pid','$feedback','$action')" )or die( mysqli_error() );
if($action ==1){
mysqli_query( $con, "UPDATE `projects`  SET `approve` = 1 where `pid` = '$pid'" )or die( mysqli_error() );}
header("Location: /supervisor/pending.php");
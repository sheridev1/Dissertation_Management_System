<?php include( 'sessions.php' );
?>
<?php
include 'header.php';
?>

<?php
$query_announcement = mysqli_query( $con, 'select * from message_sent LEFT JOIN student ON student.id = message_sent.reciever_id where  sender_id =' . $_SESSION[ 'id' ] . ' order by date_sended DESC ' ) or die( mysqli_error() );
$count_my_message = mysqli_num_rows( $query_announcement );

?>
<!-- Dashboard Headline -->
<div class = 'dashboard-headline'>
<h3>My Messages</h3>

<!-- Breadcrumbs -->
<nav id = 'breadcrumbs' class = 'dark'>
<ul>
<li><a href = '/'>Home</a></li>
<li><a href = '/user/userlogin.php'>Dashboard</a></li>
<li>Messages sent</li>
</ul>
</nav>
</div>

<!-- Row -->
<div class = 'row'>

<!-- Dashboard Box -->
<div class = 'col-xl-12'>
<div class = 'dashboard-box margin-top-0'>

<!-- Headline -->
<div class = 'headline'>
<h3><i class = 'icon-material-outline-business-center'></i> My Message</h3>
</div>

<div class = 'content'>
<ul class = 'dashboard-box-list'>

<?php
if ( $count_my_message != '0' ) {
    while( $row = mysqli_fetch_array( $query_announcement ) ) {

        $id = $row[ 'message_sent_id' ];
        $recieveristeacher = $row[ 'reciever_is_teacher' ];
        ?>

        <li>
        <!-- Job Listing -->
        <div class = 'job-listing'>

        <!-- Job Listing Details -->
        <div class = 'job-listing-details'>

        <!-- Details -->
        <div class = 'job-listing-description'>
        <h3 class = 'job-listing-title'><a href = ''>
        <?php echo $row[ 'reciever_name' ] ?>
        </a>
        <?php if ( $recieveristeacher == 1 ) {
            echo '<span class="dashboard-status-button green">Supervisor</span>';
        } else {
            echo '<span class="dashboard-status-button green">Student</span>';
        }
        ?>
        </h3>

        <!-- Job Listing Footer -->
        <div class = 'job-listing-footer'>
        <ul>
        <li><i class = 'icon-feather-calendar'></i>
        <?php echo $row[ 'date_sended' ] ?>
        </li>
        </ul>
        <p><?php echo $row[ 'content' ] ?></p>
        </div>
        </div>
        </div>
        </div>

        <!-- Buttons -->
        <div class = 'buttons-to-right always-visible'>
        <a onClick = "getConfirmation(<?php echo $id; ?>);"

        class = 'button red ripple-effect ico' title = 'Remove' data-tippy-placement = 'top'>
        <i class = 'icon-feather-trash-2'></i>
        </a>
        </div>
        </li>
        <?php }
    }
    ?>

    </ul>
    </div>
    </div>
    </div>

    </div>
    <script type = 'text/javascript'>

    function getConfirmation( getId ) {
        var retVal = confirm( 'Do you want to Delete the message ?' );
        if ( retVal == true ) {

            var id = getId;
            $.ajax( {
                type: 'POST',
                url: 'remove_sent_message.php',
                data: ( {
                    id: id }
                ),
                cache: false,
                success: function ( html ) {
                    location.reload();

                }
            }
        );

    } else {

        return false;
    }
}

</script>
<?php
include 'footer.php';
?>
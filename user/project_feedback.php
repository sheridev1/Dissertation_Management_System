<?php
include( 'sessions.php' );
include 'header.php';
$query_announcement = mysqli_query( $con, 'select * from project_history  where p_id = '.$_POST['p_id'].' order by id DESC ' ) or die( mysqli_error() );
$count_my_message = mysqli_num_rows( $query_announcement );
$prog =   mysqli_query( $con, "select progress from projects where pid = ".$_POST['p_id']) or die( mysqli_error() );
$progress = mysqli_fetch_assoc( $prog );
?>
<style>
    .sexy{
        padding:10px;
    }
</style>
<!-- Dashboard Headline -->
<div class = 'dashboard-headline'>
<h3>Project FeedBack</h3>

<!-- Breadcrumbs -->
<nav id = 'breadcrumbs' class = 'dark'>
<ul>
<li><a href = '/'>Home</a></li>
<li><a href = '/user/userlogin.php'>Dashboard</a></li>
<li>Project FeedBack</li>
</ul>
</nav>
</div>

<!-- Row -->
<div class = 'row'>

<!-- Dashboard Box -->
<div class = 'col-xl-6'>
<div class = 'dashboard-box margin-top-0'>

<!-- Headline -->
<div class = 'headline'>
<h3><i class = 'icon-material-outline-business-center'></i>Project FeedBack</h3>
</div>

<div class = 'content '>
<ul class = 'dashboard-box-list'>

<?php
if ( $count_my_message != '0' ) {
    while( $row = mysqli_fetch_array( $query_announcement ) ) {

        $feedback = $row[ 'feedback' ];
        $reply = $row[ 'reply' ];
        ?>

        <li>
        <!-- Job Listing -->
        <div class = 'job-listing '>

        <!-- Job Listing Details -->
        <div class = 'job-listing-details'>

        <!-- Details -->
        <div class = 'job-listing-description'>
        <h3 class = 'job-listing-title'><a href = ''>
        <?php if($feedback) echo ('FeedBack'); else{ echo('Reply');} ?>
        </a>
        <?php if ( $feedback  ) {
            echo '<span class="dashboard-status-button green">Supervisor</span>';
        } else {
            echo '<span class="dashboard-status-button green">Student</span>';
        }
        ?>
        <?php if (  $row['status'] == 0 ) {
            echo '<span class="dashboard-status-button red">Rejected</span>';
        } elseif (  $row['status'] == 1 ) {
            echo '<span class="dashboard-status-button green">Approved</span>';
        }
        ?>
        </h3>

        <!-- Job Listing Footer -->
        <div class = 'job-listing-footer'>
        <p>
        <?php if($feedback) echo ($feedback); else{ echo($reply);} ?></p>
        </div>
        </div>
        </div>
        </div>


        </li>
        <?php }
    }
    ?>

    </ul>
    </div>
    </div>
    </div>
    <!-- End Dashboard Box -->
    <div class = 'col-xl-6'>
<div class = 'dashboard-box margin-top-0'>

<!-- Headline -->
<div class = 'headline'>
<h3><i class = 'icon-material-outline-business-center'></i>Action</h3>
</div>


<div class = 'content '>
    <form method="post" class='sexy' action='/user/feedback.php' id="super_message">
        
            <div class="col-xl-12">
                <div class="submit-field">
                    <h5>FeedBack</h5>
                    <input name='p_id' type='hidden' value='<?php echo $_POST['p_id'];?>'> 
                    <textarea class="with-border" name="reply" rows="4"></textarea>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="submit-field">
                    <h5>FeedBack </h5>
                          <input class="range-slider-single" type="text" name='progress' data-slider-min="0" data-slider-max="100" data-slider-step="10" data-slider-value="<?php echo($progress['progress']);?>">

                </div>
            </div>
            <div class="col-xl-12">

                <button type="submit" style='color:white' name="submit"
                    class="button ripple-effect big">Send </button>
        </form>
        </div>
        </div>
        </div>

    </div>

    </div>

<?php
include 'footer.php';
?>
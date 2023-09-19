<?php
include 'header.php';
include 'connection.php';
$sql = 'SELECT * FROM supervisor';
$result = $con->query( $sql );
?>
<style>
@media ( min-width: 1200px ) {
    .myclass {
        max-width: 22%;
    }

    .myclass {
        margin: 1%;
    }
}
</style>
<section class = 'py-5'>
<div class = 'container'>
<div class = 'row gx-4 align-items-center justify-content-between'>
<div class = 'col-md-5 '>
<div class = 'mt-5 mt-md-0'>
<span class = 'text-muted'><b>Our Story</b></span>
<h1 class = 'display-5 ' style = 'padding: 10px 0 10px 0px;'>About Us</h1>
<p class = 'lead'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
ullamco laboris .</p>
<p class = 'lead'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
incididunt.</p>
</div>
</div>
<div class = 'col-md-6 offset-md-1 order-1 order-md-2'>
<div class = 'row gx-2 gx-lg-3'>
<div class = 'col-6'>
<img class = 'img-fluid rounded-3'
src = 'https://th.bing.com/th/id/R.30194e24f83e6de17913aab6c91e64f6?rik=8eucKitbF9ZfTA&pid=ImgRaw&r=0'>
</div>
</div>
</div>
</div>
</div>
</section>
<div class = 'freelancers-container freelancers-grid-layout margin-top-35'>
<?php if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        ?>
        <div class = 'freelancer myclass'>

        <!-- Overview -->
        <div class = 'freelancer-overview'>
        <div class = 'freelancer-overview-inner'>

        <!-- Avatar -->
        <div class = 'freelancer-avatar'>
        <div class = 'verified-badge'></div>
        <a href = 'single-freelancer-profile.html'><img src = "<?php if($row['img']){ echo $row['img'];}else{echo 'images/user-avatar-big-02.jpg';}?>" alt = ''></a>
        </div>

        <!-- Name -->
        <div class = 'freelancer-name'>
        <h4><a><?php echo $row[ 'fname' ].$row[ 'lname' ]?></a></h4>
        <span>Supervisor</span>
        </div>

        </div>
        </div>

        <!-- Details -->
        <div class = 'freelancer-details'>
        <div class = 'freelancer-details-list ' style = 'text-align:center'>
        <ul>
        <li>Email <strong><i class = 'icon-material-outline-location-on'></i> <?php echo $row[ 'email' ]?></strong></li>
        </ul>
        </div>
        </div>
        </div>
        <?php }
    }?>

    </div>

    <?php
    include 'footer.php';
    ?>
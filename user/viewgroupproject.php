<?php
include 'sessions.php';
if(isset($_POST['usdel'])){
  $us= $_POST['usdel'];
$sql = "delete from `projects` where  pid=".$us." ";
if($con->query($sql)==true){
  $usr = $_POST['usr'];
  $prnm = $_POST['prnm'];

$sql = "select * from images where usprj='".$usr.'_'.$prnm."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    unlink('../projects/'.$usr.'_'.$prnm.'_'.$row['src']);
  }}
$sql = "delete from images where usprj='".$usr.'_'.$prnm."'";
$con->query($sql);
$sql = "delete from members where pid=".$us;
$con->query($sql);
if($_POST['prfl']!='')
unlink('../projectFiles/'.$_POST['prfl']);
header("Refresh:0");
};

}


//Custom code
$group_project_ids = $con->prepare("SELECT * FROM `members` WHERE fullname = ?");
$group_project_ids->bind_param("s", $_SESSION['id']);
$group_project_ids->execute();
// Check for query execution errors.
if ($group_project_ids === false) {
    die("Error executing the first query: " . $con->error);
}
$group_project_ids_result = $group_project_ids->get_result();
// Use prepared statements for the second query.
$group_project = $con->prepare("SELECT * FROM `projects` WHERE pid = ? ORDER BY status DESC");
$group_project->bind_param("i", $group_project_id);

//Custom code

$result = $con->query("SELECT * FROM `projects` where studentid=".$_SESSION['id'].' order by status desc');
include 'header.php';
?>


<!-- Dashboard Headline -->
<div class="dashboard-headline">
  <h3>Group Projects</h3>
	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/supervisor/userlogin.php">Dashboard</a></li>
			<li>Manage Group Projects</li>
			</ul>
	</nav>
</div>


<!-- Row -->
<div class="row">

<!-- Dashboard Box -->
<div class="col-xl-12">
    <div class="dashboard-box margin-top-0">

        <!-- Headline -->
        <div class="headline">
            <h3><i class="icon-material-outline-business-center"></i>Group Listings</h3>
        </div>

        <div class="content">
            <ul class="dashboard-box-list">
            <?php
                          while ($row = $group_project_ids_result->fetch_assoc()) {
                            $group_project_id = $row['pid'];
                            $group_project->execute();
                            // Check for query execution errors.
                            if ($group_project === false) {
                                die("Error executing the second query: " . $con->error);
                            }
                            $group_project_result = $group_project->get_result();
                            $row = $group_project_result->fetch_assoc();
             ?>
                <li>
                    <!-- Job Listing -->
                    <div class="job-listing">

                        <!-- Job Listing Details -->
                        <div class="job-listing-details">

                            <!-- Details -->
                            <div class="job-listing-description">
                                <h3 class="job-listing-title"><a href=""><?php echo $row['title'] ?></a>      <?php   if($row['approve']==1){   echo '<span class="dashboard-status-button green">Approved</span>';}else {echo '<span class="dashboard-status-button red">Not Approved</span>';} ?></h3>
                                    <span class = 'icon-material-outline-check-circle'>
    <?php echo $row[ 'progress' ].'% Completed' ?>
    </span></h3>

                                <!-- Job Listing Footer -->
                                <div class="job-listing-footer">
                                    <ul>
                                        <li><i class="icon-line-awesome-user-secret"></i><?php echo $row['supervisor'] ?></li>
                                        <li><i class="icon-line-awesome-black-tie"></i><?php echo $row['discipline'] ?></li>
                                        <li><i class="icon-line-awesome-area-chart"></i><?php echo $row['area'] ?></li>
                                    </ul>
                                </div>
                                <!-- Buttons -->
    <div class = 'buttons-to-right always-visible'>
    <a onclick = "view(<?php echo $row['pid']; ?>)" class = 'button ripple-effect' style = 'color:white' class = 'btn-default'><i class = 'icon-material-outline-supervisor-account'></i>View</a>
    </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php }?>

            </ul>
        </div>
    </div>
</div>

</div>
<!-- Row / End -->
<script>
        function view( pid ) {
        var form = document.createElement( 'form' );
        form.method = 'post';
        form.action = 'viewprjuser.php';

        var prjidInput = document.createElement( 'input' );
        prjidInput.type = 'hidden';
        prjidInput.name = 'prjid';
        prjidInput.value = pid;

        var fromprjInput = document.createElement( 'input' );
        fromprjInput.type = 'hidden';
        fromprjInput.name = 'fromprj';
        fromprjInput.value = pid;

        form.appendChild( prjidInput );
        form.appendChild( fromprjInput );

        document.body.appendChild( form );
        form.submit();
    }
        function action( pid ) {
        var form = document.createElement( 'form' );
        form.method = 'post';
        form.action = '/user/project_feedback.php';

        var fromprjInput = document.createElement( 'input' );
        fromprjInput.type = 'hidden';
        fromprjInput.name = 'p_id';
        fromprjInput.value = pid;
        form.appendChild( fromprjInput );

        document.body.appendChild( form );
        form.submit();
    }

</script>

<?php
include 'footer.php';
?>

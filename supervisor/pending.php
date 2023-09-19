<?php
include 'sessions.php';
if(isset($_POST['prjid'])){
	$us= $_POST['prjid'];
$sql = "update `projects` set approve=1 where  pid=".$us;
$sql1 = "update `projects` set status=1 where  pid=".$us;
$con->query($sql);
$con->query($sql1);


}
if(isset($_POST['usdel'])){
	$us= $_POST['usdel'];
$sql = "delete from `projects` where  pid=".$us;
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
};
}
$sql ="SELECT * FROM `projects` WHERE projects.approve = 0 AND supervisor = ".$_SESSION['id'];
$result = $con->query($sql);
	?>
    <?php
include 'header.php';
?>


			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Projects</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="/supervisor/userlogin.php">Dashboard</a></li>
						<li>Project Approval</li>
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
							<h3><i class="icon-material-outline-business-center"></i> Projects for Approval </h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								
								<?php
                                      $count=1;
                                    while($row = $result->fetch_assoc()) { ?>

								<li>
									<!-- Job Listing -->
									<div class="job-listing">

										<!-- Job Listing Details -->
										<div class="job-listing-details">

											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a href=""><?php echo $row['title'] ?></a>      <?php   if($row['approve']==1){   echo '<span class="dashboard-status-button green">Approved</span>';}else {echo '<span class="dashboard-status-button red">Not Approved</span>';} ?></h3>

												<!-- Job Listing Footer -->
												<div class="job-listing-footer">
													<ul>
														<li><i class="icon-line-awesome-user-secret"></i><?php echo $row['supervisor'] ?></li>
														<li><i class="icon-line-awesome-black-tie"></i><?php echo $row['discipline'] ?></li>
														<li><i class="icon-line-awesome-area-chart"></i><?php echo $row['area'] ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>


									<!-- Buttons -->
									<div class="buttons-to-right always-visible">
									<a onclick="approve('<?php echo $row['pid']; ?>')" class="button ripple-effect" style='color:white' class="btn-default"><i class="icon-material-outline-supervisor-account"></i>Approve</a>
                                    
                                    <!--<a onclick="action('<?php echo $row['pid']; ?>')" class="button ripple-effect" style='color:white' class="btn-default"><i class="icon-material-outline-supervisor-account"></i>Action</a>  -->
                                    <a onclick="view('<?php echo $row['pid']; ?>','<?php if($row['supervisorId'] != NULL){ echo 'super';}else{echo 'std';}?>')" class="button ripple-effect" style='color:white' class="btn-default"><i class="icon-material-outline-supervisor-account"></i>View</a>
                           				<a onclick="del('<?php echo $row['pid']; ?>','<?php echo $_SESSION['name']; ?>','<?php echo $row['title']; ?>','<?php echo $row['projectfile']; ?>')" class="button gray ripple-effect ico" title="Remove" data-tippy-placement="top">
  <i class="icon-feather-trash-2"></i>
</a></div>
								</li>
                                <?php }?>

							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
  <script>
  function action(prjid) {
    // Create a dynamic form element
    const form = document.createElement('form');
    form.action = '/supervisor/project_feedback.php'; // Replace '#' with the actual URL where you want to post the data
    form.method = 'post';

    // Add the 'prjid' input field to the form
    const prjidInput = document.createElement('input');
    prjidInput.type = 'hidden';
    prjidInput.name = 'p_id';
    prjidInput.value = prjid;
    form.appendChild(prjidInput);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }
  function approve(prjid) {
    // Create a dynamic form element
    const form = document.createElement('form');
    form.action = '#'; // Replace '#' with the actual URL where you want to post the data
    form.method = 'post';

    // Add the 'prjid' input field to the form
    const prjidInput = document.createElement('input');
    prjidInput.type = 'hidden';
    prjidInput.name = 'prjid';
    prjidInput.value = prjid;
    form.appendChild(prjidInput);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }  

function view(pid,type) {
  var form = document.createElement("form");
  form.method = "post";
  form.action = "viewprjuser.php";

  var prjidInput = document.createElement("input");
  prjidInput.type = "hidden";
  prjidInput.name = "prjid";
  prjidInput.value = pid;


  var t = document.createElement("input");
  t.type = "hidden";
  t.name = "type";
  t.value = type;


  var fromprjInput = document.createElement("input");
  fromprjInput.type = "hidden";
  fromprjInput.name = "fromprj";
  fromprjInput.value = pid;


  form.appendChild(prjidInput);
  form.appendChild(fromprjInput);
  form.appendChild(t);

  document.body.appendChild(form);
  form.submit();
}
function edit(pid,title) {
  var form = document.createElement("form");
  form.method = "post";
  form.action = "editproject.php";

  var prjidInput = document.createElement("input");
  prjidInput.type = "hidden";
  prjidInput.name = "pid";
  prjidInput.value = pid;

  var fromprjInput = document.createElement("input");
  fromprjInput.type = "hidden";
  fromprjInput.name = "fromprj";
  fromprjInput.value = pid;

  var fromprInput = document.createElement("input");
  fromprInput.type = "hidden";
  fromprInput.name = "prjnm";
  fromprInput.value = title;

  form.appendChild(prjidInput);
  form.appendChild(fromprjInput);
  form.appendChild(fromprInput);

  document.body.appendChild(form);
  form.submit();
}
function del(pid,usr,prnm,prfl) {
  var form = document.createElement("form");
  form.method = "post";
  form.action = "approval_projects.php";

  var prjidInput = document.createElement("input");
  prjidInput.type = "hidden";
  prjidInput.name = "usdel";
  prjidInput.value = pid;

  var fromprjInput = document.createElement("input");
  fromprjInput.type = "hidden";
  fromprjInput.name = "usr";
  fromprjInput.value = usr;

  var Input1 = document.createElement("input");
  Input1.type = "hidden";
  Input1.name = "prnm";
  Input1.value = prnm;

  var Input2 = document.createElement("input");
  Input2.type = "hidden";
  Input2.name = "prfl";
  Input2.value = prfl;

  form.appendChild(prjidInput);
  form.appendChild(fromprjInput);
  form.appendChild(Input1);
  form.appendChild(Input2);

  document.body.appendChild(form);
  form.submit();
}
</script>






<?php
include 'footer.php';
?>
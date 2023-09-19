<?php
if (!isset($_GET['prjid']))
	header('Location: searchprojects.php');
include 'connection.php';
if (isset($_GET['supervisorprj'])) {
	$sql = "SELECT * FROM `projects` inner join supervisor ON projects.supervisorId=supervisor.id where pid=" . $_GET['prjid'];
} else {
	$sql = "SELECT * FROM `projects` inner join student ON projects.studentid=student.id where pid=" . $_GET['prjid'];
}

$result = $con->query($sql) or die($con->error);
$row = $result->fetch_assoc()

	?>
<?php
include 'header.php';
?>
<div class="single-page-header" data-background-image="images/single-job.jpg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image"><a href="single-company-profile.html"><img
									src="images/company-logo-03a.png" alt=""></a></div>
						<div class="header-details">
							<h3>
								<?php echo $row['title'] ?>
							</h3>

							<h5>By:
								<?php echo $row[ 'fname' ].' '.$row[ 'lname' ] ?>
							</h5>
							<ul>
								<li><i class="icon-material-outline-business"></i>
									<?php echo $row['university'] ?>
								</li>
								<li>
									<div class="verified-badge-with-title">
										<?php echo $row['type'] ?>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">

		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">

			<div class="single-page-section">
				<h3 class="margin-bottom-25">Overview</h3>
				<p>
					<?php echo $row['overview'] ?>
				</p>
			</div>

			<div class="single-page-section">
				<h3 class="margin-bottom-30">Details</h3>
				<p>
					<?php echo $row['details'] ?>
				</p>
			</div>
		</div>

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">

				<?php if ($row['scope'] == 'Public') { ?>
					<!-- Sidebar Widget -->
					<div class="sidebar-widget">
						<div class="job-overview">
							<div class="job-overview-headline">Information</div>
							<div class="job-overview-inner">
								<ul>
									<li>
										<i class="icon-material-outline-location-on"></i>
									<span>Supervisor</span>
    <h5>
    <?php 
    $Supervisor = $con->query('select * from supervisor where id='.$row['supervisor']);

     if ($Supervisor !== false && $Supervisor->num_rows > 0) {
 
         $row2 = $Supervisor->fetch_assoc();
             echo  $row2['fname'].' '. $row2['lname'];
     }
   ?>    </h5>
									</li>
									<li>
										<i class="icon-material-outline-business-center"></i>
										<span>University</span>
										<h5>
											<?php echo $row['university'] ?>
										</h5>
									</li>
									<li>
										<i class="icon-material-outline-local-atm"></i>
										<span>Members</span>
										<h5>
											<?php if ($row['members'] == 'Individual')
												echo "<h5>" . $row['members'] . "</h5>";
											else {
												echo "<h5>";
												$sql = 'select * from members where pid=' . $row['pid'];
												$result1 = $con->query($sql);

												if ($result1->num_rows > 0) {
													$k = 1;
													while ($row1 = $result1->fetch_assoc()) {
														echo $row1['fullname'] . ", ";

														$k++;
													}
													echo "</h5>";
												}
											} ?>
										</h5>
									</li>
									<li>
										<i class="icon-material-outline-access-time"></i>
										<span> Thematic Area</span>
										<h5>
											<?php echo $row['area'] ?>
										</h5>
									</li>
									<li>
										<i class="icon-material-outline-access-time"></i>
										<span>Academic or Research</span>
										<h5>
											<?php echo $row['type2'] ?>
										</h5>
									</li>
									<li>
										<i class="icon-material-outline-access-time"></i>
										<span>Pubic or Private</span>
										<h5>
											<?php echo $row['scope'] ?>
										</h5>
									</li>
									<li>
										<i class="icon-material-outline-access-time"></i>
										<span>Date Added</span>
										<h5>
											<?php echo $row['dateadded'] ?>
										</h5>
									</li>
									<li>
										<i class="icon-material-outline-access-time"></i>
										<span> Start Date</span>
										<h5>
											<?php echo $row['startdate'] ?>
										</h5>
									</li>
									<li>
										<i class="icon-material-outline-access-time"></i>
										<span>End Date</span>
										<h5>
											<?php echo $row['enddate'] ?>
										</h5>
									</li>



								</ul>
							</div>
						</div>
					</div>

					<!-- Sidebar Widget -->
					<div class="sidebar-widget">
						<h3>Website:</h3>
						<a href="<?php echo $row['website'] ?>"><?php echo $row['website']; ?></a>
					</div>

				<?php
				} ?>
				
			</div>
		</div>
		
		<h3 class="margin-bottom-30">Images</h3>
		<div class="row">
				<p>

		<?php $imghtml = '';

$tt = $row['title'];
$uu = $row['username'];

if (isset($tt)) {
	$sql = "SELECT  DISTINCT src FROM `images` WHERE usprj ='" . $uu . '_' . $tt . "' ";

	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$imghtml .= '<div class="col-xl-4">
<div class="blog-compact-item" style="margin-bottom: 50px;">
<img src="projects/' . $uu . '_' . $tt . '_' . $row['src'] . '"alt=""></div>
</div>
';

		}
		// output data of each row
	} else {
		$imghtml = '<center><p> No Screenshot to show!</p></center>';
	}
}
echo $imghtml;

?>
				</p>
			</div>
	</div>
</div>
<?php
include 'footer.php';
?>
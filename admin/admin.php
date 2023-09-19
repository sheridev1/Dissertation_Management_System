<?php
include 'sessions.php';
include 'header.php';
include '../connection.php';
$projects = $con->query("SELECT COUNT(*) as project_count FROM `projects`")->fetch_assoc()["project_count"];
$students = $con->query("SELECT COUNT(*) as std FROM `student`")->fetch_assoc()["std"];
$supervisors = $con->query("SELECT COUNT(*) as super FROM `supervisor`")->fetch_assoc()["super"];
$pending = $con->query("SELECT COUNT(*) as project_pending FROM `projects` WHERE status = 0")->fetch_assoc()["project_pending"];

?>



<div class="dashboard-headline">
    <h3>Hello,
        ADMIN!
    </h3>
    <span>We are glad to see you again!</span>

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li><a href="/">Home</a></li>
            <li>Dashboard</li>
        </ul>
    </nav>
</div>
<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Total Students</span>
						<h4><?php echo $students ?></h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-users"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#b81b7f">
					<div class="fun-fact-text">
						<span>Total Supervisors</span>
						<h4><?php echo $supervisors ?></h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-line-awesome-user-secret"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#efa80f">
					<div class="fun-fact-text">
						<span>Total Projects</span>
						<h4><?php echo $projects ?></h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-file-text"></i></div>
				</div>

				<!-- Last one has to be hidden below 1600px, sorry :( -->
				<div class="fun-fact" data-fun-fact-color="#2a41e6">
					<div class="fun-fact-text">
						<span>Pending Projects</span>
						<h4><?php echo $pending ?></h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-file-minus"></i></div>
				</div>
			</div>
<?php

include 'footer.php';
?>
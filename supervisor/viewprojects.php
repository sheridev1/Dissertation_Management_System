<?php
include 'sessions.php';

if ( isset( $_POST[ 'usdel' ] ) ) {
    $us = $_POST[ 'usdel' ];
    $sql = 'delete from `projects` where  pid='.$us.' ';
    if ( $con->query( $sql ) == true ) {
        $usr = $_POST[ 'usr' ];
        $prnm = $_POST[ 'prnm' ];

        $sql = "select * from images where usprj='".$usr.'_'.$prnm."'";
        $result = $con->query( $sql );

        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                unlink( '../projects/'.$usr.'_'.$prnm.'_'.$row[ 'src' ] );
            }
        }
        $sql = "delete from images where usprj='".$usr.'_'.$prnm."'";
        $con->query( $sql );
        $sql = 'delete from members where pid='.$us;
        $con->query( $sql );
        if ( $_POST[ 'prfl' ] != '' )
        unlink( '../projectFiles/'.$_POST[ 'prfl' ] );
        header( 'Refresh:0' );
    }
    ;
}

if (isset($_POST['usapp']) && isset($_POST['status'])) {
  $us = $_POST['usapp'];
  $ustatus = ($_POST['status'] == '1') ? 1 : 0;
  $sql = "UPDATE `projects` SET status=".$ustatus." WHERE pid='".$us."'";
  $con->query($sql);
}

$sql ="SELECT * FROM `projects` where supervisor=".$_SESSION['id'].' AND projects.approve = 1 order by status desc';
$result = $con->query($sql);

include 'header.php';
?>


			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>My Projects</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="/supervisor/userlogin.php">Dashboard</a></li>
						<li>Manage Projects</li>
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
							<h3><i class="icon-material-outline-business-center"></i> My Project Listings</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								
								<?php
                                      $count=1;
                                      //<th style="color:green ; text-align:center;"  colspan="3">Type</th>
                                    // output data of each row
  while($row = $result->fetch_assoc()) { ?>

								<li>
									<!-- Job Listing -->
									<div class="job-listing">

										<!-- Job Listing Details -->
										<div class="job-listing-details">

											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a href=""><?php echo $row['title'] ?></a>      <?php   if($row['approve']==1){   echo '<span class="dashboard-status-button green">Approved</span>';}else {echo '<span class="dashboard-status-button red">Not Approved</span>';} ?>
													<span class = 'icon-material-outline-check-circle'>
                                                    <?php echo $row[ 'progress' ].'% Completed' ?>
                                                    </span>
												</h3>

											
												<!-- Job Listing Footer -->
												<div class="job-listing-footer">
													<ul>
														<li><i class="icon-line-awesome-black-tie"></i><?php echo $row['discipline'] ?></li>
														<li><i class="icon-line-awesome-area-chart"></i><?php echo $row['area'] ?></li>
													</ul>
												</div>
											</div>
										</div>
									</div>

									 <!-- Buttons -->
                   <div class = 'buttons-to-right always-visible'>
                   <a onclick = "view(<?php echo $row['pid']; ?>)" class = 'button ripple-effect' style = 'color:white' class = 'btn-default'><i class = 'icon-material-outline-supervisor-account'></i>View</a>
                   
                   <a onclick = "action('<?php echo $row['pid']; ?>','<?php echo $row['approve']; ?>')" class = 'button ripple-effect' style = 'color:white' class = 'btn-default'><i class = 'icon-line-awesome-pencil'></i>
                       <?php
    if ( $row[ 'approve' ] == 1 ) {
        echo 'Feedback';
    } else {
        echo 'Action';
    }
    ?>
    
                   </a>


            <a onclick = "edit('<?php echo $row['pid']; ?>','<?php echo $row['title']; ?>')"  class = 'button gray ripple-effect ico' title = 'Edit' data-tippy-placement = 'top'><i class = 'icon-feather-edit'></i></a>
            <a onclick = "del('<?php echo $row['pid']; ?>','<?php echo $_SESSION['name']; ?>','<?php echo $row['title']; ?>','<?php echo $row['projectfile']; ?>')" class = 'button gray ripple-effect ico' title = 'Remove' data-tippy-placement = 'top'><i class = 'icon-feather-trash-2'></i></a>
            </div>
            </li>
            <?php }
            ?>


							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
<script>
              
function status(username, status) {
    const form = document.createElement('form');
    form.action = '#'; 
    form.method = 'post';

    const usappInput = document.createElement('input');
    usappInput.type = 'hidden';
    usappInput.name = 'usapp';
    usappInput.value = username;
    form.appendChild(usappInput);

    const checkbox = document.createElement('input');
    checkbox.type = 'text';
    checkbox.name = 'status';
    checkbox.value = status;
    form.appendChild(checkbox);

    const saveCell = document.createElement('td');
    const submitButton = document.createElement('input');
    submitButton.type = 'submit';
    submitButton.className = 'btn btn-warning';
    submitButton.value = 'Save';
    submitButton.name = 'savestatus';
    saveCell.appendChild(submitButton);
    form.appendChild(saveCell);

    document.body.appendChild(form);

    form.submit();
  }
function action(pid,action) {
  var form = document.createElement("form");
  form.method = "post";
  form.action = "project_feedback.php";


  var fromprjInput = document.createElement("input");
  fromprjInput.type = "hidden";
  fromprjInput.name = "p_id";
  fromprjInput.value = pid;
  
    var fromprjInput1 = document.createElement("input");
  fromprjInput1.type = "hidden";
  fromprjInput1.name = "action";
  fromprjInput1.value = action;


  form.appendChild(fromprjInput);

  form.appendChild(fromprjInput1);

  document.body.appendChild(form);
  form.submit();
}
function view(pid) {
  var form = document.createElement("form");
  form.method = "post";
  form.action = "viewprjuser.php";

  var prjidInput = document.createElement("input");
  prjidInput.type = "hidden";
  prjidInput.name = "prjid";
  prjidInput.value = pid;

  var fromprjInput = document.createElement("input");
  fromprjInput.type = "hidden";
  fromprjInput.name = "fromprj";
  fromprjInput.value = pid;


  form.appendChild(prjidInput);
  form.appendChild(fromprjInput);

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
  form.action = "viewprojects.php";

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
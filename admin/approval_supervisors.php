<?php
include 'sessions.php';
?>

<?php 
if(isset($_POST['usapp'])){
	$us= $_POST['usapp'];
$sql = "update `supervisor` set approve=1 where  username='".$us."' ";
$con->query($sql);
}
if(isset($_POST['usdel'])){
	$us= $_POST['usdel'];
$sql = "delete from `supervisor` where  username='".$us."' ";
if($con->query($sql)==true){
  $file = $_POST['img'];
unlink($file);
};
}


$sql ="select * from supervisor where approve=0";
$result = $con->query($sql);

	?>
    <?php
include 'header.php';
?>
<div class="dashboard-headline">
    <h3>Super Visor</h3>

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/admin/admin.php">Dashboard</a></li>
            <li>Super visor</li>
        </ul>
    </nav>
</div>
<div class='row'>
    <div class="col-xl-12">
        <div class="dashboard-box margin-top-0">

            <!-- Headline -->
            <div class="headline">
                <h3><i class="icon-material-outline-business-center"></i>Super Visor</h3>
            </div>

            <div class="content">
                <ul class="dashboard-box-list">
                    <?php while($row = $result->fetch_assoc()) { ?>
                    <li>
                        <!-- Job Listing -->
                        <div class="job-listing">

                            <!-- Job Listing Details -->
                            <div class="job-listing-details">

                                <!-- Logo -->
                                <a  class="job-listing-company-logo">
                                    <img src="/<?php echo $row['img']?>" alt="">
                                </a>
<?php if($row['active']==0){
          $status=' Not Active';
        }
        else {
          $status = ' Active ';
        } ?>
                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h3 class="job-listing-title"><a href=""><?php echo $row['fname'].$row['lname']?></a></h3>

                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li><i class="icon-material-outline-business"></i> <?php echo $row['university']?></li>
                                            <li><i class="icon-material-outline-location-on"></i>  <?php echo $row['country']?></li>
                                            <li><i class="icon-material-outline-access-time"></i> <?php echo $row['regdate']?></li>
                                            <li><i class="icon-material-outline-check-circle"></i> <?php echo $status?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="buttons-to-right">
                        <a  href="#" class="button green ripple-effect " title="Approve"  onclick="submitForm('<?php echo $row['username']; ?>');">Approve</a>
                        <a href="#" class="button red ripple-effect ico" title="Remove" onclick="delsubmitForm('<?php echo $row['username']; ?>', '<?php echo $row['img']; ?>');"><i class="icon-feather-trash-2"></i></a>


                        </div>
                    </li>
                    <?php }?>

                </ul>
            </div>
        </div>
    </div>
</div>
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
  function delsubmitForm(username, img) {
    // Create a dynamic form element
    const form = document.createElement('form');
    form.action = '#'; // Replace '#' with the actual URL where you want to post the data
    form.method = 'post';

    // Add the 'usdel' input field to the form
    const usdelInput = document.createElement('input');
    usdelInput.type = 'hidden';
    usdelInput.name = 'usdel';
    usdelInput.value = username;
    form.appendChild(usdelInput);

    // Add the 'img' input field to the form
    const imgInput = document.createElement('input');
    imgInput.type = 'hidden';
    imgInput.name = 'img';
    imgInput.value = img;
    form.appendChild(imgInput);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }
  function editsubmitForm(userid, fromprj) {
    // Create a dynamic form element
    const form = document.createElement('form');
    form.action = 'edituser.php'; // Replace 'edituser.php' with the actual URL where you want to post the data
    form.method = 'post';

    // Add the 'userid' input field to the form
    const useridInput = document.createElement('input');
    useridInput.type = 'hidden';
    useridInput.name = 'userid';
    useridInput.value = userid;
    form.appendChild(useridInput);

    // Add the 'fromprj' input field to the form
    const fromprjInput = document.createElement('input');
    fromprjInput.type = 'hidden';
    fromprjInput.name = 'fromprj';
    fromprjInput.value = fromprj;
    form.appendChild(fromprjInput);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }
  function submitForm(username) {
    // Create a dynamic form element
    const form = document.createElement('form');
    form.action = '#'; // Replace '#' with the actual URL where you want to post the data
    form.method = 'post';

    // Add the 'usapp' input field to the form
    const usappInput = document.createElement('input');
    usappInput.type = 'hidden';
    usappInput.name = 'usapp';
    usappInput.value = username;
    form.appendChild(usappInput);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }
</script>
<?php
include 'footer.php';
?>
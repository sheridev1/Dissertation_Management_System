<?php
include 'sessions.php';

$error = "";
if(isset($_POST['oldpwd'])){
$oldpassword = $_POST['oldpwd'];
$newpassword = $_POST['newpwd'];
$rnewpassword = $_POST['rnewpwd'];
$sql = "select * from admin where id=1";
$result = $con->query($sql);
while($row = $result->fetch_assoc()){
$pwd = $row['pass'];
if($pwd ==  md5($oldpassword)){
	if($newpassword == $rnewpassword){
		$sql = "UPDATE `admin` SET `pass`= '".md5($newpassword)."' WHERE username='admin'";
		$con->query($sql);
		$error = "Password Changed!";	
	}
	else {
		$error = "New passwords does not matched!";
	}
	
}
else {
	$error = "Old Password is incorrect!";
	
}
	
}
}

	

?><?php
include 'header.php';
?>
<div class="dashboard-headline">
    <h3>Change Password</h3>

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/admin/admin.php">Dashboard</a></li>
            <li>Change Password</li>
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
                <h3><i class="icon-feather-folder-plus"></i>Update Password</h3>
            </div>
            <form method="post"  action="#">
                <div class="content with-padding padding-bottom-10">
                    <div class="row">

                        <div class="col-xl-6">
                            <div class="submit-field">
                                <h5>User Name</h5>
                                <input readonly type="text" class="with-border" value="<?php echo $_SESSION['name']; ?>" />
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="submit-field">
                                <h5>Password</h5>
                                <input type="password" class="with-border" placeholder="Enter your old password..." name="oldpwd" autofocus required>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="submit-field">
                                <h5>Password</h5>
                                <input type="password" class="with-border" placeholder="Enter your new password..." name="newpwd" required>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="submit-field">
                                <h5>Password</h5>
                                <input type="password" class="with-border" name="rnewpwd" placeholder="Re-Enter your new password" required> 
                            </div>
                        </div>

                        <div class="col-xl-12">

                            <button type="submit" style='color:white' name="submit"
                                class="button ripple-effect big margin-top-30">Update</button>
                        </div>
            </form>


        </div>
    </div>

</div>

</div>
</div>

<?php
include 'footer.php';
?>
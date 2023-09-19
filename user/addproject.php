<?php

include 'sessions.php';
if (isset($_POST['submit'])) {
    $kfname = '';
    $title = $_POST['title'];
    $supervisor = $_POST['supervisor'];
    $discipline = $_POST['discipline'];
    $area = $_POST['area'];
    $type = $_POST['type'];
    $website = $_POST['website'];
    
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $overview = $_POST['overview'];
    $overview = str_replace("'", '"', $overview);
    $details = $_POST['details'];
    $type2 = $_POST['type2'];
    $details = str_replace("'", '"', $details);
    $members = $_POST['members'];
    $scope = $_POST['scope'];
    $Flag = 0;
    // Include the database configuration file
    include_once '../connection.php';
    // Check if user already added a project named by the title user inputed
    $sql = "SELECT * FROM `projects` WHERE studentid=" . $_SESSION['id'] . " and title='" . $_POST['title'] . "'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        //if user already added this project
        $titleerr = 'This Project with title:' . $_POST['title'] . ' already added by you!';
    } else {
        //if user did not added a project with same name then check if a project is already added by someone with same title
        $sql = "select  * from members where fullname='" . $_SESSION['fullname'] . "'";
        $result = $con->query($sql);
        // check if user already a member of a project
        if ($result->num_rows > 0) {
            //user is already a member of a project then now compare titles  
            while ($row = $result->fetch_assoc()) {
                $foundPid = $row['pid'];
                $sql = "SELECT * FROM `projects` inner join student ON projects.studentid=student.id where pid=" . $foundPid;
                $result1 = $con->query($sql);
                //getting the title of the project that user is already a member of.
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {

                        //checking titles
                        if ($title == $row1['title']) {

                            //now if titled matched then check if project is from the same university.
                            if ($_SESSION['university'] == $row1['university']) {

                                //if project is from the same university then print error .. that user already a member of same project added by someone else
                                $titleerr = 'Your are  already a member of same project added by ' . $row1['fname'] . ' ' . $row1['lname'] . " from " . $row1['university'];
                                $Flag = 1;
                            }

                        }

                    }
                }

            }
        }

        if ($Flag == 0) {

            // File upload configuration
            $targetDir = "../projects/";
            $targetDir1 = "../projectFiles/";
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            $sql1 = "DELETE  FROM images WHERE usprj='"  . '_' . $_POST['title'] . "'";
            $con->query($sql1) or die($con->error);
            $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = '';
            if (!empty(array_filter($_FILES['files']['name']))) {

                foreach ($_FILES['files']['name'] as $key => $val) {
                    // File upload path

                    $fileName = basename($_FILES['files']['name'][$key]);
                    $targetFilePath = $targetDir . '_' . $_POST['title'] . '_' . $fileName;

                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypes)) {
                        // Upload file to server

                        try {
                            move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
                            $insertValuesSQL .= "('" .  '_' . $_POST['title'] . "','" . $fileName . "'),";


                            //code...
                        } catch (\Throwable $th) {
                            //throw $th;
                            echo $th;
                        }
                        /* if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                             // Image db insert sql
                             
                         }else{
                           
                             $errorUpload .= $_FILES['files']['name'][$key].', ';
                         }*/
                    } else {
                        $errorUploadType = 'File types are not supported!';
                    }
                }

                if (!empty($insertValuesSQL)) {
                    $insertValuesSQL = trim($insertValuesSQL, ',');
                    // Insert image file name into database
                    $insert = $con->query("INSERT INTO images (usprj,src) VALUES $insertValuesSQL");
                    if ($insert) {
                        $targetFilePath = '';
                        $targetDir = "../projectFiles/";
                        $allowTypes = array('zip', 'docx', 'ppt');
                        $prjFileFlag = 0;
                        if (!empty($_FILES['files1']['name'])) {
                            // File upload path

                            $fileName = basename($_FILES['files1']['name'][0]);

                            $targetFilePath = $targetDir .'_' . $_POST['title'] . '_' . $fileName;
                            // Check whether file type is valid
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                            if (in_array($fileType, $allowTypes)) {
                                // Upload file to server

                                try {
                                    move_uploaded_file($_FILES["files1"]["tmp_name"][0], $targetFilePath);
                                    $prjFileFlag = 1;
                                    $targetFilePath ='_' . $_POST['title'] . '_' . $fileName;
                                } catch (\Throwable $th) {
                                    //throw $th;

                                    $prjFileFlag = 0;
                                }
                                /* if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                                     // Image db insert sql
                                     
                                 }else{
                                   
                                     $errorUpload .= $_FILES['files']['name'][$key].', ';
                                 }*/
                            } else {
                                $errorUploadType1 = "File type is not supported!";
                            }
                        }
                        if ($prjFileFlag == 1) {
                            if ($members == 'Individual') {
                                $sql = "INSERT INTO `projects`( `studentid`, `title`, `discipline`, `area`, `status`, `supervisor`, `website`, `overview`, `details`, `approve`, `type`, `startdate`, `enddate`,`type2`,`members`,`scope`,`supervisorId`,`projectfile`) VALUES (" . $_SESSION['id'] . ",'" . $_POST['title'] . "','" . $_POST['discipline'] . "','" . $_POST['area'] . "',0,'" . $_POST['supervisor'] . "','" . $_POST['website'] . "','" . $_POST['overview'] . "','" . $_POST['details'] . "',0,'" . $_POST['type'] . "','" . $_POST['sdate'] . "','" . $_POST['edate'] . "','" . $type2 . "','" . $members . "','" . $scope . "','" . $_POST['supervisor'] . "','" . $targetFilePath . "');";
                                if ($con->query($sql) == true) {
                                    header('Location: userlogin.php');
                                    exit();
                                } else
                                    echo $con->error;
                            } else {
                                $sql = "INSERT INTO `projects`( `studentid`, `title`, `discipline`, `area`, `status`, `supervisor`, `website`, `overview`, `details`, `approve`, `type`, `startdate`, `enddate`,`type2`,`members`,`supervisorId`,`scope`) VALUES (" . $_SESSION['id'] . ",'" . $_POST['title'] . "','" . $_POST['discipline'] . "','" . $_POST['area'] . "',0,'" . $_POST['supervisor'] . "','" . $_POST['website'] . "','" . $_POST['overview'] . "','" . $_POST['details'] . "',0,'" . $_POST['type'] . "','" . $_POST['sdate'] . "','" . $_POST['edate'] . "','" . $type2 . "','" . $members . "','" . $_POST['supervisor'] . "','" . $scope . "');";
                                if ($con->query($sql) == true) {
                                    $sql = "select * from projects where studentid=" . $_SESSION['id'] . " and title ='" . $title . "'";
                                    $result = $con->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $pid = $row['pid'];
                                        }
                                    }
                                    for ($i = 1; $i <= 4; $i++) {
                                        $memnm = $_POST['mem' . $i];
                                        if ($memnm != '') {
                                            $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (" . $pid . ",'" . $memnm . "');";
                                            $con->query($sql);
                                        }
                                    }

                                    header('Location: userlogin.php');
                                    exit();
                                } else
                                    echo $con->error;
                            }
                        }




                        $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . $errorUpload : '';
                        $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . $errorUploadType : '';
                        $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                        $statusMsg = "Files are uploaded successfully." . $errorMsg;

                    } else {
                        echo $con->error;
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $statusMsg = "Something went wrong!";
                }

            } else {
                $statusMsg = 'Please select a file to upload.';
            }
        }
        // Display status message
    }
}

?>
<?php 
include 'header.php';?>
<!-- Dashboard Headline -->
<div class="dashboard-headline">
    <h3>Add Project</h3>

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/userlogin.php">Dashboard</a></li>
            <li>Add Project</li>
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
                <h3><i class="icon-feather-folder-plus"></i> Project Form</h3>
            </div>

            <form method="post" enctype="multipart/form-data" action="#">
            <div class="content with-padding padding-bottom-10">
                <div class="row">

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Project Name</h5>
                            <input type="text" class="with-border" required name="title"
                                placeholder="Enter a Project name" value="<?php if (isset($kfname))
                                    echo $title; ?>" />
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Supervisor Name</h5>

                            <select class="selectpicker with-border" name="supervisor" title="Super Visor">
                            <?php
                            $query = mysqli_query($con, "select * from supervisor where approve=1");
                            while ($row = mysqli_fetch_array($query)) {

                                ?>

                                <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                </option>

                            <?php } ?>
                        </select>


                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Thematic Area</h5>
                            <input type="text" required class="with-border" name="area" placeholder="Enter an Area "
                                value="<?php if (isset($kfname))
                                    echo $area; ?>" />
                        </div>
                    </div>

                    <div class="col-xl-2">
                        <div class="submit-field">
                            <h5>Visisbility</h5>
                            <select class="selectpicker with-border" name="scope" data-size="7" title="Visisbility">
                                <option value='Public'>Public</option>
                                <option value='Private'>Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="submit-field">
                            <h5>Type</h5>
                            <select class="selectpicker with-border" name="type2" data-size="7" title="Type">
                                <option value='Research'>Research</option>
                                <option value='Academic'>Academic</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="submit-field">
                            <h5>Discipline</h5>
                            <select class="selectpicker with-border" name="discipline" data-size="7" title="Discipline">
                                <option value='Engineering'>Engineering</option>
                                <option value='Non engineering'>Non engineering</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <div class="submit-field">
                            <h5>Status</h5>
                            <select class="selectpicker with-border" name="type" data-size="7" title="Status">
                                <option value='On Going'> On Going </option>
                                <option value='Completed'> Completed </option>
                                <option value='Dropped'> Dropped </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Members *</h5>
                            <select class="selectpicker with-border" id="membersSelect"  name="members" data-size="7" title="Members" required>
                                <option selected value='Individual'> Individual </option>
                                <option value='Group Base'> Group Base </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 " id='sm1'>
                        <div class="submit-field">
                            <h5>1st Member </h5>
                            <select class="selectpicker with-border" name="mem1" data-size="7" title="Students">

                            <option selected value="<?php echo $_SESSION['id']; ?>"><?php echo $_SESSION['fullname']; ?></option>

                        </select>
                        </div>
                    </div>
                
                    <div class="col-xl-3 " id='sm2'>
                        <div class="submit-field">
                            <h5>2nd Member </h5>
                            <select class="selectpicker with-border" name="mem2" data-size="7" title="Students">
                            <?php
                            $query = mysqli_query($con, "select * from student where approve=1 order by fname ASC ");
                            while ($row = mysqli_fetch_array($query)) {

                                ?>

                                <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                </option>

                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-xl-3 " id='sm3'>
                        <div class="submit-field">
                            <h5>3rd Member</h5>
                            <select class="selectpicker with-border" name="mem3" data-size="7" title="Students">
                            <?php
                            $query = mysqli_query($con, "select * from student where approve=1 order by fname ASC ");
                            while ($row = mysqli_fetch_array($query)) {

                                ?>

                                <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                </option>

                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-xl-3 " id='sm4'>
                        <div class="submit-field">
                            <h5>4th Member</h5>
                            <select class="selectpicker with-border" name="mem4" data-size="7" title="Students">
                            <?php
                            $query = mysqli_query($con, "select * from student where approve=1 order by fname ASC ");
                            while ($row = mysqli_fetch_array($query)) {

                                ?>

                                <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                </option>

                            <?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Website</h5>
                            <input type="text" class="with-border" name="website"
                                placeholder="Enter website(Not Compulsory)" value="<?php if (isset($kfname))
                                    echo $website; ?>" />
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>Start Date</h5>
                            <input type="date" required class="with-border" name="sdate" placeholder="" value="<?php if (isset($kfname))
                                echo $sdate; ?>" />
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="submit-field">
                            <h5>End Date</h5>
                            <input type="date" required class="with-border" id="edt" name="edate" placeholder="" value="<?php if (isset($kfname))
                                echo $edate; ?>" />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="submit-field">
                            <h5>Overview</h5>

                            <textarea rows="4" class="with-border"
                                name="overview"><?php if (isset($kfname))
                                    echo $overview; ?>  </textarea>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="submit-field">
                            <h5>Detail of Project</h5>
                            <textarea class="with-border" name="details"
                                rows="4"><?php if (isset($kfname))
                                    echo $details; ?> </textarea>
                        </div>
                    </div>

                    <div class="form-group"><label>* Upload Screenshots( .jpg , .png , .jpeg , .gif )</label>
                <input required type="file" name="files[]"  multiple /><p style="color:red; font-size:13px;"><?php if(isset($errorUploadType)) echo $errorUploadType; ?></p>
              </div>
              <div class="form-group"><label>* Upload Project files(.zip)</label>
                <input type="file" name="files1[]"  /><p style="color:red; font-size:13px;"><?php if(isset($errorUploadType1)) echo $errorUploadType1; ?></p>
              </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        
    <button type="submit"   style='color:white' name="submit" class="button ripple-effect big margin-top-30">Publish</button>
    </div>
    </form>

</div>
<script>

document.addEventListener('DOMContentLoaded', function () {
    // Add the change event listener to the "Members" select element
    const membersSelect = document.getElementById('membersSelect');
    membersSelect.addEventListener('change', handleMemberTypeChange);

    // Call the function initially to set the correct display and "required" attribute
    handleMemberTypeChange();
});

function handleMemberTypeChange() {
    const selectElement = document.getElementById('membersSelect');
    const sm1 = document.getElementById('sm1');
    const sm2 = document.getElementById('sm2');
    const sm3 = document.getElementById('sm3');
    const sm4 = document.getElementById('sm4');
    const selectedValue = selectElement.value;
    const memberNameInputs = document.querySelectorAll('input[name^="mem"]');

    if (selectedValue === 'Individual') {
        sm1.style.display = 'none';
        sm2.style.display = 'none';
        sm3.style.display = 'none';
        sm4.style.display = 'none';
        memberNameInputs.forEach(input => {
            input.removeAttribute('required');
        });
    } else {
        sm1.style.display = 'block';
        sm2.style.display = 'block';
        sm3.style.display = 'block';
        sm4.style.display = 'block';
        memberNameInputs.forEach(input => {
            
            input.setAttribute('required', 'required');
        });
    }
}

</script>
<!-- Row / End -->
<?php
include 'footer.php';
?>

<?php
include 'sessions.php';
?>
<?php
if (!isset($_POST['pid'])) {
    header('Location: projects.php');
    exit();
}
$alert = '';
if (isset($_POST['supervisor'])) {
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
    $sql = "UPDATE `projects` SET `title`='" . $title . "',`discipline`='" . $discipline . "',`area`='" . $area . "',`supervisor`='" . $supervisor . "',`website`='" . $website . "',`overview`='" . $overview . "',`details`='" . $details . "',`type`='" . $type . "',`startdate`='" . $sdate . "',`enddate`='" . $edate . "',`type2`='" . $type2 . "',`members`='" . $members . "',`scope`='" . $scope . "' WHERE pid=" . $_POST['pid'];
    if ($con->query($sql) == true) {
        if ($members == 'Group Base') {
            $sql = "DELETE FROM `members` WHERE pid=" . $_POST['pid'];
            $con->query($sql) or die($con->error);
            $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (" . $_POST['pid'] . ",'" . $_SESSION['fullname'] . "');";
            $con->query($sql) or die($con->error);
            $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (" . $_POST['pid'] . ",'" . $_POST['mem2'] . "');";
            $con->query($sql) or die($con->error);
            if (isset($_POST['mem3'])) {
                $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (" . $_POST['pid'] . ",'" . $_POST['mem3'] . "');";
                $con->query($sql) or die($con->error);
            }
            if (isset($_POST['mem4'])) {
                $sql = "INSERT INTO `members`(`pid`, `fullname`) VALUES (" . $_POST['pid'] . ",'" . $_POST['mem4'] . "');";
                $con->query($sql) or die($con->error);
            }


        } else {
            $sql = "DELETE FROM `members` WHERE pid=" . $_POST['pid'];
            $con->query($sql) or die($con->error);
        }
        $alert = ' alert("Changes Saved!"); ';
    } else {
        $alert = ' alert("Changes not Saved!"); ';
    }
}
//Update Screenshots Code
if (isset($_POST['update_Screenshots'])) {
    // File upload configuration
    $targetDir = "../projects/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    $usr = $_SESSION['name'];
    $prnm = $_POST['prjnm'];

    $sql = "select * from images where usprj='" . $usr . '_' . $prnm . "'";
    $result = $con->query($sql) or die($con->error);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            unlink('../projects/' . $usr . '_' . $prnm . '_' . $row['src']);
        }
    }
    $sql = "delete from images where usprj='" . $usr . '_' . $prnm . "'";
    $con->query($sql) or die($con->error);

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType1 = '';
    if (!empty(array_filter($_FILES['files']['name']))) {

        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path

            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $_SESSION['name'] . '_' . $_POST['prjnm'] . '_' . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server

                try {
                    move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);
                    $insertValuesSQL .= "('" . $_SESSION['name'] . '_' . $_POST['prjnm'] . "','" . $fileName . "'),";

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
                $errorUploadType1 = "File Type not is not supported to upload of " . $_FILES['files']['name'][$key] . '';
            }
        }

        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            // Insert image file name into database
            $insert = $con->query("INSERT INTO images (usprj,src) VALUES $insertValuesSQL");
            if ($insert) {
                $alert = ' alert("Changes Saved!"); ';
            } else {
                $alert = ' alert("Changes not Saved!"); ';
            }

        } else {
            $alert = ' alert("Changes not Saved!"); ';
        }

    }
}

//Update Proect File Code
if (isset($_POST['update_projectFile'])) {
    // File upload configuration
    $usr = $_SESSION['name'];
    $prnm = $_POST['prjnm'];
    $targetDir = "../projectFiles/";
    $allowTypes = array('zip', 'docx', 'ppt');
    $prjFileFlag = 0;
    if (!empty($_FILES['files1']['name'])) {
        // File upload path

        $fileName = basename($_FILES['files1']['name'][0]);

        $targetFilePath = $targetDir . $_SESSION['name'] . '_' . $prnm . '_' . $fileName;
        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $targetFilePath = $targetDir . $_SESSION['name'] . '_' . $prnm . '.' . $fileType;
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server

            try {
                if (move_uploaded_file($_FILES["files1"]["tmp_name"][0], $targetFilePath)) {
                    $targetFilePath = $_SESSION['name'] . '_' . $prnm . '.' . $fileType;
                    $sql = "update projects set projectfile='" . $targetFilePath . "' where pid=" . $_POST['pid'];
                    $con->query($sql) or die($con->error);

                    $alert = ' alert("Changes  Saved!"); ';
                }

            } catch (\Throwable $th) {
                //throw $th;
                echo $th;
                $prjFileFlag = 0;
                $alert = ' alert("Changes not Saved!"); ';
            }
            /* if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                 // Image db insert sql
                 
             }else{
               
                 $errorUpload .= $_FILES['files']['name'][$key].', ';
             }*/
        } else {
            $errorUploadType = "File Type not is not supported to upload of " . $_FILES['files1']['name'][0] . '';
            $alert = ' alert("Changes not Saved!"); ';
        }
    }
}

?>
<?php
include 'header.php';
$sql = 'select * from projects where pid=' . $_POST['pid'];
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kfname = '';
        $title = $row['title'];
        $supervisor = $row['supervisor'];
        $discipline = $row['discipline'];
        $area = $row['area'];
        $type = $row['type'];
        $website = $row['website'];
        $sdate = $row['startdate'];
        $edate = $row['enddate'];

        $overview = $row['overview'];
        $overview = str_replace("'", '"', $overview);
        $details = $row['details'];
        $type2 = $row['type2'];
        $details = str_replace("'", '"', $details);
        $members = $row['members'];
        $scope = $row['scope'];
        $projectFile = $row['projectfile'];

    }
}
if ($members == 'Group Base') {
    $sql = "select  * from members where pid=" . $_POST['pid'] . " and fullname!='" . $_SESSION['fullname'] . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $i = 0;
        $mem = array();
        while ($row = $result->fetch_assoc()) {

            $mem[$i] = $row['fullname'];
            $i++;
        }
    }
}
?>
<div class="dashboard-headline">
    <h3>Update Project</h3>

    <!-- Breadcrumbs -->
    <nav id="breadcrumbs" class="dark">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/supervisor/userlogin">Dashboard</a></li>
            <li>Update Project</li>
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
                        <input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>" />
                        <input type="hidden" name="prjnm" value="<?php echo $_POST['prjnm']; ?>" />

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
                                <input type="text" required class="with-border" name="supervisor"
                                    placeholder="Enter Supervisor name" value="<?php if (isset($kfname))
                                        echo $supervisor; ?>" />
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
                                    <option value='Public' <?php if ($scope == 'Public')
                                        echo 'selected'; ?>>Public</option>
                                    <option value='Private' <?php if ($scope == 'Private')
                                        echo 'selected'; ?>>Private
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="submit-field">
                                <h5>Type</h5>
                                <select class="selectpicker with-border" name="type2" data-size="7" title="Type">
                                    <option value='Research' <?php if ($type2 == 'Research')
                                        echo 'selected'; ?>>Research
                                    </option>
                                    <option value='Academic' <?php if ($type2 == 'Academic')
                                        echo 'selected'; ?>>Academic
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="submit-field">
                                <h5>Discipline</h5>
                                <select class="selectpicker with-border" name="discipline" data-size="7"
                                    title="Discipline">
                                    <option value='Engineering' <?php if ($discipline == 'Engineering')
                                        echo 'selected'; ?>>
                                        Engineering</option>
                                    <option value='Non engineering' <?php if ($discipline == 'Non engineering')
                                        echo 'selected'; ?>>Non engineering</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="submit-field">
                                <h5>Status</h5>
                                <select class="selectpicker with-border" name="type" data-size="7" title="Status">
                                    <option value='On Going' <?php if ($type == 'On Going')
                                        echo 'selected'; ?>> On Going
                                    </option>
                                    <option value='Completed' <?php if ($type == 'Completed')
                                        echo 'selected'; ?>> Completed
                                    </option>
                                    <option value='Dropped' <?php if ($type == 'Dropped')
                                        echo 'selected'; ?>> Dropped
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="submit-field">
                                <h5>Members</h5>
                                <select class="selectpicker with-border" name="members" data-size="7" title="Members">
                                    <option value='Individual' <?php if ($type == 'Individual')
                                        echo 'selected'; ?>>
                                        Individual </option>
                                    <option value='Group Base' <?php if ($type == 'Group
                                        Base')
                                        echo 'selected'; ?>> Group
                                        Base </option>
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
                                <input type="date" required class="with-border" id="edt" name="edate" placeholder=""
                                    value="<?php if (isset($kfname))
                                        echo $edate; ?>" />
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="submit-field">
                                <h5>Overview</h5>

                                <textarea rows="4" class="with-border" name="overview"><?php if (isset($kfname))
                                    echo $overview; ?>  </textarea>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="submit-field">
                                <h5>Detail of Project</h5>
                                <textarea class="with-border" name="details" rows="4"><?php if (isset($kfname))
                                    echo $details; ?> </textarea>
                            </div>
                        </div>
                        <div class="col-xl-12">

                            <button type="submit" style='color:white' name="submit"
                                class="button ripple-effect big margin-top-30">Update</button>
                        </div>
            </form>


            <form method="post" class="col-xl-12" enctype="multipart/form-data" action="#">
                <input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>" />
                <input type="hidden" name="update_Screenshots" value="true" />
                <input type="hidden" name="prjnm" value="<?php echo $_POST['prjnm']; ?>" />
                <p style="color:red;">
                    <?php if (isset($errorUploadType1))
                        echo $errorUploadType1; ?>
                </p>

                <div class="form-group"><label>Upload New Screenshots( .jpg , .png , .jpeg , .gif ) : </label>
                    <input type="file" name="files[]" multiple />
                    <p style="color:red; font-size:13px;">
                        <?php if (isset($statusMsg))
                            echo $statusMsg; ?>
                    </p>
                </div>

                <div class="form-group">
                    <button type="submit" style='color:white' name="submit"
                        class="button ripple-effect big margin-top-30">Update</button>
            </form>

            <p style="color:red;">
                <?php if (isset($errorUploadType))
                    echo $errorUploadType; ?>
            </p>
            <br>
            <form method="post" class="col-xl-12" enctype="multipart/form-data" action="#">
                <input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>" />
                <input type="hidden" name="update_projectFile" value="true" />
                <input type="hidden" name="prjnm" value="<?php echo $_POST['prjnm']; ?>" />
                <input type="hidden" name="prevFile" value="<?php echo $projectFile; ?>" />

                <div class="form-group"><label>Upload a new Project file(.zip): </label>
                    <input type="file" name="files1[]" />
                    <p style="color:red; font-size:13px;">
                        <?php if (isset($statusMsg))
                            echo $statusMsg; ?>
                    </p>
                </div>
                <div class="form-group">
                    <button type="submit" style='color:white' name="submit"
                        class="button ripple-effect big margin-top-30">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>

</div>
</div>
</div>
</div>



<?php include 'footer.php'; ?>
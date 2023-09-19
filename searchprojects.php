<?php
$sql = "SELECT * FROM `projects` inner join student ON projects.studentid=student.id where projects.approve=1 and projects.status=1 ";
$sql1 = "SELECT * FROM `projects` inner join supervisor ON projects.supervisorId=supervisor.id where projects.approve=1 and projects.status=1 ";
if (isset($_POST['txtsearch'])) {
    $txttosearch = $_POST['txtsearch'];
    $txtsearchby = $_POST['searchby'];

    $txtdiscipline = $_POST['discipline'];
    if ($txtdiscipline != 'ALL' && $txtdiscipline != '')
        $txtdiscipline = "and projects.discipline ='" . $txtdiscipline . "'";
    else
        $txtdiscipline = '';
    $txtdate = $_POST['year'];
    if ($txtdate != 'ALL' && $txtdate != '')
    
        $txtdate ="and SUBSTRING(projects.startdate, 1, 4) = '" . $txtdate . "'";
    else
        $txtdate = '';
    $txttype = $_POST['type'];
    if ($txttype != 'ALL' && $txttype != '')
        $txttype = "and projects.type ='" . $txttype . "'";
    else
        $txttype = '';

    if ($txttosearch == '') {
        $sql = "SELECT * FROM `projects` inner join student ON projects.studentid=student.id where projects.approve=1 and projects.status=1 " . $txtdiscipline . $txttype.$txtdate;
        $sql1 = "SELECT * FROM `projects` inner join supervisor ON projects.supervisorId=supervisor.id where projects.approve=1 and projects.status=1 " . $txtdiscipline . $txttype.$txtdate;

    } else {
        $txtsearchby1 = '';
        if ($txtsearchby == 'Project Name') {
            $txtsearchby = "and projects.title like '%" . $txttosearch . "%'";
            $txtsearchby1 = "and projects.title like '%" . $txttosearch . "%'";
        } else if ($txtsearchby == 'Student') {
            $txtsearchby = "and student.fname like '%" . $txttosearch . "%' or student.lname LIKE '%" . $txttosearch . "%';";
            $txtsearchby1 = "and supervisor.fname like '%" . $txttosearch . "%' or supervisor.lname LIKE '%" . $txttosearch . "%';";
        } else if ($txtsearchby == 'Supervisor') {
            $txtsearchby = "and projects.supervisor like '%" . $txttosearch . "%' ";
            $txtsearchby1 = "and projects.supervisor like '%" . $txttosearch . "%' ";
        }
        $sql = "SELECT * FROM `projects` inner join student ON projects.studentid=student.id where projects.approve=1 and projects.status=1 " . $txtdiscipline . $txttype . $txtsearchby;
        $sql1 = "SELECT * FROM `projects` inner join supervisor ON projects.supervisorId=supervisor.id where projects.approve=1 and projects.status=1 " . $txtdiscipline . $txttype . $txtsearchby1;

    }
    $txttosearch = $_POST['txtsearch'];
    $txtsearchby = $_POST['searchby'];

    $txtdiscipline = $_POST['discipline'];
    $txttype = $_POST['type'];
}
include 'connection.php';
include 'header.php';
?>
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Spacer -->
<div class="margin-top-90"></div>
<!-- Spacer / End-->

<!-- Page Content
================================================== -->
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4">

            <form action="/searchprojects.php" method="post">
                <div class="sidebar-container">

                    <!-- Search Field -->
                    <div class="sidebar-widget">
                        <label for="autocomplete-input" class="field-title ripple-effect">Project
                            Name</label>
                        <div class="input-with-icon">
                            <input id="autocomplete-input" name="txtsearch" type="text" placeholder="Name">
                            <i class="icon-material-outline-search"></i>
                        </div>
                    </div>

                    <!-- Search Field -->
                    <div class="sidebar-widget">
                        <label for="intro-keywords" class="field-title ripple-effect">Type</label>
                        <select class="selectpicker default" name="type" title="Project Type">
                            <option <?php if (isset($txttype) && $txttype == 'ALL')
                                echo 'selected'; ?> value='ALL'> All
                            </option>
                            <option <?php if (isset($txttype) && $txttype == 'On Going')
                                echo 'selected'; ?>
                                value='On Going'> On Going </option>
                            <option <?php if (isset($txttype) && $txttype == 'Completed')
                                echo 'selected'; ?>
                                value='Completed'> Completed </option>
                            <option <?php if (isset($txttype) && $txttype == 'Dropped')
                                echo 'selected'; ?>
                                value='Dropped'> Dropped </option>

                        </select>
                    </div>
                    
                    
                      <!-- Search Field -->
                    <div class="sidebar-widget">
                        <label for="intro-keywords" class="field-title ripple-effect">Year</label>
                        <select class="selectpicker default" name="year" title="Project Year">
                            <option <?php if (isset($txtdate) && $txtdate == 'ALL')
                                echo 'selected'; ?> value='ALL'> All
                            </option>
                            <option <?php if (isset($txtdate) && $txtdate == '2020')
                                echo 'selected'; ?>
                                value='2020'> 2020 </option>
                            <option <?php if (isset($txtdate) && $txtdate == '2021')
                                echo 'selected'; ?>
                                value='2021'> 2021 </option>
                            <option <?php if (isset($txtdate) && $txtdate == '2023')
                                echo 'selected'; ?>
                                value='2023'> 2023 </option>

                        </select>
                    </div>

                    <!-- Search Field -->
                    <div class="sidebar-widget">
                        <label for="intro-keywords" class="field-title ripple-effect">Discipline</label>
                        <select class="selectpicker" name="discipline" title="discipline">
                            <option <?php if (isset($txtdiscipline) && $txtdiscipline == 'ALL')
                                echo 'selected'; ?>
                                value='ALL'>All </option>
                            <option <?php if (isset($txtdiscipline) && $txtdiscipline == 'Engineering')
                                echo 'selected'; ?>
                                value='Engineering'>Engineering</option>
                            <option <?php if (isset($txtdiscipline) && $txtdiscipline == 'Non engineering')
                                echo 'selected'; ?> value='Non engineering'>Non engineering </option>


                        </select>
                    </div>

                    <!-- Search Field -->
                    <div class="sidebar-widget">
                        <label for="intro-keywords" class="field-title ripple-effect">Search By</label>
                        <select class="selectpicker default" name="searchby" title="Search by">
                            <option <?php if (isset($txtsearchby) && $txtsearchby == 'Project Name')
                                echo 'selected'; ?>>
                                Project Name</option>
                            <option <?php if (isset($txtsearchby) && $txtsearchby == 'Student')
                                echo 'selected="true"'; ?>>
                                Student</option>
                            <option <?php if (isset($txtsearchby) && $txtsearchby == 'Supervisor')
                                echo 'selected'; ?>>
                                Supervisor</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <div class="sidebar-widget">
                        <button class="button ripple-effect"
                            onclick="window.location.href='freelancers-grid-layout-full-page.html'">Search</button>
                    </div>

                </div>
        </div>
        </form>
        <div class="col-xl-9 col-lg-8 content-left-offset">

            <h3 class="page-title">Search Results</h3>

            <!-- Tasks Container -->
            <div class="tasks-list-container compact-list margin-top-35">

                <?php

                $result = $con->query($sql);

                $count = 0;
                if ($result->num_rows > 0) {


                    // output data of each row
                

                    while ($row = $result->fetch_assoc()) {
                        $count++;
                        echo " <a href=\"viewprjuserall.php?prjid='" . $row['pid'] . "'&prjnm='" . urlencode($row['title']) . "'\" class=\"task-listing\">

                                <!-- Job Listing Details -->
                                <div class=\"task-listing-details\">

                                    <!-- Details -->
                                    <div class=\"task-listing-description\">
                                        <h3 class=\"task-listing-title\">" . $row['title'] . "</h3>
                                        <ul class=\"task-icons\">
                                            <li><i class=\"icon-feather-user\"></i>" . $row['fname'] . ' ' . $row['lname'] . "</li>
                                            <li><i class=\"icon-material-outline-access-time\"></i>" . $row['dateadded'] . "</li>
                                            <li><i class=\"icon-line-awesome-user-secret\"></i>" . $row['supervisor'] . "</li>
                                        </ul>
                                        <div class=\"task-tags margin-top-15\">
                                            <span>University: " . $row['university'] . "</span>
                                            <span>" . $row['discipline'] . "</span>
                                        </div>
                                    </div>

                                </div>

                                <div class=\"task-listing-bid\">
                                    <div class=\"task-listing-bid-inner\">
                                        <div class=\"task-offers\">
                                            <strong>" . $row['type'] . "</strong>
                                        </div>
                                        <span class=\"button button-sliding-icon ripple-effect\">View<i
                                                class=\"icon-material-outline-arrow-right-alt\"></i></span>
                                    </div>
                                </div>
                            </a>";
                    }
                }
                $result = $con->query($sql1) or die($con->error);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $count++;
                        echo " <a href=\"viewprjuserall.php?supervisorprj=" . $row['pid'] . "&prjid=" . $row['pid'] . "&prjnm=" . urlencode($row['title']) . "'\" class=\"task-listing\">
                  

    <!-- Job Listing Details -->
    <div class=\"task-listing-details\">

        <!-- Details -->
        <div class=\"task-listing-description\">
            <h3 class=\"task-listing-title\">" . $row['title'] . "</h3>
            <ul class=\"task-icons\">
                <li><i class=\"icon-feather-user\"></i>" . $row['fname'] . ' ' . $row['lname'] . "</li>
                <li><i class=\"icon-material-outline-access-time\"></i>" . $row['dateadded'] . "</li>
                <li><i class=\"icon-line-awesome-user-secret\"></i>Self</li>
            </ul>
            <div class=\"task-tags margin-top-15\">
                <span>University: " . $row['university'] . "</span>
                <span>" . $row['discipline'] . "</span>
            </div>
        </div>

    </div>

    <div class=\"task-listing-bid\">
        <div class=\"task-listing-bid-inner\">
            <div class=\"task-offers\">
                <strong>" . $row['type'] . "</strong>
            </div>
            <span class=\"button button-sliding-icon ripple-effect\">View<i
                    class=\"icon-material-outline-arrow-right-alt\"></i></span>
        </div>
    </div>
</a>";
                    }

                }


                if ($count == 0) {
                    echo 'No Project Found!';

                }

                ?>
            </div>
            <!-- Tasks Container / End -->



        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
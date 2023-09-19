<?php
include 'connection.php';
$completed = ($result = $con->query("SELECT COUNT(*) AS count FROM `projects` WHERE type='Completed'")) ? $result->fetch_assoc()['count'] : "Error executing query: " . $con->error;
$ongoing = ($result = $con->query("SELECT COUNT(*) AS count FROM `projects` WHERE type='On Going'")) ? $result->fetch_assoc()['count'] : "Error executing query: " . $con->error;
$users = ($result = $con->query("SELECT COUNT(*) AS count FROM (SELECT id FROM student WHERE approve=1 UNION SELECT id FROM supervisor WHERE approve=1) AS combined_result")) ? $result->fetch_assoc()['count'] : "Error executing query: " . $con->error;
$studentprojects = $con->query("SELECT * FROM `projects` INNER JOIN `student` ON `projects`.`studentid` = `student`.`id` WHERE `projects`.`approve` = 1 AND `projects`.`status` = 1 ORDER BY `projects`.`dateadded` DESC LIMIT 3");
$supervisorprojects = $con->query("SELECT * FROM `projects` inner join supervisor ON projects.supervisorId=supervisor.id where projects.approve=1 and projects.status=1  ORDER BY `projects`.`dateadded` DESC LIMIT 3");
include 'header.php';
?>
<!-- Intro Banner -->
        <div class="intro-banner dark-overlay" data-background-image="images/home-background-02.jpg">

            <!-- Transparent Header Spacer -->
            <div class="transparent-header-spacer"></div>

            <div class="container">

                <!-- Intro Headline -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-headline">
                            <h3>
                                <strong>Pioneering Solutions for Tomorrow's Challenges</strong>
                                <br>
                                <span>FYP Innovations Hub: Where Ideas Transform into Impact</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <form action="/searchprojects.php" method="post">
                <!-- Search Bar -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="intro-banner-search-form margin-top-95">

                            
                                <!-- Search Field -->
                                <div class="intro-search-field with-autocomplete">
                                    <label for="autocomplete-input"  class="field-title ripple-effect">Project
                                        Name</label>
                                    <div class="input-with-icon">
                                        <input id="autocomplete-input" name="txtsearch" type="text" placeholder="Name">
                                        <i class="icon-material-outline-search"></i>
                                    </div>
                                </div>

                                <!-- Search Field -->
                                <div class="intro-search-field">
                                    <label for="intro-keywords"  class="field-title ripple-effect">Type</label>
                                    <select class="selectpicker default" name="type"  title="Project Type">
                                        <option value='ALL'> All </option>
                                        <option value='On Going'> On Going </option>
                                        <option value='Completed'> Completed </option>
                                        <option value='Dropped'> Dropped </option>
                                    </select>
                                </div>
                                
                                
                                 <!-- Search Field -->
                                <div class="intro-search-field">
                                    <label for="intro-keywords"  class="field-title ripple-effect">Year</label>
                                    <select class="selectpicker default" name="year"  title="Project Year">
                                        <option value='ALL'> All </option>
                                        <option value='2020'> 2020 </option>
                                        <option value='2021'> 2021 </option>
                                        <option value='2023'> 2023 </option>
                                    </select>
                                </div>


                                <!-- Search Field -->
                                <div class="intro-search-field">
                                    <label for="intro-keywords"  class="field-title ripple-effect">Discipline</label>
                                    <select class="selectpicker default" name="discipline" title="discipline">
                                        <option value='ALL'>All </option>
                                        <option value='Engineering'>Engineering</option>
                                        <option value='Non engineering'>Non engineering </option>


                                    </select>
                                </div>

                                <!-- Search Field -->
                                <div class="intro-search-field">
                                    <label for="intro-keywords" class="field-title ripple-effect">Search By</label>
                                    <select class="selectpicker default"   name="searchby" title="Search by">
                                        <option value='Project Name'>Project Name</option>
                                        <option value='Student'>Student</option>
                                        <option value='Supervisor'>Supervisor</option>
                                    </select>
                                </div>

                                <!-- Button -->
                                <div class="intro-search-button">
                                    <button class="button ripple-effect"
                                        onclick="window.location.href='freelancers-grid-layout-full-page.html'">Search</button>
                                </div>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>


        <!-- Content -->
        <!-- Icon Boxes -->
        <div class="section padding-top-65 padding-bottom-65">
            <div class="container">
                <div class="row">

                    <div class="col-xl-12">
                        <!-- Section Headline -->
                        <div class="section-headline centered margin-top-0 margin-bottom-5">
                            <h3>How It Works?</h3>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4">
                        <!-- Icon Box -->
                        <div class="icon-box with-line">
                            <!-- Icon -->
                            <div class="icon-box-circle">
                                <div class="icon-box-circle-inner">
                                    <i class="icon-line-awesome-lock"></i>
                                    <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                                </div>
                            </div>
                            <h3>Create an Account</h3>
                            <p>Bring to the table win-win survival strategies to ensure proactive domination going
                                forward.</p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4">
                        <!-- Icon Box -->
                        <div class="icon-box with-line">
                            <!-- Icon -->
                            <div class="icon-box-circle">
                                <div class="icon-box-circle-inner">
                                    <i class="icon-line-awesome-legal"></i>
                                    <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                                </div>
                            </div>
                            <h3>Post a Task</h3>
                            <p>Efficiently unleash cross-media information without. Quickly maximize return on
                                investment.</p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-4">
                        <!-- Icon Box -->
                        <div class="icon-box">
                            <!-- Icon -->
                            <div class="icon-box-circle">
                                <div class="icon-box-circle-inner">
                                    <i class=" icon-line-awesome-trophy"></i>
                                    <div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
                                </div>
                            </div>
                            <h3>Choose an Expert</h3>
                            <p>Nanotechnology immersion along the information highway will close the loop on focusing
                                solely.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Icon Boxes / End -->




        <!-- Features Jobs -->
        <div class="section gray margin-top-45 padding-top-65 padding-bottom-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">

                        <!-- Section Headline -->
                        <div class="section-headline margin-top-0 margin-bottom-35">
                            <h3>Recent Projects</h3>
                            <a href="searchprojects.php" class="headline-link">Browse All Tasks</a>
                        </div>

                        <!-- Jobs Container -->
                        <div class="tasks-list-container compact-list margin-top-35">
                            <?php
                            if ($studentprojects->num_rows > 0) {
                                while ($row = $studentprojects->fetch_assoc()) {


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
                            } else {
                                $p = NULL;
                            }

                            if ($supervisorprojects->num_rows > 0) {
                                while ($row = $supervisorprojects->fetch_assoc()) {


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
                            } else {
                                $p = NULL;
                                echo "No projects found.";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featured Jobs / End -->

        <!-- Counters -->
        <div class="section padding-top-70 padding-bottom-75">
            <div class="container">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="counters-container">

                            <!-- Counter -->
                            <div class="single-counter">
                                <i class="icon-line-awesome-suitcase"></i>
                                <div class="counter-inner">
                                    <h3><span class="counter">
                                            <?php
                                            echo $completed
                                                ?>
                                        </span></h3>
                                    <span class="counter-title">Completed</span>
                                </div>
                            </div>

                            <!-- Counter -->
                            <div class="single-counter">
                                <i class="icon-line-awesome-cogs"></i>
                                <div class="counter-inner">
                                    <h3><span class="counter">
                                            <?php
                                            echo $ongoing;
                                            ?>
                                        </span></h3>
                                    <span class="counter-title">On Going</span>
                                </div>
                            </div>

                            <!-- Counter -->
                            <div class="single-counter">
                                <i class="icon-line-awesome-users"></i>
                                <div class="counter-inner">
                                    <h3><span class="counter">
                                            <?php
                                            echo $users;
                                            ?>
                                        </span></h3>
                                    <span class="counter-title">Total Users</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Counters / End -->
        <?php
include 'footer.php';
?>
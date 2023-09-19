<?php
include 'header.php';
include '../connection.php';
?>
<div class="tabs">
    <div class="tabs-header">
        <ul>
            <li class="active"><a href="#std" data-tab-id="std">Student</a></li>
            <li><a href="#super" data-tab-id="super">Supervisor</a></li>
        </ul>
        <div class="tab-hover"></div>
    </div>

    <div class="tabs-content">
        <div class="tab active" data-tab-id="std">
            <form method="post" id="std_message">
                <div class="col-xl-2">
                    <div class="submit-field">
                        <h5>Select Student</h5>
                        <select class="selectpicker with-border" name="student_id" data-size="7" title="Students">
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
                <div class="col-xl-6">
                    <div class="submit-field">
                        <h5>Message</h5>
                        <textarea class="with-border" name="my_message" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-xl-12">

                    <button type="submit" style='color:white' name="submit"
                        class="button ripple-effect big margin-top-30">Send</button>
            </form>
        </div>
    </div>
    <div class="tab" data-tab-id="super">
        <form method="post" id="super_message">
            <div class="col-xl-2">
                <div class="submit-field">
                    <h5>Select Supervisor</h5>
                    <select class="selectpicker with-border" name="teacher_id" data-size="7" title="Supervisor">
                        <?php
                        $query = mysqli_query($con, "select * from supervisor where approve=1 order by fname ASC ");
                        while ($row = mysqli_fetch_array($query)) {

                            ?>

                            <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?>
                            </option>

                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="submit-field">
                    <h5>Message</h5>
                    <textarea class="with-border" name="my_message" rows="4"></textarea>
                </div>
            </div>
            <div class="col-xl-12">

                <button type="submit" style='color:white' name="submit"
                    class="button ripple-effect big margin-top-30">Send</button>
        </form>
    </div>
</div>
</div>
</div>

</div>
<?php
include 'footer.php';
?>
<script>
    jQuery(document).ready(function () {
        jQuery("#super_message").submit(function (e) {

            e.preventDefault();
            var formData = jQuery(this).serialize();
            $.ajax({
                type: "POST",
                url: "send_message_student.php",
                data: formData,
                success: function (html) {

                    alert("Message Successfully Sended");

                    jQuery("#send_message").trigger('reset');
                }


            });
            return false;
        });
    });
    jQuery(document).ready(function () {
        jQuery("#std_message").submit(function (e) {

            e.preventDefault();
            var formData = jQuery(this).serialize();
            $.ajax({
                type: "POST",
                url: "send_message_student_to_student.php",
                data: formData,
                success: function (html) {

                    alert("Message Successfully Sended");

                    jQuery("#send_message").trigger('reset');
                }


            });
            return false;
        });
    });
</script>
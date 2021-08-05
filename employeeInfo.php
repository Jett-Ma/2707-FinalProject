<?php
require_once "./service.php";
require_once "./verification.php";
?>
<?php
$email = $_SESSION['email'];
if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $introduction = $_POST['introduction'];
    $learnExperience = $_POST['learnExperience'];
    $workExperience = $_POST['workExperience'];
    $resumeUrl = "";


    if (!empty($_FILES["file"]["name"])) {
        $name = explode(".", $_FILES["file"]["name"]);

        $type = end($name);
        if ((($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "application/msword")
                || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 10240000)
        )   
        {

            $resumeUrl = rand(0, 999999) . time() .".".$type;

            move_uploaded_file($_FILES["file"]["tmp_name"], "./resume/" . $resumeUrl);
        }else{
            echo "<script>alert('File Farta error');history.back(-1)</script>";

            exit();  
        }
    }

    $sql = "update employee set `firstname` = '$firstname',`lastname` = '$lastname',
    `phone` = '$phone',`address` = '$address',`introduction` = '$introduction',
    `learnExperience` = '$learnExperience',`workExperience` = '$workExperience',
    `resumeUrl` = '$resumeUrl' where email = '$email'";
    $query = updateMethod($sql, $db);
    if ($query) {
        echo "<script>alert('Update successfully!')</script>";
    } else {
        var_dump(mysqli_error($db));
        exit();
        echo "<script>alert('Database error');history.back(-1)</script>";

        exit();
    }
}

$sql = "select * from employee where email = '$email'";
$result = selectMethod($sql, $db);
if (count($result) > 0) {
} else {
    exit("Error");
}
?>
<?php require_once "./header.php"; ?>
<?php require_once "./nav.php"; ?>
<div class="page-header">
  <h1>My Information <small>Edit information</small></h1>
</div>
<fieldset>
    <legend>Basic Infomation</legend>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['firstname'] ?>" required placeholder="First Name" name="firstname">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['lastname'] ?>" required placeholder="Last Name" name="lastname">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['phone'] ?>" required placeholder="Company Phone" name="phone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['address'] ?>" placeholder="Address" name="address">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Resume Link <?php
                    if ($result[0]['resumeUrl'] != "") {
                        $resumeUrl = $result[0]['resumeUrl'];
                        echo "<a href='./resume/" . $resumeUrl . "'>My ResumeUrl</a>";
                    }
                    ?></label>
                    <input type="file" class="form-control" placeholder="ResumeUrl Link" name="file">
                    
                </div>
            </div>

        </div>



        <fieldset>
            <legend>Expand Infomation</legend>
            <div class="form-group">
                <label for="">Learning Experience</label>
                <textarea type="text" class="form-control" value="" placeholder="Learning Experience" name="learnExperience"><?php echo $result[0]['learnExperience'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Working Experience</label>
                <textarea type="text" class="form-control" value="" placeholder="Working Experience" name="workExperience"><?php echo $result[0]['workExperience'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Introduction</label>
                <textarea type="text" class="form-control" value="" placeholder="Introduction" name="introduction"><?php echo $result[0]['introduction'] ?></textarea>
            </div>
        </fieldset>
        <div class="form-group">
            <button class="btn btn-primary" name="update">Update</button>
        </div>
    </form>
</fieldset>

<?php
require_once "footer.php";
?>
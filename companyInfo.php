<?php
require_once "./service.php";
require_once "./verification.php";
?>
<?php
$email = $_SESSION['email'];
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $contact = $_POST['contact'];
    $introduction = $_POST['introduction'];
    $description = $_POST['description'];
    $officialWebsiteUrl = $_POST['officialWebsiteUrl'];
    $qualifications = $_POST['qualifications'];
    $sql = "update company set `name` = '$name',`address` = '$address',`phone` = '$phone',`contact` = '$contact',`introduction` = '$introduction',`description` = '$description',`officialWebsiteUrl` = '$officialWebsiteUrl',
    `qualifications` = '$qualifications' where email = '$email'";
    $query = updateMethod($sql,$db);
    if($query){
        echo "<script>alert('Update successfully!')</script>";
        
    }else{
        var_dump(mysqli_error($db));
        exit();
        echo "<script>alert('Database error');history.back(-1)</script>";

        exit();
    }
}

$sql = "select * from company where email = '$email'";
$result = selectMethod($sql,$db);
if(count($result) > 0){
    
}else{
    exit("Error");
}
?>
<?php require_once "./header.php"; ?>
<?php require_once "./nav.php"; ?>
<div class="page-header">
  <h1>My Company Information <small>Edit information</small></h1>
</div>
<fieldset>
    <legend>Company Basic Infomation</legend>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['name']?>" required placeholder="Company Name" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Company Address</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['address']?>" required placeholder="Company Address" name="address">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Company Contact</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['contact']?>" required placeholder="Company Contact" name="contact">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Company Phone</label>
                    <input type="text" class="form-control"  value="<?php echo $result[0]['phone']?>" required placeholder="Company Phone" name="phone">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Official Website Link</label>
                    <input type="text" class="form-control" value="<?php echo $result[0]['officialWebsiteUrl']?>" placeholder="Company Official Website Link" name="officialWebsiteUrl">
                </div>
            </div>

        </div>



        <fieldset>
            <legend>Company Expand Infomation</legend>
            <div class="form-group">
                <label for="">Company Quaifications</label>
                <textarea type="text" class="form-control" value="" placeholder="Company Qualifications" name="qualifications"><?php echo $result[0]['qualifications']?></textarea>
            </div>
            <div class="form-group">
                <label for="">Company Description</label>
                <textarea type="text" class="form-control" value="" placeholder="Company Description" name="description"><?php echo $result[0]['description']?></textarea>
            </div>
            <div class="form-group">
                <label for="">Company Introduction</label>
                <textarea type="text" class="form-control" value="" placeholder="Company Introduction" name="introduction"><?php echo $result[0]['introduction']?></textarea>
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
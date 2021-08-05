<?php
require_once "./service.php";
require_once "./verification.php";
?>
<?php
$email = $_SESSION['email'];
if(isset($_POST['post'])){
    $title = $_POST['title'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $time = date("Y-m-d H:s:i",time());
    $deadline = $_POST['deadline'];
    $deadline = $deadline . " 23:59:59";
    $sql = "insert applyjob(`title`,`category`,`type`,`description`,`salary`,`time`,`deadline`,`email`) values 
    ('$title','$category','$type','$description','$salary','$time','$deadline','$email')";
    $query = insertMethod($sql,$db);
    if($query){
        echo "<script>alert('Post successfully!');window.location.href='./posts.php'</script>";
        exit();
    }else{
        var_dump(mysqli_error($db));
        exit();
        echo "<script>alert('Database error');history.back(-1)</script>";
        exit();
        
    }
}

?>
<?php require_once "./header.php"; ?>
<?php require_once "./nav.php"; ?>
<div class="page-header">
  <h1>Post A Job <small>Find teamates</small></h1>
</div>
<fieldset>
    <legend>Job Information</legend>
    <form action="" method="POST">
    <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Job Title*</label>
                    <input type="text" class="form-control" required placeholder="Job Title" name="title">
                </div>
            </div>
            
        </div>
        <div class="row">
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Category*</label>
                    <select class="form-control" required name="category" id="" required>
                        <option value="">Job Category</option>
                        <option value="UX/UI Designer">UX/UI Designer</option>
                        <option value="Web Developer">Web Developer</option>
                        <option value="Web Designer">Web Designer</option>
                        <option value="Software Developer">Software Developer</option>
                        <option value="SEO">SEO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Job Types*</label>
                    
                    <select name="type" class="form-control" id="" required>
                        <option value="">Job Type</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                        <option value="Office">Office</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Salary Currency -->

        <div class="row">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="">Salary Currency</label>
                    <input type="text" class="form-control" required placeholder="Job Salary" name="salary">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Application Deadline*</label>
                    <input type="date" class="form-control"  required placeholder="Deadline" name="deadline">
                </div>
            </div>
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Job Description*</label>
                <textarea type="text" class="form-control" value="" placeholder="Job Description" required name="description"></textarea>
            </div>
            </div>
        </div>

        
        <div class="form-group">
            <button class="btn btn-primary" name="post">Post</button>
        </div>
    </form>
</fieldset>

<?php
require_once "footer.php";
?>
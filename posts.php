<?php
    require_once "./service.php";
    require_once "./verification.php";
    completeInfo($db);
?>
<?php
$email = $_SESSION['email'];
if(isset($_POST['audit'])){
    $employeeID = $_POST['email'];
    $audit = $_POST['audit'];
    $jobID = $_POST['jobID'];
    if($audit == 'pass'){
        $sql = "update application set status = 'pass' where `employeeID` = '$employeeID' and `jobID` = '$jobID'";
    }else{
        $sql = "update application set status = 'fail' where `employeeID` = '$employeeID' and `jobID` = '$jobID'";
    }
    $query = updateMethod($sql,$db);
    if($query){
        echo "<script>alert('Audit succeeded');history.back(-1)</script>";
        exit();
    }
}

if(isset($_POST['cancel'])){
    $jobID = $_POST['cancelJobID'];
    $sql = "delete from applyjob where id = '$jobID' and email = '$eamil'";
    $query = mysqli_query($db,$sql);
    $sql = "delete from application where jobID = '$jobID'";
    $query = mysqli_query($db,$sql);
    echo "<script>alert('Audit succeeded');window.location.href='./posts.php'</script>";
        exit();
}



    $sql = "select *,a.description as jobDescription,a.id as jobID from applyjob a join company b on a.email = b.email where a.email = '$email'";
    $result = selectMethod($sql,$db);
    $applications = array();
    foreach($result as $k=>$row){
        $id = $row["jobID"];
        $sql = "select * from application where jobID = '$id'";
        $count = count(selectMethod($sql,$db));
        $result[$k]['count'] = $count;
    }
    if(isset($_REQUEST['getApplicationsJobID'])){
        $id = $_REQUEST["getApplicationsJobID"];
        $sql = "select * from application a join employee b on a.employeeID = b.email where a.jobID = '$id'";
        $applications = selectMethod($sql,$db);
        
    }
?>
<?php require_once "./header.php";?>
<?php require_once "./nav.php";?>
<div class="page-header">
  <h1>My Posts <small>Job List</small></h1>
</div>
<div class="row">
<div class="col-md-8">
        <?php
       
        if(count($result) > 0){
            foreach($result as $row){
                $jobID = $row['jobID'];
                echo '<div class="card" style="margin-bottom:15px;border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                <div class="card-body">
                    <h3 class="card-title">'.$row['title'].'</h3>
                    <h5 class="card-subtitle mb-2 text-muted">Category:'.$row['category'].' Type:'.$row['type'].' Salary:'.$row['salary'].'</h5>
                    <h5 class="card-subtitle mb-2 text-muted">Deadline:'.$row['deadline'].'</h5>
                    <p class="card-text">'.$row['jobDescription'].'</p>
                    
                    <p>'.$row['count'].' applications</p>
                    <a href="./posts.php?getApplicationsJobID='.$jobID.'" class="card-link"><button class="btn btn-primary">Get Employee Infomation</button></a>
                    <form action="" style="float:right" method="POST">
                    <input type="hidden" name="cancelJobID" value="'.$jobID.'">   
                        <a href="#"  class="card-link"><button name="cancel" class="btn btn-danger">Cancel</button></a>
                    </form>
                </div>
            </div>';
            }
        }else{
            echo "<h2 style='text-align:center;color:rgb(149,149,149)'>You have not post a job !</h2>";
        }
   
            
        ?>
        
    </div>
    <div class="col-md-4">
        <?php
            if(count($applications) > 0){
                foreach($applications as $row){
                    echo '<div class="card" style="border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    <div class="card-body">
                        <h3 class="card-title">'.$row['firstname'].' '.$row['lastname'].'</h3>
                        <h5 class="card-subtitle mb-2 text-muted">Status:'.$row['status'].'</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Email:'.$row['email'].'</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Phone:'.$row['phone'].'</h5>
                        <h5 class="card-subtitle mb-2 text-muted"><a href="./resume/'.$row['resumeUrl'].'">Resume</a></h5>
                        <p class="card-text">Introduction:'.$row['introduction'].'</p>
                        <p class="card-text">Learn experience:'.$row['learnExperience'].'</p>
                        <p class="card-text">Work experience:'.$row['workExperience'].'</p>
                        <form action="" method="POST">
                            <input type="hidden" name="email" value="'.$row['email'].'">
                            <input type="hidden" name="jobID" value="'.$row['jobID'].'">
                            <a href="#" class="card-link"><button name="audit" value="pass" class="btn btn-success">Pass</button></a>
                            <a href="#" class="card-link"><button name="audit" value="fail" class="btn btn-danger">Fail</button></a>
                            
                        </form>
                    </div>
                </div>
            </div>';
                }
            }else{
                    
                echo '<div class="card" style="border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    <h3 style="text-align:center">No applications !</h3>
                </div>';
            }
        ?>
    
</div>

<?php
    require_once "footer.php";
?>
<?php
require_once "./service.php";
require_once "./verification.php";
completeInfo($db);
?>
<?php
    $email = $_SESSION['email'];
    if(isset($_POST['cancel'])){
        $jobID = $_POST['jobID'];
        $sql = "delete from application where `jobID` = '$jobID' and `employeeID` = '$email'";
        $query = mysqli_query($db,$sql);
        if($query){
            echo "<script>alert('You have successfully cancelled the position application');history.back(-1)</script>";
            exit();
        }
    }
    
    $sql = "select *,a.id as jobID,b.companyID as companyEmail from applyjob a join application b on a.id = b.jobID where b.employeeID = '$email'";
    $result = selectMethod($sql,$db);
    $company = array();
    if(isset($_REQUEST['companyID'])){
        $companyID = $_REQUEST['companyID'];
        $sql = "select * from company where email = '$companyID'";
        $company = selectMethod($sql,$db);
    }
?>
<?php require_once "./header.php"; ?>
<?php require_once "./nav.php"; ?>
<div class="page-header">
    <h1>My Application<small> Join teams</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <?php
            if(count($result) > 0){
                foreach($result as $row){
                    echo '<div class="card" style="margin-bottom:15px;border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    <div class="card-body">
                        <h3 class="card-title">'.$row['title'].'</h3>
                        <h5 class="card-subtitle mb-2 text-muted">Category:'.$row['category'].' Type:'.$result[0]['type'].' Salary:'.$result[0]['salary'].'</h5>
                        <p class="card-text">Status:'.$row['status'].'</p>
                        <form action="" method="POST">
                        <input type="hidden" value="'.$row['jobID'].'" name="jobID">
                        
                        <a href="./application.php?companyID='.$row['companyEmail'].'" class="card-link"><button type="button" class="btn btn-primary">Get Company Info</button></a>
                        <a href="#" class="card-link"><button name="cancel" class="btn btn-danger">Cancel</button></a>
                        
                        
                        </form>
                    </div>
                </div>';
                }
                
            }else{
                echo "<h2 style='text-align:center;color:rgb(149,149,149)'>No Applications !</h2>";
            }
        ?>
        
    </div>
    <div class="col-md-4">
    <?php   
            
            if(count($company) > 0){
                foreach($company as $row){
                    echo '<div class="card" style="border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    
                    <div class="card-header"> <h3>Company Information !</h3></div>
                    <div class="card-body">
                        <h3 class="card-title">'.$row['name'].'</h3>
                        <h5 class="card-subtitle mb-2 text-muted">Email:'.$row['email'].'</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Phone:'.$row['phone'].'</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Address:'.$row['address'].'</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Official Web Link:<a href="'.$row['officialWebsiteUrl'].'">'.$row['officialWebsiteUrl'].'</a></h5>
                        <p class="card-text">Description:'.$row['description'].'</p>
                        <p class="card-text">Intrpduction:'.$row['introduction'].'</p>
                        <p class="card-text">Qualifications:'.$row['qualifications'].'</p>
                        
                    </div>
                </div>
            </div>';
                }
            }else{
                    
                echo '<div class="card" style="border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    <h3 style="text-align:center">Company Information !</h3>
                </div>';
            }
        ?>
    </div>
</div>

<?php
require_once "footer.php";
?>
<!-- <div class="nav" style="">
        
</div> -->
<style>
    .navItem a{
        padding:15px 30px 15px 30px;
        font-size:20px;
        background:rgb(243,243,243);
        border-radius: 10px;
        color:rgb(78,78,78)
    }
    .navItem a:hover{
        
        background:rgb(233,233,233);
        
    }
</style>
<?php
    $role = $_SESSION['role'];
    $email = $_SESSION['email'];
    if($role == "company"){
        echo '<div class="nav" style="width:100%;display:flex;justify-content:space-between;align-items:center">
        <div style="text-align:left;">
            <a><img style="text-align:left" width="80" src="./images/logo.png" alt=""></a>
        </div>
        <div class="navItem" style="flex:1;text-align:center">
            <a href="./applyJob.php">Post A Job</a>
            <a href="./posts.php">My Posts</a>
            
        </div>
        <div style="display:flex">
        <a style="margin-right:9px" href="./companyInfo.php"><button class="btn btn-primary">'.$email.'</button></a>
        <a  href="./logout.php"><button class="btn">Logout</button></a>
        </div>
    </div>';
    }else{
        echo '<div class="nav" style="width:100%;display:flex;justify-content:space-between;align-items:center">
        <div style="text-align:left;">
            <img style="text-align:left" width="80" src="./images/logo.png" alt="">
        </div>
        <div class="navItem" style="flex:1;text-align:center">
            <a href="./employeeIndex.php">Look For Jobs</a>
            <a href="./application.php">My Application</a>
            
        </div>
        <div style="display:flex">
            <a style="margin-right:9px" href="./employeeInfo.php"><button class="btn btn-primary">'.$email.'</button></a>

            <a  href="./logout.php"><button class="btn">Logout</button></a>
        </div>
    </div>';
        
    }
?>

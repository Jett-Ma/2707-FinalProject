<?php
    require_once "./service.php";
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $role = $_POST['role'];
        if($password != $repassword){
            echo "<script>alert('Password diffThe passwords entered twice are inconsistent. Please check and try again');
            history.back(-1)</script>";
            exit();
        }else{

            if($role == "company"){
                $sql = "select * from company where email = '$email'";
            }else{
                $sql = "select * from employee where email = '$email'";
            }

            $result = selectMethod($sql,$db);
            if(count($result) > 0){
                echo "<script>alert('Email exits. Please check and try again');
                history.back(-1)</script>";
                exit();
            }
            
            if($role == "company"){
                $sql = "insert into company(`email`,`password`) values ('$email','$password')";
            }else{
                $sql = "insert into employee(`email`,`password`) values ('$email','$password')";
            }
            $query = insertMethod($sql,$db);
            if($query){
                echo "<script>alert('Register successfully!');
                window.location.href='./login.php'</script>";
                exit();
            }else{
                echo "<script>alert('Database Error. Please check and try again');</script>";
                var_dump(mysqli_error($db));
                exit();
            }
        }
        
    }
?>
<?php require_once "./header.php";?>
<div class="page-header">
  <h1>Quick Register <small>create your account</small></h1>
</div>
    

   
    <div class="loginForm" style="display:flex;justify-content:center;">
        <div style="background:rgb(238,238,238);border-radius:8px;padding:30px 30px 20px;width:300px;">
            <form action="" method="POST">
                <label for="">Email Address</label>
                <input type="email" required class="form-control" style="margin-bottom:15px" placeholder="Email" name="email">
                <label for="">Password</label>
                <input type="password" required class="form-control" style="margin-bottom:15px" name="password" placeholder="Password">
                <label for="">Confirm Password</label>
                <input type="password" required style="margin-bottom:15px" class="form-control" style="margin-bottom:15px" name="repassword" placeholder="Password">
                <div><label for="">Role</label></div>
                <label for=""><input type="radio" checked class="" value="company" name="role">Company</label>
                <label for=""><input type="radio" class="" value="employee" name="role">Employee</label>
                <input type="submit" name="submit" class="btn btn-primary"  style="width:100%;margin-top:15px" value="Register">
                <a href="./login.php"><input type="button" name="login" class="btn btn-plain"  style="width:100%;margin-top:15px" value="Login"></a>
            </form>
        </div>
    </div>


</body>

</html>
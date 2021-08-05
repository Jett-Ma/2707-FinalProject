<?php
    require_once "./service.php";
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "select * from employee where email = '$email' and password = '$password'";
        $result = selectMethod($sql,$db);
        if(count($result) > 0){
            $role = 'employee';
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            echo "<script>alert('Login successfully!');
            window.location.href='./employeeIndex.php';</script>";
            exit();
        }else{
            $sql = "select * from company where email = '$email' and password = '$password'";
            $result = selectMethod($sql,$db);
            if(count($result) > 0){
                $role = 'company';
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                echo "<script>alert('Login successfully!');
                window.location.href='./posts.php';</script>";
                exit();
            }else{
                echo "<script>alert('The user name or password is incorrect. Please check and try again!');
                history.back(-1)</script>";
                exit();
            }
            
        }
    }
?>
<?php require_once "./header.php";?>

<div class="page-header">
  <h1>Login Page <small>login for better service</small></h1>
</div>
    
   
    
    <div class="loginForm" style="display:flex;justify-content:center;">
        <div style="background:rgb(238,238,238);border-radius:8px;padding:30px 30px 20px;width:300px;">
            <form action="" method="POST">
                <label for="">Email Address</label>
                <input type="email" class="form-control" required style="margin-bottom:15px" placeholder="Email" name="email">
                <label for="">Password</label>
                <input type="password" class="form-control" required name="password" placeholder="Password">
                <input type="submit" name="submit" class="btn btn-primary"  style="width:100%;margin-top:15px" value="Login">
                <a href="./register.php"><input type="button" name="logout" class="btn btn-plain"  style="width:100%;margin-top:15px" value="Register"></a>
            </form>
        </div>
    </div>


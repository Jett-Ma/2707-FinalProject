<?php
    session_start();
    $db = mysqli_connect("localhost","root","root123","join");
    function fillterMethod($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function selectMethod($sql,$db){
        $query = mysqli_query($db,$sql);
        $result = mysqli_fetch_all($query,1);
        return $result;
    }

    function updateMethod($sql,$db){
        $query = mysqli_query($db,$sql);
        if($query){
            return true;
        }else{
            return false;
        }
        
    }

    function insertMethod($sql,$db){
        $query = mysqli_query($db,$sql);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function deleteMethod($sql,$db){
        $query = mysqli_query($db,$sql);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function completeInfo($db){
        $role = $_SESSION['role'];
        $email = $_SESSION['email'];
        if($role == "company"){
            $sql = "select * from company where email = '$email'";
            $result = selectMethod($sql,$db);
            $name = $result[0]['name'];
            $address = $result[0]['address'];
            $phone = $result[0]['phone'];
            $contact = $result[0]['contact'];
            if($name == "" || $address=="" || $phone=="" || $contact==""){
                echo "<script>alert('The system detects that you have not improved the company information. In order to improve the credibility of the company, please improve the company information first');
                window.location.href='./companyInfo.php';</script>";
                exit();
                
            }
        }else{
            $sql = "select * from employee where email = '$email'";
            $result = selectMethod($sql,$db);
            $firstname = $result[0]['firstname'];
            $lastname = $result[0]['lastname'];
            $phone = $result[0]['phone'];
            if($firstname == "" || $lastname=="" || $phone==""){
                echo "<script>alert('The system detects that you have not improved the company information. In order to improve the credibility of the company, please improve the company information first');
                window.location.href='./employeeInfo.php';</script>";
                exit();
                
            }
        }
        
    }
?>
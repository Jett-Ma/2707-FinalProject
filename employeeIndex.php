<?php
require_once "./service.php";
require_once "./verification.php";
completeInfo($db);
?>
<?php
$email = $_SESSION['email'];
$name = isset($_POST['name']) ? $_POST['name'] : "";
$category = isset($_POST['name']) ? $_POST['category'] : "";
$type = isset($_POST['name']) ? $_POST['type'] : "";
$effectiveDate = isset($_POST['name']) ? $_POST['effectiveDate'] : "";
$salaryMin = isset($_POST['name']) ? $_POST['salaryMin'] : "";
$salaryMax = isset($_POST['name']) ? $_POST['salaryMax'] : "";
if (isset($_POST['search'])) {
    // $name = $_POST['name'];
    // $category = $_POST['category'];
    // $type = $_POST['type'];
    // $effectiveDate = $_POST['effectiveDate'];
    // $salaryMin = $_POST['salaryMin'];
    // $salaryMax = $_POST['salaryMax'];
    $where = " where 1 = 1";
    if ($name != "") {
        $where = $where . " and b.name like '%$name%'";
    }
    if ($category != "") {
        $where = $where . " and a.category = '$category'";
    }
    if ($type != "") {
        $where = $where . " and a.type = '$type'";
    }
    if ($salaryMin != "" && $salaryMax != "") {
        $where = $where . " and a.salary between '$salaryMin' and '$salaryMax'";
    } else {
        if ($salaryMin != "" && $salaryMax == "") {
            $where = $where . " and a.salary > '$salaryMin'";
        }
        if ($salaryMin == "" && $salaryMax != "") {
            $where = $where . " and a.salary < '$salaryMax'";
        }
    }

    if ($effectiveDate != "") {
        $where = $where . " and a.deadline > '$effectiveDate'";
    }
    $sql = "select *,b.email as companyEmail,a.id as jobID from applyjob a join company b on a.email = b.email" . $where;
    $result = selectMethod($sql, $db);
} else {
    $sql = "select *,b.email as companyEmail,a.id as jobID from applyjob a join company b on a.email = b.email";
    $result = selectMethod($sql, $db);

    if (isset($_POST['jobID'])) {
        $jobID = $_POST['jobID'];
        $companyEmail = $_POST['companyEmail'];
        $time = date("Y-m-d H:s:i", time());
        $sql = "select * from application where `jobID` = '$jobID' and `employeeID` = '$email'";
        $applicationResult = selectMethod($sql, $db);
        if (count($applicationResult) > 0) {
            echo "<script>alert('You have applied for the position!');history.back(-1)</script>";
            exit();
        } else {
            $sql = "insert into application(`employeeID`,`companyID`,`time`,`jobID`,`status`) 
                values ('$email','$companyEmail','$time','$jobID','review')";
            $query = insertMethod($sql, $db);
            if ($query) {
                echo "<script>alert('You have successfully applied to change your position. Please wait patiently for your reply !');window.location.href='./application.php'</script>";
                exit();
            }
        }
    }
}
$company = array();
if (isset($_REQUEST['companyID'])) {
    $companyID = $_REQUEST['companyID'];
    $sql = "select * from company where email = '$companyID'";
    $company = selectMethod($sql, $db);
}
?>
<?php require_once "./header.php"; ?>
<?php require_once "./nav.php"; ?>
<div class="page-header">
    <h1>Look For Job <small>Join teams</small></h1>
</div>
<form action="" method="POST">
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" value="<?php if (isset($name)) {
                                                                echo $name;
                                                            } else {
                                                                echo "";
                                                            } ?>" placeholder="Company Name" name="name">
        </div>
        <div class="col-md-4">
            <div class="form-group">

                <select class="form-control" name="category" id="">
                    <option value="">Job Category</option>
                    <option <?php if (isset($category)) {
                                if ($category == 'UX/UI Designer') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="UX/UI Designer">UX/UI Designer</option>
                    <option <?php if (isset($category)) {
                                if ($category == 'Web Developer') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Web Developer">Web Developer</option>
                    <option <?php if (isset($category)) {
                                if ($category == 'Full Time') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Web Designer">Web Designer</option>
                    <option <?php if (isset($category)) {
                                if ($category == 'Software Developer') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Software Developer">Software Developer</option>
                    <option <?php if (isset($category)) {
                                if ($category == 'SEO') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="SEO">SEO</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">


                <select name="type" class="form-control" id="">
                    <option value="">Job Type</option>
                    <option <?php if (isset($type)) {
                                if ($type == 'Full Time') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Full Time">Full Time</option>
                    <option <?php if (isset($type)) {
                                if ($type == 'Part Time') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Part Time">Part Time</option>
                    <option <?php if (isset($type)) {
                                if ($type == 'Contract') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Contract">Contract</option>
                    <option <?php if (isset($type)) {
                                if ($type == 'Internship') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Internship">Internship</option>
                    <option <?php if (isset($type)) {
                                if ($type == 'Office') {
                                    echo "selected";
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            } ?> value="Office">Office</option>
                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div>
                Salary
            </div>
            <div class="" style="display:flex;justify-content:space-between;align-items:center">
                <input type="text" class="form-control" style="text-align:center" value="<?php if (isset($salaryMin)) {
                                                                                                echo $salaryMin;
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>" name="salaryMin" placeholder="Min" value="">
                <span style="margin-left:15px;margin-right:15px">~</span>
                <input type="text" class="form-control" style="text-align:center" value="<?php if (isset($salaryMax)) {
                                                                                                echo $salaryMax;
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>" name="salaryMax" placeholder="Max" value="">
            </div>
        </div>
        <div class="col-md-4">
            <div>
                Effective Date
            </div>
            <div class="form-group">
                <input type="date" name="effectiveDate" value="<?php if (isset($effectiveDate)) {
                                                                    echo $effectiveDate;
                                                                } else {
                                                                    echo "";
                                                                } ?>" class="form-control">
            </div>

        </div>
        <div class="col-md-4" style="padding-top:19px;"><button name="search" style="width:100%;" class="btn btn-primary"><span style="margin-right:15px">FIND</span><span>MY</span><span style="margin-left:15px">TEAM</span></button></div>
    </div>
    <div class="row">
        <div class="col-md-8">

            <?php
            if (count($result) > 0) {
                echo "<h3>" . count($result) . " Jobs are found<h3>";
                foreach ($result as $row) {
                    echo '<div class="card" style="margin-bottom:15px;border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    <div class="card-body">
                        <h3 class="card-title">' . $row['title'] . '</h3>
                        <h5 class="card-subtitle mb-2 text-muted">Category:' . $row['category'] . ' Type:' . $result[0]['type'] . ' Salary:' . $result[0]['salary'] . '</h5>
                        <p class="card-text">' . $row['description'] . '</p>
                        <form action="" method="POST">
                        <input type="hidden" value="' . $row['jobID'] . '" name="jobID">
                        <input type="hidden" value="' . $row['companyEmail'] . '" name="companyEmail">
                        <a href="#" class="card-link"><button name="apply" class="btn btn-primary">Apply</button></a>
                        
                        <a href="./employeeIndex.php?companyID=' . $row['companyEmail'] . '" class="card-link"><button type="button" class="btn btn-plain">Get Company Info</button></a>
                        </form>
                    </div>
                </div>';
                }
            } else {
                echo "<h2 style='text-align:center;color:rgb(149,149,149)'>No Job !</h2>";
            }
            ?>

        </div>
        <div class="col-md-4">
            <?php

            if (count($company) > 0) {
                foreach ($company as $row) {
                    echo '<div class="card" style="border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    
                    <div class="card-header"> <h3>Company Information !</h3></div>
                    <div class="card-body">
                        <h3 class="card-title">' . $row['name'] . '</h3>
                        <h5 class="card-subtitle mb-2 text-muted">Email:' . $row['email'] . '</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Phone:' . $row['phone'] . '</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Address:' . $row['address'] . '</h5>
                        <h5 class="card-subtitle mb-2 text-muted">Official Web Link:<a href="' . $row['officialWebsiteUrl'] . '">' . $row['officialWebsiteUrl'] . '</a></h5>
                        <p class="card-text">Description:' . $row['description'] . '</p>
                        <p class="card-text">Intrpduction:' . $row['introduction'] . '</p>
                        <p class="card-text">Qualifications:' . $row['qualifications'] . '</p>
                        
                    </div>
                </div>
            </div>';
                }
            } else {

                echo '<div class="card" style="border-radius:10px;border:1px solid rgb(199,199,199);padding-left:15px;padding-right:15px;padding-bottom:15px">
                    <h3 style="text-align:center">Company Information !</h3>
                </div>';
            }
            ?>
        </div>
    </div>
</form>
<?php
require_once "footer.php";
?>
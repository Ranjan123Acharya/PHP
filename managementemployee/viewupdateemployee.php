<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>Employee - View/Update Employee </title>
    <?php include('connect.php'); ?>
</head>

<body>

    <?php require('inc/header.php'); ?>


    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">VIEW/UPDATE EMPLOYEE</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">This the Demo Website On Employee Management System. Here You can <br> search employee by the Employee Number and update it.</p>
    </div>
    <div class="mb-3 py-3 px-5">
        <form action="" method="POST">
            <label for="formGroupExampleInput" class="form-label">
                <h4>Please Enter The Employee Number</h4>
            </label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="emp_num" placeholder="123456789">
            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base mt-2">
                <h6>Note: If you don't know the employee number then go to the employee search page.</h6>
            </span>
            <div class="col-12">
                <button type="submit" name="search" class="btn btn-dark">Search</button>
            </div>
        </form>
        <?php

        if (isset($_POST['search'])) {
            $emp_num = $_POST['emp_num'];

            $query = " SELECT * FROM `employee` LEFT JOIN job ON employee.job_code=job.job_code LEFT JOIN department ON employee.dept_id=department.dept_id WHERE employee.emp_num='$emp_num'";
            $query_run = mysqli_query($con, $query);
            $rows = mysqli_num_rows($query_run);


            if ($rows) {
                while ($result = mysqli_fetch_assoc($query_run)) {

        ?>
                    <form action="" method="POST" class="row g-3 mt-5 px-5">

                        <div class="col-md-6 mt-2">
                            <label for="firstName" class="form-label" style="font-weight: 500;">First Name</label>
                            <input type="text" id="firstName" class="form-control" value="<?php echo $result['first_name'] ?> " name="first_name" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="lastName" class="form-label" style="font-weight: 500;">Last Name</label>
                            <input type="text" id="lastName" class="form-control" value="<?php echo $result['last_name'] ?> " name="last_name" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="gender" style="font-weight: 500;">Select Your Gender</label> <br>
                            <div class="col-2 mt-2">
                                <input type="text" name="sex" value="<?php echo $result['sex'] ?>" />
                            </div>


                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label" style="font-weight: 500;">Date Of Birth</label>
                            <input type="date" class="form-control shadow-none" value="<?php echo $result['birth_date'] ?>" name="birth_date" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label" style="font-weight: 500;">Current Job Position</label>
                            <input type="hidden" name="job_code" value="<?php echo $job_code; ?>">
                            <select class="form-control" name="job_code" id="">

                                <?php
                                $con = mysqli_connect("localhost", "root", "", "amaz");
                                $query = "SELECT * FROM job";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $rowhob) {

                                ?>
                                        <option value="<?php echo $result['job_code']; ?>"><?php echo $rowhob['job_desc']; ?></option>
                                <?php
                                    }
                                } else {
                                    echo "NO Record Found";
                                }


                                ?>

                            </select>

                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label" style="font-weight: 500;">Department</label>
                            <input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>">
                            <select class="form-control" name="dept_id" id="">


                                <?php
                                $con = mysqli_connect("localhost", "root", "", "amaz");
                                $query = "SELECT * FROM department";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $rowhob) {

                                ?>
                                        <option value="<?php echo $result['dept_id']; ?>"><?php echo $rowhob['dept_name']; ?></option>
                                <?php
                                    }
                                } else {
                                    echo "NO Record Found";
                                }


                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label" style="font-weight: 500;">Date Assigned for the Job Position</label>
                            <input type="date" class="shadow-none form-control" value="<?php echo $result['date_assign'] ?>" name="date_assign">
                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label" style="font-weight: 500;">Current Salary</label>
                            <input type="text" class="form-control" value="<?php echo $result['emp_salary'] ?> " name="emp_salary">
                        </div>


                        <button type="submit" name="update" class="btn btn-secondary btn-lg">Update
                        </button>



                    </form>



        <?php
                }
            }
        }



        ?>


    </div>

    <br><br><br>
    <br><br><br><br>
    <br><br><br><br>








    <?php require('inc/footer.php'); ?>


</body>

</html>

<?php

if (isset($_POST['update'])) {
    $job_code = $_POST['job_code'];
    $dept_id = $_POST['dept_id'];
    $date_assign = $_POST['date_assign'];
    $emp_salary = $_POST['emp_salary'];

    // print_r($_POST);
    $query = "UPDATE `employee` SET job_code='$_POST[job_code]',dept_id='$_POST[dept_id]',date_assign='$_POST[date_assign]',emp_salary='$_POST[emp_salary]' WHERE emp_num='$_POST[emp_num]'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        echo '<script> alert("Data Updated")</script>';
    } else {
        echo '<script> alert("Data Not Updated")</script>';
    }
}


?>
<?php 
include("php/dbcon.php");


                                           // Add Category Logic
$categoryName = $categoryImageName = $categoryDes = "";
$categoryNameErr = $categoryImageNameErr = $categoryDesErr = "";

if (isset($_POST['addCategory'])) {
    $categoryName = $_POST['cName'];
    $categoryDes = $_POST['cDes'];
    $categoryImageName = strtolower($_FILES["cImage"]["name"]);
    $categoryImageTmpName = $_FILES["cImage"]["tmp_name"];
    $extension = pathinfo($categoryImageName, PATHINFO_EXTENSION);
    $destination = "images/" . $categoryImageName;

    // Validation
    $validExtensions = ["jpg", "jpeg", "png", "svg"];
    if (empty($categoryName)) {
        $categoryNameErr = "Category name is required";
    }
    if (empty($categoryDes)) {
        $categoryDesErr = "Description is required";
    }
    if (empty($categoryImageName)) {
        $categoryImageNameErr = "Image is required";
    } elseif (!in_array($extension, $validExtensions)) {
        $categoryImageNameErr = "Invalid image format";
    }

    // If no validation errors
    if (empty($categoryNameErr) && empty($categoryImageNameErr) && empty($categoryDesErr)) {
        if (move_uploaded_file($categoryImageTmpName, $destination)) {
            $stmt = $pdo->prepare("INSERT INTO addcategory (cName, cImage, cDes) VALUES (:cName, :cImage, :cDes)");
            $stmt->execute([
                ':cName' => $categoryName,
                ':cImage' => $categoryImageName,
                ':cDes' => $categoryDes
            ]);

            echo "<script>alert('✅ Category added successfully!'); location.href='addCategory.php';</script>";
        } else {
            echo "<script>alert('❌ Failed to upload image');</script>";
        }
    }
}



$productNameErr = $productImageNameErr = $createdAtErr = $categoryNameErr = $categoryImageNameErr = $categoryDesErr = "";

$message = "";
if (isset($_POST["addproductType"])) {
    $type_name = trim($_POST['type_name']);

    if (!empty($type_name)) {
        // Prepare and bind to prevent SQL injection
        $stmt = $pdo->prepare("INSERT INTO product_types (type_name) VALUES (:t)");
        $stmt->bindParam("t", $type_name);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Product type added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error adding product type " .  "</div>";
        }

        // $stmt->close();
    } else {
        $message = "<div class='alert alert-warning'>Please enter a product type name.</div>";
    }
}
                               //TESTING TYPES:

// your PDO connection
// $testName = $departmentId = "";
// $testNameErr = $departmentIdErr = "";

// if (isset($_POST['addTestingType'])) {
//     $testName = $_POST['test_name'];
//     $departmentId = $_POST['department_id'];

//     if (empty($testName)) {
//         $testNameErr = "Testing Name is required";
//     }

//     if (empty($departmentId)) {
//         $departmentIdErr = "Department ID is required";
//     }

//     if (empty($testNameErr) && empty($departmentIdErr)) {
//         $stmt = $pdo->prepare("INSERT INTO testing_types (test_name, department_id) VALUES (:test_name, :department_id)");
//         $stmt->bindParam(":test_name", $testName);
//         $stmt->bindParam(":department_id", $departmentId);
//         $stmt->execute();

//         echo "<script>alert('Testing Type Added Successfully'); location.assign('testing_type.php');</script>";
//     }
// }


                                        //Add Lab Test:


if (isset($_POST['submit'])) {

    // First, validate required fields (optional but recommended)
    $required_fields = ['product_id', 'testing_type_id', 'department_id', 'tester_id', 'test_date', 'test_start_time', 'test_end_time', 'criteria_tested', 'observed_output', 'expected_output', 'result', 'remarks', 'status', 'is_sent_to_CPRI', 'test_roll_number', 'created_at', 'updated_at'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo "<script>alert('Please fill all fields. Missing: $field');</script>";
            return;
        }
    }

    // Prepared statement
    $query = $pdo->prepare("INSERT INTO lab_test 
        (product_id, testing_type_id, department_id, tester_id, test_date, test_start_time, test_end_time, criteria_tested, observed_output, expected_output, result, remarks, status, is_sent_to_CPRI, test_roll_number, created_at, updated_at) 
        VALUES 
        (:product_id, :testing_type_id, :department_id, :tester_id, :test_date, :test_start_time, :test_end_time, :criteria_tested, :observed_output, :expected_output, :result, :remarks, :status, :is_sent_to_CPRI, :test_roll_number, :created_at, :updated_at)");

    $query->execute([
        ':product_id'         => $_POST['product_id'],
        ':testing_type_id'    => $_POST['testing_type_id'],
        ':department_id'      => $_POST['department_id'],
        ':tester_id'          => $_POST['tester_id'],
        ':test_date'          => $_POST['test_date'],
        ':test_start_time'    => $_POST['test_start_time'],
        ':test_end_time'      => $_POST['test_end_time'],
        ':criteria_tested'    => $_POST['criteria_tested'],
        ':observed_output'    => $_POST['observed_output'],
        ':expected_output'    => $_POST['expected_output'],
        ':result'             => $_POST['result'],
        ':remarks'            => $_POST['remarks'],
        ':status'             => $_POST['status'],
        ':is_sent_to_CPRI'    => $_POST['is_sent_to_CPRI'],
        ':test_roll_number'   => $_POST['test_roll_number'],
        ':created_at'         => $_POST['created_at'],
        ':updated_at'         => $_POST['updated_at']
    ]);

    echo "<script>alert('✅ Lab Test Record Added'); location.href='add_lab_test.php';</script>";
}

                                             //ADD TESTER:

if (isset($_POST['addTester'])) {
    $testerName = $_POST['tester_name'];
    $email = $_POST['email'];
    $departmentId = $_POST['department_id'];

    if (!empty($testerName) && !empty($email) && !empty($departmentId)) {
        $stmt = $pdo->prepare("INSERT INTO testers (name, email, department_id) VALUES (:tester_name, :email, :department_id)");
        $stmt->execute([
            ':tester_name' => $testerName,
            ':email' => $email,
            ':department_id' => $departmentId
        ]);
        echo "<script>alert('Tester Added Successfully'); location.href='add_tester.php';</script>";
    } else {
        echo "<script>alert('All fields are required!');</script>";
    }
}

                           //ADD DEPARTMENT:
                           
if (isset($_POST['addDepartment'])) {
    $departmentName = $_POST['department_name'];
    $location = $_POST['location'];

    if (!empty($departmentName) && !empty($location)) {
        $stmt = $pdo->prepare("INSERT INTO departments (dept_name, location) VALUES (:dept_name, :location)");
        $stmt->execute([
            ':dept_name' => $departmentName,
            ':location' => $location
        ]);
        echo "<script>alert('Department added successfully'); location.href='add_department.php';</script>";
    } else {
        echo "<script>alert('Please fill all fields');</script>";
    }
}

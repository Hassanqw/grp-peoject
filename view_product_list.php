<?php
include("php/query.php");  // PDO connection file
include("components/header.php");

$department_name = '';
$departmentNameErr = '';

if (isset($_POST['adddepartment'])) {
    $department_name = trim($_POST['department_name'] ?? '');

    if (empty($department_name)) {
        $departmentNameErr = "Department Name is required";
    }

    if (empty($departmentNameErr)) {
        $stmt = $pdo->prepare("INSERT INTO departments (department_name) VALUES (?)");
        $result = $stmt->execute([$department_name]);

        if ($result) {
            echo "<script>alert('Department added successfully!'); location.assign('departments.php');</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to add department.</div>";
        }
    }
}
?>

<style>
    .container {
        max-width: 500px;
        margin-top: 50px;
    }
</style>

<div class="container">
    <h2>Add Department</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="departmentName" class="form-label fw-bold">Department Name</label>
            <input type="text" class="form-control" id="departmentName" name="department_name" placeholder="Enter Department Name" value="<?php echo htmlspecialchars($department_name); ?>">
            <small class="text-danger"><?php echo $departmentNameErr; ?></small>
        </div>
        <button type="submit" name="adddepartment" class="btn btn-primary w-100">Add Department</button>
    </form>
</div>

<?php include("components/footer.php"); ?>

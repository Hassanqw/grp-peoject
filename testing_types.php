<?php
include("php/query.php");
include("components/header.php");

// Initialize variables & error messages
$test_name = '';
$department_id = '';
$testNameErr = '';
$departmentIdErr = '';

if (isset($_POST['addTestingType'])) {
    $test_name = trim($_POST['test_name'] ?? '');
    $department_id = trim($_POST['department_id'] ?? '');

    // Validation
    if (empty($test_name)) {
        $testNameErr = "Test Name is required";
    }

    if (empty($department_id)) {
        $departmentIdErr = "Department is required";
    } elseif (!ctype_digit($department_id)) {
        $departmentIdErr = "Department ID must be a number";
    } else {
        // Check if department_id exists in departments table
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM departments WHERE department_id = ?");
        $stmt->execute([$department_id]);
        if ($stmt->fetchColumn() == 0) {
            $departmentIdErr = "Invalid department selected.";
        }
    }

    // If no errors, insert into database
    if (empty($testNameErr) && empty($departmentIdErr)) {
        $stmt = $pdo->prepare("INSERT INTO testing_types (test_name, department_id) VALUES (?, ?)");
        $result = $stmt->execute([$test_name, $department_id]);

        if ($result) {
            echo "<script>alert('Testing type added successfully!'); location.assign('testing_types.php');</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to add testing type.</div>";
        }
    }
} else {
    // If form not submitted, initialize for empty form
    $test_name = '';
    $department_id = '';
}

// Fetch departments from database for dropdown
$deptStmt = $pdo->query("SELECT department_id, dept_name FROM departments ORDER BY dept_name ASC");
$departments = $deptStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .container {
        width: 700px;
        margin-top: -500px;
    }
</style>

<div class="container">
    <div class="container mt-5" style="max-width: 600px;">
        <h3 class="mb-4">Add Testing Type</h3>
        <form method="POST">
            <!-- Test Name -->
            <div class="mb-3">
                <label for="testName" class="form-label fw-bold">Test Name</label>
                <input type="text" class="form-control" id="testName" name="test_name" placeholder="e.g. CPRI Test" value="<?php echo htmlspecialchars($test_name); ?>">
                <small class="text-danger"><?php echo $testNameErr; ?></small>
            </div>

            <!-- Department Dropdown -->
            <div class="mb-3">
                <label for="departmentId" class="form-label fw-bold">Department</label>
                <select class="form-control" id="departmentId" name="department_id" required>
                    <option value="">-- Select Department --</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?php echo htmlspecialchars($dept['department_id']); ?>"
                            <?php if ($dept['department_id'] == $department_id) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($dept['dept_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-danger"><?php echo $departmentIdErr; ?></small>
            </div>

            <!-- Submit -->
            <button type="submit" name="addTestingType" class="btn btn-primary w-100">Add Testing Type</button>
        </form>
    </div>
</div>

<?php include("components/footer.php"); ?>

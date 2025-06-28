<?php
include("php/query.php");
include("components/header.php");

$errors = [];
$uploaded_report_path = null;

if (isset($_POST['add_cpri_test'])) {
    // Get POST data and sanitize
    $product_id = trim($_POST['product_id'] ?? '');
    $related_test_id = trim($_POST['related_test_id'] ?? null);
    $submission_date = trim($_POST['submission_date'] ?? null);
    $received_by = trim($_POST['received_by'] ?? null);
    $test_date = trim($_POST['test_date'] ?? null);
    $test_report_no = trim($_POST['test_report_no'] ?? null);
    $parameters_tested = trim($_POST['parameters_tested'] ?? null);
    $observed_output = trim($_POST['observed_output'] ?? null);
    $result = trim($_POST['result'] ?? null);
    $certification_status = trim($_POST['certification_status'] ?? null);
    $remarks = trim($_POST['remarks'] ?? null);
    $documents_attached = trim($_POST['documents_attached'] ?? null);
    $tested_by_cpri = trim($_POST['tested_by_cpri'] ?? null);
    $decision_date = trim($_POST['decision_date'] ?? null);

    // Basic validation (you can add more as needed)
    if (empty($product_id)) {
        $errors[] = "Product ID is required.";
    }

    // Handle file upload
    if (isset($_FILES['uploaded_report']) && $_FILES['uploaded_report']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['uploaded_report'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['application/pdf', 'image/png', 'image/jpeg'];
            if (!in_array($file['type'], $allowed_types)) {
                $errors[] = "Uploaded file must be PDF, PNG, or JPG.";
            } else {
                $upload_dir = __DIR__ . '/uploads/reports/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $filename = uniqid('report_') . '_' . basename($file['name']);
                $target_path = $upload_dir . $filename;

                if (move_uploaded_file($file['tmp_name'], $target_path)) {
                    // Save relative path for DB
                    $uploaded_report_path = 'uploads/reports/' . $filename;
                } else {
                    $errors[] = "Failed to upload the report file.";
                }
            }
        } else {
            $errors[] = "Error uploading file.";
        }
    }

    if (empty($errors)) {
        // Prepare insert statement
        $stmt = $pdo->prepare("INSERT INTO cpri_tests (
            product_id, related_test_id, submission_date, received_by, test_date, test_report_no,
            parameters_tested, observed_output, result, certification_status, remarks, documents_attached,
            uploaded_report_path, tested_by_cpri, decision_date, created_at, updated_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

        $result = $stmt->execute([
            $product_id,
            $related_test_id ?: null,
            $submission_date ?: null,
            $received_by ?: null,
            $test_date ?: null,
            $test_report_no ?: null,
            $parameters_tested ?: null,
            $observed_output ?: null,
            $result ?: null,
            $certification_status ?: null,
            $remarks ?: null,
            $documents_attached ?: null,
            $uploaded_report_path ?: null,
            $tested_by_cpri ?: null,
            $decision_date ?: null
        ]);

        if ($result) {
            echo "<script>alert('CPRI Test record added successfully!'); location.assign('add_cpri_test.php');</script>";
            exit;
        } else {
            $errors[] = "Failed to insert the test record.";
        }
    }
}
?>

<style>
.container {
    width: 700px;
    margin-top: -500px;
}
</style>

<div class="container">

<div class="container mt-5" style="max-width: 800px;">
    <h3 class="mb-4">Add CPRI Test Record</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
            <?php foreach ($errors as $err): ?>
                <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        
        <!-- Product ID -->
        <div class="mb-3">
            <label class="form-label">Product ID</label>
            <input type="text" name="product_id" class="form-control" required value="<?php echo htmlspecialchars($_POST['product_id'] ?? ''); ?>">
        </div>

        <!-- Related Test ID -->
        <div class="mb-3">
            <label class="form-label">Related Test ID</label>
            <input type="text" name="related_test_id" class="form-control" value="<?php echo htmlspecialchars($_POST['related_test_id'] ?? ''); ?>">
        </div>

        <!-- Submission Date -->
        <div class="mb-3">
            <label class="form-label">Submission Date</label>
            <input type="date" name="submission_date" class="form-control" value="<?php echo htmlspecialchars($_POST['submission_date'] ?? ''); ?>">
        </div>

        <!-- Received By -->
        <div class="mb-3">
            <label class="form-label">Received By</label>
            <input type="text" name="received_by" class="form-control" value="<?php echo htmlspecialchars($_POST['received_by'] ?? ''); ?>">
        </div>

        <!-- Test Date -->
        <div class="mb-3">
            <label class="form-label">Test Date</label>
            <input type="date" name="test_date" class="form-control" value="<?php echo htmlspecialchars($_POST['test_date'] ?? ''); ?>">
        </div>

        <!-- Test Report No -->
        <div class="mb-3">
            <label class="form-label">Test Report No</label>
            <input type="text" name="test_report_no" class="form-control" value="<?php echo htmlspecialchars($_POST['test_report_no'] ?? ''); ?>">
        </div>

        <!-- Parameters Tested -->
        <div class="mb-3">
            <label class="form-label">Parameters Tested</label>
            <textarea name="parameters_tested" class="form-control"><?php echo htmlspecialchars($_POST['parameters_tested'] ?? ''); ?></textarea>
        </div>

        <!-- Observed Output -->
        <div class="mb-3">
            <label class="form-label">Observed Output</label>
            <textarea name="observed_output" class="form-control"><?php echo htmlspecialchars($_POST['observed_output'] ?? ''); ?></textarea>
        </div>

        <!-- Result -->
        <div class="mb-3">
            <label class="form-label">Result</label>
            <select name="result" class="form-control">
                <option value="Passed" <?php if (($_POST['result'] ?? '') === 'Passed') echo 'selected'; ?>>Passed</option>
                <option value="Failed" <?php if (($_POST['result'] ?? '') === 'Failed') echo 'selected'; ?>>Failed</option>
            </select>
        </div>

        <!-- Certification Status -->
        <div class="mb-3">
            <label class="form-label">Certification Status</label>
            <select name="certification_status" class="form-control">
                <option value="Certified" <?php if (($_POST['certification_status'] ?? '') === 'Certified') echo 'selected'; ?>>Certified</option>
                <option value="Rejected" <?php if (($_POST['certification_status'] ?? '') === 'Rejected') echo 'selected'; ?>>Rejected</option>
                <option value="Pending" <?php if (($_POST['certification_status'] ?? '') === 'Pending') echo 'selected'; ?>>Pending</option>
            </select>
        </div>

        <!-- Remarks -->
        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control"><?php echo htmlspecialchars($_POST['remarks'] ?? ''); ?></textarea>
        </div>

        <!-- Documents Attached -->
        <div class="mb-3">
            <label class="form-label">Documents Attached</label>
            <input type="text" name="documents_attached" class="form-control" placeholder="e.g. Report.pdf, Sheet.png" value="<?php echo htmlspecialchars($_POST['documents_attached'] ?? ''); ?>">
        </div>

        <!-- Upload Report -->
        <div class="mb-3">
            <label class="form-label">Upload CPRI Report</label>
            <input type="file" name="uploaded_report" class="form-control">
        </div>

        <!-- Tested By CPRI -->
        <div class="mb-3">
            <label class="form-label">Tested By CPRI (Name)</label>
            <input type="text" name="tested_by_cpri" class="form-control" value="<?php echo htmlspecialchars($_POST['tested_by_cpri'] ?? ''); ?>">
        </div>

        <!-- Decision Date -->
        <div class="mb-3">
            <label class="form-label">Decision Date</label>
            <input type="date" name="decision_date" class="form-control" value="<?php echo htmlspecialchars($_POST['decision_date'] ?? ''); ?>">
        </div>

        <button type="submit" name="add_cpri_test" class="btn btn-primary w-100">Submit CPRI Test</button>
    </form>
</div>
</div>

<?php include("components/footer.php"); ?>
                
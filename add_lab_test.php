<?php
include("php/query.php");
include("components/header.php");

?>
<?php

$products = $pdo->query("SELECT * FROM addproduct")->fetchAll(PDO::FETCH_ASSOC);
$testingTypes = $pdo->query("SELECT * FROM testing_types")->fetchAll(PDO::FETCH_ASSOC);
$departments = $pdo->query("SELECT * FROM departments")->fetchAll(PDO::FETCH_ASSOC);
$testers = $pdo->query("SELECT * FROM testers")->fetchAll(PDO::FETCH_ASSOC);
?>

<style>

    .container{
        width: 700px;
        margin-top:  -500px ; 
    }
</style>

<div class="container">
<form method="POST" action="add_lab_test.php">
    <!-- Product -->
    <label>Product</label>
    <select name="product_id" class="form-control">
        <option value="">Select Product</option>
        <?php foreach ($products as $p): ?>
            <option value="<?= $p['product_id'] ?>"><?= $p['product_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Testing Type -->
    <label>Testing Type</label>
    <select name="testing_type_id" class="form-control">
        <option value="">Select Test</option>
        <?php foreach ($testingTypes as $t): ?>
            <option value="<?= $t['testing_type_id'] ?>"><?= $t['test_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Department -->
    <label>Department</label>
    <select name="department_id" class="form-control">
        <option value="">Select Department</option>
        <?php foreach ($departments as $d): ?>
            <option value="<?= $d['department_id'] ?>"><?= $d['department_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Tester -->
    <label>Tester</label>
    <select name="tester_id" class="form-control">
        <option value="">Select Tester</option>
        <?php foreach ($testers as $t): ?>
            <option value="<?= $t['tester_id'] ?>"><?= $t['tester_name'] ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Test Date -->
    <label>Test Date</label>
    <input type="date" name="test_date" class="form-control">

    <!-- Test Start Time -->
    <label>Test Start Time</label>
    <input type="time" name="test_start_time" class="form-control">

    <!-- Test End Time -->
    <label>Test End Time</label>
    <input type="time" name="test_end_time" class="form-control">

    <!-- Criteria Tested -->
    <label>Criteria Tested</label>
    <input type="text" name="criteria_tested" class="form-control">

    <!-- Observed Output -->
    <label>Observed Output</label>
    <input type="text" name="observed_output" class="form-control">

    <!-- Expected Output -->
    <label>Expected Output</label>
    <input type="text" name="expected_output" class="form-control">

    <!-- Result -->
    <label>Result</label>
    <select name="result" class="form-control">
        <option value="Pass">Pass</option>
        <option value="Fail">Fail</option>
    </select>

    <!-- Remarks -->
    <label>Remarks</label>
    <textarea name="remarks" class="form-control"></textarea>

    <!-- Status -->
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="Pending">Pending</option>
        <option value="Tested">Tested</option>
        <option value="Re-test">Re-test</option>
    </select>

    <!-- Is Sent To CPRI -->
    <label>Sent to CPRI?</label>
    <select name="is_sent_to_CPRI" class="form-control">
        <option value="0">No</option>
        <option value="1">Yes</option>
    </select>

    <!-- Test Roll Number -->
    <label>Test Roll Number</label>
    <input type="text" name="test_roll_number" class="form-control">

    <!-- Created At -->
    <input type="hidden" name="created_at" value="<?= date('Y-m-d H:i:s') ?>">

    <!-- Updated At -->
    <input type="hidden" name="updated_at" value="<?= date('Y-m-d H:i:s') ?>">

    <br>
    <button type="submit" name="submit" class="btn btn-primary">Submit Lab Test</button>
</form>
</div>
<?php

include("components/footer.php");

?>
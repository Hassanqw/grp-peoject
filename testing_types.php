<?php
include("php/query.php");
include("components/header.php");
?>
<style>

    .container{
        width: 700px;
        margin-top:  -500px ; 
    }
</style>

<div class="container">
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="mb-4">Add Testing Type</h3>
    <form method="POST">
        <!-- Test Name -->
        <div class="mb-3">
            <label for="testName" class="form-label fw-bold">Test Name</label>
            <input type="text" class="form-control" id="testName" name="test_name" placeholder="e.g. CPRI Test">
            <small class="text-danger"><?php echo $testNameErr; ?></small>
        </div>

        <!-- Department ID -->
        <div class="mb-3">
            <label for="departmentId" class="form-label fw-bold">Department ID</label>
            <input type="number" class="form-control" id="departmentId" name="department_id" placeholder="Enter department ID">
            <small class="text-danger"><?php echo $departmentIdErr; ?></small>
        </div>

        <!-- Submit -->
        <button type="submit" name="addTestingType" class="btn btn-primary w-100">Add Testing Type</button>
    </form>
</div>
</div>
<?php
include("components/footer.php");
?>
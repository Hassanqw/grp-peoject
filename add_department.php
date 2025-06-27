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
<div class="container mt-5" style="max-width: 700px;">
    <h3 class="mb-4">Add New Department</h3>

    <form method="POST">
        <!-- Department Name -->
        <div class="mb-3">
            <label for="departmentName" class="form-label fw-bold">Department Name</label>
            <input type="text" class="form-control" id="departmentName" name="department_name" placeholder="Enter department name">
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label for="location" class="form-label fw-bold">Location</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter department location">
        </div>

        <button type="submit" name="addDepartment" class="btn btn-success w-100">Add Department</button>
    </form>
</div>
</div>
<?php include("components/footer.php"); ?>

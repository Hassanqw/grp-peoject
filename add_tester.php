<?php
include("php/query.php"); // your DB connection
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
    <h3 class="mb-4">Add New Tester</h3>

    <form method="POST">
        <!-- Tester Name -->
        <div class="mb-3">
            <label for="testerName" class="form-label fw-bold">Tester Name</label>
            <input type="text" class="form-control" id="testerName" name="tester_name" placeholder="Enter tester name">
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
        </div>

        <!-- Department -->
        <div class="mb-3">
            <label for="department" class="form-label fw-bold">Department</label>
            <select class="form-control" id="department" name="department_id">
                <option value="">Select Department</option>
                <?php
                $departments = $pdo->query("SELECT * FROM departments")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($departments as $dept) {
                    echo "<option value='{$dept['department_id']}'>{$dept['department_name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="addTester" class="btn btn-primary w-100">Add Tester</button>
    </form>
</div>
</div>

<?php include("components/footer.php"); ?>

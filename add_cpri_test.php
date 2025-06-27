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

<div class="container mt-5" style="max-width: 800px;">
    <h3 class="mb-4">Add CPRI Test Record</h3>
    <form method="POST" enctype="multipart/form-data">
        
        <!-- Product ID -->
        <div class="mb-3">
            <label class="form-label">Product ID</label>
            <input type="text" name="product_id" class="form-control" required>
        </div>

        <!-- Related Test ID -->
        <div class="mb-3">
            <label class="form-label">Related Test ID</label>
            <input type="text" name="related_test_id" class="form-control">
        </div>

        <!-- Submission Date -->
        <div class="mb-3">
            <label class="form-label">Submission Date</label>
            <input type="date" name="submission_date" class="form-control">
        </div>

        <!-- Received By -->
        <div class="mb-3">
            <label class="form-label">Received By</label>
            <input type="text" name="received_by" class="form-control">
        </div>

        <!-- Test Date -->
        <div class="mb-3">
            <label class="form-label">Test Date</label>
            <input type="date" name="test_date" class="form-control">
        </div>

        <!-- Test Report No -->
        <div class="mb-3">
            <label class="form-label">Test Report No</label>
            <input type="text" name="test_report_no" class="form-control">
        </div>

        <!-- Parameters Tested -->
        <div class="mb-3">
            <label class="form-label">Parameters Tested</label>
            <textarea name="parameters_tested" class="form-control"></textarea>
        </div>

        <!-- Observed Output -->
        <div class="mb-3">
            <label class="form-label">Observed Output</label>
            <textarea name="observed_output" class="form-control"></textarea>
        </div>

        <!-- Result -->
        <div class="mb-3">
            <label class="form-label">Result</label>
            <select name="result" class="form-control">
                <option value="Passed">Passed</option>
                <option value="Failed">Failed</option>
            </select>
        </div>

        <!-- Certification Status -->
        <div class="mb-3">
            <label class="form-label">Certification Status</label>
            <select name="certification_status" class="form-control">
                <option value="Certified">Certified</option>
                <option value="Rejected">Rejected</option>
                <option value="Pending">Pending</option>
            </select>
        </div>

        <!-- Remarks -->
        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control"></textarea>
        </div>

        <!-- Documents Attached -->
        <div class="mb-3">
            <label class="form-label">Documents Attached</label>
            <input type="text" name="documents_attached" class="form-control" placeholder="e.g. Report.pdf, Sheet.png">
        </div>

        <!-- Upload Report -->
        <div class="mb-3">
            <label class="form-label">Upload CPRI Report</label>
            <input type="file" name="uploaded_report" class="form-control">
        </div>

        <!-- Tested By CPRI -->
        <div class="mb-3">
            <label class="form-label">Tested By CPRI (Name)</label>
            <input type="text" name="tested_by_cpri" class="form-control">
        </div>

        <!-- Decision Date -->
        <div class="mb-3">
            <label class="form-label">Decision Date</label>
            <input type="date" name="decision_date" class="form-control">
        </div>

        <button type="submit" name="add_cpri_test" class="btn btn-primary w-100">Submit CPRI Test</button>
    </form>
</div>
</div>


<?php include("components/footer.php"); ?>

<?php 
include("php/query.php"); 
include("components/header.php"); 

// Functions to generate random codes
function generateRandomReviseCode() {
    return 'R' . rand(1, 99);
}

function generateRandomManufactureNo() {
    return 'MF' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
}

// Initialize variables for form display and errors
$product_name = '';
$product_type_id = '';
$manufacture_date = '';
$productNameErr = $productTypeIdErr = $manufactureDateErr = '';

if (!isset($_POST['addproduct'])) {
    // Generate codes only on initial page load (not on form submit)
    $revise_code = generateRandomReviseCode();
    $manufacture_no = generateRandomManufactureNo();
} 

if (isset($_POST['addproduct'])) {
    // Use posted values
    $product_name = $_POST['product_name'] ?? '';
    $product_type_id = $_POST['product_type_id'] ?? null;
    $manufacture_date = $_POST['manufacture_date'] ?? '';

    // Get revise_code and manufacture_no from hidden inputs in form
    $revise_code = $_POST['revise_code'] ?? '';
    $manufacture_no = $_POST['manufacture_no'] ?? '';

    // Validation
    $errors = [];
    if (empty($product_name)) {
        $errors['productNameErr'] = "Product Name is required";
    }
    if (empty($product_type_id)) {
        $errors['productTypeIdErr'] = "Product Type is required";
    }
    // (Optional) Validate manufacture_date if needed

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO products (product_name, product_type_id, revise_code, manufacture_no, manufacture_date) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([
            $product_name,
            $product_type_id,
            $revise_code,
            $manufacture_no,
            $manufacture_date
        ]);

        if ($result) {
            echo "<script>alert('Product added successfully!'); location.assign('addProducts.php');</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to add product.</div>";
        }
    } else {
        // Show errors on form
        foreach ($errors as $key => $msg) {
            $$key = $msg;
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
    <form method="POST" enctype="multipart/form-data">
        <!-- Product Name -->
        <div class="mb-3">
            <label for="productName" class="form-label fw-bold">Product Name</label>
            <input type="text" class="form-control form-control-lg" id="productName" name="product_name" placeholder="Enter product Name" value="<?php echo htmlspecialchars($product_name); ?>">
            <small class="text-danger"><?php echo $productNameErr ?? ''; ?></small>
        </div>

        <!-- Product Type -->
        <div class="mb-3">
            <label for="productType" class="form-label fw-bold">Product Type</label>
            <select name="product_type_id" id="productType" class="form-control form-control-lg">
                <option value="">Select Product Type</option>
                <?php
                $query = $pdo->query("SELECT product_type_id, type_name FROM product_types");
                $productTypes = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($productTypes as $type) {
                    $selected = ($product_type_id == $type['product_type_id']) ? 'selected' : '';
                    echo "<option value=\"" . htmlspecialchars($type['product_type_id']) . "\" $selected>" . htmlspecialchars($type['type_name']) . "</option>";
                }
                ?>
            </select>
            <small class="text-danger"><?php echo $productTypeIdErr ?? ''; ?></small>
        </div>

        <!-- Revise Code (Read-only display + Hidden input) -->
        <div class="mb-3">
            <label for="reviseCode" class="form-label fw-bold">Revise Code (auto-generated)</label>
            <input type="text" class="form-control form-control-lg" id="reviseCode" value="<?php echo htmlspecialchars($revise_code); ?>" readonly>
            <input type="hidden" name="revise_code" value="<?php echo htmlspecialchars($revise_code); ?>">
        </div>

        <!-- Manufacture No (Read-only display + Hidden input) -->
        <div class="mb-3">
            <label for="manufactureNo" class="form-label fw-bold">Manufacture No (auto-generated)</label>
            <input type="text" class="form-control form-control-lg" id="manufactureNo" value="<?php echo htmlspecialchars($manufacture_no); ?>" readonly>
            <input type="hidden" name="manufacture_no" value="<?php echo htmlspecialchars($manufacture_no); ?>">
        </div>

        <!-- Manufacture Date -->
        <div class="mb-3">
            <label for="manufactureDate" class="form-label fw-bold">Manufacture Date</label>
            <input type="date" class="form-control form-control-lg" id="manufactureDate" name="manufacture_date" value="<?php echo htmlspecialchars($manufacture_date); ?>">
            <small class="text-danger"><?php echo $manufactureDateErr ?? ''; ?></small>
        </div>

        <!-- Submit Button -->
        <button name="addproduct" class="btn btn-primary btn-lg w-100">Add Product</button>
    </form>
</div>

<?php include("components/footer.php"); ?>

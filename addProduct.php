<?php
include("php/query.php");
include("components/header.php");
?>

<style>

    .container{
        width: 700px;
    }
</style>

<div class="container">
<form method="POST" enctype="multipart/form-data">
    <!-- Product Name -->
    <div class="mb-3">
        <label for="productName" class="form-label fw-bold">Product Name</label>
        <input type="text" class="form-control form-control-lg" id="productName" name="pName" placeholder="Enter product Name">
        <small class="text-danger"><?php echo $productNameErr ?></small>
    </div>

    <!-- Product Image -->
    <div class="mb-3">
        <label for="productImage" class="form-label fw-bold">Product Image</label>
        <input class="form-control" type="file" id="productImage" name="pImage">
        <small class="text-danger"><?php echo $productImageNameErr ?></small>
    </div>



    <!-- Product ID -->
    <div class="mb-3">
        <label for="productId" class="form-label fw-bold">Product ID</label>
        <input type="text" class="form-control" id="productId" name="product_id" placeholder="Enter 10-digit product ID">
        <small class="text-danger"><?php echo $productIdErr ?></small>
    </div>

    <!-- Product Code -->
    <div class="mb-3">
        <label for="productCode" class="form-label fw-bold">Product Code</label>
        <input type="text" class="form-control" id="productCode" name="product_code" placeholder="Enter product code">
        <small class="text-danger"><?php echo $productCodeErr ?></small>
    </div>

    <!-- Revision No -->
    <div class="mb-3">
        <label for="revisionNo" class="form-label fw-bold">Revision No</label>
        <input type="text" class="form-control" id="revisionNo" name="revision_no" placeholder="e.g. R1">
        <small class="text-danger"><?php echo $revisionNoErr ?></small>
    </div>

    <!-- Manufacture No -->
    <div class="mb-3">
        <label for="manufactureNo" class="form-label fw-bold">Manufacture No</label>
        <input type="text" class="form-control" id="manufactureNo" name="manufacture_no" placeholder="e.g. MF001">
        <small class="text-danger"><?php echo $manufactureNoErr ?></small>
    </div>

<select name="category_id" id="" class="form-control">
    <option value=""> Select Category</option>
 <?php
     $query = $pdo->query("select * from addcategory");
     
     $allCategories = $query->fetchAll(PDO::FETCH_ASSOC);
          foreach($allCategories as $category){
       ?>
      <option value="<?php echo $category['id']?>"><?php echo $category['cName']?></option>
          <?php
          }
         ?>
            </select>


    <!-- Created At -->
    <div class="mb-3">
        <label for="createdAt" class="form-label fw-bold">Created Date</label>
        <input type="date" class="form-control" id="createdAt" name="created_at">
        <small class="text-danger"><?php echo $createdAtErr ?></small>
    </div>

    <!-- Submit Button -->
    <button name="addproduct" class="btn btn-primary btn-lg w-100">Add Product</button>
</form>
</div>
<?php
include("components/footer.php");
?>
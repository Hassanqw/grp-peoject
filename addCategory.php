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
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-graph text-success"></i>
                    </div>
                    <div>Add New Category
                        <div class="page-title-subheading">Enter category details below.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Category Information</h5>

                        <form method="POST" enctype="multipart/form-data">
                            <!-- Category Name -->
                            <div class="mb-3">
                                <label for="categoryName" class="form-label fw-bold">Category Name</label>
                                <input type="text" class="form-control form-control-lg" id="categoryName" name="cName" placeholder="Enter Category Name" >
                                <small class="text-danger"><?php echo $categoryNameErr?></small>
                            </div>

                            <!-- Category Image -->
                            <div class="mb-3">
                                <label for="categoryImage" class="form-label fw-bold">Category Image</label>
                                <input class="form-control" type="file" id="categoryImage" name="cImage"  >
                                <small class="text-danger"><?php echo $categoryImageNameErr?></small>

                            </div>

                            <!-- Category Description -->
                            <div class="mb-4">
                                <label for="categoryDescription" class="form-label fw-bold">Category Description</label>
                                <textarea class="form-control" id="categoryDescription" name="cDes" rows="5" placeholder="Write a short description..."></textarea>
                                <small class="text-danger"><?php echo $categoryDesErr?></small>

                            </div>

                            <!-- Submit Button -->
                            <button name="addCategory" class="btn btn-primary btn-lg w-100">Add Category</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>
<?php include("components/footer.php"); ?>

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
            <div class="app-main__outer">
               <div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-box1 text-success"></i>
                    </div>
                    <div>Add New Product Type
                        <div class="page-title-subheading">Add new electrical product type to the system.</div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $message; ?>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <form method="post" action="">
                    <div class="position-relative form-group">
                        <label for="type_name" class="">Product Type Name</label>
                        <input name="type_name" id="type_name" placeholder="e.g. Capacitor" type="text" class="form-control" required>
                    </div>
                    <button type="submit" name="addproductType" class="mt-2 btn btn-primary">Add Product Type</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php 

include("components/footer.php"); 
?>
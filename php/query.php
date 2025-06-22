<?php 
include("php/dbcon.php");

                                  //ADD CATEGORY
$categoryName = $categoryImageName = $categoryDes = "";
$categoryNameErr = $categoryImageNameErr = $categoryDesErr = "";


if(isset($_POST["addCategory"])){
    $categoryName = $_POST["cName"];
    $categoryDes = $_POST["cDes"];
    $categoryImageName = strtolower($_FILES["cImage"]["name"]);
    $categoryImageTmpName = $_FILES["cImage"]["tmp_name"];
    $extension = pathinfo($categoryImageName, PATHINFO_EXTENSION);
    $destination = "images/".$categoryImageName;

    if(empty($categoryName)){
        $categoryNameErr = "Name is Required"; 
    }

    if(empty($categoryImageName)){
        $categoryImageNameErr = "Image is Required"; 
    } else {
        $format = ["jpg", "png", "svg", "jpeg"];
        if(!in_array($extension, $format)){
            $categoryImageNameErr = "Invalid Extension";
        }
    }

    if(empty($categoryDes)){
        $categoryDesErr = "Description is Required"; 
    }

    if(empty($categoryNameErr) && empty($categoryImageNameErr) && empty($categoryDesErr)){
        if (move_uploaded_file($categoryImageTmpName , $destination)) {
            $query = $pdo->prepare("INSERT INTO addcategory (cName, cImage, cDes) VALUES (:cName , :cImage , :cDes)");
            $query->bindParam("cName", $categoryName);
            $query->bindParam("cImage", $categoryImageName);
            $query->bindParam("cDes", $categoryDes);
            $query->execute();
            echo "<script>alert('Category Added'); location.assign('addCategory.php');</script>";
        }
    }
}

                                       //ADD PRODUCT
$productName  = $productImageName = $productId = $productCode = $revisionNo = $manufactureNo = $createdAt = "";
$productNameErr = $productImageNameErr = $productIdErr = $productCodeErr = $revisionNoErr = $manufactureNoErr = $createdAtErr = "";


if(isset($_POST["addproduct"])){
    $productName = $_POST["pName"];
    $productImageName = strtolower($_FILES["pImage"]["name"]);
    $productImageTmpName = $_FILES["pImage"]["tmp_name"];
    $productId = $_POST["product_id"];
    $categoryId = $_POST["category_id"];
    $productCode = $_POST["product_code"];
    $revisionNo = $_POST["revision_no"];
    $manufactureNo = $_POST["manufacture_no"];
    $createdAt = $_POST["created_at"];
    $extension = pathinfo($productImageName, PATHINFO_EXTENSION);
    $destination = "images/".$productImageName;
    $categoryStmt = $pdo->query("SELECT id, cName FROM addcategory");
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    if(empty($productName)){
        $productNameErr = "Name is Required"; 
    }

    if(empty($categoryId)){
    $categoryIdErr = "Category is Required";
}


    if(empty($productImageName)){
        $productImageNameErr = "Image is Required"; 
    } else {
        $format = ["jpg", "png", "svg", "jpeg"];
        if(!in_array($extension, $format)){
            $productImageNameErr = "Invalid Extension";
        }
    }

    if(empty($productId)){
        $productIdErr = "Product ID is Required";
    }

    if(empty($productCode)){
        $productCodeErr = "Product Code is Required";
    }

    if(empty($revisionNo)){
        $revisionNoErr = "Revision Number is Required";
    }

    if(empty($manufactureNo)){
        $manufactureNoErr = "Manufacture Number is Required";
    }

    if(empty($createdAt)){
        $createdAtErr = "Created Date is Required";
    }

   
    if(empty($productNameErr) && empty($productImageNameErr) && empty($productIdErr) && empty($productCodeErr) && empty($revisionNoErr) && empty($manufactureNoErr) && empty($createdAtErr)){
        if (move_uploaded_file($productImageTmpName , $destination)) {
            $query = $pdo->prepare("INSERT INTO addproduct 
                (product_name, product_image, product_id, product_code, revision_no, manufacture_no, created_at, category_id) 
                VALUES 
                (:product_name, :product_image, :product_id, :product_code, :revision_no, :manufacture_no, :created_at, :category_id)");
           
            $query->bindParam("product_name", $productName);
            $query->bindParam("product_image", $productImageName);
            $query->bindParam("product_id", $productId);
            $query->bindParam("category_id", $categoryId);
            $query->bindParam("product_code", $productCode);
            $query->bindParam("revision_no", $revisionNo);
            $query->bindParam("manufacture_no", $manufactureNo);
            $query->bindParam("created_at", $createdAt);

            $query->execute();

            echo "<script>alert('Product Added'); location.assign('addProduct.php');</script>";
        }
    }
}
?>

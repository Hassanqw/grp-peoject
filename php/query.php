<?php 
include("php/dbcon.php");
$categoryName = $categoryImageName =  $categoryDes = "";
$categoryNameErr = $categoryImageNameErr =  $categoryDesErr = "";

if(isset($_POST["addCategory"])){
    $categoryName = $_POST["cName"];
    $categoryDes = $_POST["cDes"];
    $categoryImageName = strtolower($_FILES["cImage"]["name"]);
    $categoryImageTmpName = $_FILES["cImage"]["tmp_name"];
    $extension = pathinfo($categoryImageName , PATHINFO_EXTENSION);
    $destination = "images/".$categoryImageName;

    if(empty($categoryName)){
        $categoryNameErr = "Name is Required" ; 
    }
    if(empty($categoryImageName)){
        $categoryImageNameErr = "Image is Required" ; 
    }else{
        $format = ["jpg" , "png" , "svg" , "jpeg" , "svg"];
        if(!in_array($extension , $format)){
            $categoryImageNameErr = "Invalid Extension";
        }
    }
     if(empty($categoryDes)){
        $categoryDesErr = "Description is Required" ; 
    }
    if(empty($categoryNameErr) && empty($categoryImageNameErr) && empty($categoryDesErr)){
       if (move_uploaded_file($categoryImageTmpName , $destination)) {
        $query = $pdo->prepare("insert into addcategory (cName, cImage , cDes)values(:cName , :cImage , :cDes)") ;
        $query->bindParam("cName" , $categoryName);
        $query->bindParam("cImage" , $categoryImageName);
        $query->bindParam("cDes" , $categoryDes);
        $query->execute();
       echo "<script>alert('category Added');location.assign('addCategory.php');</script>";
       }
    }

}



?>
;
<?php require '../conn.inc.php';?>
<?php
    $id=@$_GET['id'];
?>
<?php

    if(isset($_POST['addSubmit'])){
        $title =  mysqli_real_escape_string($conn,$_POST['title']);
        $category = $_POST['category'];
        $newPrice = $_POST['newPrice'];
        $oldPrice = $_POST['oldPrice'];
        $stockQuant = $_POST['stockQuant'];
        $details =  mysqli_real_escape_string($conn,$_POST['details']);
        $desc =  mysqli_real_escape_string($conn,$_POST['desc']);
        $warranty =  mysqli_real_escape_string($conn,$_POST['warranty']);

        $qu = mysqli_query($conn,"update `productdetails` set `title`='$title', `category`='$category', `description`='$desc', `newPrice`=$newPrice, `oldPrice`=$oldPrice, `stock`='$stockQuant', `details`='$details', `warranty`='$warranty' where id=$id") or die(mysqli_error($conn));
        if(!empty($_FILES['image1']['name'])){
            $qq=mysqli_query($conn,"select image1 from productdetails");
            $qq=mysqli_fetch_assoc($qq);
            $path11="../images/".$category."/".$qq['image1'];
            if(unlink($path11)){
            }
            $filename1 =  mysqli_real_escape_string($conn,$_FILES['image1']['name']);
            $pathinfo = pathinfo($filename1);
            $ex=$pathinfo['extension']; 
            $f1=$id."_1.".$ex;
            $path1="../images/".$category."/".$filename1;
            $path11="../images/".$category."/".$f1;
            mysqli_query($conn,"update `productdetails` set `image1`='$f1' where id=$id") or die(mysqli_error($conn));
            
            move_uploaded_file($_FILES['image1']['tmp_name'],$path1);
            rename ($path1, $path11);
        }

        if(!empty($_FILES['image2']['name'])){
            $qq=mysqli_query($conn,"select image2 from productdetails");
            $qq=mysqli_fetch_assoc($qq);
            $path11="../images/".$category."/".$qq['image2'];
            if(unlink($path11)){
            }
            $filename2 =  mysqli_real_escape_string($conn,$_FILES['image2']['name']);
            $pathinfo = pathinfo($filename2);
            $ex=$pathinfo['extension']; 
            $f2=$id."_2.".$ex;
            $path2="../images/".$category."/".$filename2;
            $path22="../images/".$category."/".$f2;
            mysqli_query($conn,"update `productdetails` set `image2`='$f2' where id=$id") or die(mysqli_error($conn));
            move_uploaded_file($_FILES['image2']['tmp_name'],$path2);
            rename ($path2, $path22);
        }
        if(!empty($_FILES['image2']['name'])){
            $qq=mysqli_query($conn,"select image3 from productdetails");
            $qq=mysqli_fetch_assoc($qq);
            $path11="../images/".$category."/".$qq['image3'];
            if(unlink($path11)){
            }
            $filename3 =  mysqli_real_escape_string($conn,$_FILES['image2']['name']);
            $pathinfo = pathinfo($filename3);
            $ex=$pathinfo['extension']; 
            $f3=$id."_3.".$ex;
            $path3="../images/".$category."/".$filename3;            $path33="../images/".$category."/".$f3;
            mysqli_query($conn,"update `productdetails` set `image3`='$f3' where id=$id") or die(mysqli_error($conn));

            move_uploaded_file($_FILES['image3']['tmp_name'],$path3);
            rename ($path3, $path33);

        }
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="custom.css">
    
    <title>Document</title>
</head>
<body>
<div class="container">
<h2>Product Edit:</h2>

    <?php
        $q=mysqli_query($conn,"select * from productdetails where id='$id'") or die(mysqli_error($conn));
        $q=mysqli_fetch_assoc($q);
    ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title" value="<?php echo $q['title'];?>">
        </div>
        <div class="form-group">
            <label for="image1">Image1:</label>
            <img class="dispimg img img-fluid" src="<?php echo "../images/".$q['category']."/".$q['image1'];?>" alt="">
            <input type="file" name="image1" class="form-control" id="image">
        </div>
        <div class="form-group">
            <label for="image2">Image2:</label>
            <img class="dispimg img img-fluid" src="<?php echo "../images/".$q['category']."/".$q['image2'];?>" alt="">
            <input type="file" name="image2" class="form-control" id="image">
        </div>
        <div class="form-group">
            <label for="image3">Image3:</label>
            <img  class="dispimg img img-fluid" src="<?php echo "../images/".$q['category']."/".$q['image3'];?>" alt="">
            <input type="file" name="image3" class="form-control" id="image" value="<?php echo $q['image3'];?>">
        </div>
        <div class="form-group">
            <label for="category">Select Category:</label>
            <select name="category" class="form-control" id="category" value="<?php echo $q['category'];?>">
            <option value="laptop">Laptop</option>
                <option value="mobile">Mobile</option>
                
                <option value="camera">Camera</option>
                <option value="watches">Smart watches</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="desc">Description:</label>
            <textarea name="desc" id="desc" class="form-control" cols="30" rows="7" placeholder="separate with ;"><?php echo $q['description'];?></textarea>
        </div>
        
        <div class="form-group">
            <label for="newPrice">New Price:</label>
            <input type="number" class="form-control" name="newPrice" id="newPrice" value="<?php echo $q['newPrice'];?>">
        </div>
        <div class="form-group">
            <label for="oldPrice">Old Price:</label>
            <input type="number" class="form-control" name="oldPrice" id="oldPrice" value="<?php echo $q['oldPrice'];?>">
        </div>
        <div class="form-group">
            <label for="stock">Stock Quantity:</label>
            <input type="number" class="form-control" name="stockQuant" id="stock" value="<?php echo $q['stock'];?>">
        </div>
        
        <div class="form-group">
            <label for="details">Details:</label>
            <textarea name="details" class="form-control" id="details" cols="30" rows="10" placeholder="Enter data in `key:value;` format"><?php echo $q['details'];?></textarea>
        </div>
        <div class="form-group">
            <label for="warranty">Warranty Details:</label>
            <textarea name="warranty" class="form-control" id="warranty" cols="30" rows="5" placeholder="Warranty details" ><?php echo $q['warranty'];?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="addSubmit">Submit</button>
        
    </form>
    </div>
</body>
</html>
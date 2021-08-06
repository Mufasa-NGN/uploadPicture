
<!-- 
<?php
    // if (isset($_POST['submit'])) {

    //     $image=$_FILES['picture'];
    //     // print_r($image);
    //     $imageName=$_FILES['picture']['name'];
    //     // print_r($imageName);
    //     echo '<br>';
    //     $imageType=$_FILES['picture']['type'];
    //     // print_r($imageType);
    //     echo '<br>';
    //     $imageError=$_FILES['picture']['error'];
    //     // print_r($imageError);
    //     echo '<br>';
    //     $imageTemp=$_FILES['picture']['tmp_name'];
    //     // print_r($imageTemp);
    //     echo '<br>';
    //     $imageSize=$_FILES['picture']['size'];
    //     // print_r($imageSize);

    //     $imageExt=explode('.', $imageName);
    //     // print_r($imageExt);
    //     $imageActualExt = strtolower(end($imageExt));
    //     // print_r($imageActualExt);

    //     $allowed=array('jpg', 'jpeg', 'png', 'pdf');
    //     if (in_array($imageActualExt, $allowed)) {
    //         if ($imageError === 0) {
    //             $imageNameNew = uniqid('', true).".".$imageActualExt;
    //             $imageDestination = 'upload/'.$imageNameNew;
    //             move_uploaded_file($imageTemp, $imageDestination);
    //             header("location:index.html?uploadsuccess");
    //         } else{
    //             echo 'There was an Error Uploading your Files';
    //         }
    //     }else{
    //         echo 'You can not upload files of this type!';
    //     }

        

    //     // $connection=mysqli_connect('localhost', 'root', 'temitope', 'image');
    //     // if (!$connection) {
    //     //     die('Error in Connection');
    //     // }
    //     // $query="INSERT INTO `image`(image) values('$image') ";
    //     // $result=mysqli_query($connection, $query);
    //     // if (!$result) {
    //     //     die("Error in Query");
    //     // }
    // }
?> -->


<?php
    require 'db.inc.php';
    if (isset($_POST['title'])) {
        $image=$_FILES['image'];
        $imageName=rand(1000, 10000).".".$image['name'];
        $imageTemp=$image['tmp_name'];

        $title=$_POST['title'];
        $title= stripslashes($title);
        $title= mysqli_real_escape_string($connection, $title);

        // print_r($imageName."<br>");

        // $upload="/images";
        move_uploaded_file($imageTemp, "Upload Images/".$imageName);

        $query="INSERT INTO image(title, image) VALUES('$title', '$imageName')";
        $result= mysqli_query($connection, $query);
        if (!$result) { 
            die("Error in Query".mysqli_error()); 
        } else {
            header("location:index.html?ImageSuccessful");
            // echo 'Successful';
        }  


    }

    // if (isset($_POST['view'])) {
    //     $query="SELECT * FROM image";
    //     $result=mysqli_query($connection, $query);
    //     if (!$result) {
    //         die("Error in query".mysqli_error());
    //     }
    //     while ($row=mysqli_fetch_array($result)) {
    //         // echo $row[$field]."<br>";
    //         $imageURL="upload Images/".$row['image'];
    //         echo $row;
    //     }
    // }
?>


<?php

// Include the database configuration file
require 'db.inc.php';

// Get images from the database
        $query = "SELECT * FROM image ORDER BY title DESC";
        $result=mysqli_query($connection, $query);
            if (!$result) {
                die("Error in Query".mysqli_error());
            }
        while ($row=mysqli_fetch_array($result)) {
            $imageURL = 'upload images/'.$row["image"];
            // echo $imageURL.'<br>';

    ?>
        <style>
            img{
                width: 400px;
                height: 400px;
            }
        </style>

    <img src="<?php echo $imageURL; ?>" alt="What" />


    <?php
        }
    ?>

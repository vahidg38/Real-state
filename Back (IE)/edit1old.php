<?php  
include 'myhouses1.php';
//session_start();
$name=$_SESSION['sess_name'];
$tel=$_SESSION['sess_tel'];
$family=$_SESSION['sess_family'];
$password=$_SESSION['sess_password'];

$con = mysqli_connect('localhost', 'root', '', 'User'); 
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}/*
$con=mysqli_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");
*/
  $sql="SELECT * FROM house ";
        $result = mysqli_query($con, $sql);
$ids= array();
      echo "<hr>";
      echo "<h3>شناسه خانه موردنظر برای <b>ویرایش</b> یا <b>حذف</b> را در زیر پیدا کنید</h3><br><br>";  	
        if (mysqli_num_rows($result) > 0){
        	 while($row = mysqli_fetch_assoc($result)) {
        	 	$ids[]=$row["id"];
        echo "<label class='myid'>id: " . $row["id"]. " </label>:<div class='homerow' >title: " . $row["title"]." , price: " . $row["price"]." , type: " . $row["type"]." , area: " . $row["area"]." , bedrooms: " . $row["bedrooms"]." , parkings: " . $row["parkings"]." , locality: " . $row["locality"]. " " . "</div><br><br><br>";
        
    }
        	}		

        else{

        	 echo "شما تا کنون خانه ای ثبت نکرده اید";
        	 exit;
        } 	
        mysqli_close($con);
       
?>

<!DOCTYPE html>
<html>
<head>
	<title>ویرایش تبلیغ</title>
  <style type="text/css">
  .homerow{
    font-size: 17px;
  }
 .myid{
    background: blue;
    color: white;
    margin-right: 4px;
    font-size: 20px;
    padding: 4px;
  }
        input{
 background-color: green;
  border-radius: 10px;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px;
  cursor: default;
    }
    *{
  font-size: 15px;
  font-family: b nazanin;
  font-weight: bold;
}
a{
   background-color: red;
   width: 10%;
  border-radius: 10px;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px;
  cursor: pointer;

}
  </style>
</head>
<body>
  <hr>
<form action="" method="get">
	id  (انتخاب شماره شناسایی خانه برای حذف):<input  type="text" name="id" required=""><br><br>
	<input type="submit" style="background-color: red;" name="submit4" value="حذف">
</form>
	<hr>
<form action="" method="post" enctype="multipart/form-data">
	id  (انتخاب شماره شناسایی خانه):<input type="text" name="id" required=""><br><br>
	title (عنوان):<input type="text" name="title" required="" ><br><br>
	price (قیمت):<input type="text" name="price" required=""><br><br>
	type  (نوع خانه):<input type="text" name="type" required=""><br><br>
	area  (متراژ):<input type="text" name="area" required=""><br><br>
	bedrooms  (تعداد اتاق خواب):<input type="text" name="bedrooms" required=""><br><br>
	parkings  (تعداد پارکینگ ):<input type="text" name="parkings" required=""><br><br>
	locality  (محله):<input type="text" name="locality" required=""><br><br>
  star  (اضافه به اکازیون):<input type="checkbox" name="star" ><br><br>
	picture  (اضافه کردن عکس):<input type="file" name="fileToUpload" required="" ><br><br>

	
	<input type="submit" name="submit3" value="ثبت ویرایش">


</form><br><br>


<?php
if(isset($_GET["submit4"])){

$id=$_GET['id'];
if(!filter_var($id, FILTER_VALIDATE_INT) === true){
	echo "id must be integer greater than 0<br>";	
	exit;
	}
if (!in_array($id, $ids))
  {
  echo "باید حتما یکی از آی دی های مجاز را انتخاب کنید";
  exit;
  }	

  $con = mysqli_connect('localhost', 'root', '', 'User'); 
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM house WHERE id='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
}
if(isset($_POST["submit3"])){

$id=$_POST['id'];
if(!filter_var($id, FILTER_VALIDATE_INT) === true){
	echo "id must be integer greater than 0<br>";	
	exit;
	}
if (!in_array($id, $ids))
  {
  echo "باید حتما یکی از آی دی های مجاز را انتخاب کنید";
  exit;
  }	

 
       $errors= array();
      $file_name = $_FILES['fileToUpload']['name'];
      $file_size =$_FILES['fileToUpload']['size'];
      $file_tmp =$_FILES['fileToUpload']['tmp_name'];
      $file_type=$_FILES['fileToUpload']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
      	if( is_dir($id) === false )
			{
  				  mkdir($id);
			}


         move_uploaded_file($file_tmp,"$id"."/".$file_name);
         $imageurl="$id"."/".$file_name;
         //echo "Success";
          move_uploaded_file($file_tmp,"$id"."/".$file_name);
         $imageurl="$id"."/".$file_name;
         //echo "Success";
          $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");

          $sql="INSERT INTO images(id,imagename) VALUES('$id','$file_name')";

            $result=mysql_query($sql);
         echo "<br>";
      }else{
         print_r($errors);
         exit;
      }

mysql_close($con); 
$starv='off';
if(isset($_POST["star"])) {    
$starv=$_POST["star"];
}

if($starv=='on')$star=1;
else $star=0;

$title=$_POST['title'];
$title=filter_var($title, FILTER_SANITIZE_STRING);

$locality=$_POST['locality'];
$locality=filter_var($locality, FILTER_SANITIZE_STRING);

$price=$_POST['price'];
$area=$_POST['area'];
$bedrooms=$_POST['bedrooms'];
$parkings=$_POST['parkings'];
if((!filter_var($price, FILTER_VALIDATE_INT) === true) || (!filter_var($area, FILTER_VALIDATE_INT)===true) || ((!filter_var($bedrooms, FILTER_VALIDATE_INT)===true) & filter_var($bedrooms, FILTER_VALIDATE_INT) != 0 ) || ((!filter_var($parkings, FILTER_VALIDATE_INT)===true)& filter_var($parkings, FILTER_VALIDATE_INT) != 0  ) ){
					echo '<span style="color:red;font-size:20px;">قیمت یا متراژ یا تعداد خواب ها یا تعداد پارکینگ ها صحیح نیست</span><br><br>';
					exit;
													   }

$type=$_POST['type'];
$type=filter_var($type, FILTER_SANITIZE_STRING);

 $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");

//,price='$price',type='$type',area='$area',bedrooms='$bedrooms',parkings='$parkings',locality='$locality', 

$sql = "UPDATE house SET star='$star',title='$title', price='$price',type='$type',area='$area',bedrooms='$bedrooms',parkings='$parkings',locality='$locality' WHERE  id='$id' ";
         $result=mysql_query($sql);

         if($result){
                echo "تغییرات با موفقیت اعمال شد";
            } else {
                echo "incorrect ID!";
            }

         	          }


?>
</body>
</html>



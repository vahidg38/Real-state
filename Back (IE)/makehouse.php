<?php  
session_start();
$name=$_SESSION['sess_name'];
$tel=$_SESSION['sess_tel'];
$family=$_SESSION['sess_family'];
$password=$_SESSION['sess_password'];


?>

<!DOCTYPE html>
<html>
<head>
	<title>ثبت تبلیغ</title>
	<style type="text/css">
body{
	background: linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);
}
		input{
 background-color: lightgreen;
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
a{
	 background-color: red;
	 width: 3%;
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
*{
	font-size: 17px;
	font-family: b nazanin;
	font-weight: bold;
}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
#snackbar {
  visibility: hidden;
  font-family: b nazanin;
  min-width: 250px;
  margin-left: -125px;
	color: #c02a64;
  text-shadow: 2px 2px 4px #000000;
  background: white;
  text-align: center;
  border-radius: 12px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 40px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>


</head>
<body>
	<div id="snackbar">اطلاعات خانه را با دقت وارد کنید<br> قیمت، متراژ،تعداد خواب ها،تعداد پارکینگ ها باید بصورت عدد صحیح باشند</div>
<form action="" method="post" enctype="multipart/form-data">
	<fieldset>
	title (عنوان):<input type="text" name="title" required="" ><br><br>
	price (قیمت):<input type="text" name="price" required=""><br><br>
	type  (نوع خانه):<input type="text" name="type" required=""><br><br>
	area  (متراژ):<input type="text" name="area" required=""><br><br>
	bedrooms  (تعداد اتاق خواب):<input type="text" name="bedrooms" required=""><br><br>
	parkings  (تعداد پارکینگ ):<input type="text" name="parkings" required=""><br><br>
	locality  (محله):<input type="text" name="locality" required=""><br><br>
	picture  (عکس):<input type="file" name="fileToUpload" required="" ><br><br>
	
	<input type="submit" name="submit" style="cursor: pointer;" value="ثبت خانه">

</fieldset>
</form><br><br>
<a style="display: block;" href="kilid.php">بازگشت</a><br>


<?php
if(isset($_POST["submit"])){

 
  	$con = mysqli_connect('localhost', 'root', '', 'User'); 
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}	 
              
        //$query=mysql_query("SELECT * FROM logins where password='$password' ");
       // $query=mysql_query("SELECT * FROM house ");
       // $numrows=mysql_num_rows($query);
             //  $dir=$numrows+1;// dir=id
        $sql="SELECT * FROM house";
        $result = mysqli_query($con, $sql);
	    $ids= array();
	    $dir=0;
        if (mysqli_num_rows($result)){
        	 while($row = mysqli_fetch_assoc($result)) {
        	 	$dir=$row["id"];
        	      
                                                       }
        	}	
        $dir=$dir+1;		

        	
         mysqli_close($con);
     $con=mysql_connect('localhost','root','') or die(mysql_error());
         mysql_select_db('User') or die("cannot select DB");
        
       
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
      	if( is_dir($dir) === false )
			{
  				  mkdir($dir);
			}
         move_uploaded_file($file_tmp,"$dir"."/".$file_name);
         $imageurl="$dir"."/".$file_name;
         echo "Success";
         $sql="INSERT INTO images(id,imagename) VALUES('$dir','$file_name')";

            $result=mysql_query($sql);
          /*  if($result){
                echo "Account Successfully Created";
            } else {
                echo "Failure!";
            }*/
      }else{
         print_r($errors);
         exit;
      }


mysql_close($con);
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

//date_default_timezone_set("iran");
//$time=date("Y-m-d h:i:sa");
$time=time();

$jestate = '"name"=>$name, "logo"=>"https://www.kilidstatic.com/pictures/91e7153f-0788-43f3-8926-ab3bb8d48e47.jpg"';
//$estate=json_encode($jestate);

$jlocality = '"locality"=>$locality';
//$location=json_encode($jlocality);

$jpic = '"number"=>0,"image"=>$imageurl ';
//$pic=json_encode($jpic);

 $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");

        $sql="INSERT INTO house(id,creator,title,price,type,area,bedrooms,parkings,locality,pic,estate,star,created_at) VALUES('$dir','$password','$title','$price','$type','$area','$bedrooms','$parkings','$locality','$imageurl','$name',false,$time)";
         $result=mysql_query($sql);

         if($result){
                echo "تبلیغ با موفقیت ثبت شد";
            } else {
                echo " ثبت تبلیغ انجام نشد";
            }






}

?>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);

</script>

</body>
</html>
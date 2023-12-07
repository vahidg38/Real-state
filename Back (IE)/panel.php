<?php  
session_start();
$name=$_SESSION['sess_name'];
$tel=$_SESSION['sess_tel'];
$family=$_SESSION['sess_family'];
$password=$_SESSION['sess_password'];

      $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");
        
        
     
 $sql = "select * from logins  WHERE  level=0 ";

$information = array();
$items = array();

$result=mysql_query($sql);
$numrows=mysql_num_rows($result);
if ($numrows==0) {
  echo "هیچ کس در سایت ثبت نام نکرده است	";
  exit;
}
while($row=mysql_fetch_array($result)) { 
  $rPersonid=$row['Personid'];
  $rname=$row['name']; 
  $rfamily=$row['family'];
  

  $items[] = array('Personid'=> $rPersonid, 'name'=> $rname,'family'=> $rfamily);
} 

$information['items'] = $items;

$fp = fopen('users.json', 'w');
fwrite($fp, json_encode($information));
fclose($fp);

?>

<!DOCTYPE html>
<html>
<head>
	<title>پنل مدیریت</title>

	<link rel="shortcut icon" href="shortcut.png" />
  <link rel="stylesheet" type="text/css" href="style3.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
*{
	font-family: b nazanin;
	background: lightgreen;	
	color: white;
  text-shadow: 2px 2px 4px #000000;		
}
form{
	background-color: white;
}
button,a{	
  background-color: red;
  border-radius: 50px;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px;
  cursor: pointer;
  margin-left: 50px;
  opacity: 0.9;
}
label{
	font-size: 20px;
	font-weight: bold;
	background: white;
	color: black;
  text-shadow: 2px 2px 4px #000000;
    margin: 0px;
	padding: 5px;
}
ul{
	width: 45%;

}
</style>
  <script>
$(document).ready(function(){

 

 	$.getJSON( "users.json", function( data ) { 
  
  for (i=0;i<data.items.length;i++){

  
 var t1='<li style=" background: #cce5ff; margin: 5px;"><form   method="post"><br><label>'+data.items[i].family+'</label><label>'+data.items[i].name+':</label><button value=" '+data.items[i].Personid+' " type="submit" name="submit1">حذف کاربر</button><button style="background-color: green;" value="'+data.items[i].Personid+'" type="submit" name="submit2" formmethod="post">ارتقا به مدیر</button></form></li><br><br>';

 $(".users").append(t1);



  }
 
});


  


  
});
</script>
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
	<div id="snackbar">شما به عنوان مدیر میتوانید یک کاربر را حذف کرده و یا به عنوان مدیر منظور نمایید</div>
<h2 style="text-align: center;color: white;
  text-shadow: 2px 2px 4px #000000;">لیست تمام کاربران</h2><br>	
<ul class="users" style="list-style-type:none; background: linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);padding: 20px;"></ul>
<?php 
if(isset($_POST["submit1"])){

 
$con = mysqli_connect('localhost', 'root', '', 'User'); 
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$Pid=$_POST["submit1"];

$sql = "DELETE FROM logins WHERE Personid='$Pid'";

if (mysqli_query($con, $sql)) {
    echo "<br>Record deleted successfully<br>";
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);


         				}else{

if(isset($_POST["submit2"])){

 
$con = mysqli_connect('localhost', 'root', '', 'User'); 
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$Pid=$_POST["submit2"];

$sql = "UPDATE logins SET level=1 WHERE Personid='$Pid' ";

if (mysqli_query($con, $sql)) {
    echo "<br>Record updated successfully<br>";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
mysqli_close($con);


         				}

         			}

?>
 <a    href="kilid.php" style="text-decoration: none;" >باز گشت </a>
 <script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);

</script>

</body>

</html>

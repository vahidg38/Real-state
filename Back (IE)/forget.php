<?php 


?>
<!DOCTYPE html>
<html>
<head>
	<title>فراموشی رمز عبور</title>
	<style type="text/css">
		input{
 background-color: lightgreen;
  border-radius: 10px;
  border: none;
  color: black;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px;
  cursor: default;
    }
    *{
  font-size: 20px;
  font-family: b nazanin;
  font-weight: bold;
}
a{
text-decoration: none;


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
	<div id="snackbar">ابتدا شماره همراه یا ایمیل و سپس نام خود را وارد کنید<br> سپس رمز عبور جدید خود را وارد کرده و دکمه ارسال را فشار دهید</div>
	<h1 style="text-align: center;">فرم زیر را جهت تغییر رمز عبور تکمبل کنید</h1>
	<form method="post">
		<input type="text" name="input1" placeholder="شماره همراه یا ایمیل" required=""><br><br>
		<input type="text" name="input2" placeholder="نام" required=""><br><br>
		<input type="text" name="input3" placeholder="رمز عبور جدید" required=""><br><br>
		<input type="submit" name="submit" value="ارسال" style="cursor: pointer;">

	</form>

<a href="enter.php">بازگشت</a>
 <script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);

</script>
</body>
</html>

<?php 

if(isset($_POST["submit"])){
	
$email=$tel='null';

        $temp=$_POST['input1'];
        if(filter_var($temp, FILTER_VALIDATE_EMAIL)){
        	$email=$temp;
        }elseif (filter_var($temp, FILTER_VALIDATE_INT)) {
        	$tel=$temp;
        }else{
        	echo '<span style="color:white;background-color: black; weight=bold; font-size:25px;">  Invalid tellphone or email ! </span><br>';
        	exit;
        }

        $password=$_POST['input3'];
        $password=filter_var($password, FILTER_SANITIZE_STRING);

         $name=$_POST['input2'];
         $name=filter_var($name, FILTER_SANITIZE_STRING);


        $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");
     if($email=='null')
        $query=mysql_query("SELECT * FROM logins WHERE tel='".$tel."' AND name='".$name."'");
    else
    	 $query=mysql_query("SELECT * FROM logins WHERE email='".$email."' AND name='".$name."'");

        $numrows=mysql_num_rows($query);
        if($numrows==1)
        {
     if($email=='null') 	
         $sql = "UPDATE logins SET password='$password' WHERE name='$name' and tel='$tel' ";
     else
     	 $sql = "UPDATE logins SET password='$password' WHERE name='$name' and email='$email' ";

         $result=mysql_query($sql);

         if($result){
                 echo '<span style="color:white;background-color: black; weight=bold; font-size:25px;"> رمز عبور با موفقیت تغییر داده شد</span><br>';
            } else {
                echo "Failure!";
            }
        	
           
        } else {
            echo '<span style="color:white;background-color: black; weight=bold; font-size:25px;"> Not found !</span><br>';
        }




}





?>
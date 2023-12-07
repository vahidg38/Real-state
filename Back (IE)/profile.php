<?php 	
session_start();
$name=$_SESSION['sess_name'];
$tel=$_SESSION['sess_tel'];
$family=$_SESSION['sess_family'];
$password=$_SESSION['sess_password'];


if(isset($_POST["submit"])){
 if(!empty($_POST['nemail'])){

 	 $email=$_POST['nemail'];
  			if(filter_var($email, FILTER_VALIDATE_EMAIL)){

  		 $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");

        
        
        //$query=mysql_query("SELECT * FROM logins where password='$password' ");
        $query=mysql_query("SELECT * FROM logins WHERE  (email = 'null' ) and password='".$password."'");
        $numrows=mysql_num_rows($query);

        	
        if($numrows==1){
         $sql = "UPDATE logins SET email='$email' WHERE password='$password' ";
         $result=mysql_query($sql);

         if($result){
                echo "Account Successfully Updated";
            } else {
                echo "Failure!";
            }

         	          }

        else{

        	 echo "You cannot change your email after registeration";
        } 	


 														 }
 		else	
 		 echo "invalid email";											 

 							}



}



?>

<!DOCTYPE html>
<html>
<head>
	<title>ویرایش اطلاعات</title>
	<style type="text/css">
		button,a{	
  background-color: gray;
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
		input{
 background-color: lightgray;
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
    	color: white;
  font-size: 20px;
  font-family: b nazanin;
  font-weight: bold;
}

.send{
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
  cursor: pointer;
}
fieldset {
  display: block;
  background: white;
  width: 15%;
  margin-left: 2px;
  margin-right: 2px;
  padding-top: 0.35em;
  padding-bottom: 0.625em;
  padding-left: 0.75em;
  padding-right: 0.75em;
  border: 5px groove (internal value);
}
body{
	background: linear-gradient(110deg, #fdcd3b 60%, #ffed4b 60%);

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
	<div id="snackbar">اگر قبلا ایمیل خود را وارد نکرده اید میتوانید ایمیل خود را اضافه کنید</div>
	<h2 style="color: black;">Email:</h2>
<form action="" method="post">
	 <fieldset>
	<input type="text" class="field" name="nemail" required=""><br><br>
	<input type="submit" class="send" name="submit" value="ارسال"><br><br>
	 </fieldset>
</form>
<a href="kilid.php">بازگشت</a>
<script>

  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 8000);

</script>

</body>
</html>
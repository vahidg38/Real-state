<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="shortcut icon" href="shortcut.png" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		function reg(){

			document.getElementsByName('input1')[0].placeholder='نام';
			document.getElementsByName('input1')[0].required="required";

			document.getElementsByName('input2')[0].style="display:block;";	
			document.getElementsByName('input2')[0].placeholder='نام خانوادگی';
			document.getElementsByName('input2')[0].required="required";

			document.getElementsByName('input3')[0].style="display:block;";	
			document.getElementsByName('input3')[0].required="required";

			document.getElementsByName('news')[0].style="display:inline;";
			document.getElementsByName('newscheck')[0].style="display:inline;";

			document.getElementsByName('forget')[0].style="display:none;";
			document.getElementsByName('agree')[0].style="display:inline;";


			
			document.getElementsByName('e')[0].id="register";
			document.getElementsByName('r')[0].id="enter";


			
  		    
		}
		

	   function ent(){
	   		document.getElementsByName('input1')[0].placeholder='شماره همراه یا ایمیل';
			document.getElementsByName('input1')[0].required="required";

			document.getElementsByName('input2')[0].style="display:none;";	
			document.getElementsByName('input2')[0].placeholder='نام خانوادگی';
			document.getElementsByName('input2')[0].required="required";

			document.getElementsByName('input3')[0].style="display:none;";	
			document.getElementsByName('input3')[0].required="required";

			document.getElementsByName('news')[0].style="display:none;";
			document.getElementsByName('newscheck')[0].style="display:none;";

			document.getElementsByName('forget')[0].style="display:inline;";
			document.getElementsByName('agree')[0].style="display:none;";
			
		document.getElementsByName('e')[0].id="enter";
			document.getElementsByName('r')[0].id="register";
			


	   }
	</script>
</head>
<body>
	




	<div class="form1" >
		<div name="e" id="enter" onclick="ent()">ورود</div>
		<div name="r" id="register" onclick="reg()">ثبت‌نام</div>
		<div class="exit"><a href="kilid.php"><img class="cross" src="cross.png"></a></div>

		<form class="form2" action="" method="post">

		<div ><input  required="" name="input1"  placeholder="شماره همراه یا ایمیل" type="text" value=""></div>

		<div><input  required="" name="input2" value="نام خانوادگی"  type="text" style="display: none;">	</div>

		<div ><input required="" name="input3" value="شماره همراه یا ایمیل" placeholder="شماره همراه یا ایمیل" type="text" style="display: none;"></div>

		<div ><input required="" name="input4"  placeholder="رمز عبور" type="password" value=""></div>

		<div><span  name="forget">رمز خود را <a href="forget.php" class="forget">فراموش کرده ‌اید؟</a></span>

		<label name="news" style="display: none;">دریافت خبرنامه</label>

		<input  name="newscheck" style="display: none;" type="checkbox" id="checkbox" value="default">

		<div><span name="agree" style="display: none;" class="terms">ثبت نام به معنی قبول <a class="link" target="_blank" href="/terms">قوانین و مقررات</a> است</span></div>

       
        <button class="send" name="submit" value="ارسال" type="submit">ارسال</button></form>
      </div>





	</div>
<?php
if(isset($_POST["submit"])){

    if(!empty($_POST['input1']) && !empty($_POST['input4']) && $_POST['input2']=="نام خانوادگی") {
    	$email=$tel='null';

        $temp=$_POST['input1'];
        if(filter_var($temp, FILTER_VALIDATE_EMAIL)){
        	$email=$temp;
        }elseif (filter_var($temp, FILTER_VALIDATE_INT)) {
        	$tel=$temp;
        }else{
        	echo '<span style="color:white;background-color: black; weight=bold; font-size:25px;">  Invalid tellphone or email ! </span>';
        	exit;
        }

        $password=$_POST['input4'];
        $password=filter_var($password, FILTER_SANITIZE_STRING);
        	
        
        

        $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");
     if($email=='null')
        $query=mysql_query("SELECT * FROM logins WHERE tel='".$tel."' AND password='".$password."'");
    else
    	 $query=mysql_query("SELECT * FROM logins WHERE email='".$email."' AND password='".$password."'");

        $numrows=mysql_num_rows($query);
        if($numrows!=0)
        {
            while($row=mysql_fetch_assoc($query))
            {
                $dbname=$row['name'];
                $dbfamily=$row['family'];
                $dbpassword=$row['password']; 
                $dbtel=$row['tel'];
                $dbemail=$row['email'];
                $dblevel=$row['level'] ;       

               session_start();
                $_SESSION['sess_name']=$dbname;
                $_SESSION['sess_family']=$dbfamily;
                $_SESSION['sess_password']=$dbpassword;
                $_SESSION['sess_tel']=$dbtel;
                $_SESSION['sess_email']=$dbemail;
                $_SESSION['sess_level']=$dblevel;
              

                /* Redirect browser */
                header("Location: kilid.php");
            }
        } else {
            echo '<span style="color:white;background-color: black; weight=bold; font-size:25px;"> Not found !</span>';
        }

    } else {
        $email=$tel='null';
        $name=$_POST['input1'];
        $name=filter_var($name, FILTER_SANITIZE_STRING);

        $family=$_POST['input2'];
        $family=filter_var($family, FILTER_SANITIZE_STRING);

        $temp=$_POST['input3'];
          if(filter_var($temp, FILTER_VALIDATE_EMAIL)){
        	$email=$temp;
        }elseif (filter_var($temp, FILTER_VALIDATE_INT)) {
        	$tel=$temp;
        }else{
        	echo '<span style="color:white;background-color: black; weight=bold; font-size:25px;">  Invalid tellphone or email ! </span>';
        	exit;
        }

        $password=$_POST['input4'];
        $password=filter_var($password, FILTER_SANITIZE_STRING);

         $con=mysql_connect('localhost','root','') or die(mysql_error());
        mysql_select_db('User') or die("cannot select DB");

        $query=mysql_query("SELECT * FROM logins WHERE password='".$password."'");
        $numrows=mysql_num_rows($query);

        if($numrows==0){
         $sql="INSERT INTO logins(tel,email,name,family,password,level) VALUES('$tel','$email','$name','$family','$password',0)";
         $result=mysql_query($sql);

         if($result){
                echo "Account Successfully Created";
            } else {
                echo "Failure!";
            }

         	          }

        else{

        	 echo "That username already exists! Please try again with another.";
        } 	

    }
}
?>
</body>
</html>
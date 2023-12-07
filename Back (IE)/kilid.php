<?php
session_start();

if(isset($_SESSION['sess_name']))	{
echo '<span id="session">'.$_SESSION["sess_name"] .'  '.  $_SESSION["sess_family"].'(خروج)'.'</span>';
echo '<span id="provalue">'."  ویرایش پروفایل".'</span>';	

echo '<span id="mhousesvalue">'."  اضافه کردن خانه".'</span>';
		
}
if(!isset($_SESSION['sess_name'])){
echo '<span id="session">'." ورود/ثبت نام ".'</span>';	
echo '<span id="provalue">'."  ".'</span>';

echo '<span id="mhousesvalue">'."  ".'</span>';
$_SESSION['sess_level']=0;

}



if (isset($_SESSION['sess_name']) & $_SESSION['sess_level']==0) {
	echo '<span id="housesvalue">'."  تمام خانه های من".'</span>';
	echo '<span id="editvalue">'."  ویرایش یک خانه".'</span>';
}
if (!(isset($_SESSION['sess_name']) & $_SESSION['sess_level']==0)) {
	echo '<span id="housesvalue">'."  ".'</span>';
	echo '<span id="editvalue">'."  ".'</span>';
}

if (isset($_SESSION['sess_name']) & $_SESSION['sess_level']==1) {
	echo '<span id="housesvalue1">'."  تمام خانه های من".'</span>';
	echo '<span id="editvalue1">'."  ویرایش یک خانه".'</span>';
}
if (!(isset($_SESSION['sess_name']) & $_SESSION['sess_level']==1)) {
	echo '<span id="housesvalue1">'."  ".'</span>';
	echo '<span id="editvalue1">'."  ".'</span>';
}




if(isset($_SESSION['sess_level']) & $_SESSION['sess_level']==1 ){
echo '<span id="mpanelvalue">'."  پنل مدیریت".'</span>';
}
if(!(isset($_SESSION['sess_level']) & $_SESSION['sess_level']==1) ){
echo '<span id="mpanelvalue">'."  ".'</span>';
}
?>

<?php 
 if(isset($_POST["submit"])){
 		$_SESSION['sess_locality']=$_POST['search'];
 	    header("Location: search.php");
            
 	    


 }



 ?> 

<!DOCTYPE html>
<html>
<head>
	<title>سامانه خرید و فروش- رهن  و اجاره مسکن |کلید</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="shortcut.png" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
$(document).ready(function(){
	
	$("#register").html($("#session").html());
	$("#pro").html($("#provalue").html());
	$("#myhouses").html($("#housesvalue").html());
	$("#myhouses1").html($("#housesvalue1").html());
	$("#mhouse").html($("#mhousesvalue").html());
	$("#edit").html($("#editvalue").html());
	$("#edit1").html($("#editvalue1").html());
	$("#managerpanel").html($("#mpanelvalue").html());
if ($("#managerpanel").html()=="  پنل مدیریت") {

	$("#myhouses").hide();
	$("#edit").hide();
}else{
	$("#managerpanel").hide();
	$("#myhouses1").hide();
	$("#edit1").hide();
}
     if($("#mhouse").html() =="  اضافه کردن خانه") {
     				 var x = document.getElementById("snackbar");
 						 x.className = "show";
 						 setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

     }                      

 	$.getJSON( "http://hallows.ir/mags", function( data ) {
 
  
  $.each( data.items[0], function( key, val ) {
  	if (key=="image") {
  	 $("#mag1").attr("src",val);
  	}
  	if (key=="title") {
  		 $("#desc1").text(val);
  	}
  

  });

   $.each( data.items[1], function( key, val ) {
  	if (key=="image") {
  	 $("#mag2").attr("src",val);
  	}
  	if (key=="title") {
  		 $("#desc2").text(val);
  	}
   

  });
  $.each( data.items[2], function( key, val ) {
  	if (key=="image") {
  	 $("#mag3").attr("src",val);
  	}
  	if (key=="title") {
  		 $("#desc3").text(val);
  	}
   

  });
   $.each( data.items[3], function( key, val ) {
  	if (key=="image") {
  	 $("#mag4").attr("src",val);
  	}
  	if (key=="title") {
  		 $("#desc4").text(val);
  	}
   

  });
  
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
	color: white;
  text-shadow: 2px 2px 4px #000000;
  background: gray;
  text-align: center;
  border-radius: 12px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 70px;
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
<div id="snackbar">خوش آمدید</div>
<div class="nav">

<ul >
	 <li ><a  href="enter.php" id="register" >  ورود / ثبت نام</a><a  href="panel.php" id="managerpanel"></a></li>
	 <li><a href="">سامانه مشاورین</a><a  href="edit.php" id="edit"></a><a  href="edit1.php" id="edit1"></a></li>
	 <li><a href=""> آژانس‌های املاک </a><a href="makehouse.php" id="mhouse"></a></li>
	 <li><a href=""> اطلاعات بازار مسکن </a><a href="profile.php" id="pro"></a></li>
	 <li><a href=""> قیمت خانه شما </a><a href="myhouses.php" id="myhouses"></a><a href="myhouses1.php" id="myhouses1"></a></li>	
	 <li><a href="">ثبت رایگان آگهی</a></li>
	 <li><a href="">جستجو روی نقشه</a></li>
	 <li><a href="">رهن و اجاره</a></li>
	 <li><a href="myhouses1.php">خرید</a></li>
	 <li><img src="logo.png"></li>
	
 </ul>
</div>
<div class="middle">
<div class="search">		
		<label id="labelblock">کلید، سامانه هوشمند مسکن</label>	
		<button type="button" >قیمت خانه شما؟</button>
		<button type="button" >رهن و اجاره</button>
		<button type="button" >خرید</button>
</div>

<div class="searchinput"> 	
	<form method="post">
		
			<button type="submit" name="submit" ><img src="sicon.png"></button>
			<input type="text" name="search" placeholder="نام محله،منطقه یا ایستگاه مترو">

	   <img class="location" src="location.png">		
      <select  class="minimal">
        <option value="tehran">تهران</option>
        <option value="کرج">کرج</option>
        <option value="پردیس">پردیس</option>
        <option value="مشهذ">مشهد</option>
      </select>
      
  
	</form>

</div>	
</div>

<div class="information">
	<h2>بازار مسکن را ارزیابی کنید</h2>
	<img src="information.png">
	<p>در بازار مسکن، داشتن اطلاعات و داده های دقیق «طلایی ترین فرصتها» را<br>
		برای خریداران و سرمایه گذاران فراهم می کند. در کیلید این داده ها و<br>
		اطلاعات پردازش شده و نتیجه پردازش در اختیار مشترکان کیلید قرار می<br>
		گیرد. با تحلیل گذشته و رصد کردن امروز بازار مسکن، خانه آینده را بسازید.
		
	</p>
	<button> اطلاعات بازار مسکن</button>

</div>
<div class="magazine">
	<h2>مجله کیلید را بخوانید</h2>
	<p>.کارشناسان کیلید، در مجله "کیلید" شما را با مهم ترین مسائل بازار مسکن آشنا می کنند  <br>
		این مجله، مبتنی بر بررسی های علمی و آماری، اخبار و تحلیل های آینده بازار مسکن را
		.در اختیارتان قرار می دهد
		
	</p>

</div>
 
<div class="gallery">
  <a target="_blank" href="img_5terre.jpg">
    <img id="mag1"  src="1.jpg" alt="error" width="600" height="400">
  </a>
  <div id="desc1" class="desc">دلایل عجیب و حتی ترسناک برای اثاث کشی</div>
</div>

<div class="gallery">
  <a target="_blank" href="img_forest.jpg">
    <img id="mag2" src="2.jpg" alt="error" width="600" height="400">
  </a>
  <div id="desc2" class="desc">نکاتی برای خانواده‌ها به مناسبت شروع مدارس دانش آموزان کلاس اولی‌</div>
</div>

<div class="gallery">
  <a target="_blank" href="img_lights.jpg">
    <img id="mag3" src="3.jpg" alt="error" width="600" height="400">
  </a>
  <div id="desc3" class="desc">راهنمای خرید خانه 500میلیونی در تهران</div>
</div>

<div class="gallery" style="clear: left;">
  <a target="_blank" href="img_lights.jpg">
    <img id="mag4" src="3.jpg" alt="error" width="600" height="400">
  </a>
  <div id="desc4" class="desc">راهنمای خرید خانه 500میلیونی در تهران</div>
</div>


<div class="more">
<button> مطالب بیشتر</button>
</div>

<div class="sn">
	
	<a href=""><img id="ig" src="ig.png"></a>
	<a href=""><img id="in" src="in.png"></a>
	<a href=""><img id="twitter" src="twitter.png"></a>
	<a href=""><img id="telegram" src="telegram.png"></a>
</div>

<div class="footer">
	
		

	
	<ul>
	<li><a _ngcontent-c8="" href="/pro">سامانه مشاورین</a></li>
	<li><a _ngcontent-c8="" href="/real-estate-agencies">آژانس‌های املاک</a></li>	
	<li><a _ngcontent-c8="" href="/post-real-estate-listings/buy/step1?previewMode=false">ثبت رایگان آگهی</a></li>
	<li><a _ngcontent-c8="" href="/housing-market-insight">اطلاعات بازار مسکن</a></li>
	<li><a _ngcontent-c8="" href="/smart-real-estate-valuations">قیمت خانه شما</a></li>
	<li><a _ngcontent-c8="" href="/map?type=listing&amp;smartSearch=true&amp;locations=c_2301021576&amp;sort=kilid,DESC">جستجو روی نقشه</a></li>
	<li><a _ngcontent-c8="" href="/rent">رهن و اجاره</a></li>
	<li><a _ngcontent-c8="" href="/buy">خرید</a></li>
	
	

	
	
	
	

	</ul>

<div class="support">
	<a href=""><img src="im1.png"></a>
	<a href=""><img src="im2.png"></a>
	<a href=""><img src="im3.png"></a>
	<a href=""><img src="im4.png"></a>

</div>

<div class="end">
	<ul>
		<li><a _ngcontent-c8="" href="/sitemap">نقشه سایت</a></li>
		<li><a _ngcontent-c8="" href="/app-page/kilid-portal">اپلیکیشن موبایل</a></li>
		<li><a _ngcontent-c8="" href="https://kilid.com/mag/">بلاگ</a></li>
		<li><a _ngcontent-c8="" href="/contact">تماس با ما</a></li>
		<li><a _ngcontent-c8="" href="/about">درباره کیلید</a></li>

		
	</ul>

</div>
<div class="footerimage">
	<img src="end.png">
</div>
<div class="call">
	<p>
		تهران، خیابان وزرا، کوچه نهم، پلاک 26<br>
		021-75071000
	</p>
</div>


	

</div>
<div class="other">

	<label id="buy">خرید</label>
	<label id="b">اجاره</label>

	<ul id="c2">
	<li><a href="">پاسداران</a></li>	
	<li><a href="">شهرک غرب</a></li>	
	<li><a href="">ستارخان</a></li>	
	<li><a href="">ونک</a></li>	
	<li><a href="">مرزداران</a></li>	
    </ul>

	<ul id="c1">
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-tehranpars">تهرانپارس</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-punak">پونک</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-bolvar_ferdos">بلوار فردوس</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-saadat_abad">سعادت‌آباد</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-region10-navab">نواب</a></li>
	</ul>


	<ul id="c4">
	<li><a href="">پاسداران</a></li>	
	<li><a href="">شهرک غرب</a></li>	
	<li><a href="">ستارخان</a></li>	
	<li><a href="">ونک</a></li>	
	<li><a href="">مرزداران</a></li>	
    </ul>

	<ul id="c3">
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-tehranpars">تهرانپارس</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-punak">پونک</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-bolvar_ferdos">بلوار فردوس</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-saadat_abad">سعادت‌آباد</a></li>
	<li><a _ngcontent-c8="" class="single-neighbourhood ng-star-inserted" href="/buy/tehran-region10-navab">نواب</a></li>
	</ul>

   

    

</div>

<div class="right">
	<label>کلیه حقوق این سایت متعلق به شرکت کلان داده شهر فناوران می‌باشد</label>
	<a href="">حریم خصوصی</a>
	<a href="">شرایط استفاده</a>
</div>


	





  

  
  

 
  
  
 
  





</body>

</html>
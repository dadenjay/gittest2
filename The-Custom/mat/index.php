<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- mat.1.0.4 killed the NaN on price, fixed error on sizing sent to cart, nicened up the format -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Orderly Drawer Custom-Cut Mat</title>
	<link rel="shortcut icon" href="http://orderlydrawer.com/wp-content/uploads/2009/02/favicon.ico" >
	<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
	<script type="text/javascript">
		//Test for Javascript enabled
	    $("document").ready(function() {
			$("#jsEnabled").empty();
		});
		//Both listeners call the same function
		$(function() {
		   //listener for when width changes
		   $("#dwWidth").bind("keyup", formCalc);
		   //listener for when length changes
		   $("#dwDepth").bind("keyup", formCalc);
		   //listener for when color changes
		   $("select").change (formCalc);
		});
		//function to update everything
		function formCalc() {
			//fetch cell values into vars and get actual insert dims
			str = document.getElementById('dwWidth').value;
			var width = parseFloat(str);
			str = document.getElementById('dwDepth').value;
			var depth = parseFloat(str);	
			str = document.getElementById('mat_type').value;
			var mat_type = str;			
			//calculate and output the price
			var price = (width * depth) * .02;
			if (price < 2){price = 2};
			//show current price, if available
			if (price)
				{$("#priceResponse p span").html(price.toFixed(2));
				}else{$("#priceResponse p span").html(" Awaiting your Input");	
				};
			//$("#priceResponse p span").html(price.toFixed(2));
			//if price != NaN, then enable the link for shopping cart
			if (price)
				{document.getElementById('price').href="https://www.e-junkie.com/ecom/gb.php?c=cart&i=842536&cl=69858&ejc=2&amount=" + (price.toFixed(2) - 2) + "&on0=Options&os0=w" + width.toFixed(2) + ", d" + depth.toFixed(2) + ", " + mat_type;
				}else{document.getElementById('price').href="";
				};
			};			
			//create the string to go into the link for shopping cart
			//document.getElementById('price').href="https://www.e-junkie.com/ecom/gb.php?c=cart&i=842536&cl=69858&ejc=2&amount=" + (price.toFixed(2) - 2) + "&on0=Options&os0=w" + width.toFixed(2) + ", d" + depth.toFixed(2) + ", " + mat_type;
		//};
		function popitup(url) {
			newwindow=window.open(url,'name','height=550,width=230,screenX=10,screenY=10');
			if (window.focus) {newwindow.focus()}
			return false;
		};			
		</script>
	
	<link href="css/maincmjr800px.css" rel="stylesheet" type="text/css" />
</head>

<body onload="formCalc()">
<head>
    <title>Orderly Drawer Organizers  -  Drawer Mat</title>
    <?php
    include ("../../header.inc.php");
    ?>
<div id = "container">
			<h1>Custom-Cut Drawer Mat</h1>
			<div id = "content"
				<p>We offer three options for custom cut drawer mats.
				<ul>
				<li>The Red mat is rubberized and has a woven look with holes.</li>
				<li>The Beige/Tan mat has a solid, textured surface with rubberized backing.</li>
				<li>The Translucent mat is flexible plastic with ribbing.  It is shown below in a white bottomed drawer.</li>
				</ul>
				<img class = "horizontal" src = "http://orderlydrawer.com/wp-content/uploads/2011/02/dsc075841.jpg" width="250px">
				<img class = "horizontal" src = "http://orderlydrawer.com/wp-content/uploads/2010/11/002.jpg" width="250px">
				<img class = "horizontal" src = "http://orderlydrawer.com/wp-content/uploads/2010/11/dsc07598.jpg" width="250px">
				</p>
			</div>

    <?php
    include ("../../footer.inc.php");
    ?>
</body>
</html>


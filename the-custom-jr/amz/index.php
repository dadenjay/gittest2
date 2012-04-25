<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 25april12 had to rebuild this page for amz traffic to make the amz bot happy -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Custom Junior -- Design Yours</title>
   <?php
    include ("../../header.inc.php");
    ?>
        <div id = "container">
			<h1>Design Your "Custom Jr" Drawer Insert</h1>
			<p><a href = "/the-custom-jr">See Product Details</a></p>
            <p><span style="color: #f00000;"><em><strong>Note to Amazon customers: We have inserted some example values for the size of the "Custom Jr".  You will want to overwrite these values (in the boxes below) to match your drawer's internal width and your largest utensil size.</strong></em></span>

			<div id = "data">
				<div id = "leftdata">
					<noscript id = "jsEnabled">
						<p>Please enable Javascript to use this form.</p>
					</noscript>
					<form id = "formcalc" class="h5-defaults" action="">
						<fieldset>
							<legend>Personalize Your Insert:</legend>
							<h6> Please enter sizes in inches. <a href="/how-to-measure" target="_blank">(How to measure)</a> </h6>
							<h6> Use decimals, not fractions. <a href="http://orderlydrawer.com/wp-content/uploads/2011/07/fractiontodecimalpopup.jpg" onclick="return popitup('http://orderlydrawer.com/wp-content/uploads/2011/07/fractiontodecimalpopup.jpg')">(Helpful chart)</a> </h6>
							<input type="text" value="10 (example)" name="dwWidth" id="dwWidth" size="16" /> Internal Drawer Width <br />
							<div id = "widthResponse"><p> </p></div>
							<input type="text" value="9.875 (example)" name="utensilLength" id="utensilLength" size="16" /> Longest Utensil Length <br />
							<div id = "depthResponse"><p> </p></div>
							<div id = "divsResponse"><p>Movable Dividers included: <span>4</span></p></div>
							<div id = "btmPrice">
								<input class="btms" id="wBtm" type="checkbox" name="woodBtm" value="wBtm" /> Add a Wood Bottom:&nbsp;$<span></span>&nbsp;<a href="/attached-bottom" target="_blank">(Learn more)</a>
							</div>
							<div id = "priceResponse"><p>Price: $<span>20</span></p></div>
						</fieldset>
					</form><br/><br/>
					<a id = "price" class="button" href="" target="ej_ejc" class="ec_ejc_thkbx" onClick="javascript:return EJEJC_lc(this);">Please enable Javascript to use this form</a>
				    <p>(Custom Mat not included with this insert.  It is <a href="/the-custom-jr/mat">available here</a>.)</p>
				</div>
				<div id = "rightdatajr">
				    <img src="https://lh6.googleusercontent.com/-WzqwnnbN6a0/T2S1Ivw_7uI/AAAAAAAACs8/fejj0zuFU5k/s440/Jr-1.JPG"></img>

                </div>
			</div>
        </div>
    <?php
    include ("../../footer.inc.php");
    ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
    //Calcform code
    var Calcform =
    {
        init: function()
        {
            //pull out the No Javascript box -- no longer needed due to noscript tag
            //$("#jsEnabled").empty();
            //listener for when width changes
            $("#dwWidth").bind("keyup", Calcform.totalPrice);
            //listener for when length changes
            $("#utensilLength").bind("keyup", Calcform.totalPrice);
            //listener for btm checkbox
            $(".btms").change (Calcform.totalPrice);
            //right here I could call formcalc so as to update all calculations upon pageload
            Calcform.totalPrice();
        },
        widthFn: function()
        {
            str = document.getElementById('dwWidth').value;
            var cmjr_width = parseFloat(str)-.125;
            if (cmjr_width >= 16 || cmjr_width < 2.85)
            {
                $("#widthResponse p").html("Allowable widths: 3-16in");
                //this is vital to keep price from showing (rev 1.2.3)
                cmjr_width = "xOut";
            }
            else if (cmjr_width < 16 && cmjr_width >= 2.85)
            {
                $("#widthResponse p").html("This results in an insert width of " + cmjr_width.toFixed(2) + " inches.")
            }
            else
            {
                $("#widthResponse p").html("Please enter a number above.")
            }
            return cmjr_width;

        },
        divsFn: function(width)
        {
            //calculate and output number of divs
            if (width <= 9.9) {var divs = 4}
            else{divs = Math.ceil((width - 1.875)/2)};
            $("#divsResponse p span").html(divs.toFixed(0));
            return divs;

        },
        depthFn: function()
        {
            str = document.getElementById('utensilLength').value;
            var cmjr_depth = parseFloat(str)+ 1.125;
            //for depth, we need to disallow anything under 3" or over 13"
            if (cmjr_depth > 14.125 || cmjr_depth < 4.125)
            {
                $("#depthResponse p").html("Allowable utensil lengths: 3-13in");
                //this is vital to keep price from showing (rev 1.2.3)
                cmjr_depth = "xOut";
            }
            else if (cmjr_depth <= 14.125 || cmjr_depth >= 4.125)
            {
                $("#depthResponse p").html("This results in an insert depth of " + cmjr_depth.toFixed(2) + " inches")
            }
            else
            {
                $("#depthResponse p").html("Please enter a number above.")
            };
            return cmjr_depth;
        },
        subPriceFn: function(divs, depth)
        {
            //calculate and output the price
            if (depth <=11.125) {var depth = 11.125};
            var price = 20 + ((divs - 4) * 2) + (1 + (divs - 4) * .5) * (depth - 11.125);
            return price;
        },
        btmPriceFn: function(width, depth)
        {
            //calculate and output the btm price
            var btmPrice = 10 + (width * depth * .01);
            return btmPrice;
        },
        totalPrice: function()
        {
            $("#price").text('Form Incomplete');
            var width = Calcform.widthFn();
            //console.log("width is %s", width);
            if (width)
            {
                var divs = Calcform.divsFn(width);
            };
            //console.log("divs is %s", divs);
            var depth = Calcform.depthFn();
            //console.log("depth is %s", depth);
            if (width && divs && depth)
            {
                var price = Calcform.subPriceFn(divs, depth);
                //console.log("price is %s", price);
                var btmPrice = Calcform.btmPriceFn(width, depth);
                //console.log("btmPrice is %s", btmPrice);
            };
            //add bottom price to total price if checked
            var btmOut = "noBtm";
            if (btmPrice)
            {$("#btmPrice span").html(btmPrice.toFixed(2));
            }
            if (document.getElementById("wBtm").checked){price = price + btmPrice; btmOut = "wbtm"};
            //end of wood bottom pricing section
            //show current price, if available
            if (price)
            {$("#priceResponse p span").html(price.toFixed(2));
                //adjusts price for minimum charge in cart
                price -= 20;
                //fix the anchor text and the url of checkout button
                $("#price").text('Add to Shopping Cart');
                document.getElementById('price').href="https://www.e-junkie.com/ecom/gb.php?c=cart&i=857033&cl=69858&ejc=2&amount=" + (price.toFixed(2)) + "&on0=Options&os0=w" + width.toFixed(2) + ", d" + depth.toFixed(2) + " Code m" + divs + btmOut;
            }else{$("#priceResponse p span").html(" Awaiting your Input");
                document.getElementById('price').href="";
            }
        }
    }
    Calcform.init();
    function popitup(url) {
        newwindow=window.open(url,'name','height=550,width=230,screenX=10,screenY=10');
        if (window.focus) {newwindow.focus()}
        return false;
    }
</script>

<!--</html>-->

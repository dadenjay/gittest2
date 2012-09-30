<?php
    $dom = simplexml_load_file($_GET['t'].".xml");
	$gen = simplexml_load_file("od.xml");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Design with Template #</title>
    <?php
    include ("../../header.inc.php");
    ?>
        <div id = "container">
            <h1>Custom Insert - <?php echo $dom->templates->template->name;	?> Design
	        </h1>
            <p> <span style="color:red"> NOTE TO INTERNET EXPLORER USERS: This form is currently not working in Microsoft IE browsers.  Please use Firefox or Chrome to complete this form.  Or, you can email the content of your form to info@OrderlyDrawer.com</span></p>
            <div id = "data">
                <div id = "leftdata">
	                <noscript id = "jsEnabled">
		                <p>You do not have Javascript enabled.  Please use <a href="../the-custom">our old form</a>.</p>
	                </noscript>
	<!-- width and depth fields with response divs -->
                    <form id = "formcalc" class="h5-defaults" action="">
                        <fieldset>
                        <legend>Personalize Your Insert:</legend>
                        <h6> Please enter sizes in inches. <a href="/how-to-measure" target="_blank">(Measuring tips)</a> </h6>
                        <h6> Use decimals, not fractions. <a href="http://orderlydrawer.com/wp-content/uploads/2011/07/fractiontodecimalpopup.jpg" onclick="return popitup('http://orderlydrawer.com/wp-content/uploads/2011/07/fractiontodecimalpopup.jpg')">(Helpful chart)</a> </h6>
                        <input type="text" placeholder="12.13 (example)" name="dwWidth" id="dwWidth" class="chg" size="16" /> Internal Drawer Width <br />
                        <div id = "widthResponse"><p> </p></div>
                        <input type="text" placeholder="18.75 (example)" name="dwDepth" id="dwDepth" class="chg" size="16" /> Internal Drawer Depth <br />
                        <div id = "depthResponse"><p> </p></div>
	<!-- loop for height options selectbox -->

           <select name="height" id="height">
                <?php
                    foreach ($gen->heights->height as $ht)
                    {
                        echo '<option value="'.$ht['ht'].'" data-cost="'.$ht->cost.'">';
                        echo $ht['ht'].'" tall = $';
                        echo $ht->cost.' per square inch</option>';
                    }
                ?>
            </select> Height of Your Insert <br /><br />
	
	<?php
		$var = $_GET['t'];
		$dimsy = $dom->xpath("//template[@t='$var']/dims");
		$dims = $dimsy[0];
		foreach ($dims as $dim) 
		{
			if (isset($dim->max))
			{
				echo '<input type="text" name="driver'.$dim['name'].'" id="driver';
				echo $dim['name'].'" class="chg" size="6" /> Dimension '.$dim['name'];
				echo ' (Min 3", Max <span id="mx'.$dim['name'].'">TBD</span>")<br />';
			}
			else if (isset($dim->res))
			{
				echo '<div class="so">So, '.$dim['name'].' = <span id = "result'.$dim['name'].'"></span> min.</div>';
			}
			echo '<br />';
		}
		echo '<p class="calcSubTitle">--- Movable Dividers in Each Section <a href="/movable-dividers" target="_blank">(learn more)</a>  --- <br/><h6> Use the "plus" and "minus" below to change the quantity of dividers</br>Learn about scooped divs <a href="/scooped-dividers"target="_blank">here</a></h6></p>';
		$secGrp = $dom->xpath("//template[@t='$var']/sections");	
		$sections = $secGrp[0];

		foreach ($sections as $sec)
		{
			echo 'Sec. '.$sec['name'].': Qty Reg Divs = <span id = "sec'.$sec['name'].'"></span> ';
			echo '<a title="Add another regular divider to this section" class="plusminus" id="plus'.$sec['name'].'" name="1" href="">+</a> ';
			echo '<a title="Remove a regular divider from this section" class="plusminus" id="minus'.$sec['name'].'" name="-1" href="">-</a> ';
			echo '<input id="k'.$sec['name'].'" name="k'.$sec['name'].'" type="hidden" value="0" />';		
			echo '<span class="hideScoop">   Qty Scooped Divs = <span class="scoopNum" id = "scoop'.$sec['name'].'">0</span> ';
			echo '<a title="Add a scooped divider to this section" class="scoopPlusMinus" id="scoopPlus'.$sec['name'].'" name="1" href="">+</a> ';
			echo '<a <a title="Remove a scooped divider from this section" class="scoopPlusMinus" id="scoopMinus'.$sec['name'].'" name="-1" href="">-</a></span><br/>';
		}
		//okay, at this point, the SimpleXMLElement command leaves us with two different structures in the object, 
			//depending on whether there is more than one element inside the "section" section of the xml file
			//So, the code below is to fix the object for templates #101 and 108 that have only one section in them
			//Strangely, the section below was still working fine for both, but the Javascript couldn't handle the difference
		//If $sections[0] does not exist, then save the guts of $sections into $section[0]
		// if (!(property_exists('sections', '0')))
		// {
			// echo 'Bugfix modification initiated';
			// $sections[0] = $sections;	
		// }
		//couldn't come up with an effective existence test nor a way to interpolate a parent so the rest of form works
	?><br/>
	<p class="calcSubTitle">-- Bottom Options --</p>
	<div id = "btmPrice">
		<input class="btms" id="wBtm" type="radio" name="Btm" value="wBtm" /> Add a Wood Bottom:&nbsp;$<span class="wood"></span>&nbsp;<a href="/attached-bottom" target="_blank">(Learn more)</a>
		Increases insert height by 0.19"
		<br/><input class="btms" id="rMat" type="radio" name="Btm" value="rMat" /> Add a Red Mat:&nbsp;$<span class="mat"></span>&nbsp;<a href="/the-custom/mat" target="_blank">(Learn more)</a>
		<br/><input class="btms" id="tMat" type="radio" name="Btm" value="tMat" /> Add a Tan Mat:&nbsp;$<span class="mat"></span>
		<br/><input class="btms" id="cMat" type="radio" name="Btm" value="cMat" /> Add a Clear Mat:&nbsp;$<span class="mat"></span>
		<br/><input class="btms" id="none" type="radio" name="Btm" value="none" checked="true" data-cost="0"/> No Bottom
        <br/><h6>Need a mat sized differently from your insert?  Instead of selecting one above, <a href="/the-custom-jr/mat/" target="_blank">order a custom sized mat here.</a></h6>
	</div>
	<div id = "priceResponse"><p class="calcSubTitle">Price: $<span>40</span></p></div>
	<h6>Order totals over $200 ship free.</h6>
	<div class = "callout">
		<a id = "price" class="button" href="" target="ej_ejc" class="ec_ejc_thkbx" onClick="javascript:return EJEJC_lc(this);">Please enable Javascript to use this form</a>
	</div>
<!--    <div>-->
<!--        <img src="--><?php //echo $dom->templates->template->img;	?><!--" alt="custom drawer organizer layout">-->
<!--    </div>-->
	
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 
<!--<script src="jquery-1.6.min.js"></script>-->

	<script type="text/javascript">
	//Calcform code
	var Calcform = {
		init: function(){
		   //listener for when anything with "chg" class changes
		   $(".chg").bind("change", Calcform.totalPrice);
		   //listener for when div clickers get a click.  
		   $(".plusminus").bind("click", Calcform.clickerFn);
		   //listener for when scoop clickers get a click.  
		   $(".scoopPlusMinus").bind("click", Calcform.scoopClickerFn);
			//listener for btm checkbox. 
		   $(".btms").change (Calcform.totalPrice);
		   //listener for change in value of height
		   	$("#height").change (Calcform.clearScoopFn);
		   //right here I could call formcalc so as to update all calculations upon pageload
		   Calcform.totalPrice();
		},
		widthFn: function()	{
			//TODO: add special notice for width over 24"
			
			str = document.getElementById('dwWidth').value;
			var ins_width = parseFloat(str)-.125;
			if (ins_width >= 35.85 || ins_width < 3.85)
				{
				$("#widthResponse p").html("Allowable widths: 4-36 in.");
				//this is vital to keep price from showing (rev 1.2.3)
				ins_width = "xOut";
				}
			else if (ins_width < 35.85 && ins_width >= 3.85)
				{
				$("#widthResponse p").html("This results in an insert width of " + ins_width.toFixed(2) + " inches.")
				}
			else 				
				{
				$("#widthResponse p").html("Please enter a number above.")
				}
			return ins_width;		
		},
		depthFn: function(){
			str = document.getElementById('dwDepth').value;
			var depth = parseFloat(str)- .25;
			//for depth, we need to disallow anything under 3" or over 13"
			if (depth > 35.85 || depth < 3.85)
				{
				$("#depthResponse p").html("Allowable depths: 4-36 in.");
				//this is vital to keep price from showing (rev 1.2.3)
				depth = "xOut";				
				}
			else if (depth <= 35.85 || depth >= 3.85)
				{
				$("#depthResponse p").html("This results in an insert depth of " + depth.toFixed(2) + " inches")
				}
			else 				
				{
				$("#depthResponse p").html("Please enter a number above.")
				};
			return depth;
		},
		heightFn: function() {
			var sel = document.getElementById("height");
			var ht = sel.value;
			var selected = sel.options[sel.selectedIndex];
			var htCost = parseFloat(selected.getAttribute('data-cost'));
			if (ht < 2.1)
			{
				$(".hideScoop").hide("slow");
			}
			else
			{
				$(".hideScoop").show("slow");	
			}			
			return htCost;
		},
		dimsnDivsFn: function(width, depth) {
			//var addedInches = 0;  -- I think this is obsolete
			//get array here from Php
			<?php
			$var = $_GET['t'];
			$php_array = $dom->xpath("//template[@t='$var']/dims");
			$actual_array = $php_array[0];
			$js_array = json_encode($actual_array);
			echo "var xml_dims = jQuery.parseJSON('". $js_array ."');";
			?>
			insD = depth;
			insW = width;
			var dimsList = new Object();
			var complete = 1;
			var dimA = 'null';
			var dimB = 'null';
			var dimC = 'null';
			var dimD = 'null';
			var dimE = 'null';
			var dimF = 'null';
			var dimG = 'null';
			var dimH = 'null';
			var dimI = 'null';
			var dimJ = 'null';
			var dimK = 'null';
			var dimL = 'null';
			
			//loop through ABC dimensions 
			for (var i in xml_dims.dim){	
				if (xml_dims.dim[i].max)
				{
					//grab formula for max, compute max value if we can, and write it into min/max text
					var result = xml_dims.dim[i].max;
					var max = eval(result);
					//establish name of dim and the output id
					var name = xml_dims.dim[i].name;
					var spanId = "mx" + name;
                    //if the result of max calculation is a number
					if (!isNaN(parseFloat(max)))
					{
						//write max value to the output span
						$('#' + spanId).html(max.toFixed(3));
						//grab the entered value
						var id = "driver" + name;
						var temp = document.getElementById(id).value;
						if (temp >= 3 && temp <= max){dimsList[name] = temp;}
						else{
							//if not in range,  var = null, and TODO turn the min/max text red
							temp = 'null';
							complete = 0;
						}
					}
                    //if not a number, then mark form as incomplete
					else 
					{
						complete = 0;
						$('#' + spanId).html("(...pending)");					
					}
				}
				else if (xml_dims.dim[i].res)
				{
					//get the formula for output from array
					var result = xml_dims.dim[i].res;
					var temp = eval(result);
					var name = xml_dims.dim[i].name;
					var divId = "result" + name;					
					if (!isNaN(parseFloat(temp)))
					{
						$('#' + divId).html(temp.toFixed(3));
						//dimsList[name] = temp; --doesn't seem necessary to send this result to our code string
					}
					else 
					{
						$('#' + divId).html("(...pending)");
					}
				}	
				//put into array/object under its dim name used in the xml
				if(name=='A'){dimA=temp;}
				else if(name=='B'){dimB=temp;}
				else if(name=='C'){dimC=temp;}
				else if(name=='D'){ dimD=temp;}
				else if(name=='E'){ dimE=temp;}
				else if(name=='F'){ dimF=temp}
				else if(name=='G'){ dimG=temp}
				else if(name=='H'){ dimH=temp}
				else if(name=='I'){ dimI=temp}

			}
			if (complete != 0) {
				//BEGIN THE "DIVS" SECTION
				//console.log("begin divs section");
				//set up an array to hold the output of divs/scoops from a "section loop"
				var divsList = new Object;
				divsList.divs = {};
				divsList.scoops = {};
				var modDivLength = 0;
				//pull in xml data for sections and start looping them
				<?php
				$sections_xml = $dom->xpath("//template[@t='$var']/sections");
				$sections_array = $sections_xml[0];
				$js_sections = json_encode($sections_array);
				echo "var xml_sections = jQuery.parseJSON('". $js_sections ."');";
				?>
				//see note on approx line 70.  I was unable to standardize the object there for the edge cases 101 and 118
				//so, I'm going to try to do it here, using javascript
				//if section[0] is undefined, then 
				if (!(xml_sections.section[0]))
				{
					console.log("initiating workaround");
					var tempy = new Object;
					tempy = xml_sections.section;
					xml_sections.section = {};
					xml_sections.section[0] = tempy;
				}	
				//loop sections to get # of divs and scoops needed in each section.  Foreach:
				for (var i in xml_sections.section){
				//use section data to find official number of divs -- see formula on planning sheet
					//grab the withDivs and acrossDivs values from the xml for this loop
                    var withDivs = parseFloat(eval(xml_sections.section[i].withDivs));
                    var acrossDivs = parseFloat(eval(xml_sections.section[i].acrossDivs));
                    var name = xml_sections.section[i].name;
                    //plug them into formulas to get recommended number of divs
                    var numDivs = Math.ceil(((.94 * acrossDivs)-1.875)/2);
                    //fetch the value from the hidden cell
                    var hidId = "k" + name;
                    var chg = parseFloat(document.getElementById(hidId).value);
                    //now add those two together to get the actual number of divs they want
                    var actual = parseFloat(numDivs) + parseFloat(chg);
                    //so that a single click on the plus will always add a div, whenever actual is neg, we could overwrite the value of the hid cell to equal the neg of the value of numDivs
                    if (actual < 0) {
                        actual = 0;
                        //document.getElementById("hidId").value =((-1) * (numDivs));
                        //$('#' + hidId).value((-1) * (numDivs));
                        var temp8 = document.getElementById("hidId");
                        temp8.value = 26;
                    }
                    //Here's the original code, where we merely prevent the form from showing or registering a negative value
                    //if (actual < 0) {actual = 0};
                    //write that number onto the line for Qty Reg Divs
                    var spanId = "sec" + name;
                    if (!isNaN(actual)){
                        $('#' + spanId).html(actual.toFixed(0));
                        //write that value into the divsList object
                        divsList.divs[name] = actual;
                        //use mod and the length of the section to find the total length of their increment/decrement
                        if (-chg > numDivs){modDivLength -= (numDivs * (withDivs + .375))}
                        else {modDivLength += (chg * (withDivs + .375))};
                    }
                    //use name to get id of scoop qty location
                    var scoopLoc = "scoop" + name;
                    //call that id to get value of scoops
                    var scoopTemp = parseFloat($('#' + scoopLoc).text());
                    //put it into the object
                    divsList.scoops[name] = scoopTemp;
				}
			//return array of arrays/vars to master(): ABC array, divs per section array, inches added per section, scoops per section
			var passDnD = [dimsList, divsList, modDivLength];
				//console.log("in DnD func: length of divs added is %s", passDnD[2]);
			return passDnD;
			}
		},
		clickerFn: function(event) {
			event.preventDefault();
			//GET THE VALUE ASSIGNED TO THIS CLICKER
			var put = parseFloat($(this)[0].name);
			var idString = $(this)[0].id;
			var idLetter = idString.charAt(idString.length - 1);
			//console.log("idLetter is %s", idLetter);
			//GET THE CURRENT VALUE OF THE HIDDEN FIELD 
			var keep = parseFloat($('#k' + idLetter).val());
			//console.log("keep is %s", keep);
			//CHG VALUE OF HIDDEN FIELD BY THE AMOUNT OF THE CLICKER
			var sum = put + keep;
			$('#k' + idLetter).val(sum);
			//console.log("sum is %s and so should be value of hidden cell", sum);
			//CALL MASTER FUNCTION
			Calcform.totalPrice();
		},
		scoopClickerFn: function(event) {
			event.preventDefault();
			//GET THE VALUE ASSIGNED TO THIS CLICKER
			var put = parseFloat($(this)[0].name);
			//hack to get the current ABC value of this section
			var idString = $(this)[0].id;
			var idLetter = idString.charAt(idString.length - 1);
				//console.log("idLetter is %s", idLetter);
			//use ABC section value to get current value of visible field
			var keep = parseFloat($('#scoop' + idLetter).text());
				//console.log("keep is %s", keep);
			//increment the value appropriately
			var newScoop = put + keep;
			if (newScoop < 0) {newScoop = 0};
			//post new val
			$('#scoop' + idLetter).text(newScoop)
			//call master
			Calcform.totalPrice();
		},
		clearScoopFn: function() {
			//get value of current selection in height Select
			var curHt = parseFloat($('#height').val());	
			//if new value is 1.5 or 2
			if (curHt <= 2) {
				//zero the qty of all previous Scoop additions 	
				$('.scoopNum').text("0");
			}
			//call master
			Calcform.totalPrice();
		},
		btmPriceFn: function(width, depth) {
			//calculate and output the btm price
			var btmPrice = 10 + (width * depth * .01);
			$(".wood").html(btmPrice.toFixed(2));
			$("#wBtm").attr('data-cost', btmPrice.toFixed(2));
			//calculate and write the mat prices
			var matPrice = (width * depth * .02);
			$(".mat").html(matPrice.toFixed(2));
			$("#rMat").attr('data-cost', matPrice.toFixed(2));
			$("#tMat").attr('data-cost', matPrice.toFixed(2));
			$("#cMat").attr('data-cost', matPrice.toFixed(2));
		},	
		totalPrice: function() {
		    $("#price").text('Form Incomplete');
			var width = Calcform.widthFn();
				//console.log("width is %s", width);
			var depth = Calcform.depthFn();
				//console.log("depth is %s", depth);
			var htCost = Calcform.heightFn();
				//console.log("height cost is %s", htCost);
			//here are chores we want to handle once we have width and depth	
			if (width && htCost && depth){
				var price = htCost * width * depth;
				$("#priceResponse p span").html(price.toFixed(2));
				//console.log("price is %s", price);
				Calcform.btmPriceFn(width, depth);
				//console.log("btmPrice is %s", btmPrice);
				var passDnD = Calcform.dimsnDivsFn(width, depth);
			};	
			//here are chores to do only if we have gotten the return from DnD function
			if (passDnD) {
				//figure itemized costs and code snippets for various items
				//code snippet for the dim values 
				var dimSnippet = '';
				for (object in passDnD[0]){
					dimSnippet += object + passDnD[0][object];
				}
				//get snippet for the # of divs in each section, meanwhile add up how many sections = 0
				var divSnippet = '';
				var numZeroedSections = 0;
				for (object in passDnD[1].divs){
					divSnippet += object + passDnD[1].divs[object];
					//to determine if no slots will be needed, get num of scoops in this section 
					//var tempNumScoops = passDnD[1].scoops[object];
					//if no scoops or divs in this section, then we can initiate discount
					if ((passDnD[1].divs[object] == 0) && (passDnD[1].scoops[object]== 0)){numZeroedSections += 1};
				}
				//get price discount for sections that are zeroed
				price -= numZeroedSections * 25 * htCost; //includes consideration for height
					console.log("price after zeroed sections is %s", price);
					console.log("number of zeroed sections is %s", numZeroedSections);
				//get markup/markdown for total inches of divs added/removed
				price += (passDnD[2] * .8 * htCost); //for now we'll say 10c per inch of div changed
					//console.log("price after dividers removed is %s", price);
				//get snippet for the scoops in each section, meanwhile add up total # of scoops
				var scoopSnippet = '';
				var numScoops = 0;
				for (object in passDnD[1].scoops){
					scoopSnippet += object + passDnD[1].scoops[object];
					numScoops += parseFloat(passDnD[1].scoops[object]);
				}
                //need to fix this so they are charged the value of the div plus $3, but we've left the loop so we don't know how long the div is!
				price += parseFloat(numScoops * 3);
				//modify price for selected value of btm
				var btm = $('input[type=radio]:checked').attr('value');
				var btmCharge = parseFloat($('input[type=radio]:checked').attr('data-cost'));
				price += btmCharge;
				if (price < 40){price = 40}; //may want to adjust this for various hts at some point
				//show current/full/final price, if available
				$("#priceResponse p span").html(price.toFixed(2));
				//adjust price for minimum charge in cart	
				price -= 40;
				//get the template number via PHP
				<?php
				echo "var template = ". $_GET['t'] .";";
				?>
				var sel = document.getElementById("height");
				var ht = sel.value;
				var code = "T"+template+price.toFixed(0)+"W"+insW+"D"+insD+"H"+ht+dimSnippet+","+divSnippet+","+scoopSnippet+","+btm;
				$("#price").text('Add to Shopping Cart');
                document.getElementById('price').href="https://www.e-junkie.com/ecom/gb.php?c=cart&i=263445&cl=69858&ejc=2&amount=" + (price.toFixed(2)) + "&on0=Options&os0=" + code;
//                document.getElementById('price').target="ej_ejc";
//                document.getElementById('price').class="ec_ejc_thkbx";
//                document.getElementById('price').onClick="javascript:return EJEJC_lc(this);";
//                document.getElementById('price').alt="Add this insert to Cart";
                $("#price").attr('alt', 'howdy');

			}else{$("#priceResponse p span").html(" Awaiting your Input");	
			document.getElementById('price').href="";
            }
        }
	};

	Calcform.init();

	function popitup(url) {
		newwindow=window.open(url,'name','height=550,width=230,screenX=10,screenY=10');
		if (window.focus) {newwindow.focus()}
		return false;
		};

	</script>
    </div>
    <!-- TODO - MOVE THIS UP WITH THE HTML -->
    <div id = "rightdata">
        <div>
            <p style="margin-left:15px" "margin-top:0px">
            <a href="http://www.screencast.com/t/TntkQRPe8BG"target="_blank"><img src="https://lh5.googleusercontent.com/-Ynd9YS-RRbY/T6sw2sur7wI/AAAAAAAAJ3o/ktPnhMRgwLw/s252/OrderForm%2520pt1.jpg"></a><br/>
            <a href="http://www.screencast.com/t/wFzCQoCe"target="_blank">Video: part 2</a><br/>
            <a href="http://www.screencast.com/t/e0bIf8gMv"target="_blank">Video: part 3</a><br/>
            <br/>
            </p>
            <img src="<?php echo $dom->templates->template->img;	?>" alt="custom drawer organizer layout">
        </div>
    </div>
    </div>
            </div>
<?php
include ("../../footer.inc.php");
?>

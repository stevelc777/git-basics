<?php echo("hello world");
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			var cnt = 1;
			doOmo = 0;
			doneClick = 0;
			undoStack = "";
			var nextMove = new Array();
			nextMove[0] = "9999101799999999";
			nextMove[1] = "9999111816999999";
			nextMove[2] = "9999121917089999";
			nextMove[3] = "9999132018099999";
			nextMove[4] = "9999142119109999";
			nextMove[5] = "9999152220119999";
			nextMove[6] = "9999992321129999";
			nextMove[7] = "9999999922139999";

			nextMove[8] = "9902182599999999";
			nextMove[9] = "9903192624999999";
			nextMove[10] = "9904202725160099";
			nextMove[11] = "9905212826170199";
			nextMove[12] = "9906222927180299";
			nextMove[13] = "9907233028190399";
			nextMove[14] = "9999993129200499";
			nextMove[15] = "9999999930210599";

			nextMove[16] = "0110263399999999";
			nextMove[17] = "0211273432999900";
			nextMove[18] = "0312283533240801";
			nextMove[19] = "0413293634250902";
			nextMove[20] = "0514303735261003";
			nextMove[21] = "0615313836271104";
			nextMove[22] = "0799993937281205";
			nextMove[23] = "9999999938291306";

			nextMove[24] = "0918344199999999";
			nextMove[25] = "1019354240999908";
			nextMove[26] = "1120364341321609";
			nextMove[27] = "1221374442331710";
			nextMove[28] = "1322384543341811";
			nextMove[29] = "1423394644351912";
			nextMove[30] = "1599994745362013";
			nextMove[31] = "9999999946372114";

			nextMove[32] = "1726424999999999";
			nextMove[33] = "1827435048999916";
			nextMove[34] = "1928445149402417";
			nextMove[35] = "2029455250412518";
			nextMove[36] = "2130465351422619";
			nextMove[37] = "2231475452432720";
			nextMove[38] = "2399995553442821";
			nextMove[39] = "9999999954452922";

			nextMove[40] = "2534505799999999";
			nextMove[41] = "2635515856999924";
			nextMove[42] = "2736525957483225";
			nextMove[43] = "2837536058493326";
			nextMove[44] = "2938546159503427";
			nextMove[45] = "3039556260513528";
			nextMove[46] = "3199996361523629";
			nextMove[47] = "9999999962533730";

			nextMove[48] = "3342589999999999";
			nextMove[49] = "3443599999999932";
			nextMove[50] = "3544609999564033";
			nextMove[51] = "3645619999574134";
			nextMove[52] = "3746629999584235";
			nextMove[53] = "3847639999594336";
			nextMove[54] = "3999999999604437";
			nextMove[55] = "9999999999614538";

			nextMove[56] = "4150999999999999";
			nextMove[57] = "4251999999999940";
			nextMove[58] = "4352999999994841";
			nextMove[59] = "4453999999994942";
			nextMove[60] = "4554999999995043";
			nextMove[61] = "4655999999995144";
			nextMove[62] = "4799999999995245";
			nextMove[63] = "9999999999995346";
			
			function init(){
				for (a=0;a<64;a++){
					document.getElementById(a+"").style.background = "white";
				}
			}
			function setStyle(i,c){
				document.getElementById(i).style.color = c;
				document.getElementById(i).style.fontSize = "2.5em";
				document.getElementById(i).style.textAlign = "center";
				document.getElementById(i).style.background = "green";
			}
			function clearColour(colour){
				for (a=0;a<64;a++){
					if (document.getElementById(a+"").style.background == colour){
						document.getElementById(a+"").style.background = "white";
					}
				}
			}
			function orangeToRed(){
				for (a=0;a<64;a++){
					if (document.getElementById(a+"").style.background == "orange"){
						document.getElementById(a+"").style.background = "red";
					}
				}
			}
			function whiteToYellow(){
				for (a=0;a<64;a++){
					if (document.getElementById(a+"").style.color == "white"){
						setStyle(a,"yellow");
					}
				}
			}
			function omo(i){
				clearColour("orange");
				j = parseInt(i);
				
				for (b=0;b<8;b++){ // traverse the array element string
					var redsq = parseInt(nextMove[j].substr(2*b,2));
					if (redsq<99){
						for (a=0;a<64;a++){
							var aa = document.getElementById(a+"").style.background;
							if (aa=="red" || aa=="green"){} else {
								document.getElementById(a+"").style.background = "white";
								document.getElementById(a+"").style.color = "black";
								document.getElementById(a+"").innerHTML = "here";
							}
						}
						if (document.getElementById(redsq+"").style.background == "white"){
							document.getElementById(redsq+"").style.background = "orange";
						}
					}
				}
			}
			function oc(i){
				if (doneClick==0){
					doneClick = 1;
					doOmo = 1;
					document.getElementById(i).innerHTML = "1";
					setStyle(i,"white")
					omo(i);
					orangeToRed();
					uStack(i);
					return;
				}
				if (document.getElementById(i).style.background == "red"){
					cnt++;
					document.getElementById(i).innerHTML = cnt+"";
					whiteToYellow();
					setStyle(i,"white");
					clearColour("red");
					orangeToRed();
					uStack(i);
				}
			}
			function uStack(i){
				var iPadded = i;
				if (parseInt(i)<10){
					iPadded = "0"+i;
				}
				undoStack = undoStack+iPadded;
				document.getElementById("lbl").innerHTML = undoStack;
			}
			function undoMove(){
//				alert(undoStack.substr(-4,2));
				var oldVal = undoStack.substr(-2,2);
				var newVal = parseInt(oldVal)+""; // remove leading zero from string value
				document.getElementById(newVal).innerHTML = "";
				document.getElementById(newVal).style.background = "white";
				clearColour("orange");
				clearColour("red");
				omo(undoStack.substr(-4,2)); // place orange squares from last pos
				orangeToRed(); // make these red
				undoStack = undoStack.substr(0,undoStack.length-2);
				document.getElementById("lbl").innerHTML = undoStack;
				cnt--;
				if (undoStack==""){
					clearColour("red");
					doneClick = 0;
//					doOmo = 0;
					cnt++;
				}			
			}
		</script>
	</head>
	<body onload="init();">
	<div id="lbl">...</div>
	<div id="lbl1">...</div>
	<div id="lbl2">...</div>
	<div id="lbl3">...</div>
	<div id="lbl4">...</div>
		<button style="position:absolute;top:200px;width:200px;height:200px;left:600px;background:purple;color:white;font-size:1.8em;" onclick="undoMove();">UNDO</button>
		<div id="0" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="1" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="2" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="3" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="4" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="5" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="6" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="7" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:150px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

		<div id="8" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="9" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="10" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="11" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="12" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="13" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="14" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="15" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:200px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

		<div id="16" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="17" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="18" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="19" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="20" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="21" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="22" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="23" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:250px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

		<div id="24" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="25" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="26" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="27" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="28" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="29" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="30" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="31" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:300px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

		<div id="32" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="33" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="34" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="35" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="36" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="37" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="38" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="39" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:350px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

		<div id="40" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="41" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="42" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="43" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="44" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="45" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="46" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="47" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:400px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

		<div id="48" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="49" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="50" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="51" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="52" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="53" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="54" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="55" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:450px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

		<div id="56" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:100px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="57" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:150px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="58" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:200px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="59" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:250px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="60" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:300px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="61" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:350px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="62" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:400px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>
		<div id="63" style="position:absolute;border:1px solid blue;width:50px;height:50px;left:450px;top:500px;" onclick="oc(this.id);" onmouseover="omo(this.id);"></div>

	</body>
</html>

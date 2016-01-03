<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Circular Content Carousel with jQuery</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Circular Content Carousel with jQuery" />
        <meta name="keywords" content="jquery, conent slider, content carousel, circular, expanding, sliding, css3" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Coustard:900' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css' />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
		
		<div class="container">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="recent.php">Recent</a></li>
			</ul>
		</div>
		<div id="container" class="container" style="text-align: center;">
			<h1>Recent Views</h1>
		</div>
		<script>
			var length = sessionStorage.getItem("total");
			
			console.log(length);
			for(var i = 1 ; i <= length ; i++){
				if(typeof sessionStorage.getItem("heading"+i) === 'undefined'){
    // your code here.
					console.log("type undefined");
					break;
				};
				var div = document.createElement("div");
				var para = document.createElement("a");                       // Create a <p> element
				var t = document.createTextNode(sessionStorage.getItem("heading"+i));       // Create a text node
				para.appendChild(t);                                          // Append the text to <p>
				para.setAttribute("href", sessionStorage.getItem("video"+i));
				para.style.fontSize = "3em";
				div.appendChild(para);
				document.getElementById("container").appendChild(div);
				//document.write(sessionStorage.getItem("video"+i));
				//document.write(sessionStorage.getItem("heading"+i));
			}
		</script>
	
	</body>
	
</html>
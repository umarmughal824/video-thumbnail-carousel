<?php
/**
 * Created by PhpStorm.
 * User: umar
 * Date: 12/27/2015
 * Time: 7:16 PM
 */

function grab_page($site){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_URL, $site);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST ,"GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    return curl_exec ($ch);
    curl_close ($ch);
}

$response = grab_page('https://demo2697834.mockable.io/movies');

//print_r($response);
$response = json_decode($response);
//print_r($response->entries);
$total = $response->totalCount;

?>
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
			<div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
					<?php
					for($i = 0 ; $i < $total ; $i++) { 
						$j = $i + 1;?>
						
						<div id="<?php echo $j; ?>" class="<?php echo "ca-item ca-item-$j"; ?>" tabindex="<?php echo ($i+1); ?>">
							<div class="ca-item-main">
								<video width="320" height="240" controls style="    margin-left: -7%;margin-top: -15%;">
								  <source src="<?php echo $response->entries[$i]->contents[0]->url ?>" type="video/mp4">
								  <source src="<?php echo $response->entries[$i]->contents[0]->url ?>" type="video/ogg">
								  Your browser does not support the video tag.
								</video>
								
								
								<h3><?php echo $response->entries[$i]->title; ?></h3>
								<h4>
									<span class="ca-quote">&ldquo;</span>
									<span><?php echo $response->entries[$i]->description; ?></span>
								</h4>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
//
			$(document).ready(function(){
			
				$('.ca-item-1 video').get(0).play();
				
				sessionStorage.setItem("video1", $('.ca-item-1 video source').attr("src"));
				sessionStorage.setItem("heading1", $('.ca-item-1 h3').text());
//				var current = parseInt(sessionStorage.getItem("total"));
//				current++;
//				sessionStorage.setItem("total", current); 
				sessionStorage.setItem("total", "1"); 
				
				$( "body" ).focusin(function() {
				/*  console.log('focus in');
				  console.log(document.onfocus);
				  console.log(document.activeElement);
				  var elements =document.activeElement;
				  var element = elements.getElementsByTagName('video');
				  console.log(element[0]);
				  element[0].play();
				  */
				});

				$('#ca-container').contentcarousel();				
				// listens for any navigation keypress activity
				$(document).keydown(function(e) {
				console.log("key down pressed");
    
	
	
	switch(e.which) {
        case 37: // left
			$('span.ca-nav-prev').click();
			var divs = document.getElementsByClassName('ca-item');
			var length = divs.length;
			console.log(length);
			var video;
			for (var i=0 ; i < length ; i++ ){
				video = divs[i].getElementsByTagName('video');
				console.log(video[0]);
				console.log(video[0].paused);
				if(video[0].paused == false){
					//alert('false');
					break;
				}
			}


			var j =divs[i].getAttribute("id");
			console.log(j);

			var text='.ca-item-'+j+' video';
			console.log(text);
			$(text).get(0).pause();

			


			if(j==1)
				j=length-1;
			else{
				j--;
				//j--;
			}
			
			console.log(j);
			var text='.ca-item-'+j+' video';
			console.log(text);
			
			$(text).get(0).play();
			console.log($('.ca-item-'+j+' h3').text());
			
			var current = parseInt(sessionStorage.getItem("total"));
			current++;
			var video = "video"+current;
			console.log(video);
			sessionStorage.setItem("video"+current , $('.ca-item-'+j+' video source').attr("src"));
			sessionStorage.setItem("heading"+current, $('.ca-item-'+j+' h3').text());
			console.log("current ="+ current);
			sessionStorage.setItem("total", current); 
			
			break;

        /*case 38: // up video2
        break;*/

        case 39: // right
			var divs = document.getElementsByClassName('ca-item');
			var length = divs.length;
			console.log(length);
			var video;
			for (var i=0 ; i < length ; i++ ){
				video = divs[i].getElementsByTagName('video');
				console.log(video[0]);
				console.log(video[0].paused);
				if(video[0].paused == false){
					//alert('false');
					break;
				}
			}

			var j =divs[i].getAttribute("id");

			console.log(j);
			if(j == length)
				j=1;
			else
				j++;
			console.log(j);
			var text='.ca-item-'+j+' video';
			console.log(text);			
			
			$(text).get(0).play();

			console.log($('.ca-item-'+j+' h3').text());
			
						var current = parseInt(sessionStorage.getItem("total"));
			current++;
			var video = "video"+current;
			console.log(video);
			sessionStorage.setItem("video"+current , $('.ca-item-'+j+' video source').attr("src"));
			sessionStorage.setItem("heading"+current, $('.ca-item-'+j+' h3').text());
			console.log("current ="+ current);
			sessionStorage.setItem("total", current); 
			
			$('span.ca-nav-next').click();
			break;

        /*case 40: // down
        break;*/

        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});
						
/*				$(document).keypress(function(e)
				{
					console.log("key pressed");
					switch(e.which)
					{
					
						// user presses the "a"
						case 37:
							console.log("left key pressed");
							break;
							
						case 39:
							console.log("right key pressed");
							break;
							
						case 97:	showViaKeypress("#home");
									break;	
									
						// user presses the "s" key
						case 115:	showViaKeypress("#about");
									break;
									
						// user presses the "d" key
						case 100:	showViaKeypress("#contact");
									break;
									
						// user presses the "f" key
						case 102:	showViaKeypress("#awards");
									break;
									
						// user presses the "g" key 
						case 103:	showViaKeypress("#links");
					}
				});
		*/

				});
		</script>
    
	
	</body>
	
</html>
$(document).ready(function(){
				
	//setUp top bar				
	var width = $(document).width();
	var topDiv = "<div id='top'> </div>"
	$('body').append(topDiv);
	$('#top').css('background-color','rgba(0,0,0,1)');
	$('#top').css('width',width);
	$('#top').css('position','fixed');
			
	//add logo to top bar 
	createImageMap();
	$('#top').append("<img id='logo' src='./img/logo.png' title ='navigate to school site or league site' usemap='#navMap'/>");
				
				
	//add nav bar
	$('#top').append("<ul id='navBar' class='navList'> </ul>");
		
       /**
	 <button class='btn btn-primary btn-lg' data-toggle='modal' data-target='#login_modal'>
	Launch demo modal
	</button>  */
				
	//add elements to nav bar 
	//var links = [ ["Home","index.php"], ["Officers","officer.php"], ["Events","index.php"], ["SignIn","index.html"]];
	var links = [ ["Home","home"], ["Officers","officer"], ["Events","events"], ["SignIn","sign_in"]];
	for(var i = 0, length = links.length; i < length; i++)
	{
	//$('#navBar').append("<li class='navItems'> <a class ='navLink' href ='"+links[i][1]+"'>"+links[i][0]+"</a></li>");
	 if(i != length -1)$('#navBar').append("<li class='navItems'> <button class='btn' id='"+links[i][1]+"'style='background-color:black; color:white'>"+links[i][0]+"</button></li>");
	  else $('#navBar').append("<li class='navItems'> <button class='btn' id='"+links[i][1]+"'style='background-color:black; color:white' data-toggle='modal' data-target='#login_modal'>"+links[i][0]+"</button></li>");
	}
				
	$(window).resize(function(){
	
	 var newWidth = $(window).width();
	$('#top').css('width',newWidth);
	
	});
	
	//create action listener for the buttons 
	$('#officer').click(function(){
			
	   $('#officers').show();
	   $('#myCarousel').hide();
	   $('#blog').hide();
	    $("html, body").animate({ scrollTop: 0 }, 500);
			
	});
	
	$('#home').click(function(){
	
          $('#officers').hide();
	   $('#myCarousel').show();
	   $('#blog').show();	
	    $("html, body").animate({ scrollTop: 0 }, 500);
	});
	
	//scroll back to top
	
	$("#to_top").click(function(){
	
		$("html, body").animate({ scrollTop: 0 }, 500);	
		return false;
	});
	
				
				
});

function createImageMap(){

	$('body').append("<map name='navMap'> </map>");
	$('map').append("<area shape='rect' title='Visit CSULA Site' coords='0 0 66 57' href='http://www.calstatela.edu/' target='_blank'/> ");
	$('map').append("<area shape='rect' title='Visit League Site' coords='66 0 249 57' href='http://leagueoflegends.com/' target='_blank'/> ");
	




}


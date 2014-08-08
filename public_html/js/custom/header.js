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
				
				//add elements to nav bar 
				var links = [ ["Home","index.php"], ["Officers","officer.php"], ["Events","index.php"], ["About Us","index.php"] /*, ["SignIn","index.html"]*/];
				for(var i = 0; i < links.length; i++)
				{
					$('#navBar').append("<li class='navItems'> <a class ='navLink' href ='"+links[i][1]+"'>"+links[i][0]+"</a></li>");
				}
				
				$(window).resize(function(){
					
						var newWidth = $(window).width();
						$('#top').css('width',newWidth);
				});
				
				
				
				
});

function createImageMap(){

	$('body').append("<map name='navMap'> </map>");
	$('map').append("<area shape='rect' title='Visit CSULA Site' coords='0 0 66 57' href='http://www.calstatela.edu/' target='_blank'/> ");
	$('map').append("<area shape='rect' title='Visit League Site' coords='66 0 249 57' href='http://leagueoflegends.com/' target='_blank'/> ");
	




}


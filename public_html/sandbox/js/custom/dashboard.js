$(document).ready(function(){
  
      $('.dash_link').click(function(){
      
          $('.dash_link').removeClass('active');
          //select correct nav item
          $(this).addClass('active');
          
         var id = $(this).attr("id");
         console.log("nav id: "+ id);
         
        /* switch(id){
         	 
           case "overview":
           	   request("all");
           	   return;
           	   
           case "blog":
           	   request("blog");
           	   return;
           	   
           case "team_rank":
           	   request("");
           	   return;
           	   
           case "event":
           	   
           	   return;
           	   
           case "control_panel":
           	   
           	  return;
         	 
         }*/
          
      
      });
		

});

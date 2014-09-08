$(document).ready(function(){
   
		
	//side bar nav toggling
      $('.dash_link').click(function(){
      
          $('.dash_link').removeClass('active');
          //select correct nav item
          $(this).addClass('active');
          
         var id = $(this).attr("id");
         console.log("nav id: "+ id);
         
       
      });
      
      //team rank div
      $('.team_rank_btn').click(function(){
      		      
      		     $('#team_rank_modal').modal('show');
      });
      
      
      $('#commit').click(function(){
      		
        var title = $('#blog_title').val();
        console.log(title);
        
        if(typeof title === 'undefined' || trim(title).length == 0){
        
           $('#blog_error').html("Title is not long enough!");
           	
           return false;
        }
        
        var post = $('#user_post').val();
        console.log(post);
        if(typeof post === 'undefined' || trim(post).length == 0){
        
        	  $('#blog_error').html("Blog post is empty! Please add some content");
        	return false;
        }
        
        $('#user_post').html("");
      		   
      		      
      		      
      });
		

});

function trim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}

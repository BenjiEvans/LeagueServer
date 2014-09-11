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
      		      
          var decide = "Are you sure that you wish to ";
         //write content      
      	if($(this).hasClass("leave")){
      		
      	   $('#team_modal_body').html(decide+="<span class='text-warning'>leave this team</span>? <span class='text-danger'> If you do you will be unable to participate in events that this team is registered for!</span>");	
      		
      	}else if($(this).hasClass("remove")){
      	   
      	   $('#team_modal_body').html(decide+="<span class='text-warning'>remove this player from your team</span>?");
      		
      	}else if($(this).hasClass("captain")){
      		
      		var permList = "<ul><li>Recruit members for the team</li><li>Register the team for tournaments </li><li>Remove players from the team</li> </ul>";
      	     $('#team_modal_body').html(decide+="<span class='text-warning'>assign this player as team captain</span>?<span class='text-danger'>If you do you will not be allowed to</span>"+permList);
      	}
      		      
      		      
        //show content 
      	 $('#team_rank_modal').modal('show');
      });
      
      
      //blog post commit
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

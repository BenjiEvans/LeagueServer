$(document).ready(function(){
  
      $('.dash_link').click(function(){
      
          $('.dash_link').removeClass('active');
          $('.dash_link').css("color","rgb(0,0,0)");
          //select correct nav item
          $(this).addClass('active');
          $(this).css("color","gold")
          
         var id = $(this).attr("id");
         console.log("nav id: "+ id);
         var list = [".blogy",".overview",".team_rank",".event", ".note", ".control_panel"];
         //hide all
         for(var i = 0, length = list.length; i < length; i++)$(list[i]).hide();
         //show active 
         $('.'+id).show();
              
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
        
        var post ={
        	title: $('#blog_title').val(),
        	post: $('#user_post').val()
        }
       
        //send post to server 
        $.ajax({
                 type: "POST",
                 url: "/main.php",
	         data: JSON.stringify(post),
                 contentType: "application/json; charset=utf-8",
                 dataType: "json",
                 processData: true,
                 success: function (data) {
                     alert("post successful! ");
                 },
                 error: function (data) {
                     alert("bad post");
                 }
             });
        
        
        
        
      	 $('#user_post').html("");	      
      		      
      });
      
      
		

});


function trim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}

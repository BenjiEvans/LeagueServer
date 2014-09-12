$(document).ready(function(){
  
       //toggle 
      $('.dash_link').click(function(){
      
         if($(this).hasClass('active'))return;		     
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
         //$('.'+id).show();
         $('.'+id).fadeIn();
              
      });
      
      //team rank div (no user not appart of team )
      $('#browse_team').click(function(){
      	
        /*if the team listing div is empty 
          do an ajax call to the server to 
          get the table listing 
        */
      	var empty = $('#team_list').html().trim().length == 0;	 
      	console.log(empty);
        if(empty){
           
        	 $.ajax({
                 type: "GET",
                 url: "/main.php?rq=team_list",
                 contentType: "text/html",
                 success: function (data) {
                     $("#team_list").append(data);
                   
                 },
                 error: function (data) {
                     alert("could not retreive listing");
                 }
             });
        	
        	
        }
      		      
        //show listing 
        $('#team_list').fadeIn('slow');
      		      
      });
      
      //createing team 
      $('#create_team').click(function(){
      	
         $('#team_create_modal').modal('show');
      });
      
      //commit to creating team 
      $('#team_create_commit').click(function(){
      	
         //make sure a name is passed to the server		      
         var teamName = $('#team_name').val();
         
         if(typeof teamName === 'undefined' || trim(teamName).length == 0 ){
         	 
           $('#team_create_error').html("*Enter a Team Name!");
           $('#team_name').parent().addClass("has-error"); 
           return false;
           
         }else if(trim(teamName).length > 32){
         	 
           $('#team_create_error').html('*Team Name cannot be more than 32 characters');
           $('#team_name').parent().addClass("has-error"); 
           return false;
         }
      		      
         var team = { name: teamName }
         
      	  //send post to server 
        $.ajax({
                 type: "POST",
                 url: "/main.php",
	         data: JSON.stringify(team),
                 contentType: "application/json; charset=utf-8",
                 dataType: "json",
                 processData: true,
                 success: function (data) {
                                     
                  alert("Team was read"); 
                 },
                 error: function (data) {
                     alert("bad Team Request");
                 }
             });	      
      	
      		      
          return false;   
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
                   //  alert("post successful! ");
                     //prepend post 
                     $("#blog_post_container").prepend(makePost(html_special_chars(post),data.author));
                   
                 },
                 error: function (data) {
                     alert("bad post");
                 }
             });
        
      	 $('#user_post').val("");	      
      		      
      });
      	
      $(window).scroll(function () { //used to append additional blog posts 
               
        if ($('#blogy').hasClass("active") && $(window).scrollTop() >= $(document).height() - $(window).height() - 10 ) 
        {
        	var id = $('#blog_post_container').children().last().attr('id');
        	console.log("ID: "+id);
        	if(id == 1) return;
               //retreive some posts 
                $.ajax({
                 type: "GET",
                 url: "/main.php?rq=blog&id="+id,
                 contentType: "text/html",
                 success: function (data) {
                   
                     $("#blog_post_container").append(data);
                   
                 },
                 error: function (data) {
                     alert("could not retreive posts");
                 }
             });
               
        }
      
      });
      
      
		

});

function makePost(post, author){
  
 var blogPost = "<div class='blog-post'> <h2 class='blog-post-title'>";
 //add title
 blogPost+=post.title+"</h2>";
 //add time
 blogPost+= "<p class='blog-post-meta'>May 18, 2014 by ";
 //add author
 if(author.toLowerCase() == "root"){
 	 blogPost+= "Root</p>";
 }else blogPost+= "<a href='#'>"+author+"</a></p>";
 //add blog content
 blogPost+="<p>"+post.post+"</p></div>"; 
 
 return blogPost;
 
}

function html_special_chars(string){
 
return string.replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;");	
	
}

function trim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}

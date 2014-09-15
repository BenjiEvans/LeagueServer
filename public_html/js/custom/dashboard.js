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
                                     
                  if(data.status == 202)
                  {
                    //hide and reset form
                    $('#team_name').parent().removeClass("has-error"); 
                    $('#team_form').hide();
                     document.getElementById("team_form").reset();
                    //display response
                    $('#team_create_respon').append("<p>You have successfull created Team :\""+teamName+"\". You have been assigned as captain.</p>");
                    $('#team_create_respon').fadeIn('slow');
                    //append teams profile 
                    $('.team_rank').html("");
                       $('.team_rank').html("<h1> JBlap <em><span class='text-muted officer'>Challenger</span></em></h1> <hr class='featurette-divider'><img class='featurette-image img-responsive' data-src='holder.js/200x200/auto' alt='Generic placeholder image' style='border:solid;float:left'><div style='float:left;margin-left:10px;'><h2> <span style='font-family:Fertigo'>Club Rank</span> : <span class='text-muted officer'>1</span></h2><h2> <span style='font-family:Fertigo'>Team Captain</span>: <span class='text-warning text-capitalize'>speedy847</span> </h2><h3> <span class='text-success' > Wins: 5 </span> </h3><h3> <span class='text-danger'> Losses: 2 </span></h3><button type='button' class='btn btn-danger team_rank_btn leave' style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button> </div>");
                  /*  var profile = "<h1>"+teamName+" <em><span class='text-muted officer'>Challenger</span></em></h1> <hr class='featurette-divider'>";
                    profile+="<img class='featurette-image img-responsive' data-src='holder.js/200x200/auto' alt='Generic placeholder image' style='border:solid;float:left'>";
                    profile+="<div style='float:left;margin-left:10px;'><h2> <span style='font-family:Fertigo'>Not Ranked</h2>";
                    profile+="<h2> <span style='font-family:Fertigo'>Team Captain</span>: <span class='text-warning text-capitalize'>"+$('#user').attr('name')+"</span> </h2>";
                    profile+="<h3> <span class='text-success'> Wins: 0 </span> </h3><h3> <span class='text-danger'> Losses: 0 </span></h3>";
                    profile+="<button type='button' class='btn btn-danger team_rank_btn leave' style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button></div>";
                    $('.team_rank').append(profile);*/
                  }
                 
                 },
                 error: function (data) {
                      $('#team_create_error').html('*Team Name cannot be more than 32 characters');
                      $('#team_name').parent().addClass("has-error"); 
                 }
             });	      
      	
      		      
          return false;   
      });
      
      
      //confirm a decision in team rank modal
       $('.confirm_choice').click(function(){
       	
          if($(this).hasClass("leave")){
       		//post to server 
       	     var teamID = $(this).attr('id');
       	     console.log(teamID);
       	     var leave ={opt: 'leave', team: teamID};
       	    $.ajax({
                 type: "POST",
                 url: "/main.php",
	         data: JSON.stringify(leave),
                 contentType: "application/json; charset=utf-8",
                 dataType: "json",
                 processData: true,
                 success: function (data) {
                                     
                  alert("removed from team"); 
                 },
                 error: function (data) {
                     alert("uh.... leaving didnt work...");
                 }
             });	      
       	   }
       		       
       });




      
      //activate team rank modal
      $('.team_rank_btn').click(function(){
      		      
          var decide = "Are you sure that you wish to ";
          var id = $(this).parent().attr('id');
         //write content      
      	if($(this).hasClass("leave")){
      	   var cap = "If you are captain of this team your teamates WILL ALSO BE KICKED OUT OF THE TEAM AND ALL RECORD OF THE TEAM WILL BE DELETED;";
      	   cap+= "To avoid this consequence please assign another member to be team captain";
      	   $('#team_modal_body').html(decide+="<span class='text-warning'>leave this team</span>? <span class='text-danger'> If you do you will be unable to participate in events that this team is registered for!"+cap+"</span>");
      	   //add class to button
      	   $('.confirm_choice').addClass('leave');
      	   $('.confirm_choice').removeClass('remove');
      	   $('.confirm_choice').removeClass('captain');
      	   //add id 
      	   $('.confirm_choice').attr('id',id); 		
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
                     $("#blog_post_container").prepend(makePost(post,$('#user').attr('name')));
                   
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
        	if(id == 1 || typeof id === 'undefined') return;
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

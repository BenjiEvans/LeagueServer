$(document).ready(function(){
  
       //toggle 
      $('.dash_link').click(function(){
      
         if($(this).hasClass('active'))return;	
          $('.search').hide();
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
      
      //viewing other team's profile
      $(document).on("click",".team_profile",function(){
      	
        var id = $(this).attr('id');
        //get html from server 
        var param = [["rq","team"],["id",id]];
         getResource({
         	params:param,
         	 success: function (data) {
                  //  alert("got the html");
                    // hide current content and remove side bar activation
                    $('.dash_link').removeClass('active');
                    $('.team_rank').hide();
                    //show team profile 
                    $('.search').html(data);
                    $('.search').fadeIn('slow');
                   
                 },
                 error: function (data) {
                     alert("could not retreive profile");
                 }
         	
         });
         
      	return false;	      
      });
      
      //noticfication actions 
      $(document).on("click",".note_btn",function(){
         var ID = $(this).parent().parent().attr('id');
         console.log("id: "+ID);
         var dec = 3;
         if($(this).hasClass("accept")){
          dec = 1;
         }else if($(this).hasClass("decline")){
         	dec = 0; 
         }
         console.log("Dec: "+dec);
         var note = {id:ID, note:dec}
         //post to server 
         postJSON({
         json: note,
         success: function (data) {
            if(data.status == 203)
            {
               $('#note_modal_body').append(data.msg);
               $('#note_respon_modal').modal('show');   
             }
              var count = document.getElementById("note_count").innerHTML;
              console.log("Note#: "+count);
              count = Number(count);
              count--;
              $('#note_count').html(count);
              //if no more notes display no notes...
              if(count == 0)$('.note').html("<h2> No Notifications...</h2>");
              if(data.hasOwnProperty("team_id")){
              	 getResource({
              	   params:[['rq','team'],['id',data.team_id]],
              	   success:function(data){
              	    $('.team_rank').html(data);	   
              	   }
              	 })      
              }
               $(this).parent().parent().fadeOut(1000); 
           }
         		 
         });
      		      
      });
      
      //delete notifications 
      $(document).on("click",".note_close", function(){
      		
      	 var ID = $(this).parent().attr('id');
         var note = {id:ID, note:-1}
         //post to server 
         postJSON({
            json:note,
            success: function (data) {
              //fade the div and decrement the notifications  
              var count = document.getElementById("note_count").innerHTML;
              console.log("Note#: "+count);
              count = Number(count);
              count--;   
              $('#note_count').html(count);
               //if no more notes display no notes...
              if(count == 0)$('.note').html("<h2> No Notifications...</h2>");
                          	     
               $(this).parent().fadeOut(1000);
            
              }
         		 
         });
         
           return false;
      		      
      });
      
      
      //team rank div (no user not appart of team )
      $(document).on("click",'#browse_team',function(){
      	
        /*if the team listing div is empty 
          do an ajax call to the server to 
          get the table listing 
        */
      	var empty = $('#team_list').html().trim().length == 0;	 
      	console.log(empty);
        if(empty){
           
           getResource({
             params:[["rq","team_list"]],
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
      $(document).on("click",'#create_team',function(){
      	  $('#team_form').show();
      	   $('#team_create_respon').hide();
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
      	  $(this).button('loading');	      
         var team = { name: teamName }
         
      	  //send post to server 
      	  postJSON({
      	     json:team,
      	     success: function (data) {
                                     
                  if(data.status == 202)
                  {
                    //hide and reset form
                    $('#team_name').parent().removeClass("has-error"); 
                    $('#team_form').hide();
                     document.getElementById("team_form").reset();
                    //display response
                    $('#team_create_respon').html("<p class='text-success'>You have successfull created Team :<span class='text-muted'>\""+teamName+"\"</span>. You have been assigned as captain.</p>");
                    $('#team_create_respon').fadeIn('slow');
                    //append teams profile 
                    $('.team_rank').html("");
                    //   $('.team_rank').html("<h1> JBlap <em><span class='text-muted officer'>Challenger</span></em></h1> <hr class='featurette-divider'><img class='featurette-image img-responsive' data-src='holder.js/200x200/auto' alt='Generic placeholder image' style='border:solid;float:left'><div style='float:left;margin-left:10px;'><h2> <span style='font-family:Fertigo'>Club Rank</span> : <span class='text-muted officer'>1</span></h2><h2> <span style='font-family:Fertigo'>Team Captain</span>: <span class='text-warning text-capitalize'>speedy847</span> </h2><h3> <span class='text-success' > Wins: 5 </span> </h3><h3> <span class='text-danger'> Losses: 2 </span></h3><button type='button' class='btn btn-danger team_rank_btn leave' style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button> </div>");
                    var profile = "<h1>"+teamName+" <em><span class='text-muted officer'>Challenger</span></em></h1> <hr class='featurette-divider'>";
                    profile+="<img id='team_image' class='featurette-image img-responsive' src='/img/team_default.png' alt='Generic placeholder image' style='border:solid;float:left'>";
                    profile+="<div style='float:left;margin-left:10px;' id='"+data.id+"'><h2> <span style='font-family:Fertigo'><em>Not Ranked</em></h2>";
                    profile+="<h2> <span style='font-family:Fertigo'>Team Captain</span>: <span class='text-warning text-capitalize'>"+$('#user').attr('name')+"</span> </h2>";
                    profile+="<h3> <span class='text-success'> Wins: 0 </span> </h3><h3> <span class='text-danger'> Losses: 0 </span></h3>";
                    profile+="<button type='button' class='btn btn-danger team_rank_btn leave' style='color:rgb(0,0,0)' onclick='confirmTeamDecision()'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button></div>";
                    $('.team_rank').append(profile);
                 
                    //remove modal after 3 seconds
                    setTimeout(function(){$('#team_create_modal').modal('hide')}, 3000);
                  }
                 
                 },
                 error: function (data) {
                 	                	 
                      switch(data.status){
                      case 409://team exists
                       $('#team_create_error').html('*That team name is already in use.. please try again..');     
                      	 break;
                      case 401:
                      	 $('#team_create_error').html('*');    
                      	 break;
                      case 406:
                 	 break;
                 	 
                      case 503:
                 	 break;
                      	      
                      }
                     
                      $('#team_name').parent().addClass("has-error"); 
                 }
      	     
      	  		  
      	  });     
      	
      	  $(this).button('reset');	      
          return false;   
      });
      
      
      //confirm a decision in team rank modal
       $('.confirm_choice').click(function(){
       	
       	  var choice, success, error;	       
          if($(this).hasClass("leave")){
       		//post to server 
       	     var teamID = $(this).attr('id');
       	     console.log(teamID);
       	     choice = {opt: 'leave', id: teamID};
       	     success = function (data) {
                                     
                  $('#team_modal_body').html("<span class='text-success'>You have successfully been remove from the team!</span>");
                  $('#team_modal_footer').hide();
                  //remove modal after 3 seconds
                  setTimeout(function(){$('#team_rank_modal').modal('hide')}, 3000);
                  //update page to display buttons to browse and create team
                  $('.team_rank').html("<h1 style='text-align:center;'> You are not currently part of a team</h1><button type='button' class='btn btn-warning btn-lg btn-block' id='browse_team'>Browse Teams</button><button type='button' class='btn btn-default btn-lg btn-block' id='create_team'>Create Team</button><div id='team_list' hidden> </div>");
                  
                 };
                 
             error = function (data) {
                      $('#team_modal_body').html("You are unable to leave the team. Try again later. If this problem persists please contact the web master");
                      $('#team_modal_footer').hide();
                 };
       	 
       	   }
       	   
       	   postJSON({
       	      json:choice,
       	      success: success,
       	      error: error       	   
       	   });
       	   
       	   
       	 return false;	       
       });

      
      //activate team rank modal
      $(document).on("click",".team_rank_btn",function(){
      		      
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
      	     
      	}else if($(this).hasClass("join")){
      	
      	  $( this ).find( 'span' ).html("Join Request Sent");
      	   $(this).attr( "disabled","disabled");
      	   //then send ajax request to team 
      	    var teamID = $(this).parent().attr('id');
       	     console.log(teamID);
       	     var request ={opt: 'join', id: teamID};
      	     postJSON({
      	      json:request
      	     });    	   
      		return;
      	}
      	      		      
        //show content 
        $('#team_modal_footer').show();
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
        postJSON({
          json:post,
          success: function (data) {  
		console.log("Author:"+$('#user').attr('name'));    
              $("#blog_post_container").prepend(makeBlogPost(post,$('#user').attr('name')));    
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
                getResource({
                  params:[["rq","blog"],["id",id]],
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

function postJSON(requestData){
	
	  $.ajax({
                 type: "POST",
                 url: "/main2.php",
	         data: JSON.stringify(requestData.json),
                 contentType: "application/json; charset=utf-8",
                 dataType: "json",
                 processData: true,
                 success: function (data) {
                      
                    if(requestData.hasOwnProperty("success"))requestData.success(data);
                 },
                 error: function (data) {
                     if(requestData.hasOwnProperty("error"))requestData.error(data);
                     else alert("Posting Error!");
                 }
             });
	
	
}

function getResource(requestData){
	
      var url = "/resource.php?";
      var pairs = requestData.params;
      for(var i = 0, length = pairs.length;  i < length ;i++){
      	      if(i != 0)url+="&";
      	      url+=pairs[i][0]+"="+pairs[i][1];
      }

	
	 $.ajax({
                 type: "GET",
                 url: url,
                 contentType: "text/html",
                   success: function (data) {
                      
                    if(requestData.hasOwnProperty("success"))requestData.success(data);
                 },
                 error: function (data) {
                     if(requestData.hasOwnProperty("error"))requestData.error(data);
                     else alert("Could not fetch resource");
                 }
             });
}

function makeBlogPost(post, author){
  
 var blogPost = "<div class='blog-post'> <h2 class='blog-post-title'>";
 //add title
 blogPost+=post.title+"</h2>";
 //add time
 blogPost+= "<p class='blog-post-meta'>May 18, 2014 by ";
 //add author
 blogPost+= "<a href='#'>"+author+"</a></p>";
 //add blog content
 blogPost+="<p>"+post.post+"</p></div>"; 
 
 return blogPost;
 
}

function trim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}

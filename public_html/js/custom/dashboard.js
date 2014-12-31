$(document).ready(function(){
  var more_posts = true;
  var count = document.getElementById("note_count").innerHTML;          
  count = Number(count);

  var updater = new Updater(count);
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
	var result = id.split("-");
        //get html from server 
        var param = [["rq","team"],["name",result[1]]];
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
			reload();
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
		window.location.reload();
            /*if(data.status == 203)
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
              	   params:[['rq','team'],['name',data.team_id]],
              	   success:function(data){
              	    $('.team_rank').html(data);	   
              	   }
              	 })      
              }
               $(this).parent().parent().fadeOut(1000); */
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
            /*  var count = document.getElementById("note_count").innerHTML;
              console.log("Note#: "+count);
              count = Number(count);
              count--;   */
		updater.remove();
              $('#note_count').html(updater.getTotal());
               //if no more notes display no notes...
              if(count == 0)$('.note').html("<h2> No Notifications...</h2>");
                          	     
               $(this).parent().fadeOut(1000);
            
              }
         		 
         });
         
           return false;
      		      
      });



	//admin stuff 
     $(document).on("click",'#mem_overview',function(){//corresponds to overview members tab
	
		$.ajax({
			      type: "GET",
                 	      url: "/update.php?rq=mems",
                              contentType: "text/html",	
			      success :function (data){
			       	 $('#home').html(data);
				},

			      error: function(data){
					alert("Trouble retreiving members");
				}
				});	

		

     });

     $(document).on("click", '#team_overview', function(){// corresponds to overview team tab
		
		$.ajax({
			      type: "GET",
                 	      url: "/update.php?rq=teams",
                              contentType: "text/html",	
			      success :function (data){
			            $('#profile').html(data);
				},

			      error: function(data){
					alert("Trouble retreiving teams");
				}
				});	


     });


      
      
      //team rank div (no user not appart of team )
      $(document).on("click",'#browse_team',function(){
      	
        /*if the team listing div is empty 
          do an ajax call to the server to 
          get the table listing 
        */
	 $('#browse_team').attr('disabled',true);
      	var empty = $('#team_list').html().trim().length == 0;	 
      	console.log(empty);
     //   if(empty){
           
           getResource({
             params:[["rq","team_list"]],
             success: function (data) {
                     $("#team_list").html(data);
		      $('#browse_team').attr('disabled',false);
                   
                 },
             error: function (data) {
                     alert("could not retreive listing");
                 }
           
           });
        	
       // }
      		      
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
                 
                    var profile = "<h1 style='display:inline'> <span id='team-name' class='text-capitalize'>"+teamName+"</span></h1><button type='button' class='btn btn-danger team_rank_btn leave' style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button> <hr class='featurette-divider'>";
		    profile+="<div style='clear:left;'><div class='panel-group' id='accordion'><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'> <img src='./img/captain.png'><a data-toggle='collapse' data-parent='#accordion' href='#mem'><span class='text-capitalize'>"+$('#user').attr('name')+"</span></a></h4></div><div id='mem' class='panel-collapse collapse'><div class='panel-body'></div></div></div></div></div>";
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
       	

	console.log('confirm choice');

       	  var choice, success, error;	       
          if($(this).hasClass("leave")){
       		//post to server 
       	    // var teamID = $(this).attr('id');
       	    // console.log(teamID);
       	     choice = {opt: 'leave'/*, id: teamID*/};
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
       	 
       	   }else if ($(this).hasClass("remove")){
		
	       
		var memID = $(this).attr('id');
		choice = {opt: 'remove', id: memID};
	
		success = function(data){
		  
		      //add code to remove on client side
		      //get the profile and append it to the rank div 
		        var result = $('#team-name').html(); 
			console.log("Teams name: "+result);
			 var param = [["rq","team"],["name",result]];
        		 getResource({
         			params:param,
         			 success: function (data) {
				 $('.team_rank').html(data);
				 $('#team_modal_footer').hide();
				 $('#team_modal_body').html("Remove successful");},
                 		error: function (data) {
                     		   alert("could not retreive profile");
               				  }});
			
                };

                error = function(data){
	            //TODO
	 		 $('#team_modal_body').html("We were unable to leave remove that teammate. Try again later. If this problem persists please contact the web master");
                      $('#team_modal_footer').hide();

                };		

            }else if ($(this).hasClass("captain")){
		
		var memID = $(this).attr('id');
		choice = {opt: 'captain', id: memID};
	
		success = function(data){
		   //TODO
		       var result = $('#team-name').html(); 
			console.log("Teams name: "+result);
			 var param = [["rq","team"],["name",result]];
        		 getResource({
         			params:param,
         			 success: function (data) {
				 $('.team_rank').html(data);
				 $('#team_modal_footer').hide();
				 $('#team_modal_body').html("Captain of the team has been reassigned.");

},
                 		error: function (data) {
                     		   alert("could not retreive profile");
               				  }});
	            
                     
                };



                error = function(data){
	            //TODO
  $('#team_modal_body').html("We were unable to reassign the selected member as captain. Try again later. If this problem persists please contact the web master");
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
         /* var iden = $(this).parent().attr('id').split('-');
	  var id = iden[1];*/
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
      	   //$('.confirm_choice').attr('id',id); 		
      	}else if($(this).hasClass("remove")){
      	   //write content 
      	   $('#team_modal_body').html(decide+="<span class='text-warning'>remove this player from your team</span>?");
      		
	   //add class to button
	   $('.confirm_choice').addClass('remove');
      	   $('.confirm_choice').removeClass('leave');
      	   $('.confirm_choice').removeClass('captain');
           //add id 
	   var iden = $(this).parent().attr('id').split('-');
	   var id = iden[1];
	   $('.confirm_choice').attr('id',id); 	

      	}else if($(this).hasClass("captain")){
      		//write content 
      		var permList = "<ul><li>Recruit members for the team</li><li>Register the team for tournaments </li><li>Remove players from the team</li> </ul>";
      	     $('#team_modal_body').html(decide+="<span class='text-warning'>assign this player as team captain</span>?<span class='text-danger'>If you do you will not be allowed to</span>"+permList);

	   //add class to button
	   $('.confirm_choice').addClass('captain');
      	   $('.confirm_choice').removeClass('leave');
      	   $('.confirm_choice').removeClass('remove');
           //add id 
           var iden = $(this).parent().attr('id').split('-');
	   var id = iden[1];
	   $('.confirm_choice').attr('id',id); 	

      	     
      	}else if($(this).hasClass("join")){
      	
      	  $( this ).find( 'span' ).html("Join Request Sent");
      	   $(this).attr( "disabled","disabled");
      	   //then send ajax request to team 
      	    var teamName = $(this).parent().attr('id');
       	     console.log(teamName);
	    var result = teamName.split("-");
       	     var request ={opt: 'join', id: result[1]};
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
		$('#blog_error').html("");
            }
        });
                
      	 $('#user_post').val("");	      
      		      
      });
      	
      $(window).scroll(function () { //used to append additional blog posts 
               
        if (more_posts && $('#blogy').hasClass("active") && $(window).scrollTop() >= $(document).height() - $(window).height() - 10 ) 
        {
        	var id = $('#blog_post_container').children().last().attr('id');
        	console.log("ID: "+id);
        	if(id == 1 || typeof id === 'undefined') return;
               //retreive some posts 
                getResource({
                  params:[["rq","blog"],["id",id]],
                  success: function (data) {
                    if(data == "")more_posts = false;
                     $("#blog_post_container").append(data);
                   
                 },
                 error: function (data) {
                     alert("could not retreive posts");
                 }
                });                 
        }
      
      });
      
      
		
 updater.start();
});


function Updater(starting_total){
var total = starting_total;
var sec = 1000;
var time = 10*sec;
var maxtime = (60*sec)*5

//assume player doesn't have a team 
var has_team_client = false;

var send_total = function (){
console.log("sending");
 $.ajax({
                 type: "GET",
                 url: "/update.php?total="+total,
                 contentType: "text/html",
                   success: function (data) {
                      console.log(data.trim().length);
                    if(data.trim().length != 0){
		       //post all notes 
			 $('.note').html(data);
		       //update counter on page 
                         total = $('.real_note').length;
			 $('#note_count').html(total);
		      //reset timer 
			
		      }
			
 			//ajax request for team rank
			$.ajax({
			      type: "GET",
                 	      url: "/update.php?rq=team",
                              contentType: "text/html",	
			      success :function (stuff){
			        var has_team_server;

				 if(stuff.trim().length == 0) has_team_server = false;
				 else has_team_server = true;

				 if(has_team_client){
					
				    if(has_team_server)$('.team_rank').html(stuff);
				    else{
					$('.team_rank').html(rank_default());
					has_team_client = false;
				    }

				 }

				if(!has_team_client){

				    if(has_team_server){
					$('.team_rank').html(stuff);
					has_team_client = true;
				    }

				}

					if(stuff.trim().length != 0)$('.team_rank').html(stuff);

				},

			      error: function(data){
					alert("Trouble diplaying team profile");
				}
				});
		 

	              var newTime = time*2;
			if(newTime > maxtime)newTime = maxtime;
		     setTimeout(send_total, newTime);
                 },
                 error: function (data) {
                     if(requestData.hasOwnProperty("error"))requestData.error(data);
                     else alert("Could not fetch resource");
                 }
             });

};

this.remove = function (){
  total--;
};

this.getTotal = function(){
return total;
};

this.start = function(){

setTimeout(send_total, time);


};


}






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

function rank_default(){

return "<h1 style='text-align:center;'> You are not currently part of a team</h1><button type='button' class='btn btn-warning btn-lg btn-block' id='browse_team'>Browse Teams</button><button type='button' class='btn btn-default btn-lg btn-block' id='create_team'>Create Team</button><div id='team_list' hidden> </div>";

}

function reload(){
window.location.reload();
}

function trim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}

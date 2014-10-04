$(document).ready(function(){
   
    $('#termbox').click(function(){
         
           $("#register").attr('disabled', !this.checked)
         
      });
    
    //when signup is clicked 
    $('#reg').click(function(){
       
	$('#login_error').html("");
	//un hide register form if hidden 
	$('#register_form').show();
	$('#register').css("display","");//register button
    });

    $('#terms').click(function(){

           $('#conditions').removeClass("hidden");
           $('#conditions').addClass("show");

      });

    $('#login').click(function(){
  
           login(); 

       });

    $('#register').click(function(){
  
           register(); 

     });
    
    //when ok button is clicked after regestration response 
   $('#ok').click(function(){
    	
       $('#register_modal').modal('hide');
        //hide ok button 
        $(this).css("display","none");
        //hide previous response and clear it's contents 
        $('#register_response').hide();
        $('#register_response').html("");
        //reset form
       document.getElementById("register_form").reset();
       //disable submit button
       $("#register").prop("disabled",true);
    		    
    });


//ensure that no feilds are empty 
   $('.form-control').blur(function(){
            
         
          checkForEmptyField($(this));
        
              
    });

  $('#register_email').blur(function(){
           
     doEmailCheck($(this));

  });

  $('#register_cemail').blur(function(){
        
        checkEmailConfirm();

   });


});

function login(){

	// temporarilly disable login
	$('#login_error').html("Sorry.. Site is under construction so login has been disabled");
	return;
	
	
	//check email for emptyness
	var ign = $('#login_ign');
	if(ign.hasClass("has-error"))return;
	
	if(isEmpty(ign.val())){	
		ign.parent().addClass("has-error");
		$('#login_error').html("Please enter Ign or if new user click Register");
		return;
	}
	
	
	//check password for emptiness
	var password =$('#login_pass');
	if (password.hasClass("has-error"))return;
	
	if (isEmpty(password.val())){
		password.parent().addClass("has-error");
		$('#login_error').html("Please enter password");
		return;
	}
	
	//create JSON
	var login_parameter ={
	ign: ign.val(),
	pass: password.val()
	}
	
	
	//Create AJAX call to Server
	$.ajax({
                 type: "POST",
                 url: "/login.php",
	             data: JSON.stringify(login_parameter),
                 contentType: "application/json; charset=utf-8",
                 dataType: "json",
                 processData: true,
                 success: function (data) {
                     
                   document.location.href = data.url
                 },
                 error: function (data) {
                   switch(data.status){
                   	case 404: 
                   	$('#login_error').html("The Ign you attempted to login with is no yet registered. Click register below to signup for an account");
                   	break;
                       case 500:
                       $('#login_error').html("We are having problems with our server..Please try again later.");
                       break;
                       case 401:
                       $('#login_error').html("Incorrect password");
                       $('#login_pass').val("");
                   }
                 }
             });



}

function checkForEmptyField(field){

 if(isEmpty(field.val())) field.parent().addClass("has-error");
 else field.parent().removeClass("has-error");

}

function doEmailCheck(email){

//if the email is invalid display error
     if(!validEmail(email.val().trim())){
          
       displayEmailError();
        return;
     }
      
//other wise there are no erros (success) 

  //remove errors and warning s
       email.parent().removeClass('has-error has-warning');
       $("#email_error").html("");
       email.parent().addClass('has-success');
        checkEmailConfirm();


}


function isEmpty(string){

return string.trim().length == 0;

}

function checkEmailConfirm(){

checkStatus($('#register_email'),$('#register_cemail'));

}

function checkPassConfirm(){
checkStatus($('#register_pass'),$('#register_cpass'));
}

function checkStatus(field, confirm_field){

if(field.hasClass("has-error") || isEmpty(field.val())){

confirm_field.parent().removeClass("has-warning has-error has-success");
return;
}

if(confirm_field.val().trim() == field.val().trim()){

confirm_field.parent().removeClass("has-warning has-error");
confirm_field.parent().addClass("has-success");

}
else confirm_field.parent().addClass("has-warning");


}

function register(){

//get all form fields 
var list = document.getElementsByClassName('form-control');
var hasError = false;

/*check registration fields and if any of them are empty
  or have warnings or errors don't dont submit to server  
*/
for( var i = 0, length = list.length; i < length; i++){

    var element = list[i];

  if(hasClass(element,"reg") && (isEmpty(element.value) || hasClass(element.parentNode,"has-error") || hasClass(element.parentNode, "has-warning"))){

       if(!hasError) hasError= true;
       /* fields that havent havent been focused on and blur 
          might be empty so we add error class if this is the case 
       */
       element.parentNode.className =  element.parentNode.className +" has-error";
  }

}
//return... to many erros
if(hasError)return;

var user = {
   
email: $('#register_email').val(),
pass: $('#register_pass').val(),
ign: $('#register_username').val()

}

//submit data to register controller via ajax 
$.ajax({
                 type: "POST",
                 url: "/register.php",
	             data: JSON.stringify(user),
                 contentType: "application/json; charset=utf-8",
                 dataType: "json",
                 processData: true,
                 success: function (data) {
                    // alert("Registratin Successful. Check your email to activate your account ");
                   displayRegisterResponse("Registratin Successful. Check your email to activate your account");
                 },
                 error: function (data) {
                  var msg;
                  switch(data.status){
                     case 409:
                 	msg = "The email or Ign you are trying to register has already been registered. Check your email to activate your account, or if your account is already activated please log in"; 	 	 
                      break;
                     case 406: 
                     	msg = "Please make sure you are providing a valid email (CSULA email), Ign and password";
                     	break;
                     case 503:
                     	msg = "We are have problems with our server at the moment... Please try again later...";
                     	break;
                     	
                     case 400:
                     	msg = "There is a problem with the email you are using to register.. please make sure it is a CSULA email";
                 	break;
                  }
                  displayRegisterResponse(msg);
                 }
             });

}

function displayRegisterResponse(message){
 
//hide register form and register submit button 	
 $('#register_form').hide();
 $('#register').css("display","none");
 //append response and show
  $('#register_response').html(message);
  $('#register_response').show();
  $('#ok').css("display","");
	
}

function displayEmailError(){
var email = $('#register_email');
var parent = email.parent();
$("#email_error").html("*not a proper email address. make sure you are using your CSULA email");
parent.removeClass("has-success");
parent.addClass("has-error");
$('#register_cemail').parent().removeClass("has-success");
}

function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}

/*function validEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} */

function validEmail(email){
     	
	var pattern = /^\"?[\w-_\.]*\"?@calstatela\.edu$/;
	return pattern.test(email); 
	
}




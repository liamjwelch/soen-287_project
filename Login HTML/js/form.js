$(document).ready(function() {
	$(".login-form a").click(function() {
	  $(".login-form").hide();
	  $(".register-form").show();  
	});
	$(".register-form a").click(function() {
	  $(".register-form").hide(); 
	  $(".login-form").show(); 
	});
});
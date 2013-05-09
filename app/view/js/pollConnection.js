
var registered = document.getElementById('registered');
var notRegistered = document.getElementById('not_registered');
var pwdUser = document.getElementById('pwd_user');
var mailInfo = document.getElementById('mail_info');
var nameUser = document.getElementById('name_user');
var firstNameUser = document.getElementById('first_name_user');

registered.addEventListener('click', function(e){
	
	pwdUser.style.display = "block";
	mailInfo.style.display = "none";
	firstNameUser.style.display = "none";
	nameUser.style.display = "none";
}, false);

notRegistered.addEventListener('click', function(e){

	pwdUser.style.display = "none";
	mailInfo.style.display = "block";
	firstNameUser.style.display = "inline-block";
	nameUser.style.display = "inline-block";
}, false);
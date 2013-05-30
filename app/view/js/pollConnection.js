
var registered = document.getElementById('registered');
var notRegistered = document.getElementById('not_registered');
var pwdUser = document.getElementById('pwd_user');
var mailInfo = document.getElementById('mail_info');
var nameUser = document.getElementById('name_user');
var firstNameUser = document.getElementById('first_name_user');

pwdUser.style.display = "inline-block";
mailInfo.style.display = "none";
firstNameUser.style.display = "none";
nameUser.style.display = "none";

firstNameUser.previousSibling.previousSibling.style.display = "none";
nameUser.previousSibling.previousSibling.style.display = "none";
pwdUser.previousSibling.previousSibling.style.display = "inline-block";

registered.addEventListener('click', function(e){
	
	pwdUser.style.display = "inline-block";
	mailInfo.style.display = "none";
	firstNameUser.style.display = "none";
	nameUser.style.display = "none";
	firstNameUser.previousSibling.previousSibling.style.display = "none";
	nameUser.previousSibling.previousSibling.style.display = "none";
	pwdUser.previousSibling.previousSibling.style.display = "inline-block";
}, false);

notRegistered.addEventListener('click', function(e){

	pwdUser.style.display = "none";
	mailInfo.style.display = "block";
	firstNameUser.style.display = "inline-block";
	nameUser.style.display = "inline-block";
	firstNameUser.previousSibling.previousSibling.style.display = "inline-block";
	nameUser.previousSibling.previousSibling.style.display = "inline-block";
	pwdUser.previousSibling.previousSibling.style.display = "none";
}, false);
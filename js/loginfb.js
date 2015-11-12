function statusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);
	if (response.status === 'connected') {
		document.getElementById('main').style.visibility = 'visible';
//		document.getElementById('fbot').style.visibility = 'hidden';
		testAPI();
	} else {
		document.getElementById('main').style.visibility = 'hidden';
		document.getElementById('fbot').style.visibility = 'visible';
	}
}

function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

window.fbAsyncInit = function() {
	FB.init({
		appId      : '751988108262418',
		cookie     : true,  
		xfbml      : true,
		version    : 'v2.5'
	});
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	  });
};

(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function testAPI() {
//	console.log('Welcome!  Fetching your information.... ');
	FB.api('/me', function(response) {
		console.log(JSON.stringify(response));
//		document.getElementById('ctl0_Main_txtNombre').value = response.name;
		document.getElementById('ctl0_Main_hidFacebook').value = response.id;
		codigo();
//	alert(document.getElementById("ctl0_Main_hidFacebook").value);
/*		if(response.email != undefined)
			document.getElementById('ctl0_Main_txtCorreo').value = response.email;
//	  console.log('Successful login for: ' + response.name);
/*	  document.getElementById('status').innerHTML =
		'Thanks for logging in, ' + response.name + '!';*/
	});
}

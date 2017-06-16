var UserManagerTabbar = null;
var GET = GetUrlVars();

function afterLoad() {
	var UserName = GET['UserName'];
	var Type = GET['Type'];
	
	if (Type != null) {
		Type = Type.replace('_', ' ');
	}
	
	dhtmlx.image_path='../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/';
	
	var UserManager = new dhtmlXLayoutObject("Content", "1C");
	
	if (UserName != null && Type != null) {
		UserManager.cells("a").setText(Type + ' - ' + UserName);
	} else if (UserName != null) {
		UserManager.cells("a").setText('User Manager - ' + UserName);
	} else {
		UserManager.cells("a").setText('User Manager');
	}
	
	UserManager.cells("a").showHeader();
	
	var UserManagerHeight = UserManager.cells("a").getHeight();
	UserManagerHeight = UserManagerHeight + 15;
	UserManager.cells("a").setHeight(UserManagerHeight);
	UserManagerHeight = UserManagerHeight - 15;
	var UserManagerDiv = document.getElementById("Content");
	UserManagerDiv.style.height = UserManagerHeight + "px";
	
	// NEED TO MAKE ONE FOR MY ACCOUNT AND ONE FOR MESSAGES
	if (Type != null) {
		if (Type == 'Messages') {
			UserManager.cells("a").attachURL('SampleData/Messages.xml', true);
		} else if (Type == 'My Account') {
			UserManager.cells("a").attachURL('SampleData/MyAccount.xml', true);
		} else {
			UserManager.cells("a").attachURL('SampleData/default.xml', true);
		}
	}
	//UserManager.cells("a").attachURL('SampleData/default.xml', true);
	
	//UserManagerTabbar = UserManager.cells("a").attachTabbar();
	
	//UserManagerTabbar.setAlign("left");
	
	//UserManagerTabbar.addTab('SiteStats','Site Stats','');
	//StatsReportsTabbar.addTab('AdStats','Ad Stats','');
	
	//var Tabs = UserManagerTabbar.getAllTabs();
	
	/*var FunctionCall = null;
	$.each(Tabs, function() {
		FunctionCall = 'Load' + this + '()';
		//window[FunctionCall]();
		eval(FunctionCall);
		//alert(FunctionCall);		  
	});*/
	//LoadSiteStats();
	//LoadAdStats();
	
	//alert(Tabs);
}

// QUIRKSMODE.ORG COOKIE FUNCTIONS
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') {
			c = c.substring(1,c.length);
		}
		if (c.indexOf(nameEQ) == 0) {
			var ReturnValue = c.substring(nameEQ.length,c.length);
			ReturnValue = ReturnValue.replace(/\+/g, " ");
			return ReturnValue;
		}
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

function GetUrlVars() {
	var Get = new Array();
	window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(M,Key,Value) {
		Get[Key] = Value;
	});
	return Get;
}
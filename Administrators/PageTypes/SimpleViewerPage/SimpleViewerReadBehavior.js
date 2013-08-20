// USE VideoContentPageBehavior.js and TableContentBehavior.js for ideas on how to do this

var GET = GetUrlVars();
var COOKIE = document.cookie.split(';');
//var PageLocation = "../Administrators/PageTypes/SimpleViewer/XmlDHtmlXGridTables.php?TableID=";
var PageID = 0;

$(document).ready(PageLoad());

function PageLoad() {
	if (GET['GalleryID'] != null) {
		PageID = GET['GalleryID'];
		
		BuildGallery();
	} else {
		alert("Cannot find gallery");
	}
}

function BuildGallery() {
	var FlashVarsText = "../../Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=" + PageID + "%26ObjectID=1";
	
	var SimpleViewerObject = document.createElement('object');
	SimpleViewerObject.setAttribute('id', "SimpleViewer");
	SimpleViewerObject.setAttribute('type', "application/x-shockwave-flash");
	
	var Container = document.getElementById('sv-container');
	Container.appendChild(SimpleViewerObject);
	
	//$('#sv-container').flash();
	$('#SimpleViewer').flash( {
		'src' : '../../Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/svcore/swf/simpleviewer.swf',
		'width' : "100%",
		'height' : "90%",
		'wmode' : 'transparent',
		'allowfullscreen' : 'true',
		'allowscriptaccess' : 'true',
		'quality' : 'high', 
		'flashvars' : {
			'galleryURL' : FlashVarsText
		}
	});
	
	/*var SimpleViewerObject = document.createElement('object');
	SimpleViewerObject.setAttribute('width', "100%");
	SimpleViewerObject.setAttribute('height', "90%");
	SimpleViewerObject.setAttribute('type', "application/x-shockwave-flash");
	SimpleViewerObject.setAttribute('data', "../../Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/svcore/swf/simpleviewer.swf");
	
	var SimpleViewerParam1 = document.createElement('param');
	SimpleViewerParam1.setAttribute('name', "movie");
	SimpleViewerParam1.setAttribute('value', "../../Libraries/Tier6ContentLayer/SimpleViewers/SimpleViewer/svcore/swf/simpleviewer.swf");
	SimpleViewerObject.appendChild(SimpleViewerParam1);
	
	var SimpleViewerParam2 = document.createElement('param');
	SimpleViewerParam2.setAttribute('name', "wmode");
	SimpleViewerParam2.setAttribute('value', "transparent");
	SimpleViewerObject.appendChild(SimpleViewerParam2);
	
	var SimpleViewerParam3 = document.createElement('param');
	SimpleViewerParam3.setAttribute('name', "allfullscreen");
	SimpleViewerParam3.setAttribute('value', "true");
	SimpleViewerObject.appendChild(SimpleViewerParam3);
	
	var SimpleViewerParam4 = document.createElement('param');
	SimpleViewerParam4.setAttribute('name', "allowscriptaccess");
	SimpleViewerParam4.setAttribute('value', "true");
	SimpleViewerObject.appendChild(SimpleViewerParam4);
	
	var SimpleViewerParam5 = document.createElement('param');
	SimpleViewerParam5.setAttribute('name', "quality");
	SimpleViewerParam5.setAttribute('value', "high");
	SimpleViewerObject.appendChild(SimpleViewerParam5);
	
	var FlashVarsText = "galleryURL=../../Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=" + PageID + "%26ObjectID=1";
	var SimpleViewerParam6 = document.createElement('param');
	SimpleViewerParam6.setAttribute('name', "flashvars");
	SimpleViewerParam6.setAttribute('value', FlashVarsText);
	SimpleViewerObject.appendChild(SimpleViewerParam6);
	
	var Container = document.getElementById('sv-container');
	Container.appendChild(SimpleViewerObject);
	*/
}

function stripSlashes(str) {
	str = str.replace(/\\'/g, '\'');
    str = str.replace(/\\"/g, '"');
    str = str.replace(/\\0/g, '\0');
    str = str.replace(/\\\\/g, '\\');
    return str;
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
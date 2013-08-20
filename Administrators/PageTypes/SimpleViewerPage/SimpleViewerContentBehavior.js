// USE VideoContentPageBehavior.js and TableContentBehavior.js for ideas on how to do this

var Temp = document.getElementById("Import");
if (typeof(Temp) != 'undefined' && Temp != null) {
	document.getElementById("Import").setAttribute('onclick', 'ImportData();');
}

document.getElementById("AddImage1").setAttribute('onclick', 'AddOneImage(1);');
document.getElementById("RemoveImage1").setAttribute('onclick', 'RemoveOneImage(1);');

var GET = GetUrlVars();
var COOKIE = document.cookie.split(';');
//var PageLocation = "../Administrators/PageTypes/SimpleViewer/XmlDHtmlXGridTables.php?TableID=";
var PageID = null;
var FileName = null;

var SessionID = null;

//var TableContentTemp = COOKIE;
//var TableContent = new Array();
	

$(document).ready(PageLoad());

function PageLoad() {
	if (GET['GalleryID'] != null) {
		PageID = GET['GalleryID'];
	}
	
	if (GET['File'] != null) {
		FileName = GET['File'];
	}
	
	if (GET['SessionID'] != null) {
		SessionID = GET['SessionID'];
	}
	
	if (SessionID != null) {
		if (PageID != null) {
			var File = '../Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewer.php?PageID=' + PageID + '&amp;ObjectID=1';
		} else {
			var File = '../Administrators/PageTypes/SimpleViewerPage/TEMPFILES/' + SessionID + '.xml';
		}
			$.ajax({
				url: File,
				type: "GET", 
				dataType: "xml",
				success: LoadGalleryContent,
				statusCode: {
					404: function() {
						alert("Page Not Found");
					}
				}
			});
	}
	
	if (FileName != null) {
		var File = '../Administrators/PageTypes/SimpleViewerPage/UPLOAD/' + FileName;
		$.ajax({
			url: File,
			type: "GET", 
			dataType: "xml",
			success: LoadGalleryContent,
			statusCode: {
				404: function() {
					alert("Page Not Found");
				}
			}
		});
	}
}

function ImportData() {
	Vault = new dhtmlXVaultObject();
	Vault.setImagePath("../../Libraries/Tier7BehavioralLayer/DHTMLXVault/codebase/imgs/");
	Vault.setServerHandlers("PageTypes/SimpleViewerPage/UploadHandler.php", "PageTypes/SimpleViewerPage/GetInfoHandler.php", "PageTypes/SimpleViewerPage/GetIdHandler.php");
	Vault.setFilesLimit(1);
	
	Vault.onAddFile = function(FileName) {
			var Ext = this.getFileExtension(FileName);
			if (Ext != "xml") {
				alert ("You may only upload XML documents. Please retry.");
				return false;
			} else {
				return true;
			}
		};
	
	Vault.onUploadComplete = function (Files) {
			var File = Files[0];
			
			var FileName = File.name;
			FileName = FileName.replace("fakepath", "");
			FileName = FileName.replace("C:\\", "");
			FileName = FileName.replace("\\", "");
			//var Url = document.URL + "&File=" + FileName;
			alert ("The SimpleViewer Gallery Form is being reset with data from your file");
			//window.location = Url;
			//window.location.href = window.location.href + "&File=" + FileName;
			GET['File'] = FileName;
			
			$("#Vault").empty();
			//$("[id^='Image']").remove();
			$("[id^='Image']:not('#ImageLocation')").remove();
			
			EnablePriorAddImageButton(1);
			
			PageLoad();
		};
	Vault.create("Vault");
}

function AddOneImage(ContentNumber) {
	var Data = null;
	
	if (arguments[1] != null) {
		Data = arguments[1];
	}
	
	var AppendID = null;
	if (ContentNumber === 1) {
		AppendID = "Vault";
	} else {
		AppendID = ContentNumber;
		AppendID = AppendID - 1;
		AppendID = "Image" + AppendID;
	}
	
	var NextAddImagePage = ContentNumber + 1;
	var AddImageName = "AddImage" + NextAddImagePage;
	var RemoveImageName = "RemoveImage" + NextAddImagePage;
	var AddImageOnClick = "AddOneImage(" + NextAddImagePage + ");";
	var RemoveImageOnClick = "RemoveOneImage(" + NextAddImagePage + ");";
	
	var ContentName = "Image " + ContentNumber;
	var ContentID = "Image" + ContentNumber;
	
	var ImageUrlContentID = "Image" + ContentNumber + "ImageUrl";
	var ImageUrlContentName = "Image" + ContentNumber + "_ImageUrl";
	
	var ThumbUrlContentID = "Image" + ContentNumber + "ThumbUrl";
	var ThumbUrlContentName = "Image" + ContentNumber + "_ThumbUrl";
	
	var LinkUrlContentID = "Image" + ContentNumber + "LinkUrl";
	var LinkUrlContentName = "Image" + ContentNumber + "_LinkUrl";
	
	var LinkTargetContentID = "Image" + ContentNumber + "LinkTarget";
	var LinkTargetContentName = "Image" + ContentNumber + "_LinkTarget";
	
	var CaptionContentID = "Image" + ContentNumber + "Caption";
	var CaptionContentName = "Image" + ContentNumber + "_Caption";
	
	var FieldSet = document.createElement('fieldset');
	FieldSet.setAttribute('class', "ShortForm");
	FieldSet.setAttribute('dir', "ltr");
	FieldSet.setAttribute('id', ContentID);
	FieldSet.setAttribute('lang', "en-us");
	FieldSet.setAttribute('xml:lang', "en-us");
	
	var Legend = document.createElement('legend');
	Legend.setAttribute('class', "BodyHeading");
	Legend.setAttribute('dir', "ltr");
	Legend.setAttribute('lang', "en-us");
	Legend.setAttribute('xml:lang', "en-us");
	Legend.innerHTML = ContentName + " - SimpleViewer Gallery";
	
	FieldSet.appendChild(Legend);
	
	
	// Image Url
	var ImageUrlLabel = document.createElement('label');
	var ImageUrlContent = document.createElement('textarea');
	
	ImageUrlLabel.setAttribute('class', 'BodyText ShortForm');
	ImageUrlLabel.setAttribute('dir', "ltr");
	ImageUrlLabel.setAttribute('lang', "en-us");
	ImageUrlLabel.setAttribute('xml:lang', "en-us");
	ImageUrlLabel.innerHTML = "Image Url";
	
	ImageUrlContent.setAttribute('class', "ShortFormTableBox");
	ImageUrlContent.setAttribute('dir', "ltr");
	ImageUrlContent.setAttribute('id', ImageUrlContentID);
	ImageUrlContent.setAttribute('lang', "en-us");
	ImageUrlContent.setAttribute('xml:lang', "en-us");
	ImageUrlContent.setAttribute('rows', "2");
	ImageUrlContent.setAttribute('cols', "30");
	ImageUrlContent.setAttribute('name', ImageUrlContentName);
	
	if (Data != null) {
		if (Data['ImageUrl'] != null) {
			ImageUrlContent.innerHTML = Data['ImageUrl'];
		} else {
			ImageUrlContent.innerHTML = 'NULL';
		}
	} else {
		ImageUrlContent.innerHTML = 'NULL';
	}
	
	var ImageUrlLabelDiv = document.createElement('div');
	var ImageUrlContentDiv = document.createElement('div');
	ImageUrlLabelDiv.appendChild(ImageUrlLabel);
	ImageUrlContentDiv.appendChild(ImageUrlContent);
	
	FieldSet.appendChild(ImageUrlLabelDiv);
	FieldSet.appendChild(ImageUrlContentDiv);
	
	// Thumb Url
	var ThumbUrlLabel = document.createElement('label');
	var ThumbUrlContent = document.createElement('textarea');
	
	ThumbUrlLabel.setAttribute('class', 'BodyText ShortForm');
	ThumbUrlLabel.setAttribute('dir', "ltr");
	ThumbUrlLabel.setAttribute('lang', "en-us");
	ThumbUrlLabel.setAttribute('xml:lang', "en-us");
	ThumbUrlLabel.innerHTML = "Thumb Url";
	
	ThumbUrlContent.setAttribute('class', "ShortFormTableBox");
	ThumbUrlContent.setAttribute('dir', "ltr");
	ThumbUrlContent.setAttribute('id', ThumbUrlContentID);
	ThumbUrlContent.setAttribute('lang', "en-us");
	ThumbUrlContent.setAttribute('xml:lang', "en-us");
	ThumbUrlContent.setAttribute('rows', "2");
	ThumbUrlContent.setAttribute('cols', "30");
	ThumbUrlContent.setAttribute('name', ThumbUrlContentName);
	
	if (Data != null) {
		if (Data['ThumbUrl'] != null) {
			ThumbUrlContent.innerHTML = Data['ThumbUrl'];
		} else {
			ThumbUrlContent.innerHTML = 'NULL';
		}
	} else {
		ThumbUrlContent.innerHTML = 'NULL';
	}
	
	var ThumbUrlLabelDiv = document.createElement('div');
	var ThumbUrlContentDiv = document.createElement('div');
	ThumbUrlLabelDiv.appendChild(ThumbUrlLabel);
	ThumbUrlContentDiv.appendChild(ThumbUrlContent);
	
	FieldSet.appendChild(ThumbUrlLabelDiv);
	FieldSet.appendChild(ThumbUrlContentDiv);
	
	// Link Url
	var LinkUrlLabel = document.createElement('label');
	var LinkUrlContent = document.createElement('textarea');
	
	LinkUrlLabel.setAttribute('class', 'BodyText ShortForm');
	LinkUrlLabel.setAttribute('dir', "ltr");
	LinkUrlLabel.setAttribute('lang', "en-us");
	LinkUrlLabel.setAttribute('xml:lang', "en-us");
	LinkUrlLabel.innerHTML = "Link Url";
	
	LinkUrlContent.setAttribute('class', "ShortFormTableBox");
	LinkUrlContent.setAttribute('dir', "ltr");
	LinkUrlContent.setAttribute('id', LinkUrlContentID);
	LinkUrlContent.setAttribute('lang', "en-us");
	LinkUrlContent.setAttribute('xml:lang', "en-us");
	LinkUrlContent.setAttribute('rows', "2");
	LinkUrlContent.setAttribute('cols', "30");
	LinkUrlContent.setAttribute('name', LinkUrlContentName);
	
	if (Data != null) {
		if (Data['LinkUrl'] != null & Data['LinkUrl'].length != 0) {
			LinkUrlContent.innerHTML = Data['LinkUrl'];
		} else {
			LinkUrlContent.innerHTML = 'NULL';
		}
	} else {
		LinkUrlContent.innerHTML = 'NULL';
	}
	
	
	var LinkUrlLabelDiv = document.createElement('div');
	var LinkUrlContentDiv = document.createElement('div');
	LinkUrlLabelDiv.appendChild(LinkUrlLabel);
	LinkUrlContentDiv.appendChild(LinkUrlContent);
	
	FieldSet.appendChild(LinkUrlLabelDiv);
	FieldSet.appendChild(LinkUrlContentDiv);
	
	// Link Target
	var LinkTargetLabel = document.createElement('label');
	var LinkTargetContent = document.createElement('textarea');
	
	LinkTargetLabel.setAttribute('class', 'BodyText ShortForm');
	LinkTargetLabel.setAttribute('dir', "ltr");
	LinkTargetLabel.setAttribute('lang', "en-us");
	LinkTargetLabel.setAttribute('xml:lang', "en-us");
	LinkTargetLabel.innerHTML = "Link Target";
	
	LinkTargetContent.setAttribute('class', "ShortFormTableBox");
	LinkTargetContent.setAttribute('dir', "ltr");
	LinkTargetContent.setAttribute('id', LinkTargetContentID);
	LinkTargetContent.setAttribute('lang', "en-us");
	LinkTargetContent.setAttribute('xml:lang', "en-us");
	LinkTargetContent.setAttribute('rows', "2");
	LinkTargetContent.setAttribute('cols', "30");
	LinkTargetContent.setAttribute('name', LinkTargetContentName);
	
	if (Data != null) {
		if (Data['LinkTarget'] != null) {
			LinkTargetContent.innerHTML = Data['LinkTarget'];
		} else {
			LinkTargetContent.innerHTML = 'NULL';
		}
	} else {
		LinkTargetContent.innerHTML = 'NULL';
	}
	
	var LinkTargetLabelDiv = document.createElement('div');
	var LinkTargetContentDiv = document.createElement('div');
	LinkTargetLabelDiv.appendChild(LinkTargetLabel);
	LinkTargetContentDiv.appendChild(LinkTargetContent);
	
	FieldSet.appendChild(LinkTargetLabelDiv);
	FieldSet.appendChild(LinkTargetContentDiv);
	
	// Caption
	var CaptionLabel = document.createElement('label');
	var CaptionContent = document.createElement('textarea');
	
	CaptionLabel.setAttribute('class', 'BodyText ShortForm');
	CaptionLabel.setAttribute('dir', "ltr");
	CaptionLabel.setAttribute('lang', "en-us");
	CaptionLabel.setAttribute('xml:lang', "en-us");
	CaptionLabel.innerHTML = "Caption";
	
	CaptionContent.setAttribute('class', "ShortFormTableBox");
	CaptionContent.setAttribute('dir', "ltr");
	CaptionContent.setAttribute('id', CaptionContentID);
	CaptionContent.setAttribute('lang', "en-us");
	CaptionContent.setAttribute('xml:lang', "en-us");
	CaptionContent.setAttribute('rows', "2");
	CaptionContent.setAttribute('cols', "30");
	CaptionContent.setAttribute('name', CaptionContentName);
	
	if (Data != null) {
		if (Data['Caption'] != null & Data['Caption'].length != 0) {
			CaptionContent.innerHTML = Data['Caption'];
		} else {
			CaptionContent.innerHTML = 'NULL';
		}
	} else {
		CaptionContent.innerHTML = 'NULL';
	}
	
	
	var CaptionLabelDiv = document.createElement('div');
	var CaptionContentDiv = document.createElement('div');
	CaptionLabelDiv.appendChild(CaptionLabel);
	CaptionContentDiv.appendChild(CaptionContent);
	
	FieldSet.appendChild(CaptionLabelDiv);
	FieldSet.appendChild(CaptionContentDiv);
	
	// ADD IMAGE BUTTON
	var AddButton = document.createElement("button");
	AddButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	AddButton.setAttribute('dir', "ltr");
	AddButton.setAttribute('id', AddImageName);
	AddButton.setAttribute('lang', "en-us");
	AddButton.setAttribute('xml:lang', "en-us");
	AddButton.setAttribute('name', AddImageName);
	AddButton.setAttribute('type', "button");
	AddButton.setAttribute('onclick', AddImageOnClick);
	AddButton.innerHTML = "Add Image " + NextAddImagePage;
	
	FieldSet.appendChild(AddButton);
	
	// REMOVE IMAGE BUTTON
	var RemoveButton = document.createElement("button");
	RemoveButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	RemoveButton.setAttribute('dir', "ltr");
	RemoveButton.setAttribute('id', RemoveImageName);
	RemoveButton.setAttribute('lang', "en-us");
	RemoveButton.setAttribute('xml:lang', "en-us");
	RemoveButton.setAttribute('name', RemoveImageName);
	RemoveButton.setAttribute('type', "button");
	RemoveButton.setAttribute('onclick', RemoveImageOnClick);
	RemoveButton.innerHTML = "Remove Image " + NextAddImagePage;
	
	FieldSet.appendChild(RemoveButton);
	
	DisablePriorAddImageButtons(ContentNumber);
	
	$("#" + AppendID).after(FieldSet);
	
}

function RemoveOneImage(ContentNumber) {
	var DivID = 'Image' + ContentNumber;
	if (document.getElementById(DivID)) {
		$("#"+DivID).remove();
		EnablePriorAddImageButton(ContentNumber);
	} else {
		alert("Image " + ContentNumber + " Does Not Exist!");
	}
}

function DisablePriorAddImageButtons(ContentNumber) {
	var ButtonID = "AddImage" + ContentNumber;
	document.getElementById(ButtonID).setAttribute('disabled', "disabled");
	$("#" + ButtonID).hide();
}

function EnablePriorAddImageButton(ContentNumber) {
	var ButtonID = "AddImage" + ContentNumber;
	document.getElementById(ButtonID).removeAttribute('disabled');
	$("#" + ButtonID).show();
}

function LoadGalleryContent(XML) {
	var Gallery = $(XML).find("simpleviewergallery");

	var ImageNumber = 0;
	
	var GalleryName = Gallery.attr("title");
	var GalleryHeading = Gallery.attr("title");
	
	if (document.getElementById('GalleryName').innerHTML.length == 0) {
		if (GalleryName.length != 0) {
			document.getElementById('GalleryName').innerHTML = GalleryName;
		} else {
			document.getElementById('GalleryName').innerHTML = "NULL";
		}
	}
	
	if (document.getElementById('GalleryHeading').innerHTML.length == 0) {
		if (GalleryName.length != 0) {
			document.getElementById('GalleryHeading').innerHTML = GalleryName;
		} else {
			document.getElementById('GalleryHeading').innerHTML = "NULL";
		}
	}
	
	var ImageLocation = null;
	var ThumbLocation = null;
	var LinkLocation = null;
	
	var ImageUrl = null;
	var ThumbUrl = null;
	var LinkUrl = null;
	var LinkTarget = null;
	var Caption = null;
	
	Gallery.find("image").each(function() {
		ImageUrl = $(this).attr("imageURL");
		ThumbUrl = $(this).attr("thumbURL");
		LinkUrl = $(this).attr("linkURL");
		LinkTarget = $(this).attr("linkTarget");
		Caption = $(this).find("caption").text();
		
		var Data = new Array();
		Data['ImageUrl'] = stripDirectory(ImageUrl.replace("images/",""), false);
		Data['ThumbUrl'] = stripDirectory(ThumbUrl.replace("thumbs/", ""), false);
		Data['LinkUrl'] = stripDirectory(LinkUrl.replace("images/", ""), false);
		Data['LinkTarget'] = LinkTarget;
		Data['Caption'] = Caption;
		
		ImageNumber = ImageNumber + 1;
		
		AddOneImage(ImageNumber, Data);
	});
	
	if (SessionID != null & PageID != null) {
		ImageLocation = stripDirectory(ImageUrl, true);
		ThumbLocation = stripDirectory(ThumbUrl,true);
		LinkLocation = stripDirectory(LinkUrl,true);
		
		if (ImageLocation != null) {
			document.getElementById('ImageLocation').innerHTML = ImageLocation;
		}
		
		if (ThumbLocation != null) {
			document.getElementById('ThumbLocation').innerHTML = ThumbLocation;
		}
		
		if (LinkLocation != null) {
			document.getElementById('LinkLocation').innerHTML = LinkLocation;
		}
		//alert (ImageLocation);
	}
}

function stripDirectory(str, removefile) {
	var temp = new Array();
	temp = str.split('/');
	if (removefile === true) {
		temp.pop();
		//temp.toString();
		//temp.replace("," , "/");
		var returnstring = '';
		
		temp.forEach(function(string) {
			returnstring = returnstring + string + '/';
		});
		
		return returnstring;
	} else {
		return temp.pop();
	}
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
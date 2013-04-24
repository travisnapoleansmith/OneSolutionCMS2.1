// JavaScript Document
var GET = GetUrlVars();
//var PageLocation = "../Modules/Tier6ContentLayer/Core/XhtmlTable/XmlTableListing.php";
//var TableListings = null;

//var TableSelectionOutput = document.createDocumentFragment();

//var TableSelectionLabel = document.createElement('label');
//var TableSelectionLabelDiv = document.createElement('div');

var COOKIE = document.cookie.split(';');
//var SessionID = null;

$(document).ready(function()
{
	//CreateTableSelectionLabel();
	
	/*$.ajax({
		url: PageLocation,
		type: "GET", 
		dataType: "xml",
		success: LoadTableListings
	}).done(function (data){
		if (GET['SessionID'] != null) {
			SessionID = GET['SessionID'];
		}
		
		if (SessionID != null) {
			var File = '../Administrators/PageTypes/TablePage/TEMPFILES/' + SessionID + '.xml';
			
			$.ajax({
				url: File,
				type: "GET", 
				dataType: "xml",
				success: LoadTables
			});
		}
	});*/
	
});

/*function CreateTableSelectionLabel() {
	TableSelectionLabel.setAttribute('class', 'BodyText ShortForm');
	TableSelectionLabel.setAttribute('dir', "ltr");
	TableSelectionLabel.setAttribute('lang', "en-us");
	TableSelectionLabel.setAttribute('xml:lang', "en-us");
	TableSelectionLabel.innerHTML = "Table";
	
	TableSelectionLabelDiv.appendChild(TableSelectionLabel);
}*/

/*
function CreateTableListing() {
	var TableSelectionContentDiv = document.createElement('select');
	
	TableSelectionContentDiv.setAttribute('class', "ShortForm");
	TableSelectionContentDiv.setAttribute('dir', "ltr");
	TableSelectionContentDiv.setAttribute('lang', "en-us");
	TableSelectionContentDiv.setAttribute('xml:lang', "en-us");
	TableSelectionContentDiv.appendChild(TableSelectionOutput.cloneNode(true));
	
	return (TableSelectionContentDiv);
}
*/

function AddContent(ContentNumber) {
	var Data = null;
	
	if (arguments[1] != null) {
		Data = arguments[1];
	}
	
	var AppendID = null;
	if (ContentNumber === 1) {
		AppendID = "Heading";
	} else {
		AppendID = ContentNumber;
		AppendID = AppendID - 1;
		AppendID = "Content" + AppendID;
	}
	
	var NextAddContentPage = ContentNumber + 1;
	var AddContentName = "AddContent" + NextAddContentPage;
	var RemoveContentName = "RemoveContent" + NextAddContentPage;
	var AddContentOnClick = "AddContent(" + NextAddContentPage + ");";
	var RemoveContentOnClick = "RemoveContent(" + NextAddContentPage + ");";
	
	var ContentName = "Content " + ContentNumber;
	var ContentID = "Content" + ContentNumber;
	
	var HeadingContentID = "Content" + ContentNumber + "Heading";
	var HeadingContentName = "Content" + ContentNumber + "_Heading";
	
	var TopTextContentID = "Content" + ContentNumber + "TopText";
	var TopTextContentName = "Content" + ContentNumber + "_TopText";
	
	var BottomTextContentID = "Content" + ContentNumber + "BottomText";
	var BottomTextContentName = "Content" + ContentNumber + "_BottomText";
	
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
	Legend.innerHTML = ContentName + " - Videos Page";
	
	FieldSet.appendChild(Legend);
	
	
	// HEADING
	var HeadingLabel = document.createElement('label');
	var HeadingContent = document.createElement('textarea');
	
	HeadingLabel.setAttribute('class', 'BodyText ShortForm');
	HeadingLabel.setAttribute('dir', "ltr");
	HeadingLabel.setAttribute('lang', "en-us");
	HeadingLabel.setAttribute('xml:lang', "en-us");
	HeadingLabel.innerHTML = "Heading";
	
	HeadingContent.setAttribute('class', "ShortForm");
	HeadingContent.setAttribute('dir', "ltr");
	HeadingContent.setAttribute('id', HeadingContentID);
	HeadingContent.setAttribute('lang', "en-us");
	HeadingContent.setAttribute('xml:lang', "en-us");
	HeadingContent.setAttribute('rows', "4");
	HeadingContent.setAttribute('cols', "30");
	HeadingContent.setAttribute('name', HeadingContentName);
	
	if (Data != null) {
		if (Data['Heading'] != null) {
			HeadingContent.innerHTML = Data['Heading'];
		} else {
			HeadingContent.innerHTML = 'NULL';
		}
	} else {
		HeadingContent.innerHTML = 'NULL';
	}
	
	var HeadingLabelDiv = document.createElement('div');
	var HeadingContentDiv = document.createElement('div');
	HeadingLabelDiv.appendChild(HeadingLabel);
	HeadingContentDiv.appendChild(HeadingContent);
	
	FieldSet.appendChild(HeadingLabelDiv);
	FieldSet.appendChild(HeadingContentDiv);
	
	// TOP TEXT
	var TopTextLabel = document.createElement('label');
	var TopTextContent = document.createElement('textarea');
	
	TopTextLabel.setAttribute('class', 'BodyText ShortForm');
	TopTextLabel.setAttribute('dir', "ltr");
	TopTextLabel.setAttribute('lang', "en-us");
	TopTextLabel.setAttribute('xml:lang', "en-us");
	TopTextLabel.innerHTML = "Top Text";
	
	TopTextContent.setAttribute('class', "ShortFormTableBox");
	TopTextContent.setAttribute('dir', "ltr");
	TopTextContent.setAttribute('id', TopTextContentID);
	TopTextContent.setAttribute('lang', "en-us");
	TopTextContent.setAttribute('xml:lang', "en-us");
	TopTextContent.setAttribute('rows', "15");
	TopTextContent.setAttribute('cols', "3");
	TopTextContent.setAttribute('name', TopTextContentName);
	
	if (Data != null) {
		if (Data['TopText'] != null) {
			TopTextContent.innerHTML = Data['TopText'];
		} else {
			TopTextContent.innerHTML = 'NULL';
		}
	} else {
		TopTextContent.innerHTML = 'NULL';
	}
	
	var TopTextLabelDiv = document.createElement('div');
	var TopTextContentDiv = document.createElement('div');
	TopTextLabelDiv.appendChild(TopTextLabel);
	TopTextContentDiv.appendChild(TopTextContent);
	
	FieldSet.appendChild(TopTextLabelDiv);
	FieldSet.appendChild(TopTextContentDiv);
	
	// VIDEO CONTENT
		// ADD VIDEO BUTTON
		var AddVideoButton = document.createElement("button");
		AddVideoButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
		AddVideoButton.setAttribute('dir', "ltr");
		AddVideoButton.setAttribute('id', ContentID + "AddVideo" + 1);
		AddVideoButton.setAttribute('lang', "en-us");
		AddVideoButton.setAttribute('xml:lang', "en-us");
		AddVideoButton.setAttribute('name', "AddVideo" + 1);
		AddVideoButton.setAttribute('type', "button");
		AddVideoButton.setAttribute('onclick', "AddVideo(" + 1 + ",\"" + ContentID + "\");");
		AddVideoButton.innerHTML = "Add Video " + 1;
		
		FieldSet.appendChild(AddVideoButton);
		
		// REMOVE CONTENT BUTTON
		var RemoveVideoButton = document.createElement("button");
		RemoveVideoButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
		RemoveVideoButton.setAttribute('dir', "ltr");
		RemoveVideoButton.setAttribute('id', "RemoveVideo" + 1);
		RemoveVideoButton.setAttribute('lang', "en-us");
		RemoveVideoButton.setAttribute('xml:lang', "en-us");
		RemoveVideoButton.setAttribute('name', "RemoveVideo" + 1);
		RemoveVideoButton.setAttribute('type', "button");
		RemoveVideoButton.setAttribute('onclick', "RemoveVideo(" + 1 + ",\"" + ContentID + "\");");
		RemoveVideoButton.innerHTML = "Remove Video " + 1;
		
		FieldSet.appendChild(RemoveVideoButton);
		
	
	
	// BOTTOM TEXT
	var BottomTextLabel = document.createElement('label');
	var BottomTextContent = document.createElement('textarea');
	
	BottomTextLabel.setAttribute('class', 'BodyText ShortForm');
	BottomTextLabel.setAttribute('dir', "ltr");
	BottomTextLabel.setAttribute('lang', "en-us");
	BottomTextLabel.setAttribute('xml:lang', "en-us");
	BottomTextLabel.innerHTML = "Bottom Text";
	
	BottomTextContent.setAttribute('class', "ShortFormTableBox");
	BottomTextContent.setAttribute('dir', "ltr");
	BottomTextContent.setAttribute('id', BottomTextContentID);
	BottomTextContent.setAttribute('lang', "en-us");
	BottomTextContent.setAttribute('xml:lang', "en-us");
	BottomTextContent.setAttribute('rows', "15");
	BottomTextContent.setAttribute('cols', "3");
	BottomTextContent.setAttribute('name', BottomTextContentName);
	
	if (Data != null) {
		if (Data['BottomText'] != null & Data['BottomText'].length != 0) {
			BottomTextContent.innerHTML = Data['BottomText'];
		} else {
			BottomTextContent.innerHTML = 'NULL';
		}
	} else {
		BottomTextContent.innerHTML = 'NULL';
	}
	
	
	var BottomTextLabelDiv = document.createElement('div');
	var BottomTextContentDiv = document.createElement('div');
	BottomTextLabelDiv.appendChild(BottomTextLabel);
	BottomTextContentDiv.appendChild(BottomTextContent);
	
	FieldSet.appendChild(BottomTextLabelDiv);
	FieldSet.appendChild(BottomTextContentDiv);
	
	// ADD CONTENT BUTTON
	var AddButton = document.createElement("button");
	AddButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	AddButton.setAttribute('dir', "ltr");
	AddButton.setAttribute('id', AddContentName);
	AddButton.setAttribute('lang', "en-us");
	AddButton.setAttribute('xml:lang', "en-us");
	AddButton.setAttribute('name', AddContentName);
	AddButton.setAttribute('type', "button");
	AddButton.setAttribute('onclick', AddContentOnClick);
	AddButton.innerHTML = "Add Content " + NextAddContentPage;
	
	FieldSet.appendChild(AddButton);
	
	// REMOVE CONTENT BUTTON
	var RemoveButton = document.createElement("button");
	RemoveButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	RemoveButton.setAttribute('dir', "ltr");
	RemoveButton.setAttribute('id', RemoveContentName);
	RemoveButton.setAttribute('lang', "en-us");
	RemoveButton.setAttribute('xml:lang', "en-us");
	RemoveButton.setAttribute('name', RemoveContentName);
	RemoveButton.setAttribute('type', "button");
	RemoveButton.setAttribute('onclick', RemoveContentOnClick);
	RemoveButton.innerHTML = "Remove Content " + NextAddContentPage;
	
	FieldSet.appendChild(RemoveButton);
	
	DisablePriorAddContentButtons(ContentNumber);
	
	$("#" + AppendID).after(FieldSet);
}

function RemoveContent(ContentNumber) {
	var DivID = 'Content' + ContentNumber;
	if (document.getElementById(DivID)) {
		$("#"+DivID).remove();
		EnablePriorAddContentButton(ContentNumber);
	} else {
		alert("Content " + ContentNumber + " Does Not Exist!");
	}
}

function DisablePriorAddContentButtons(ContentNumber) {
	var ButtonID = "AddContent" + ContentNumber;
	document.getElementById(ButtonID).setAttribute('disabled', "disabled");
	$("#" + ButtonID).hide();
}

function EnablePriorAddContentButton(ContentNumber) {
	var ButtonID = "AddContent" + ContentNumber;
	document.getElementById(ButtonID).removeAttribute('disabled');
	$("#" + ButtonID).show();
}

function AddVideo(VideoNumber, ContentID) {
	var Data = null;
	
	if (arguments[2] != null) {
		Data = arguments[2];
	}
	
	var AppendID = null;
	if (VideoNumber === 1) {
		AppendID = ContentID + "AddVideo1";
	} else {
		AppendID = VideoNumber;
		AppendID = AppendID - 1;
		AppendID = ContentID + "Video" + AppendID;
	}
	
	var NextAddVideoPage = VideoNumber + 1;
	var AddVideoName = ContentID + "AddVideo" + NextAddVideoPage;
	var RemoveVideoName = ContentID + "RemoveVideo" + NextAddVideoPage;
	var AddVideoOnClick = "AddVideo(" + NextAddVideoPage + ",\"" + ContentID + "\");";
	var RemoveVideoOnClick = "RemoveVideo(" + NextAddVideoPage + ",\"" + ContentID + "\");";
	
	var VideoName = "Video " + VideoNumber;
	var VideoID = ContentID + "Video" + VideoNumber;
	
	var VideoLocationContentID = ContentID + "Video" + VideoNumber + "VideoLocation";
	var VideoLocationContentName = ContentID + "_Video" + VideoNumber + "_VideoLocation";
	
	var NoFlashTextContentID = ContentID + "Video" + VideoNumber + "TopText";
	var NoFlashTextContentName = ContentID + "_Video" + VideoNumber + "_TopText";
	
	var FieldSet = document.createElement('fieldset');
	FieldSet.setAttribute('class', "ShortForm");
	FieldSet.setAttribute('style', "left: 5px;");
	FieldSet.setAttribute('dir', "ltr");
	FieldSet.setAttribute('id', VideoID);
	FieldSet.setAttribute('lang', "en-us");
	FieldSet.setAttribute('xml:lang', "en-us");
	
	var Legend = document.createElement('legend');
	Legend.setAttribute('class', "BodyHeading");
	Legend.setAttribute('dir', "ltr");
	Legend.setAttribute('lang', "en-us");
	Legend.setAttribute('xml:lang', "en-us");
	Legend.innerHTML = VideoName;
	
	FieldSet.appendChild(Legend);
	
	// Video Location
	var VideoLocationLabel = document.createElement('label');
	var VideoLocationContent = document.createElement('input');
	
	VideoLocationLabel.setAttribute('class', 'BodyText ShortForm');
	VideoLocationLabel.setAttribute('dir', "ltr");
	VideoLocationLabel.setAttribute('lang', "en-us");
	VideoLocationLabel.setAttribute('xml:lang', "en-us");
	VideoLocationLabel.innerHTML = "Video Location";
	
	VideoLocationContent.setAttribute('class', "ShortForm");
	VideoLocationContent.setAttribute('dir', "ltr");
	VideoLocationContent.setAttribute('id', VideoLocationContentID);
	VideoLocationContent.setAttribute('lang', "en-us");
	VideoLocationContent.setAttribute('xml:lang', "en-us");
	VideoLocationContent.setAttribute('name', VideoLocationContentName);
	VideoLocationContent.setAttribute('type', 'text');
	
	if (Data != null) {
		if (Data['VideoLocation'] != null) {
			VideoLocationContent.setAttribute('value', Data['VideoLocation']);
		} else {
			VideoLocationContent.setAttribute('value', 'NULL');
		}
	} else {
		VideoLocationContent.setAttribute('value', 'NULL');
	}
	
	var VideoLocationLabelDiv = document.createElement('div');
	var VideoLocationContentDiv = document.createElement('div');
	VideoLocationLabelDiv.appendChild(VideoLocationLabel);
	VideoLocationContentDiv.appendChild(VideoLocationContent);
	
	FieldSet.appendChild(VideoLocationLabelDiv);
	FieldSet.appendChild(VideoLocationContentDiv);
	
	// NO FLASH TEXT
	var NoFlashTextLabel = document.createElement('label');
	var NoFlashTextContent = document.createElement('textarea');
	
	NoFlashTextLabel.setAttribute('class', 'BodyText ShortForm');
	NoFlashTextLabel.setAttribute('dir', "ltr");
	NoFlashTextLabel.setAttribute('lang', "en-us");
	NoFlashTextLabel.setAttribute('xml:lang', "en-us");
	NoFlashTextLabel.innerHTML = "No Flash Text";
	
	NoFlashTextContent.setAttribute('class', "ShortFormTableBox");
	NoFlashTextContent.setAttribute('dir', "ltr");
	NoFlashTextContent.setAttribute('id', NoFlashTextContentID);
	NoFlashTextContent.setAttribute('lang', "en-us");
	NoFlashTextContent.setAttribute('xml:lang', "en-us");
	NoFlashTextContent.setAttribute('rows', "15");
	NoFlashTextContent.setAttribute('cols', "3");
	NoFlashTextContent.setAttribute('name', NoFlashTextContentName);
	
	if (Data != null) {
		if (Data['NoFlashText'] != null) {
			NoFlashTextContent.innerHTML = Data['NoFlashText'];
		} else {
			NoFlashTextContent.innerHTML = "VIDEO NAME - <a href='http://get.adobe.com/flashplayer/'>Adobe Flash </a> is needed to view these pictures";
		}
	} else {
		NoFlashTextContent.innerHTML = "VIDEO NAME - <a href='http://get.adobe.com/flashplayer/'>Adobe Flash </a> is needed to view these pictures";
	}
	
	var NoFlashTextLabelDiv = document.createElement('div');
	var NoFlashTextContentDiv = document.createElement('div');
	NoFlashTextLabelDiv.appendChild(NoFlashTextLabel);
	NoFlashTextContentDiv.appendChild(NoFlashTextContent);
	
	FieldSet.appendChild(NoFlashTextLabelDiv);
	FieldSet.appendChild(NoFlashTextContentDiv);
	
	// ADD CONTENT BUTTON
	var AddButton = document.createElement("button");
	AddButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	AddButton.setAttribute('dir', "ltr");
	AddButton.setAttribute('id', AddVideoName);
	AddButton.setAttribute('lang', "en-us");
	AddButton.setAttribute('xml:lang', "en-us");
	AddButton.setAttribute('name', AddVideoName);
	AddButton.setAttribute('type', "button");
	AddButton.setAttribute('onclick', AddVideoOnClick);
	AddButton.innerHTML = "Add Video " + NextAddVideoPage;
	
	FieldSet.appendChild(AddButton);
	
	// REMOVE CONTENT BUTTON
	var RemoveButton = document.createElement("button");
	RemoveButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	RemoveButton.setAttribute('dir', "ltr");
	RemoveButton.setAttribute('id', RemoveVideoName);
	RemoveButton.setAttribute('lang', "en-us");
	RemoveButton.setAttribute('xml:lang', "en-us");
	RemoveButton.setAttribute('name', RemoveVideoName);
	RemoveButton.setAttribute('type', "button");
	RemoveButton.setAttribute('onclick', RemoveVideoOnClick);
	RemoveButton.innerHTML = "Remove Video " + NextAddVideoPage;
	
	FieldSet.appendChild(RemoveButton);
	
	DisablePriorAddVideoButtons(VideoNumber, ContentID);
	
	$("#" + AppendID).after(FieldSet);
	
	// FIX When someone clicks remove button and then clicks on Add the same one that was removed that all the proper buttons are disabled.
}

function RemoveVideo(VideoNumber, ContentID) {
	var DivID = ContentID + 'Video' + VideoNumber;
	if (document.getElementById(DivID)) {
		$("#"+DivID).remove();
		EnablePriorAddVideoButton(VideoNumber, ContentID);
	} else {
		alert(ContentID + " Video " + VideoNumber + " Does Not Exist!");
	}
}

function DisablePriorAddVideoButtons(VideoNumber, ContentID) {
	var ButtonID = ContentID + "AddVideo" + VideoNumber;
	document.getElementById(ButtonID).setAttribute('disabled', "disabled");
	$("#" + ButtonID).hide();
}

function EnablePriorAddVideoButton(VideoNumber, ContentID) {
	var ButtonID = ContentID + "AddVideo" + VideoNumber;
	document.getElementById(ButtonID).removeAttribute('disabled');
	$("#" + ButtonID).show();
}

/*
function LoadTableListings(XML) {
	var Listings = $(XML).find("TableListings");
	var TableContentArray = new Array();
	var TableSelectionContent = document.createElement('option');
	
	Listings.find("Item").each(function(){
		TableContentArray['TableID'] = $(this).find("TableID").text();
		TableContentArray['TableName'] = $(this).find("TableName").text();
		
		TableSelectionContent = document.createElement('option');
		TableSelectionContent.setAttribute('class', "ShortForm");
		TableSelectionContent.setAttribute('dir', "ltr");
		TableSelectionContent.setAttribute('lang', "en-us");
		TableSelectionContent.setAttribute('xml:lang', "en-us");
		TableSelectionContent.innerHTML = TableContentArray['TableID'] + " - " + TableContentArray['TableName'];
		
		TableSelectionOutput.appendChild(TableSelectionContent);
		
	});
}
*/

/*
function LoadTables(XML) {
	var Tables = $(XML).find("Content");
	var TableContent = new Array();
	Tables.find("Table").each(function() {
		var TableName = $(this).attr("name");
		var Heading = $(this).find("Heading").text();
		var TopText = $(this).find("TopText").text();
		var Image1Alt = $(this).find("Image1Alt").text();
		var Image1Src = $(this).find("Image1Src").text();
		var Image1Text = $(this).find("Image1Text").text();
		var Image2Alt = $(this).find("Image2Alt").text();
		var Image2Src = $(this).find("Image2Src").text();
		var Image2Text = $(this).find("Image2Text").text();
		var Name = $(this).find("Name").text();
		var BottomText = $(this).find("BottomText").text();
		
		var Data = new Array();
		Data['TableName'] = TableName;
		Data['Heading'] = Heading;
		Data['TopText'] = stripSlashes(TopText);
		Data['Image1Alt'] = Image1Alt;
		Data['Image1Src'] = Image1Src;
		Data['Image1Text'] = stripSlashes(Image1Text);
		Data['Image2Alt'] = Image2Alt;
		Data['Image2Src'] = Image2Src;
		Data['Image2Text'] = stripSlashes(Image2Text);
		Data['Name'] = Name;
		Data['BottomText'] = BottomText;
		
		var TableNumber = TableName.replace("Table", '');
		TableNumber = parseInt(TableNumber);
		AddTable(TableNumber, Data);		
	});
}
*/

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
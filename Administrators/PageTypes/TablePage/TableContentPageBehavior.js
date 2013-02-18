// JavaScript Document
var GET = GetUrlVars();
var PageLocation = "../Modules/Tier6ContentLayer/Core/XhtmlTable/XmlTableListing.php";
var TableListings = null;

var TableSelectionOutput = document.createDocumentFragment();

var TableSelectionLabel = document.createElement('label');
var TableSelectionLabelDiv = document.createElement('div');

var COOKIE = document.cookie.split(';');
var SessionID = null;

$(document).ready(function()
{
	CreateTableSelectionLabel();
	
	$.ajax({
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
	});
});

function CreateTableSelectionLabel() {
	TableSelectionLabel.setAttribute('class', 'BodyText ShortForm');
	TableSelectionLabel.setAttribute('dir', "ltr");
	TableSelectionLabel.setAttribute('lang', "en-us");
	TableSelectionLabel.setAttribute('xml:lang', "en-us");
	TableSelectionLabel.innerHTML = "Table";
	
	TableSelectionLabelDiv.appendChild(TableSelectionLabel);
}

function CreateTableListing() {
	var TableSelectionContentDiv = document.createElement('select');
	
	TableSelectionContentDiv.setAttribute('class', "ShortForm");
	TableSelectionContentDiv.setAttribute('dir', "ltr");
	TableSelectionContentDiv.setAttribute('lang', "en-us");
	TableSelectionContentDiv.setAttribute('xml:lang', "en-us");
	TableSelectionContentDiv.appendChild(TableSelectionOutput.cloneNode(true));
	
	return (TableSelectionContentDiv);
}

function AddTable(TableNumber) {
	var Data = null;
	
	if (arguments[1] != null) {
		Data = arguments[1];
	}
	
	var AppendID = null;
	if (TableNumber === 1) {
		AppendID = "Heading"
	} else {
		AppendID = TableNumber;
		AppendID = AppendID - 1;
		AppendID = "Table" + AppendID;
	}
	
	var NextAddTablePage = TableNumber + 1;
	var AddTableName = "AddTable" + NextAddTablePage;
	var RemoveTableName = "RemoveTable" + NextAddTablePage;
	var AddTableOnClick = "AddTable(" + NextAddTablePage + ");";
	var RemoveTableOnClick = "RemoveTable(" + NextAddTablePage + ");";
	
	var TableName = "Table " + TableNumber;
	var TableID = "Table" + TableNumber;
	
	var HeadingContentID = "Table" + TableNumber + "Heading";
	var HeadingContentName = "Table" + TableNumber + "_Heading";
	
	var TopTextContentID = "Table" + TableNumber + "TopText";
	var TopTextContentName = "Table" + TableNumber + "_TopText";
	
	var BottomTextContentID = "Table" + TableNumber + "BottomText";
	var BottomTextContentName = "Table" + TableNumber + "_BottomText";
	
	var TableSelectionContentID = "Table" + TableNumber + "Selection";
	var TableSelectionContentName = "Table" + TableNumber + "_Name";
	
	var Image1SrcID = "Table" + TableNumber + "Image1Src";
	var Image1SrcName = "Table" + TableNumber + "_Image1Src";
	
	var Image1TextID = "Table" + TableNumber + "Image1Text";
	var Image1TextName = "Table" + TableNumber + "_Image1Text";
	
	var Image1AltID = "Table" + TableNumber + "Image1Alt";
	var Image1AltName = "Table" + TableNumber + "_Image1Alt";
	
	var Image2SrcID = "Table" + TableNumber + "Image2Src";
	var Image2SrcName = "Table" + TableNumber + "_Image2Src";
	
	var Image2TextID = "Table" + TableNumber + "Image2Text";
	var Image2TextName = "Table" + TableNumber + "_Image2Text";
	
	var Image2AltID = "Table" + TableNumber + "Image2Alt";
	var Image2AltName = "Table" + TableNumber + "_Image2Alt";
	
	var FieldSet = document.createElement('fieldset');
	FieldSet.setAttribute('class', "ShortForm");
	FieldSet.setAttribute('dir', "ltr");
	FieldSet.setAttribute('id', TableID);
	FieldSet.setAttribute('lang', "en-us");
	FieldSet.setAttribute('xml:lang', "en-us");
	
	var Legend = document.createElement('legend');
	Legend.setAttribute('class', "BodyHeading");
	Legend.setAttribute('dir', "ltr");
	Legend.setAttribute('lang', "en-us");
	Legend.setAttribute('xml:lang', "en-us");
	Legend.innerHTML = TableName + " - Table Page";
	
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
	
	// Image 1
	Image1SrcLabel = document.createElement('label');
	Image1SrcContent = document.createElement('input');
	
	Image1SrcLabel.setAttribute('class', 'BodyText ShortForm');
	Image1SrcLabel.setAttribute('dir', "ltr");
	Image1SrcLabel.setAttribute('lang', "en-us");
	Image1SrcLabel.setAttribute('xml:lang', "en-us");
	Image1SrcLabel.innerHTML = "Image 1 Src";
	
	Image1SrcContent.setAttribute('class', "ShortForm");
	Image1SrcContent.setAttribute('dir', "ltr");
	Image1SrcContent.setAttribute('id', Image1SrcID);
	Image1SrcContent.setAttribute('lang', "en-us");
	Image1SrcContent.setAttribute('xml:lang', "en-us");
	Image1SrcContent.setAttribute('type', "text");
	
	if (Data != null) {
		if (Data['Image1Src'] != null & Data['Image1Src'].length != 0) {
			Image1SrcContent.setAttribute('value', Data['Image1Src']);
		} else {
			Image1SrcContent.setAttribute('value', "NULL");
		}
	} else {
		Image1SrcContent.setAttribute('value', "NULL");
	}
	
	Image1SrcContent.setAttribute('name', Image1SrcName);
	
	var Image1SrcLabelDiv = document.createElement('div');
	var Image1SrcContentDiv = document.createElement('div');
	Image1SrcLabelDiv.appendChild(Image1SrcLabel);
	Image1SrcContentDiv.appendChild(Image1SrcContent);
	
	FieldSet.appendChild(Image1SrcLabelDiv);
	FieldSet.appendChild(Image1SrcContentDiv);
	
	var Image1TextLabel = document.createElement('label');
	var Image1TextContent = document.createElement('textarea');
	
	Image1TextLabel.setAttribute('class', 'BodyText ShortForm');
	Image1TextLabel.setAttribute('dir', "ltr");
	Image1TextLabel.setAttribute('lang', "en-us");
	Image1TextLabel.setAttribute('xml:lang', "en-us");
	Image1TextLabel.innerHTML = "Image 1 Text";
	
	Image1TextContent.setAttribute('class', "ShortForm");
	Image1TextContent.setAttribute('dir', "ltr");
	Image1TextContent.setAttribute('id', Image1TextID);
	Image1TextContent.setAttribute('lang', "en-us");
	Image1TextContent.setAttribute('xml:lang', "en-us");
	Image1TextContent.setAttribute('rows', "15");
	Image1TextContent.setAttribute('cols', "3");
	Image1TextContent.setAttribute('name', Image1TextName);
	
	if (Data != null) {
		if (Data['Image1Text'] != null & Data['Image1Text'].length != 0) {
			Image1TextContent.innerHTML = Data['Image1Text'];
		} else {
			Image1TextContent.innerHTML = "NULL";
		}
	} else {
		Image1TextContent.innerHTML = "PHOTO IMAGE TEXT GOES HERE - IF YOU NEED A LINK HERE IS THE TAG FOR THAT! <a href='LINK GOES HERE'>Gallery</a>";
	}
	
	var Image1TextLabelDiv = document.createElement('div');
	var Image1TextContentDiv = document.createElement('div');
	Image1TextLabelDiv.appendChild(Image1TextLabel);
	Image1TextContentDiv.appendChild(Image1TextContent);
	
	FieldSet.appendChild(Image1TextLabelDiv);
	FieldSet.appendChild(Image1TextContentDiv);
	
	Image1AltLabel = document.createElement('label');
	Image1AltContent = document.createElement('input');
	
	Image1AltLabel.setAttribute('class', 'BodyText ShortForm');
	Image1AltLabel.setAttribute('dir', "ltr");
	Image1AltLabel.setAttribute('lang', "en-us");
	Image1AltLabel.setAttribute('xml:lang', "en-us");
	Image1AltLabel.innerHTML = "Image 1 Alt";
	
	Image1AltContent.setAttribute('class', "ShortForm");
	Image1AltContent.setAttribute('dir', "ltr");
	Image1AltContent.setAttribute('id', Image1AltID);
	Image1AltContent.setAttribute('lang', "en-us");
	Image1AltContent.setAttribute('xml:lang', "en-us");
	Image1AltContent.setAttribute('type', "text");
	
	if (Data != null) {
		if (Data['Image1Alt'] != null & Data['Image1Alt'].length != 0) {
			Image1AltContent.setAttribute('value', Data['Image1Alt']);
		} else {
			Image1AltContent.setAttribute('value', "NULL");
		}
	} else {
		Image1AltContent.setAttribute('value', "NULL");
	}
	
	Image1AltContent.setAttribute('name', Image1AltName);
	
	var Image1AltLabelDiv = document.createElement('div');
	var Image1AltContentDiv = document.createElement('div');
	Image1AltLabelDiv.appendChild(Image1AltLabel);
	Image1AltContentDiv.appendChild(Image1AltContent);
	
	FieldSet.appendChild(Image1AltLabelDiv);
	FieldSet.appendChild(Image1AltContentDiv);
	
	// Image 2
	Image2SrcLabel = document.createElement('label');
	Image2SrcContent = document.createElement('input');
	
	Image2SrcLabel.setAttribute('class', 'BodyText ShortForm');
	Image2SrcLabel.setAttribute('dir', "ltr");
	Image2SrcLabel.setAttribute('lang', "en-us");
	Image2SrcLabel.setAttribute('xml:lang', "en-us");
	Image2SrcLabel.innerHTML = "Image 2 Src";
	
	Image2SrcContent.setAttribute('class', "ShortForm");
	Image2SrcContent.setAttribute('dir', "ltr");
	Image2SrcContent.setAttribute('id', Image2SrcID);
	Image2SrcContent.setAttribute('lang', "en-us");
	Image2SrcContent.setAttribute('xml:lang', "en-us");
	Image2SrcContent.setAttribute('type', "text");
	
	if (Data != null) {
		if (Data['Image2Src'] != null & Data['Image2Src'].length != 0) {
			Image2SrcContent.setAttribute('value', Data['Image2Src']);
		} else {
			Image2SrcContent.setAttribute('value', "NULL");
		}
	} else {
		Image2SrcContent.setAttribute('value', "NULL");
	}
	
	Image2SrcContent.setAttribute('name', Image2SrcName);
	
	var Image2SrcLabelDiv = document.createElement('div');
	var Image2SrcContentDiv = document.createElement('div');
	Image2SrcLabelDiv.appendChild(Image2SrcLabel);
	Image2SrcContentDiv.appendChild(Image2SrcContent);
	
	FieldSet.appendChild(Image2SrcLabelDiv);
	FieldSet.appendChild(Image2SrcContentDiv);
	
	var Image2TextLabel = document.createElement('label');
	var Image2TextContent = document.createElement('textarea');
	
	Image2TextLabel.setAttribute('class', 'BodyText ShortForm');
	Image2TextLabel.setAttribute('dir', "ltr");
	Image2TextLabel.setAttribute('lang', "en-us");
	Image2TextLabel.setAttribute('xml:lang', "en-us");
	Image2TextLabel.innerHTML = "Image 2 Text";
	
	Image2TextContent.setAttribute('class', "ShortForm");
	Image2TextContent.setAttribute('dir', "ltr");
	Image2TextContent.setAttribute('id', Image2TextID);
	Image2TextContent.setAttribute('lang', "en-us");
	Image2TextContent.setAttribute('xml:lang', "en-us");
	Image2TextContent.setAttribute('rows', "15");
	Image2TextContent.setAttribute('cols', "3");
	Image2TextContent.setAttribute('name', Image2TextName);
	
	if (Data != null) {
		if (Data['Image2Text'] != null & Data['Image2Text'].length != 0) {
			Image2TextContent.innerHTML = Data['Image2Text'];
		} else {
			Image2TextContent.innerHTML = "NULL";
		}
	} else {
		Image2TextContent.innerHTML = "PHOTO IMAGE TEXT GOES HERE - IF YOU NEED A LINK HERE IS THE TAG FOR THAT! <a href='LINK GOES HERE'>Gallery</a>";
	}
	
	var Image2TextLabelDiv = document.createElement('div');
	var Image2TextContentDiv = document.createElement('div');
	Image2TextLabelDiv.appendChild(Image2TextLabel);
	Image2TextContentDiv.appendChild(Image2TextContent);
	
	FieldSet.appendChild(Image2TextLabelDiv);
	FieldSet.appendChild(Image2TextContentDiv);
	
	Image2AltLabel = document.createElement('label');
	Image2AltContent = document.createElement('input');
	
	Image2AltLabel.setAttribute('class', 'BodyText ShortForm');
	Image2AltLabel.setAttribute('dir', "ltr");
	Image2AltLabel.setAttribute('lang', "en-us");
	Image2AltLabel.setAttribute('xml:lang', "en-us");
	Image2AltLabel.innerHTML = "Image 2 Alt";
	
	Image2AltContent.setAttribute('class', "ShortForm");
	Image2AltContent.setAttribute('dir', "ltr");
	Image2AltContent.setAttribute('id', Image2AltID);
	Image2AltContent.setAttribute('lang', "en-us");
	Image2AltContent.setAttribute('xml:lang', "en-us");
	Image2AltContent.setAttribute('type', "text");
	
	if (Data != null) {
		if (Data['Image2Alt'] != null & Data['Image2Alt'].length != 0) {
			Image2AltContent.setAttribute('value', Data['Image2Alt']);
		} else {
			Image2AltContent.setAttribute('value', "NULL");
		}
	} else {
		Image2AltContent.setAttribute('value', "NULL");
	}
	
	Image2AltContent.setAttribute('name', Image2AltName);
	
	var Image2AltLabelDiv = document.createElement('div');
	var Image2AltContentDiv = document.createElement('div');
	Image2AltLabelDiv.appendChild(Image2AltLabel);
	Image2AltContentDiv.appendChild(Image2AltContent);
	
	FieldSet.appendChild(Image2AltLabelDiv);
	FieldSet.appendChild(Image2AltContentDiv);
	
	// Table Listing
	var TableSelectionContentDiv = CreateTableListing();
	TableSelectionContentDiv.setAttribute('id', TableSelectionContentID);
	TableSelectionContentDiv.setAttribute('name', TableSelectionContentName);
	
	if (Data != null) {
		if (Data['Name'] != null) {
			$(TableSelectionContentDiv).each(function () {
				$(this).children("option").each(function() {
					if ($(this).text() == Data['Name']) {
						$(this).attr("selected", "selected");
					}
				});
			});
		}
	}
	
	FieldSet.appendChild(TableSelectionLabelDiv.cloneNode(true));
	FieldSet.appendChild(TableSelectionContentDiv);
	
	
	
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
	
	// ADD BUTTON
	var AddButton = document.createElement("button");
	AddButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	AddButton.setAttribute('dir', "ltr");
	AddButton.setAttribute('id', AddTableName);
	AddButton.setAttribute('lang', "en-us");
	AddButton.setAttribute('xml:lang', "en-us");
	AddButton.setAttribute('name', AddTableName);
	AddButton.setAttribute('type', "button");
	AddButton.setAttribute('onclick', AddTableOnClick);
	AddButton.innerHTML = "Add Table " + NextAddTablePage;
	
	FieldSet.appendChild(AddButton);
	
	// REMOVE BUTTON
	var RemoveButton = document.createElement("button");
	RemoveButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	RemoveButton.setAttribute('dir', "ltr");
	RemoveButton.setAttribute('id', RemoveTableName);
	RemoveButton.setAttribute('lang', "en-us");
	RemoveButton.setAttribute('xml:lang', "en-us");
	RemoveButton.setAttribute('name', RemoveTableName);
	RemoveButton.setAttribute('type', "button");
	RemoveButton.setAttribute('onclick', RemoveTableOnClick);
	RemoveButton.innerHTML = "Remove Table " + NextAddTablePage;
	
	FieldSet.appendChild(RemoveButton);
	
	DisablePriorAddTableButtons(TableNumber);
	$("#" + AppendID).after(FieldSet);
}

function RemoveTable(TableNumber) {
	var DivID = 'Table' + TableNumber;
	if (document.getElementById(DivID)) {
		$("#"+DivID).remove();
		EnablePriorAddTableButton(TableNumber);
	} else {
		alert("Table " + TableNumber + " Does Not Exist!");
	}
}

function DisablePriorAddTableButtons(TableNumber) {
	var ButtonID = "AddTable" + TableNumber;
	document.getElementById(ButtonID).setAttribute('disabled', "disabled");
	$("#" + ButtonID).hide();
}

function EnablePriorAddTableButton(TableNumber) {
	var ButtonID = "AddTable" + TableNumber;
	document.getElementById(ButtonID).removeAttribute('disabled');
	$("#" + ButtonID).show();
}

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
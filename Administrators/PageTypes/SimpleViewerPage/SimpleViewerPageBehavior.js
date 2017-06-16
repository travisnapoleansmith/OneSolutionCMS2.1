// JavaScript Document
var GET = GetUrlVars();
var PageLocation = "../Modules/Tier6ContentLayer/User/XhtmlSimpleViewer/XmlSimpleViewerListing.php";
var SimpleViewerListings = null;

var SimpleViewerSelectionOutput = document.createDocumentFragment();
var SimpleViewerOrderSelectionOutput = document.createDocumentFragment();

var SimpleViewerSelectionLabel = document.createElement('label');
var SimpleViewerSelectionLabelDiv = document.createElement('div');

var SimpleViewerOrderLabel = document.createElement('label');
var SimpleViewerOrderLabelDiv = document.createElement('div');

var COOKIE = document.cookie.split(';');
var SessionID = null;

var SimpleViewerCount = 0;

$(document).ready(function()
{
	CreateSimpleViewerSelectionLabel();
	CreateSimpleViewerOrderLabel();
	
	$.ajax({
		url: PageLocation,
		type: "GET", 
		dataType: "xml",
		success: LoadSimpleViewerListings
	}).done(function (data){
		if (GET['SessionID'] != null) {
			SessionID = GET['SessionID'];
		}
		
		if (SessionID != null) {
			var File = '../Administrators/PageTypes/SimpleViewerPage/TEMPFILES/' + SessionID + '.xml';
			$.ajax({
				url: File,
				type: "GET", 
				dataType: "xml",
				success: LoadSimpleViewers
			});
		}
	});
});

function CreateSimpleViewerSelectionLabel() {
	SimpleViewerSelectionLabel.setAttribute('class', 'BodyText ShortForm');
	SimpleViewerSelectionLabel.setAttribute('dir', "ltr");
	SimpleViewerSelectionLabel.setAttribute('lang', "en-us");
	SimpleViewerSelectionLabel.setAttribute('xml:lang', "en-us");
	SimpleViewerSelectionLabel.innerHTML = "SimpleViewer";
	
	SimpleViewerSelectionLabelDiv.appendChild(SimpleViewerSelectionLabel);
}

function CreateSimpleViewerListing() {
	var SimpleViewerSelectionContentDiv = document.createElement('select');
	
	SimpleViewerSelectionContentDiv.setAttribute('class', "ShortForm");
	SimpleViewerSelectionContentDiv.setAttribute('dir', "ltr");
	SimpleViewerSelectionContentDiv.setAttribute('lang', "en-us");
	SimpleViewerSelectionContentDiv.setAttribute('xml:lang', "en-us");
	SimpleViewerSelectionContentDiv.appendChild(SimpleViewerSelectionOutput.cloneNode(true));
	
	return (SimpleViewerSelectionContentDiv);
}

function CreateSimpleViewerOrderLabel() {
	SimpleViewerOrderLabel.setAttribute('class', 'BodyText ShortForm');
	SimpleViewerOrderLabel.setAttribute('dir', "ltr");
	SimpleViewerOrderLabel.setAttribute('lang', "en-us");
	SimpleViewerOrderLabel.setAttribute('xml:lang', "en-us");
	SimpleViewerOrderLabel.innerHTML = "Order";
	
	SimpleViewerOrderLabelDiv.appendChild(SimpleViewerOrderLabel);
}

function CreateOrderListing() {
	var SimpleViewerOrderSelectionContentDiv = document.createElement('select');
	
	SimpleViewerOrderSelectionContentDiv.setAttribute('class', "ShortForm");
	SimpleViewerOrderSelectionContentDiv.setAttribute('dir', "ltr");
	SimpleViewerOrderSelectionContentDiv.setAttribute('lang', "en-us");
	SimpleViewerOrderSelectionContentDiv.setAttribute('xml:lang', "en-us");
	SimpleViewerOrderSelectionContentDiv.appendChild(SimpleViewerOrderSelectionOutput.cloneNode(true));
	
	return (SimpleViewerOrderSelectionContentDiv);
}

function AddGallery(SimpleViewerNumber) {
	SimpleViewerCount = SimpleViewerCount + 1;
	var Data = null;
	
	if (arguments[1] != null) {
		Data = arguments[1];
	}
	
	var AppendID = null;
	if (SimpleViewerNumber === 1) {
		AppendID = "Heading"
	} else {
		AppendID = SimpleViewerNumber;
		AppendID = AppendID - 1;
		AppendID = "SimpleViewer" + AppendID;
	}
	
	var NextAddGalleryPage = SimpleViewerNumber + 1;
	var AddGalleryName = "AddGallery" + NextAddGalleryPage;
	var RemoveGalleryName = "RemoveGallery" + NextAddGalleryPage;
	var AddGalleryOnClick = "AddGallery(" + NextAddGalleryPage + ");";
	var RemoveGalleryOnClick = "RemoveGallery(" + NextAddGalleryPage + ");";
	
	var SimpleViewerName = "SimpleViewer " + SimpleViewerNumber;
	var SimpleViewerID = "SimpleViewer" + SimpleViewerNumber;
	
	var HeadingContentID = "SimpleViewer" + SimpleViewerNumber + "Heading";
	var HeadingContentName = "SimpleViewer" + SimpleViewerNumber + "_Heading";
	
	var TopTextContentID = "SimpleViewer" + SimpleViewerNumber + "TopText";
	var TopTextContentName = "SimpleViewer" + SimpleViewerNumber + "_TopText";
	
	var BottomTextContentID = "SimpleViewer" + SimpleViewerNumber + "BottomText";
	var BottomTextContentName = "SimpleViewer" + SimpleViewerNumber + "_BottomText";
	
	var SimpleViewerSelectionContentID = "SimpleViewer" + SimpleViewerNumber + "Selection";
	var SimpleViewerSelectionContentName = "SimpleViewer" + SimpleViewerNumber + "_Name";
	
	var SimpleViewerOrderContentID = "SimpleViewer" + SimpleViewerNumber + "Order";
	var SimpleViewerOrderContentName = "SimpleViewer" + SimpleViewerNumber + "_Order"
	
	var FieldSet = document.createElement('fieldset');
	FieldSet.setAttribute('class', "ShortForm");
	FieldSet.setAttribute('dir', "ltr");
	FieldSet.setAttribute('id', SimpleViewerID);
	FieldSet.setAttribute('lang', "en-us");
	FieldSet.setAttribute('xml:lang', "en-us");
	
	var Legend = document.createElement('legend');
	Legend.setAttribute('class', "BodyHeading");
	Legend.setAttribute('dir', "ltr");
	Legend.setAttribute('lang', "en-us");
	Legend.setAttribute('xml:lang', "en-us");
	Legend.innerHTML = SimpleViewerName + " - SimpleViewer Page";
	
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
	
	TopTextContent.setAttribute('class', "ShortForm");
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
	
	// SimpleViewer Listing
	var SimpleViewerSelectionContentDiv = CreateSimpleViewerListing();
	SimpleViewerSelectionContentDiv.setAttribute('id', SimpleViewerSelectionContentID);
	SimpleViewerSelectionContentDiv.setAttribute('name', SimpleViewerSelectionContentName);
	
	if (Data != null) {
		if (Data['Name'] != null) {
			$(SimpleViewerSelectionContentDiv).each(function () {
				$(this).children("option").each(function() {
					if ($(this).text() == Data['Name']) {
						$(this).attr("selected", "selected");
					}
				});
			});
		}
	}
	
	FieldSet.appendChild(SimpleViewerSelectionLabelDiv.cloneNode(true));
	FieldSet.appendChild(SimpleViewerSelectionContentDiv);
	
	// BOTTOM TEXT
	var BottomTextLabel = document.createElement('label');
	var BottomTextContent = document.createElement('textarea');
	
	BottomTextLabel.setAttribute('class', 'BodyText ShortForm');
	BottomTextLabel.setAttribute('dir', "ltr");
	BottomTextLabel.setAttribute('lang', "en-us");
	BottomTextLabel.setAttribute('xml:lang', "en-us");
	BottomTextLabel.innerHTML = "Bottom Text";
	
	BottomTextContent.setAttribute('class', "ShortForm");
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
	
	// ORDER
	AddSimpleViewerOrder(SimpleViewerNumber);
	var SimpleViewerOrderContentDiv = CreateOrderListing();
	SimpleViewerOrderContentDiv.setAttribute('id', SimpleViewerOrderContentID);
	SimpleViewerOrderContentDiv.setAttribute('name', SimpleViewerOrderContentName);
	
	if (Data != null) {
		if (Data['Order'] != null) {
			$(SimpleViewerOrderContentDiv).each(function () {
				$(this).children("option").each(function() {
					if ($(this).text() == Data['Order']) {
						$(this).attr("selected", "selected");
					}
				});
			});
		}
	}
	
	FieldSet.appendChild(SimpleViewerOrderLabelDiv.cloneNode(true));
	FieldSet.appendChild(SimpleViewerOrderContentDiv);
	
	var ButtonDiv = document.createElement("div");
	
	// ADD BUTTON
	var AddButton = document.createElement("button");
	AddButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	AddButton.setAttribute('dir', "ltr");
	AddButton.setAttribute('id', AddGalleryName);
	AddButton.setAttribute('lang', "en-us");
	AddButton.setAttribute('xml:lang', "en-us");
	AddButton.setAttribute('name', AddGalleryName);
	AddButton.setAttribute('type', "button");
	AddButton.setAttribute('onclick', AddGalleryOnClick);
	AddButton.innerHTML = "Add SimpleViewer " + NextAddGalleryPage;
	
	ButtonDiv.appendChild(AddButton);
	
	// REMOVE BUTTON
	var RemoveButton = document.createElement("button");
	RemoveButton.setAttribute('class', "BodyTextButton ShortForm ShortFormButton");
	RemoveButton.setAttribute('dir', "ltr");
	RemoveButton.setAttribute('id', RemoveGalleryName);
	RemoveButton.setAttribute('lang', "en-us");
	RemoveButton.setAttribute('xml:lang', "en-us");
	RemoveButton.setAttribute('name', RemoveGalleryName);
	RemoveButton.setAttribute('type', "button");
	RemoveButton.setAttribute('onclick', RemoveGalleryOnClick);
	RemoveButton.innerHTML = "Remove SimpleViewer " + NextAddGalleryPage;
	
	ButtonDiv.appendChild(RemoveButton);
	
	FieldSet.appendChild(ButtonDiv);
	
	DisablePriorAddGalleryButtons(SimpleViewerNumber);
	$("#" + AppendID).after(FieldSet);
}

function RemoveGallery(SimpleViewerNumber) {
	RemoveSimpleViewerOrder(SimpleViewerNumber);
	
	if (SimpleViewerCount > 0) {
		SimpleViewerCount = SimpleViewerCount - 1;
	}
	
	var DivID = 'SimpleViewer' + SimpleViewerNumber;
	if (document.getElementById(DivID)) {
		$("#"+DivID).remove();
		EnablePriorAddGalleryButton(SimpleViewerNumber);
	} else {
		alert("SimpleViewer " + SimpleViewerNumber + " Does Not Exist!");
	}
}

function DisablePriorAddGalleryButtons(SimpleViewerNumber) {
	var ButtonID = "AddGallery" + SimpleViewerNumber;
	document.getElementById(ButtonID).setAttribute('disabled', "disabled");
	$("#" + ButtonID).hide();
}

function EnablePriorAddGalleryButton(SimpleViewerNumber) {
	var ButtonID = "AddGallery" + SimpleViewerNumber;
	document.getElementById(ButtonID).removeAttribute('disabled');
	$("#" + ButtonID).show();
}

function LoadSimpleViewerListings(XML) {
	var Listings = $(XML).find("SimpleViewerListings");
	var SimpleViewerContentArray = new Array();
	var SimpleViewerSelectionContent = document.createElement('option');
	
	Listings.find("Item").each(function(){
		SimpleViewerContentArray['GalleryID'] = $(this).find("GalleryID").text();
		SimpleViewerContentArray['GalleryName'] = $(this).find("GalleryName").text();
		
		SimpleViewerSelectionContent = document.createElement('option');
		SimpleViewerSelectionContent.setAttribute('class', "ShortForm");
		SimpleViewerSelectionContent.setAttribute('dir', "ltr");
		SimpleViewerSelectionContent.setAttribute('lang', "en-us");
		SimpleViewerSelectionContent.setAttribute('xml:lang', "en-us");
		SimpleViewerSelectionContent.innerHTML = SimpleViewerContentArray['GalleryID'] + " - " + SimpleViewerContentArray['GalleryName'];
		
		SimpleViewerSelectionOutput.appendChild(SimpleViewerSelectionContent);
		
	});
}

function LoadSimpleViewers(XML) {
	var SimpleViewers = $(XML).find("Content");
	var SimpleViewerContent = new Array();
	SimpleViewers.find("SimpleViewer").each(function() {
		var SimpleViewerName = $(this).attr("name");
		var Heading = $(this).find("Heading").text();
		var TopText = $(this).find("TopText").text();
		var Name = $(this).find("Name").text();
		var BottomText = $(this).find("BottomText").text();
		var Order = $(this).find("Order").text();
		
		var Data = new Array();
		Data['SimpleViewerName'] = SimpleViewerName;
		Data['Heading'] = Heading;
		Data['TopText'] = stripSlashes(TopText);
		Data['Name'] = Name;
		Data['BottomText'] = BottomText;
		Data['Order'] = Order;
		
		var SimpleViewerNumber = SimpleViewerName.replace("SimpleViewer", '');
		SimpleViewerNumber = parseInt(SimpleViewerNumber);
		AddGallery(SimpleViewerNumber, Data);		
	});
}

function AddSimpleViewerOrder(OrderNumber) {
	if (OrderNumber == 1) {
		SimpleViewerOrderSelectionContent = document.createElement('option');
		SimpleViewerOrderSelectionContent.setAttribute('class', "ShortForm");
		SimpleViewerOrderSelectionContent.setAttribute('dir', "ltr");
		SimpleViewerOrderSelectionContent.setAttribute('lang', "en-us");
		SimpleViewerOrderSelectionContent.setAttribute('xml:lang', "en-us");
		SimpleViewerOrderSelectionContent.innerHTML = 'NULL';
		
		SimpleViewerOrderSelectionOutput.appendChild(SimpleViewerOrderSelectionContent);
	}
	
	var Temp = SimpleViewerCount;
	//Temp = Temp - 1;
	var DivID = null;
	var TempDiv = null;
	for (i = Temp; i > 0; i = i - 1) {
		DivID = 'SimpleViewer' + i + 'Order';
		if (document.getElementById(DivID)) {
			TempDiv = document.getElementById(DivID);
			
			SimpleViewerOrderSelectionContent = document.createElement('option');
			SimpleViewerOrderSelectionContent.setAttribute('class', "ShortForm");
			SimpleViewerOrderSelectionContent.setAttribute('dir', "ltr");
			SimpleViewerOrderSelectionContent.setAttribute('lang', "en-us");
			SimpleViewerOrderSelectionContent.setAttribute('xml:lang', "en-us");
			SimpleViewerOrderSelectionContent.innerHTML = OrderNumber;
			
			TempDiv.appendChild(SimpleViewerOrderSelectionContent);
		}
	}
	
	SimpleViewerOrderSelectionContent = document.createElement('option');
	SimpleViewerOrderSelectionContent.setAttribute('class', "ShortForm");
	SimpleViewerOrderSelectionContent.setAttribute('dir', "ltr");
	SimpleViewerOrderSelectionContent.setAttribute('lang', "en-us");
	SimpleViewerOrderSelectionContent.setAttribute('xml:lang', "en-us");
	SimpleViewerOrderSelectionContent.innerHTML = OrderNumber;
	
	SimpleViewerOrderSelectionOutput.appendChild(SimpleViewerOrderSelectionContent);
}

function RemoveSimpleViewerOrder(OrderNumber) {
	var MAX = SimpleViewerCount;
	var DivID = null;
	var TempDiv = null;
	var Contents = null;
	/*
	// Removes Order Number from the fragment document.
	$(SimpleViewerOrderSelectionOutput).children('option').each(function () {
		if (this.innerHTML == OrderNumber) {
			$(this).remove();
		}
	});
	
	// Add All Order Numbers To Fragment Document.
	var TempDivID = null;
	var TempDiv = null;
	i = 1;
	alert (SimpleViewerOrderSelectionOutput);
	$(SimpleViewerOrderSelectionOutput).children('option').each(function () {
		if (this.innerHTML != "NULL") {
			this.innerHTML = i;
			i = i + 1;
		}
	});
	*/
	
	if (OrderNumber > 0) {
		// Removes all prior Order Number for drop downs.
		for (i = 1; i <= MAX; i = i + 1) {
			DivID = 'SimpleViewer' + i + 'Order';
			TempDiv = document.getElementById(DivID);
			Contents = TempDiv.innerHTML;
			$("#" + DivID).children('option').each(function () {
				if (this.innerHTML == OrderNumber) {
					$(this).remove();
				}
			});
			
		}
		
		// Removes Order Number from the fragment document.
		$(SimpleViewerOrderSelectionOutput).children('option').each(function () {
			if (this.innerHTML == OrderNumber) {
				$(this).remove();
			}
		});
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
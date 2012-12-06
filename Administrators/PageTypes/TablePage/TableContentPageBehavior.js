// JavaScript Document
var PageLocation = "../Modules/Tier6ContentLayer/Core/XhtmlTable/XmlTableListing.php";
var TableListings = null;

var TableSelectionOutput = document.createDocumentFragment();

var TableSelectionLabel = document.createElement('label');
var TableSelectionLabelDiv = document.createElement('div');

$(document).ready(function()
{
	CreateTableSelectionLabel();
	
	$.ajax({
		url: PageLocation,
		type: "GET", 
		dataType: "xml",
		success: LoadTableListings
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
	var AppendID = null;
	if (TableNumber === 1) {
		AppendID = "Heading"
	} else {
		AppendID = TableNumber;
		AppendID = AppendID - 1;
		AppendID = "Table" + AppendID;
	}
	
	var NextAddTablePage = TableNumber + 1;
	var TableName = "Table " + TableNumber;
	var TableID = "Table" + TableNumber;
	var AddTableName = "AddTable" + NextAddTablePage;
	var RemoveTableName = "RemoveTable" + NextAddTablePage;
	var AddTableOnClick = "AddTable(" + NextAddTablePage + ");";
	var RemoveTableOnClick = "RemoveTable(" + NextAddTablePage + ");";
	
	var HeadingContentID = "Table" + TableNumber + "Heading";
	var HeadingContentName = "Table" + TableNumber + "_Heading";
	
	var TopTextContentID = "Table" + TableNumber + "TopText";
	var TopTextContentName = "Table" + TableNumber + "_TopText";
	
	var BottomTextContentID = "Table" + TableNumber + "BottomText";
	var BottomTextContentName = "Table" + TableNumber + "_BottomText";
	
	var TableSelectionContentID = "Table" + TableNumber + "Selection";
	var TableSelectionContentName = "Table" + TableNumber + "_Name";
	
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
	TopTextContent.setAttribute('rows', "30");
	TopTextContent.setAttribute('cols', "3");
	TopTextContent.setAttribute('name', TopTextContentName);
	
	var TopTextLabelDiv = document.createElement('div');
	var TopTextContentDiv = document.createElement('div');
	TopTextLabelDiv.appendChild(TopTextLabel);
	TopTextContentDiv.appendChild(TopTextContent);
	
	FieldSet.appendChild(TopTextLabelDiv);
	FieldSet.appendChild(TopTextContentDiv);
	
	var TableSelectionContentDiv = CreateTableListing();
	
	TableSelectionContentDiv.setAttribute('id', TableSelectionContentID);
	TableSelectionContentDiv.setAttribute('name', TableSelectionContentName);
	
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
	BottomTextContent.setAttribute('rows', "30");
	BottomTextContent.setAttribute('cols', "3");
	BottomTextContent.setAttribute('name', BottomTextContentName);
	
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
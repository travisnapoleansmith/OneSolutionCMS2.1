// JavaScript Document
var PageLocation = "../Modules/Tier6ContentLayer/Core/XhtmlTable/XmlTableListing.php";
var TableListings = null;

var TableSelectionLabel = document.createElement('label');
var TableSelectionLabelDiv = document.createElement('div');
//var TableSelectionContentDiv = document.createElement('div');
var TableSelectionContentDiv = document.createElement('select');

$(document).ready(function()
{
	CreateTableListing();
	
	$.ajax({
		url: PageLocation,
		type: "GET", 
		dataType: "xml",
		success: LoadTableListings
	});
	//LoadGrid();
});

function CreateTableListing() {
	////////////////TableListings = document.createElement('div');
	
	// TABLE SELECTION
	//var TableSelectionLabel = document.createElement('label');
	
	TableSelectionLabel.setAttribute('class', 'BodyText ShortForm');
	TableSelectionLabel.setAttribute('dir', "ltr");
	TableSelectionLabel.setAttribute('lang', "en-us");
	TableSelectionLabel.setAttribute('xml:lang', "en-us");
	TableSelectionLabel.innerHTML = "Table";
	
	//var TableSelectionLabelDiv = document.createElement('div');
	//var TableSelectionContentDiv = document.createElement('div');
	//var TableSelectionContentDiv = document.createElement('select');
	TableSelectionContentDiv.setAttribute('class', "ShortForm");
	TableSelectionContentDiv.setAttribute('dir', "ltr");
	//TableSelectionContentDiv.setAttribute('id', TableSelectionContentID);
	TableSelectionContentDiv.setAttribute('lang', "en-us");
	TableSelectionContentDiv.setAttribute('xml:lang', "en-us");
	//TableSelectionContentDiv.setAttribute('name', TableSelectionContentName);
	
	TableSelectionLabelDiv.appendChild(TableSelectionLabel);
	//TableSelectionContentDiv.appendChild(TableSelectionContent);
	//TableSelectionContentDiv.appendChild(TableSelectionSelect);
	
}
//function LoadGrid() {
	//alert("TESTING");
//}

function AddTable(TableNumber) {
	//alert("Add Table " + AddTablePage);
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
	var TopTextContentID = "Table" + TableNumber + "TopText";
	var BottomTextContentID = "Table" + TableNumber + "BottomText";
	var TableSelectionContentID = "Table" + TableNumber + "Selection";
	var TableSelectionContentName = "Table" + TableNumber + "Name";
	
	//alert (AppendID);
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
	
	var TopTextLabelDiv = document.createElement('div');
	var TopTextContentDiv = document.createElement('div');
	TopTextLabelDiv.appendChild(TopTextLabel);
	TopTextContentDiv.appendChild(TopTextContent);
	
	FieldSet.appendChild(TopTextLabelDiv);
	FieldSet.appendChild(TopTextContentDiv);
	
	// TABLE SELECTION
	/*var TableSelectionLabel = document.createElement('label');
	var TableSelectionContent = document.createElement('option');
	
	TableSelectionLabel.setAttribute('class', 'BodyText ShortForm');
	TableSelectionLabel.setAttribute('dir', "ltr");
	TableSelectionLabel.setAttribute('lang', "en-us");
	TableSelectionLabel.setAttribute('xml:lang', "en-us");
	TableSelectionLabel.innerHTML = "Table";
	
	TableSelectionContent.setAttribute('class', "ShortForm");
	TableSelectionContent.setAttribute('dir', "ltr");
	TableSelectionContent.setAttribute('lang', "en-us");
	TableSelectionContent.setAttribute('xml:lang', "en-us");
	TableSelectionContent.innerHTML = "Table 1";
	
	var TableSelectionLabelDiv = document.createElement('div');
	//var TableSelectionContentDiv = document.createElement('div');
	var TableSelectionContentDiv = document.createElement('select');
	TableSelectionContentDiv.setAttribute('class', "ShortForm");
	TableSelectionContentDiv.setAttribute('dir', "ltr");
	TableSelectionContentDiv.setAttribute('id', TableSelectionContentID);
	TableSelectionContentDiv.setAttribute('lang', "en-us");
	TableSelectionContentDiv.setAttribute('xml:lang', "en-us");
	TableSelectionContentDiv.setAttribute('name', TableSelectionContentName);
	
	TableSelectionLabelDiv.appendChild(TableSelectionLabel);
	TableSelectionContentDiv.appendChild(TableSelectionContent);
	//TableSelectionContentDiv.appendChild(TableSelectionSelect);
	*/
	TableSelectionContentDiv.setAttribute('id', TableSelectionContentID);
	TableSelectionContentDiv.setAttribute('name', TableSelectionContentName);
	
	FieldSet.appendChild(TableSelectionLabelDiv);
	FieldSet.appendChild(TableSelectionContentDiv);
	
	TableSelectionContentDiv.removeAttribute('id');
	TableSelectionContentDiv.removeAttribute('name');
	
	//alert(TableSelectionContentDiv);
	
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
	alert("Remove Table " + TableNumber);
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
		
		TableSelectionContentDiv.appendChild(TableSelectionContent);
		
	});
}
var Temp = document.getElementById("Import");
if (typeof(Temp) != 'undefined' && Temp != null) {
	document.getElementById("Import").setAttribute('onclick', 'ImportData();');
}

document.getElementById("AddRow").setAttribute('onclick', 'AddOneRow();');
document.getElementById("AddColumn").setAttribute('onclick', 'AddOneColumn();');
document.getElementById("RemoveColumn").setAttribute('onclick', 'RemoveOneColumn();');
document.getElementById("RemoveRow").setAttribute('onClick', 'DeleteCurrentRows();');

var RowCount = null;
var ColumnCount = null;

var GET = GetUrlVars();
var COOKIE = document.cookie.split(';');
var PageLocation = "../Administrators/PageTypes/TablePage/XmlDHtmlXGridTables.php?TableID=";
var PageID = 0;
var FileName = null;

var TableContentTemp = COOKIE;
var TableContent = new Array();

var mygrid = null;

if (TableContentTemp instanceof Array) {
	for (Index in TableContentTemp) {
		var CurrentValue = TableContentTemp[Index];
		if (CurrentValue.search(/TableContent\[/) != -1) {
			var Temp = CurrentValue.split(/\[|\]/);
			Temp[4] = Temp[4].replace('=', '');
			var FirstIndex = Temp[1];
			var SecondIndex = Temp[3];
			var Value = Temp[4];
			
			if (TableContent[FirstIndex] == null) {
				TableContent[FirstIndex] = new Array();
			}
			TableContent[FirstIndex][SecondIndex] = Value;
		}
	}
}


if (GET['TableID'] != null) {
	PageID = GET['TableID'];
}

if (GET['File'] != null) {
	FileName = GET['File'];
}

PageLocation = PageLocation + PageID;

var ColumnHeader = new Array();
var ColumnFooter = new Array();

mygrid = new dhtmlXGridObject('Grid');

$(document).ready(function()
{
	CheckFile();
	$.ajax({
		url: PageLocation,
		type: "GET", 
		dataType: "xml",
		success: LoadHeaderData
	});
	
	LoadGrid();
});

//window.onload=setTimeout("LoadRowColumnCount()", 60);
window.onload=setTimeout("LoadCookieData()", 90);

function CheckFile() {
	if (FileName != null) {
		//var File = '../Administrators/PageTypes/TablePage/UPLOAD/';
		//File += FileName;
		var FileLocation = "../Administrators/PageTypes/TablePage/XmlDHtmlXGridImport.php?File=";
		FileLocation += FileName;
		PageLocation = FileLocation;
		
		var FileDiv = document.createElement('div');
		var FileInput = document.createElement('input');
		FileInput.setAttribute('type', 'hidden');
		FileInput.setAttribute('name', "File");
		FileInput.setAttribute('value', FileName);
		
		FileDiv.appendChild(FileInput);
		var FormElement = document.getElementsByTagName('form');
		//alert(FormElement.length);
		FormElement[0].appendChild(FileDiv);
	}
}

function LoadGrid() {
	mygrid.setImagePath("../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandard/dhtmlxGrid/codebase/imgs/");
	mygrid.init();
	mygrid.setSkin("dhx_skyblue");
	mygrid.setStyle("", "color: black;");
	
	mygrid.load(PageLocation);
	////mygrid.loadXML(PageLocation);
	//mygrid.enableDragAndDrop(true);
	
	mygrid.submitOnlyChanged(false);
	
	var Start = confirm("Click OK when table data has been loaded!");
	if (Start == true) {
		LoadRowColumnCount();
	} else {
		alert("Data needs to load, data may not save properly, please refresh and try again!");
	}
	
}

function LoadRowColumnCount() {
	ColumnCount = mygrid.getColumnsNum();
	RowCount = mygrid.getRowsNum();
	if (RowCount == 0) {
		alert("Data has not loaded, data may not save properly, please refresh the page!");
	} else {
		RowCount = Number(RowCount) * 100;
		RowCount = Number(RowCount) - 100;
		//alert(RowCount);
	}
	
}

function LoadCookieData() {
	if (TableContent instanceof Array) {
		if (TableContent.length < 1) {
			//alert ("Table Data Is Being Reloaded!");
			for (Index in TableContent) {
				if (TableContent[Index] instanceof Array) {
					for (SubIndex in TableContent[Index]) {
						if (TableContent[Index][SubIndex] != null) {
							var Content = TableContent[Index][SubIndex];
							if (!mygrid.doesRowExist(Index)) {
								AddOneRow();
							}
							mygrid.cells(Index, SubIndex).cell.innerHTML=Content;
						}
					}
				}
			}
			//alert ("Table Data Has Been Reloaded!");
		}
	}
}

function LoadColumns(Page, Header, Name, IDName) {
	var i = 1;
	if (Header instanceof Array) {
		for (Index in Header) {
			var LabelID = Name + "Label" + i;
			var ColumnID = Name + i;
			var ColumnName = Name + " " + i;
			var ColumnValue = Header[Index];
			var Label = document.createElement('label');
			Label.setAttribute('id', LabelID);
			Label.setAttribute('class', 'BodyText ShortForm');
			Label.setAttribute('xml:lang', 'en-us');
			Label.setAttribute('dir', 'ltr');
			Label.innerHTML = ColumnName; 
			var DivLabel = document.createElement('div');
			DivLabel.appendChild(Label);
			document.getElementById(IDName).appendChild(DivLabel);
			
			var Input = document.createElement('input');
			var Heading = readCookie(ColumnID);
			if (Heading != null) {
				Input.setAttribute('value', Heading);
			} else {
				Input.setAttribute('value', ColumnValue);
			}
			Input.setAttribute('id', ColumnID);
			Input.setAttribute('class', 'ShortForm');
			Input.setAttribute('xml:lang', 'en-us');
			Input.setAttribute('dir', 'ltr');
			Input.setAttribute('type', 'text');
			Input.setAttribute('name', ColumnID);
			var DivInput = document.createElement('div');
			DivInput.appendChild(Input);
			document.getElementById(IDName).appendChild(DivInput);
			i++;
		}
		ColumnID = Name + i;
		var VALUE = readCookie(ColumnID);
		//alert(COOKIE);
		if (readCookie(ColumnID) != null) {
			alert ("Loading More Header and Footer Columns!");
		}
		while (readCookie(ColumnID) != null) {
			//alert (Name);
			CreateColumn(Header, Name, IDName, i);
			var ColumnNumber = mygrid.getColumnsNum();
			//alert (i);
			//alert(ColumnNumber);
			if (ColumnNumber != i) {
				ColumnCount = ColumnCount + 1;
				mygrid.insertColumn(ColumnCount, "Column " + ColumnCount, 'ed', '110', 'str'); 
			}
			//AddOneColumn();
			i++;
			ColumnID = Name + i;
		}
	}
}

function CreateColumn(Header, Name, IDName, Count) {
	var LabelID = Name + "Label" + Count;
	var ColumnID = Name + Count;
	var ColumnName = Name + " " + Count;
	var ColumnValue = Header[Count];
	var Label = document.createElement('label');
	Label.setAttribute('id', LabelID);
	Label.setAttribute('class', 'BodyText ShortForm');
	Label.setAttribute('xml:lang', 'en-us');
	Label.setAttribute('dir', 'ltr');
	Label.innerHTML = ColumnName; 
	var DivLabel = document.createElement('div');
	DivLabel.appendChild(Label);
	document.getElementById(IDName).appendChild(DivLabel);
	
	var Input = document.createElement('input');
	Input.setAttribute('id', ColumnID);
	Input.setAttribute('class', 'ShortForm');
	Input.setAttribute('xml:lang', 'en-us');
	Input.setAttribute('dir', 'ltr');
	Input.setAttribute('type', 'text');
	
	var Heading = readCookie(ColumnID);
	if (Heading != null) {
		Input.setAttribute('value', Heading);
	} else {
		Input.setAttribute('value', ColumnValue);
	}
	Input.setAttribute('name', ColumnID);
	
	var DivInput = document.createElement('div');
	DivInput.appendChild(Input);
	document.getElementById(IDName).appendChild(DivInput);
	
}

function RemoveColumn(Header, Name, IDName, Count) {
	var ColumnName = Name + Count;
	var LabelColumnName = Name + "Label" + Count;
	//alert(ColumnName);
	//alert(LastColumnName);
	$('#' + ColumnName).remove();
	$('#' + LabelColumnName).remove();
	
	ShiftColumns(Header, Name, ColumnName, LabelColumnName, Count);
}

function ShiftColumns(Header, Name, ColumnName, LabelColumnName, Count) {
	Count++;
	var NewColumnName = Name + Count;
	var NewLabelName = Name + "Label" + Count;
	while ($('#' + NewColumnName).length) {
		//alert ("IN HERE");
		//if ($('#' + NewColumnName).length) {
			$('#' + ColumnName).attr('id', NewColumnName);
			$('#' + LabelColumnName).attr('id', NewLabelName);
		//}
		Count++;
		ColumnName = NewColumnName;
		LabelColumnName = NewLabelColumnName;
		NewColumnName = Name + Count;
		NewLabelName = Name + "Label" + Count;
	}
}

function ImportData() {
	Vault = new dhtmlXVaultObject();
	Vault.setImagePath("../../Libraries/Tier7BehavioralLayer/DHTMLXVault/codebase/imgs/");
	Vault.setServerHandlers("PageTypes/TablePage/UploadHandler.php", "PageTypes/TablePage/GetInfoHandler.php", "PageTypes/TablePage/GetIdHandler.php");
	Vault.setFilesLimit(1);
	
	Vault.onAddFile = function(FileName) {
			var Ext = this.getFileExtension(FileName);
			if (Ext != "csv" && Ext != "xls") {
				alert ("You may only upload CSV or Excel documents. Please retry.");
				return false;
			} else {
				return true;
			}
		};
	
	Vault.onUploadComplete = function (Files) {
			var File = Files[0];
			
			var Url = document.URL + "&File=" + File.name;
			alert ("You are being redirect to a new Add Table Content form with your file");
			window.location = Url;
		};
	Vault.create("Vault");
}

function AddOneRow() {
	RowCount = +RowCount + 100;
	var Id = mygrid.getSelectedId();
	if (Id != null) {
		//mygrid.moveRowDown(Id);
		var NewRow;
		var OldRow;
		var LastRow;
		NewRow = RowCount -0;
		OldRow = RowCount - 100;
		for(var i = 0; NewRow != Id; i++) {
			//alert(NewRow);
			mygrid.changeRowId(OldRow, NewRow);
			NewRow = NewRow - 100;
			OldRow = OldRow - 100;
		}
		
		var RowPosition;
		RowPosition = null;
		RowPosition = Id / 100;
		mygrid.addRow(Id, "", RowPosition);
	} else {
		mygrid.addRow(RowCount, "");
	}
	
	
	// THIS WORKS!
	//mygrid.addRow("TEST", "10, Dog, Cat, Bird");
	//mygrid.cells(100, 1).cell.innerHTML="Chicken";
}

function DeleteCurrentRows() {
	mygrid.deleteSelectedRows();	
}

function AddOneColumn() {
	ColumnCount = ColumnCount + 1;
	mygrid.insertColumn(ColumnCount, "Column " + ColumnCount, 'ed', '110', 'str'); 
	
	ColumnHeader[ColumnCount] = "Column " + ColumnCount;
	ColumnFooter[ColumnCount] = "NULL";

	CreateColumn(ColumnHeader, "Header", "ColumnHeadings", ColumnCount);
	CreateColumn(ColumnFooter, "Footer", "ColumnFooters", ColumnCount);
}

function RemoveOneColumn() {
	var Id = mygrid.getSelectedCellIndex();
	var Index = mygrid.getColIndexById(Id);
	//var ColumnID = mygrid.getColumnId(Id);
	mygrid.deleteColumn(Id);
	
	var ElementRemove = Id + 1;
	
	//if (ColumnHeader[ID]) {
		//alert ("HERE");
		ColumnHeader.splice(Id, 1);
		ColumnFooter.splice(Id, 1);
	//}
	//alert(ColumnHeader);
	//alert(ElementRemove);
	RemoveColumn(ColumnHeader, "Header", "ColumnHeadings", ElementRemove);
	RemoveColumn(ColumnFooter, "Footer", "ColumnFooters", ElementRemove);
}

function LoadHeaderData(XML) {
	var $Head = $(XML).find("head");
	$Head.find("column").each(function(){
		ColumnHeader.push($(this).text());
	});
	
	LoadColumns(PageLocation, ColumnHeader, "Header", "ColumnHeadings");
	
	LoadFooterData(XML);
	LoadColumns(PageLocation, ColumnFooter, "Footer", "ColumnFooters");
}

function LoadFooterData(XML) {
	var $Foot = $(XML).find("tfoot");
	var $Foot = $Foot.find("tr");
	$Content = $Foot.find("cell");
	if ($Content === null) {
		//$Foot = $(XML).find("head");
		$Foot.find("cell").each(function(){
			ColumnFooter.push("NULL");
		});
	} else {
		$Foot.find("cell").each(function() {
			ColumnFooter.push($(this).text()); 
		});
	}
}

function GetUrlVars() {
	var Get = new Array();
	window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(M,Key,Value) {
		Get[Key] = Value;
	});
	return Get;
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
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
var COOKIE = null;
var PageLocation = null;
var HeaderLocation = null;
var PageID = 0;
var FileName = null;

var SessionID = null;

var TableContentTemp = null;
var TableContent = new Array();

var mygrid = null;


var ColumnHeader = new Array();
var ColumnFooter = new Array();

$(document).ready(PageLoad());

//window.onload=setTimeout("LoadRowColumnCount()", 60);
//window.onload=setTimeout("LoadCookieData()", 90);

function PageLoad() {
	mygrid = new dhtmlXGridObject('Grid');
	
	COOKIE = document.cookie.split(';');
	TableContentTemp = COOKIE;
	
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
	
	PageLocation = "../Administrators/PageTypes/TablePage/XmlDHtmlXGridTables.php?TableID=";
	HeaderLocation = "../Administrators/PageTypes/TablePage/XmlDHtmlXGridTables.php?TableID=";
	
	if (GET['TableID'] != null) {
		PageID = GET['TableID'];
	}
	
	if (GET['File'] != null) {
		FileName = GET['File'];
	}
	
	PageLocation = PageLocation + PageID;
	HeaderLocation = HeaderLocation + PageID;
	
	CheckFile();
	$.ajax({
		url: HeaderLocation,
		type: "GET", 
		dataType: "xml",
		success: LoadHeaderData
	});
	
	LoadGrid();
}

function CheckFile() {
	if (GET['SessionID'] != null) {
		SessionID = GET['SessionID'];
	}
	if (SessionID != null && GET['TableID'] == null) {
		var FileLocation = '../Administrators/PageTypes/TablePage/TEMPFILES/';
		FileName = SessionID + '.xml';
		FileLocation += FileName;
		PageLocation = FileLocation;
		
		var FileDiv = document.createElement('div');
		var FileInput = document.createElement('input');
		FileInput.setAttribute('type', 'hidden');
		FileInput.setAttribute('name', "File");
		FileInput.setAttribute('value', FileName);
		
		FileDiv.appendChild(FileInput);
		var FormElement = document.getElementsByTagName('form');
		FormElement[0].appendChild(FileDiv);
	} else if (FileName != null) {
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
		FormElement[0].appendChild(FileDiv);
	}
}

function LoadGrid() {
	mygrid.setImagePath("../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandard/codebase/imgs/");
	mygrid.init();
	mygrid.setSkin("dhx_skyblue");
	mygrid.setStyle("", "color: black;");
	
	mygrid.load(PageLocation);
	
	mygrid.submitOnlyChanged(false);
	//mygrid.insertColumn(1000, '&nbsp;', 'cntr', 40, 'na', 'right');
	
	//mygrid.setHeader("&nbsp;");
	//mygrid.setInitWidths("40");
	//mygrid.setColAlign("right");
	//mygrid.setColTypes("cntr");
	//mygrid.setColSorting("na");
	//mygrid.setColumnColor("#CCE2FE");
	//mygrid.init();
	
	//mygrid.splitAt(1);
	
	//mygrid.load(PageLocation);
	
	
	
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
	ColumnCount = ColumnCount - 1;
	
	if (RowCount == 0) {
		alert("Data has not loaded, data may not save properly, please refresh the page!");
	} else {
		RowCount = Number(RowCount) * 100;
		RowCount = Number(RowCount) - 100;
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
		}
	}
}

function LoadColumns(Page, Header, Name, IDName) {
	var i = 1;

	if (Header instanceof Array) {
		for (Index in Header) {
			if (Index == 0) {
				continue;
			}
			
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
			/*var Heading = readCookie(ColumnID);
			if (Heading != null) {
				alert(ColumnValue);
				Input.setAttribute('value', Heading);
			} else {*/
				Input.setAttribute('value', ColumnValue);
			/*}*/
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
		/*var VALUE = readCookie(ColumnID);
		if (readCookie(ColumnID) != null) {
			alert ("Loading More Header and Footer Columns!");
		}
		while (readCookie(ColumnID) != null) {
			CreateColumn(Header, Name, IDName, i);
			var ColumnNumber = mygrid.getColumnsNum();

			if (ColumnNumber != i) {
				ColumnCount = ColumnCount + 1;
				mygrid.insertColumn(ColumnCount, "Column " + ColumnCount, 'ed', '110', 'str'); 
			}
			i++;
			ColumnID = Name + i;
		}*/
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
	
	$('#' + ColumnName).remove();
	$('#' + LabelColumnName).remove();
	
	ShiftColumns(Header, Name, ColumnName, LabelColumnName, Count);
}

function ShiftColumns(Header, Name, ColumnName, LabelColumnName, Count) {
	Count++;
	var NewColumnName = Name + Count;
	var NewLabelName = Name + "Label" + Count;
	while ($('#' + NewColumnName).length) {
		$('#' + ColumnName).attr('id', NewColumnName);
		$('#' + LabelColumnName).attr('id', NewLabelName);
		
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
			var FileName = File.name;
			FileName = FileName.replace("fakepath", "");
			FileName = FileName.replace("C:\\", "");
			FileName = FileName.replace("\\", "");
			//var Url = document.URL + "&File=" + FileName;
			//alert ("You are being redirect to a new Table Content form with your file");
			//window.location = Url;
			alert ("The Table Content Form is being reset with data from your file");
			
			GET['File'] = FileName;
			
			$("#Vault").empty();
			$("#ColumnHeadings").empty();
			$("#ColumnFooters").empty();
			$("#Grid").empty();
			
			RowCount = null;
			ColumnCount = null;
			
			mygrid = null;

			ColumnHeader = new Array();
			ColumnFooter = new Array();
			//$("[id^='Image']").remove();
			//EnablePriorAddContentButton(1);
			
			// Replace Header Legend
			var HeaderLegend = document.createElement('legend');
			HeaderLegend.setAttribute('class', 'BodyHeading');
			HeaderLegend.setAttribute('dir', "ltr");
			HeaderLegend.setAttribute('lang', "en-us");
			HeaderLegend.setAttribute('xml:lang', "en-us");
			HeaderLegend.innerHTML = "Column Headings";
			
			document.getElementById("ColumnHeadings").appendChild(HeaderLegend);
			
			// Replace Footer Legend
			var FooterLegend = document.createElement('legend');
			FooterLegend.setAttribute('class', 'BodyHeading');
			FooterLegend.setAttribute('dir', "ltr");
			FooterLegend.setAttribute('lang', "en-us");
			FooterLegend.setAttribute('xml:lang', "en-us");
			FooterLegend.innerHTML = "Column Footers";
			
			document.getElementById("ColumnFooters").appendChild(FooterLegend);
			
			// Reload Javascript Commands
			PageLoad();
			
		};
	Vault.create("Vault");
}

function AddOneRow() {
	//alert("TEST");
	//alert(RowCount);
	var Id = mygrid.getSelectedId();
	//alert(Id);
	if (Id == 1) {
		alert("Currently you cannot add to the first row, this will be implemented in the future!");
		// PUT IN CODE TO ADD TO THE FIRST ROW OF THE TABLE!
		/*var LastRowID;
		var NewRow;
		var OldRow;
		
		mygrid.forEachRow(function(id) {
			LastRowID = id;
		});
		
		/*alert (LastRowID);
		
		for(var i = LastRowID; i >= 0 ; i = i - 100) {
			//alert(i);
			var id = i;
			if (id == 0) {
				OldRow = 1;
				NewRow = 100;
			} else {
				OldRow = id;
				NewRow = id + 100;
			}
			
			var TempValue = mygrid.cells(OldRow,0).getValue();
			TempValue = Number(TempValue);
			TempValue = TempValue + 1;
			mygrid.cells(OldRow,0).setValue(TempValue);
			//alert("TEMP VALUE = " + TempValue);
			//alert(mygrid.cells(OldRow,0).getValue());
			mygrid.changeRowId(OldRow, NewRow);
		}*/
		
		/*mygrid.forEachRow(function(id) {
			var TempValue = mygrid.cells(id,0).getValue();
			//TempValue = Number(TempValue);
			//TempValue = TempValue + 1;
			//mygrid.cells(id,0).setValue(TempValue);
		});
		alert ("DONE");
		/*mygrid.forEachRow(function(id) {
			alert(id);
			if (id == 1) {
				alert(id);
				OldRow = id;
				NewRow = 100;
			} else {
				OldRow = id;
				NewRow = id + 100;
			}
			
			var TempValue = mygrid.cells(OldRow,0).getValue();
			TempValue = TempValue + 1;
			mygrid.cells(OldRow,0).setValue(TempValue);
			mygrid.changeRowId(OldRow, NewRow);
			
			/*if (id > Id) {
				OldRow = id;
				NewRow = id - 100;
				
				var TempValue = mygrid.cells(OldRow,0).getValue();
				TempValue = TempValue - 1;
				mygrid.cells(OldRow,0).setValue(TempValue);
				mygrid.changeRowId(OldRow, NewRow);
			}*/
		//});
		
		/*if (Id == 1) {
			alert(id);
			OldRow = id;
			NewRow = 100;
		} else {
			OldRow = id;
			NewRow = id + 100;
		}*/
		
		//mygrid.addRow(Id, "1");
		//alert ("CHANGED");
		//mygrid.forEachRow(function(id) {
			//alert(id);   
		//});
		
		//RowCount = RowCount + 100;
	} else {
		var OldRowCount;
		var MaxColumn = 100;
		
		RowCount = +RowCount + MaxColumn;
		
		if (Id != null) {
			var NewRow;
			var OldRow;
			NewRow = RowCount -0;
			OldRow = RowCount - MaxColumn;
			
			for(var i = 0; NewRow != Id; i++) {
				var TempValue = mygrid.cells(OldRow,0).getValue();
				TempValue = TempValue + 1;
				mygrid.cells(OldRow,0).setValue(TempValue);
				mygrid.changeRowId(OldRow, NewRow);
				
				NewRow = NewRow - MaxColumn;
				OldRow = OldRow - MaxColumn;
			}
			
			var RowPosition;
			RowPosition = null;
			
			RowPosition = Id / MaxColumn;
			
			mygrid.addRow(Id, "10", RowPosition);
		} else {
			mygrid.addRow(RowCount, "");
		}
	}
	
}

function DeleteCurrentRows() {
	//mygrid.deleteSelectedRows();
	RowCount = +RowCount - 100;

	var Id = mygrid.getSelectedId();
	mygrid.deleteRow(Id);
	
	var NewRow;
	var OldRow;
	
	mygrid.forEachRow(function(id) {
		if (id > Id) {
			OldRow = id;
			NewRow = id - 100;
			
			var TempValue = mygrid.cells(OldRow,0).getValue();
			TempValue = TempValue - 1;
			mygrid.cells(OldRow,0).setValue(TempValue);
			mygrid.changeRowId(OldRow, NewRow);
		}
	});
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
	mygrid.deleteColumn(Id);
	
	var ElementRemove = Id;
	
	ColumnHeader.splice(Id, 1);
	ColumnFooter.splice(Id, 1);
	
	RemoveColumn(ColumnHeader, "Header", "ColumnHeadings", ElementRemove);
	RemoveColumn(ColumnFooter, "Footer", "ColumnFooters", ElementRemove);
}

function LoadHeaderData(XML) {
	var $Head = $(XML).find("head");
	$Head.find("column").each(function(){
		ColumnHeader.push($(this).text());
	});
	
	LoadColumns(HeaderLocation, ColumnHeader, "Header", "ColumnHeadings");
	
	LoadFooterData(XML);
	LoadColumns(HeaderLocation, ColumnFooter, "Footer", "ColumnFooters");
}

function LoadFooterData(XML) {
	var $Foot = $(XML).find("tfoot");
	var $Foot = $Foot.find("tr");
	
	var temp = false;
	
	
	$Foot.find("cell").each(function() {
		temp = true;
		ColumnFooter.push($(this).text()); 
	});
	
	if (temp === false) {
		var $Head = $(XML).find("head");
		$Head.find("column").each(function(){
			ColumnFooter.push("NULL");
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

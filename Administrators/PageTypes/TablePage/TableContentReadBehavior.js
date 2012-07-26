var GET = GetUrlVars();

var PageLocation = "../Administrators/PageTypes/TablePage/XmlDHtmlXGridTables.php?TableID=";
var PageID = 0;

if (GET['TableID'] != null) {
	PageID = GET['TableID'];
}

PageLocation = PageLocation + PageID;

mygrid = new dhtmlXGridObject('Grid');

mygrid.setImagePath("../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandard/dhtmlxGrid/codebase/imgs/");
mygrid.init();
mygrid.setSkin("dhx_skyblue");
mygrid.setStyle("", "color: black;");
mygrid.loadXML(PageLocation);
mygrid.setEditable(false);

function GetUrlVars() {
	var Get = new Array();
	window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(M,Key,Value) {
		Get[Key] = Value;
	});
	return Get;
}


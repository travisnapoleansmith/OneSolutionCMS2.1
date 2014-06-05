var StatsReportsTabbar = null;

function afterLoad() {
	dhtmlx.image_path='../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/';
	
	var StatsReports = new dhtmlXLayoutObject("Content", "1C");
	StatsReports.cells("a").setText("Stats/Reports");
	StatsReports.cells("a").showHeader();
	
	var StatsReportsHeight = StatsReports.cells("a").getHeight();
	StatsReportsHeight = StatsReportsHeight + 15;
	StatsReports.cells("a").setHeight(StatsReportsHeight);
	StatsReportsHeight = StatsReportsHeight - 15;
	var StatsReportsDiv = document.getElementById("Content");
	StatsReportsDiv.style.height = StatsReportsHeight + "px";
	
	StatsReportsTabbar = StatsReports.cells("a").attachTabbar();
	
	StatsReportsTabbar.setAlign("left");
	
	StatsReportsTabbar.addTab('SiteStats','Site Stats','');
	//StatsReportsTabbar.addTab('AdStats','Ad Stats','');
	
	var Tabs = StatsReportsTabbar.getAllTabs();
	
	/*var FunctionCall = null;
	$.each(Tabs, function() {
		FunctionCall = 'Load' + this + '()';
		//window[FunctionCall]();
		eval(FunctionCall);
		//alert(FunctionCall);		  
	});*/
	LoadSiteStats();
	//LoadAdStats();
	
	//alert(Tabs);
}
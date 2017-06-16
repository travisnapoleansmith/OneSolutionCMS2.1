function LoadSiteStats() {
	//StatsReportsTabbar.addTab('SiteStats','Site Stats','');
	var SiteStats = StatsReportsTabbar.cells('SiteStats');
	StatsReportsTabbar.tabs('SiteStats').setActive();
	
	var SiteStatsType = SiteStats.attachTabbar();
	SiteStatsType.setArrowsMode("auto");
	
	SiteStatsType.setAlign('right');
	
	// Site Stats Range
	SiteStatsType.addTab('SiteStatsRange','Range','135');
	var SiteStatsRange = SiteStatsType.cells('SiteStatsRange');
	SiteStatsType.tabs('SiteStatsRange').setActive();
	var SiteStatsRangeLayout = SiteStatsRange.attachLayout('3E');

	var SiteStatsRangeForm = SiteStatsRangeLayout.cells('a');
	SiteStatsRangeForm.setText('Form');
	SiteStatsRangeForm.setHeight('40');
	SiteStatsRangeForm.hideHeader();
	var FormData = [
		{ type:"calendar" , name:"SiteStatsRangeForm1CalendarStartDate", label:"Choose Start Date", dateFormat:"%d-%m-%Y", readonly:true, enableTime: false, labelWidth:125, options:{
			
		}, labelLeft:5, labelTop:5, inputLeft:125, inputTop:5, position:"absolute"  },
		{ type:"calendar" , name:"SiteStatsRangeForm1CalendarEndDate", label:"Choose End Date", dateFormat:"%d-%m-%Y", readonly:true, enableTime: false, labelWidth:100, labelAlign:"left", options:{
			
		}, labelLeft:300, labelTop:5, inputLeft:400, inputTop:5, position:"absolute"  },
		{ type:"button" , name:"SiteStatsRangeForm1Button1", value:"Submit", inputLeft:600, inputTop:5, position:"absolute"  }
	];
	
	var SiteStatsRangeForm1 = SiteStatsRangeForm.attachForm(FormData);
	
	var StartDateCalendar = SiteStatsRangeForm1.getCalendar("SiteStatsRangeForm1CalendarStartDate");
	var EndDateCalendar = SiteStatsRangeForm1.getCalendar("SiteStatsRangeForm1CalendarEndDate");
	StartDateCalendar.setSensitiveRange("01-01-2014", null);
	EndDateCalendar.setSensitiveRange("01-01-2014", null);
	
	var SiteStatsRangeChart = SiteStatsRangeLayout.cells('b');
	SiteStatsRangeChart.setText('Charts');
	SiteStatsRangeChart.setHeight('300');
	//SiteStatsRangeChart.hideHeader();
	SiteStatsRangeLayout.cells('b').setCollapsedText('Charts');
	
	var SiteStatsRangeChartLayout = SiteStatsRangeChart.attachLayout('2U');

	var SiteStatsRangeChartLayoutChart1 = SiteStatsRangeChartLayout.cells('a');
	SiteStatsRangeChartLayoutChart1.setText('Top 10 Page Views - Human Views / Total Views');
	SiteStatsRangeChartLayout.cells('a').setCollapsedText('Top 10 Page Views - Human Views / Total Views');
	SiteStatsRangeChartLayoutChart1.setWidth('800');
	var SiteStatsRangeChart1 = SiteStatsRangeChartLayoutChart1.attachChart({
		view: 'bar' ,
		label:'#HumanViews#',
		tooltip:{
			template:'Human Hits - #PageName#'
		},
		legend:{"template":"#PageName#",width:190, "marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#HumanViews#'
	});
	
	SiteStatsRangeChart1.addSeries( {
		label:'#TotalViews#',
		value:'#TotalViews#',
		tooltip:{
			template:'Total Views - #PageName#'
		}
	});

	var SiteStatsRangeChartLayoutChart2 = SiteStatsRangeChartLayout.cells('b');
	SiteStatsRangeChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
	SiteStatsRangeChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
	
	var SiteStatsRangeChart2 = SiteStatsRangeChartLayoutChart2.attachChart({
		view: 'pie' ,
		label:'#Percentage#',
		tooltip:{
			template:'#Browsers#'
		},
		legend:{"template":"#Browsers#","marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		xAxis:{"template":"#Browsers#","step":"1"},
		yAxis:{"start":"0","end":"100","step":"1"},
		value:'#Percentage#'
	});

	SiteStatsRangeLayout.cells("b").showHeader();
	
	var SiteStatsRangeData = SiteStatsRangeLayout.cells('c');
	SiteStatsRangeData.setText('Page Views');
	SiteStatsRangeLayout.cells('c').setCollapsedText('Page Views');
	
	var SiteStatsRangeToolbar1Export = SiteStatsRangeData.attachToolbar();
	SiteStatsRangeToolbar1Export.setIconSize(24);
	SiteStatsRangeToolbar1Export.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	//SiteStatsRangeToolbar1Export.loadStruct('SampleData/toolbarExport.xml');
	SiteStatsRangeToolbar1Export.loadStruct('../../AJAX/Managers/StatsManager/ToolbarExport.php');
	
	var SiteStatsRangeTabbar1 = SiteStatsRangeData.attachTabbar();
	SiteStatsRangeTabbar1.setArrowsMode("auto");
	
	SiteStatsRangeLayout.cells("c").showHeader();
	
	// TAB 1
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeOverallStats','Overall','135');
	var SiteStatsRangeOverallStats = SiteStatsRangeTabbar1.cells('SiteStatsRangeOverallStats');
	SiteStatsRangeTabbar1.tabs('SiteStatsRangeOverallStats').setActive();
	var SiteStatsRangeOverallStatsGrid1 = SiteStatsRangeOverallStats.attachGrid();
	SiteStatsRangeOverallStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');

	SiteStatsRangeOverallStatsGrid1.init();
	
	SiteStatsRangeOverallStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 2
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeBrowserStats','Browsers','135');
	var SiteStatsRangeBrowserStats = SiteStatsRangeTabbar1.cells('SiteStatsRangeBrowserStats');
	var SiteStatsRangeBrowserStatsGrid1 = SiteStatsRangeBrowserStats.attachGrid();
	SiteStatsRangeBrowserStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');

	SiteStatsRangeBrowserStatsGrid1.init();
	
	SiteStatsRangeBrowserStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 3
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeBrowsersVersions','Browsers Versions','135');
	var SiteStatsRangeBrowsersVersions = SiteStatsRangeTabbar1.cells('SiteStatsRangeBrowsersVersions');
	var SiteStatsRangeBrowserVersionsStatsGrid1 = SiteStatsRangeBrowsersVersions.attachGrid();
	SiteStatsRangeBrowserVersionsStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
		
	SiteStatsRangeBrowserVersionsStatsGrid1.init();
	
	SiteStatsRangeBrowserVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 4
	SiteStatsRangeTabbar1.addTab('SiteStatsRangePluginStats','Plugins','135');
	var SiteStatsRangePluginStats = SiteStatsRangeTabbar1.cells('SiteStatsRangePluginStats');
	var SiteStatsRangePluginStatsGrid1 = SiteStatsRangePluginStats.attachGrid();
	SiteStatsRangePluginStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsRangePluginStatsGrid1.init();
	
	SiteStatsRangePluginStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 5
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeOperatingSystems','OS\'s','135');
	var SiteStatsRangeOperatingSystems = SiteStatsRangeTabbar1.cells('SiteStatsRangeOperatingSystems');
	var SiteStatsRangeOperatingSystemsStatsGrid1 = SiteStatsRangeOperatingSystems.attachGrid();
	SiteStatsRangeOperatingSystemsStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsRangeOperatingSystemsStatsGrid1.init();
	
	SiteStatsRangeOperatingSystemsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 6
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeOperatingSystemsVersions','OS Versions','135');
	var SiteStatsRangeOperatingSystemsVersions = SiteStatsRangeTabbar1.cells('SiteStatsRangeOperatingSystemsVersions');
	var SiteStatsRangeOperatingSystemsVersionsStatsGrid1 = SiteStatsRangeOperatingSystemsVersions.attachGrid();
	SiteStatsRangeOperatingSystemsVersionsStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsRangeOperatingSystemsVersionsStatsGrid1.init();
	
	SiteStatsRangeOperatingSystemsVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 7
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeLanguages','Languages','135');
	var SiteStatsRangeLanguages = SiteStatsRangeTabbar1.cells('SiteStatsRangeLanguages');
	var SiteStatsRangeLanguagesStatsGrid1 = SiteStatsRangeLanguages.attachGrid();
	SiteStatsRangeLanguagesStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
		
	SiteStatsRangeLanguagesStatsGrid1.init();
	
	SiteStatsRangeLanguagesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 8
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeCountries','Countries','135');
	var SiteStatsRangeCountries = SiteStatsRangeTabbar1.cells('SiteStatsRangeCountries');
	var SiteStatsRangeCountriesStatsGrid1 = SiteStatsRangeCountries.attachGrid();
	SiteStatsRangeCountriesStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsRangeCountriesStatsGrid1.init();
	
	SiteStatsRangeCountriesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 9
	SiteStatsRangeTabbar1.addTab('SiteStatsRangeIPAddresses','IP Addresses','135');
	var SiteStatsRangeIPAddresses = SiteStatsRangeTabbar1.cells('SiteStatsRangeIPAddresses');
	var SiteStatsRangeIPAddressesStatsGrid1 = SiteStatsRangeIPAddresses.attachGrid();
	SiteStatsRangeIPAddressesStatsGrid1.setIconsPath('../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsRangeIPAddressesStatsGrid1.init();
	
	SiteStatsRangeIPAddressesStatsGrid1.enableSmartRendering(true, 100);
	
	//var SiteStatsRangeOverallStatsDP = null;
	
	// All Event Handlers For Site Stats Range
	// Form
	SiteStatsRangeForm1.attachEvent("onButtonClick", function (ItemID) {
		var StartDate = SiteStatsRangeForm1.getItemValue('SiteStatsRangeForm1CalendarStartDate', true);
		//alert ("You're Start Date is " + StartDate);
		var EndDate = SiteStatsRangeForm1.getItemValue('SiteStatsRangeForm1CalendarEndDate', true);
		//alert ("You're End Date is " + EndDate);
		
		//refresh_chart();
		
		if (StartDate != '' && EndDate != '') {
			var TabbarID = SiteStatsRangeTabbar1.getActiveTab();
			var TabbarText = SiteStatsRangeTabbar1.tabs(TabbarID).getText();
			
			var Field = TabbarText.replace(' ', '');
			var FieldName = Field.replace("'", '');
			
			// All Grids
			SiteStatsRangeOverallStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangeBrowserStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangeBrowserVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangePluginStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangeOperatingSystemsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangeOperatingSystemsVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangeLanguagesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangeCountriesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			SiteStatsRangeIPAddressesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML', 'xml');
			
			//SiteStatsRangeOverallStatsDP = new dataProcessor('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Range&Range=' + StartDate + ':' + EndDate, 'xml');

			//SiteStatsRangeOverallStatsDP.init(SiteStatsRangeOverallStatsGrid1);
			//SiteStatsRangeOverallStatsDP.setTransactionMode("POST", false);
			
			// All Charts
			SiteStatsRangeChart1.load('../../AJAX/Managers/StatsManager/ChartsTop10.php?Type=SiteStats&RangeType=Range&Range=' + StartDate + ':' + EndDate, 'xml');
			
			var SiteStatsRangeChart2 = SiteStatsRangeChartLayoutChart2.attachChart({
				view: 'pie' ,
				label:'#Percentage#',
				tooltip:{
					template:'#' + FieldName + '#'
				},
				legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
				gradient: false,
				xAxis:{"template":'#' + FieldName + '#',"step":"1"},
				yAxis:{"start":"0","end":"100","step":"1"},
				value:'#Percentage#'
			});
	
			SiteStatsRangeChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Range&Range=' + StartDate + ':' + EndDate, 'xml');
			
		} else {
			// All Grids
			SiteStatsRangeOverallStatsGrid1.clearAll(true);
			SiteStatsRangeBrowserStatsGrid1.clearAll(true);
			SiteStatsRangeBrowserVersionsStatsGrid1.clearAll(true);
			SiteStatsRangePluginStatsGrid1.clearAll(true);
			SiteStatsRangeOperatingSystemsStatsGrid1.clearAll(true);
			SiteStatsRangeOperatingSystemsVersionsStatsGrid1.clearAll(true);
			SiteStatsRangeLanguagesStatsGrid1.clearAll(true);
			SiteStatsRangeCountriesStatsGrid1.clearAll(true);
			SiteStatsRangeIPAddressesStatsGrid1.clearAll(true);
			
			// All Charts
			SiteStatsRangeChart1.clearAll();
			SiteStatsRangeChart2.clearAll();
		}
		
		if (StartDate == '' || EndDate == '') {
			alert ("Both a start date and end date need to be selected!");
		}
	});
	
	// Toolbar
	SiteStatsRangeToolbar1Export.attachEvent("onClick", function(ItemID) {
		var ButtonName = SiteStatsRangeToolbar1Export.getItemText(ItemID);
		var TabbarID = SiteStatsRangeTabbar1.getActiveTab();
		var StartDate = SiteStatsRangeForm1.getItemValue('SiteStatsRangeForm1CalendarStartDate', true);
		var EndDate = SiteStatsRangeForm1.getItemValue('SiteStatsRangeForm1CalendarEndDate', true);
		
		switch(TabbarID) {
			case 'SiteStatsRangeOverallStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangeBrowserStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangeBrowsersVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangePluginStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangeOperatingSystems':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangeOperatingSystemsVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangeLanguages':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangeCountries':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsRangeIPAddresses':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Range&Range=' + StartDate + ':' + EndDate + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
		}
		//alert("You Click On " + ButtonName + ' Tabbar ID = ' + TabbarID );
	});
	
	// Tabbar
	SiteStatsRangeTabbar1.attachEvent("onTabClick", function (CurrentID, LastID) {
		var Text = SiteStatsRangeTabbar1.tabs(CurrentID).getText();
		
		var StartDate = SiteStatsRangeForm1.getItemValue('SiteStatsRangeForm1CalendarStartDate', true);
		var EndDate = SiteStatsRangeForm1.getItemValue('SiteStatsRangeForm1CalendarEndDate', true);
		
		if (Text == "IP Addresses") {
			SiteStatsRangeChartLayoutChart2.setText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
			SiteStatsRangeChartLayout.cells('b').setCollapsedText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
		} else if (Text == "Overall") {
			SiteStatsRangeChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
			SiteStatsRangeChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
		} else {
			SiteStatsRangeChartLayoutChart2.setText('Overall ' + Text + ' - % Of Traffic');
			SiteStatsRangeChartLayout.cells('b').setCollapsedText('Overall ' + Text + ' - % Of Traffic');
		}
		
		var Field = Text.replace(' ', '');
		var FieldName = Field.replace("'", '');
		//Field = Field.replace("'", '');
		
		//var FileName = 'chart' + Field + '.xml';
		
		var SiteStatsRangeChart2 = SiteStatsRangeChartLayoutChart2.attachChart({
			view: 'pie' ,
			label:'#Percentage#',
			tooltip:{
				template:'#' + FieldName + '#'
			},
			legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
			gradient: false,
			xAxis:{"template":'#' + FieldName + '#',"step":"1"},
			yAxis:{"start":"0","end":"100","step":"1"},
			value:'#Percentage#'
		});

		SiteStatsRangeChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Range&Range=' + StartDate + ':' + EndDate, 'xml');
	});
	
	// Site Stats Yearly
	SiteStatsType.addTab('SiteStatsYearly','Yearly','135');
	var SiteStatsYearly = SiteStatsType.cells('SiteStatsYearly');
	var SiteStatsYearlyLayout = SiteStatsYearly.attachLayout('3E');

	var SiteStatsYearlyForm = SiteStatsYearlyLayout.cells('a');
	SiteStatsYearlyForm.setText('Form');
	SiteStatsYearlyForm.setHeight('40');
	SiteStatsYearlyForm.hideHeader();
	SiteStatsYearlyLayout.cells('a').setCollapsedText('Form');
	var FormData = [
		{ type:"select" , name:"SiteStatsYearlyForm1SelectYear", label:"Choose Year", connector:"../../AJAX/Managers/StatsManager/OptionsDates.php?Range=Yearly", labelWidth:125, inputWidth:150, required:true, labelLeft:5, labelTop:5, inputLeft:125, inputTop:5, position:"absolute" },
		{ type:"button" , name:"SiteStatsYearlyForm1Button1", value:"Submit", inputLeft:300, inputTop:5, position:"absolute"  }
	];

	var SiteStatsYearlyForm1 = SiteStatsYearlyForm.attachForm(FormData);

	//SiteStatsYearlyForm1.load('./data/form.xml');

	var SiteStatsYearlyChart = SiteStatsYearlyLayout.cells('b');
	SiteStatsYearlyChart.setText('Charts');
	SiteStatsYearlyChart.setHeight('300');
	SiteStatsYearlyLayout.cells('b').setCollapsedText('Charts');
	var SiteStatsYearlyChartLayout = SiteStatsYearlyChart.attachLayout('2U');

	var SiteStatsYearlyChartLayoutChart1 = SiteStatsYearlyChartLayout.cells('a');
	SiteStatsYearlyChartLayoutChart1.setText('Top 10 Page Views - Human Views / Total Views');
	SiteStatsYearlyChartLayoutChart1.setWidth('800');
	SiteStatsYearlyChartLayout.cells('a').setCollapsedText('Top 10 Page Views - Human Views / Total Views');
	var SiteStatsYearlyChart1 = SiteStatsYearlyChartLayoutChart1.attachChart({
		view: 'bar' ,
		label:'#HumanViews#',
		tooltip:{
			template:'Human Views - #PageName#'
		},
		legend:{"template":"#PageName#",width:190, "marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#HumanViews#'
	});
	
	SiteStatsYearlyChart1.addSeries( {
		label:'#TotalViews#',
		value:'#TotalViews#',
		tooltip:{
			template:'Total Views - #PageName#'
		}
	});

	var SiteStatsYearlyChartLayoutChart2 = SiteStatsYearlyChartLayout.cells('b');
	SiteStatsYearlyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
	SiteStatsYearlyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
	var SiteStatsYearlyChart2 = SiteStatsYearlyChartLayoutChart2.attachChart({
		view: 'pie' ,
		label:'#Percentage#',
		tooltip:{
			template:'#Browsers#'
		},
		legend:{"template":"#Browsers#","marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#Percentage#'
	});
	
	SiteStatsYearlyLayout.cells("b").showHeader();
	
	var SiteStatsYearlyData = SiteStatsYearlyLayout.cells('c');
	SiteStatsYearlyData.setText('Page Views');
	SiteStatsYearlyLayout.cells('c').setCollapsedText('Page Views');
	var SiteStatsYearlyToolbar1Export = SiteStatsYearlyData.attachToolbar();
	SiteStatsYearlyToolbar1Export.setIconSize(24);
	SiteStatsYearlyToolbar1Export.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyToolbar1Export.loadStruct('../../AJAX/Managers/StatsManager/ToolbarExport.php');
	var SiteStatsYearlyTabbar1 = SiteStatsYearlyData.attachTabbar();
	SiteStatsYearlyTabbar1.setArrowsMode("auto");
	
	SiteStatsYearlyLayout.cells("c").showHeader();
	
	// TAB 1
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyOverallStats','Overall','135');
	var SiteStatsYearlyOverallStats = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyOverallStats');
	SiteStatsYearlyTabbar1.tabs('SiteStatsYearlyOverallStats').setActive();
	var SiteStatsYearlyOverallStatsGrid1 = SiteStatsYearlyOverallStats.attachGrid();
	SiteStatsYearlyOverallStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyOverallStatsGrid1.init();
	SiteStatsYearlyOverallStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 2
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyBrowserStats','Browsers','135');
	var SiteStatsYearlyBrowserStats = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyBrowserStats');
	var SiteStatsYearlyBrowserStatsGrid1 = SiteStatsYearlyBrowserStats.attachGrid();
	SiteStatsYearlyBrowserStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyBrowserStatsGrid1.init();
	SiteStatsYearlyBrowserStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 3
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyBrowsersVersions','Browsers Versions','135');
	var SiteStatsYearlyBrowsersVersions = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyBrowsersVersions');
	var SiteStatsYearlyBrowserVersionsStatsGrid1 = SiteStatsYearlyBrowsersVersions.attachGrid();
	SiteStatsYearlyBrowserVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyBrowserVersionsStatsGrid1.init();
	SiteStatsYearlyBrowserVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 4
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyPluginStats','Plugins','135');
	var SiteStatsYearlyPluginStats = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyPluginStats');
	var SiteStatsYearlyPluginStatsGrid1 = SiteStatsYearlyPluginStats.attachGrid();
	SiteStatsYearlyPluginStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyPluginStatsGrid1.init();
	SiteStatsYearlyPluginStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 5
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyOperatingSystems','OS\'s','135');
	var SiteStatsYearlyOperatingSystems = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyOperatingSystems');
	var SiteStatsYearlyOperatingSystemsStatsGrid1 = SiteStatsYearlyOperatingSystems.attachGrid();
	SiteStatsYearlyOperatingSystemsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyOperatingSystemsStatsGrid1.init();
	SiteStatsYearlyOperatingSystemsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 6
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyOperatingSystemsVersions','OS Versions','135');
	var SiteStatsYearlyOperatingSystemsVersions = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyOperatingSystemsVersions');
	var SiteStatsYearlyOperatingSystemsVersionsStatsGrid1 = SiteStatsYearlyOperatingSystemsVersions.attachGrid();
	SiteStatsYearlyOperatingSystemsVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyOperatingSystemsVersionsStatsGrid1.init();
	SiteStatsYearlyOperatingSystemsVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 7
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyLanguages','Languages','135');
	var SiteStatsYearlyLanguages = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyLanguages');
	var SiteStatsYearlyLanguagesStatsGrid1 = SiteStatsYearlyLanguages.attachGrid();
	SiteStatsYearlyLanguagesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyLanguagesStatsGrid1.init();
	SiteStatsYearlyLanguagesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 8
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyCountries','Countries','135');
	var SiteStatsYearlyCountries = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyCountries');
	var SiteStatsYearlyCountriesStatsGrid1 = SiteStatsYearlyCountries.attachGrid();
	SiteStatsYearlyCountriesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyCountriesStatsGrid1.init();
	SiteStatsYearlyCountriesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 9
	SiteStatsYearlyTabbar1.addTab('SiteStatsYearlyIPAddresses','IP Addresses','135');
	var SiteStatsYearlyIPAddresses = SiteStatsYearlyTabbar1.cells('SiteStatsYearlyIPAddresses');
	var SiteStatsYearlyIPAddressesStatsGrid1 = SiteStatsYearlyIPAddresses.attachGrid();
	SiteStatsYearlyIPAddressesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsYearlyIPAddressesStatsGrid1.init();
	SiteStatsYearlyIPAddressesStatsGrid1.enableSmartRendering(true, 100);
	
	// All Event Handlers For Site Stats Yearly
	// Form
	SiteStatsYearlyForm1.attachEvent("onButtonClick", function (ItemID) {
		var CurrentYear = SiteStatsYearlyForm1.getItemValue('SiteStatsYearlyForm1SelectYear', true);
		//alert ("You're Year is " + CurrentYear);
		if (CurrentYear != '') {
			var TabbarID = SiteStatsYearlyTabbar1.getActiveTab();
			var TabbarText = SiteStatsYearlyTabbar1.tabs(TabbarID).getText();
			var Field = TabbarText.replace(' ', '');
			var FieldName = Field.replace("'", '');
			
			// All Grids
			SiteStatsYearlyOverallStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyBrowserStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyBrowserVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyPluginStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyOperatingSystemsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyOperatingSystemsVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyLanguagesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyCountriesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			SiteStatsYearlyIPAddressesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML', 'xml');
			
			// All Charts
			SiteStatsYearlyChart1.load('../../AJAX/Managers/StatsManager/ChartsTop10.php?Type=SiteStats&RangeType=Yearly&Range=' + CurrentYear, 'xml');
			//SiteStatsYearlyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + TabbarText +'&RangeType=Yearly&Range=' + CurrentYear, 'xml');
			
			SiteStatsYearlyChart2 = SiteStatsYearlyChartLayoutChart2.attachChart({
				view: 'pie' ,
				label:'#Percentage#',
				tooltip:{
					template:'#' + FieldName + '#'
				},
				legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
				gradient: false,
				xAxis:{"template":'#' + FieldName + '#',"step":"1"},
				yAxis:{"start":"0","end":"100","step":"1"},
				value:'#Percentage#'
			});
			
			SiteStatsYearlyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Yearly&Range=' + CurrentYear, 'xml');
			
		} else {
			// All Grids
			SiteStatsYearlyOverallStatsGrid1.clearAll(true);
			SiteStatsYearlyBrowserStatsGrid1.clearAll(true);
			SiteStatsYearlyBrowserVersionsStatsGrid1.clearAll(true);
			SiteStatsYearlyPluginStatsGrid1.clearAll(true);
			SiteStatsYearlyOperatingSystemsStatsGrid1.clearAll(true);
			SiteStatsYearlyOperatingSystemsVersionsStatsGrid1.clearAll(true);
			SiteStatsYearlyLanguagesStatsGrid1.clearAll(true);
			SiteStatsYearlyCountriesStatsGrid1.clearAll(true);
			SiteStatsYearlyIPAddressesStatsGrid1.clearAll(true);
			
			// All Charts
			SiteStatsYearlyChart1.clearAll();
			SiteStatsYearlyChart2.clearAll();
		}
	});
	
	SiteStatsYearlyBrowserStatsGrid1.attachEvent("onXLE", function (GridObject, Count) {
		//alert('Browsers Has Finished Loading!');
	});
	
	// Toolbar
	SiteStatsYearlyToolbar1Export.attachEvent("onClick", function(ItemID) {
		var ButtonName = SiteStatsYearlyToolbar1Export.getItemText(ItemID);
		var TabbarID = SiteStatsYearlyTabbar1.getActiveTab();
		var CurrentYear = SiteStatsYearlyForm1.getItemValue('SiteStatsYearlyForm1SelectYear', true);
		
		switch(TabbarID) {
			case 'SiteStatsYearlyOverallStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyBrowserStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyBrowsersVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyPluginStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyOperatingSystems':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyOperatingSystemsVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyLanguages':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyCountries':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsYearlyIPAddresses':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Yearly&Range=' + CurrentYear + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
		}
		//alert("You Click On " + ButtonName + ' Tabbar ID = ' + TabbarID );
	});
	
	// Tabbar
	SiteStatsYearlyTabbar1.attachEvent("onTabClick", function (CurrentID, LastID) {
		var Text = SiteStatsYearlyTabbar1.tabs(CurrentID).getText();
		var CurrentYear = SiteStatsYearlyForm1.getItemValue('SiteStatsYearlyForm1SelectYear', true);
		
		if (Text == "IP Addresses") {
			SiteStatsYearlyChartLayoutChart2.setText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
			SiteStatsYearlyChartLayout.cells('b').setCollapsedText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
		} else if (Text == "Overall") {
			SiteStatsYearlyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
			SiteStatsYearlyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
		} else {
			SiteStatsYearlyChartLayoutChart2.setText('Overall ' + Text + ' - % Of Traffic');
			SiteStatsYearlyChartLayout.cells('b').setCollapsedText('Overall ' + Text + ' - % Of Traffic');
		}
		
		var Field = Text.replace(' ', '');
		var FieldName = Field.replace("'", '');
		//Field = Field.replace("'", '');
		
		//var FileName = 'chart' + Field + '.xml';
		
		SiteStatsYearlyChart2 = SiteStatsYearlyChartLayoutChart2.attachChart({
			view: 'pie' ,
			label:'#Percentage#',
			tooltip:{
				template:'#' + FieldName + '#'
			},
			legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
			gradient: false,
			xAxis:{"template":'#' + FieldName + '#',"step":"1"},
			yAxis:{"start":"0","end":"100","step":"1"},
			value:'#Percentage#'
		});
		
		SiteStatsYearlyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Yearly&Range=' + CurrentYear, 'xml');
		//SiteStatsYearlyChart2.load('SampleData/' + FileName, 'xml');
		
	});
	
	
	// Site Stats Monthly
	SiteStatsType.addTab('SiteStatsMonthly','Monthly','135');
	var SiteStatsMonthly = SiteStatsType.cells('SiteStatsMonthly');
	var SiteStatsMonthlyLayout = SiteStatsMonthly.attachLayout('3E');

	var SiteStatsMonthlyForm = SiteStatsMonthlyLayout.cells('a');
	SiteStatsMonthlyForm.setText('Form');
	SiteStatsMonthlyForm.setHeight('40');
	SiteStatsMonthlyForm.hideHeader();
	SiteStatsMonthlyLayout.cells('a').setCollapsedText('Form');
	var FormData = [
		{ type:"select" , name:"SiteStatsMonthlyForm1SelectMonth", label:"Choose Month", connector:"../../AJAX/Managers/StatsManager/OptionsDates.php?Range=Monthly", labelWidth:125, inputWidth:150, required:true, labelLeft:5, labelTop:5, inputLeft:125, inputTop:5, position:"absolute" },
		{ type:"button" , name:"SiteStatsMonthlyForm1Button1", value:"Submit", inputLeft:300, inputTop:5, position:"absolute"  }
	];

	var SiteStatsMonthlyForm1 = SiteStatsMonthlyForm.attachForm(FormData);

	//SiteStatsMonthlyForm1.load('./data/form.xml');

	var SiteStatsMonthlyChart = SiteStatsMonthlyLayout.cells('b');
	SiteStatsMonthlyChart.setText('Charts');
	SiteStatsMonthlyChart.setHeight('300');
	SiteStatsMonthlyLayout.cells('b').setCollapsedText('Charts');
	var SiteStatsMonthlyChartLayout = SiteStatsMonthlyChart.attachLayout('2U');

	var SiteStatsMonthlyChartLayoutChart1 = SiteStatsMonthlyChartLayout.cells('a');
	SiteStatsMonthlyChartLayoutChart1.setText('Top 10 Page Views - Human Views / Total Views');
	SiteStatsMonthlyChartLayoutChart1.setWidth('800');
	SiteStatsMonthlyChartLayout.cells('a').setCollapsedText('Top 10 Page Views - Human Views / Total Views');
	var SiteStatsMonthlyChart1 = SiteStatsMonthlyChartLayoutChart1.attachChart({
		view: 'bar' ,
		label:'#HumanViews#',
		tooltip:{
			template:'Human Views - #PageName#'
		},
		legend:{"template":"#PageName#",width:190, "marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#HumanViews#'
	});
	
	SiteStatsMonthlyChart1.addSeries( {
		label:'#TotalViews#',
		value:'#TotalViews#',
		tooltip:{
			template:'Total Views - #PageName#'
		}
	});

	var SiteStatsMonthlyChartLayoutChart2 = SiteStatsMonthlyChartLayout.cells('b');
	SiteStatsMonthlyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
	SiteStatsMonthlyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
	var SiteStatsMonthlyChart2 = SiteStatsMonthlyChartLayoutChart2.attachChart({
		view: 'pie' ,
		label:'#Percentage#',
		tooltip:{
			template:'#Browsers#'
		},
		legend:{"template":"#Browsers#","marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#Percentage#'
	});
	
	SiteStatsMonthlyLayout.cells("b").showHeader();
	
	var SiteStatsMonthlyData = SiteStatsMonthlyLayout.cells('c');
	SiteStatsMonthlyData.setText('Page Views');
	SiteStatsMonthlyLayout.cells('c').setCollapsedText('Page Views');
	var SiteStatsMonthlyToolbar1Export = SiteStatsMonthlyData.attachToolbar();
	SiteStatsMonthlyToolbar1Export.setIconSize(24);
	SiteStatsMonthlyToolbar1Export.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyToolbar1Export.loadStruct('../../AJAX/Managers/StatsManager/ToolbarExport.php');
	
	var SiteStatsMonthlyTabbar1 = SiteStatsMonthlyData.attachTabbar();
	SiteStatsMonthlyTabbar1.setArrowsMode("auto");
	
	SiteStatsMonthlyLayout.cells("c").showHeader();
	
	// TAB 1
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyOverallStats','Overall','135');
	var SiteStatsMonthlyOverallStats = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyOverallStats');
	SiteStatsMonthlyTabbar1.tabs('SiteStatsMonthlyOverallStats').setActive();
	var SiteStatsMonthlyOverallStatsGrid1 = SiteStatsMonthlyOverallStats.attachGrid();
	SiteStatsMonthlyOverallStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyOverallStatsGrid1.init();
	
	SiteStatsMonthlyOverallStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 2
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyBrowserStats','Browsers','135');
	var SiteStatsMonthlyBrowserStats = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyBrowserStats');
	var SiteStatsMonthlyBrowserStatsGrid1 = SiteStatsMonthlyBrowserStats.attachGrid();
	SiteStatsMonthlyBrowserStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyBrowserStatsGrid1.init();
	
	SiteStatsMonthlyBrowserStatsGrid1.enableSmartRendering(true, 100);

	// TAB 3
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyBrowsersVersions','Browsers Versions','135');
	var SiteStatsMonthlyBrowsersVersions = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyBrowsersVersions');
	var SiteStatsMonthlyBrowserVersionsStatsGrid1 = SiteStatsMonthlyBrowsersVersions.attachGrid();
	SiteStatsMonthlyBrowserVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyBrowserVersionsStatsGrid1.init();
	
	SiteStatsMonthlyBrowserVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 4
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyPluginStats','Plugins','135');
	var SiteStatsMonthlyPluginStats = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyPluginStats');
	var SiteStatsMonthlyPluginStatsGrid1 = SiteStatsMonthlyPluginStats.attachGrid();
	SiteStatsMonthlyPluginStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyPluginStatsGrid1.init();
	
	SiteStatsMonthlyPluginStatsGrid1.enableSmartRendering(true, 100);

	// TAB 5
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyOperatingSystems','OS\'s','135');
	var SiteStatsMonthlyOperatingSystems = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyOperatingSystems');
	var SiteStatsMonthlyOperatingSystemsStatsGrid1 = SiteStatsMonthlyOperatingSystems.attachGrid();
	SiteStatsMonthlyOperatingSystemsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyOperatingSystemsStatsGrid1.init();
	
	SiteStatsMonthlyOperatingSystemsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 6
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyOperatingSystemsVersions','OS Versions','135');
	var SiteStatsMonthlyOperatingSystemsVersions = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyOperatingSystemsVersions');
	var SiteStatsMonthlyOperatingSystemsVersionsStatsGrid1 = SiteStatsMonthlyOperatingSystemsVersions.attachGrid();
	SiteStatsMonthlyOperatingSystemsVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyOperatingSystemsVersionsStatsGrid1.init();
	
	SiteStatsMonthlyOperatingSystemsVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 7
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyLanguages','Languages','135');
	var SiteStatsMonthlyLanguages = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyLanguages');
	var SiteStatsMonthlyLanguagesStatsGrid1 = SiteStatsMonthlyLanguages.attachGrid();
	SiteStatsMonthlyLanguagesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyLanguagesStatsGrid1.init();
	
	SiteStatsMonthlyLanguagesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 8
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyCountries','Countries','135');
	var SiteStatsMonthlyCountries = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyCountries');
	var SiteStatsMonthlyCountriesStatsGrid1 = SiteStatsMonthlyCountries.attachGrid();
	SiteStatsMonthlyCountriesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyCountriesStatsGrid1.init();
	
	SiteStatsMonthlyCountriesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 9
	SiteStatsMonthlyTabbar1.addTab('SiteStatsMonthlyIPAddresses','IP Addresses','135');
	var SiteStatsMonthlyIPAddresses = SiteStatsMonthlyTabbar1.cells('SiteStatsMonthlyIPAddresses');
	var SiteStatsMonthlyIPAddressesStatsGrid1 = SiteStatsMonthlyIPAddresses.attachGrid();
	SiteStatsMonthlyIPAddressesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsMonthlyIPAddressesStatsGrid1.init();
	
	SiteStatsMonthlyIPAddressesStatsGrid1.enableSmartRendering(true, 100);
	
	// All Event Handlers For Site Stats Monthly
	// Form
	SiteStatsMonthlyForm1.attachEvent("onButtonClick", function (ItemID) {
		var CurrentMonth = SiteStatsMonthlyForm1.getItemValue('SiteStatsMonthlyForm1SelectMonth', true);
		//alert ("You're Month is " + CurrentMonth);
		if (CurrentMonth != '') {
			var TabbarID = SiteStatsMonthlyTabbar1.getActiveTab();
			var TabbarText = SiteStatsMonthlyTabbar1.tabs(TabbarID).getText();
			var Field = TabbarText.replace(' ', '');
			var FieldName = Field.replace("'", '');
			var CurrentMonth = SiteStatsMonthlyForm1.getItemValue('SiteStatsMonthlyForm1SelectMonth', true);
			
			// All Grids
			SiteStatsMonthlyOverallStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyBrowserStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyBrowserVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyPluginStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyOperatingSystemsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyOperatingSystemsVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Yearly&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyLanguagesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Yearly&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyCountriesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Yearly&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			SiteStatsMonthlyIPAddressesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Yearly&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML', 'xml');
			
			// All Charts
			SiteStatsMonthlyChart1.load('../../AJAX/Managers/StatsManager/ChartsTop10.php?Type=SiteStats&RangeType=Monthly&Range=' + CurrentMonth, 'xml');
			//SiteStatsMonthlyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + TabbarText + '&RangeType=Monthly&Range=' + CurrentMonth, 'xml');
			
			SiteStatsMonthlyChart2 = SiteStatsMonthlyChartLayoutChart2.attachChart({
				view: 'pie' ,
				label:'#Percentage#',
				tooltip:{
					template:'#' + FieldName + '#'
				},
				legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
				gradient: false,
				xAxis:{"template":'#' + FieldName + '#',"step":"1"},
				yAxis:{"start":"0","end":"100","step":"1"},
				value:'#Percentage#'
			});
	
			SiteStatsMonthlyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Monthly&Range=' + CurrentMonth, 'xml');
		} else {
			// All Grids
			SiteStatsMonthlyOverallStatsGrid1.clearAll(true);
			SiteStatsMonthlyBrowserStatsGrid1.clearAll(true);
			SiteStatsMonthlyBrowserVersionsStatsGrid1.clearAll(true);
			SiteStatsMonthlyPluginStatsGrid1.clearAll(true);
			SiteStatsMonthlyOperatingSystemsStatsGrid1.clearAll(true);
			SiteStatsMonthlyOperatingSystemsVersionsStatsGrid1.clearAll(true);
			SiteStatsMonthlyLanguagesStatsGrid1.clearAll(true);
			SiteStatsMonthlyCountriesStatsGrid1.clearAll(true);
			SiteStatsMonthlyIPAddressesStatsGrid1.clearAll(true);
			
			// All Charts
			SiteStatsMonthlyChart1.clearAll();
			SiteStatsMonthlyChart2.clearAll();
		}
	});
	
	SiteStatsMonthlyBrowserStatsGrid1.attachEvent("onXLE", function (GridObject, Count) {
		//alert('Browsers Has Finished Loading!');
	});
	
	// Toolbar
	SiteStatsMonthlyToolbar1Export.attachEvent("onClick", function(ItemID) {
		var ButtonName = SiteStatsMonthlyToolbar1Export.getItemText(ItemID);
		var TabbarID = SiteStatsMonthlyTabbar1.getActiveTab();
		var CurrentMonth = SiteStatsMonthlyForm1.getItemValue('SiteStatsMonthlyForm1SelectMonth', true);
		
		switch(TabbarID) {
			case 'SiteStatsMonthlyOverallStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyBrowserStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyBrowsersVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyPluginStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyOperatingSystems':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyOperatingSystemsVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyLanguages':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyCountries':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsMonthlyIPAddresses':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Monthly&Range=' + CurrentMonth + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
		}
		//alert("You Click On " + ButtonName + 'Tabbar ID = ' + TabbarID );
	});
	
	// Tabbar
	SiteStatsMonthlyTabbar1.attachEvent("onTabClick", function (CurrentID, LastID) {
		var Text = SiteStatsMonthlyTabbar1.tabs(CurrentID).getText();
		
		if (Text == "IP Addresses") {
			SiteStatsMonthlyChartLayoutChart2.setText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
			SiteStatsMonthlyChartLayout.cells('b').setCollapsedText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
		} else if (Text == "Overall") {
			SiteStatsMonthlyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
			SiteStatsMonthlyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
		} else {
			SiteStatsMonthlyChartLayoutChart2.setText('Overall ' + Text + ' - % Of Traffic');
			SiteStatsMonthlyChartLayout.cells('b').setCollapsedText('Overall ' + Text + ' - % Of Traffic');
		}
		
		var Field = Text.replace(' ', '');
		var FieldName = Field.replace("'", '');
		//Field = Field.replace("'", '');
		
		var CurrentMonth = SiteStatsMonthlyForm1.getItemValue('SiteStatsMonthlyForm1SelectMonth', true);
		//var FileName = 'chart' + Field + '.xml';
		
		SiteStatsMonthlyChart2 = SiteStatsMonthlyChartLayoutChart2.attachChart({
			view: 'pie' ,
			label:'#Percentage#',
			tooltip:{
				template:'#' + FieldName + '#'
			},
			legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
			gradient: false,
			xAxis:{"template":'#' + FieldName + '#',"step":"1"},
			yAxis:{"start":"0","end":"100","step":"1"},
			value:'#Percentage#'
		});

		//SiteStatsMonthlyChart2.load('SampleData/' + FileName, 'xml');
		SiteStatsMonthlyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Monthly&Range=' + CurrentMonth, 'xml');
	});
	
	// Site Stats Weekly
	SiteStatsType.addTab('SiteStatsWeekly','Weekly','135');
	var SiteStatsWeekly = SiteStatsType.cells('SiteStatsWeekly');
	var SiteStatsWeeklyLayout = SiteStatsWeekly.attachLayout('3E');

	var SiteStatsWeeklyForm = SiteStatsWeeklyLayout.cells('a');
	SiteStatsWeeklyForm.setText('Form');
	SiteStatsWeeklyForm.setHeight('40');
	SiteStatsWeeklyForm.hideHeader();
	var FormData = [
		{ type:"select" , name:"SiteStatsWeeklyForm1SelectWeek", label:"Choose Week", connector:"../../AJAX/Managers/StatsManager/OptionsDates.php?Range=Weekly", labelWidth:125, inputWidth:300, required:true, labelLeft:5, labelTop:5, inputLeft:125, inputTop:5, position:"absolute" },
		{ type:"button" , name:"SiteStatsWeeklyForm1Button1", value:"Submit", inputLeft:450, inputTop:5, position:"absolute"  }
	];

	var SiteStatsWeeklyForm1 = SiteStatsWeeklyForm.attachForm(FormData);
	
	var SiteStatsWeeklyChart = SiteStatsWeeklyLayout.cells('b');
	SiteStatsWeeklyChart.setText('Charts');
	SiteStatsWeeklyChart.setHeight('300');
	SiteStatsWeeklyLayout.cells('b').setCollapsedText('Charts');
	var SiteStatsWeeklyChartLayout = SiteStatsWeeklyChart.attachLayout('2U');

	var SiteStatsWeeklyChartLayoutChart1 = SiteStatsWeeklyChartLayout.cells('a');
	SiteStatsWeeklyChartLayoutChart1.setText('Top 10 Page Views - Human Views / Total Views');
	SiteStatsWeeklyChartLayoutChart1.setWidth('800');
	SiteStatsWeeklyChartLayout.cells('a').setCollapsedText('Top 10 Page Views - Human Views / Total Views');
	var SiteStatsWeeklyChart1 = SiteStatsWeeklyChartLayoutChart1.attachChart({
		view: 'bar' ,
		label:'#HumanViews#',
		tooltip:{
			template:'Human Views - #PageName#'
		},
		legend:{"template":"#PageName#",width:190, "marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#HumanViews#'
	});
	
	SiteStatsWeeklyChart1.addSeries( {
		label:'#TotalViews#',
		value:'#TotalViews#',
		tooltip:{
			template:'Total Views - #PageName#'
		}
	});
	
	var SiteStatsWeeklyChartLayoutChart2 = SiteStatsWeeklyChartLayout.cells('b');
	SiteStatsWeeklyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
	SiteStatsWeeklyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
	var SiteStatsWeeklyChart2 = SiteStatsWeeklyChartLayoutChart2.attachChart({
		view: 'pie' ,
		label:'#Percentage#',
		tooltip:{
			template:'#Browsers#'
		},
		legend:{"template":"#Browsers#","marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		xAxis:{"template":"#Browsers#","step":"1"},
		yAxis:{"start":"0","end":"100","step":"1"},
		value:'#Percentage#'
	});
	
	SiteStatsWeeklyLayout.cells("b").showHeader();
	
	var SiteStatsWeeklyData = SiteStatsWeeklyLayout.cells('c');
	SiteStatsWeeklyData.setText('Page Views');
	SiteStatsWeeklyLayout.cells('c').setCollapsedText('Page Views');
	var SiteStatsWeeklyToolbar1Export = SiteStatsWeeklyData.attachToolbar();
	SiteStatsWeeklyToolbar1Export.setIconSize(24);
	SiteStatsWeeklyToolbar1Export.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyToolbar1Export.loadStruct('../../AJAX/Managers/StatsManager/ToolbarExport.php');
	
	var SiteStatsWeeklyTabbar1 = SiteStatsWeeklyData.attachTabbar();
	SiteStatsWeeklyTabbar1.setArrowsMode("auto");
	
	SiteStatsWeeklyLayout.cells("c").showHeader();
	
	// TAB 1
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyOverallStats','Overall','135');
	var SiteStatsWeeklyOverallStats = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyOverallStats');
	SiteStatsWeeklyTabbar1.tabs('SiteStatsWeeklyOverallStats').setActive();
	var SiteStatsWeeklyOverallStatsGrid1 = SiteStatsWeeklyOverallStats.attachGrid();
	SiteStatsWeeklyOverallStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyOverallStatsGrid1.init();
	
	SiteStatsWeeklyOverallStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 2
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyBrowserStats','Browsers','135');
	var SiteStatsWeeklyBrowserStats = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyBrowserStats');
	var SiteStatsWeeklyBrowserStatsGrid1 = SiteStatsWeeklyBrowserStats.attachGrid();
	SiteStatsWeeklyBrowserStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyBrowserStatsGrid1.init();
	
	SiteStatsWeeklyBrowserStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 3
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyBrowsersVersions','Browsers Versions','135');
	var SiteStatsWeeklyBrowsersVersions = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyBrowsersVersions');
	var SiteStatsWeeklyBrowserVersionsStatsGrid1 = SiteStatsWeeklyBrowsersVersions.attachGrid();
	SiteStatsWeeklyBrowserVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyBrowserVersionsStatsGrid1.init();
	
	SiteStatsWeeklyBrowserVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 4
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyPluginStats','Plugins','135');
	var SiteStatsWeeklyPluginStats = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyPluginStats');
	var SiteStatsWeeklyPluginStatsGrid1 = SiteStatsWeeklyPluginStats.attachGrid();
	SiteStatsWeeklyPluginStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyPluginStatsGrid1.init();
	
	SiteStatsWeeklyPluginStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 5
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyOperatingSystems','OS\'s','135');
	var SiteStatsWeeklyOperatingSystems = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyOperatingSystems');
	var SiteStatsWeeklyOperatingSystemsStatsGrid1 = SiteStatsWeeklyOperatingSystems.attachGrid();
	SiteStatsWeeklyOperatingSystemsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyOperatingSystemsStatsGrid1.init();
	
	SiteStatsWeeklyOperatingSystemsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 6
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyOperatingSystemsVersions','OS Versions','135');
	var SiteStatsWeeklyOperatingSystemsVersions = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyOperatingSystemsVersions');
	var SiteStatsWeeklyOperatingSystemsVersionsStatsGrid1 = SiteStatsWeeklyOperatingSystemsVersions.attachGrid();
	SiteStatsWeeklyOperatingSystemsVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyOperatingSystemsVersionsStatsGrid1.init();
	
	SiteStatsWeeklyOperatingSystemsVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 7
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyLanguages','Languages','135');
	var SiteStatsWeeklyLanguages = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyLanguages');
	var SiteStatsWeeklyLanguagesStatsGrid1 = SiteStatsWeeklyLanguages.attachGrid();
	SiteStatsWeeklyLanguagesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyLanguagesStatsGrid1.init();
	
	SiteStatsWeeklyLanguagesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 8
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyCountries','Countries','135');
	var SiteStatsWeeklyCountries = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyCountries');
	var SiteStatsWeeklyCountriesStatsGrid1 = SiteStatsWeeklyCountries.attachGrid();
	SiteStatsWeeklyCountriesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyCountriesStatsGrid1.init();
	
	SiteStatsWeeklyCountriesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 9
	SiteStatsWeeklyTabbar1.addTab('SiteStatsWeeklyIPAddresses','IP Addresses','135');
	var SiteStatsWeeklyIPAddresses = SiteStatsWeeklyTabbar1.cells('SiteStatsWeeklyIPAddresses');
	var SiteStatsWeeklyIPAddressesStatsGrid1 = SiteStatsWeeklyIPAddresses.attachGrid();
	SiteStatsWeeklyIPAddressesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsWeeklyIPAddressesStatsGrid1.init();
	
	SiteStatsWeeklyIPAddressesStatsGrid1.enableSmartRendering(true, 100);
	
	// All Event Handlers For Site Stats Monthly
	// Form
	SiteStatsWeeklyForm1.attachEvent("onButtonClick", function (ItemID) {
		var CurrentWeek = SiteStatsWeeklyForm1.getItemValue('SiteStatsWeeklyForm1SelectWeek', true);
		//alert ("You're Week is " + CurrentWeek);
		
		if (CurrentWeek != '') {
			var TabbarID = SiteStatsWeeklyTabbar1.getActiveTab();
			var TabbarText = SiteStatsWeeklyTabbar1.tabs(TabbarID).getText();
			var Field = TabbarText.replace(' ', '');
			var FieldName = Field.replace("'", '');
			
			// All Grids
			SiteStatsWeeklyOverallStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyBrowserStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyBrowserVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyPluginStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyOperatingSystemsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyOperatingSystemsVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyLanguagesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyCountriesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			SiteStatsWeeklyIPAddressesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML', 'xml');
			
			// All Charts
			SiteStatsWeeklyChart1.load('../../AJAX/Managers/StatsManager/ChartsTop10.php?Type=SiteStats&RangeType=Weekly&Range=' + CurrentWeek, 'xml');
			//SiteStatsWeeklyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + TabbarText + '&RangeType=Weekly&Range=' + CurrentWeek, 'xml');
			
			var SiteStatsWeeklyChart2 = SiteStatsWeeklyChartLayoutChart2.attachChart({
				view: 'pie' ,
				label:'#Percentage#',
				tooltip:{
					template:'#' + FieldName + '#'
				},
				legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
				gradient: false,
				xAxis:{"template":'#' + FieldName + '#',"step":"1"},
				yAxis:{"start":"0","end":"100","step":"1"},
				value:'#Percentage#'
			});
	
			SiteStatsWeeklyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Weekly&Range=' + CurrentWeek, 'xml');
		} else {
			// All Grids
			SiteStatsWeeklyOverallStatsGrid1.clearAll(true);
			SiteStatsWeeklyBrowserStatsGrid1.clearAll(true);
			SiteStatsWeeklyBrowserVersionsStatsGrid1.clearAll(true);
			SiteStatsWeeklyPluginStatsGrid1.clearAll(true);
			SiteStatsWeeklyOperatingSystemsStatsGrid1.clearAll(true);
			SiteStatsWeeklyOperatingSystemsVersionsStatsGrid1.clearAll(true);
			SiteStatsWeeklyLanguagesStatsGrid1.clearAll(true);
			SiteStatsWeeklyCountriesStatsGrid1.clearAll(true);
			SiteStatsWeeklyIPAddressesStatsGrid1.clearAll(true);
			
			// All Charts
			SiteStatsWeeklyChart1.clearAll();
			SiteStatsWeeklyChart2.clearAll();
		}
	});
	
	// Toolbar
	SiteStatsWeeklyToolbar1Export.attachEvent("onClick", function(ItemID) {
		var ButtonName = SiteStatsWeeklyToolbar1Export.getItemText(ItemID);
		var TabbarID = SiteStatsWeeklyTabbar1.getActiveTab();
		var CurrentWeek = SiteStatsWeeklyForm1.getItemValue('SiteStatsWeeklyForm1SelectWeek', true);
		
		switch(TabbarID) {
			case 'SiteStatsWeeklyOverallStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyBrowserStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyBrowsersVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyPluginStats':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyOperatingSystems':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyOperatingSystemsVersions':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyLanguages':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyCountries':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
			case 'SiteStatsWeeklyIPAddresses':
				switch(ButtonName) {
					case 'XML':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=XML&File=TRUE';
						window.open(Link);
						break;
					case 'Excel':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=Excel&File=TRUE';
						window.open(Link);
						break;
					case 'CSV':
						Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Weekly&Range=' + CurrentWeek + '&Format=CSV&File=TRUE';
						window.open(Link);
						break;
				}
				break;
		}
		
		
		//alert("You Click On " + ButtonName + ' Tabbar ID = ' + TabbarID );
	});
	
	// Tabbar
	SiteStatsWeeklyTabbar1.attachEvent("onTabClick", function (CurrentID, LastID) {
		var Text = SiteStatsWeeklyTabbar1.tabs(CurrentID).getText();
		
		var CurrentWeek = SiteStatsWeeklyForm1.getItemValue('SiteStatsWeeklyForm1SelectWeek', true);
		
		if (Text == "IP Addresses") {
			SiteStatsWeeklyChartLayoutChart2.setText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
			SiteStatsWeeklyChartLayout.cells('b').setCollapsedText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
		} else if (Text == "Overall") {
			SiteStatsWeeklyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
			SiteStatsWeeklyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
		} else {
			SiteStatsWeeklyChartLayoutChart2.setText('Overall ' + Text + ' - % Of Traffic');
			SiteStatsWeeklyChartLayout.cells('b').setCollapsedText('Overall ' + Text + ' - % Of Traffic');
		}
		
		var Field = Text.replace(' ', '');
		var FieldName = Field.replace("'", '');
		//Field = Field.replace("'", '');
		
		//var FileName = 'chart' + Field + '.xml';
		
		var SiteStatsWeeklyChart2 = SiteStatsWeeklyChartLayoutChart2.attachChart({
			view: 'pie' ,
			label:'#Percentage#',
			tooltip:{
				template:'#' + FieldName + '#'
			},
			legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
			gradient: false,
			xAxis:{"template":'#' + FieldName + '#',"step":"1"},
			yAxis:{"start":"0","end":"100","step":"1"},
			value:'#Percentage#'
		});

		SiteStatsWeeklyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Weekly&Range=' + CurrentWeek, 'xml');
	});

	// Site Stats Daily
	SiteStatsType.addTab('SiteStatsDaily','Daily','135');
	var SiteStatsDaily = SiteStatsType.cells('SiteStatsDaily');
	var SiteStatsDailyLayout = SiteStatsDaily.attachLayout('3E');

	var SiteStatsDailyForm = SiteStatsDailyLayout.cells('a');
	SiteStatsDailyForm.setText('Form');
	SiteStatsDailyForm.setHeight('40');
	SiteStatsDailyForm.hideHeader();
	var FormData = [
		{ type:"calendar" , name:"SiteStatsDailyForm1Calendar1", label:"Choose Date", dateFormat:"%d-%m-%Y", readonly:true, enableTime:false, labelWidth:100, labelAlign:"left", options:{
			
		}, labelLeft:5, labelTop:5, inputLeft:100, inputTop:5, position:"absolute"  },
		{ type:"button" , name:"SiteStatsDailyForm1Button1", value:"Submit", inputLeft:275, inputTop:5, position:"absolute"  }
	];

	var SiteStatsDailyForm1 = SiteStatsDailyForm.attachForm(FormData);
	
	var DateCalendar = SiteStatsDailyForm1.getCalendar("SiteStatsDailyForm1Calendar1");
	DateCalendar.setSensitiveRange("01-01-2014", null);
	
	var SiteStatsDailyChart = SiteStatsDailyLayout.cells('b');
	SiteStatsDailyChart.setText('Charts');
	SiteStatsDailyChart.setHeight('300');
	SiteStatsDailyLayout.cells('b').setCollapsedText('Charts');
	var SiteStatsDailyChartLayout = SiteStatsDailyChart.attachLayout('2U');

	var SiteStatsDailyChartLayoutChart1 = SiteStatsDailyChartLayout.cells('a');
	SiteStatsDailyChartLayoutChart1.setText('Top 10 Page Views - Human Views / Total Views');
	SiteStatsDailyChartLayoutChart1.setWidth('800');
	SiteStatsDailyChartLayout.cells('a').setCollapsedText('Top 10 Page Views - Human Views / Total Views');
	var SiteStatsDailyChart1 = SiteStatsDailyChartLayoutChart1.attachChart({
		view: 'bar' ,
		label:'#HumanViews#',
		tooltip:{
			template:'Human Views - #PageName#'
		},
		legend:{"template":"#PageName#",width:190, "marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#HumanViews#'
	});
	
	SiteStatsDailyChart1.addSeries( {
		label:'#TotalViews#',
		value:'#TotalViews#',
		tooltip:{
			template:'Total Views - #PageName#'
		}
	});
	
	var SiteStatsDailyChartLayoutChart2 = SiteStatsDailyChartLayout.cells('b');
	SiteStatsDailyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
	SiteStatsDailyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
	var SiteStatsDailyChart2 = SiteStatsDailyChartLayoutChart2.attachChart({
		view: 'pie' ,
		label:'#Percentage#',
		tooltip:{
			template:'#Browsers#'
		},
		legend:{"template":"#Browsers#","marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		xAxis:{"template":"#Browsers#","step":"1"},
		yAxis:{"start":"0","end":"100","step":"1"},
		value:'#Percentage#'
	});
	
	SiteStatsDailyLayout.cells("b").showHeader();
	
	var SiteStatsDailyData = SiteStatsDailyLayout.cells('c');
	SiteStatsDailyData.setText('Page Views');
	SiteStatsDailyLayout.cells('c').setCollapsedText('Page Views');
	
	var SiteStatsDailyToolbar1Export = SiteStatsDailyData.attachToolbar();
	SiteStatsDailyToolbar1Export.setIconSize(24);
	SiteStatsDailyToolbar1Export.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	SiteStatsDailyToolbar1Export.loadStruct('../../AJAX/Managers/StatsManager/ToolbarExport.php');
	
	var SiteStatsDailyTabbar1 = SiteStatsDailyData.attachTabbar();
	SiteStatsDailyTabbar1.setArrowsMode("auto");
	
	SiteStatsDailyLayout.cells("c").showHeader();
	
	// TAB 1
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyOverallStats','Overall','135');
	var SiteStatsDailyOverallStats = SiteStatsDailyTabbar1.cells('SiteStatsDailyOverallStats');
	SiteStatsDailyTabbar1.tabs('SiteStatsDailyOverallStats').setActive();
	var SiteStatsDailyOverallStatsGrid1 = SiteStatsDailyOverallStats.attachGrid();
	SiteStatsDailyOverallStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyOverallStatsGrid1.init();
	
	SiteStatsDailyOverallStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 2
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyBrowserStats','Browsers','135');
	var SiteStatsDailyBrowserStats = SiteStatsDailyTabbar1.cells('SiteStatsDailyBrowserStats');
	var SiteStatsDailyBrowserStatsGrid1 = SiteStatsDailyBrowserStats.attachGrid();
	SiteStatsDailyBrowserStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyBrowserStatsGrid1.init();
	
	SiteStatsDailyBrowserStatsGrid1.enableSmartRendering(true, 100);

	// TAB 3
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyBrowsersVersions','Browsers Versions','135');
	var SiteStatsDailyBrowsersVersions = SiteStatsDailyTabbar1.cells('SiteStatsDailyBrowsersVersions');
	var SiteStatsDailyBrowserVersionsStatsGrid1 = SiteStatsDailyBrowsersVersions.attachGrid();
	SiteStatsDailyBrowserVersionsStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyBrowserVersionsStatsGrid1.init();
	
	SiteStatsDailyBrowserVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 4
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyPluginStats','Plugins','135');
	var SiteStatsDailyPluginStats = SiteStatsDailyTabbar1.cells('SiteStatsDailyPluginStats');
	var SiteStatsDailyPluginStatsGrid1 = SiteStatsDailyPluginStats.attachGrid();
	SiteStatsDailyPluginStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyPluginStatsGrid1.init();
	
	SiteStatsDailyPluginStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 5
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyOperatingSystems','OS\'s','135');
	var SiteStatsDailyOperatingSystems = SiteStatsDailyTabbar1.cells('SiteStatsDailyOperatingSystems');
	var SiteStatsDailyOperatingSystemsStatsGrid1 = SiteStatsDailyOperatingSystems.attachGrid();
	SiteStatsDailyOperatingSystemsStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyOperatingSystemsStatsGrid1.init();
	
	SiteStatsDailyOperatingSystemsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 6
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyOperatingSystemsVersions','OS Versions','135');
	var SiteStatsDailyOperatingSystemsVersions = SiteStatsDailyTabbar1.cells('SiteStatsDailyOperatingSystemsVersions');
	var SiteStatsDailyOperatingSystemsVersionsStatsGrid1 = SiteStatsDailyOperatingSystemsVersions.attachGrid();
	SiteStatsDailyOperatingSystemsVersionsStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyOperatingSystemsVersionsStatsGrid1.init();
	
	SiteStatsDailyOperatingSystemsVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 7
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyLanguages','Languages','135');
	var SiteStatsDailyLanguages = SiteStatsDailyTabbar1.cells('SiteStatsDailyLanguages');
	var SiteStatsDailyLanguagesStatsGrid1 = SiteStatsDailyLanguages.attachGrid();
	SiteStatsDailyLanguagesStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyLanguagesStatsGrid1.init();
	
	SiteStatsDailyLanguagesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 8
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyCountries','Countries','135');
	var SiteStatsDailyCountries = SiteStatsDailyTabbar1.cells('SiteStatsDailyCountries');
	var SiteStatsDailyCountriesStatsGrid1 = SiteStatsDailyCountries.attachGrid();
	SiteStatsDailyCountriesStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyCountriesStatsGrid1.init();
	
	SiteStatsDailyCountriesStatsGrid1.enableSmartRendering(true, 100);
	
	// TAB 9
	SiteStatsDailyTabbar1.addTab('SiteStatsDailyIPAddresses','IP Addresses','135');
	var SiteStatsDailyIPAddresses = SiteStatsDailyTabbar1.cells('SiteStatsDailyIPAddresses');
	var SiteStatsDailyIPAddressesStatsGrid1 = SiteStatsDailyIPAddresses.attachGrid();
	SiteStatsDailyIPAddressesStatsGrid1.setIconsPath('../../../../Libraries/Tier7BehavioralLayer/DHTMLXSuiteStandardCompressed/imgs/');
	
	SiteStatsDailyIPAddressesStatsGrid1.init();
	
	SiteStatsDailyIPAddressesStatsGrid1.enableSmartRendering(true, 100);
	
	// All Event Handlers For Site Stats Monthly
	// Form
	SiteStatsDailyForm1.attachEvent("onButtonClick", function (ItemID) {
		var CurrentDate = SiteStatsDailyForm1.getItemValue('SiteStatsDailyForm1Calendar1', true);
		//alert ("You're Date is " + CurrentDate);
		var TabbarID = SiteStatsDailyTabbar1.getActiveTab();
		var TabbarText = SiteStatsDailyTabbar1.tabs(TabbarID).getText();
		var Field = TabbarText.replace(' ', '');
		var FieldName = Field.replace("'", '');
		
		if (CurrentDate != '') {
			// All Grids
			SiteStatsDailyOverallStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Daily&Range=' + CurrentDate+ '&Format=XML', 'xml');
			SiteStatsDailyBrowserStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Daily&Range=' + CurrentDate + '&Format=XML', 'xml');
			SiteStatsDailyBrowserVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=XML', 'xml');
			SiteStatsDailyPluginStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Daily&Range=' + CurrentDate + '&Format=XML', 'xml');
			SiteStatsDailyOperatingSystemsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Daily&Range=' + CurrentDate + '&Format=XML', 'xml');
			SiteStatsDailyOperatingSystemsVersionsStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=XML', 'xml');
			SiteStatsDailyLanguagesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=XML', 'xml');
			SiteStatsDailyCountriesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=XML', 'xml');
			SiteStatsDailyIPAddressesStatsGrid1.load('../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Daily&Range=' + CurrentDate  + '&Format=XML', 'xml');
			
			//alert('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + TabbarText + '&RangeType=Daily&Range=' + CurrentDate);
			//alert(SiteStatsDailyChart2);
			// All Charts
			SiteStatsDailyChart1.load('../../AJAX/Managers/StatsManager/ChartsTop10.php?Type=SiteStats&RangeType=Daily&Range=' + CurrentDate, 'xml');
			//SiteStatsDailyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + TabbarText + '&RangeType=Daily&Range=' + CurrentDate, 'xml');
			//SiteStatsDailyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + TabbarText + '&RangeType=Daily&Range=' + CurrentDate, 'xml');
			
			var SiteStatsDailyChart2 = SiteStatsDailyChartLayoutChart2.attachChart({
				view: 'pie' ,
				label:'#Percentage#',
				tooltip:{
					template:'#' + FieldName + '#'
				},
				legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
				gradient: false,
				xAxis:{"template":'#' + FieldName + '#',"step":"1"},
				yAxis:{"start":"0","end":"100","step":"1"},
				value:'#Percentage#'
			});
	
			SiteStatsDailyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Daily&Range=' + CurrentDate, 'xml');
				
		} else {
			// All Grids
			SiteStatsDailyOverallStatsGrid1.clearAll(true);
			SiteStatsDailyBrowserStatsGrid1.clearAll(true);
			SiteStatsDailyBrowserVersionsStatsGrid1.clearAll(true);
			SiteStatsDailyPluginStatsGrid1.clearAll(true);
			SiteStatsDailyOperatingSystemsStatsGrid1.clearAll(true);
			SiteStatsDailyOperatingSystemsVersionsStatsGrid1.clearAll(true);
			SiteStatsDailyLanguagesStatsGrid1.clearAll(true);
			SiteStatsDailyCountriesStatsGrid1.clearAll(true);
			SiteStatsDailyIPAddressesStatsGrid1.clearAll(true);
			
			// All Charts
			SiteStatsDailyChart1.clearAll();
			SiteStatsDailyChart2.clearAll();
		}
	});
	
	// Toolbar
	SiteStatsDailyToolbar1Export.attachEvent("onClick", function(ItemID) {
		var ButtonName = SiteStatsDailyToolbar1Export.getItemText(ItemID);
		var TabbarID = SiteStatsDailyTabbar1.getActiveTab();
		var Link = null;
		
		var CurrentDate = SiteStatsDailyForm1.getItemValue('SiteStatsDailyForm1Calendar1', true);
		
		if (CurrentDate != '') {
			switch(TabbarID) {
				case 'SiteStatsDailyOverallStats':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Daily&Range=' + CurrentDate+ '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Daily&Range=' + CurrentDate+ '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Overall&RangeType=Daily&Range=' + CurrentDate+ '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyBrowserStats':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Daily&Range=' + CurrentDate + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Daily&Range=' + CurrentDate + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Browsers&RangeType=Daily&Range=' + CurrentDate + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyBrowsersVersions':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=BrowsersVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyPluginStats':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Daily&Range=' + CurrentDate + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Daily&Range=' + CurrentDate + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Plugins&RangeType=Daily&Range=' + CurrentDate + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyOperatingSystems':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Daily&Range=' + CurrentDate + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Daily&Range=' + CurrentDate + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OS\'s&RangeType=Daily&Range=' + CurrentDate + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyOperatingSystemsVersions':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=OSVersions&RangeType=Daily&Range=' + CurrentDate + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyLanguages':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Languages&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyCountries':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=Countries&RangeType=Range&RangeType=Daily&Range=' + CurrentDate + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
				case 'SiteStatsDailyIPAddresses':
					switch(ButtonName) {
						case 'XML':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Daily&Range=' + CurrentDate  + '&Format=XML&File=TRUE';
							window.open(Link);
							break;
						case 'Excel':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Daily&Range=' + CurrentDate  + '&Format=Excel&File=TRUE';
							window.open(Link);
							break;
						case 'CSV':
							Link = '../../AJAX/Managers/StatsManager/GridStatsData.php?Type=SiteStats&Name=IPAddresses&RangeType=Range&RangeType=Daily&Range=' + CurrentDate  + '&Format=CSV&File=TRUE';
							window.open(Link);
							break;
					}
					break;
			}
			//alert("You Click On " + ButtonName + ' Tabbar ID = ' + TabbarID + ' Link = ' + Link );
			
		} else {
			alert("Please Choose A Date!");
		}
		
	});
	
	// Tabbar
	SiteStatsDailyTabbar1.attachEvent("onTabClick", function (CurrentID, LastID) {
		var Text = SiteStatsDailyTabbar1.tabs(CurrentID).getText();
		
		var CurrentDate = SiteStatsDailyForm1.getItemValue('SiteStatsDailyForm1Calendar1', true);
		
		if (Text == "IP Addresses") {
			SiteStatsDailyChartLayoutChart2.setText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
			SiteStatsDailyChartLayout.cells('b').setCollapsedText('Top 10 ' + Text + ' - % Of Human Traffic Per Address');
		} else if (Text == "Overall") {
			SiteStatsDailyChartLayoutChart2.setText('Overall - Top 10 Bounce Rate - % Of Traffic');
			SiteStatsDailyChartLayout.cells('b').setCollapsedText('Overall - Top 10 Bounce Rate - % Of Traffic');
		} else {
			SiteStatsDailyChartLayoutChart2.setText('Overall ' + Text + ' - % Of Traffic');
			SiteStatsDailyChartLayout.cells('b').setCollapsedText('Overall ' + Text + ' - % Of Traffic');
		}
		
		var Field = Text.replace(' ', '');
		var FieldName = Field.replace("'", '');
		//Field = Field.replace("'", '');
		
		//var FileName = 'chart' + Field + '.xml';
		
		var SiteStatsDailyChart2 = SiteStatsDailyChartLayoutChart2.attachChart({
			view: 'pie' ,
			label:'#Percentage#',
			tooltip:{
				template:'#' + FieldName + '#'
			},
			legend:{"template":'#' + FieldName + '#',"marker":{"type":"square","width":15,"height":15}},
			gradient: false,
			xAxis:{"template":'#' + FieldName + '#',"step":"1"},
			yAxis:{"start":"0","end":"100","step":"1"},
			value:'#Percentage#'
		});

		SiteStatsDailyChart2.load('../../AJAX/Managers/StatsManager/ChartsOverall.php?Type=SiteStats&Name=' + Field + '&RangeType=Daily&Range=' + CurrentDate, 'xml');
	});
	
	// Site Stats Window
	/*var Window = new dhtmlXWindows();

	var SiteStatsChartWindow = Window.createWindow('SiteStatsChartWindow', 0, 0, 800, 600);
	var SiteStatsChartWindowChart1 = SiteStatsChartWindow.attachChart({
		view: 'bar' ,
		label:'#HumanHits#',
		tooltip:{
			template:'Human Hits - #PageName#'
		},
		legend:{"template":"#PageName#",width:190, "marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#HumanHits#'
	});
	
	SiteStatsChartWindowChart1.addSeries( {
		label:'#TotalHits#',
		value:'#TotalHits#',
		tooltip:{
			template:'Total Hits - #PageName#'
		}
	});
	
	var CurrentDate = '05-05-2014';
	SiteStatsChartWindowChart1.load('../../AJAX/Managers/StatsManager/ChartsTop10.php?Type=SiteStats&RangeType=Daily&Range=' + CurrentDate, 'xml');


	SiteStatsChartWindow.setText('Top 10 Page Views');
	SiteStatsChartWindow.centerOnScreen();
	*/
}
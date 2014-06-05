function LoadAdStats() {
	// AD STATS
	//StatsReportsTabbar.addTab('AdStats','Ad Stats','');
	var AdStats = StatsReportsTabbar.cells('AdStats');
	var AdStatsLayout1 = AdStats.attachLayout('2E');
	
	var AdStatsLayout1Form = AdStatsLayout1.cells('a');
	AdStatsLayout1Form.setText('Ad Selection Form');
	AdStatsLayout1Form.setHeight('40');
	AdStatsLayout1Form.hideHeader();
	AdStatsLayout1.setCollapsedText('a', 'Ad Selection Form');
	var FormData = [
		{ type:"select" , name:"AdStatsLayout1Form1SelectAdPanel", label:"Ad Panel", connector:"../../AJAX/Managers/StatsManager/OptionsAdPanels.php", labelWidth:125, inputWidth:150, labelLeft:5, labelTop:5, inputLeft:125, inputTop:5, position:"absolute", options:[
					] },
		{ type:"select" , name:"AdStatsLayout1Form1SelectAdvertiser", label:"Advertiser", connector:"../../AJAX/Managers/StatsManager/OptionsAdvertisers.php", labelWidth:125, inputWidth:400, labelLeft:300, labelTop:5, inputLeft:425, inputTop:5, position:"absolute", options:[
					] },
		{ type:"button" , name:"AdStatsLayout1Form1Button1", value:"Submit", inputLeft:850, inputTop:5, position:"absolute"  }
	];

	var AdStatsLayout1Form1 = AdStatsLayout1Form.attachForm(FormData);
	
	AdStatsLayout1Form1.attachEvent("onChange", function (ItemID) {
		if (ItemID == "AdStatsLayout1Form1SelectAdPanel") {
			var OptionSelected = AdStatsLayout1Form1.getItemValue(ItemID, true);
			OptionSelected = OptionSelected.replace(/ /g,'');
			var FileName = '../../AJAX/Managers/StatsManager/OptionsAdvertisers.php?AdPanel=' + OptionSelected;
			
			AdStatsLayout1Form1.reloadOptions('AdStatsLayout1Form1SelectAdvertiser', FileName);
		}
	});
	
	AdStatsLayout1Form1.attachEvent("onButtonClick", function(ItemID) {
		if (ItemID == "AdStatsLayout1Form1Button1") {
			var OptionSelected = AdStatsLayout1Form1.getItemValue('AdStatsLayout1Form1SelectAdvertiser', true);
			alert("You Selected " + OptionSelected);
		}
	});
	//AdStatsLayout1Form1.load('./data/form.xml');

	var AdStatsLayout1Type = AdStatsLayout1.cells('b');
	AdStatsLayout1Type.setText('Ad Stats');
	AdStatsLayout1Type.hideHeader();
	AdStatsLayout1.setCollapsedText('b', 'Ad Stats');
	var AdStatsType = AdStatsLayout1Type.attachTabbar();
	AdStatsType.setAlign('right');
	AdStatsType.addTab('AdStatsRange','Range','');
	var AdStatsRange = AdStatsType.cells('AdStatsRange');
	AdStatsType.setTabActive('AdStatsRange');
	var AdStatsRangeLayout = AdStatsRange.attachLayout('3E');
	
	var AdStatsRangeForm = AdStatsRangeLayout.cells('a');
	AdStatsRangeForm.setText('Form');
	AdStatsRangeForm.setHeight('40');
	AdStatsRangeForm.hideHeader();
	AdStatsRangeLayout.setCollapsedText('a', 'Form');
	var FormData = [
		{ type:"calendar" , name:"AdStatsRangeForm1CalendarStartDate", label:"Choose Start Date", dateFormat:"%m-%d-%Y", labelWidth:125, options:{
			
		}, labelLeft:5, labelTop:5, inputLeft:125, inputTop:5, position:"absolute"  },
		{ type:"calendar" , name:"AdStatsRangeForm1CalendarEndDate", label:"Choose End Date", dateFormat:"%m-%d-%Y", labelWidth:100, options:{
			
		}, labelLeft:300, labelTop:5, inputLeft:400, inputTop:5, position:"absolute"  },
		{ type:"button" , name:"AdStatsRangeForm1Button1", value:"Submit", inputLeft:600, inputTop:5, position:"absolute"  }
	];

	var AdStatsRangeForm1 = AdStatsRangeForm.attachForm(FormData);
	
	var StartDateCalendar = AdStatsRangeForm1.getCalendar("AdStatsRangeForm1CalendarStartDate");
	var EndDateCalendar = AdStatsRangeForm1.getCalendar("AdStatsRangeForm1CalendarEndDate");
	StartDateCalendar.setSensitiveRange("01-01-2014", null);
	EndDateCalendar.setSensitiveRange("01-01-2014", null);
	
	AdStatsRangeForm1.attachEvent("onButtonClick", function (ItemID) {
		var StartDate = AdStatsRangeForm1.getItemValue('AdStatsRangeForm1CalendarStartDate', true);
		alert ("You're Start Date is " + StartDate);
		var EndDate = AdStatsRangeForm1.getItemValue('AdStatsRangeForm1CalendarEndDate', true);
		alert ("You're End Date is " + EndDate);
	});
	
	var AdStatsRangeChart = AdStatsRangeLayout.cells('b');
	AdStatsRangeChart.setText('Charts');
	AdStatsRangeLayout.setCollapsedText('b', 'Charts');
	AdStatsRangeChart.setHeight('300');
	var AdStatsRangeChartLayout = AdStatsRangeChart.attachLayout('2U');

	var AdStatsRangeChartLayoutChart1 = AdStatsRangeChartLayout.cells('a');
	AdStatsRangeChartLayoutChart1.setText('Top 10 Page Views');
	AdStatsRangeChartLayoutChart1.setWidth('800');
	AdStatsRangeChartLayout.setCollapsedText('a', 'Top 10 Page Views');
	var AdStatsRangeChart1 = AdStatsRangeChartLayoutChart1.attachChart({
		view: 'bar' ,
		label:'#Views#',
		tooltip:{
			template:'#PageName#'
		},
		legend:{"template":"#PageName#","marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#Views#'
	});

	AdStatsRangeChart1.load('SampleData/chart.xml', 'xml');
	
	var AdStatsRangeChartLayoutChart2 = AdStatsRangeChartLayout.cells('b');
	AdStatsRangeChartLayoutChart2.setText('Overall Browsers - % Of Traffic');
	AdStatsRangeChartLayout.setCollapsedText('b', 'Overall Browsers - % Of Traffic');
	var AdStatsRangeChart2 = AdStatsRangeChartLayoutChart2.attachChart({
		view: 'pie' ,
		label:'#Percentage#',
		tooltip:{
			template:'#Browsers#'
		},
		legend:{"template":"#Browsers#","marker":{"type":"square","width":15,"height":15}},
		gradient: false,
		value:'#Percentage#'
	});

	AdStatsRangeChart2.load('SampleData/chartBrowsers.xml', 'xml');
	
	AdStatsRangeLayout.cells("b").showHeader();
	
	var AdStatsRangeData = AdStatsRangeLayout.cells('c');
	AdStatsRangeData.setText('Page Views');
	AdStatsRangeLayout.setCollapsedText('c', 'Page Views');
	var AdStatsRangeToolbar1Export = AdStatsRangeData.attachToolbar();
	AdStatsRangeToolbar1Export.setIconSize(24);
	AdStatsRangeToolbar1Export.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeToolbar1Export.loadXML('SampleData/toolbarExport.xml');
	
	AdStatsRangeToolbar1Export.attachEvent("onClick", function(ItemID) {
		var ButtonName = AdStatsRangeToolbar1Export.getItemText(ItemID);
		alert("You Click On " + ButtonName);
	});
	
	var AdStatsRangeTabbar1 = AdStatsRangeData.attachTabbar();
	
	AdStatsRangeLayout.cells("c").showHeader();
	//AdStatsRangeTabbar1.loadXML('SampleData/tabbar.xml');
	
	// TAB 1
	AdStatsRangeTabbar1.addTab('AdStatsRangeBrowserStats','Browsers','');
	var AdStatsRangeBrowserStats = AdStatsRangeTabbar1.cells('AdStatsRangeBrowserStats');
	AdStatsRangeTabbar1.setTabActive('AdStatsRangeBrowserStats');
	
	var AdStatsRangeBrowserStatsGrid1 = AdStatsRangeBrowserStats.attachGrid();
	AdStatsRangeBrowserStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeBrowserStatsGrid1.init();
	
	AdStatsRangeBrowserStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangeBrowserStatsGrid1.load('SampleData/gridBrowsers.xml', 'xml');
	
	// TAB 2
	AdStatsRangeTabbar1.addTab('AdStatsRangeBrowsersVersions','Browsers Versions','');
	var AdStatsRangeBrowsersVersions = AdStatsRangeTabbar1.cells('AdStatsRangeBrowsersVersions');
	var AdStatsRangeBrowserVersionsStatsGrid1 = AdStatsRangeBrowsersVersions.attachGrid();
	AdStatsRangeBrowserVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeBrowserVersionsStatsGrid1.init();
	
	AdStatsRangeBrowserVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangeBrowserVersionsStatsGrid1.load('SampleData/gridBrowsersVersions.xml', 'xml');
	
	// TAB 3
	AdStatsRangeTabbar1.addTab('AdStatsRangePluginStats','Plugins','');
	var AdStatsRangePluginStats = AdStatsRangeTabbar1.cells('AdStatsRangePluginStats');
	var AdStatsRangePluginStatsGrid1 = AdStatsRangePluginStats.attachGrid();
	AdStatsRangePluginStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangePluginStatsGrid1.init();
	
	AdStatsRangePluginStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangePluginStatsGrid1.load('SampleData/gridPlugins.xml', 'xml');
	
	// TAB 4
	AdStatsRangeTabbar1.addTab('AdStatsRangeOperatingSystems','OS\'s','');
	var AdStatsRangeOperatingSystems = AdStatsRangeTabbar1.cells('AdStatsRangeOperatingSystems');
	var AdStatsRangeOperatingSystemsStatsGrid1 = AdStatsRangeOperatingSystems.attachGrid();
	AdStatsRangeOperatingSystemsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeOperatingSystemsStatsGrid1.init();
	
	AdStatsRangeOperatingSystemsStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangeOperatingSystemsStatsGrid1.load('SampleData/gridOperatingSystems.xml', 'xml');
	
	// TAB 5
	AdStatsRangeTabbar1.addTab('AdStatsRangeOperatingSystemsVersions','OS Versions','');
	var AdStatsRangeOperatingSystemsVersions = AdStatsRangeTabbar1.cells('AdStatsRangeOperatingSystemsVersions');
	var AdStatsRangeOperatingSystemsVersionsStatsGrid1 = AdStatsRangeOperatingSystemsVersions.attachGrid();
	AdStatsRangeOperatingSystemsVersionsStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeOperatingSystemsVersionsStatsGrid1.init();
	
	AdStatsRangeOperatingSystemsVersionsStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangeOperatingSystemsVersionsStatsGrid1.load('SampleData/gridOperatingSystemsVersions.xml', 'xml');
	
	// TAB 6
	AdStatsRangeTabbar1.addTab('AdStatsRangeLanguages','Languages','');
	var AdStatsRangeLanguages = AdStatsRangeTabbar1.cells('AdStatsRangeLanguages');
	var AdStatsRangeLanguagesStatsGrid1 = AdStatsRangeLanguages.attachGrid();
	AdStatsRangeLanguagesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeLanguagesStatsGrid1.init();
	
	AdStatsRangeLanguagesStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangeLanguagesStatsGrid1.load('SampleData/gridLanguages.xml', 'xml');
	
	// TAB 7
	AdStatsRangeTabbar1.addTab('AdStatsRangeCountries','Countries','');
	var AdStatsRangeCountries = AdStatsRangeTabbar1.cells('AdStatsRangeCountries');
	var AdStatsRangeCountriesStatsGrid1 = AdStatsRangeCountries.attachGrid();
	AdStatsRangeCountriesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeCountriesStatsGrid1.init();
	
	AdStatsRangeCountriesStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangeCountriesStatsGrid1.load('SampleData/gridCountries.xml', 'xml');
	
	// TAB 8
	AdStatsRangeTabbar1.addTab('AdStatsRangeIPAddresses','IP Addresses','');
	var AdStatsRangeIPAddresses = AdStatsRangeTabbar1.cells('AdStatsRangeIPAddresses');
	var AdStatsRangeIPAddressesStatsGrid1 = AdStatsRangeIPAddresses.attachGrid();
	AdStatsRangeIPAddressesStatsGrid1.setIconsPath('../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');
	
	AdStatsRangeIPAddressesStatsGrid1.init();
	
	AdStatsRangeIPAddressesStatsGrid1.enableSmartRendering(true, 100);
	
	AdStatsRangeIPAddressesStatsGrid1.load('SampleData/gridIPAddresses.xml', 'xml');
	
	AdStatsRangeTabbar1.attachEvent("onTabClick", function (CurrentID, LastID) {
		var Text = AdStatsRangeTabbar1.getLabel(CurrentID);
		if (Text == "IP Addresses") {
			AdStatsRangeChartLayoutChart2.setText('Top 10 ' + Text + ' - % Of Overall Traffic');
			AdStatsRangeChartLayout.setCollapsedText('b', 'Top 10 ' + Text + ' - % Of Overall Traffic');
		} else {
			AdStatsRangeChartLayoutChart2.setText('Overall ' + Text + ' - % Of Traffic');
			AdStatsRangeChartLayout.setCollapsedText('b', 'Overall ' + Text + ' - % Of Traffic');
		}
		
		var Field = Text.replace(' ', '');
		Field = Field.replace("'", '');
		
		var FileName = 'chart' + Field + '.xml';
		
		var AdStatsRangeChart2 = AdStatsRangeChartLayoutChart2.attachChart({
			view: 'pie' ,
			label:'#Percentage#',
			tooltip:{
				template:'#' + Field + '#'
			},
			legend:{"template":'#' + Field + '#',"marker":{"type":"square","width":15,"height":15}},
			gradient: false,
			xAxis:{"template":'#' + Field + '#',"step":"1"},
			yAxis:{"start":"0","end":"100","step":"1"},
			value:'#Percentage#'
		});

		AdStatsRangeChart2.load('SampleData/' + FileName, 'xml');
	});
	
	// ADD HERE
	AdStatsType.addTab('AdStatsYearly','Yearly','');
	var AdStatsYearly = AdStatsType.cells('AdStatsYearly');

	AdStatsType.addTab('AdStatsMonthly','Monthly','');
	var AdStatsMonthly = AdStatsType.cells('AdStatsMonthly');

	AdStatsType.addTab('AdStatsWeekly','Weekly','');
	var AdStatsWeekly = AdStatsType.cells('AdStatsWeekly');

	AdStatsType.addTab('AdStatsDaily','Daily','');
	var AdStatsDaily = AdStatsType.cells('AdStatsDaily');
}
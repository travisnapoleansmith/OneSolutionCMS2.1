function afterLoad() {
	scheduler.config.hour_date = "%g:%i%a"; 
	scheduler.config.xml_date="%F-%d-%Y %h:%i:%s %A";
	scheduler.init('Content', new Date(),"month");
	
	scheduler.load('../../../AJAX/Managers/ContentManager/Scheduler/Events.php', 'xml');

	var dp = new dataProcessor("../../../AJAX/Managers/ContentManager/Scheduler/Events.php");

	dp.init(scheduler);
	dp.setTransactionMode("POST", false);
	
	var EnableDisableOptions = [
		{ key: 'Enable', label: 'Enable' },
		{ key: 'Disable', label: 'Disable' }
	];
	
	var StatusOptions = [
		{ key: 'Approved', label: 'Approved' },
		{ key: 'Not-Approved', label: 'Not-Approved' },
		{ key: 'Spam', label: 'Spam' },
		{ key: 'Pending', label: 'Pending' }
	];
	
	scheduler.config.lightbox.sections=[
		{name:"Description", height:250, map_to:"text", type:"textarea", focus:true },
		{name:"Enable/Disable", height:30, type:"select", map_to:"EnableDisable", options:EnableDisableOptions},
		{name:"Status", height:30, type:"select", map_to:"Status", options:StatusOptions},
		{name:"Time period", height:72, type:"time", map_to:"auto"}
	];
	
	var SchedulerToolbarExport = new dhtmlXToolbarObject('ExportToolbar');
	SchedulerToolbarExport.setSkin('dhx_skyblue');
	SchedulerToolbarExport.setIconSize(10);
	SchedulerToolbarExport.setIconsPath('../../../../../Tier8-PresentationLayer/AdministratorsPanel/Images/ToolbarIcons/');

	SchedulerToolbarExport.loadStruct("../../../AJAX/Managers/ContentManager/Scheduler/Toolbar.xml", function(){
		SchedulerToolbarExport.addSpacer("iCal");																					
	});
	
	SchedulerToolbarExport.attachEvent("onClick", function (id) {
		var Form = document.forms[0];
		
		switch(id) {
			case 'PDF':
				scheduler.toPDF('../../../AJAX/Managers/ContentManager/Scheduler/Events.php?Type=Export');
				break;
			case 'CSV':
				Form.elements.Format.value = 'CSV';
				Form.elements.Type.value = 'Export';
				Form.submit();
				break;
			case 'XLS':
				Form.elements.Format.value = 'XLS';
				Form.elements.Type.value = 'Export';
				Form.submit();
				break;
			case 'XML':
				Form.elements.Format.value = 'XML';
				Form.elements.Type.value = 'Export';
				Form.submit();
				break;
			case 'iCal':
				Form.elements.Format.value = 'iCal';
				Form.elements.Type.value = 'Export';
				Form.submit();
				break;
			case 'Import':
				//Form.elements.Format.value = 'Import';
				var ImportWindow = new dhtmlXWindows();
				ImportWindow.attachViewportTo('ImportBox');
				
				var ID = 1;
				var Width = 400;
				var Height = 175;
				var X = 500;
				var Y = 100;
				
				ImportWindow.createWindow(ID, X, Y, Width, Height);
				ImportWindow.window(ID).setText('Import');
				
				var formStructure = [
					{type: "fieldset", label: "Uploader", list:[
						{type: "upload", autoRemove: true, name: "UploadFiles", titleText : 'Upload files here: Use export tools as a guide to correct format', inputWidth: 330, url: "../../../AJAX/Managers/ContentManager/Scheduler/Events.php?Type=Import", _swfLogs: "enabled", swfPath: "uploader.swf", swfUrl: "../../../AJAX/Managers/ContentManager/Scheduler/Events.php?Type=Import"}
					]}
				];
				
				
				ImportForm = ImportWindow.window(ID).attachForm(formStructure);
				
				ImportForm.attachEvent("onUploadFail",function(FileName, Extra){
					ImportWindow.window(ID).hide();
					dhtmlx.alert({
						title:"Status - File Failure!",
						type:"alert-error",
						text:"File Failure, file " + FileName + "<br/>" + Extra.Error,
						callback: function() {
							ImportWindow.window(ID).show();
						}
					});
				});
				
				ImportForm.attachEvent("onUploadComplete",function(FileName, Extra){
					dhtmlx.message("File Upload Completed");
					scheduler.load('../../../AJAX/Managers/ContentManager/Scheduler/Events.php', 'xml');
				});
				break;
			case 'MassUpdate':
				alert("TEST " + id);
				break;
			case 'Print':
				scheduler.toPDF('../../../AJAX/Managers/ContentManager/Scheduler/Events.php?Type=Export&Print=TRUE');
				break;
			default:
				break;
		}
	});

}
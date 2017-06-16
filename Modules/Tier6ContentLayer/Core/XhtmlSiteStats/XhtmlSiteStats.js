/*
**************************************************************************************
* One Solution CMS
*
* Copyright (c) 1999 - 2013 One Solution CMS
* This content management system is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* (at your option) any later version.
*
* This content management system is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @copyright  Copyright (c) 1999 - 2013 One Solution CMS (http://www.onesolutioncms.com/)
* @license    http://www.gnu.org/licenses/gpl-2.0.txt
* @version    2.1.141, 2013-01-14
*************************************************************************************
*/
	
$(document).ready(SiteStats());
function SiteStats() {
	var GET = GetUrlVars();
	var PageID = 1;
	if (GET['PageID'] != null) {
		PageID = GET['PageID'];
	}
	
	var PageUrl = 'Modules/Tier6ContentLayer/Core/XhtmlSiteStats/XMLBrowserSiteStats.php?PageID=' + PageID;
	
	var ScreenHeight = screen.height;
	var ScreenWidth = screen.width;
	var ScreenAvailableHeight = screen.availHeight;
	var ScreenAvailableWidth = screen.availWidth;
	var ScreenColorDepth = screen.colorDepth;
	var ScreenPixelDepth = screen.pixelDepth;
	
	var NavigatorAppCodeName = navigator.appCodeName;
	var NavigatorAppName = navigator.appName;
	var NavigatorAppVersion = navigator.appVersion;
	var NavigatorCookieEnabled = navigator.cookieEnabled;
	var NavigatorLanguage = navigator.language;
	var NavigatorOnline = navigator.onLine;
	var NavigatorPlatform = navigator.platform;
	var NavigatorUserAgent = navigator.userAgent;
	var NavigatorSystemLanguage = navigator.systemLanguage;
	var NavigatorJavaEnabled = navigator.javaEnabled();
	
	PluginDetect.getVersion(".");
	
	var PluginDetectAdobeReaderVersion = PluginDetect.getVersion('AdobeReader');
	var PluginDetectDevalvrVersion = PluginDetect.getVersion('Devalvr');
	var PluginDetectFlashVersion = PluginDetect.getVersion('Flash');
	//var PluginDetectJavaVersion = PluginDetect.getVersion('Java');
	var PluginDetectPDFJSVersion = PluginDetect.getVersion('PDFJS');
	var PluginDetectPDFReaderVersion = PluginDetect.getVersion('PDFReader');
	var PluginDetectQuickTimeVersion = PluginDetect.getVersion('QuickTime');
	var PluginDetectRealPlayerVersion = PluginDetect.getVersion('RealPlayer');
	var PluginDetectShockWaveVersion = PluginDetect.getVersion('ShockWave');
	var PluginDetectSilverlightVersion = PluginDetect.getVersion('Silverlight');
	var PluginDetectVLCVersion = PluginDetect.getVersion('VLC');
	var PluginDetectWindowsMediaPlayerVersion = PluginDetect.getVersion('WindowsMediaPlayer');
	
	var PluginDetectOS = PluginDetect.OS;
	if (PluginDetectOS == 1) PluginDetectOS = "Windows";
	if (PluginDetectOS == 2) PluginDetectOS = "Macintosh";
	if (PluginDetectOS == 3) PluginDetectOS = "Linux";
	
	if (PluginDetectOS == 21.1) PluginDetectOS = "iPhone";
	if (PluginDetectOS == 21.2) PluginDetectOS = "iPod";
	if (PluginDetectOS == 21.3) PluginDetectOS = "iPad";
	
	var OSVersion = null;
	
	if (navigator.appVersion.indexOf("NT 5.1")!=-1) OSVersion = "XP"; 
	if (navigator.appVersion.indexOf("NT 6.0")!=-1) OSVersion = "Vista"; 
	if (navigator.appVersion.indexOf("NT 6.1")!=-1) OSVersion = "7"; 
	if (navigator.appVersion.indexOf("NT 6.2")!=-1) OSVersion = "8";
	if (navigator.appVersion.indexOf("NT 6.3")!=-1) OSVersion = "8.1"; 
	//var PluginDetectIsIE = PluginDetect.browser.isIE;
	var PluginDetectActiveXEnabled = PluginDetect.browser.ActiveXEnabled;
	var PluginDetectActiveXFilteringEnabled = PluginDetect.ActiveXFilteringEnabled;
	var PluginDetectIEVersion = PluginDetect.browser.verIE;
	var PluginDetectTrueIEVersion = PluginDetect.browser.verIEtrue;
	var PluginDetectDocModeIE = PluginDetect.browser.docModeIE;
	
	//var PluginDetectIsGecko = PluginDetect.browser.isGecko;
	var PluginDetectGeckoVersion = PluginDetect.browser.verGecko;
	//var PluginDetectIsSafari = PluginDetect.browser.isSafari;
	var PluginDetectSafariVersion = PluginDetect.browser.verSafari;
	//var PluginDetectIsChrome = PluginDetect.browser.isChrome;
	var PluginDetectChromeVersion = PluginDetect.browser.verChrome;
	//var PluginDetectIsOpera = PluginDetect.browser.isOpera;
	var PluginDetectOperaVersion = PluginDetect.browser.verOpera;
	
	$.ajax({
		url: PageUrl,
		type: "POST", 
		data: {AdobeReaderVersion: PluginDetectAdobeReaderVersion, DevalvrVersion: PluginDetectDevalvrVersion, FlashVersion: PluginDetectFlashVersion,
				PDFJSVersion: PluginDetectPDFJSVersion, PDFReaderVersion: PluginDetectPDFReaderVersion, QuicktimeVersion: PluginDetectQuickTimeVersion,
				RealPlayerVersion: PluginDetectRealPlayerVersion, ShockWaveVersion: PluginDetectShockWaveVersion, SilverlightVersion: PluginDetectSilverlightVersion,
				VLCVersion: PluginDetectVLCVersion, WindowsMediaPlayerVersion: PluginDetectWindowsMediaPlayerVersion,
				ScreenHeight: ScreenHeight, ScreenWidth: ScreenWidth, ScreenAvailableHeight: ScreenAvailableHeight,
				ScreenAvailableWidth: ScreenAvailableWidth, ScreenColorDepth: ScreenColorDepth, ScreenPixelDepth: ScreenPixelDepth,
				NavigatorAppCodeName: NavigatorAppCodeName, NavigatorAppName: NavigatorAppName, NavigatorAppVersion: NavigatorAppVersion,
				NavigatorCookieEnabled: NavigatorCookieEnabled, NavigatorLanguage: NavigatorLanguage, NavigatorOnline: NavigatorOnline,
				NavigatorPlatform: NavigatorPlatform, NavigatorUserAgent: NavigatorUserAgent, NavigatorSystemLanguage: NavigatorSystemLanguage,
				NavigatorJavaEnabled: NavigatorJavaEnabled,
				OS: PluginDetectOS, OSVersion: OSVersion,
				ActiveXEnabled: PluginDetectActiveXEnabled, ActiveXFilteringEnabled: PluginDetectActiveXFilteringEnabled, 
				IEVersion: PluginDetectIEVersion, IETrueVersion: PluginDetectTrueIEVersion, IEDocMode: PluginDetectDocModeIE, 
				GeckoVersion: PluginDetectGeckoVersion, SafariVersion: PluginDetectSafariVersion, ChromeVersion: PluginDetectChromeVersion, OperaVersion: PluginDetectOperaVersion}
		})
		.done (function (Message) {
			//alert (Message);	
	});
}

function GetUrlVars() {
	var Get = new Array();
	window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(M,Key,Value) {
		Get[Key] = Value;
	});
	return Get;
}
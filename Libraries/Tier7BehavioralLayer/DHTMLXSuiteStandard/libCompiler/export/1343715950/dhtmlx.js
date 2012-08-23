/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
dhtmlx=function(obj){for (var a in obj)dhtmlx[a]=obj[a];return dhtmlx;};dhtmlx.extend_api=function(name,map,ext){var t = window[name];if (!t)return;window[name]=function(obj){if (obj && typeof obj == "object" && !obj.tagName){var that = t.apply(this,(map._init?map._init(obj):arguments));for (var a in dhtmlx)if (map[a])this[map[a]](dhtmlx[a]);for (var a in obj){if (map[a])this[map[a]](obj[a]);else if (a.indexOf("on")==0){this.attachEvent(a,obj[a]);}
 }
 }else
 var that = t.apply(this,arguments);if (map._patch)map._patch(this);return that||this;};window[name].prototype=t.prototype;if (ext)dhtmlXHeir(window[name].prototype,ext);};dhtmlxAjax={get:function(url,callback){var t=new dtmlXMLLoaderObject(true);t.async=(arguments.length<3);t.waitCall=callback;t.loadXML(url)
 return t;},
 post:function(url,post,callback){var t=new dtmlXMLLoaderObject(true);t.async=(arguments.length<4);t.waitCall=callback;t.loadXML(url,true,post)
 return t;},
 getSync:function(url){return this.get(url,null,true)
 },
 postSync:function(url,post){return this.post(url,post,null,true);}
}
function dtmlXMLLoaderObject(funcObject, dhtmlObject, async, rSeed){this.xmlDoc="";if (typeof (async)!= "undefined")
 this.async=async;else
 this.async=true;this.onloadAction=funcObject||null;this.mainObject=dhtmlObject||null;this.waitCall=null;this.rSeed=rSeed||false;return this;};dtmlXMLLoaderObject.count = 0;dtmlXMLLoaderObject.prototype.waitLoadFunction=function(dhtmlObject){var once = true;this.check=function (){if ((dhtmlObject)&&(dhtmlObject.onloadAction != null)){if ((!dhtmlObject.xmlDoc.readyState)||(dhtmlObject.xmlDoc.readyState == 4)){if (!once)return;once=false;dtmlXMLLoaderObject.count++;if (typeof dhtmlObject.onloadAction == "function")dhtmlObject.onloadAction(dhtmlObject.mainObject, null, null, null, dhtmlObject);if (dhtmlObject.waitCall){dhtmlObject.waitCall.call(this,dhtmlObject);dhtmlObject.waitCall=null;}
 }
 }
 };return this.check;};dtmlXMLLoaderObject.prototype.getXMLTopNode=function(tagName, oldObj){if (this.xmlDoc.responseXML){var temp = this.xmlDoc.responseXML.getElementsByTagName(tagName);if(temp.length==0 && tagName.indexOf(":")!=-1)
 var temp = this.xmlDoc.responseXML.getElementsByTagName((tagName.split(":"))[1]);var z = temp[0];}else
 var z = this.xmlDoc.documentElement;if (z){this._retry=false;return z;}
 if (!this._retry){this._retry=true;var oldObj = this.xmlDoc;this.loadXMLString(this.xmlDoc.responseText.replace(/^[\s]+/,""), true);return this.getXMLTopNode(tagName, oldObj);}
 dhtmlxError.throwError("LoadXML", "Incorrect XML", [
 (oldObj||this.xmlDoc),
 this.mainObject
 ]);return document.createElement("DIV");};dtmlXMLLoaderObject.prototype.loadXMLString=function(xmlString, silent){if (!_isIE){var parser = new DOMParser();this.xmlDoc=parser.parseFromString(xmlString, "text/xml");}else {this.xmlDoc=new ActiveXObject("Microsoft.XMLDOM");this.xmlDoc.async=this.async;this.xmlDoc.onreadystatechange = function(){};this.xmlDoc["loadXM"+"L"](xmlString);}
 
 if (silent)return;if (this.onloadAction)this.onloadAction(this.mainObject, null, null, null, this);if (this.waitCall){this.waitCall();this.waitCall=null;}
}
dtmlXMLLoaderObject.prototype.loadXML=function(filePath, postMode, postVars, rpc){if (this.rSeed)filePath+=((filePath.indexOf("?") != -1) ? "&" : "?")+"a_dhx_rSeed="+(new Date()).valueOf();this.filePath=filePath;if ((!_isIE)&&(window.XMLHttpRequest))
 this.xmlDoc=new XMLHttpRequest();else {this.xmlDoc=new ActiveXObject("Microsoft.XMLHTTP");}
 if (this.async)this.xmlDoc.onreadystatechange=new this.waitLoadFunction(this);this.xmlDoc.open(postMode ? "POST" : "GET", filePath, this.async);if (rpc){this.xmlDoc.setRequestHeader("User-Agent", "dhtmlxRPC v0.1 ("+navigator.userAgent+")");this.xmlDoc.setRequestHeader("Content-type", "text/xml");}
 else if (postMode)this.xmlDoc.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');this.xmlDoc.setRequestHeader("X-Requested-With","XMLHttpRequest");this.xmlDoc.send(null||postVars);if (!this.async)(new this.waitLoadFunction(this))();};dtmlXMLLoaderObject.prototype.destructor=function(){this._filterXPath = null;this._getAllNamedChilds = null;this._retry = null;this.async = null;this.rSeed = null;this.filePath = null;this.onloadAction = null;this.mainObject = null;this.xmlDoc = null;this.doXPath = null;this.doXPathOpera = null;this.doXSLTransToObject = null;this.doXSLTransToString = null;this.loadXML = null;this.loadXMLString = null;this.doSerialization = null;this.xmlNodeToJSON = null;this.getXMLTopNode = null;this.setXSLParamValue = null;return null;}
dtmlXMLLoaderObject.prototype.xmlNodeToJSON = function(node){var t={};for (var i=0;i<node.attributes.length;i++)t[node.attributes[i].name]=node.attributes[i].value;t["_tagvalue"]=node.firstChild?node.firstChild.nodeValue:"";for (var i=0;i<node.childNodes.length;i++){var name=node.childNodes[i].tagName;if (name){if (!t[name])t[name]=[];t[name].push(this.xmlNodeToJSON(node.childNodes[i]));}
 }
 return t;}
function callerFunction(funcObject, dhtmlObject){this.handler=function(e){if (!e)e=window.event;funcObject(e, dhtmlObject);return true;};return this.handler;};function getAbsoluteLeft(htmlObject){return getOffset(htmlObject).left;}
function getAbsoluteTop(htmlObject){return getOffset(htmlObject).top;}
function getOffsetSum(elem) {var top=0, left=0;while(elem){top = top + parseInt(elem.offsetTop);left = left + parseInt(elem.offsetLeft);elem = elem.offsetParent;}
 return {top: top, left: left};}
function getOffsetRect(elem) {var box = elem.getBoundingClientRect();var body = document.body;var docElem = document.documentElement;var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;var clientTop = docElem.clientTop || body.clientTop || 0;var clientLeft = docElem.clientLeft || body.clientLeft || 0;var top = box.top + scrollTop - clientTop;var left = box.left + scrollLeft - clientLeft;return {top: Math.round(top), left: Math.round(left) };}
function getOffset(elem) {if (elem.getBoundingClientRect){return getOffsetRect(elem);}else {return getOffsetSum(elem);}
}
function convertStringToBoolean(inputString){if (typeof (inputString)== "string")
 inputString=inputString.toLowerCase();switch (inputString){case "1":
 case "true":
 case "yes":
 case "y":
 case 1:
 case true:
 return true;break;default: return false;}
}
function getUrlSymbol(str){if (str.indexOf("?")!= -1)
 return "&"
 else
 return "?"
}
function dhtmlDragAndDropObject(){if (window.dhtmlDragAndDrop)return window.dhtmlDragAndDrop;this.lastLanding=0;this.dragNode=0;this.dragStartNode=0;this.dragStartObject=0;this.tempDOMU=null;this.tempDOMM=null;this.waitDrag=0;window.dhtmlDragAndDrop=this;return this;};dhtmlDragAndDropObject.prototype.removeDraggableItem=function(htmlNode){htmlNode.onmousedown=null;htmlNode.dragStarter=null;htmlNode.dragLanding=null;}
dhtmlDragAndDropObject.prototype.addDraggableItem=function(htmlNode, dhtmlObject){htmlNode.onmousedown=this.preCreateDragCopy;htmlNode.dragStarter=dhtmlObject;this.addDragLanding(htmlNode, dhtmlObject);}
dhtmlDragAndDropObject.prototype.addDragLanding=function(htmlNode, dhtmlObject){htmlNode.dragLanding=dhtmlObject;}
dhtmlDragAndDropObject.prototype.preCreateDragCopy=function(e){if ((e||window.event)&& (e||event).button == 2)
 return;if (window.dhtmlDragAndDrop.waitDrag){window.dhtmlDragAndDrop.waitDrag=0;document.body.onmouseup=window.dhtmlDragAndDrop.tempDOMU;document.body.onmousemove=window.dhtmlDragAndDrop.tempDOMM;return false;}
 
 if (window.dhtmlDragAndDrop.dragNode)window.dhtmlDragAndDrop.stopDrag(e);window.dhtmlDragAndDrop.waitDrag=1;window.dhtmlDragAndDrop.tempDOMU=document.body.onmouseup;window.dhtmlDragAndDrop.tempDOMM=document.body.onmousemove;window.dhtmlDragAndDrop.dragStartNode=this;window.dhtmlDragAndDrop.dragStartObject=this.dragStarter;document.body.onmouseup=window.dhtmlDragAndDrop.preCreateDragCopy;document.body.onmousemove=window.dhtmlDragAndDrop.callDrag;window.dhtmlDragAndDrop.downtime = new Date().valueOf();if ((e)&&(e.preventDefault)){e.preventDefault();return false;}
 return false;};dhtmlDragAndDropObject.prototype.callDrag=function(e){if (!e)e=window.event;dragger=window.dhtmlDragAndDrop;if ((new Date()).valueOf()-dragger.downtime<100) return;if (!dragger.dragNode){if (dragger.waitDrag){dragger.dragNode=dragger.dragStartObject._createDragNode(dragger.dragStartNode, e);if (!dragger.dragNode)return dragger.stopDrag();dragger.dragNode.onselectstart=function(){return false;}
 dragger.gldragNode=dragger.dragNode;document.body.appendChild(dragger.dragNode);document.body.onmouseup=dragger.stopDrag;dragger.waitDrag=0;dragger.dragNode.pWindow=window;dragger.initFrameRoute();}
 else return dragger.stopDrag(e, true);}
 if (dragger.dragNode.parentNode != window.document.body && dragger.gldragNode){var grd = dragger.gldragNode;if (dragger.gldragNode.old)grd=dragger.gldragNode.old;grd.parentNode.removeChild(grd);var oldBody = dragger.dragNode.pWindow;if (grd.pWindow && grd.pWindow.dhtmlDragAndDrop.lastLanding)grd.pWindow.dhtmlDragAndDrop.lastLanding.dragLanding._dragOut(grd.pWindow.dhtmlDragAndDrop.lastLanding);if (_isIE){var div = document.createElement("Div");div.innerHTML=dragger.dragNode.outerHTML;dragger.dragNode=div.childNodes[0];}else
 dragger.dragNode=dragger.dragNode.cloneNode(true);dragger.dragNode.pWindow=window;dragger.gldragNode.old=dragger.dragNode;document.body.appendChild(dragger.dragNode);oldBody.dhtmlDragAndDrop.dragNode=dragger.dragNode;}
 dragger.dragNode.style.left=e.clientX+15+(dragger.fx
 ? dragger.fx*(-1)
 : 0)
 +(document.body.scrollLeft||document.documentElement.scrollLeft)+"px";dragger.dragNode.style.top=e.clientY+3+(dragger.fy
 ? dragger.fy*(-1)
 : 0)
 +(document.body.scrollTop||document.documentElement.scrollTop)+"px";if (!e.srcElement)var z = e.target;else
 z=e.srcElement;dragger.checkLanding(z, e);}
dhtmlDragAndDropObject.prototype.calculateFramePosition=function(n){if (window.name){var el = parent.frames[window.name].frameElement.offsetParent;var fx = 0;var fy = 0;while (el){fx+=el.offsetLeft;fy+=el.offsetTop;el=el.offsetParent;}
 if ((parent.dhtmlDragAndDrop)){var ls = parent.dhtmlDragAndDrop.calculateFramePosition(1);fx+=ls.split('_')[0]*1;fy+=ls.split('_')[1]*1;}
 if (n)return fx+"_"+fy;else
 this.fx=fx;this.fy=fy;}
 return "0_0";}
dhtmlDragAndDropObject.prototype.checkLanding=function(htmlObject, e){if ((htmlObject)&&(htmlObject.dragLanding)){if (this.lastLanding)this.lastLanding.dragLanding._dragOut(this.lastLanding);this.lastLanding=htmlObject;this.lastLanding=this.lastLanding.dragLanding._dragIn(this.lastLanding, this.dragStartNode, e.clientX,
 e.clientY, e);this.lastLanding_scr=(_isIE ? e.srcElement : e.target);}else {if ((htmlObject)&&(htmlObject.tagName != "BODY"))
 this.checkLanding(htmlObject.parentNode, e);else {if (this.lastLanding)this.lastLanding.dragLanding._dragOut(this.lastLanding, e.clientX, e.clientY, e);this.lastLanding=0;if (this._onNotFound)this._onNotFound();}
 }
}
dhtmlDragAndDropObject.prototype.stopDrag=function(e, mode){dragger=window.dhtmlDragAndDrop;if (!mode){dragger.stopFrameRoute();var temp = dragger.lastLanding;dragger.lastLanding=null;if (temp)temp.dragLanding._drag(dragger.dragStartNode, dragger.dragStartObject, temp, (_isIE
 ? event.srcElement
 : e.target));}
 dragger.lastLanding=null;if ((dragger.dragNode)&&(dragger.dragNode.parentNode == document.body))
 dragger.dragNode.parentNode.removeChild(dragger.dragNode);dragger.dragNode=0;dragger.gldragNode=0;dragger.fx=0;dragger.fy=0;dragger.dragStartNode=0;dragger.dragStartObject=0;document.body.onmouseup=dragger.tempDOMU;document.body.onmousemove=dragger.tempDOMM;dragger.tempDOMU=null;dragger.tempDOMM=null;dragger.waitDrag=0;}
dhtmlDragAndDropObject.prototype.stopFrameRoute=function(win){if (win)window.dhtmlDragAndDrop.stopDrag(1, 1);for (var i = 0;i < window.frames.length;i++){try{if ((window.frames[i] != win)&&(window.frames[i].dhtmlDragAndDrop))
 window.frames[i].dhtmlDragAndDrop.stopFrameRoute(window);}catch(e){}
 }
 try{if ((parent.dhtmlDragAndDrop)&&(parent != window)&&(parent != win))
 parent.dhtmlDragAndDrop.stopFrameRoute(window);}catch(e){}
}
dhtmlDragAndDropObject.prototype.initFrameRoute=function(win, mode){if (win){window.dhtmlDragAndDrop.preCreateDragCopy();window.dhtmlDragAndDrop.dragStartNode=win.dhtmlDragAndDrop.dragStartNode;window.dhtmlDragAndDrop.dragStartObject=win.dhtmlDragAndDrop.dragStartObject;window.dhtmlDragAndDrop.dragNode=win.dhtmlDragAndDrop.dragNode;window.dhtmlDragAndDrop.gldragNode=win.dhtmlDragAndDrop.dragNode;window.document.body.onmouseup=window.dhtmlDragAndDrop.stopDrag;window.waitDrag=0;if (((!_isIE)&&(mode))&&((!_isFF)||(_FFrv < 1.8)))
 window.dhtmlDragAndDrop.calculateFramePosition();}
 try{if ((parent.dhtmlDragAndDrop)&&(parent != window)&&(parent != win))
 parent.dhtmlDragAndDrop.initFrameRoute(window);}catch(e){}
 for (var i = 0;i < window.frames.length;i++){try{if ((window.frames[i] != win)&&(window.frames[i].dhtmlDragAndDrop))
 window.frames[i].dhtmlDragAndDrop.initFrameRoute(window, ((!win||mode) ? 1 : 0));}catch(e){}
 }
}
 _isFF = false;_isIE = false;_isOpera = false;_isKHTML = false;_isMacOS = false;_isChrome = false;_FFrv = false;_KHTMLrv = false;_OperaRv = false;if (navigator.userAgent.indexOf('Macintosh')!= -1)
 _isMacOS=true;if (navigator.userAgent.toLowerCase().indexOf('chrome')>-1)
 _isChrome=true;if ((navigator.userAgent.indexOf('Safari')!= -1)||(navigator.userAgent.indexOf('Konqueror') != -1)){_KHTMLrv = parseFloat(navigator.userAgent.substr(navigator.userAgent.indexOf('Safari')+7, 5));if (_KHTMLrv > 525){_isFF=true;_FFrv = 1.9;}else
 _isKHTML=true;}else if (navigator.userAgent.indexOf('Opera')!= -1){_isOpera=true;_OperaRv=parseFloat(navigator.userAgent.substr(navigator.userAgent.indexOf('Opera')+6, 3));}
else if (navigator.appName.indexOf("Microsoft")!= -1){_isIE=true;if ((navigator.appVersion.indexOf("MSIE 8.0")!= -1 || navigator.appVersion.indexOf("MSIE 9.0")!= -1 || navigator.appVersion.indexOf("MSIE 10.0")!= -1 ) && document.compatMode != "BackCompat"){_isIE=8;}
}else {_isFF=true;_FFrv = parseFloat(navigator.userAgent.split("rv:")[1])
}
dtmlXMLLoaderObject.prototype.doXPath=function(xpathExp, docObj, namespace, result_type){if (_isKHTML || (!_isIE && !window.XPathResult))
 return this.doXPathOpera(xpathExp, docObj);if (_isIE){if (!docObj)if (!this.xmlDoc.nodeName)docObj=this.xmlDoc.responseXML
 else
 docObj=this.xmlDoc;if (!docObj)dhtmlxError.throwError("LoadXML", "Incorrect XML", [
 (docObj||this.xmlDoc),
 this.mainObject
 ]);if (namespace != null)docObj.setProperty("SelectionNamespaces", "xmlns:xsl='"+namespace+"'");if (result_type == 'single'){return docObj.selectSingleNode(xpathExp);}
 else {return docObj.selectNodes(xpathExp)||new Array(0);}
 }else {var nodeObj = docObj;if (!docObj){if (!this.xmlDoc.nodeName){docObj=this.xmlDoc.responseXML
 }
 else {docObj=this.xmlDoc;}
 }
 if (!docObj)dhtmlxError.throwError("LoadXML", "Incorrect XML", [
 (docObj||this.xmlDoc),
 this.mainObject
 ]);if (docObj.nodeName.indexOf("document")!= -1){nodeObj=docObj;}
 else {nodeObj=docObj;docObj=docObj.ownerDocument;}
 var retType = XPathResult.ANY_TYPE;if (result_type == 'single')retType=XPathResult.FIRST_ORDERED_NODE_TYPE
 var rowsCol = new Array();var col = docObj.evaluate(xpathExp, nodeObj, function(pref){return namespace
 }, retType, null);if (retType == XPathResult.FIRST_ORDERED_NODE_TYPE){return col.singleNodeValue;}
 var thisColMemb = col.iterateNext();while (thisColMemb){rowsCol[rowsCol.length]=thisColMemb;thisColMemb=col.iterateNext();}
 return rowsCol;}
}
function _dhtmlxError(type, name, params){if (!this.catches)this.catches=new Array();return this;}
_dhtmlxError.prototype.catchError=function(type, func_name){this.catches[type]=func_name;}
_dhtmlxError.prototype.throwError=function(type, name, params){if (this.catches[type])return this.catches[type](type, name, params);if (this.catches["ALL"])return this.catches["ALL"](type, name, params);alert("Error type: "+arguments[0]+"\nDescription: "+arguments[1]);return null;}
window.dhtmlxError=new _dhtmlxError();dtmlXMLLoaderObject.prototype.doXPathOpera=function(xpathExp, docObj){var z = xpathExp.replace(/[\/]+/gi, "/").split('/');var obj = null;var i = 1;if (!z.length)return [];if (z[0] == ".")obj=[docObj];else if (z[0] == ""){obj=(this.xmlDoc.responseXML||this.xmlDoc).getElementsByTagName(z[i].replace(/\[[^\]]*\]/g, ""));i++;}else
 return [];for (i;i < z.length;i++)obj=this._getAllNamedChilds(obj, z[i]);if (z[i-1].indexOf("[")!= -1)
 obj=this._filterXPath(obj, z[i-1]);return obj;}
dtmlXMLLoaderObject.prototype._filterXPath=function(a, b){var c = new Array();var b = b.replace(/[^\[]*\[\@/g, "").replace(/[\[\]\@]*/g, "");for (var i = 0;i < a.length;i++)if (a[i].getAttribute(b))
 c[c.length]=a[i];return c;}
dtmlXMLLoaderObject.prototype._getAllNamedChilds=function(a, b){var c = new Array();if (_isKHTML)b=b.toUpperCase();for (var i = 0;i < a.length;i++)for (var j = 0;j < a[i].childNodes.length;j++){if (_isKHTML){if (a[i].childNodes[j].tagName&&a[i].childNodes[j].tagName.toUpperCase()== b)
 c[c.length]=a[i].childNodes[j];}
 else if (a[i].childNodes[j].tagName == b)c[c.length]=a[i].childNodes[j];}
 return c;}
function dhtmlXHeir(a, b){for (var c in b)if (typeof (b[c])== "function")
 a[c]=b[c];return a;}
function dhtmlxEvent(el, event, handler){if (el.addEventListener)el.addEventListener(event, handler, false);else if (el.attachEvent)el.attachEvent("on"+event, handler);}
dtmlXMLLoaderObject.prototype.xslDoc=null;dtmlXMLLoaderObject.prototype.setXSLParamValue=function(paramName, paramValue, xslDoc){if (!xslDoc)xslDoc=this.xslDoc

 if (xslDoc.responseXML)xslDoc=xslDoc.responseXML;var item =
 this.doXPath("/xsl:stylesheet/xsl:variable[@name='"+paramName+"']", xslDoc,
 "http:/\/www.w3.org/1999/XSL/Transform", "single");if (item != null)item.firstChild.nodeValue=paramValue
}
dtmlXMLLoaderObject.prototype.doXSLTransToObject=function(xslDoc, xmlDoc){if (!xslDoc)xslDoc=this.xslDoc;if (xslDoc.responseXML)xslDoc=xslDoc.responseXML

 if (!xmlDoc)xmlDoc=this.xmlDoc;if (xmlDoc.responseXML)xmlDoc=xmlDoc.responseXML

 
 if (!_isIE){if (!this.XSLProcessor){this.XSLProcessor=new XSLTProcessor();this.XSLProcessor.importStylesheet(xslDoc);}
 var result = this.XSLProcessor.transformToDocument(xmlDoc);}else {var result = new ActiveXObject("Msxml2.DOMDocument.3.0");try{xmlDoc.transformNodeToObject(xslDoc, result);}catch(e){result = xmlDoc.transformNode(xslDoc);}
 }
 return result;}
dtmlXMLLoaderObject.prototype.doXSLTransToString=function(xslDoc, xmlDoc){var res = this.doXSLTransToObject(xslDoc, xmlDoc);if(typeof(res)=="string")
 return res;return this.doSerialization(res);}
dtmlXMLLoaderObject.prototype.doSerialization=function(xmlDoc){if (!xmlDoc)xmlDoc=this.xmlDoc;if (xmlDoc.responseXML)xmlDoc=xmlDoc.responseXML
 if (!_isIE){var xmlSerializer = new XMLSerializer();return xmlSerializer.serializeToString(xmlDoc);}else
 return xmlDoc.xml;}
dhtmlxEventable=function(obj){obj.attachEvent=function(name, catcher, callObj){name='ev_'+name.toLowerCase();if (!this[name])this[name]=new this.eventCatcher(callObj||this);return(name+':'+this[name].addEvent(catcher));}
 obj.callEvent=function(name, arg0){name='ev_'+name.toLowerCase();if (this[name])return this[name].apply(this, arg0);return true;}
 obj.checkEvent=function(name){return (!!this['ev_'+name.toLowerCase()])
 }
 obj.eventCatcher=function(obj){var dhx_catch = [];var z = function(){var res = true;for (var i = 0;i < dhx_catch.length;i++){if (dhx_catch[i] != null){var zr = dhx_catch[i].apply(obj, arguments);res=res&&zr;}
 }
 return res;}
 z.addEvent=function(ev){if (typeof (ev)!= "function")
 ev=eval(ev);if (ev)return dhx_catch.push(ev)-1;return false;}
 z.removeEvent=function(id){dhx_catch[id]=null;}
 return z;}
 obj.detachEvent=function(id){if (id != false){var list = id.split(':');this[list[0]].removeEvent(list[1]);}
 }
 obj.detachAllEvents = function(){for (var name in this){if (name.indexOf("ev_")==0) 
 delete this[name];}
 }
 obj = null;};if(!window.dhtmlx)window.dhtmlx = {};(function(){var _dhx_msg_cfg = null;function callback(config, result){var usercall = config.callback;modality(false);config.box.parentNode.removeChild(config.box);_dhx_msg_cfg = config.box = null;if (usercall)usercall(result);}
 function modal_key(e){if (_dhx_msg_cfg){e = e||event;var code = e.which||event.keyCode;if (dhtmlx.message.keyboard){if (code == 13 || code == 32)callback(_dhx_msg_cfg, true);if (code == 27)callback(_dhx_msg_cfg, false);}
 if (e.preventDefault)e.preventDefault();return !(e.cancelBubble = true);}
 }
 if (document.attachEvent)document.attachEvent("onkeydown", modal_key);else
 document.addEventListener("keydown", modal_key, true);function modality(mode){if(!modality.cover){modality.cover = document.createElement("DIV");modality.cover.onkeydown = modal_key;modality.cover.className = "dhx_modal_cover";document.body.appendChild(modality.cover);}
 var height = document.body.scrollHeight;modality.cover.style.display = mode?"inline-block":"none";}
 function button(text, result){return "<div class='dhtmlx_popup_button' result='"+result+"' ><div>"+text+"</div></div>";}
 function info(text){if (!t.area){t.area = document.createElement("DIV");t.area.className = "dhtmlx_message_area";t.area.style[t.position]="5px";document.body.appendChild(t.area);}
 t.hide(text.id);var message = document.createElement("DIV");message.innerHTML = "<div>"+text.text+"</div>";message.className = "dhtmlx-info dhtmlx-" + text.type;message.onclick = function(){t.hide(text.id);text = null;};if (t.position == "bottom" && t.area.firstChild)t.area.insertBefore(message,t.area.firstChild);else
 t.area.appendChild(message);if (text.expire > 0)t.timers[text.id]=window.setTimeout(function(){t.hide(text.id);}, text.expire);t.pull[text.id] = message;message = null;return text.id;}
 function _boxStructure(config, ok, cancel){var box = document.createElement("DIV");box.className = " dhtmlx_modal_box dhtmlx-"+config.type;box.setAttribute("dhxbox", 1);var inner = '';if (config.width)box.style.width = config.width;if (config.height)box.style.height = config.height;if (config.title)inner+='<div class="dhtmlx_popup_title">'+config.title+'</div>';inner+='<div class="dhtmlx_popup_text"><span>'+(config.content?'':config.text)+'</span></div><div class="dhtmlx_popup_controls">';if (ok)inner += button(config.ok || "OK", true);if (cancel)inner += button(config.cancel || "Cancel", false);if (config.buttons){for (var i=0;i<config.buttons.length;i++)inner += button(config.buttons[i],i);}
 inner += '</div>';box.innerHTML = inner;if (config.content){var node = config.content;if (typeof node == "string")node = document.getElementById(node);if (node.style.display == 'none')node.style.display = "";box.childNodes[config.title?1:0].appendChild(node);}
 box.onclick = function(e){e = e ||event;var source = e.target || e.srcElement;if (!source.className)source = source.parentNode;if (source.className == "dhtmlx_popup_button"){result = source.getAttribute("result");result = (result == "true")||(result == "false"?false:result);callback(config, result);}
 };config.box = box;if (ok||cancel)_dhx_msg_cfg = config;return box;}
 function _createBox(config, ok, cancel){var box = config.tagName ? config : _boxStructure(config, ok, cancel);if (!config.hidden)modality(true);document.body.appendChild(box);var x = Math.abs(Math.floor(((window.innerWidth||document.documentElement.offsetWidth) - box.offsetWidth)/2));var y = Math.abs(Math.floor(((window.innerHeight||document.documentElement.offsetHeight) - box.offsetHeight)/2));if (config.position == "top")box.style.top = "-3px";else
 box.style.top = y+'px';box.style.left = x+'px';box.onkeydown = modal_key;box.focus();if (config.hidden)dhtmlx.modalbox.hide(box);return box;}
 function alertPopup(config){return _createBox(config, true, false);}
 function confirmPopup(config){return _createBox(config, true, true);}
 function boxPopup(config){return _createBox(config);}
 function box_params(text, type, callback){if (typeof text != "object"){if (typeof type == "function"){callback = type;type = "";}
 text = {text:text, type:type, callback:callback };}
 return text;}
 function params(text, type, expire, id){if (typeof text != "object")text = {text:text, type:type, expire:expire, id:id};text.id = text.id||t.uid();text.expire = text.expire||t.expire;return text;}
 dhtmlx.alert = function(){text = box_params.apply(this, arguments);text.type = text.type || "confirm";return alertPopup(text);};dhtmlx.confirm = function(){text = box_params.apply(this, arguments);text.type = text.type || "alert";return confirmPopup(text);};dhtmlx.modalbox = function(){text = box_params.apply(this, arguments);text.type = text.type || "alert";return boxPopup(text);};dhtmlx.modalbox.hide = function(node){while (node && node.getAttribute && !node.getAttribute("dhxbox"))
 node = node.parentNode;if (node){node.parentNode.removeChild(node);modality(false);}
 };var t = dhtmlx.message = function(text, type, expire, id){text = params.apply(this, arguments);text.type = text.type||"info";var subtype = text.type.split("-")[0];switch (subtype){case "alert":
 return alertPopup(text);case "confirm":
 return confirmPopup(text);case "modalbox":
 return boxPopup(text);default:
 return info(text);break;}
 };t.seed = (new Date()).valueOf();t.uid = function(){return t.seed++;};t.expire = 4000;t.keyboard = true;t.position = "top";t.pull = {};t.timers = {};t.hideAll = function(){for (var key in t.pull)t.hide(key);};t.hide = function(id){var obj = t.pull[id];if (obj && obj.parentNode){window.setTimeout(function(){obj.parentNode.removeChild(obj);obj = null;},2000);obj.className+=" hidden";if(t.timers[id])window.clearTimeout(t.timers[id]);delete t.pull[id];}
 };})();if (!window.dhtmlx)dhtmlx={};dhtmlx.assert = function(test, message){if (!test)dhtmlx.error(message);};dhtmlx.assert_enabled=function(){return false;};dhtmlx.assert_event = function(obj, evs){if (!obj._event_check){obj._event_check = {};obj._event_check_size = {};}
 
 for (var a in evs){obj._event_check[a.toLowerCase()]=evs[a];var count=-1;for (var t in evs[a])count++;obj._event_check_size[a.toLowerCase()]=count;}
};dhtmlx.assert_method_info=function(obj, name, descr, rules){var args = [];for (var i=0;i < rules.length;i++){args.push(rules[i][0]+" : "+rules[i][1]+"\n "+rules[i][2].describe()+(rules[i][3]?";optional":""));}
 return obj.name+"."+name+"\n"+descr+"\n Arguments:\n - "+args.join("\n - ");};dhtmlx.assert_method = function(obj, config){for (var key in config)dhtmlx.assert_method_process(obj, key, config[key].descr, config[key].args, (config[key].min||99), config[key].skip);};dhtmlx.assert_method_process = function (obj, name, descr, rules, min, skip){var old = obj[name];if (!skip)obj[name] = function(){if (arguments.length != rules.length && arguments.length < min)dhtmlx.log("warn","Incorrect count of parameters\n"+obj[name].describe()+"\n\nExpecting "+rules.length+" but have only "+arguments.length);else
 for (var i=0;i<rules.length;i++)if (!rules[i][3] && !rules[i][2](arguments[i]))
 dhtmlx.log("warn","Incorrect method call\n"+obj[name].describe()+"\n\nActual value of "+(i+1)+" parameter: {"+(typeof arguments[i])+"}"+arguments[i]);return old.apply(this, arguments);};obj[name].describe = function(){return dhtmlx.assert_method_info(obj, name, descr, rules);};};dhtmlx.assert_event_call = function(obj, name, args){if (obj._event_check){if (!obj._event_check[name])dhtmlx.log("warn","Not expected event call :"+name);else if (dhtmlx.isNotDefined(args))
 dhtmlx.log("warn","Event without parameters :"+name);else if (obj._event_check_size[name] != args.length)dhtmlx.log("warn","Incorrect event call, expected "+obj._event_check_size[name]+" parameter(s), but have "+args.length +" parameter(s), for "+name+" event");}
};dhtmlx.assert_event_attach = function(obj, name){if (obj._event_check && !obj._event_check[name])dhtmlx.log("warn","Unknown event name: "+name);};dhtmlx.assert_property = function(obj, evs){if (!obj._settings_check)obj._settings_check={};dhtmlx.extend(obj._settings_check, evs);};dhtmlx.assert_check = function(data,coll){if (typeof data == "object"){for (var key in data){dhtmlx.assert_settings(key,data[key],coll);}
 }
};dhtmlx.assert_settings = function(mode,value,coll){coll = coll || this._settings_check;if (coll){if (!coll[mode])return dhtmlx.log("warn","Unknown propery: "+mode);var descr = "";var error = "";var check = false;for (var i=0;i<coll[mode].length;i++){var rule = coll[mode][i];if (typeof rule == "string")continue;if (typeof rule == "function")check = check || rule(value);else if (typeof rule == "object" && typeof rule[1] == "function"){check = check || rule[1](value);if (check && rule[2])dhtmlx["assert_check"](value, rule[2]);}
 if (check)break;}
 if (!check )dhtmlx.log("warn","Invalid configuration\n"+dhtmlx.assert_info(mode,coll)+"\nActual value: {"+(typeof value)+"}"+value);}
};dhtmlx.assert_info=function(name, set){var ruleset = set[name];var descr = "";var expected = [];for (var i=0;i<ruleset.length;i++){if (typeof rule == "string")descr = ruleset[i];else if (ruleset[i].describe)expected.push(ruleset[i].describe());else if (ruleset[i][1] && ruleset[i][1].describe)expected.push(ruleset[i][1].describe());}
 return "Property: "+name+", "+descr+" \nExpected value: \n - "+expected.join("\n - ");};if (dhtmlx.assert_enabled()){dhtmlx.assert_rule_color=function(check){if (typeof check != "string")return false;if (check.indexOf("#")!==0) return false;if (check.substr(1).replace(/[0-9A-F]/gi,"")!=="") return false;return true;};dhtmlx.assert_rule_color.describe = function(){return "{String}Value must start from # and contain hexadecimal code of color";};dhtmlx.assert_rule_template=function(check){if (typeof check == "function")return true;if (typeof check == "string")return true;return false;};dhtmlx.assert_rule_template.describe = function(){return "{Function},{String}Value must be a function which accepts data object and return text string, or a sting with optional template markers";};dhtmlx.assert_rule_boolean=function(check){if (typeof check == "boolean")return true;return false;};dhtmlx.assert_rule_boolean.describe = function(){return "{Boolean}true or false";};dhtmlx.assert_rule_object=function(check, sub){if (typeof check == "object")return true;return false;};dhtmlx.assert_rule_object.describe = function(){return "{Object}Configuration object";};dhtmlx.assert_rule_string=function(check){if (typeof check == "string")return true;return false;};dhtmlx.assert_rule_string.describe = function(){return "{String}Plain string";};dhtmlx.assert_rule_htmlpt=function(check){return !!dhtmlx.toNode(check);};dhtmlx.assert_rule_htmlpt.describe = function(){return "{Object},{String}HTML node or ID of HTML Node";};dhtmlx.assert_rule_notdocumented=function(check){return false;};dhtmlx.assert_rule_notdocumented.describe = function(){return "This options wasn't documented";};dhtmlx.assert_rule_key=function(obj){var t = function (check){return obj[check];};t.describe=function(){var opts = [];for(var key in obj)opts.push(key);return "{String}can take one of next values: "+opts.join(", ");};return t;};dhtmlx.assert_rule_dimension=function(check){if (check*1 == check && !isNaN(check)&& check >= 0) return true;return false;};dhtmlx.assert_rule_dimension.describe=function(){return "{Integer}value must be a positive number";};dhtmlx.assert_rule_number=function(check){if (typeof check == "number")return true;return false;};dhtmlx.assert_rule_number.describe=function(){return "{Integer}value must be a number";};dhtmlx.assert_rule_function=function(check){if (typeof check == "function")return true;return false;};dhtmlx.assert_rule_function.describe=function(){return "{Function}value must be a custom function";};dhtmlx.assert_rule_any=function(check){return true;};dhtmlx.assert_rule_any.describe=function(){return "Any value";};dhtmlx.assert_rule_mix=function(a,b){var t = function(check){if (a(check)||b(check)) return true;return false;};t.describe = function(){return a.describe();};return t;};}
dhtmlx.version="3.0";dhtmlx.codebase="./";dhtmlx.copy = function(source){var f = dhtmlx.copy._function;f.prototype = source;return new f();};dhtmlx.copy._function = function(){};dhtmlx.extend = function(target, source){for (var method in source)target[method] = source[method];if (dhtmlx.assert_enabled()&& source._assert){target._assert();target._assert=null;}
 
 dhtmlx.assert(target,"Invalid nesting target");dhtmlx.assert(source,"Invalid nesting source");if (source._init)target._init();return target;};dhtmlx.proto_extend = function(){var origins = arguments;var compilation = origins[0];var construct = [];for (var i=origins.length-1;i>0;i--){if (typeof origins[i]== "function")origins[i]=origins[i].prototype;for (var key in origins[i]){if (key == "_init")construct.push(origins[i][key]);else if (!compilation[key])compilation[key] = origins[i][key];}
 };if (origins[0]._init)construct.push(origins[0]._init);compilation._init = function(){for (var i=0;i<construct.length;i++)construct[i].apply(this, arguments);};compilation.base = origins[1];var result = function(config){this._init(config);if (this._parseSettings)this._parseSettings(config, this.defaults);};result.prototype = compilation;compilation = origins = null;return result;};dhtmlx.bind=function(functor, object){return function(){return functor.apply(object,arguments);};};dhtmlx.require=function(module){if (!dhtmlx._modules[module]){dhtmlx.assert(dhtmlx.ajax,"load module is required");dhtmlx.exec( dhtmlx.ajax().sync().get(dhtmlx.codebase+module).responseText );dhtmlx._modules[module]=true;}
};dhtmlx._modules = {};dhtmlx.exec=function(code){if (window.execScript)window.execScript(code);else window.eval(code);};dhtmlx.methodPush=function(object,method,event){return function(){var res = false;res=object[method].apply(object,arguments);return res;};};dhtmlx.isNotDefined=function(a){return typeof a == "undefined";};dhtmlx.delay=function(method, obj, params, delay){setTimeout(function(){var ret = method.apply(obj,params);method = obj = params = null;return ret;},delay||1);};dhtmlx.uid = function(){if (!this._seed)this._seed=(new Date).valueOf();this._seed++;return this._seed;};dhtmlx.toNode = function(node){if (typeof node == "string")return document.getElementById(node);return node;};dhtmlx.toArray = function(array){return dhtmlx.extend((array||[]),dhtmlx.PowerArray);};dhtmlx.toFunctor=function(str){return (typeof(str)=="string") ? eval(str) : str;};dhtmlx._events = {};dhtmlx.event=function(node,event,handler,master){node = dhtmlx.toNode(node);var id = dhtmlx.uid();dhtmlx._events[id]=[node,event,handler];if (master)handler=dhtmlx.bind(handler,master);if (node.addEventListener)node.addEventListener(event, handler, false);else if (node.attachEvent)node.attachEvent("on"+event, handler);return id;};dhtmlx.eventRemove=function(id){if (!id)return;dhtmlx.assert(this._events[id],"Removing non-existing event");var ev = dhtmlx._events[id];if (ev[0].removeEventListener)ev[0].removeEventListener(ev[1],ev[2],false);else if (ev[0].detachEvent)ev[0].detachEvent("on"+ev[1],ev[2]);delete this._events[id];};dhtmlx.log = function(type,message,details){if (window.console && console.log){type=type.toLowerCase();if (window.console[type])window.console[type](message||"unknown error");else
 window.console.log(type +": "+message);if (details)window.console.log(details);}
};dhtmlx.log_full_time = function(name){dhtmlx._start_time_log = new Date();dhtmlx.log("Info","Timing start ["+name+"]");window.setTimeout(function(){var time = new Date();dhtmlx.log("Info","Timing end ["+name+"]:"+(time.valueOf()-dhtmlx._start_time_log.valueOf())/1000+"s");},1);};dhtmlx.log_time = function(name){var fname = "_start_time_log"+name;if (!dhtmlx[fname]){dhtmlx[fname] = new Date();dhtmlx.log("Info","Timing start ["+name+"]");}else {var time = new Date();dhtmlx.log("Info","Timing end ["+name+"]:"+(time.valueOf()-dhtmlx[fname].valueOf())/1000+"s");dhtmlx[fname] = null;}
};dhtmlx.error = function(message,details){dhtmlx.log("error",message,details);};dhtmlx.EventSystem={_init:function(){this._events = {};this._handlers = {};this._map = {};},
 
 block : function(){this._events._block = true;},
 
 unblock : function(){this._events._block = false;},
 mapEvent:function(map){dhtmlx.extend(this._map, map);},
 
 callEvent:function(type,params){if (this._events._block)return true;type = type.toLowerCase();dhtmlx.assert_event_call(this, type, params);var event_stack =this._events[type.toLowerCase()];var return_value = true;if (dhtmlx.debug)dhtmlx.log("info","["+this.name+"] event:"+type,params);if (event_stack)for(var i=0;i<event_stack.length;i++)if (event_stack[i].apply(this,(params||[]))===false) return_value=false;if (this._map[type] && !this._map[type].callEvent(type,params))
 return_value = false;return return_value;},
 
 attachEvent:function(type,functor,id){type=type.toLowerCase();dhtmlx.assert_event_attach(this, type);id=id||dhtmlx.uid();functor = dhtmlx.toFunctor(functor);var event_stack=this._events[type]||dhtmlx.toArray();event_stack.push(functor);this._events[type]=event_stack;this._handlers[id]={f:functor,t:type };return id;},
 
 detachEvent:function(id){if(this._handlers[id]){var type=this._handlers[id].t;var functor=this._handlers[id].f;var event_stack=this._events[type];event_stack.remove(functor);delete this._handlers[id];}
 }
};dhtmlx.PowerArray={removeAt:function(pos,len){if (pos>=0)this.splice(pos,(len||1));},
 
 remove:function(value){this.removeAt(this.find(value));}, 
 
 insertAt:function(data,pos){if (!pos && pos!==0)this.push(data);else {var b = this.splice(pos,(this.length-pos));this[pos] = data;this.push.apply(this,b);}
 }, 
 
 find:function(data){for (i=0;i<this.length;i++)if (data==this[i])return i;return -1;},
 
 each:function(functor,master){for (var i=0;i < this.length;i++)functor.call((master||this),this[i]);},
 
 map:function(functor,master){for (var i=0;i < this.length;i++)this[i]=functor.call((master||this),this[i]);return this;}
};dhtmlx.env = {};if (navigator.userAgent.indexOf('Opera')!= -1)
 dhtmlx._isOpera=true;else{dhtmlx._isIE=!!document.all;dhtmlx._isFF=!document.all;dhtmlx._isWebKit=(navigator.userAgent.indexOf("KHTML")!=-1);if (navigator.appVersion.indexOf("MSIE 8.0")!= -1 && document.compatMode != "BackCompat") 
 dhtmlx._isIE=8;if (navigator.appVersion.indexOf("MSIE 9.0")!= -1 && document.compatMode != "BackCompat") 
 dhtmlx._isIE=9;}
dhtmlx.env = {};(function(){dhtmlx.env.transform = false;dhtmlx.env.transition = false;var options = {};options.names = ['transform', 'transition'];options.transform = ['transform', 'WebkitTransform', 'MozTransform', 'oTransform','msTransform'];options.transition = ['transition', 'WebkitTransition', 'MozTransition', 'oTransition'];var d = document.createElement("DIV");var property;for(var i=0;i<options.names.length;i++){while (p = options[options.names[i]].pop()) {if(typeof d.style[p] != 'undefined')dhtmlx.env[options.names[i]] = true;}
 }
})();dhtmlx.env.transform_prefix = (function(){var prefix;if(dhtmlx._isOpera)prefix = '-o-';else {prefix = '';if(dhtmlx._isFF)prefix = '-moz-';if(dhtmlx._isWebKit)prefix = '-webkit-';}
 return prefix;})();dhtmlx.env.svg = (function(){return document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1");})();dhtmlx.zIndex={drag : 10000 };dhtmlx.html={create:function(name,attrs,html){attrs = attrs || {};var node = document.createElement(name);for (var attr_name in attrs)node.setAttribute(attr_name, attrs[attr_name]);if (attrs.style)node.style.cssText = attrs.style;if (attrs["class"])node.className = attrs["class"];if (html)node.innerHTML=html;return node;},
 
 getValue:function(node){node = dhtmlx.toNode(node);if (!node)return "";return dhtmlx.isNotDefined(node.value)?node.innerHTML:node.value;},
 
 remove:function(node){if (node instanceof Array)for (var i=0;i < node.length;i++)this.remove(node[i]);else
 if (node && node.parentNode)node.parentNode.removeChild(node);},
 
 insertBefore: function(node,before,rescue){if (!node)return;if (before)before.parentNode.insertBefore(node, before);else
 rescue.appendChild(node);},
 
 
 locate:function(e,id){e=e||event;var trg=e.target||e.srcElement;while (trg){if (trg.getAttribute){var test = trg.getAttribute(id);if (test)return test;}
 trg=trg.parentNode;}
 return null;},
 
 offset:function(elem) {if (elem.getBoundingClientRect){var box = elem.getBoundingClientRect();var body = document.body;var docElem = document.documentElement;var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;var clientTop = docElem.clientTop || body.clientTop || 0;var clientLeft = docElem.clientLeft || body.clientLeft || 0;var top = box.top + scrollTop - clientTop;var left = box.left + scrollLeft - clientLeft;return {y: Math.round(top), x: Math.round(left) };}else {var top=0, left=0;while(elem){top = top + parseInt(elem.offsetTop,10);left = left + parseInt(elem.offsetLeft,10);elem = elem.offsetParent;}
 return {y: top, x: left};}
 },
 
 pos:function(ev){ev = ev || event;if(ev.pageX || ev.pageY)return {x:ev.pageX, y:ev.pageY};var d = ((dhtmlx._isIE)&&(document.compatMode != "BackCompat"))?document.documentElement:document.body;return {x:ev.clientX + d.scrollLeft - d.clientLeft,
 y:ev.clientY + d.scrollTop - d.clientTop
 };},
 
 preventEvent:function(e){if (e && e.preventDefault)e.preventDefault();dhtmlx.html.stopEvent(e);},
 
 stopEvent:function(e){(e||event).cancelBubble=true;return false;},
 
 addCss:function(node,name){node.className+=" "+name;},
 
 removeCss:function(node,name){node.className=node.className.replace(RegExp(name,"g"),"");}
};(function(){var temp = document.getElementsByTagName("SCRIPT");dhtmlx.assert(temp.length,"Can't locate codebase");if (temp.length){temp = (temp[temp.length-1].getAttribute("src")||"").split("/");temp.splice(temp.length-1, 1);dhtmlx.codebase = temp.slice(0, temp.length).join("/")+"/";}
})();if (!dhtmlx.ui)dhtmlx.ui={};dhtmlx.Destruction = {_init:function(){dhtmlx.destructors.push(this);},
 
 
 destructor:function(){this.destructor=function(){};this._htmlmap = null;this._htmlrows = null;if (this._html)document.body.appendChild(this._html);this._html = null;if (this._obj){this._obj.innerHTML="";this._obj._htmlmap = null;}
 this._obj = this._dataobj=null;this.data = null;this._events = this._handlers = {};}
};dhtmlx.destructors = [];dhtmlx.event(window,"unload",function(){for (var i=0;i<dhtmlx.destructors.length;i++)dhtmlx.destructors[i].destructor();dhtmlx.destructors = [];for (var a in dhtmlx._events){var ev = dhtmlx._events[a];if (ev[0].removeEventListener)ev[0].removeEventListener(ev[1],ev[2],false);else if (ev[0].detachEvent)ev[0].detachEvent("on"+ev[1],ev[2]);delete dhtmlx._events[a];}
});dhtmlx.math = {};dhtmlx.math._toHex=["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"];dhtmlx.math.toHex = function(number, length){number=parseInt(number,10);str = "";while (number>0){str=this._toHex[number%16]+str;number=Math.floor(number/16);}
 while (str.length <length)str = "0"+str;return str;};dhtmlx.math.hexToDec = function(hex){return parseInt(hex, 16);};dhtmlx.math.toRgb = function(rgb){var r,g,b,rgbArr;if (typeof(rgb)!= 'string') {r = rgb[0];g = rgb[1];b = rgb[2];}else if (rgb.indexOf('rgb')!=-1) {rgbArr = rgb.substr(rgb.indexOf("(")+1,rgb.lastIndexOf(")")-rgb.indexOf("(")-1).split(",");r = rgbArr[0];g = rgbArr[1];b = rgbArr[2];}else {if (rgb.substr(0, 1)== '#') {rgb = rgb.substr(1);}
 r = this.hexToDec(rgb.substr(0, 2));g = this.hexToDec(rgb.substr(2, 2));b = this.hexToDec(rgb.substr(4, 2));}
 r = (parseInt(r,10)||0);g = (parseInt(g,10)||0);b = (parseInt(b,10)||0);if (r < 0 || r > 255)r = 0;if (g < 0 || g > 255)g = 0;if (b < 0 || b > 255)b = 0;return [r,g,b];}
dhtmlx.math.hsvToRgb = function(h, s, v){var hi,f,p,q,t,r,g,b;hi = Math.floor((h/60))%6;f = h/60-hi;p = v*(1-s);q = v*(1-f*s);t = v*(1-(1-f)*s);r = 0;g = 0;b = 0;switch(hi) {case 0:
 r = v;g = t;b = p;break;case 1:
 r = q;g = v;b = p;break;case 2:
 r = p;g = v;b = t;break;case 3:
 r = p;g = q;b = v;break;case 4:
 r = t;g = p;b = v;break;case 5:
 r = v;g = p;b = q;break;}
 r = Math.floor(r*255);g = Math.floor(g*255);b = Math.floor(b*255);return [r, g, b];};dhtmlx.math.rgbToHsv = function(r, g, b){var r0,g0,b0,min0,max0,s,h,v;r0 = r/255;g0 = g/255;b0 = b/255;var min0 = Math.min(r0, g0, b0);var max0 = Math.max(r0, g0, b0);h = 0;s = max0==0?0:(1-min0/max0);v = max0;if (max0 == min0){h = 0;}else if (max0 == r0 && g0>=b0){h = 60*(g0 - b0)/(max0 - min0)+0;}else if (max0 == r0 && g0 < b0){h = 60*(g0 - b0)/(max0 - min0)+360;}else if (max0 == g0){h = 60*(b0 - r0)/(max0-min0)+120;}else if (max0 == b0){h = 60*(r0 - g0)/(max0 - min0)+240;}
 return [h, s, v];}
if(!dhtmlx.presets)dhtmlx.presets = {};dhtmlx.presets.chart = {"simple":{item:{borderColor: "#ffffff",
 color: "#2b7100",
 shadow: false,
 borderWidth:2
 },
 line:{color:"#8ecf03",
 width:2
 }
 },
 "plot":{color:"#1293f8",
 item:{borderColor:"#636363",
 borderWidth:1,
 color: "#ffffff",
 type:"r",
 shadow: false
 },
 line:{color:"#1293f8",
 width:2
 }
 },
 "diamond":{color:"#b64040",
 item:{borderColor:"#b64040",
 color: "#b64040",
 type:"d",
 radius:3,
 shadow:true
 },
 line:{color:"#ff9000",
 width:2
 }
 },
 "point":{color:"#fe5916",
 disableLines:true,
 fill:false,
 disableItems:false,
 item:{color:"#feb916",
 borderColor:"#fe5916",
 radius:2,
 borderWidth:1,
 type:"r"
 },
 alpha:1
 },
 "line":{line:{color:"#3399ff",
 width:2
 },
 item:{color:"#ffffff",
 borderColor:"#3399ff",
 radius:2,
 borderWidth:2,
 type:"d"
 },
 fill:false,
 disableItems:false,
 disableLines:false,
 alpha:1
 },
 "area":{fill:"#3399ff",
 line:{color:"#3399ff",
 width:1
 },
 disableItems:true,
 alpha: 0.2,
 disableLines:false
 },
 "round":{item:{radius:3,
 borderColor:"#3f83ff",
 borderWidth:1,
 color:"#3f83ff",
 type:"r",
 shadow:false,
 alpha:0.6
 }
 },
 "square":{item:{radius:3,
 borderColor:"#447900",
 borderWidth:2,
 color:"#69ba00",
 type:"s",
 shadow:false,
 alpha:1
 }
 },
 
 "column":{color:"RAINBOW",
 gradient:false,
 width:45,
 radius:0,
 alpha:1,
 border:true
 },
 "stick":{width:5,
 gradient:false,
 color:"#67b5c9",
 radius:2,
 alpha:1,
 border:false
 },
 "alpha":{color:"#b9a8f9",
 width:70,
 gradient:"falling",
 radius:0,
 alpha:0.5,
 border:true
 }
};dhtmlx.ui.Map = function(key){this.name = "Map";this._id = "map_"+dhtmlx.uid();this._key = key;this._map = [];};dhtmlx.ui.Map.prototype = {addRect: function(id,points,userdata) {this._createMapArea(id,"RECT",points,userdata);},
 addPoly: function(id,points) {this._createMapArea(id,"POLY",points);},
 _createMapArea:function(id,shape,coords,userdata){var extra_data = "";if(arguments.length==4)extra_data = "userdata='"+userdata+"'";this._map.push("<area "+this._key+"='"+id+"' shape='"+shape+"' coords='"+coords.join()+"' "+extra_data+"></area>");},
 addSector:function(id,alpha0,alpha1,x,y,R,ky){var points = [];points.push(x);points.push(Math.floor(y*ky));for(var i = alpha0;i < alpha1;i+=Math.PI/18){points.push(Math.floor(x+R*Math.cos(i)));points.push(Math.floor((y+R*Math.sin(i))*ky));}
 points.push(Math.floor(x+R*Math.cos(alpha1)));points.push(Math.floor((y+R*Math.sin(alpha1))*ky));points.push(x);points.push(Math.floor(y*ky));return this.addPoly(id,points);},
 render:function(obj){var d = dhtmlx.html.create("DIV");d.style.cssText="position:absolute;width:100%;height:100%;top:0px;left:0px;";obj.appendChild(d);var src = dhtmlx._isIE?"":"src='data:image/gif;base64,R0lGODlhEgASAIAAAP///////yH5BAUUAAEALAAAAAASABIAAAIPjI+py+0Po5y02ouz3pwXADs='";d.innerHTML="<map id='"+this._id+"' name='"+this._id+"'>"+this._map.join("\n")+"</map><img "+src+" class='dhx_map_img' usemap='#"+this._id+"'>";obj._htmlmap = d;this._map = [];}
};dhtmlx.chart = {};dhtmlx.chart.scatter = {pvt_render_scatter:function(ctx, data, point0, point1, sIndex, map){if(!this._settings.xValue)return dhtmlx.log("warning","Undefined propery: xValue");var limitsY = this._getLimits();var limitsX = this._getLimits("h","xValue");if(!sIndex){this._drawYAxis(ctx,data,point0,point1,limitsY.min,limitsY.max);this._drawHXAxis(ctx,data,point0,point1,limitsX.min,limitsX.max);}
 limitsY = {min:this._settings.yAxis.start,max:this._settings.yAxis.end};limitsX = {min:this._settings.xAxis.start,max:this._settings.xAxis.end};var params = this._getScatterParams(ctx,data,point0,point1,limitsX,limitsY);for(var i=0;i<data.length;i++){this._drawScatterItem(ctx,map,point0, point1, params,limitsX,limitsY,data[i],sIndex);}
 },
 _getScatterParams:function(ctx, data, point0, point1,limitsX,limitsY){var params = {};params.totalHeight = point1.y-point0.y;params.totalWidth = point1.x-point0.x;this._calcScatterUnit(params,limitsX.min,limitsX.max,params.totalWidth,"X");this._calcScatterUnit(params,limitsY.min,limitsY.max,params.totalHeight,"Y");return params;},
 _drawScatterItem:function(ctx,map,point0, point1,params,limitsX,limitsY,obj,sIndex){var x0 = this._calculateScatterItemPosition(params, point1, point0, limitsX, obj, "X");var y0 = this._calculateScatterItemPosition(params, point0, point1, limitsY, obj, "Y");this. _drawItemOfLineChart(ctx,x0,y0,obj,1);var config = this._settings;var areaWidth = (config.eventRadius||Math.floor(config.item.radius+1));map.addRect(obj.id,[x0-areaWidth,y0-areaWidth,x0+areaWidth,y0+areaWidth],sIndex);},
 _calculateScatterItemPosition:function(params, point0, point1, limits, obj, axis){var value = this._settings[axis=="X"?"xValue":"value"].call(this,obj);var valueFactor = params["valueFactor"+axis];var v = (parseFloat(value||0) - limits.min)*valueFactor;var unit = params["unit"+axis];var pos = point1[axis.toLowerCase()] - (axis=="X"?(-1):1)*Math.floor(unit*v);if(v<0)pos = point1[axis.toLowerCase()];if(value > limits.max)pos = point0[axis.toLowerCase()];if(value < limits.min)pos = point1[axis.toLowerCase()];return pos;},
 _calcScatterUnit:function(p,min,max,size,axis){var relativeValues = this._getRelativeValue(min,max);axis = (axis||"");p["relValue"+axis] = relativeValues[0];p["valueFactor"+axis] = relativeValues[1];p["unit"+axis] = (p["relValue"+axis]?size/p["relValue"+axis]:10);}
};dhtmlx.chart.radar = {pvt_render_radar:function(ctx,data,x,y,sIndex,map){this._renderRadarChart(ctx,data,x,y,sIndex,map);}, 
 
 _renderRadarChart:function(ctx,data,point0,point1,sIndex,map){if(!data.length)return;var coord = this._getPieParameters(point0,point1);var radius = (this._settings.radius?this._settings.radius:coord.radius);var x0 = (this._settings.x?this._settings.x:coord.x);var y0 = (this._settings.y?this._settings.y:coord.y);var ratioUnits = [];for(var i=0;i<data.length;i++)ratioUnits.push(1)
 var ratios = this._getRatios(ratioUnits,data.length);if(!sIndex)this._drawRadarAxises(ctx,ratios,x0,y0,radius,data);this._drawRadarData(ctx,ratios,x0,y0,radius,data,sIndex,map);},
 _drawRadarData:function(ctx,ratios,x,y,radius,data,sIndex,map){var alpha0,alpha1,areaWidth,config,i,min,max,pos0,pos1,posArr,r0,r1,relValue,startAlpha,value,value0,value1,valueFactor,unit,unitArr;config = this._settings;min = config.yAxis.start;max = config.yAxis.end;unitArr = this._getRelativeValue(min,max);relValue = unitArr[0];unit = (relValue?radius/relValue:radius/2);valueFactor = unitArr[1];startAlpha = -Math.PI/2;alpha0 = alpha1 = startAlpha;posArr = [];for(i=0;i<data.length;i++){if(!value1){value = config.value(data[i]);value0 = (value1||(parseFloat(value||0) - min)*valueFactor);}
 else
 value0 = value1;r0 = Math.floor(unit*value0);value = config.value((i!=(data.length-1))?data[i+1]:data[0]);value1 = (parseFloat(value||0) - min)*valueFactor;r1 = Math.floor(unit*value1);alpha0 = alpha1;alpha1 = ((i!=(data.length-1))?(startAlpha+ratios[i]-0.0001):startAlpha);pos0 = (pos1||this._getPositionByAngle(alpha0,x,y,r0));pos1 = this._getPositionByAngle(alpha1,x,y,r1);areaWidth = (config.eventRadius||(parseInt(config.item.radius.call(this,data[i]),10)+config.item.borderWidth));map.addRect(data[i].id,[pos0.x-areaWidth,pos0.y-areaWidth,pos0.x+areaWidth,pos0.y+areaWidth],sIndex);posArr.push(pos0);}
 if(config.fill)this._fillRadarChart(ctx,posArr,data);if(!config.disableLines)this._strokeRadarChart(ctx,posArr,data);if(!config.disableItems)this._drawRadarItemMarkers(ctx,posArr,data);posArr = null;},
 _drawRadarItemMarkers:function(ctx,points,data){for(var i=0;i < points.length;i++){this._drawItemOfLineChart(ctx,points[i].x,points[i].y,data[i]);}
 },
 _fillRadarChart:function(ctx,points,data){var pos0,pos1;ctx.globalAlpha= this._settings.alpha.call(this,{});ctx.beginPath();for(var i=0;i < points.length;i++){ctx.fillStyle = this._settings.fill.call(this,data[i]);pos0 = points[i];pos1 = (points[i+1]|| points[0]);if(!i){ctx.moveTo(pos0.x,pos0.y);}
 ctx.lineTo(pos1.x,pos1.y)
 }
 ctx.fill();ctx.globalAlpha=1;},
 _strokeRadarChart:function(ctx,points,data){var pos0,pos1;for(var i=0;i < points.length;i++){pos0 = points[i];pos1 = (points[i+1]|| points[0]);this._drawLine(ctx,pos0.x,pos0.y,pos1.x,pos1.y,this._settings.line.color.call(this,data[i]),this._settings.line.width)
 }
 },
 _drawRadarAxises:function(ctx,ratios,x,y,radius,data){var configY = this._settings.yAxis;var configX = this._settings.xAxis;var start = configY.start;var end = configY.end;var step = configY.step;var scaleParam= {};var config = this._settings.configYAxis;if(typeof config.step =="undefined"||typeof config.start=="undefined"||typeof config.end =="undefined"){var limits = this._getLimits();scaleParam = this._calculateScale(limits.min,limits.max);start = scaleParam.start;end = scaleParam.end;step = scaleParam.step;configY.end = end;configY.start = start;}
 var units = [];var i,j,p;var c=0;var stepHeight = radius*step/(end-start);var power,corr;if(step<1){power = Math.min(this._log10(step),(start<=0?0:this._log10(start)));corr = Math.pow(10,-power);}
 var angles = [];for(i = end;i>=start;i -=step){if(scaleParam.fixNum)i = parseFloat((new Number(i)).toFixed(scaleParam.fixNum));units.push(Math.floor(c*stepHeight)+ 0.5);if(corr){i = Math.round(i*corr)/corr;}
 var unitY = y-radius+units[units.length-1];this.renderTextAt("middle","left",x,unitY,
 configY.template(i.toString()),
 "dhx_axis_item_y dhx_radar"
 );if(ratios.length<2){this._drawScaleSector(ctx,"arc",x,y,radius-units[units.length-1],-Math.PI/2,3*Math.PI/2,i);return;}
 var startAlpha = -Math.PI/2;var alpha0 = startAlpha;var alpha1;for(j=0;j< ratios.length;j++){if(i==end)angles.push(alpha0);alpha1 = startAlpha+ratios[j]-0.0001;this._drawScaleSector(ctx,(config.lineShape||"line"),x,y,radius-units[units.length-1],alpha0,alpha1,i,j,data[i]);alpha0 = alpha1;}
 c++;}
 
 for(i=0;i< angles.length;i++){p = this._getPositionByAngle(angles[i],x,y,radius);this._drawLine(ctx,x,y,p.x,p.y,(configX?configX.lineColor.call(this,data[i]):"#cfcfcf"),((configX&&configX.lineWidth)?configX.lineWidth.call(this,data[i]):1));this._drawRadarScaleLabel(ctx,x,y,radius,angles[i],(configX?configX.template.call(this,data[i]):"&nbsp;"));}
 },
 _drawScaleSector:function(ctx,shape,x,y,radius,a1,a2,i,j){var pos1, pos2;if(radius<0)return false;pos1 = this._getPositionByAngle(a1,x,y,radius);pos2 = this._getPositionByAngle(a2,x,y,radius);var configY = this._settings.yAxis;if(configY.bg){ctx.beginPath();ctx.moveTo(x,y);if(shape=="arc")ctx.arc(x,y,radius,a1,a2,false);else{ctx.lineTo(pos1.x,pos1.y);ctx.lineTo(pos2.x,pos2.y);}
 ctx.fillStyle = configY.bg(i,j);ctx.moveTo(x,y);ctx.fill();ctx.closePath();}
 if(configY.lines(i,j)){ctx.lineWidth = 1;ctx.beginPath();if(shape=="arc")ctx.arc(x,y,radius,a1,a2,false);else{ctx.moveTo(pos1.x,pos1.y);ctx.lineTo(pos2.x,pos2.y);}
 ctx.strokeStyle = configY.lineColor(i,j);ctx.stroke();}
 },
 _drawRadarScaleLabel:function(ctx,x,y,r,a,text){var t = this.renderText(0,0,text,"dhx_axis_radar_title",1);var width = t.scrollWidth;var height = t.offsetHeight;var delta = 0.001;var pos = this._getPositionByAngle(a,x,y,r+5);var corr_x=0,corr_y=0;if(a<0||a>Math.PI){corr_y = -height;}
 if(a>Math.PI/2){corr_x = -width;}
 if(Math.abs(a+Math.PI/2)<delta||Math.abs(a-Math.PI/2)<delta){corr_x = -width/2;}
 else if(Math.abs(a)<delta||Math.abs(a-Math.PI)<delta){corr_y = -height/2;}
 t.style.top = pos.y+corr_y+"px";t.style.left = pos.x+corr_x+"px";t.style.width = width+"px";t.style.whiteSpace = "nowrap";}
};dhtmlx.chart.area = {pvt_render_area:function(ctx, data, point0, point1, sIndex, map){var params = this._calculateParametersOfLineChart(ctx,data,point0,point1,sIndex);var areaPos = (this._settings.eventRadius||Math.floor(params.cellWidth/2));if (data.length){ctx.globalAlpha = this._settings.alpha.call(this,data[0]);ctx.fillStyle = this._settings.color.call(this,data[0]);var y0 = this._getYPointOfLineChart(data[0],point0,point1,params);var x0 = (this._settings.offset?point0.x+params.cellWidth*0.5:point0.x);ctx.beginPath();ctx.moveTo(x0,point1.y);ctx.lineTo(x0,y0);map.addRect(data[0].id,[x0-areaPos,y0-areaPos,x0+areaPos,y0+areaPos],sIndex);if(!this._settings.yAxis)this.renderTextAt(false, (!this._settings.offset?false:true), x0, y0-this._settings.labelOffset, this._settings.label(data[0]));for(var i=1;i < data.length;i ++){var xi = x0+ Math.floor(params.cellWidth*i) - 0.5;var yi = this._getYPointOfLineChart(data[i],point0,point1,params);ctx.lineTo(xi,yi);map.addRect(data[i].id,[xi-areaPos,yi-areaPos,xi+areaPos,yi+areaPos],sIndex);if(!this._settings.yAxis)this.renderTextAt(false, (!this._settings.offset&&i==(data.length-1)?"left":"center"), xi, yi-this._settings.labelOffset, this._settings.label(data[i]));}
 ctx.lineTo(x0+Math.floor(params.cellWidth*[data.length-1]),point1.y);ctx.lineTo(x0,point1.y);ctx.fill();}
 }
};dhtmlx.chart.stackedArea ={pvt_render_stackedArea:function(ctx, data, point0, point1, sIndex, map){var params = this._calculateParametersOfLineChart(ctx,data,point0,point1,sIndex);var areaPos = (this._settings.eventRadius||Math.floor(params.cellWidth/2));var y1 = [];if (data.length){ctx.globalAlpha = this._settings.alpha.call(this,data[0]);ctx.fillStyle = this._settings.color.call(this,data[0]);var y01 = (sIndex?data[0].$startY:point1.y);var x0 = (this._settings.offset?point0.x+params.cellWidth*0.5:point0.x);var y02 = this._getYPointOfLineChart(data[0],point0,point1,params)-(sIndex?(point1.y-y01):0);y1[0] = y02;ctx.beginPath();ctx.moveTo(x0,y01);ctx.lineTo(x0,y02);map.addRect(data[0].id,[x0-areaPos,y02-areaPos,x0+areaPos,y02+areaPos],sIndex);if(!this._settings.yAxis)this.renderTextAt(false, true, x0, y02-this._settings.labelOffset, this._settings.label(data[0]));for(var i=1;i < data.length;i ++){var xi = x0+ Math.floor(params.cellWidth*i) - 0.5;var yi2 = this._getYPointOfLineChart(data[i],point0,point1,params)-(sIndex?(point1.y-data[i].$startY):0);y1[i] = yi2;ctx.lineTo(xi,yi2);map.addRect(data[i].id,[xi-areaPos,yi2-areaPos,xi+areaPos,yi2+areaPos],sIndex);if(!this._settings.yAxis)this.renderTextAt(false, true, xi, yi2-this._settings.labelOffset, this._settings.label(data[i]));}
 ctx.lineTo(x0+Math.floor(params.cellWidth*[data.length-1]),y01);if(sIndex){for(var i=data.length-1;i >=0 ;i--){var xi = x0+ Math.floor(params.cellWidth*i) - 0.5;var yi1 = data[i].$startY;ctx.lineTo(xi,yi1);}
 }
 else ctx.lineTo(x0+ Math.floor(params.cellWidth*(length-1)) - 0.5,y01);ctx.lineTo(x0,y01);ctx.fill();for(var i=0;i < data.length;i ++){data[i].$startY = y1[i];}
 }
 }
};dhtmlx.chart.spline = {pvt_render_spline:function(ctx, data, point0, point1, sIndex, map){var areaPos,config,i,items,j,params,radius,sparam,x,x0,x1,x2,y,y1,y2;params = this._calculateParametersOfLineChart(ctx,data,point0,point1,sIndex);config = this._settings;items = [];if (data.length){x0 = (config.offset?point0.x+params.cellWidth*0.5:point0.x);for(i=0;i < data.length;i ++){x = ((!i)?x0:Math.floor(params.cellWidth*i) - 0.5 + x0);y = this._getYPointOfLineChart(data[i],point0,point1,params);items.push({x:x,y:y});}
 sparam = this._getSplineParameters(items);for(i =0;i< items.length;i++){x1 = items[i].x;y1 = items[i].y;if(i<items.length-1){x2 = items[i+1].x;y2 = items[i+1].y;for(j = x1;j < x2;j++)this._drawLine(ctx,j,this._getSplineYPoint(j,x1,i,sparam.a,sparam.b,sparam.c,sparam.d),j+1,this._getSplineYPoint(j+1,x1,i,sparam.a,sparam.b,sparam.c,sparam.d),config.line.color(data[i]),config.line.width);this._drawLine(ctx,x2-1,this._getSplineYPoint(j,x1,i,sparam.a,sparam.b,sparam.c,sparam.d),x2,y2,config.line.color(data[i]),config.line.width);}
 this._drawItemOfLineChart(ctx,x1,y1,data[i],config.label(data[i]));radius = (parseInt(config.item.radius.call(this,data[i-1]),10)||2);areaPos = (config.eventRadius||radius+1);map.addRect(data[i].id,[x1-areaPos,y1-areaPos,x1+areaPos,y1+areaPos],sIndex);}
 

 }
 },
 
 _getSplineParameters:function(points){var h,i,u,v,s,a,b,c,d,n;h = [];m = [];n = points.length;for(i =0;i<n-1;i++){h[i] = points[i+1].x - points[i].x;m[i] = (points[i+1].y - points[i].y)/h[i];}
 u = [];v = [];u[0] = 0;u[1] = 2*(h[0] + h[1]);v[0] = 0;v[1] = 6*(m[1] - m[0]);for(i =2;i < n-1;i++){u[i] = 2*(h[i-1]+h[i]) - h[i-1]*h[i-1]/u[i-1];v[i] = 6*(m[i]-m[i-1]) - h[i-1]*v[i-1]/u[i-1];}
 
 s = [];s[n-1] = s[0] = 0;for(i = n -2;i>=1;i--)s[i] = (v[i] - h[i]*s[i+1])/u[i];a = [];b = [];c = [];d = [];for(i =0;i<n-1;i++){a[i] = points[i].y;b[i] = - h[i]*s[i+1]/6 - h[i]*s[i]/3 + (points[i+1].y-points[i].y)/h[i];c[i] = s[i]/2;d[i] = (s[i+1] - s[i])/(6*h[i]);}
 return {a:a,b:b,c:c,d:d};},
 
 _getSplineYPoint:function(x,xi,i,a,b,c,d){return a[i] + (x - xi)*(b[i] + (x-xi)*(c[i]+(x-xi)*d[i]));}
};dhtmlx.chart.barH = {pvt_render_barH:function(ctx, data, point0, point1, sIndex, map){var maxValue,minValue;var valueFactor;var relValue;var total_width = point1.x-point0.x;var yax = !!this._settings.yAxis;var xax = !!this._settings.xAxis;var limits = this._getLimits("h");maxValue = limits.max;minValue = limits.min;var cellWidth = Math.floor((point1.y-point0.y)/data.length);if(!sIndex)this._drawHScales(ctx,data,point0, point1,minValue,maxValue,cellWidth);if(yax){maxValue = parseFloat(this._settings.xAxis.end);minValue = parseFloat(this._settings.xAxis.start);}
 
 
 var relativeValues = this._getRelativeValue(minValue,maxValue);relValue = relativeValues[0];valueFactor = relativeValues[1];var unit = (relValue?total_width/relValue:10);if(!yax){var startValue = 10;unit = (relValue?(total_width-startValue)/relValue:10);}
 
 
 
 var barWidth = parseInt(this._settings.width,10);if((barWidth*this._series.length+4)>cellWidth) barWidth = cellWidth/this._series.length-4;var barOffset = Math.floor((cellWidth - barWidth*this._series.length)/2);var radius = (typeof this._settings.radius!="undefined"?parseInt(this._settings.radius,10):Math.round(barWidth/5));var inner_gradient = false;var gradient = this._settings.gradient;if (gradient&&typeof(gradient)!= "function"){inner_gradient = gradient;gradient = false;}else if (gradient){gradient = ctx.createLinearGradient(point0.x,point0.y,point1.x,point0.y);this._settings.gradient(gradient);}
 var scaleY = 0;if(!yax){this._drawLine(ctx,point0.x-0.5,point0.y,point0.x-0.5,point1.y,"#000000",1);}
 
 
 
 for(var i=0;i < data.length;i ++){var value = parseFloat(this._settings.value(data[i]||0));if(value>maxValue)value = maxValue;value -= minValue;value *= valueFactor;var x0 = point0.x;var y0 = point0.y+ barOffset + i*cellWidth+(barWidth+1)*sIndex;if((value<0&&this._settings.origin=="auto")||(this._settings.xAxis&&value===0&&!(this._settings.origin!="auto"&&this._settings.origin>minValue))){this.renderTextAt("middle", "right", x0+10,y0+barWidth/2+barOffset,this._settings.label(data[i]));continue;}
 if(value<0&&this._settings.origin!="auto"&&this._settings.origin>minValue){value = 0;}
 
 
 if(!yax)value += startValue/unit;var color = gradient||this._settings.color.call(this,data[i]);if(this._settings.border){this._drawBarHBorder(ctx,x0,y0,barWidth,minValue,radius,unit,value,color);}
 
 ctx.globalAlpha = this._settings.alpha.call(this,data[i]);var points = this._drawBarH(ctx,point0,x0,y0,barWidth,minValue,radius,unit,value,color,gradient,inner_gradient);if (inner_gradient!=false){this._drawBarHGradient(ctx,x0,y0,barWidth,minValue,radius,unit,value,color,inner_gradient);}
 ctx.globalAlpha = 1;if(points[3]==y0){this.renderTextAt("middle", "left", points[0]-5,points[3]+Math.floor(barWidth/2),this._settings.label(data[i]));map.addRect(data[i].id,[points[0],points[3],points[2],points[3]+barWidth],sIndex);}else{this.renderTextAt("middle", false, points[2]+5,points[1]+Math.floor(barWidth/2),this._settings.label(data[i]));map.addRect(data[i].id,[points[0],y0,points[2],points[3]],sIndex);}
 
 }
 },
 
 _setBarHPoints:function(ctx,x0,y0,barWidth,radius,unit,value,offset,skipLeft){var angle_corr = 0;if(radius>unit*value){var sinA = (radius-unit*value)/radius;angle_corr = -Math.asin(sinA)+Math.PI/2;}
 
 ctx.moveTo(x0,y0+offset);var x1 = x0 + unit*value - radius - (radius?0:offset);if(radius<unit*value)ctx.lineTo(x1,y0+offset);var y2 = y0 + radius;if (radius&&radius>0)ctx.arc(x1,y2,radius-offset,-Math.PI/2+angle_corr,0,false);var y3 = y0 + barWidth - radius - (radius?0:offset);var x3 = x1 + radius - (radius?offset:0);ctx.lineTo(x3,y3);var x4 = x1;if (radius&&radius>0)ctx.arc(x4,y3,radius-offset,0,Math.PI/2-angle_corr,false);var y5 = y0 + barWidth-offset;ctx.lineTo(x0,y5);if(!skipLeft){ctx.lineTo(x0,y0+offset);}
 
 return [x3,y5];},
 _drawHScales:function(ctx,data,point0,point1,start,end,cellWidth){var x = this._drawHXAxis(ctx,data,point0,point1,start,end);this._drawHYAxis(ctx,data,point0,point1,cellWidth,x);},
 _drawHYAxis:function(ctx,data,point0,point1,cellWidth,yAxisX){if (!this._settings.yAxis)return;var unitPos;var x0 = parseInt((yAxisX?yAxisX:point0.x),10)-0.5;var y0 = point1.y+0.5;var y1 = point0.y;this._drawLine(ctx,x0,y0,x0,y1,this._settings.yAxis.color,1);for(var i=0;i < data.length;i ++){var right = ((this._settings.origin!="auto")&&(this._settings.view=="barH")&&(parseFloat(this._settings.value(data[i]))<this._settings.origin));unitPos = y1+cellWidth/2+i*cellWidth;this.renderTextAt("middle",(right?false:"left"),(right?x0+5:x0-5),unitPos,
 this._settings.yAxis.template(data[i]),
 "dhx_axis_item_y",(right?0:x0-10)
 );if(this._settings.yAxis.lines.call(this,data[i]))
 this._drawLine(ctx,point0.x,unitPos,point1.x,unitPos,this._settings.yAxis.lineColor.call(this,data[i]),1);}
 this._drawLine(ctx,point0.x+0.5,y1+0.5,point1.x,y1+0.5,this._settings.yAxis.lineColor.call(this,{}),1);this._setYAxisTitle(point0,point1);},
 _drawHXAxis:function(ctx,data,point0,point1,start,end){var step;var scaleParam= {};var axis = this._settings.xAxis;if (!axis)return;var y0 = point1.y+0.5;var x0 = point0.x-0.5;var x1 = point1.x-0.5;var yAxisStart = point0.x;this._drawLine(ctx,x0,y0,x1,y0,axis.color,1);if(axis.step)step = parseFloat(axis.step);if(typeof this._settings.configXAxis.step =="undefined"||typeof this._settings.configXAxis.start=="undefined"||typeof this._settings.configXAxis.end =="undefined"){scaleParam = this._calculateScale(start,end);start = scaleParam.start;end = scaleParam.end;step = scaleParam.step;this._settings.xAxis.end = end;this._settings.xAxis.start = start;this._settings.xAxis.step = step;};if(step===0)return;var stepHeight = (x1-x0)*step/(end-start);var c = 0;for(var i = start;i<=end;i += step){if(scaleParam.fixNum)i = parseFloat((new Number(i)).toFixed(scaleParam.fixNum));var xi = Math.floor(x0+c*stepHeight)+ 0.5;if(!(i==start&&this._settings.origin=="auto")&&axis.lines.call(this,i))
 this._drawLine(ctx,xi,y0,xi,point0.y,this._settings.xAxis.lineColor.call(this,i),1);if(i == this._settings.origin)yAxisStart = xi+1;this.renderTextAt(false, true,xi,y0+2,axis.template(i.toString()),"dhx_axis_item_x");c++;};this.renderTextAt(true, false, x0,point1.y+this._settings.padding.bottom-3,
 this._settings.xAxis.title,
 "dhx_axis_title_x",
 point1.x - point0.x
 );if (!axis.lines){;this._drawLine(ctx,x0,point0.y-0.5,x1,point0.y-0.5,this._settings.xAxis.color,0.2);}
 return yAxisStart;},
 _correctBarHParams:function(ctx,x,y,value,unit,barWidth,minValue){var yax = this._settings.yAxis;var axisStart = x;if(!!yax&&this._settings.origin!="auto" && (this._settings.origin>minValue)){x += (this._settings.origin-minValue)*unit;axisStart = x;value = value-(this._settings.origin-minValue);if(value < 0){value *= (-1);ctx.translate(x,y+barWidth);ctx.rotate(Math.PI);x = 0.5;y = 0;}
 x += 0.5;}
 
 return {value:value,x0:x,y0:y,start:axisStart}
 },
 _drawBarH:function(ctx,point0,x0,y0,barWidth,minValue,radius,unit,value,color,gradient,inner_gradient){ctx.save();var p = this._correctBarHParams(ctx,x0,y0,value,unit,barWidth,minValue);ctx.fillStyle = color;ctx.beginPath();var points = this._setBarHPoints(ctx,p.x0,p.y0,barWidth,radius,unit,p.value,(this._settings.border?1:0));if (gradient&&!inner_gradient)ctx.lineTo(point0.x+total_width,p.y0+(this._settings.border?1:0));ctx.fill();ctx.restore();var y1 = p.y0;var y2 = (p.y0!=y0?y0:points[1]);var x1 = (p.y0!=y0?(p.start-points[0]):p.start);var x2 = (p.y0!=y0?p.start:points[0]);return [x1,y1,x2,y2];},
 _drawBarHBorder:function(ctx,x0,y0,barWidth,minValue,radius,unit,value,color){ctx.save();var p = this._correctBarHParams(ctx,x0,y0,value,unit,barWidth,minValue);ctx.beginPath();this._setBorderStyles(ctx,color);ctx.globalAlpha =0.9;this._setBarHPoints(ctx,p.x0,p.y0,barWidth,radius,unit,p.value,ctx.lineWidth/2,1);ctx.stroke();ctx.restore();},
 _drawBarHGradient:function(ctx,x0,y0,barWidth,minValue,radius,unit,value,color,inner_gradient){ctx.save();var p = this._correctBarHParams(ctx,x0,y0,value,unit,barWidth,minValue);var gradParam = this._setBarGradient(ctx,p.x0,p.y0+barWidth,p.x0+unit*p.value,p.y0,inner_gradient,color,"x");ctx.fillStyle = gradParam.gradient;ctx.beginPath();var points = this._setBarHPoints(ctx,p.x0,p.y0+gradParam.offset,barWidth-gradParam.offset*2,radius,unit,p.value,gradParam.offset);ctx.fill();ctx.globalAlpha = 1;ctx.restore();}
};dhtmlx.assert(dhtmlx.chart.barH);dhtmlx.chart.stackedBarH = {pvt_render_stackedBarH:function(ctx, data, point0, point1, sIndex, map){var maxValue,minValue;var valueFactor;var relValue;var total_width = point1.x-point0.x;var yax = !!this._settings.yAxis;var limits = this._getStackedLimits(data);maxValue = limits.max;minValue = limits.min;var cellWidth = Math.floor((point1.y-point0.y)/data.length);if(!sIndex)this._drawHScales(ctx,data,point0, point1,minValue,maxValue,cellWidth);if(yax){maxValue = parseFloat(this._settings.xAxis.end);minValue = parseFloat(this._settings.xAxis.start);}
 
 
 var relativeValues = this._getRelativeValue(minValue,maxValue);relValue = relativeValues[0];valueFactor = relativeValues[1];var unit = (relValue?total_width/relValue:10);if(!yax){var startValue = 10;unit = (relValue?(total_width-startValue)/relValue:10);}
 
 
 var barWidth = parseInt(this._settings.width,10);if((barWidth+4)>cellWidth) barWidth = cellWidth-4;var barOffset = Math.floor((cellWidth - barWidth)/2);var radius = 0;var inner_gradient = false;var gradient = this._settings.gradient;if (gradient){inner_gradient = true;}
 
 if(!yax){this._drawLine(ctx,point0.x-0.5,point0.y,point0.x-0.5,point1.y,"#000000",1);}
 
 for(var i=0;i < data.length;i ++){if(!sIndex)data[i].$startX = point0.x;var value = parseFloat(this._settings.value(data[i]||0));if(value>maxValue)value = maxValue;value -= minValue;value *= valueFactor;var x0 = point0.x;var y0 = point0.y+ barOffset + i*cellWidth;if(!sIndex)data[i].$startX = x0;else
 x0 = data[i].$startX;if(value<0||(this._settings.yAxis&&value===0)){this.renderTextAt("middle", true, x0+10,y0+barWidth/2,this._settings.label(data[i]));continue;}
 
 
 if(!yax)value += startValue/unit;var color = this._settings.color.call(this,data[i]);ctx.globalAlpha = this._settings.alpha.call(this,data[i]);ctx.fillStyle = this._settings.color.call(this,data[i]);ctx.beginPath();var points = this._setBarHPoints(ctx,x0,y0,barWidth,radius,unit,value,(this._settings.border?1:0));if (gradient&&!inner_gradient)ctx.lineTo(point0.x+total_width,y0+(this._settings.border?1:0));ctx.fill();if (inner_gradient!=false){var gradParam = this._setBarGradient(ctx,x0,y0+barWidth,x0,y0,inner_gradient,color,"x");ctx.fillStyle = gradParam.gradient;ctx.beginPath();points = this._setBarHPoints(ctx,x0,y0, barWidth,radius,unit,value,0);ctx.fill();}
 
 if(this._settings.border){this._drawBarHBorder(ctx,x0,y0,barWidth,minValue,radius,unit,value,color);}
 
 ctx.globalAlpha = 1;this.renderTextAt("middle",true,data[i].$startX+(points[0]-data[i].$startX)/2-1, y0+(points[1]-y0)/2, this._settings.label(data[i]));map.addRect(data[i].id,[data[i].$startX,y0,points[0],points[1]],sIndex);data[i].$startX = points[0];}
 }
};dhtmlx.chart.stackedBar = {pvt_render_stackedBar:function(ctx, data, point0, point1, sIndex, map){var maxValue,minValue;var valueFactor;var relValue;var total_height = point1.y-point0.y;var yax = !!this._settings.yAxis;var xax = !!this._settings.xAxis;var limits = this._getStackedLimits(data);maxValue = limits.max;minValue = limits.min;var cellWidth = Math.floor((point1.x-point0.x)/data.length);if(!sIndex)this._drawScales(ctx,data,point0, point1,minValue,maxValue,cellWidth);if(yax){maxValue = parseFloat(this._settings.yAxis.end);minValue = parseFloat(this._settings.yAxis.start);}
 
 
 var relativeValues = this._getRelativeValue(minValue,maxValue);relValue = relativeValues[0];valueFactor = relativeValues[1];var unit = (relValue?total_height/relValue:10);var barWidth = parseInt(this._settings.width,10);if(barWidth+4 > cellWidth)barWidth = cellWidth-4;var barOffset = Math.floor((cellWidth - barWidth)/2);var inner_gradient = (this._settings.gradient?this._settings.gradient:false);if(!xax){this._drawLine(ctx,point0.x,point1.y+0.5,point1.x,point1.y+0.5,"#000000",1);}
 
 for(var i=0;i < data.length;i ++){var value = parseFloat(this._settings.value(data[i]||0));if(!value){if(!sIndex||!data[i].$startY)data[i].$startY = point1.y;continue;}
 
 if(!sIndex)value -= minValue;value *= valueFactor;var x0 = point0.x + barOffset + i*cellWidth;var y0 = point1.y;if(!sIndex)data[i].$startY = y0;else
 y0 = data[i].$startY;if(y0 < (point0.y+1)) continue;if(value<0||(this._settings.yAxis&&value===0)){this.renderTextAt(true, true, x0+Math.floor(barWidth/2),y0,this._settings.label(data[i]));continue;}
 
 var color = this._settings.color.call(this,data[i]);ctx.globalAlpha = this._settings.alpha.call(this,data[i]);ctx.fillStyle = this._settings.color.call(this,data[i]);ctx.beginPath();var points = this._setStakedBarPoints(ctx,x0-(this._settings.border?0.5:0),y0,barWidth+(this._settings.border?0.5:0),unit,value,0,point0.y);ctx.fill();if (inner_gradient){ctx.save();var gradParam = this._setBarGradient(ctx,x0,y0,x0+barWidth,points[1],inner_gradient,color,"y");ctx.fillStyle = gradParam.gradient;ctx.beginPath();points = this._setStakedBarPoints(ctx,x0+gradParam.offset,y0,barWidth-gradParam.offset*2,unit,value,(this._settings.border?1:0),point0.y);ctx.fill();ctx.restore()
 }
 
 if(this._settings.border){ctx.save();this._setBorderStyles(ctx,color);ctx.beginPath();this._setStakedBarPoints(ctx,x0-0.5,y0,barWidth+1,unit,value,0,point0.y,1);ctx.stroke();ctx.restore();}
 ctx.globalAlpha = 1;this.renderTextAt(false, true, x0+Math.floor(barWidth/2),(points[1]+(y0-points[1])/2)-7,this._settings.label(data[i]));map.addRect(data[i].id,[x0,points[1],points[0],(data[i].$startY||y0)],sIndex);data[i].$startY = (this._settings.border?(points[1]+1):points[1]);}
 },
 
 _setStakedBarPoints:function(ctx,x0,y0,barWidth,unit,value,offset,minY,skipBottom){ctx.moveTo(x0,y0);var y1 = y0 - unit*value+offset;if(y1<minY)y1 = minY;ctx.lineTo(x0,y1);var x3 = x0 + barWidth;var y3 = y1;ctx.lineTo(x3,y3);var x5 = x0 + barWidth;ctx.lineTo(x5,y0);if(!skipBottom){ctx.lineTo(x0,y0);}
 
 return [x5,y3-2*offset];}
};dhtmlx.chart.line = {pvt_render_line:function(ctx, data, point0, point1, sIndex, map){var areaPos,config,i,params,radius,x0,x1,x2,y1,y2;params = this._calculateParametersOfLineChart(ctx,data,point0,point1,sIndex);config = this._settings;if (data.length){y1 = this._getYPointOfLineChart(data[0],point0,point1,params);x1 = (config.offset?point0.x+params.cellWidth*0.5:point0.x);x0 = x1;for(i=1;i <= data.length;i ++){x2 = ((i==data.length-1)&&!this._settings.offset)?point1.x:Math.floor(params.cellWidth*i) - 0.5 + x0;if (data.length!=i){y2 = this._getYPointOfLineChart(data[i],point0,point1,params);if(!y2)continue;if(config.line.width){this._drawLine(ctx,x1,y1,x2,y2,config.line.color.call(this,data[i-1]),config.line.width);if(config.line&&config.line.shadow){ctx.globalAlpha = 0.3;this._drawLine(ctx,x1+2,y1+config.line.width+8,x2+2,y2+config.line.width+8,"#eeeeee",config.line.width+3);ctx.globalAlpha = 1;}
 }
 }
 
 this._drawItemOfLineChart(ctx,x1,y1,data[i-1],!!config.offset);radius = (parseInt(config.item.radius.call(this,data[i-1]),10)||2);areaPos = (config.eventRadius||radius+1);map.addRect(data[i-1].id,[x1-areaPos,y1-areaPos,x1+areaPos,y1+areaPos],sIndex);y1=y2;x1=x2;}
 }
 },
 
 _drawItemOfLineChart:function(ctx,x0,y0,obj,label){var config = this._settings.item;var R = parseInt(config.radius.call(this,obj),10);ctx.save();if(config.shadow){ctx.lineWidth = 1;ctx.strokeStyle = "#bdbdbd";ctx.fillStyle = "#bdbdbd";var alphas = [0.1,0.2,0.3];for(var i=(alphas.length-1);i>=0;i--){ctx.globalAlpha = alphas[i];ctx.strokeStyle = "#d0d0d0";ctx.beginPath();this._strokeChartItem(ctx,x0,y0+2*R/3,R+i+1,config.type);ctx.stroke();}
 ctx.beginPath();ctx.globalAlpha = 0.3;ctx.fillStyle = "#bdbdbd";this._strokeChartItem(ctx,x0,y0+2*R/3,R+1,config.type);ctx.fill();}
 ctx.restore();ctx.lineWidth = config.borderWidth;ctx.fillStyle = config.color.call(this,obj);ctx.strokeStyle = config.borderColor.call(this,obj);ctx.globalAlpha = config.alpha.call(this,obj);ctx.beginPath();this._strokeChartItem(ctx,x0,y0,R+1,config.type);ctx.fill();ctx.stroke();ctx.globalAlpha = 1;if(label)this.renderTextAt(false, true, x0,y0-R-this._settings.labelOffset,this._settings.label.call(this,obj));},
 _strokeChartItem:function(ctx,x0,y0,R,type){if(type && (type=="square" || type=="s")){R *= Math.sqrt(2)/2;ctx.moveTo(x0-R-ctx.lineWidth/2,y0-R);ctx.lineTo(x0+R,y0-R);ctx.lineTo(x0+R,y0+R);ctx.lineTo(x0-R,y0+R);ctx.lineTo(x0-R,y0-R);}
 else if(type && (type=="diamond" || type=="d")){var corr = (ctx.lineWidth>1?ctx.lineWidth*Math.sqrt(2)/4:0);ctx.moveTo(x0,y0-R);ctx.lineTo(x0+R,y0);ctx.lineTo(x0,y0+R);ctx.lineTo(x0-R,y0);ctx.lineTo(x0+corr,y0-R-corr);}
 else if(type && (type=="triangle" || type=="t")){ctx.moveTo(x0,y0-R);ctx.lineTo(x0+Math.sqrt(3)*R/2,y0+R/2);ctx.lineTo(x0-Math.sqrt(3)*R/2,y0+R/2);ctx.lineTo(x0,y0-R);}
 else
 ctx.arc(x0,y0,R,0,Math.PI*2,true);},
 
 _getYPointOfLineChart: function(data,point0,point1,params){var minValue = params.minValue;var maxValue = params.maxValue;var unit = params.unit;var valueFactor = params.valueFactor;var value = this._settings.value(data);var v = (parseFloat(value||0) - minValue)*valueFactor;if(!this._settings.yAxis)v += params.startValue/unit;var y = point1.y - Math.floor(unit*v);if(v<0)y = point1.y;if(value > maxValue)y = point0.y;if(value < minValue)y = point1.y;return y;},
 _calculateParametersOfLineChart: function(ctx,data,point0,point1,sIndex){var params = {};var relValue;params.totalHeight = point1.y-point0.y;params.cellWidth = Math.round((point1.x-point0.x)/((!this._settings.offset)?(data.length-1):data.length));var yax = !!this._settings.yAxis;var limits = (this._settings.view.indexOf("stacked")!=-1?this._getStackedLimits(data):this._getLimits());params.maxValue = limits.max;params.minValue = limits.min;if(!sIndex)this._drawScales(ctx,data, point0, point1,params.minValue,params.maxValue,params.cellWidth);if(yax){params.maxValue = parseFloat(this._settings.yAxis.end);params.minValue = parseFloat(this._settings.yAxis.start);}
 
 
 var relativeValues = this._getRelativeValue(params.minValue,params.maxValue);relValue = relativeValues[0];params.valueFactor = relativeValues[1];params.unit = (relValue?params.totalHeight/relValue:10);params.startValue = 0;if(!yax){params.startValue = 10;if(params.unit!=params.totalHeight)params.unit = (relValue?(params.totalHeight - params.startValue)/relValue:10);}
 return params;}
};dhtmlx.chart.bar = {pvt_render_bar:function(ctx, data, point0, point1, sIndex, map){var maxValue,minValue;var valueFactor;var relValue;var total_height = point1.y-point0.y;var yax = !!this._settings.yAxis;var xax = !!this._settings.xAxis;var limits = this._getLimits();maxValue = limits.max;minValue = limits.min;var cellWidth = Math.floor((point1.x-point0.x)/data.length);if(!sIndex&&!(this._settings.origin!="auto"&&!yax)){this._drawScales(ctx,data,point0, point1,minValue,maxValue,cellWidth);}
 
 
 if(yax){maxValue = parseFloat(this._settings.yAxis.end);minValue = parseFloat(this._settings.yAxis.start);}
 
 
 var relativeValues = this._getRelativeValue(minValue,maxValue);relValue = relativeValues[0];valueFactor = relativeValues[1];var unit = (relValue?total_height/relValue:relValue);if(!yax&&!(this._settings.origin!="auto"&&xax)){var startValue = 10;unit = (relValue?(total_height-startValue)/relValue:startValue);}
 
 if(!sIndex&&(this._settings.origin!="auto"&&!yax)&&this._settings.origin>minValue){this._drawXAxis(ctx,data,point0,point1,cellWidth,point1.y-unit*(this._settings.origin-minValue));}
 
 
 var barWidth = parseInt(this._settings.width,10);if(this._series&&(barWidth*this._series.length+4)>cellWidth) barWidth = parseInt(cellWidth/this._series.length-4,10);var barOffset = Math.floor((cellWidth - barWidth*this._series.length)/2);var radius = (typeof this._settings.radius!="undefined"?parseInt(this._settings.radius,10):Math.round(barWidth/5));var inner_gradient = false;var gradient = this._settings.gradient;if(gradient && typeof(gradient)!= "function"){inner_gradient = gradient;gradient = false;}else if (gradient){gradient = ctx.createLinearGradient(0,point1.y,0,point0.y);this._settings.gradient(gradient);}
 
 if(!xax){this._drawLine(ctx,point0.x,point1.y+0.5,point1.x,point1.y+0.5,"#000000",1);}
 
 for(var i=0;i < data.length;i ++){var value = parseFloat(this._settings.value(data[i]||0));if(value>maxValue)value = maxValue;value -= minValue;value *= valueFactor;var x0 = point0.x + barOffset + i*cellWidth+(barWidth+1)*sIndex;var y0 = point1.y+0.5;if(value<0||(this._settings.yAxis&&value===0&&!(this._settings.origin!="auto"&&this._settings.origin>minValue))){this.renderTextAt(true, true, x0+Math.floor(barWidth/2),y0,this._settings.label(data[i]));continue;}
 
 
 if(!yax&&!(this._settings.origin!="auto"&&xax)) value += startValue/unit;var color = gradient||this._settings.color.call(this,data[i]);ctx.globalAlpha = this._settings.alpha.call(this,data[i]);var points = this._drawBar(ctx,point0,x0,y0,barWidth,minValue,radius,unit,value,color,gradient,inner_gradient);if (inner_gradient){this._drawBarGradient(ctx,x0,y0,barWidth,minValue,radius,unit,value,color,inner_gradient);}
 
 if(this._settings.border)this._drawBarBorder(ctx,x0,y0,barWidth,minValue,radius,unit,value,color);ctx.globalAlpha = 1;if(points[0]!=x0)this.renderTextAt(false, true, x0+Math.floor(barWidth/2),points[1],this._settings.label(data[i]));else
 this.renderTextAt(true, true, x0+Math.floor(barWidth/2),points[3],this._settings.label(data[i]));map.addRect(data[i].id,[x0,points[3],points[2],points[1]],sIndex);}
 },
 _correctBarParams:function(ctx,x,y,value,unit,barWidth,minValue){var xax = this._settings.xAxis;var axisStart = y;if(!!xax&&this._settings.origin!="auto" && (this._settings.origin>minValue)){y -= (this._settings.origin-minValue)*unit;axisStart = y;value = value-(this._settings.origin-minValue);if(value < 0){value *= (-1);ctx.translate(x+barWidth,y);ctx.rotate(Math.PI);x = 0;y = 0;}
 y -= 0.5;}
 
 return {value:value,x0:parseInt(x,10),y0:parseInt(y,10),start:axisStart}
 },
 _drawBar:function(ctx,point0,x0,y0,barWidth,minValue,radius,unit,value,color,gradient,inner_gradient){ctx.save();ctx.fillStyle = color;var p = this._correctBarParams(ctx,x0,y0,value,unit,barWidth,minValue);var points = this._setBarPoints(ctx,p.x0,p.y0,barWidth,radius,unit,p.value,(this._settings.border?1:0));if (gradient&&!inner_gradient)ctx.lineTo(p.x0+(this._settings.border?1:0),point0.y);ctx.fill();ctx.restore();var x1 = p.x0;var x2 = (p.x0!=x0?x0+points[0]:points[0]);var y1 = (p.x0!=x0?(p.start-points[1]):y0);var y2 = (p.x0!=x0?p.start:points[1]);return [x1,y1,x2,y2];},
 _setBorderStyles:function(ctx,color){var hsv,rgb;rgb = dhtmlx.math.toRgb(color);hsv = dhtmlx.math.rgbToHsv(rgb[0],rgb[1],rgb[2]);hsv[2] /= 2;color = "rgb("+dhtmlx.math.hsvToRgb(hsv[0],hsv[1],hsv[2])+")";ctx.strokeStyle = color;if(ctx.globalAlpha==1)ctx.globalAlpha = 0.9;},
 _drawBarBorder:function(ctx,x0,y0,barWidth,minValue,radius,unit,value,color){var p;ctx.save();p = this._correctBarParams(ctx,x0,y0,value,unit,barWidth,minValue);this._setBorderStyles(ctx,color);this._setBarPoints(ctx,p.x0,p.y0,barWidth,radius,unit,p.value,ctx.lineWidth/2,1);ctx.stroke();ctx.restore();},
 _drawBarGradient:function(ctx,x0,y0,barWidth,minValue,radius,unit,value,color,inner_gradient){ctx.save();var p = this._correctBarParams(ctx,x0,y0,value,unit,barWidth,minValue);var gradParam = this._setBarGradient(ctx,p.x0,p.y0,p.x0+barWidth,p.y0-unit*p.value+2,inner_gradient,color,"y");var borderOffset = this._settings.border?1:0;ctx.fillStyle = gradParam.gradient;this._setBarPoints(ctx,p.x0+gradParam.offset,p.y0,barWidth-gradParam.offset*2,radius,unit,p.value,gradParam.offset+borderOffset);ctx.fill();ctx.restore();},
 
 _setBarPoints:function(ctx,x0,y0,barWidth,radius,unit,value,offset,skipBottom){ctx.beginPath();var angle_corr = 0;if(radius>unit*value){var cosA = (radius-unit*value)/radius;if(cosA<=1&&cosA>=-1)angle_corr = -Math.acos(cosA)+Math.PI/2;}
 
 ctx.moveTo(x0+offset,y0);var y1 = y0 - Math.floor(unit*value) + radius + (radius?0:offset);if(radius<unit*value)ctx.lineTo(x0+offset,y1);var x2 = x0 + radius;if (radius&&radius>0)ctx.arc(x2,y1,radius-offset,-Math.PI+angle_corr,-Math.PI/2,false);var x3 = x0 + barWidth - radius - (radius?0:offset);var y3 = y1 - radius+(radius?offset:0);ctx.lineTo(x3,y3);if (radius&&radius>0)ctx.arc(x3,y1,radius-offset,-Math.PI/2,0-angle_corr,false);var x5 = x0 + barWidth-offset;ctx.lineTo(x5,y0);if(!skipBottom){ctx.lineTo(x0+offset,y0);}
 
 return [x5,y3];}
};dhtmlx.chart.pie = {pvt_render_pie:function(ctx,data,x,y,sIndex,map){this._renderPie(ctx,data,x,y,1,map);},
 
 _renderPie:function(ctx,data,point0,point1,ky,map){if(!data.length)return;var coord = this._getPieParameters(point0,point1);var radius = (this._settings.radius?this._settings.radius:coord.radius);if(radius<0)return;var values = this._getValues(data);var totalValue = this._getTotalValue(values);var ratios = this._getRatios(values,totalValue);var x0 = (this._settings.x?this._settings.x:coord.x);var y0 = (this._settings.y?this._settings.y:coord.y);if(ky==1&&this._settings.shadow)this._addShadow(ctx,x0,y0,radius);y0 = y0/ky;var alpha0 = -Math.PI/2;var angles = [];ctx.scale(1,ky);if (this._settings.gradient){var x1 = (ky!=1?x0+radius/3:x0);var y1 = (ky!=1?y0+radius/3:y0);this._showRadialGradient(ctx,x0,y0,radius,x1,y1);}
 for(var i = 0;i < data.length;i++){if (!values[i])continue;ctx.strokeStyle = this._settings.lineColor.call(this,data[i]);ctx.beginPath();ctx.moveTo(x0,y0);angles.push(alpha0);alpha1 = -Math.PI/2+ratios[i]-0.0001;ctx.arc(x0,y0,radius,alpha0,alpha1,false);ctx.lineTo(x0,y0);var color = this._settings.color.call(this,data[i]);ctx.fillStyle = color;ctx.fill();if(this._settings.pieInnerText)this._drawSectorLabel(x0,y0,5*radius/6,alpha0,alpha1,ky,this._settings.pieInnerText(data[i],totalValue),true);if(this._settings.label)this._drawSectorLabel(x0,y0,radius+this._settings.labelOffset,alpha0,alpha1,ky,this._settings.label(data[i]));if(ky!=1){this._createLowerSector(ctx,x0,y0,alpha0,alpha1,radius,true);ctx.fillStyle = "#000000";ctx.globalAlpha = 0.2;this._createLowerSector(ctx,x0,y0,alpha0,alpha1,radius,false);ctx.globalAlpha = 1;ctx.fillStyle = color;}
 
 map.addSector(data[i].id,alpha0,alpha1,x0,y0,radius,ky);alpha0 = alpha1;}
 
 ctx.globalAlpha = 0.8;var p;for(i=0;i< angles.length;i++){p = this._getPositionByAngle(angles[i],x0,y0,radius);this._drawLine(ctx,x0,y0,p.x,p.y,this._settings.lineColor.call(this,data[i]),2);}
 if(ky==1){ctx.lineWidth = 2;ctx.strokeStyle = "#ffffff";ctx.beginPath();ctx.arc(x0,y0,radius+1,0,2*Math.PI,false);ctx.stroke();}
 ctx.globalAlpha =1;ctx.scale(1,1/ky);},
 
 _getValues:function(data){var v = [];for(var i = 0;i < data.length;i++)v.push(parseFloat(this._settings.value(data[i])||0));return v;},
 
 _getTotalValue:function(values){var t=0;for(var i = 0;i < values.length;i++)t += values[i];return t;},
 
 _getRatios:function(values,totalValue){var value;var ratios = [];var prevSum = 0;totalValue = totalValue||this._getTotalValue(values);for(var i = 0;i < values.length;i++){value = values[i];ratios[i] = Math.PI*2*(totalValue?((value+prevSum)/totalValue):(1/data.length));prevSum += value;}
 return ratios;},
 
 _getPieParameters:function(point0,point1){var width = point1.x-point0.x;var height = point1.y-point0.y;var x0 = point0.x+width/2;var y0 = point0.y+height/2;var radius = Math.min(width/2,height/2);return {"x":x0,"y":y0,"radius":radius};},
 
 _createLowerSector:function(ctx,x0,y0,a1,a2,R,line){ctx.lineWidth = 1;if(!((a1<=0 && a2>=0)||(a1>=0 && a2<=Math.PI)||(Math.abs(a1-Math.PI)>0.003&&a1<=Math.PI && a2>=Math.PI))) return;if(a1<=0 && a2>=0){a1 = 0;line = false;this._drawSectorLine(ctx,x0,y0,R,a1,a2);}
 if(a1<=Math.PI && a2>=Math.PI){a2 = Math.PI;line = false;this._drawSectorLine(ctx,x0,y0,R,a1,a2);}
 
 var offset = (this._settings.height||Math.floor(R/4))/this._settings.cant;ctx.beginPath();ctx.arc(x0,y0,R,a1,a2,false);ctx.lineTo(x0+R*Math.cos(a2),y0+R*Math.sin(a2)+offset);ctx.arc(x0,y0+offset,R,a2,a1,true);ctx.lineTo(x0+R*Math.cos(a1),y0+R*Math.sin(a1));ctx.fill();if(line)ctx.stroke();},
 
 _drawSectorLine:function(ctx,x0,y0,R,a1,a2){ctx.beginPath();ctx.arc(x0,y0,R,a1,a2,false);ctx.stroke();},
 
 _addShadow:function(ctx,x,y,R){ctx.globalAlpha = 0.5;var shadows = ["#c4c4c4","#c6c6c6","#cacaca","#dcdcdc","#dddddd","#e0e0e0","#eeeeee","#f5f5f5","#f8f8f8"];for(var i = shadows.length-1;i>-1;i--){ctx.beginPath();ctx.fillStyle = shadows[i];ctx.arc(x+1,y+1,R+i,0,Math.PI*2,true);ctx.fill();}
 ctx.globalAlpha = 1
 },
 
 _getGrayGradient:function(gradient){gradient.addColorStop(0.0,"#ffffff");gradient.addColorStop(0.7,"#7a7a7a");gradient.addColorStop(1.0,"#000000");return gradient;},
 
 _showRadialGradient:function(ctx,x,y,radius,x0,y0){ctx.beginPath();var gradient;if(typeof this._settings.gradient!= "function"){gradient = ctx.createRadialGradient(x0,y0,radius/4,x,y,radius);gradient = this._getGrayGradient(gradient);}
 else gradient = this._settings.gradient(gradient);ctx.fillStyle = gradient;ctx.arc(x,y,radius,0,Math.PI*2,true);ctx.fill();ctx.globalAlpha = 0.7;},
 
 _drawSectorLabel:function(x0,y0,R,alpha1,alpha2,ky,text,in_width){var t = this.renderText(0,0,text,0,1);if (!t)return;var labelWidth = t.scrollWidth;t.style.width = labelWidth+"px";if (labelWidth>x0)labelWidth = x0;var width = (alpha2-alpha1<0.2?4:8);if (in_width)width = labelWidth/1.8;var alpha = alpha1+(alpha2-alpha1)/2;R = R-(width-8)/2;var corr_x = - width;var corr_y = -8;var align = "right";if(alpha>=Math.PI/2 && alpha<Math.PI || alpha<=3*Math.PI/2 && alpha>=Math.PI){corr_x = -labelWidth-corr_x+1;align = "left";}
 
 
 var offset = 0;if(!in_width&&ky<1&&(alpha>0&&alpha<Math.PI))
 offset = (this._settings.height||Math.floor(R/4))/ky;var y = (y0+Math.floor((R+offset)*Math.sin(alpha)))*ky+corr_y;var x = x0+Math.floor((R+width/2)*Math.cos(alpha))+corr_x;var left_end = (alpha2 < Math.PI/2+0.01);var left_start = (alpha1 < Math.PI/2);if (left_start && left_end){x = Math.max(x,x0+3);if(alpha2-alpha1<0.2)x = x0;}
 else if (!left_start && !left_end)x = Math.min(x,x0-labelWidth);else if (!in_width&&(alpha>=Math.PI/2 && alpha<Math.PI || alpha<=3*Math.PI/2 && alpha>=Math.PI)){x += labelWidth/3;}
 

 
 t.style.top = y+"px";t.style.left = x+"px";t.style.width = labelWidth+"px";t.style.textAlign = align;t.style.whiteSpace = "nowrap";}
};dhtmlx.chart.pie3D = {pvt_render_pie3D:function(ctx,data,x,y,sIndex,map){this._renderPie(ctx,data,x,y,this._settings.cant,map);}
};dhtmlx.chart.donut = {pvt_render_donut:function(ctx,data,point0,point1,sIndex,map){if(!data.length)return;this._renderPie(ctx,data,point0,point1,1,map);var config = this._settings;var coord = this._getPieParameters(point0,point1);var pieRadius = (config.radius?config.radius:coord.radius);var innerRadius = ((config.innerRadius&&(config.innerRadius<pieRadius))?config.innerRadius:pieRadius/3);var x0 = (config.x?config.x:coord.x);var y0 = (config.y?config.y:coord.y);ctx.fillStyle = "#ffffff";ctx.beginPath();ctx.arc(x0,y0,innerRadius,0,Math.PI*2,true);ctx.fill();}
};dhtmlx.Template={_cache:{},
 empty:function(){return "";},
 setter:function(value){return dhtmlx.Template.fromHTML(value);},
 obj_setter:function(value){var f = dhtmlx.Template.setter(value);var obj = this;return function(){return f.apply(obj, arguments);};},
 fromHTML:function(str){if (typeof str == "function")return str;if (this._cache[str])return this._cache[str];str=(str||"").toString();str=str.replace(/[\r\n]+/g,"\\n");str=str.replace(/\{obj\.([^}?]+)\?([^:]*):([^}]*)\}/g,"\"+(obj.$1?\"$2\":\"$3\")+\"");str=str.replace(/\{common\.([^}\(]*)\}/g,"\"+common.$1+\"");str=str.replace(/\{common\.([^\}\(]*)\(\)\}/g,"\"+(common.$1?common.$1(obj):\"\")+\"");str=str.replace(/\{obj\.([^}]*)\}/g,"\"+obj.$1+\"");str=str.replace(/#([a-z0-9_]+)#/gi,"\"+obj.$1+\"");str=str.replace(/\{obj\}/g,"\"+obj+\"");str=str.replace(/\{-obj/g,"{obj");str=str.replace(/\{-common/g,"{common");str="return \""+str+"\";";return this._cache[str]= Function("obj","common",str);}
};dhtmlx.Type={add:function(obj, data){if (!obj.types && obj.prototype.types)obj = obj.prototype;if (dhtmlx.assert_enabled())
 this.assert_event(data);var name = data.name||"default";this._template(data);this._template(data,"edit");this._template(data,"loading");obj.types[name]=dhtmlx.extend(dhtmlx.extend({},(obj.types[name]||this._default)),data);return name;},
 
 _default:{css:"default",
 template:function(){return "";},
 template_edit:function(){return "";},
 template_loading:function(){return "...";},
 width:150,
 height:80,
 margin:5,
 padding:0
 },
 
 _template:function(obj,name){name = "template"+(name?("_"+name):"");var data = obj[name];if (data && (typeof data == "string")){if (data.indexOf("->")!=-1){data = data.split("->");switch(data[0]){case "html": 
 data = dhtmlx.html.getValue(data[1]).replace(/\"/g,"\\\"");break;case "http": 
 data = new dhtmlx.ajax().sync().get(data[1],{uid:(new Date()).valueOf()}).responseText;break;default:
 
 break;}
 }
 obj[name] = dhtmlx.Template.fromHTML(data);}
 }
};dhtmlx.SingleRender={_init:function(){},
 
 _toHTML:function(obj){return this.type._item_start(obj,this.type)+this.type.template(obj,this.type)+this.type._item_end;},
 
 render:function(){if (!this.callEvent || this.callEvent("onBeforeRender",[this.data])){if (this.data)this._dataobj.innerHTML = this._toHTML(this.data);if (this.callEvent)this.callEvent("onAfterRender",[]);}
 }
};dhtmlx.ui.Tooltip=function(container){this.name = "Tooltip";this.version = "3.0";if (dhtmlx.assert_enabled()) this._assert();if (typeof container == "string"){container = {template:container };}
 
 dhtmlx.extend(this, dhtmlx.Settings);dhtmlx.extend(this, dhtmlx.SingleRender);this._parseSettings(container,{type:"default",
 dy:0,
 dx:20
 });this._dataobj = this._obj = document.createElement("DIV");this._obj.className="dhx_tooltip";dhtmlx.html.insertBefore(this._obj,document.body.firstChild);};dhtmlx.ui.Tooltip.prototype = {show:function(data,pos){if (this._disabled)return;if (this.data!=data){this.data=data;this.render(data);}
 
 this._obj.style.top = pos.y+this._settings.dy+"px";this._obj.style.left = pos.x+this._settings.dx+"px";this._obj.style.display="block";},
 
 hide:function(){this.data=null;this._obj.style.display="none";},
 disable:function(){this._disabled = true;},
 enable:function(){this._disabled = false;},
 types:{"default":dhtmlx.Template.fromHTML("{obj.id}")
 },
 template_item_start:dhtmlx.Template.empty,
 template_item_end:dhtmlx.Template.empty
};dhtmlx.AutoTooltip = {tooltip_setter:function(value){var t = new dhtmlx.ui.Tooltip(value);this.attachEvent("onMouseMove",function(id,e){t.show(this.get(id),dhtmlx.html.pos(e));});this.attachEvent("onMouseOut",function(id,e){t.hide();});this.attachEvent("onMouseMoving",function(id,e){t.hide();});return t;}
};dhtmlx.ajax = function(url,call,master){if (arguments.length!==0){var http_request = new dhtmlx.ajax();if (master)http_request.master=master;http_request.get(url,null,call);}
 if (!this.getXHR)return new dhtmlx.ajax();return this;};dhtmlx.ajax.prototype={getXHR:function(){if (dhtmlx._isIE)return new ActiveXObject("Microsoft.xmlHTTP");else 
 return new XMLHttpRequest();},
 
 send:function(url,params,call){var x=this.getXHR();if (typeof call == "function")call = [call];if (typeof params == "object"){var t=[];for (var a in params){var value = params[a];if (value === null || value === dhtmlx.undefined)value = "";t.push(a+"="+encodeURIComponent(value));}
 params=t.join("&");}
 if (params && !this.post){url=url+(url.indexOf("?")!=-1 ? "&" : "?")+params;params=null;}
 
 x.open(this.post?"POST":"GET",url,!this._sync);if (this.post)x.setRequestHeader('Content-type','application/x-www-form-urlencoded');var self=this;x.onreadystatechange= function(){if (!x.readyState || x.readyState == 4){dhtmlx.log_full_time("data_loading");if (call && self)for (var i=0;i < call.length;i++)if (call[i])call[i].call((self.master||self),x.responseText,x.responseXML,x);self.master=null;call=self=null;}
 };x.send(params||null);return x;},
 
 get:function(url,params,call){this.post=false;return this.send(url,params,call);},
 
 post:function(url,params,call){this.post=true;return this.send(url,params,call);}, 
 sync:function(){this._sync = true;return this;}
};dhtmlx.AtomDataLoader={_init:function(config){this.data = {};if (config){this._settings.datatype = config.datatype||"json";this._after_init.push(this._load_when_ready);}
 },
 _load_when_ready:function(){this._ready_for_data = true;if (this._settings.url)this.url_setter(this._settings.url);if (this._settings.data)this.data_setter(this._settings.data);},
 url_setter:function(value){if (!this._ready_for_data)return value;this.load(value, this._settings.datatype);return value;},
 data_setter:function(value){if (!this._ready_for_data)return value;this.parse(value, this._settings.datatype);return true;},
 
 load:function(url,call){this.callEvent("onXLS",[]);if (typeof call == "string"){this.data.driver = dhtmlx.DataDriver[call];call = arguments[2];}
 else
 this.data.driver = dhtmlx.DataDriver["xml"];dhtmlx.ajax(url,[this._onLoad,call],this);},
 
 parse:function(data,type){this.callEvent("onXLS",[]);this.data.driver = dhtmlx.DataDriver[type||"xml"];this._onLoad(data,null);},
 
 _onLoad:function(text,xml,loader){var driver = this.data.driver;var top = driver.getRecords(driver.toObject(text,xml))[0];this.data=(driver?driver.getDetails(top):text);this.callEvent("onXLE",[]);},
 _check_data_feed:function(data){if (!this._settings.dataFeed || this._ignore_feed || !data)return true;var url = this._settings.dataFeed;if (typeof url == "function")return url.call(this, (data.id||data), data);url = url+(url.indexOf("?")==-1?"?":"&")+"action=get&id="+encodeURIComponent(data.id||data);this.callEvent("onXLS",[]);dhtmlx.ajax(url, function(text,xml){this._ignore_feed=true;this.setValues(dhtmlx.DataDriver.json.toObject(text)[0]);this._ignore_feed=false;this.callEvent("onXLE",[]);}, this);return false;}
};dhtmlx.DataDriver={};dhtmlx.DataDriver.json={toObject:function(data){if (!data)data="[]";if (typeof data == "string"){eval ("dhtmlx.temp="+data);return dhtmlx.temp;}
 return data;},
 
 getRecords:function(data){if (data && !(data instanceof Array))
 return [data];return data;},
 
 getDetails:function(data){return data;},
 
 getInfo:function(data){return {_size:(data.total_count||0),
 _from:(data.pos||0),
 _key:(data.dhx_security)
 };}
};dhtmlx.DataDriver.json_ext={toObject:function(data){if (!data)data="[]";if (typeof data == "string"){var temp;eval ("temp="+data);dhtmlx.temp = [];var header = temp.header;for (var i = 0;i < temp.data.length;i++){var item = {};for (var j = 0;j < header.length;j++){if (typeof(temp.data[i][j])!= "undefined")
 item[header[j]] = temp.data[i][j];}
 dhtmlx.temp.push(item);}
 return dhtmlx.temp;}
 return data;},
 
 getRecords:function(data){if (data && !(data instanceof Array))
 return [data];return data;},
 
 getDetails:function(data){return data;},
 
 getInfo:function(data){return {_size:(data.total_count||0),
 _from:(data.pos||0)
 };}
};dhtmlx.DataDriver.html={toObject:function(data){if (typeof data == "string"){var t=null;if (data.indexOf("<")==-1) 
 t = dhtmlx.toNode(data);if (!t){t=document.createElement("DIV");t.innerHTML = data;}
 
 return t.getElementsByTagName(this.tag);}
 return data;},
 
 getRecords:function(data){if (data.tagName)return data.childNodes;return data;},
 
 getDetails:function(data){return dhtmlx.DataDriver.xml.tagToObject(data);},
 
 getInfo:function(data){return {_size:0,
 _from:0
 };},
 tag: "LI"
};dhtmlx.DataDriver.jsarray={toObject:function(data){if (typeof data == "string"){eval ("dhtmlx.temp="+data);return dhtmlx.temp;}
 return data;},
 
 getRecords:function(data){return data;},
 
 getDetails:function(data){var result = {};for (var i=0;i < data.length;i++)result["data"+i]=data[i];return result;},
 
 getInfo:function(data){return {_size:0,
 _from:0
 };}
};dhtmlx.DataDriver.csv={toObject:function(data){return data;},
 
 getRecords:function(data){return data.split(this.row);},
 
 getDetails:function(data){data = this.stringToArray(data);var result = {};for (var i=0;i < data.length;i++)result["data"+i]=data[i];return result;},
 
 getInfo:function(data){return {_size:0,
 _from:0
 };},
 
 stringToArray:function(data){data = data.split(this.cell);for (var i=0;i < data.length;i++)data[i] = data[i].replace(/^[ \t\n\r]*(\"|)/g,"").replace(/(\"|)[ \t\n\r]*$/g,"");return data;},
 row:"\n", 
 cell:"," 
};dhtmlx.DataDriver.xml={toObject:function(text,xml){if (xml && (xml=this.checkResponse(text,xml))) 
 return xml;if (typeof text == "string"){return this.fromString(text);}
 return text;},
 
 getRecords:function(data){return this.xpath(data,this.records);},
 records:"/*/item",
 
 getDetails:function(data){return this.tagToObject(data,{});},
 
 getInfo:function(data){return {_size:(data.documentElement.getAttribute("total_count")||0),
 _from:(data.documentElement.getAttribute("pos")||0),
 _key:(data.documentElement.getAttribute("dhx_security"))
 };},
 
 xpath:function(xml,path){if (window.XPathResult){var node=xml;if(xml.nodeName.indexOf("document")==-1)
 xml=xml.ownerDocument;var res = [];var col = xml.evaluate(path, node, null, XPathResult.ANY_TYPE, null);var temp = col.iterateNext();while (temp){res.push(temp);temp = col.iterateNext();}
 return res;}
 else {var test = true;try {if (typeof(xml.selectNodes)=="undefined")
 test = false;}catch(e){}
 
 if (test)return xml.selectNodes(path);else {var name = path.split("/").pop();return xml.getElementsByTagName(name);}
 }
 },
 
 tagToObject:function(tag,z){z=z||{};var flag=false;var a=tag.attributes;if(a && a.length){for (var i=0;i<a.length;i++)z[a[i].name]=a[i].value;flag = true;}
 
 
 var b=tag.childNodes;var state = {};for (var i=0;i<b.length;i++){if (b[i].nodeType==1){var name = b[i].tagName;if (typeof z[name] != "undefined"){if (!(z[name] instanceof Array))
 z[name]=[z[name]];z[name].push(this.tagToObject(b[i],{}));}
 else
 z[b[i].tagName]=this.tagToObject(b[i],{});flag=true;}
 }
 
 if (!flag)return this.nodeValue(tag);z.value = this.nodeValue(tag);return z;},
 
 nodeValue:function(node){if (node.firstChild)return node.firstChild.data;return "";},
 
 fromString:function(xmlString){if (window.DOMParser && !dhtmlx._isIE)return (new DOMParser()).parseFromString(xmlString,"text/xml");if (window.ActiveXObject){var temp=new ActiveXObject("Microsoft.xmlDOM");temp.loadXML(xmlString);return temp;}
 dhtmlx.error("Load from xml string is not supported");},
 
 checkResponse:function(text,xml){if (xml && ( xml.firstChild && xml.firstChild.tagName != "parsererror"))
 return xml;var a=this.fromString(text.replace(/^[\s]+/,""));if (a)return a;dhtmlx.error("xml can't be parsed",text);}
};dhtmlx.DataLoader={_init:function(config){config = config || "";this.name = "DataStore";this.data = (config.datastore)||(new dhtmlx.DataStore());this._readyHandler = this.data.attachEvent("onStoreLoad",dhtmlx.bind(this._call_onready,this));},
 
 load:function(url,call){dhtmlx.AtomDataLoader.load.apply(this, arguments);if (!this.data.feed)this.data.feed = function(from,count){if (this._load_count)return this._load_count=[from,count];else
 this._load_count=true;this.load(url+((url.indexOf("?")==-1)?"?":"&")+"posStart="+from+"&count="+count,function(){var temp = this._load_count;this._load_count = false;if (typeof temp =="object")this.data.feed.apply(this, temp);});};},
 
 _onLoad:function(text,xml,loader){this.data._parse(this.data.driver.toObject(text,xml));this.callEvent("onXLE",[]);if(this._readyHandler){this.data.detachEvent(this._readyHandler);this._readyHandler = null;}
 },
 dataFeed_setter:function(value){this.data.attachEvent("onBeforeFilter", dhtmlx.bind(function(text, value){if (this._settings.dataFeed){var filter = {};if (!text && !filter)return;if (typeof text == "function"){if (!value)return;text(value, filter);}else 
 filter = {text:value };this.clearAll();var url = this._settings.dataFeed;if (typeof url == "function")return url.call(this, value, filter);var urldata = [];for (var key in filter)urldata.push("dhx_filter["+key+"]="+encodeURIComponent(filter[key]));this.load(url+(url.indexOf("?")<0?"?":"&")+urldata.join("&"), this._settings.datatype);return false;}
 },this));return value;},
 _call_onready:function(){if (this._settings.ready){var code = dhtmlx.toFunctor(this._settings.ready);if (code && code.call)code.apply(this, arguments);}
 }
};dhtmlx.DataStore = function(){this.name = "DataStore";dhtmlx.extend(this, dhtmlx.EventSystem);this.setDriver("xml");this.pull = {};this.order = dhtmlx.toArray();};dhtmlx.DataStore.prototype={setDriver:function(type){dhtmlx.assert(dhtmlx.DataDriver[type],"incorrect DataDriver");this.driver = dhtmlx.DataDriver[type];},
 
 _parse:function(data){this.callEvent("onParse", [this.driver, data]);if (this._filter_order)this.filter();var info = this.driver.getInfo(data);if (info._key)dhtmlx.security_key = info._key;var recs = this.driver.getRecords(data);var from = (info._from||0)*1;if (from === 0 && this.order[0])from = this.order.length;var j=0;for (var i=0;i<recs.length;i++){var temp = this.driver.getDetails(recs[i]);var id = this.id(temp);if (!this.pull[id]){this.order[j+from]=id;j++;}
 this.pull[id]=temp;if (this.extraParser)this.extraParser(temp);if (this._scheme){if (this._scheme.$init)this._scheme.$update(temp);else if (this._scheme.$update)this._scheme.$update(temp);}
 }
 
 for (var i=0;i < info._size;i++)if (!this.order[i]){var id = dhtmlx.uid();var temp = {id:id, $template:"loading"};this.pull[id]=temp;this.order[i]=id;}
 this.callEvent("onStoreLoad",[this.driver, data]);this.refresh();},
 
 id:function(data){return data.id||(data.id=dhtmlx.uid());},
 changeId:function(old, newid){dhtmlx.assert(this.pull[old],"Can't change id, for non existing item: "+old);this.pull[newid] = this.pull[old];this.pull[newid].id = newid;this.order[this.order.find(old)]=newid;if (this._filter_order)this._filter_order[this._filter_order.find(old)]=newid;this.callEvent("onIdChange", [old, newid]);if (this._render_change_id)this._render_change_id(old, newid);},
 get:function(id){return this.item(id);},
 set:function(id, data){return this.update(id, data);},
 
 item:function(id){return this.pull[id];},
 
 update:function(id,data){if (this._scheme && this._scheme.$update)this._scheme.$update(data);if (this.callEvent("onBeforeUpdate", [id, data])=== false) return false;this.pull[id]=data;this.refresh(id);},
 
 refresh:function(id){if (this._skip_refresh)return;if (id)this.callEvent("onStoreUpdated",[id, this.pull[id], "update"]);else
 this.callEvent("onStoreUpdated",[null,null,null]);},
 silent:function(code){this._skip_refresh = true;code.call(this);this._skip_refresh = false;},
 
 getRange:function(from,to){if (from)from = this.indexById(from);else 
 from = this.startOffset||0;if (to)to = this.indexById(to);else {to = Math.min((this.endOffset||Infinity),(this.dataCount()-1));if (to<0)to = 0;}
 if (from>to){var a=to;to=from;from=a;}
 
 return this.getIndexRange(from,to);},
 
 getIndexRange:function(from,to){to=Math.min((to||Infinity),this.dataCount()-1);var ret=dhtmlx.toArray();for (var i=(from||0);i <= to;i++)
 ret.push(this.item(this.order[i]));return ret;},
 
 dataCount:function(){return this.order.length;},
 
 exists:function(id){return !!(this.pull[id]);},
 
 
 move:function(sindex,tindex){if (sindex<0 || tindex<0){dhtmlx.error("DataStore::move","Incorrect indexes");return;}
 
 var id = this.idByIndex(sindex);var obj = this.item(id);this.order.removeAt(sindex);this.order.insertAt(id,Math.min(this.order.length, tindex));this.callEvent("onStoreUpdated",[id,obj,"move"]);},
 scheme:function(config){this._scheme = config;},
 sync:function(source, filter, silent){if (typeof filter != "function"){silent = filter;filter = null;}
 
 if (dhtmlx.debug_bind){this.debug_sync_master = source;dhtmlx.log("[sync] "+this.debug_bind_master.name+"@"+this.debug_bind_master._settings.id+" <= "+this.debug_sync_master.name+"@"+this.debug_sync_master._settings.id);}
 
 var topsource = source;if (source.name != "DataStore")source = source.data;var sync_logic = dhtmlx.bind(function(id, data, mode){if (mode != "update" || filter)id = null;if (!id){this.order = dhtmlx.toArray([].concat(source.order));this._filter_order = null;this.pull = source.pull;if (filter)this.silent(filter);if (this._on_sync)this._on_sync();}
 if (dhtmlx.debug_bind)dhtmlx.log("[sync:request] "+this.debug_sync_master.name+"@"+this.debug_sync_master._settings.id + " <= "+this.debug_bind_master.name+"@"+this.debug_bind_master._settings.id);if (!silent)this.refresh(id);else
 silent = false;}, this);source.attachEvent("onStoreUpdated", sync_logic);this.feed = function(from, count){topsource.loadNext(count, from);};sync_logic();},
 
 add:function(obj,index){if (this._scheme){obj = obj||{};for (var key in this._scheme)obj[key] = obj[key]||this._scheme[key];if (this._scheme){if (this._scheme.$init)this._scheme.$update(obj);else if (this._scheme.$update)this._scheme.$update(obj);}
 }
 
 
 var id = this.id(obj);var data_size = this.dataCount();if (dhtmlx.isNotDefined(index)|| index < 0)
 index = data_size;if (index > data_size){dhtmlx.log("Warning","DataStore:add","Index of out of bounds");index = Math.min(this.order.length,index);}
 if (this.callEvent("onBeforeAdd", [id, obj, index])=== false) return false;if (this.exists(id)) return dhtmlx.error("Not unique ID");this.pull[id]=obj;this.order.insertAt(id,index);if (this._filter_order){var original_index = this._filter_order.length;if (!index && this.order.length)original_index = 0;this._filter_order.insertAt(id,original_index);}
 this.callEvent("onafterAdd",[id,index]);this.callEvent("onStoreUpdated",[id,obj,"add"]);return id;},
 
 
 remove:function(id){if (id instanceof Array){for (var i=0;i < id.length;i++)this.remove(id[i]);return;}
 if (this.callEvent("onBeforeDelete",[id])=== false) return false;if (!this.exists(id)) return dhtmlx.error("Not existing ID",id);var obj = this.item(id);this.order.remove(id);if (this._filter_order)this._filter_order.remove(id);delete this.pull[id];this.callEvent("onafterdelete",[id]);this.callEvent("onStoreUpdated",[id,obj,"delete"]);},
 
 clearAll:function(){this.pull = {};this.order = dhtmlx.toArray();this.feed = null;this._filter_order = null;this.callEvent("onClearAll",[]);this.refresh();},
 
 idByIndex:function(index){if (index>=this.order.length || index<0)dhtmlx.log("Warning","DataStore::idByIndex Incorrect index");return this.order[index];},
 
 indexById:function(id){var res = this.order.find(id);return res;},
 
 next:function(id,step){return this.order[this.indexById(id)+(step||1)];},
 
 first:function(){return this.order[0];},
 
 last:function(){return this.order[this.order.length-1];},
 
 previous:function(id,step){return this.order[this.indexById(id)-(step||1)];},
 
 sort:function(by, dir, as){var sort = by;if (typeof by == "function")sort = {as:by, dir:dir};else if (typeof by == "string")sort = {by:by, dir:dir, as:as};var parameters = [sort.by, sort.dir, sort.as];if (!this.callEvent("onbeforesort",parameters)) return;if (this.order.length){var sorter = dhtmlx.sort.create(sort);var neworder = this.getRange(this.first(), this.last());neworder.sort(sorter);this.order = neworder.map(function(obj){return this.id(obj);},this);}
 
 
 this.refresh();this.callEvent("onaftersort",parameters);},
 
 filter:function(text,value){if (!this.callEvent("onBeforeFilter", [text, value])) return;if (this._filter_order){this.order = this._filter_order;delete this._filter_order;}
 
 if (!this.order.length)return;if (text){var filter = text;value = value||"";if (typeof text == "string"){text = dhtmlx.Template.fromHTML(text);value = value.toString().toLowerCase();filter = function(obj,value){return text(obj).toLowerCase().indexOf(value)!=-1;};}
 
 
 var neworder = dhtmlx.toArray();for (var i=0;i < this.order.length;i++){var id = this.order[i];if (filter(this.item(id),value))
 neworder.push(id);}
 
 this._filter_order = this.order;this.order = neworder;}
 
 this.refresh();this.callEvent("onAfterFilter", []);},
 
 each:function(method,master){for (var i=0;i<this.order.length;i++)method.call((master||this), this.item(this.order[i]));},
 
 provideApi:function(target,eventable){this.debug_bind_master = target;if (eventable){this.mapEvent({onbeforesort: target,
 onaftersort: target,
 onbeforeadd: target,
 onafteradd: target,
 onbeforedelete: target,
 onafterdelete: target,
 onbeforeupdate: target
 });}
 
 var list = ["get","set","sort","add","remove","exists","idByIndex","indexById","item","update","refresh","dataCount","filter","next","previous","clearAll","first","last","serialize"];for (var i=0;i < list.length;i++)target[list[i]]=dhtmlx.methodPush(this,list[i]);if (dhtmlx.assert_enabled()) 
 this.assert_event(target);},
 
 serialize: function(){var ids = this.order;var result = [];for(var i=0;i< ids.length;i++)result.push(this.pull[ids[i]]);return result;}
};dhtmlx.sort = {create:function(config){return dhtmlx.sort.dir(config.dir, dhtmlx.sort.by(config.by, config.as));},
 as:{"int":function(a,b){a = a*1;b=b*1;return a>b?1:(a<b?-1:0);},
 "string_strict":function(a,b){a = a.toString();b=b.toString();return a>b?1:(a<b?-1:0);},
 "string":function(a,b){a = a.toString().toLowerCase();b=b.toString().toLowerCase();return a>b?1:(a<b?-1:0);}
 },
 by:function(prop, method){if (!prop)return method;if (typeof method != "function")method = dhtmlx.sort.as[method||"string"];prop = dhtmlx.Template.fromHTML(prop);return function(a,b){return method(prop(a),prop(b));};},
 dir:function(prop, method){if (prop == "asc")return method;return function(a,b){return method(a,b)*-1;};}
};dhtmlx.Group = {_init:function(){dhtmlx.assert(this.data,"DataStore required for grouping");this.data.attachEvent("onStoreLoad",dhtmlx.bind(function(){if (this._settings.group)this.group(this._settings.group,false);},this));this.attachEvent("onBeforeRender",dhtmlx.bind(function(data){if (this._settings.sort){data.block();data.sort(this._settings.sort);data.unblock();}
 },this));this.attachEvent("onBeforeSort",dhtmlx.bind(function(){this._settings.sort = null;},this));},
 _init_group_data_event:function(data,master){data.attachEvent("onClearAll",dhtmlx.bind(function(){this.ungroup(false);this.block();this.clearAll();this.unblock();},master));},
 sum:function(property, data){property = dhtmlx.Template.setter(property);data = data || this.data;var summ = 0;data.each(function(obj){summ+=property(obj)*1;});return summ;},
 min:function(property, data){property = dhtmlx.Template.setter(property);data = data || this.data;var min = Infinity;data.each(function(obj){if (property(obj)*1 < min) min = property(obj)*1;});return min*1;},
 max:function(property, data){property = dhtmlx.Template.setter(property);data = data || this.data;var max = -Infinity;data.each(function(obj){if (property(obj)*1 > max) max = property(obj)*1;});return max;},
 _split_data_by:function(stats){var any=function(property, data){property = dhtmlx.Template.setter(property);return property(data[0]);};var key = dhtmlx.Template.setter(stats.by);if (!stats.map[key])stats.map[key] = [key, any];var groups = {};var labels = [];this.data.each(function(data){var current = key(data);if (!groups[current]){labels.push({id:current});groups[current] = dhtmlx.toArray();}
 groups[current].push(data);});for (var prop in stats.map){var functor = (stats.map[prop][1]||any);if (typeof functor != "function")functor = this[functor];for (var i=0;i < labels.length;i++){labels[i][prop]=functor.call(this, stats.map[prop][0], groups[labels[i].id]);}
 }
 
 this._not_grouped_data = this.data;this.data = new dhtmlx.DataStore();this.data.provideApi(this,true);this._init_group_data_event(this.data, this);this.parse(labels,"json");},
 group:function(config,mode){this.ungroup(false);this._split_data_by(config);if (mode!==false)this.render();},
 ungroup:function(mode){if (this._not_grouped_data){this.data = this._not_grouped_data;this.data.provideApi(this, true);}
 if (mode!==false)this.render();},
 group_setter:function(config){dhtmlx.assert(typeof config == "object", "Incorrect group value");dhtmlx.assert(config.by,"group.by is mandatory");dhtmlx.assert(config.map,"group.map is mandatory");return config;},
 
 sort_setter:function(config){if (typeof config != "object")config = {by:config };this._mergeSettings(config,{as:"string",
 dir:"asc"
 });return config;}
};dhtmlx.KeyEvents = {_init:function(){dhtmlx.event(this._obj,"keypress",this._onKeyPress,this);},
 
 _onKeyPress:function(e){e=e||event;var code = e.which||e.keyCode;this.callEvent((this._edit_id?"onEditKeyPress":"onKeyPress"),[code,e.ctrlKey,e.shiftKey,e]);}
};dhtmlx.MouseEvents={_init: function(){if (this.on_click){dhtmlx.event(this._obj,"click",this._onClick,this);dhtmlx.event(this._obj,"contextmenu",this._onContext,this);}
 if (this.on_dblclick)dhtmlx.event(this._obj,"dblclick",this._onDblClick,this);if (this.on_mouse_move){dhtmlx.event(this._obj,"mousemove",this._onMouse,this);dhtmlx.event(this._obj,(dhtmlx._isIE?"mouseleave":"mouseout"),this._onMouse,this);}
 },
 
 _onClick: function(e) {return this._mouseEvent(e,this.on_click,"ItemClick");},
 
 _onDblClick: function(e) {return this._mouseEvent(e,this.on_dblclick,"ItemDblClick");},
 
 _onContext: function(e) {var id = dhtmlx.html.locate(e, this._id);if (id && !this.callEvent("onBeforeContextMenu", [id,e]))
 return dhtmlx.html.preventEvent(e);},
 
 _onMouse:function(e){if (dhtmlx._isIE)e = document.createEventObject(event);if (this._mouse_move_timer)window.clearTimeout(this._mouse_move_timer);this.callEvent("onMouseMoving",[e]);this._mouse_move_timer = window.setTimeout(dhtmlx.bind(function(){if (e.type == "mousemove")this._onMouseMove(e);else
 this._onMouseOut(e);},this),500);},
 
 _onMouseMove: function(e) {if (!this._mouseEvent(e,this.on_mouse_move,"MouseMove"))
 this.callEvent("onMouseOut",[e||event]);},
 
 _onMouseOut: function(e) {this.callEvent("onMouseOut",[e||event]);},
 
 _mouseEvent:function(e,hash,name){e=e||event;var trg=e.target||e.srcElement;var css = "";var id = null;var found = false;while (trg && trg.parentNode){if (!found && trg.getAttribute){id = trg.getAttribute(this._id);if (id){if (trg.getAttribute("userdata"))
 this.callEvent("onLocateData",[id,trg]);if (!this.callEvent("on"+name,[id,e,trg])) return;found = true;}
 }
 css=trg.className;if (css){css = css.split(" ");css = css[0]||css[1];if (hash[css])return hash[css].call(this,e,id,trg);}
 trg=trg.parentNode;}
 return found;}
};dhtmlx.Settings={_init:function(){this._settings = this.config= {};},
 define:function(property, value){if (typeof property == "object")return this._parseSeetingColl(property);return this._define(property, value);},
 _define:function(property,value){dhtmlx.assert_settings.call(this,property,value);var setter = this[property+"_setter"];return this._settings[property]=setter?setter.call(this,value):value;},
 
 _parseSeetingColl:function(coll){if (coll){for (var a in coll)this._define(a,coll[a]);}
 },
 
 _parseSettings:function(obj,initial){var settings = dhtmlx.extend({},initial);if (typeof obj == "object" && !obj.tagName)dhtmlx.extend(settings,obj);this._parseSeetingColl(settings);},
 _mergeSettings:function(config, defaults){for (var key in defaults)switch(typeof config[key]){case "object": 
 config[key] = this._mergeSettings((config[key]||{}), defaults[key]);break;case "undefined":
 config[key] = defaults[key];break;default: 
 break;}
 return config;},
 
 _parseContainer:function(obj,name,fallback){if (typeof obj == "object" && !obj.tagName)obj=obj.container;this._obj = dhtmlx.toNode(obj);if (!this._obj && fallback)this._obj = fallback(obj);dhtmlx.assert(this._obj, "Incorrect html container");this._obj.className+=" "+name;this._obj.onselectstart=function(){return false;};this._dataobj = this._obj;},
 
 _set_type:function(name){if (typeof name == "object")return this.type_setter(name);dhtmlx.assert(this.types, "RenderStack :: Types are not defined");dhtmlx.assert(this.types[name],"RenderStack :: Inccorect type name",name);this.type=dhtmlx.extend({},this.types[name]);this.customize();},
 customize:function(obj){if (obj)dhtmlx.extend(this.type,obj);this.type._item_start = dhtmlx.Template.fromHTML(this.template_item_start(this.type));this.type._item_end = this.template_item_end(this.type);this.render();},
 
 type_setter:function(value){this._set_type(typeof value == "object"?dhtmlx.Type.add(this,value):value);return value;},
 
 template_setter:function(value){return this.type_setter({template:value});},
 
 css_setter:function(value){this._obj.className += " "+value;return value;}
};dhtmlx.compat=function(name, obj){if (dhtmlx.compat[name])dhtmlx.compat[name](obj);};(function(){if (!window.dhtmlxError){var dummy = function(){};window.dhtmlxError={catchError:dummy, throwError:dummy };window.convertStringToBoolean=function(value){return !!value;};window.dhtmlxEventable = function(node){dhtmlx.extend(node,dhtmlx.EventSystem);};var loader = {getXMLTopNode:function(name){},
 doXPath:function(path){return dhtmlx.DataDriver.xml.xpath(this.xml,path);},
 xmlDoc:{responseXML:true
 }
 };dhtmlx.compat.dataProcessor=function(obj){var sendData = "_sendData";var in_progress = "_in_progress";var tMode = "_tMode";var waitMode = "_waitMode";obj[sendData]=function(a1,rowId){if (!a1)return;if (rowId)this[in_progress][rowId]=(new Date()).valueOf();if (!this.callEvent("onBeforeDataSending",rowId?[rowId,this.getState(rowId)]:[])) return false;var a2 = this;var a3=this.serverProcessor;if (this[tMode]!="POST")dhtmlx.ajax().get(a3+((a3.indexOf("?")!=-1)?"&":"?")+this.serialize(a1,rowId),"",function(t,x,xml){loader.xml = dhtmlx.DataDriver.xml.checkResponse(t,x);a2.afterUpdate(a2, null, null, null, loader);});else
 dhtmlx.ajax().post(a3,this.serialize(a1,rowId),function(t,x,xml){loader.xml = dhtmlx.DataDriver.xml.checkResponse(t,x);a2.afterUpdate(a2, null, null, null, loader);});this[waitMode]++;};};}
 
})();if (!dhtmlx.attaches)dhtmlx.attaches = {};dhtmlx.attaches.attachAbstract=function(name, conf){var obj = document.createElement("DIV");obj.id = "CustomObject_"+dhtmlx.uid();obj.style.width = "100%";obj.style.height = "100%";obj.cmp = "grid";document.body.appendChild(obj);this.attachObject(obj.id);conf.container = obj.id;var that = this.vs[this.av];that.grid = new window[name](conf);that.gridId = obj.id;that.gridObj = obj;that.grid.setSizes = function(){if (this.resize)this.resize();else this.render();};var method_name="_viewRestore";return this.vs[this[method_name]()].grid;};dhtmlx.attaches.attachDataView = function(conf){return this.attachAbstract("dhtmlXDataView",conf);};dhtmlx.attaches.attachChart = function(conf){return this.attachAbstract("dhtmlXChart",conf);};dhtmlx.compat.layout = function(){};dhtmlx.DataDriver.dhtmlxgrid={_grid_getter:"_get_cell_value",
 toObject:function(data){this._grid = data;return data;},
 getRecords:function(data){return data.rowsBuffer;},
 getDetails:function(data){var result = {};for (var i=0;i < this._grid.getColumnsNum();i++)
 result["data"+i]=this._grid[this._grid_getter](data,i);return result;},
 getInfo:function(data){return {_size:0,
 _from:0
 };}
};dhtmlx.Canvas = {_init:function(){this._canvas_labels = [];},
 _prepareCanvas:function(container){this._canvas = dhtmlx.html.create("canvas",{width:container.offsetWidth, height:container.offsetHeight });container.appendChild(this._canvas);if (!this._canvas.getContext){if (dhtmlx._isIE){dhtmlx.require("thirdparty/excanvas/excanvas.js");G_vmlCanvasManager.init_(document);G_vmlCanvasManager.initElement(this._canvas);}else 
 dhtmlx.error("Canvas is not supported in the current browser");}
 return this._canvas;}, 
 getCanvas:function(context){return (this._canvas||this._prepareCanvas(this._obj)).getContext(context||"2d");},
 _resizeCanvas:function(){if (this._canvas){this._canvas.setAttribute("width", this._canvas.parentNode.offsetWidth);this._canvas.setAttribute("height", this._canvas.parentNode.offsetHeight);}
 },
 renderText:function(x,y,text,css,w){if (!text)return;var t = dhtmlx.html.create("DIV",{"class":"dhx_canvas_text"+(css?(" "+css):""),
 "style":"left:"+x+"px;top:"+y+"px;"
 },text);this._obj.appendChild(t);this._canvas_labels.push(t);if (w)t.style.width = w+"px";return t;},
 renderTextAt:function(valign,align, x,y,t,c,w){var text=this.renderText.call(this,x,y,t,c,w);if (text){if (valign){if(valign == "middle")text.style.top = parseInt(y-text.offsetHeight/2,10) + "px";else
 text.style.top = y-text.offsetHeight + "px";}
 if (align){if(align == "left")text.style.left = x-text.offsetWidth + "px";else
 text.style.left = parseInt(x-text.offsetWidth/2,10) + "px";}
 }
 return text;},
 clearCanvas:function(){for(var i=0;i < this._canvas_labels.length;i++)this._obj.removeChild(this._canvas_labels[i]);this._canvas_labels = [];if (this._obj._htmlmap){this._obj._htmlmap.parentNode.removeChild(this._obj._htmlmap);this._obj._htmlmap = null;}
 
 this.getCanvas().clearRect(0,0,this._canvas.offsetWidth, this._canvas.offsetHeight);}
};dhtmlXChart = function(container){this.name = "Chart";this.version = "3.0";if (dhtmlx.assert_enabled()) this._assert();dhtmlx.extend(this, dhtmlx.Settings);this._parseContainer(container,"dhx_chart");dhtmlx.extend(this, dhtmlx.AtomDataLoader);dhtmlx.extend(this, dhtmlx.DataLoader);this.data.provideApi(this,true);dhtmlx.extend(this, dhtmlx.EventSystem);dhtmlx.extend(this, dhtmlx.MouseEvents);dhtmlx.extend(this, dhtmlx.Destruction);dhtmlx.extend(this, dhtmlx.Canvas);dhtmlx.extend(this, dhtmlx.Group);dhtmlx.extend(this, dhtmlx.AutoTooltip);for (var key in dhtmlx.chart)dhtmlx.extend(this, dhtmlx.chart[key]);if(container.preset){this.definePreset(container);}
 this._parseSettings(container,this.defaults);this._series = [this._settings];this.data.attachEvent("onStoreUpdated",dhtmlx.bind(function(){this.render();},this));this.attachEvent("onLocateData", this._switchSerie);};dhtmlXChart.prototype={_id:"dhx_area_id",
 on_click:{},
 on_dblclick:{},
 on_mouse_move:{},
 bind:function(){dhx.BaseBind.legacyBind.apply(this, arguments);},
 sync:function(){dhx.BaseBind.legacySync.apply(this, arguments);},
 resize:function(){this._resizeCanvas();this.render();},
 view_setter:function( val){if (!dhtmlx.chart[val])dhtmlx.error("Chart type extension is not loaded: "+val);if (typeof this._settings.offset == "undefined"){this._settings.offset = !(val == "area" || val == "stackedArea");}
 if(val=="radar"&&!this._settings.yAxis)this.define("yAxis",{});if(val=="scatter"){if(!this._settings.yAxis)this.define("yAxis",{});if(!this._settings.xAxis)this.define("xAxis",{});}
 return val;},
 render:function(){if (!this.callEvent("onBeforeRender",[this.data]))
 return;this.clearCanvas();if(this._settings.legend){this._drawLegend(this.getCanvas(),
 this.data.getRange(),
 this._obj.offsetWidth
 );}
 var bounds = this._getChartBounds(this._obj.offsetWidth,this._obj.offsetHeight);var map = new dhtmlx.ui.Map(this._id);var temp = this._settings;for(var i=0;i < this._series.length;i++){this._settings = this._series[i];this["pvt_render_"+this._settings.view](
 this.getCanvas(),
 this.data.getRange(),
 bounds.start,
 bounds.end,
 i,
 map
 );}
 map.render(this._obj);this._settings = temp;},
 value_setter:dhtmlx.Template.obj_setter,
 xValue_setter:dhtmlx.Template.obj_setter,
 yValue_setter:function(config){this.define("value",config);},
 alpha_setter:dhtmlx.Template.obj_setter, 
 label_setter:dhtmlx.Template.obj_setter,
 lineColor_setter:dhtmlx.Template.obj_setter, 
 pieInnerText_setter:dhtmlx.Template.obj_setter,
 gradient_setter:function(config){if((typeof(config)!="function")&&config&&(config === true))
 config = "light";return config;},
 colormap:{"RAINBOW":function(obj){var pos = Math.floor(this.indexById(obj.id)/this.dataCount()*1536);if (pos==1536)pos-=1;return this._rainbow[Math.floor(pos/256)](pos%256);}
 },
 color_setter:function(value){return this.colormap[value]||dhtmlx.Template.obj_setter( value);},
 fill_setter:function(value){return ((!value||value==0)?false:dhtmlx.Template.obj_setter( value));},
 definePreset:function(obj){this.define("preset",obj.preset);delete obj.preset;},
 preset_setter:function(value){var a, b, preset;this.defaults = dhtmlx.extend({},this.defaults);if(typeof dhtmlx.presets.chart[value]=="object"){preset = dhtmlx.presets.chart[value];for(a in preset){if(typeof preset[a]=="object"){if(!this.defaults[a]||typeof this.defaults[a]!="object"){this.defaults[a] = dhtmlx.extend({},preset[a]);}
 else{this.defaults[a] = dhtmlx.extend({},this.defaults[a]);for(b in preset[a]){this.defaults[a][b] = preset[a][b];}
 }
 }else{this.defaults[a] = preset[a];}
 }
 return value;}
 return false;},
 legend_setter:function( config){if(!config){if(this.legendObj){this.legendObj.innerHTML = "";this.legendObj = null;}
 return false;}
 if(typeof(config)!="object") 
 config={template:config};this._mergeSettings(config,{width:150,
 height:18,
 layout:"y",
 align:"left",
 valign:"bottom",
 template:"",
 marker:{type:"square",
 width:15,
 height:15,
 radius:3
 },
 margin: 4,
 padding: 3
 });config.template = dhtmlx.Template.setter(config.template);return config;},
 defaults:{color:"RAINBOW",
 alpha:"1",
 label:false,
 value:"{obj.value}",
 padding:{},
 view:"pie",
 lineColor:"#ffffff",
 cant:0.5,
 width: 30,
 labelWidth:100,
 line:{width:2,
 color:"#1293f8"
 },
 item:{radius:3,
 borderColor:"#636363",
 borderWidth:1,
 color: "#ffffff",
 alpha:1,
 type:"r",
 shadow:false
 },
 shadow:true,
 gradient:false,
 border:true,
 labelOffset: 20,
 origin:"auto"
 },
 item_setter:function( config){if(typeof(config)!="object")
 config={color:config, borderColor:config};this._mergeSettings(config,dhtmlx.extend({},this.defaults.item));config.alpha = dhtmlx.Template.setter(config.alpha);config.borderColor = dhtmlx.Template.setter(config.borderColor);config.color = dhtmlx.Template.setter(config.color);config.radius = dhtmlx.Template.setter(config.radius);return config;},
 line_setter:function( config){if(typeof(config)!="object")
 config={color:config};dhtmlx.extend(this.defaults.line,config);config = dhtmlx.extend({},this.defaults.line);config.color = dhtmlx.Template.setter(config.color);return config;},
 padding_setter:function( config){if(typeof(config)!="object")
 config={left:config, right:config, top:config, bottom:config};this._mergeSettings(config,{left:50,
 right:20,
 top:35,
 bottom:40
 });return config;},
 xAxis_setter:function( config){if(!config)return false;if(typeof(config)!="object")
 config={template:config };this._mergeSettings(config,{title:"",
 color:"#000000",
 lineColor:"#cfcfcf",
 template:"{obj}",
 lines:true
 });var templates = ["lineColor","template","lines"];this._converToTemplate(templates,config);this._settings.configXAxis = dhtmlx.extend({},config);return config;},
 yAxis_setter:function( config){this._mergeSettings(config,{title:"",
 color:"#000000",
 lineColor:"#cfcfcf",
 template:"{obj}",
 lines:true,
 bg:"#ffffff"
 });var templates = ["lineColor","template","lines","bg"];this._converToTemplate(templates,config);this._settings.configYAxis = dhtmlx.extend({},config);return config;},
 _converToTemplate:function(arr,config){for(var i=0;i< arr.length;i++){config[arr[i]] = dhtmlx.Template.setter(config[arr[i]]);}
 },
 _drawScales:function(ctx,data,point0,point1,start,end,cellWidth){var y = this._drawYAxis(ctx,data,point0,point1,start,end);this._drawXAxis(ctx,data,point0,point1,cellWidth,y);return y;},
 _drawXAxis:function(ctx,data,point0,point1,cellWidth,y){if (!this._settings.xAxis)return;var x0 = point0.x-0.5;var y0 = parseInt((y?y:point1.y),10)+0.5;var x1 = point1.x;var unit_pos;var center = true;this._drawLine(ctx,x0,y0,x1,y0,this._settings.xAxis.color,1);for(var i=0;i < data.length;i ++){if(this._settings.offset === true)unit_pos = x0+cellWidth/2+i*cellWidth;else{unit_pos = (i==data.length-1)?point1.x:x0+i*cellWidth;center = !!i;}
 unit_pos = parseInt(unit_pos,10)-0.5;var top = ((this._settings.origin!="auto")&&(this._settings.view=="bar")&&(parseFloat(this._settings.value(data[i]))<this._settings.origin));this._drawXAxisLabel(unit_pos,y0,data[i],center,top);if((this._settings.offset||i)&&this._settings.xAxis.lines.call(this,data[i]))
 this._drawXAxisLine(ctx,unit_pos,point1.y,point0.y,data[i]);}
 
 this.renderTextAt(true, false, x0,point1.y+this._settings.padding.bottom-3,
 this._settings.xAxis.title,
 "dhx_axis_title_x",
 point1.x - point0.x
 );if (!this._settings.xAxis.lines.call(this,{})|| !this._settings.offset) return;this._drawLine(ctx,x1+0.5,point1.y,x1+0.5,point0.y+0.5,this._settings.xAxis.color,0.2);},
 _drawYAxis:function(ctx,data,point0,point1,start,end){var step;var scaleParam= {};if (!this._settings.yAxis)return;var x0 = point0.x - 0.5;var y0 = point1.y;var y1 = point0.y;var lineX = point1.y;if(this._settings.yAxis.step)step = parseFloat(this._settings.yAxis.step);if(typeof this._settings.configYAxis.step =="undefined"||typeof this._settings.configYAxis.start=="undefined"||typeof this._settings.configYAxis.end =="undefined"){scaleParam = this._calculateScale(start,end);start = scaleParam.start;end = scaleParam.end;step = scaleParam.step;this._settings.yAxis.end = end;this._settings.yAxis.start = start;}
 this._setYAxisTitle(point0,point1);if(step===0)return;if(end==start){return y0;}
 var stepHeight = (y0-y1)*step/(end-start);var c = 0;for(var i = start;i<=end;i += step){if(scaleParam.fixNum)i = parseFloat((new Number(i)).toFixed(scaleParam.fixNum));var yi = Math.floor(y0-c*stepHeight)+ 0.5;if(!(i==start&&this._settings.origin=="auto")&&this._settings.yAxis.lines(i))
 this._drawLine(ctx,x0,yi,point1.x,yi,this._settings.yAxis.lineColor(i),1);if(i == this._settings.origin)lineX = yi;var label = i;if(step<1){var power = Math.min(this._log10(step),(start<=0?0:this._log10(start)));var corr = Math.pow(10,-power);label = Math.round(i*corr)/corr;i = label;}
 this.renderText(0,yi-5,
 this._settings.yAxis.template(label.toString()),
 "dhx_axis_item_y",
 point0.x-5
 );c++;}
 this._drawLine(ctx,x0,y0+1,x0,y1,this._settings.yAxis.color,1);return lineX;},
 _setYAxisTitle:function(point0,point1){var className = "dhx_axis_title_y"+(dhtmlx._isIE&&dhtmlx._isIE !=9?" dhx_ie_filter":"");var text=this.renderTextAt("middle",false,0,parseInt((point1.y-point0.y)/2+point0.y,10),this._settings.yAxis.title,className);if (text)text.style.left = (dhtmlx.env.transform?(text.offsetHeight-text.offsetWidth)/2:0)+"px";},
 _calculateScale:function(nmin,nmax){if(this._settings.origin!="auto"&&this._settings.origin<nmin)nmin = this._settings.origin;var step,start,end;step = ((nmax-nmin)/8)||1;var power = Math.floor(this._log10(step));var calculStep = Math.pow(10,power);var stepVal = step/calculStep;stepVal = (stepVal>5?10:5);step = parseInt(stepVal,10)*calculStep;if(step>Math.abs(nmin))
 start = (nmin<0?-step:0);else{var absNmin = Math.abs(nmin);var powerStart = Math.floor(this._log10(absNmin));var nminVal = absNmin/Math.pow(10,powerStart);start = Math.ceil(nminVal*10)/10*Math.pow(10,powerStart)-step;if(absNmin>1&&step>0.1){start = Math.ceil(start);}
 while(nmin<0?start<=nmin:start>=nmin)start -= step;if(nmin<0)start =-start-2*step;}
 end = start;while(end<nmax){end += step;end = parseFloat((new Number(end)).toFixed(Math.abs(power)));}
 return {start:start,end:end,step:step,fixNum:Math.abs(power) };},
 _getLimits:function(orientation,value){var maxValue,minValue;var axis = ((arguments.length && orientation=="h")?this._settings.configXAxis:this._settings.configYAxis);if(axis&&(typeof axis.end!="undefined")&&(typeof axis.start!="undefined")&&axis.step){maxValue = parseFloat(axis.end);minValue = parseFloat(axis.start);}
 else{maxValue = this.max(this._series[0][value||"value"]);minValue = (axis&&(typeof axis.start!="undefined"))?parseFloat(axis.start):this.min(this._series[0][value||"value"]);if(this._series.length>1)for(var i=1;i < this._series.length;i++){var maxI = this.max(this._series[i][value||"value"]);var minI = this.min(this._series[i][value||"value"]);if (maxI > maxValue)maxValue = maxI;if (minI < minValue)minValue = minI;}
 }
 return {max:maxValue,min:minValue};},
 _log10:function(n){var method_name="log";return Math.floor((Math[method_name](n)/Math.LN10));},
 _drawXAxisLabel:function(x,y,obj,center,top){if (!this._settings.xAxis)return;var elem = this.renderTextAt(top, center, x,y-(top?2:0),this._settings.xAxis.template(obj));if (elem)elem.className += " dhx_axis_item_x";},
 _drawXAxisLine:function(ctx,x,y1,y2,obj){if (!this._settings.xAxis||!this._settings.xAxis.lines)return;this._drawLine(ctx,x,y1,x,y2,this._settings.xAxis.lineColor.call(this,obj),1);},
 _drawLine:function(ctx,x1,y1,x2,y2,color,width){ctx.strokeStyle = color;ctx.lineWidth = width;ctx.beginPath();ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);ctx.stroke();ctx.lineWidth = 1;},
 _getRelativeValue:function(minValue,maxValue){var relValue, origRelValue;var valueFactor = 1;if(maxValue != minValue){origRelValue = maxValue - minValue;if(Math.abs(relValue)< 1){while(Math.abs(relValue)<1){valueFactor *= 10;origRelValue = relValue* valueFactor;}
 }
 relValue = origRelValue;}
 else relValue = minValue;return [relValue,valueFactor];},
 _rainbow : [
 function(pos){return "#FF"+dhtmlx.math.toHex(pos/2,2)+"00";},
 function(pos){return "#FF"+dhtmlx.math.toHex(pos/2+128,2)+"00";},
 function(pos){return "#"+dhtmlx.math.toHex(255-pos,2)+"FF00";},
 function(pos){return "#00FF"+dhtmlx.math.toHex(pos,2);},
 function(pos){return "#00"+dhtmlx.math.toHex(255-pos,2)+"FF";},
 function(pos){return "#"+dhtmlx.math.toHex(pos,2)+"00FF";}
 ],
 
 addSeries:function(obj){var temp = this._settings;this._settings = dhtmlx.extend({},temp);this._parseSettings(obj,{});this._series.push(this._settings);this._settings = temp;},
 
 _switchSerie:function(id, tag){var tip;this._active_serie = tag.getAttribute("userdata");if (!this._series[this._active_serie])return;for (var i=0;i < this._series.length;i++){tip = this._series[i].tooltip;if (tip)tip.disable();}
 tip = this._series[this._active_serie].tooltip;if (tip)tip.enable();},
 
 _drawLegend:function(ctx,data,width){var i,legend,legendContainer,legendHeight,legendItems,legendWidth, style, x=0,y=0;legend = this._settings.legend;style = (this._settings.legend.layout!="x"?"width:"+legend.width+"px":"");if(this.legendObj)this.legendObj.innerHTML = "";legendContainer = dhtmlx.html.create("DIV",{"class":"dhx_chart_legend",
 "style":"left:"+x+"px;top:"+y+"px;"+style
 },"");if(legend.padding){legendContainer.style.padding = legend.padding+"px";}
 this.legendObj = legendContainer;this._obj.appendChild(legendContainer);legendItems = [];if(!legend.values)for(i = 0;i < data.length;i++){legendItems.push(this._drawLegendText(legendContainer,legend.template(data[i])));}
 else
 for(i = 0;i < legend.values.length;i++){legendItems.push(this._drawLegendText(legendContainer,legend.values[i].text));}
 legendWidth = legendContainer.offsetWidth;legendHeight = legendContainer.offsetHeight;if(legendWidth<this._obj.offsetWidth){if(legend.layout == "x"&&legend.align == "center"){x = (this._obj.offsetWidth-legendWidth)/2;}
 if(legend.align == "right"){x = this._obj.offsetWidth-legendWidth;}
 if(legend.margin&&legend.align != "center"){x += (legend.align == "left"?1:-1)*legend.margin;}
 }
 if(legendHeight<this._obj.offsetHeight){if(legend.valign == "middle"&&legend.align != "center"&&legend.layout != "x")y = (this._obj.offsetHeight-legendHeight)/2;else if(legend.valign == "bottom")y = this._obj.offsetHeight-legendHeight;if(legend.margin&&legend.valign != "middle"){y += (legend.valign == "top"?1:-1)*legend.margin;}
 }
 legendContainer.style.left = x+"px";legendContainer.style.top = y+"px";ctx.save();for(i = 0;i < legendItems.length;i++){var item = legendItems[i];var itemColor = (legend.values?legend.values[i].color:this._settings.color.call(this,data[i]));this._drawLegendMarker(ctx,item.offsetLeft+x,item.offsetTop+y,itemColor,item.offsetHeight);}
 ctx.restore();legendItems = null;},
 
 _drawLegendText:function(cont,value){var style = "";if(this._settings.legend.layout=="x")style = "float:left;";var text = dhtmlx.html.create("DIV",{"style":style+"padding-left:"+(10+this._settings.legend.marker.width)+"px",
 "class":"dhx_chart_legend_item"
 },value);cont.appendChild(text);return text;},
 
 _drawLegendMarker:function(ctx,x,y,color,height){var marker = this._settings.legend.marker;ctx.strokeStyle = ctx.fillStyle = color;ctx.beginPath();if(marker.type=="round"||!marker.radius){ctx.lineWidth = marker.height;ctx.lineCap = marker.type;x += ctx.lineWidth/2+5;y += height/2;ctx.moveTo(x,y);var x1 = x + marker.width-marker.height +1;ctx.lineTo(x1,y);}else{ctx.lineWidth = 1;var x0,y0;x += 5;y += height/2-marker.height/2;x0 = x+ marker.width/2;y0= y+marker.height/2;ctx.arc(x+marker.radius,y+marker.radius,marker.radius,Math.PI,3*Math.PI/2,false);ctx.lineTo(x+marker.width-marker.radius,y);ctx.arc(x+marker.width-marker.radius,y+marker.radius,marker.radius,-Math.PI/2,0,false);ctx.lineTo(x+marker.width,y+marker.height-marker.radius);ctx.arc(x+marker.width-marker.radius,y+marker.height-marker.radius,marker.radius,0,Math.PI/2,false);ctx.lineTo(x+marker.radius,y+marker.height);ctx.arc(x+marker.radius,y+marker.height-marker.radius,marker.radius,Math.PI/2,Math.PI,false);ctx.lineTo(x,y+marker.radius);}
 ctx.stroke();ctx.fill();},
 
 _getChartBounds:function(width,height){var chartX0, chartY0, chartX1, chartY1;chartX0 = this._settings.padding.left;chartY0 = this._settings.padding.top;chartX1 = width - this._settings.padding.right;chartY1 = height - this._settings.padding.bottom;if(this._settings.legend){var legend = this._settings.legend;var legendWidth = this._settings.legend.width;var legendHeight = this._settings.legend.height;if(legend.layout == "x"){if(legend.valign == "center"){if(legend.align == "right")chartX1 -= legendWidth;else if(legend.align == "left")chartX0 += legendWidth;}
 else if(legend.valign == "bottom"){chartY1 -= legendHeight;}
 else{chartY0 += legendHeight;}
 }
 
 else{if(legend.align == "right")chartX1 -= legendWidth;else if(legend.align == "left")chartX0 += legendWidth;}
 }
 return {start:{x:chartX0,y:chartY0},end:{x:chartX1,y:chartY1}};},
 
 _getStackedLimits:function(data){var i,j,maxValue,minValue,value;if(this._settings.yAxis&&(typeof this._settings.yAxis.end!="undefined")&&(typeof this._settings.yAxis.start!="undefined")&&this._settings.yAxis.step){maxValue = parseFloat(this._settings.yAxis.end);minValue = parseFloat(this._settings.yAxis.start);}
 else{for(i=0;i < data.length;i++){data[i].$sum = 0 ;data[i].$min = Infinity;for(j =0;j < this._series.length;j++){value = parseFloat(this._series[j].value(data[i])||0);if(isNaN(value)) continue;data[i].$sum += value;if(value < data[i].$min)data[i].$min = value;}
 }
 maxValue = -Infinity;minValue = Infinity;for(i=0;i < data.length;i++){if (data[i].$sum > maxValue)maxValue = data[i].$sum ;if (data[i].$min < minValue)minValue = data[i].$min ;}
 if(minValue>0)minValue =0;}
 return {max:maxValue,min:minValue};},
 
 _setBarGradient:function(ctx,x1,y1,x2,y2,type,color,axis){var gradient,offset,rgb,hsv,color0;if(type == "light"){if(axis == "x")gradient = ctx.createLinearGradient(x1,y1,x2,y1);else
 gradient = ctx.createLinearGradient(x1,y1,x1,y2);gradient.addColorStop(0,"#FFFFFF");gradient.addColorStop(0.9,color);gradient.addColorStop(1,color);offset = 2;}
 else if(type == "falling"||type == "rising"){if(axis == "x")gradient = ctx.createLinearGradient(x1,y1,x2,y1);else
 gradient = ctx.createLinearGradient(x1,y1,x1,y2);rgb = dhtmlx.math.toRgb(color);hsv = dhtmlx.math.rgbToHsv(rgb[0],rgb[1],rgb[2]);hsv[1] *= 1/2;color0 = "rgb("+dhtmlx.math.hsvToRgb(hsv[0],hsv[1],hsv[2])+")";if(type == "falling"){gradient.addColorStop(0,color0);gradient.addColorStop(0.7,color);gradient.addColorStop(1,color);}
 else if(type == "rising"){gradient.addColorStop(0,color);gradient.addColorStop(0.3,color);gradient.addColorStop(1,color0);}
 offset = 0;}
 else{ctx.globalAlpha = 0.37;offset = 0;if(axis == "x")gradient = ctx.createLinearGradient(x1,y2,x1,y1);else
 gradient = ctx.createLinearGradient(x1,y1,x2,y1);gradient.addColorStop(0,"#9d9d9d");gradient.addColorStop(0.3,"#e8e8e8");gradient.addColorStop(0.45,"#ffffff");gradient.addColorStop(0.55,"#ffffff");gradient.addColorStop(0.7,"#e8e8e8");gradient.addColorStop(1,"#9d9d9d");}
 return {gradient:gradient,offset:offset};},
 
 _getPositionByAngle:function(a,x,y,r){a *= (-1);x = x+Math.cos(a)*r;y = y-Math.sin(a)*r;return {x:x,y:y};}
};dhtmlx.compat("layout");function dataProcessor(serverProcessorURL){this.serverProcessor = serverProcessorURL;this.action_param="!nativeeditor_status";this.object = null;this.updatedRows = [];this.autoUpdate = true;this.updateMode = "cell";this._tMode="GET";this.post_delim = "_";this._waitMode=0;this._in_progress={};this._invalid={};this.mandatoryFields=[];this.messages=[];this.styles={updated:"font-weight:bold;",
 inserted:"font-weight:bold;",
 deleted:"text-decoration : line-through;",
 invalid:"background-color:FFE0E0;",
 invalid_cell:"border-bottom:2px solid red;",
 error:"color:red;",
 clear:"font-weight:normal;text-decoration:none;"
 };this.enableUTFencoding(true);dhtmlxEventable(this);return this;}
dataProcessor.prototype={setTransactionMode:function(mode,total){this._tMode=mode;this._tSend=total;},
 escape:function(data){if (this._utf)return encodeURIComponent(data);else
 return escape(data);},
 
 enableUTFencoding:function(mode){this._utf=convertStringToBoolean(mode);},
 
 setDataColumns:function(val){this._columns=(typeof val == "string")?val.split(","):val;},
 
 getSyncState:function(){return !this.updatedRows.length;},
 
 enableDataNames:function(mode){this._endnm=convertStringToBoolean(mode);},
 
 enablePartialDataSend:function(mode){this._changed=convertStringToBoolean(mode);},
 
 setUpdateMode:function(mode,dnd){this.autoUpdate = (mode=="cell");this.updateMode = mode;this.dnd=dnd;},
 ignore:function(code,master){this._silent_mode=true;code.call(master||window);this._silent_mode=false;},
 
 setUpdated:function(rowId,state,mode){if (this._silent_mode)return;var ind=this.findRow(rowId);mode=mode||"updated";var existing = this.obj.getUserData(rowId,this.action_param);if (existing && mode == "updated")mode=existing;if (state){this.set_invalid(rowId,false);this.updatedRows[ind]=rowId;this.obj.setUserData(rowId,this.action_param,mode);if (this._in_progress[rowId])this._in_progress[rowId]="wait";}else{if (!this.is_invalid(rowId)){this.updatedRows.splice(ind,1);this.obj.setUserData(rowId,this.action_param,"");}
 }
 
 if (!state)this._clearUpdateFlag(rowId);this.markRow(rowId,state,mode);if (state && this.autoUpdate)this.sendData(rowId);},
 _clearUpdateFlag:function(id){},
 markRow:function(id,state,mode){var str="";var invalid=this.is_invalid(id);if (invalid){str=this.styles[invalid];state=true;}
 if (this.callEvent("onRowMark",[id,state,mode,invalid])){str=this.styles[state?mode:"clear"]+str;this.obj[this._methods[0]](id,str);if (invalid && invalid.details){str+=this.styles[invalid+"_cell"];for (var i=0;i < invalid.details.length;i++)if (invalid.details[i])this.obj[this._methods[1]](id,i,str);}
 }
 },
 getState:function(id){return this.obj.getUserData(id,this.action_param);},
 is_invalid:function(id){return this._invalid[id];},
 set_invalid:function(id,mode,details){if (details)mode={value:mode, details:details, toString:function(){return this.value.toString();}};this._invalid[id]=mode;},
 
 checkBeforeUpdate:function(rowId){return true;},
 
 sendData:function(rowId){if (this._waitMode && (this.obj.mytype=="tree" || this.obj._h2)) return;if (this.obj.editStop)this.obj.editStop();if(typeof rowId == "undefined" || this._tSend)return this.sendAllData();if (this._in_progress[rowId])return false;this.messages=[];if (!this.checkBeforeUpdate(rowId)&& this.callEvent("onValidationError",[rowId,this.messages])) return false;this._beforeSendData(this._getRowData(rowId),rowId);},
 _beforeSendData:function(data,rowId){if (!this.callEvent("onBeforeUpdate",[rowId,this.getState(rowId),data])) return false;this._sendData(data,rowId);},
 serialize:function(data, id){if (typeof data == "string")return data;if (typeof id != "undefined")return this.serialize_one(data,"");else{var stack = [];var keys = [];for (var key in data)if (data.hasOwnProperty(key)){stack.push(this.serialize_one(data[key],key+this.post_delim));keys.push(key);}
 stack.push("ids="+this.escape(keys.join(",")));if (dhtmlx.security_key)stack.push("dhx_security="+dhtmlx.security_key);return stack.join("&");}
 },
 serialize_one:function(data, pref){if (typeof data == "string")return data;var stack = [];for (var key in data)if (data.hasOwnProperty(key))
 stack.push(this.escape((pref||"")+key)+"="+this.escape(data[key]));return stack.join("&");},
 _sendData:function(a1,rowId){if (!a1)return;if (!this.callEvent("onBeforeDataSending",rowId?[rowId,this.getState(rowId),a1]:[null, null, a1])) return false;if (rowId)this._in_progress[rowId]=(new Date()).valueOf();var a2=new dtmlXMLLoaderObject(this.afterUpdate,this,true);var a3 = this.serverProcessor+(this._user?(getUrlSymbol(this.serverProcessor)+["dhx_user="+this._user,"dhx_version="+this.obj.getUserData(0,"version")].join("&")):"");if (this._tMode!="POST")a2.loadXML(a3+((a3.indexOf("?")!=-1)?"&":"?")+this.serialize(a1,rowId));else
 a2.loadXML(a3,true,this.serialize(a1,rowId));this._waitMode++;},
 sendAllData:function(){if (!this.updatedRows.length)return;this.messages=[];var valid=true;for (var i=0;i<this.updatedRows.length;i++)valid&=this.checkBeforeUpdate(this.updatedRows[i]);if (!valid && !this.callEvent("onValidationError",["",this.messages])) return false;if (this._tSend)this._sendData(this._getAllData());else
 for (var i=0;i<this.updatedRows.length;i++)if (!this._in_progress[this.updatedRows[i]]){if (this.is_invalid(this.updatedRows[i])) continue;this._beforeSendData(this._getRowData(this.updatedRows[i]),this.updatedRows[i]);if (this._waitMode && (this.obj.mytype=="tree" || this.obj._h2)) return;}
 },
 
 
 
 
 
 
 
 
 _getAllData:function(rowId){var out={};var has_one = false;for(var i=0;i<this.updatedRows.length;i++){var id=this.updatedRows[i];if (this._in_progress[id] || this.is_invalid(id)) continue;if (!this.callEvent("onBeforeUpdate",[id,this.getState(id)])) continue;out[id]=this._getRowData(id,id+this.post_delim);has_one = true;this._in_progress[id]=(new Date()).valueOf();}
 return has_one?out:null;},
 
 
 
 setVerificator:function(ind,verifFunction){this.mandatoryFields[ind] = verifFunction||(function(value){return (value!="");});},
 
 clearVerificator:function(ind){this.mandatoryFields[ind] = false;},
 
 
 
 
 
 findRow:function(pattern){var i=0;for(i=0;i<this.updatedRows.length;i++)if(pattern==this.updatedRows[i])break;return i;},

 
 


 





 
 defineAction:function(name,handler){if (!this._uActions)this._uActions=[];this._uActions[name]=handler;},




 
 afterUpdateCallback:function(sid, tid, action, btag) {var marker = sid;var correct=(action!="error" && action!="invalid");if (!correct)this.set_invalid(sid,action);if ((this._uActions)&&(this._uActions[action])&&(!this._uActions[action](btag))) 
 return (delete this._in_progress[marker]);if (this._in_progress[marker]!="wait")this.setUpdated(sid, false);var soid = sid;switch (action) {case "inserted":
 case "insert":
 if (tid != sid){this.obj[this._methods[2]](sid, tid);sid = tid;}
 break;case "delete":
 case "deleted":
 this.obj.setUserData(sid, this.action_param, "true_deleted");this.obj[this._methods[3]](sid);delete this._in_progress[marker];return this.callEvent("onAfterUpdate", [sid, action, tid, btag]);break;}
 
 if (this._in_progress[marker]!="wait"){if (correct)this.obj.setUserData(sid, this.action_param,'');delete this._in_progress[marker];}else {delete this._in_progress[marker];this.setUpdated(tid,true,this.obj.getUserData(sid,this.action_param));}
 
 this.callEvent("onAfterUpdate", [sid, action, tid, btag]);},

 
 afterUpdate:function(that,b,c,d,xml){xml.getXMLTopNode("data");if (!xml.xmlDoc.responseXML)return;var atag=xml.doXPath("//data/action");for (var i=0;i<atag.length;i++){var btag=atag[i];var action = btag.getAttribute("type");var sid = btag.getAttribute("sid");var tid = btag.getAttribute("tid");that.afterUpdateCallback(sid,tid,action,btag);}
 that.finalizeUpdate();},
 finalizeUpdate:function(){if (this._waitMode)this._waitMode--;if ((this.obj.mytype=="tree" || this.obj._h2)&& this.updatedRows.length) 
 this.sendData();this.callEvent("onAfterUpdateFinish",[]);if (!this.updatedRows.length)this.callEvent("onFullSync",[]);},




 
 
 init:function(anObj){this.obj = anObj;if (this.obj._dp_init)this.obj._dp_init(this);},
 
 
 setOnAfterUpdate:function(ev){this.attachEvent("onAfterUpdate",ev);},
 enableDebug:function(mode){},
 setOnBeforeUpdateHandler:function(func){this.attachEvent("onBeforeDataSending",func);},



 
 setAutoUpdate: function(interval, user) {interval = interval || 2000;this._user = user || (new Date()).valueOf();this._need_update = false;this._loader = null;this._update_busy = false;this.attachEvent("onAfterUpdate",function(sid,action,tid,xml_node){this.afterAutoUpdate(sid, action, tid, xml_node);});this.attachEvent("onFullSync",function(){this.fullSync();});var self = this;window.setInterval(function(){self.loadUpdate();}, interval);},


 
 afterAutoUpdate: function(sid, action, tid, xml_node) {if (action == 'collision'){this._need_update = true;return false;}else {return true;}
 },


 
 fullSync: function() {if (this._need_update == true){this._need_update = false;this.loadUpdate();}
 return true;},


 
 getUpdates: function(url,callback){if (this._update_busy)return false;else
 this._update_busy = true;this._loader = this._loader || new dtmlXMLLoaderObject(true);this._loader.async=true;this._loader.waitCall=callback;this._loader.loadXML(url);},


 
 _v: function(node) {if (node.firstChild)return node.firstChild.nodeValue;return "";},


 
 _a: function(arr) {var res = [];for (var i=0;i < arr.length;i++){res[i]=this._v(arr[i]);};return res;},


 
 loadUpdate: function(){var self = this;var version = this.obj.getUserData(0,"version");var url = this.serverProcessor+getUrlSymbol(this.serverProcessor)+["dhx_user="+this._user,"dhx_version="+version].join("&");url = url.replace("editing=true&","");this.getUpdates(url, function(){var vers = self._loader.doXPath("//userdata");self.obj.setUserData(0,"version",self._v(vers[0]));var upds = self._loader.doXPath("//update");if (upds.length){self._silent_mode = true;for (var i=0;i<upds.length;i++){var status = upds[i].getAttribute('status');var id = upds[i].getAttribute('id');var parent = upds[i].getAttribute('parent');switch (status) {case 'inserted':
 self.callEvent("insertCallback",[upds[i], id, parent]);break;case 'updated':
 self.callEvent("updateCallback",[upds[i], id, parent]);break;case 'deleted':
 self.callEvent("deleteCallback",[upds[i], id, parent]);break;}
 }
 
 self._silent_mode = false;}
 
 self._update_busy = false;self = null;});}
};window.dhx||(dhx={});dhx.version="3.0";dhx.codebase="./";dhx.name="Core";dhx.clone=function(a){var b=dhx.clone.ua;b.prototype=a;return new b};dhx.clone.ua=function(){};dhx.extend=function(a,b,c){if(a.o)return dhx.PowerArray.insertAt.call(a.o,b,1),a;for(var d in b)if(!a[d]||c)a[d]=b[d];b.defaults&&dhx.extend(a.defaults,b.defaults);b.$init&&b.$init.call(a);return a};dhx.copy=function(a){var b=a.length?[]:{};arguments.length>1&&(b=arguments[0],a=arguments[1]);for(var c in a)a[c]&&typeof a[c]=="object"&&!dhx.isDate(a[c])?(b[c]=a[c].length?[]:{},dhx.copy(b[c],a[c])):b[c]=a[c];return b};dhx.single=function(a){var b=null,c=function(c){b||(b=new a({}));b.Fa&&b.Fa.apply(b,arguments);return b};return c};dhx.protoUI=function(){var a=arguments,b=a[0].name,c=function(a){if(!c)return dhx.ui[b].prototype;var e=c.o;if(e){for(var f=[e[0]],g=1;g<e.length;g++)f[g]=e[g],f[g].o&&(f[g]=f[g].call(dhx,f[g].name)),f[g].prototype&&f[g].prototype.name&&(dhx.ui[f[g].prototype.name]=f[g]);dhx.ui[b]=dhx.proto.apply(dhx,f);if(c.p)for(g=0;g<c.p.length;g++)dhx.Type(dhx.ui[b],c.p[g]);c=e=null}return this!=dhx?new dhx.ui[b](a):dhx.ui[b]};c.o=Array.prototype.slice.call(arguments,0);return dhx.ui[b]=c};dhx.proto=function(){for(var a=arguments,b=a[0],c=!!b.$init,d=[],e=a.length-1;e>0;e--){if(typeof a[e]=="function")a[e]=a[e].prototype;a[e].$init&&d.push(a[e].$init);if(a[e].defaults){var f=a[e].defaults;if(!b.defaults)b.defaults={};for(var g in f)dhx.isUndefined(b.defaults[g])&&(b.defaults[g]=f[g])}if(a[e].type&&b.type)for(g in a[e].type)b.type[g]||(b.type[g]=a[e].type[g]);for(var i in a[e])b[i]||(b[i]=a[e][i])}c&&d.push(b.$init);b.$init=function(){for(var a=0;a<d.length;a++)d[a].apply(this,arguments)};var h=function(a){this.$ready=[];this.$init(a);this.X&&this.X(a,this.defaults);for(var b=0;b<this.$ready.length;b++)this.$ready[b].call(this)};h.prototype=b;b=a=null;return h};dhx.bind=function(a,b){return function(){return a.apply(b,arguments)}};dhx.require=function(a){dhx.V[a]||(dhx.exec(dhx.ajax().sync().get(dhx.codebase+a).responseText),dhx.V[a]=!0)};dhx.V={};dhx.exec=function(a){window.execScript?window.execScript(a):window.eval(a)};dhx.wrap=function(a,b){return!a?b:function(){var c=a.apply(this,arguments);b.apply(this,arguments);return c}};dhx.isUndefined=function(a){return typeof a=="undefined"};dhx.delay=function(a,b,c,d){return window.setTimeout(function(){var d=a.apply(b,c||[]);a=b=c=null;return d},d||1)};dhx.uid=function(){if(!this.N)this.N=(new Date).valueOf();this.N++;return this.N};dhx.toNode=function(a){return typeof a=="string"?document.getElementById(a):a};dhx.toArray=function(a){return dhx.extend(a||[],dhx.PowerArray,!0)};dhx.toFunctor=function(a){return typeof a=="string"?eval(a):a};dhx.isArray=function(a){return Object.prototype.toString.call(a)==="[object Array]"};dhx.isDate=function(a){return a instanceof Date};dhx.H={};dhx.event=function(a,b,c,d){var a=dhx.toNode(a),e=dhx.uid();d&&(c=dhx.bind(c,d));dhx.H[e]=[a,b,c];a.addEventListener?a.addEventListener(b,c,!1):a.attachEvent&&a.attachEvent("on"+b,c);return e};dhx.eventRemove=function(a){if(a){var b=dhx.H[a];b[0].removeEventListener?b[0].removeEventListener(b[1],b[2],!1):b[0].detachEvent&&b[0].detachEvent("on"+b[1],b[2]);delete this.H[a]}};dhx.EventSystem={$init:function(){if(!this.d)this.d={},this.q={},this.I={}},blockEvent:function(){this.d.P=!0},unblockEvent:function(){this.d.P=!1},mapEvent:function(a){dhx.extend(this.I,a,!0)},on_setter:function(a){if(a)for(var b in a)typeof a[b]=="function"&&this.attachEvent(b,a[b])},callEvent:function(a,b){if(this.d.P)return!0;var a=a.toLowerCase(),c=this.d[a.toLowerCase()],d=!0;if(c)for(var e=0;e<c.length;e++)if(c[e].apply(this,b||[])===!1)d=!1;this.I[a]&&!this.I[a].callEvent(a,b)&&(d=!1);return d},
attachEvent:function(a,b,c){var a=a.toLowerCase(),c=c||dhx.uid(),b=dhx.toFunctor(b),d=this.d[a]||dhx.toArray();d.push(b);this.d[a]=d;this.q[c]={f:b,t:a};return c},detachEvent:function(a){if(this.q[a]){var b=this.q[a].t,c=this.q[a].f,d=this.d[b];d.remove(c);delete this.q[a]}},hasEvent:function(a){a=a.toLowerCase();return this.d[a]?!0:!1}};dhx.extend(dhx,dhx.EventSystem);dhx.PowerArray={removeAt:function(a,b){a>=0&&this.splice(a,b||1)},remove:function(a){this.removeAt(this.find(a))},insertAt:function(a,b){if(!b&&b!==0)this.push(a);else{var c=this.splice(b,this.length-b);this[b]=a;this.push.apply(this,c)}},find:function(a){for(var b=0;b<this.length;b++)if(a==this[b])return b;return-1},each:function(a,b){for(var c=0;c<this.length;c++)a.call(b||this,this[c])},map:function(a,b){for(var c=0;c<this.length;c++)this[c]=a.call(b||this,this[c]);return this}};dhx.env={};(function(){if(navigator.userAgent.indexOf("Mobile")!=-1)dhx.env.mobile=!0;if(dhx.env.mobile||navigator.userAgent.indexOf("iPad")!=-1||navigator.userAgent.indexOf("Android")!=-1)dhx.env.touch=!0;navigator.userAgent.indexOf("Opera")!=-1?dhx.env.isOpera=!0:(dhx.env.isIE=!!document.all,dhx.env.isFF=!document.all,dhx.env.isWebKit=navigator.userAgent.indexOf("KHTML")!=-1,dhx.env.isSafari=dhx.env.isWebKit&&navigator.userAgent.indexOf("Mac")!=-1);if(navigator.userAgent.toLowerCase().indexOf("android")!=
-1)dhx.env.isAndroid=!0;dhx.env.transform=!1;dhx.env.transition=!1;for(var a={names:["transform","transition"],transform:["transform","WebkitTransform","MozTransform","OTransform","msTransform"],transition:["transition","WebkitTransition","MozTransition","OTransition","msTransition"]},b=document.createElement("DIV"),c=0;c<a.names.length;c++)for(var d=a[a.names[c]],e=0;e<d.length;e++)if(typeof b.style[d[e]]!="undefined"){dhx.env[a.names[c]]=d[e];break}b.style[dhx.env.transform]="translate3d(0,0,0)";dhx.env.translate=b.style[dhx.env.transform]?"translate3d":"translate";var f="",g=!1;dhx.env.isOpera&&(f="-o-",g="O");dhx.env.isFF&&(f="-Moz-");dhx.env.isWebKit&&(f="-webkit-");dhx.env.isIE&&(f="-ms-");dhx.env.transformCSSPrefix=f;dhx.env.transformPrefix=g||dhx.env.transformCSSPrefix.replace(/-/gi,"");dhx.env.transitionEnd=dhx.env.transformCSSPrefix=="-Moz-"?"transitionend":dhx.env.transformPrefix+"TransitionEnd"})();dhx.env.svg=function(){return document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure","1.1")}();dhx.html={s:0,denySelect:function(){if(!dhx.s)dhx.s=document.onselectstart;document.onselectstart=dhx.html.stopEvent},allowSelect:function(){if(dhx.s!==0)document.onselectstart=dhx.s||null;dhx.s=0},index:function(a){for(var b=0;a=a.previousSibling;)b++;return b},da:{},createCss:function(a){var b="",c;for(c in a)b+=c+":"+a[c]+";";var d=this.da[b];d||(d="s"+dhx.uid(),this.addStyle("."+d+"{"+b+"}"),this.da[b]=d);return d},addStyle:function(a){var b=document.createElement("style");b.setAttribute("type",
"text/css");b.setAttribute("media","screen");b.styleSheet?b.styleSheet.cssText=a:b.appendChild(document.createTextNode(a));document.getElementsByTagName("head")[0].appendChild(b)},create:function(a,b,c){var b=b||{},d=document.createElement(a),e;for(e in b)d.setAttribute(e,b[e]);if(b.style)d.style.cssText=b.style;if(b["class"])d.className=b["class"];if(c)d.innerHTML=c;return d},getValue:function(a){a=dhx.toNode(a);return!a?"":dhx.isUndefined(a.value)?a.innerHTML:a.value},remove:function(a){if(a instanceof
Array)for(var b=0;b<a.length;b++)this.remove(a[b]);else a&&a.parentNode&&a.parentNode.removeChild(a)},insertBefore:function(a,b,c){a&&(b&&b.parentNode?b.parentNode.insertBefore(a,b):c.appendChild(a))},locate:function(a,b){if(a.tagName)var c=a;else a=a||event,c=a.target||a.srcElement;for(;c;){if(c.getAttribute){var d=c.getAttribute(b);if(d)return d}c=c.parentNode}return null},offset:function(a){if(a.getBoundingClientRect){var b=a.getBoundingClientRect(),c=document.body,d=document.documentElement,e=
window.pageYOffset||d.scrollTop||c.scrollTop,f=window.pageXOffset||d.scrollLeft||c.scrollLeft,g=d.clientTop||c.clientTop||0,i=d.clientLeft||c.clientLeft||0,h=b.top+e-g,j=b.left+f-i;return{y:Math.round(h),x:Math.round(j)}}else{for(j=h=0;a;)h+=parseInt(a.offsetTop,10),j+=parseInt(a.offsetLeft,10),a=a.offsetParent;return{y:h,x:j}}},posRelative:function(a){a=a||event;return dhx.isUndefined(a.offsetX)?{x:a.layerX,y:a.layerY}:{x:a.offsetX,y:a.offsetY}},pos:function(a){a=a||event;if(a.pageX||a.pageY)return{x:a.pageX,
y:a.pageY};var b=dhx.env.isIE&&document.compatMode!="BackCompat"?document.documentElement:document.body;return{x:a.clientX+b.scrollLeft-b.clientLeft,y:a.clientY+b.scrollTop-b.clientTop}},preventEvent:function(a){a&&a.preventDefault&&a.preventDefault();return dhx.html.stopEvent(a)},stopEvent:function(a){(a||event).cancelBubble=!0;return!1},addCss:function(a,b){a.className+=" "+b},removeCss:function(a,b){a.className=a.className.replace(RegExp(" "+b,"g"),"")}};dhx.ready=function(a){this.Da?a.call():this.B.push(a)};dhx.B=[];(function(){var a=document.getElementsByTagName("SCRIPT");if(a.length)a=(a[a.length-1].getAttribute("src")||"").split("/"),a.splice(a.length-1,1),dhx.codebase=a.slice(0,a.length).join("/")+"/";dhx.event(window,"load",function(){dhx.callEvent("onReady",[]);dhx.delay(function(){dhx.Da=!0;for(var a=0;a<dhx.B.length;a++)dhx.B[a].call();dhx.B=[]})})})();dhx.locale=dhx.locale||{};dhx.ready(function(){dhx.event(document.body,"click",function(a){dhx.callEvent("onClick",[a||event])})});(function(){var a={},b=RegExp("(\\r\\n|\\n)","g"),c=RegExp('(\\")',"g");dhx.Template=function(d){if(typeof d=="function")return d;if(a[d])return a[d];d=(d||"").toString();if(d.indexOf("->")!=-1)switch(d=d.split("->"),d[0]){case "html":d=dhx.html.getValue(d[1]);break;case "http":d=(new dhx.ajax).sync().get(d[1],{uid:dhx.uid()}).responseText}d=(d||"").toString();d=d.replace(b,"\\n");d=d.replace(c,'\\"');d=d.replace(/\{obj\.([^}?]+)\?([^:]*):([^}]*)\}/g,'"+(obj.$1?"$2":"$3")+"');d=d.replace(/\{common\.([^}\(]*)\}/g,
"\"+(common.$1||'')+\"");d=d.replace(/\{common\.([^\}\(]*)\(\)\}/g,'"+(common.$1?common.$1(obj,common):"")+"');d=d.replace(/\{obj\.([^}]*)\}/g,'"+(obj.$1)+"');d=d.replace("{obj}",'"+obj+"');d=d.replace(/#([^#'";, ]+)#/gi,'"+(obj.$1)+"');try{a[d]=Function("obj","common",'return "'+d+'";')}catch(e){}return a[d]};dhx.Template.empty=function(){return""};dhx.Template.bind=function(a){return dhx.bind(dhx.Template(a),this)};dhx.Type=function(a,b){if(a.o){if(!a.p)a.p=[];a.p.push(b)}else{if(typeof a=="function")a=
a.prototype;if(!a.types)a.types={"default":a.type},a.type.name="default";var c=b.name,g=a.type;c&&(g=a.types[c]=dhx.clone(b.baseType?a.types[b.baseType]:a.type));for(var i in b)g[i]=i.indexOf("template")===0?dhx.Template(b[i]):b[i];return c}}})();dhx.Settings={$init:function(){this.a=this.config={}},define:function(a,b){return typeof a=="object"?this.M(a):this.Q(a,b)},Q:function(a,b){var c=this[a+"_setter"];return this.a[a]=c?c.call(this,b,a):b},M:function(a){if(a)for(var b in a)this.Q(b,a[b])},X:function(a,b){var c={};b&&(c=dhx.extend(c,b));typeof a=="object"&&!a.tagName&&dhx.extend(c,a,!0);this.M(c)},ya:function(a,b){for(var c in b)switch(typeof a[c]){case "object":a[c]=this.ya(a[c]||{},b[c]);break;case "undefined":a[c]=b[c]}return a}};dhx.ajax=function(a,b,c){if(arguments.length!==0){var d=new dhx.ajax;if(c)d.master=c;return d.get(a,null,b)}return!this.getXHR?new dhx.ajax:this};dhx.ajax.count=0;dhx.ajax.prototype={master:null,getXHR:function(){return dhx.env.isIE?new ActiveXObject("Microsoft.xmlHTTP"):new XMLHttpRequest},send:function(a,b,c){var d=this.getXHR();dhx.isArray(c)||(c=[c]);if(typeof b=="object"){var e=[],f;for(f in b){var g=b[f];if(g===null||g===dhx.undefined)g="";e.push(f+"="+encodeURIComponent(g))}b=e.join("&")}b&&this.request==="GET"&&(a=a+(a.indexOf("?")!=-1?"&":"?")+b,b=null);d.open(this.request,a,!this.Ka);this.request==="POST"&&d.setRequestHeader("Content-type","application/x-www-form-urlencoded");var i=this;d.onreadystatechange=function(){if(!d.readyState||d.readyState==4){dhx.ajax.count++;if(c&&i)for(var a=0;a<c.length;a++)if(c[a]){var b=c[a].success||c[a];if(d.status>=400||!d.status&&!d.responseText)b=c[a].error;b&&b.call(i.master||i,d.responseText,d.responseXML,d)}c=i=i.master=null}};d.send(b||null);return d},get:function(a,b,c){this.request="GET";return this.send(a,b,c)},post:function(a,b,c){this.request="POST";return this.send(a,b,c)},put:function(a,b,c){this.request="PUT";return this.send(a,
b,c)},del:function(a,b,c){this.request="DELETE";return this.send(a,b,c)},sync:function(){this.Ka=!0;return this},bind:function(a){this.master=a;return this}};dhx.send=function(a,b,c){var d=dhx.html.create("FORM",{action:a,method:c||"POST"},""),e;for(e in b){var f=dhx.html.create("INPUT",{type:"hidden",name:e,value:b[e]},"");d.appendChild(f)}d.style.display="none";document.body.appendChild(d);d.submit();document.body.removeChild(d)};dhx.AtomDataLoader={$init:function(a){this.data={};if(a)this.a.datatype=a.datatype||"json",this.$ready.push(this.xa)},xa:function(){this.Y=!0;this.a.url&&this.url_setter(this.a.url);this.a.data&&this.data_setter(this.a.data)},url_setter:function(a){if(!this.Y)return a;this.load(a,this.a.datatype);return a},data_setter:function(a){if(!this.Y)return a;this.parse(a,this.a.datatype);return!0},load:function(a,b,c){if(a.$proxy)a.load(this,typeof b=="string"?b:"json");else{this.callEvent("onXLS",[]);if(typeof b==
"string")this.data.driver=dhx.DataDriver[b],b=c;else if(!this.data.driver)this.data.driver=dhx.DataDriver.json;var d=[{success:this.L,error:this.A}];b&&(dhx.isArray(b)?d.push.apply(d,b):d.push(b));return dhx.ajax(a,d,this)}},parse:function(a,b){this.callEvent("onXLS",[]);this.data.driver=dhx.DataDriver[b||"json"];this.L(a,null)},L:function(a,b,c){var d=this.data.driver,e=d.toObject(a,b);if(e){var f=d.getRecords(e)[0];this.data=d?d.getDetails(f):a}else this.A(a,b,c);this.callEvent("onXLE",[])},A:function(a,
b,c){this.callEvent("onXLE",[]);this.callEvent("onLoadError",arguments);dhx.callEvent("onLoadError",[a,b,c,this])},v:function(a){if(!this.a.dataFeed||this.J||!a)return!0;var b=this.a.dataFeed;if(typeof b=="function")return b.call(this,a.id||a,a);b=b+(b.indexOf("?")==-1?"?":"&")+"action=get&id="+encodeURIComponent(a.id||a);this.callEvent("onXLS",[]);dhx.ajax(b,function(a,b,e){this.J=!0;var f=dhx.DataDriver.toObject(a,b);f?this.setValues(f.getDetails(f.getRecords()[0])):this.A(a,b,e);this.J=!1;this.callEvent("onXLE",
[])},this);return!1}};dhx.DataDriver={};dhx.DataDriver.json={toObject:function(a){a||(a="[]");if(typeof a=="string"){try{eval("dhx.temp="+a)}catch(b){return null}a=dhx.temp}if(a.data){var c=a.data.config={},d;for(d in a)d!="data"&&(c[d]=a[d]);a=a.data}return a},getRecords:function(a){return a&&!dhx.isArray(a)?[a]:a},getDetails:function(a){return typeof a=="string"?{id:dhx.uid(),value:a}:a},getInfo:function(a){var b=a.config;return!b?{}:{k:b.total_count||0,j:b.pos||0,Ba:b.parent||0,G:b.config,K:b.dhx_security}},child:"data"};dhx.DataDriver.html={toObject:function(a){if(typeof a=="string"){var b=null;a.indexOf("<")==-1&&(b=dhx.toNode(a));if(!b)b=document.createElement("DIV"),b.innerHTML=a;return b.getElementsByTagName(this.tag)}return a},getRecords:function(a){for(var b=[],c=0;c<a.childNodes.length;c++){var d=a.childNodes[c];d.nodeType==1&&b.push(d)}return b},getDetails:function(a){return dhx.DataDriver.xml.tagToObject(a)},getInfo:function(){return{k:0,j:0}},tag:"LI"};dhx.DataDriver.jsarray={toObject:function(a){return typeof a=="string"?(eval("dhx.temp="+a),dhx.temp):a},getRecords:function(a){return a},getDetails:function(a){for(var b={},c=0;c<a.length;c++)b["data"+c]=a[c];return b},getInfo:function(){return{k:0,j:0}}};dhx.DataDriver.csv={toObject:function(a){return a},getRecords:function(a){return a.split(this.row)},getDetails:function(a){for(var a=this.stringToArray(a),b={},c=0;c<a.length;c++)b["data"+c]=a[c];return b},getInfo:function(){return{k:0,j:0}},stringToArray:function(a){for(var a=a.split(this.cell),b=0;b<a.length;b++)a[b]=a[b].replace(/^[ \t\n\r]*(\"|)/g,"").replace(/(\"|)[ \t\n\r]*$/g,"");return a},row:"\n",cell:","};dhx.DataDriver.xml={U:function(a){return!a||!a.documentElement?null:a.getElementsByTagName("parsererror").length?null:a},toObject:function(a){if(this.U(b))return b;var b=typeof a=="string"?this.fromString(a.replace(/^[\s]+/,"")):a;return this.U(b)?b:null},getRecords:function(a){return this.xpath(a,this.records)},records:"/*/item",child:"item",config:"/*/config",getDetails:function(a){return this.tagToObject(a,{})},getInfo:function(a){var b=this.xpath(a,this.config),b=b.length?this.assignTypes(this.tagToObject(b[0],
{})):null;return{k:a.documentElement.getAttribute("total_count")||0,j:a.documentElement.getAttribute("pos")||0,Ba:a.documentElement.getAttribute("parent")||0,G:b,K:a.documentElement.getAttribute("dhx_security")||null}},xpath:function(a,b){if(window.XPathResult){var c=a;if(a.nodeName.indexOf("document")==-1)a=a.ownerDocument;for(var d=[],e=a.evaluate(b,c,null,XPathResult.ANY_TYPE,null),f=e.iterateNext();f;)d.push(f),f=e.iterateNext();return d}else{var g=!0;try{typeof a.selectNodes=="undefined"&&(g=
!1)}catch(i){}if(g)return a.selectNodes(b);else{var h=b.split("/").pop();return a.getElementsByTagName(h)}}},assignTypes:function(a){for(var b in a){var c=a[b];typeof c=="object"?this.assignTypes(c):typeof c=="string"&&c!==""&&(c=="true"?a[b]=!0:c=="false"?a[b]=!1:c==c*1&&(a[b]*=1))}return a},tagToObject:function(a,b){var b=b||{},c=!1,d=a.attributes;if(d&&d.length){for(var e=0;e<d.length;e++)b[d[e].name]=d[e].value;c=!0}for(var f=a.childNodes,g={},e=0;e<f.length;e++)if(f[e].nodeType==1){var i=f[e].tagName;typeof b[i]!="undefined"?(dhx.isArray(b[i])||(b[i]=[b[i]]),b[i].push(this.tagToObject(f[e],{}))):b[f[e].tagName]=this.tagToObject(f[e],{});c=!0}if(!c)return this.nodeValue(a);b.value=b.value||this.nodeValue(a);return b},nodeValue:function(a){return a.firstChild?a.firstChild.data:""},fromString:function(a){try{if(window.DOMParser)return(new DOMParser).parseFromString(a,"text/xml");if(window.ActiveXObject){var b=new ActiveXObject("Microsoft.xmlDOM");b.loadXML(a);return b}}catch(c){return null}}};dhx.DataLoader=dhx.proto({$init:function(a){a=a||"";this.l=dhx.toArray();this.data=new dhx.DataStore;this.data.attachEvent("onClearAll",dhx.bind(this.la,this));this.data.attachEvent("onServerConfig",dhx.bind(this.ka,this));this.data.feed=this.pa},pa:function(a,b,c){if(this.r)return this.r=[a,b,c];else this.r=!0;this.S=[a,b];this.ra.call(this,a,b,c)},ra:function(a,b,c){var d=this.data.url;a<0&&(a=0);this.load(d+(d.indexOf("?")==-1?"?":"&")+(this.dataCount()?"continue=true&":"")+"start="+a+"&count="+
b,[this.qa,c])},qa:function(){var a=this.r,b=this.S;this.r=!1;typeof a=="object"&&(a[0]!=b[0]||a[1]!=b[1])&&this.data.feed.apply(this,a)},load:function(a,b){var c=dhx.AtomDataLoader.load.apply(this,arguments);this.l.push(c);if(!this.data.url)this.data.url=a},loadNext:function(a,b,c,d,e){this.a.datathrottle&&!e?(this.ea&&window.clearTimeout(this.ea),this.ea=dhx.delay(function(){this.loadNext(a,b,c,d,!0)},this,0,this.a.datathrottle)):(!b&&b!==0&&(b=this.dataCount()),this.data.url=this.data.url||d,this.callEvent("onDataRequest",
[b,a,c,d])&&this.data.url&&this.data.feed.call(this,b,a,c))},Na:function(a,b){var c=this.S;return this.r&&c&&c[0]<=b&&c[1]+c[0]>=a+b?!0:!1},L:function(a,b,c){this.l.remove(c);var d=this.data.driver.toObject(a,b);if(d)this.data.Ca(d);else return this.A(a,b,c);this.ma();this.callEvent("onXLE",[])},removeMissed_setter:function(a){return this.data.Ga=a},scheme_setter:function(a){this.data.scheme(a)},dataFeed_setter:function(a){this.data.attachEvent("onBeforeFilter",dhx.bind(function(a,c){if(this.a.dataFeed){var d=
{};if(a||c){if(typeof a=="function"){if(!c)return;a(c,d)}else d={text:c};this.clearAll();var e=this.a.dataFeed,f=[];if(typeof e=="function")return e.call(this,c,d);for(var g in d)f.push("dhx_filter["+g+"]="+encodeURIComponent(d[g]));this.load(e+(e.indexOf("?")<0?"?":"&")+f.join("&"),this.a.datatype);return!1}}},this));return a},ma:function(){if(this.a.ready&&!this.Ea){var a=dhx.toFunctor(this.a.ready);a&&dhx.delay(a,this,arguments);this.Ea=!0}},la:function(){for(var a=0;a<this.l.length;a++)this.l[a].abort();this.l=dhx.toArray()},ka:function(a){this.M(a)}},dhx.AtomDataLoader);dhx.DataStore=function(){this.name="DataStore";dhx.extend(this,dhx.EventSystem);this.setDriver("json");this.pull={};this.order=dhx.toArray()};dhx.DataStore.prototype={setDriver:function(a){this.driver=dhx.DataDriver[a]},Ca:function(a){this.callEvent("onParse",[this.driver,a]);this.c&&this.filter();var b=this.driver.getInfo(a);if(b.K)dhx.securityKey=b.K;b.G&&this.callEvent("onServerConfig",[b.G]);var c=this.driver.getRecords(a);this.wa(b,c);this.Z&&this.va&&this.va(this.Z);this.aa&&(this.blockEvent(),this.sort(this.aa),this.unblockEvent());this.callEvent("onStoreLoad",[this.driver,a]);this.refresh()},wa:function(a,b){var c=(a.j||0)*1,d=
!0,e=!1;if(c===0&&this.order[0]){if(this.Ga)for(var e={},f=0;f<this.order.length;f++)e[this.order[f]]=!0;d=!1;c=this.order.length}for(var g=0,f=0;f<b.length;f++){var i=this.driver.getDetails(b[f]),h=this.id(i);this.pull[h]?d&&this.order[g+c]&&g++:(this.order[g+c]=h,g++);this.pull[h]?(dhx.extend(this.pull[h],i,!0),this.D&&this.D(this.pull[h]),e&&delete e[h]):(this.pull[h]=i,this.C&&this.C(i))}if(e){this.blockEvent();for(var j in e)this.remove(j);this.unblockEvent()}if(!this.order[a.k-1])this.order[a.k-
1]=dhx.undefined},id:function(a){return a.id||(a.id=dhx.uid())},changeId:function(a,b){this.pull[a]&&(this.pull[b]=this.pull[a]);this.pull[b].id=b;this.order[this.order.find(a)]=b;this.c&&(this.c[this.c.find(a)]=b);this.callEvent("onIdChange",[a,b]);this.Ha&&this.Ha(a,b);delete this.pull[a]},item:function(a){return this.pull[a]},update:function(a,b){dhx.isUndefined(b)&&(b=this.item(a));this.D&&this.D(b);if(this.callEvent("onBeforeUpdate",[a,b])===!1)return!1;this.pull[a]=b;this.callEvent("onStoreUpdated",
[a,b,"update"])},refresh:function(a){this.ca||(a?this.callEvent("onStoreUpdated",[a,this.pull[a],"paint"]):this.callEvent("onStoreUpdated",[null,null,null]))},silent:function(a,b){this.ca=!0;a.call(b||this);this.ca=!1},getRange:function(a,b){a=a?this.indexById(a):this.$min||this.startOffset||0;b?b=this.indexById(b):(b=Math.min(this.$max||this.endOffset||Infinity,this.dataCount()-1),b<0&&(b=0));if(a>b)var c=b,b=a,a=c;return this.getIndexRange(a,b)},getIndexRange:function(a,b){for(var b=Math.min(b||
Infinity,this.dataCount()-1),c=dhx.toArray(),d=a||0;d<=b;d++)c.push(this.item(this.order[d]));return c},dataCount:function(){return this.order.length},exists:function(a){return!!this.pull[a]},move:function(a,b){var c=this.idByIndex(a),d=this.item(c);this.order.removeAt(a);this.order.insertAt(c,Math.min(this.order.length,b));this.callEvent("onStoreUpdated",[c,d,"move"])},scheme:function(a){this.Oa=a;this.C=a.$init;this.D=a.$update;this.$=a.$serialize;if(a.$group)this.Z=a.$group;this.aa=a.$sort;delete a.$init;delete a.$update;delete a.$serialize;delete a.$group;delete a.$sort},sync:function(a,b,c){typeof b!="function"&&(c=b,b=null);if(a.name!="DataStore")a=a.data;var d=dhx.bind(function(){this.order=dhx.toArray([].concat(a.order));this.c=null;this.pull=a.pull;b&&this.silent(b);this.W&&this.W();c?c=!1:this.refresh()},this);this.u=[a.attachEvent("onStoreUpdated",d)];d()},add:function(a,b){this.C&&this.C(a);var c=this.id(a),d=this.order.length;if(dhx.isUndefined(b)||b<0)b=d;b>d&&(b=Math.min(this.order.length,
b));if(this.callEvent("onBeforeAdd",[c,a,b])===!1)return!1;this.pull[c]=a;this.order.insertAt(c,b);if(this.c){var e=this.c.length;!b&&this.order.length&&(e=0);this.c.insertAt(c,e)}this.callEvent("onAfterAdd",[c,b]);this.callEvent("onStoreUpdated",[c,a,"add"]);return c},remove:function(a){if(dhx.isArray(a))for(var b=0;b<a.length;b++)this.remove(a[b]);else{if(this.callEvent("onBeforeDelete",[a])===!1)return!1;var c=this.item(a);this.order.remove(a);this.c&&this.c.remove(a);delete this.pull[a];this.callEvent("onAfterDelete",
[a]);this.callEvent("onStoreUpdated",[a,c,"delete"])}},clearAll:function(){this.pull={};this.order=dhx.toArray();this.c=null;this.callEvent("onClearAll",[]);this.refresh()},idByIndex:function(a){return this.order[a]},indexById:function(a){var b=this.order.find(a);return b},next:function(a,b){return this.order[this.indexById(a)+(b||1)]},first:function(){return this.order[0]},last:function(){return this.order[this.order.length-1]},previous:function(a,b){return this.order[this.indexById(a)-(b||1)]},
sort:function(a,b,c){var d=a;typeof a=="function"?d={as:a,dir:b}:typeof a=="string"&&(d={by:a.replace(/#/g,""),dir:b,as:c});var e=[d.by,d.dir,d.as];this.callEvent("onBeforeSort",e)&&(this.Ja(d),this.refresh(),this.callEvent("onAfterSort",e))},Ja:function(a){if(this.order.length){var b=this.Ia.na(a),c=this.getRange(this.first(),this.last());c.sort(b);this.order=c.map(function(a){return this.id(a)},this)}},ta:function(a){if(this.c&&!a)this.order=this.c,delete this.c;return this.order.length},sa:function(a,
b,c){for(var d=dhx.toArray(),e=0;e<this.order.length;e++){var f=this.order[e];a(this.item(f),b)&&d.push(f)}if(!c||!this.c)this.c=this.order;this.order=d},filter:function(a,b,c){if(this.callEvent("onBeforeFilter",[a,b])&&this.ta(c)){if(a){var d=a,b=b||"";typeof a=="string"&&(a=a.replace(/#/g,""),b=b.toString().toLowerCase(),d=function(b,c){return(b[a]||"").toString().toLowerCase().indexOf(c)!=-1});this.sa(d,b,c)}this.refresh();this.callEvent("onAfterFilter",[])}},each:function(a,b){for(var c=0;c<this.order.length;c++)a.call(b||
this,this.item(this.order[c]))},za:function(a,b){return function(){return a[b].apply(a,arguments)}},provideApi:function(a,b){b&&this.mapEvent({onbeforesort:a,onaftersort:a,onbeforeadd:a,onafteradd:a,onbeforedelete:a,onafterdelete:a,onbeforeupdate:a});for(var c="sort,add,remove,exists,idByIndex,indexById,item,update,refresh,dataCount,filter,next,previous,clearAll,first,last,serialize,sync".split(","),d=0;d<c.length;d++)a[c[d]]=this.za(this,c[d])},serialize:function(){for(var a=this.order,b=[],c=0;c<
a.length;c++){var d=this.pull[a[c]];if(this.$&&(d=this.$(d),d===!1))continue;b.push(d)}return b},Ia:{na:function(a){return this.oa(a.dir,this.ja(a.by,a.as))},ga:{date:function(a,b){a-=0;b-=0;return a>b?1:a<b?-1:0},"int":function(a,b){a*=1;b*=1;return a>b?1:a<b?-1:0},string_strict:function(a,b){a=a.toString();b=b.toString();return a>b?1:a<b?-1:0},string:function(a,b){if(!b)return 1;if(!a)return-1;a=a.toString().toLowerCase();b=b.toString().toLowerCase();return a>b?1:a<b?-1:0}},ja:function(a,b){if(!a)return b;typeof b!="function"&&(b=this.ga[b||"string"]);return function(c,d){return b(c[a],d[a])}},oa:function(a,b){return a=="asc"||!a?b:function(a,d){return b(a,d)*-1}}}};dhx.BaseBind={bind:function(a,b,c){typeof a=="string"&&(a=dhx.ui.get(a));a.b&&a.b();this.b&&this.b();a.getBindData||dhx.extend(a,dhx.BindSource);if(!this.ha){var d=this.render;if(this.filter){var e=this.a.id;this.data.W=function(){a.n[e]=!1}}this.render=function(){if(!this.T){this.T=!0;var a=this.callEvent("onBindRequest");this.T=!1;return d.apply(this,a===!1?arguments:[])}};if(this.getValue||this.getValues)this.save=function(){if(!this.validate||this.validate())a.setBindData(this.getValue?this.getValue:
this.getValues(),this.a.id)};this.ha=!0}a.addBind(this.a.id,b,c);this.attachEvent(this.touchable?"onAfterRender":"onBindRequest",function(){return a.getBindData(this.a.id)});this.isVisible(this.a.id)&&this.refresh()},e:function(a){a.removeBind(this.a.id);var b=this.u||(this.data?this.data.u:0);if(b&&a.data)for(var c=0;c<b.length;c++)a.data.detachEvent(b[c])}};dhx.BindSource={$init:function(){this.m={};this.n={};this.w={};this.ia(this)},saveBatch:function(a){this.R=!0;a.call(this);this.R=!1;this.i()},setBindData:function(a,b){b&&(this.w[b]=!0);if(this.setValue)this.setValue(a);else if(this.setValues)this.setValues(a);else{var c=this.getCursor();c&&(a=dhx.extend(this.item(c),a,!0),this.update(c,a))}this.callEvent("onBindUpdate",[a,b]);this.save&&this.save();b&&(this.w[b]=!1)},getBindData:function(a,b){if(this.n[a])return!1;var c=dhx.ui.get(a);c.isVisible(c.a.id)&&
(this.n[a]=!0,this.F(c,this.m[a][0],this.m[a][1]),b&&c.filter&&c.refresh())},addBind:function(a,b,c){this.m[a]=[b,c]},removeBind:function(a){delete this.m[a];delete this.n[a];delete this.w[a]},ia:function(a){a.filter?dhx.extend(this,dhx.CollectionBind):a.setValue?dhx.extend(this,dhx.ValueBind):dhx.extend(this,dhx.RecordBind)},i:function(){if(!this.R)for(var a in this.m)this.w[a]||(this.n[a]=!1,this.getBindData(a,!0))},O:function(a,b,c){a.setValue?a.setValue(c?c[b]:c):a.filter?a.data.silent(function(){this.filter(b,
c)}):!c&&a.clear?a.clear():a.v(c)&&a.setValues(dhx.clone(c));a.callEvent("onBindApply",[c,b,this])}};dhx.DataValue=dhx.proto({name:"DataValue",isVisible:function(){return!0},$init:function(a){var b=(this.data=a)&&a.id?a.id:dhx.uid();this.a={id:b};dhx.ui.views[b]=this},setValue:function(a){this.data=a;this.callEvent("onChange",[a])},getValue:function(){return this.data},refresh:function(){this.callEvent("onBindRequest")}},dhx.EventSystem,dhx.BaseBind);dhx.DataRecord=dhx.proto({name:"DataRecord",isVisible:function(){return!0},$init:function(a){this.data=a||{};var b=a&&a.id?a.id:dhx.uid();this.a={id:b};dhx.ui.views[b]=this},getValues:function(){return this.data},setValues:function(a){this.data=a;this.callEvent("onChange",[a])},refresh:function(){this.callEvent("onBindRequest")}},dhx.EventSystem,dhx.BaseBind,dhx.AtomDataLoader,dhx.Settings);dhx.DataCollection=dhx.proto({name:"DataCollection",isVisible:function(){return!this.data.order.length&&!this.data.c&&!this.a.dataFeed?!1:!0},$init:function(a){this.data.provideApi(this,!0);var b=a&&a.id?a.id:dhx.uid();this.a.id=b;dhx.ui.views[b]=this;this.data.attachEvent("onStoreLoad",dhx.bind(function(){this.callEvent("onBindRequest",[])},this))},refresh:function(){this.callEvent("onBindRequest",[])}},dhx.DataLoader,dhx.EventSystem,dhx.BaseBind,dhx.Settings);dhx.ValueBind={$init:function(){this.attachEvent("onChange",this.i)},F:function(a,b,c){var d=this.getValue()||"";c&&(d=c(d));if(a.setValue)a.setValue(d);else if(a.filter)a.data.silent(function(){this.filter(b,d)});else{var e={};e[b]=d;a.v(d)&&a.setValues(e)}a.callEvent("onBindApply",[d,b,this])}};dhx.RecordBind={$init:function(){this.attachEvent("onChange",this.i)},F:function(a,b){var c=this.getValues()||null;this.O(a,b,c)}};dhx.CollectionBind={$init:function(){this.g=null;this.attachEvent("onSelectChange",function(){var a=this.getSelected();this.setCursor(a?a.id||a:"")});this.attachEvent("onAfterCursorChange",this.i);this.data.attachEvent("onStoreUpdated",dhx.bind(function(a){a&&a==this.getCursor()&&this.i()},this));this.data.attachEvent("onClearAll",dhx.bind(function(){this.g=null},this));this.data.attachEvent("onIdChange",dhx.bind(function(a,b){if(this.g==a)this.g=b},this))},setCursor:function(a){if(!(a==this.g||a!==
null&&!this.item(a)))this.callEvent("onBeforeCursorChange",[this.g]),this.g=a,this.callEvent("onAfterCursorChange",[a])},getCursor:function(){return this.g},F:function(a,b){var c=this.item(this.getCursor())||null;this.O(a,b,c)}};if(!dhx.ui)dhx.ui={};if(!dhx.ui.views)dhx.ui.views={},dhx.ui.get=function(a){return a.a?a:dhx.ui.views[a]};dhtmlXDataStore=function(a){var b=new dhx.DataCollection(a),c="_dp_init";b[c]=function(a){var b="_methods";a[b]=["dummy","dummy","changeId","dummy"];this.data.Aa={add:"inserted",update:"updated","delete":"deleted"};this.data.attachEvent("onStoreUpdated",function(b,c,e){b&&!a.ba&&a.setUpdated(b,!0,this.Aa[e])});b="_getRowData";a[b]=function(a){var b=this.obj.data.item(a),c={id:a,"!nativeeditor_status":this.obj.getUserData(a)};if(b)for(var d in b)d.indexOf("_")!==0&&(c[d]=b[d]);return c};this.changeId=
function(b,c){this.data.changeId(b,c);a.ba=!0;this.data.callEvent("onStoreUpdated",[c,this.item(c),"update"]);a.ba=!1};b="_clearUpdateFlag";a[b]=function(){};this.fa={}};b.dummy=function(){};b.setUserData=function(a,b,c){this.fa[a]=c};b.getUserData=function(a){return this.fa[a]};b.dataFeed=function(a){this.define("dataFeed",a)};dhx.extend(b,dhx.BindSource);return b};if(window.dhtmlXDataView)dhtmlXDataView.prototype.b=function(){this.isVisible=function(){return!this.data.order.length&&!this.data.c&&!this.a.dataFeed?!1:!0};this.a = this.a||this._settings;if(!this.a.id)this.a.id=dhx.uid();this.unbind=dhx.BaseBind.unbind;this.unsync=dhx.BaseBind.unsync;dhx.ui.views[this.a.id]=this};if(window.dhtmlXChart)dhtmlXChart.prototype.b=function(){this.isVisible=function(){return!this.data.order.length&&!this.data.Ma&&!this.a.dataFeed?!1:!0};this.a = this.a||this._settings;if(!this.a.id)this.a.id=dhx.uid();this.unbind=dhx.BaseBind.unbind;this.unsync=dhx.BaseBind.unsync;dhx.ui.views[this.a.id]=this};dhx.BaseBind.unsync=function(a){return dhx.BaseBind.e.call(this,a)};dhx.BaseBind.unbind=function(a){return dhx.BaseBind.e.call(this,a)};dhx.BaseBind.legacyBind=function(){return dhx.BaseBind.bind.apply(this,arguments)};dhx.BaseBind.legacySync=function(a,b){this.b&&this.b();a.b&&a.b();this.attachEvent("onAfterEditStop",function(a){this.save(a);return!0});this.save=function(b){b||(b=this.getCursor());var d=this.item(b),e=a.item(b),f;for(f in d)f.indexOf("$")!==0&&(e[f]=d[f]);a.refresh(b)};return a&&a.name=="DataCollection"?a.data.sync.apply(this.data,arguments):this.data.sync.apply(this.data,arguments)};if(window.dhtmlXForm)dhtmlXForm.prototype.bind=function(a){dhx.BaseBind.bind.apply(this,arguments);a.getBindData(this.a.id)},dhtmlXForm.prototype.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXForm.prototype.b=function(){if(dhx.isUndefined(this.a))this.a={id:dhx.uid(),dataFeed:this.h},dhx.ui.views[this.a.id]=this},dhtmlXForm.prototype.v=function(a){if(!this.a.dataFeed||this.J||!a)return!0;var b=this.a.dataFeed;if(typeof b=="function")return b.call(this,a.id||a,a);b=b+(b.indexOf("?")==-1?"?":
"&")+"action=get&id="+encodeURIComponent(a.id||a);this.load(b);return!1},dhtmlXForm.prototype.setValues=dhtmlXForm.prototype.setFormData,dhtmlXForm.prototype.getValues=function(){return this.getFormData(!1,!0)},dhtmlXForm.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXForm.prototype.refresh=dhtmlXForm.prototype.isVisible=function(){return!0};if(window.scheduler){if(!window.Scheduler)window.Scheduler={};Scheduler.$syncFactory=function(a){a.sync=function(b,c){this.b&&this.b();b.b&&b.b();var d="_process_loading",e=function(){a.clearAll();for(var e=b.data.order,g=b.data.pull,i=[],h=0;h<e.length;h++)i[h]=c&&c.copy?dhx.clone(g[e[h]]):g[e[h]];a[d](i)};this.save=function(a){a||(a=this.getCursor());var c=this.item(a),d=b.item(a);this.callEvent("onStoreSave",[a,c,d])&&(dhx.extend(b.item(a),c,!0),b.update(a))};this.item=function(a){return this.getEvent(a)};this.u=[b.data.attachEvent("onStoreUpdated",function(){e.call(this)}),b.data.attachEvent("onIdChange",function(a,b){combo.changeOptionId(a,b)})];this.attachEvent("onEventChanged",function(a){this.save(a)});this.attachEvent("onEventAdded",function(a,c){b.data.pull[a]||b.add(c)});e()};a.unsync=function(a){dhx.BaseBind.e.call(this,a)};a.b=function(){if(!this.a)this.a={id:dhx.uid()}}};Scheduler.$syncFactory(window.scheduler)}
if(window.dhtmlXCombo)dhtmlXCombo.prototype.bind=function(){dhx.BaseBind.bind.apply(this,arguments)},dhtmlXCombo.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXCombo.unsync=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXCombo.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXCombo.prototype.sync=function(a){this.b&&this.b();a.b&&a.b();var b=this,c=function(){b.clearAll();b.addOption(this.serialize())};this.u=[a.data.attachEvent("onStoreUpdated",function(){c.call(this)}),
a.data.attachEvent("onIdChange",function(a,c){b.changeOptionId(a,c)})];c.call(a)},dhtmlXCombo.prototype.b=function(){if(dhx.isUndefined(this.a))this.a={id:dhx.uid(),dataFeed:this.h},dhx.ui.views[this.a.id]=this,this.data={silent:dhx.bind(function(a){a.call(this)},this)},dhtmlxEventable(this.data),this.attachEvent("onChange",function(){this.callEvent("onSelectChange",[this.getSelectedValue()])}),this.attachEvent("onXLE",function(){this.callEvent("onBindRequest",[])})},dhtmlXCombo.prototype.item=function(){return this.Pa},
dhtmlXCombo.prototype.getSelected=function(){return this.getSelectedValue()},dhtmlXCombo.prototype.isVisible=function(){return!this.optionsArr.length&&!this.a.dataFeed?!1:!0},dhtmlXCombo.prototype.refresh=function(){this.render(!0)},dhtmlXCombo.prototype.filter=function(){alert("not implemented")};if(window.dhtmlXGridObject)dhtmlXGridObject.prototype.bind=function(a,b,c){dhx.BaseBind.bind.apply(this,arguments)},dhtmlXGridObject.prototype.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXGridObject.prototype.unsync=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXGridObject.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXGridObject.prototype.sync=function(a,b){this.b&&this.b();a.b&&a.b();var c=this,d="_parsing",e="_parser",f="_locator",g="_process_store_row",i="_get_store_data";this.save=function(b){b||(b=this.getCursor());dhx.extend(a.item(b),this.item(b),!0);a.update(b)};var h=function(){var a=0;c.z?(a=c.z,c.z=!1):c.clearAll();var b=this.dataCount();if(b){c[d]=!0;for(var h=a;h<b;h++){var k=this.order[h];if(k&&(!a||!c.rowsBuffer[h]))c.rowsBuffer[h]={idd:k,data:this.pull[k]},c.rowsBuffer[h][e]=c[g],c.rowsBuffer[h][f]=c[i],c.rowsAr[k]=this.pull[k]}if(!c.rowsBuffer[b-1])c.rowsBuffer[b-1]=dhtmlx.undefined,c.xmlFileUrl=c.xmlFileUrl||!0;c.pagingOn?c.changePage():c.Qa&&c.La?c.Ra():
(c.render_dataset(),c.callEvent("onXLE",[]));c[d]=!1}};this.u=[a.data.attachEvent("onStoreUpdated",function(a,b,d){d=="delete"?(c.deleteRow(a),c.data.callEvent("onStoreUpdated",[a,b,d])):d=="update"?(c.callEvent("onSyncUpdate",[b,d]),c.update(a,b),c.data.callEvent("onStoreUpdated",[a,b,d])):d=="add"?(c.callEvent("onSyncUpdate",[b,d]),c.add(a,b,this.indexById(a)),c.data.callEvent("onStoreUpdated",[a,b,d])):h.call(this)}),a.data.attachEvent("onStoreLoad",function(b,d){c.xmlFileUrl=a.data.url;c.z=b.getInfo(d).j}),
a.data.attachEvent("onIdChange",function(a,b){c.changeRowId(a,b)})];c.attachEvent("onDynXLS",function(b,d){for(var e=b;e<b+d;e++)if(!a.data.order[e])return a.loadNext(d,b),!1;c.z=b;h.call(a.data)});h.call(a.data);c.attachEvent("onEditCell",function(a,b){a==2&&this.save(b);return!0});c.attachEvent("onClearAll",function(){var a="_f_rowsBuffer";this[a]=null});b&&b.sort&&c.attachEvent("onBeforeSorting",function(b,d,e){if(d=="connector")return!1;var f=this.getColumnId(b);a.sort("#"+f+"#",e=="asc"?"asc":
"desc",d=="int"?d:"string");c.setSortImgState(!0,b,e);return!1});b&&b.filter&&c.attachEvent("onFilterStart",function(b,d){var e="_con_f_used";if(c[e]&&c[e].length)return!1;a.data.silent(function(){a.filter();for(var e=0;e<b.length;e++)if(d[e]!=""){var f=c.getColumnId(b[e]);a.filter("#"+f+"#",d[e],e!=0)}});a.refresh();return!1});b&&b.select&&c.attachEvent("onRowSelect",function(b){a.setCursor(b)});c.clearAndLoad=function(b){a.clearAll();a.load(b)}},dhtmlXGridObject.prototype.b=function(){if(dhx.isUndefined(this.a)){this.a=
{id:dhx.uid(),dataFeed:this.h};dhx.ui.views[this.a.id]=this;this.data={silent:dhx.bind(function(a){a.call(this)},this)};dhtmlxEventable(this.data);for(var a="_cCount",b=0;b<this[a];b++)this.columnIds[b]||(this.columnIds[b]="cell"+b);this.attachEvent("onSelectStateChanged",function(a){this.callEvent("onSelectChange",[a])});this.attachEvent("onSelectionCleared",function(){this.callEvent("onSelectChange",[null])});this.attachEvent("onEditCell",function(a,b){a===2&&this.getCursor&&b&&b==this.getCursor()&&
this.i();return!0});this.attachEvent("onXLE",function(){this.callEvent("onBindRequest",[])})}},dhtmlXGridObject.prototype.item=function(a){if(a===null)return null;var b=this.getRowById(a);if(!b)return null;var c="_attrs",d=dhx.copy(b[c]);d.id=a;for(var e=this.getColumnsNum(),f=0;f<e;f++)d[this.columnIds[f]]=this.cells(a,f).getValue();return d},dhtmlXGridObject.prototype.update=function(a,b){for(var c=0;c<this.columnIds.length;c++){var d=this.columnIds[c];dhx.isUndefined(b[d])||this.cells(a,c).setValue(b[d])}var e=
"_attrs",f=this.getRowById(a)[e];for(d in b)f[d]=b[d];this.callEvent("onBindUpdate",[a])},dhtmlXGridObject.prototype.add=function(a,b,c){for(var d=[],e=0;e<this.columnIds.length;e++){var f=this.columnIds[e];d[e]=dhx.isUndefined(b[f])?"":b[f]}this.addRow(a,d,c);var g="_attrs";this.getRowById(a)[g]=dhx.copy(b)},dhtmlXGridObject.prototype.getSelected=function(){return this.getSelectedRowId()},dhtmlXGridObject.prototype.isVisible=function(){var a="_f_rowsBuffer";return!this.rowsBuffer.length&&!this[a]&&
!this.a.dataFeed?!1:!0},dhtmlXGridObject.prototype.refresh=function(){this.render_dataset()},dhtmlXGridObject.prototype.filter=function(a,b){if(this.a.dataFeed){var c={};if(!a&&!b)return;if(typeof a=="function"){if(!b)return;a(b,c)}else dhx.isUndefined(a)?c=b:c[a]=b;this.clearAll();var d=this.a.dataFeed;if(typeof d=="function")return d.call(this,b,c);var e=[],f;for(f in c)e.push("dhx_filter["+f+"]="+encodeURIComponent(c[f]));this.load(d+(d.indexOf("?")<0?"?":"&")+e.join("&"));return!1}if(b===null)return this.filterBy(0,
function(){return!1});this.filterBy(0,function(c,d){return a.call(this,d,b)})};if(window.dhtmlXTreeObject)dhtmlXTreeObject.prototype.bind=function(){dhx.BaseBind.bind.apply(this,arguments)},dhtmlXTreeObject.prototype.unbind=function(a){dhx.BaseBind.e.call(this,a)},dhtmlXTreeObject.prototype.dataFeed=function(a){this.a?this.a.dataFeed=a:this.h=a},dhtmlXTreeObject.prototype.b=function(){if(dhx.isUndefined(this.a))this.a={id:dhx.uid(),dataFeed:this.h},dhx.ui.views[this.a.id]=this,this.data={silent:dhx.bind(function(a){a.call(this)},this)},dhtmlxEventable(this.data),this.attachEvent("onSelect",
function(a){this.callEvent("onSelectChange",[a])}),this.attachEvent("onEdit",function(a,b){a===2&&b&&b==this.getCursor()&&this.i();return!0})},dhtmlXTreeObject.prototype.item=function(a){return a===null?null:{id:a,text:this.getItemText(a)}},dhtmlXTreeObject.prototype.getSelected=function(){return this.getSelectedItemId()},dhtmlXTreeObject.prototype.isVisible=function(){return!0},dhtmlXTreeObject.prototype.refresh=function(){},dhtmlXTreeObject.prototype.filter=function(a,b){if(this.a.dataFeed){var c=
{};if(a||b){if(typeof a=="function"){if(!b)return;a(b,c)}else dhx.isUndefined(a)?c=b:c[a]=b;this.deleteChildItems(0);var d=this.a.dataFeed;if(typeof d=="function")return d.call(this,[data.id||data,data]);var e=[],f;for(f in c)e.push("dhx_filter["+f+"]="+encodeURIComponent(c[f]));this.loadXML(d+(d.indexOf("?")<0?"?":"&")+e.join("&"));return!1}}},dhtmlXTreeObject.prototype.update=function(a,b){dhx.isUndefined(b.text)||this.setItemText(a,b.text)};dhtmlx.skin='dhx_skyblue';
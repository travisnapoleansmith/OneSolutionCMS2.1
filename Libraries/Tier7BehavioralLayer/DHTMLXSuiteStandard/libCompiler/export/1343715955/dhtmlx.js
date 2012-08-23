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
 };})();function dhtmlXColorPickerInput(container){if (typeof(container)!="object")
 container=document.getElementById(container);var n=container;var cb=n.getAttribute("colorbox");var cc=n.getAttribute("customcolors");var cs=n.getAttribute("selectonclick");var cv=n.getAttribute("fullview");var sc=n.getAttribute("selectedcolor");var k=n;if (cb){var d=document.createElement("DIV");d.style.width=n.offsetWidth+"px";d.style.height=n.offsetHeight+"px";n.style.width=n.offsetWidth-n.offsetHeight-2;n.parentNode.insertBefore(d,n);d.style.position="relative";k=document.createElement("DIV");d.appendChild(k);d.appendChild(n);k.className="cs_colorBox";n.className+=" cs_colorInput";k.style.width=k.style.height=(n.offsetHeight-(document.all?0:2))+"px";n.style.left=n.offsetHeight+2+"px";}
 var z2=new dhtmlXColorPicker(null,cs,cc,true,cv);if (sc)z2.setColor(sc);z2.linkToObjects = [k,n,n];return z2;}
function dhtmlXColorPicker(container, isClickOnly, customColors, hide, fullview)
{if (document.all)try {document.execCommand("BackgroundImageCache", false, true);}catch (e){}
 this._cc=customColors;if (!container){container=document.createElement("DIV");container.style.position="absolute";document.body.appendChild (container);container._dhx_remove=true;}
 if (typeof(container)!="object")
 this.container = document.getElementById(container);else
 this.container = container;dhtmlxEventable(this);this.skinName = dhtmlx.skin || '';this.ready = false;this.hideOnInit = hide || false;this.linkToObjects = [];this.imgURL = dhtmlx.image_path||window.dhx_globalImgPath||"";this.hideSelfOnSelect = true;this.hex = "000000";this.h = 100;this.s = 0.9;this.v = 0.1;this.r = 0;this.g = 0;this.b = 0;this.old_hue = 0;this.old_sat = 0;this.fullview = fullview || false;this.customColorsCount=(!this.fullview?10:8);this.language = null;this.elements = new Array();this.customColors = new Array();this.restoreFrom = null;if (!this.fullview){this.colorSelectH = 119;this.colorSelectW = 209;}else {this.colorSelectH = 255;this.colorSelectW = 255;}
 

 this.isClickOnly = isClickOnly||false;if (window.cs_dechex == null){var hexDigit = new Array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f');window.cs_dechex = new Array();for (var i=0;i<256;i++){var retval = hexDigit[i>>4].toString()+hexDigit[i&15].toString();if (retval.length < 2)retval = '0'+retval;window.cs_dechex[i] = retval;}
 }
 defLeng = {langname: 'en-us',
 labelHue : "Hue",
 labelSat : "Sat",
 labelLum : "Lum",
 labelRed : "Red",
 labelGreen : "Green",
 labelBlue : "Blue",
 btnAddColor : "Add to Custom Colors",
 btnSelect : "Select",
 btnCancel : "Cancel"
 }
 
 if (window.dhtmlxColorPickerObjects)window.dhtmlxColorPickerObjects[window.dhtmlxColorPickerObjects.length] = this;else window.dhtmlxColorPickerObjects = [this];if (!window.dhtmlxColorPickerLangModules)window.dhtmlxColorPickerLangModules = {};window.dhtmlxColorPickerLangModules['en-us'] = defLeng;return this;}
dhtmlXColorPicker.prototype.generate = function()
{X = (document.compatMode!="BackCompat"?"X":"");if (!this.fullview){var html = "<div class='dhtmlxcolorpicker" + (this.skinName != '' ? '_' + this.skinName : '') + "' csid='cs_Content' style='display:none;'>";if ((document.all)&&((this.container.style.position=="absolute")))
 html +="<iframe src='"+(this.imgURL||"")+"blank.html' frameBorder='0' style='position:absolute;top:0px;left:0px;width:252px;height:"+(this._cc?300:244)+"px;z-index:-1;'></iframe>";html += "<table cellpadding='0' cellspacing='0'>";html += "<tr><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"left_top.gif);'></td><td style='height:2px;background:url("+(this.imgURL||"")+"top.gif);'></td><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"right_top.gif);'></td></tr>";html += "<tr><td style='width:2px;background:url("+(this.imgURL||"")+"left.gif);'></td><td style='width:"+(document.all?247:243)+"px;height:"+(this._cc?281:240)+"px;'>";html +="<table class='cs_ContentTable' csid='cs_ContentTable' cellpadding='0px' cellspacing='0px'>";html += "<tr>";html += "<td><div class='cs_SelectorDiv_Mini' csid='cs_SelectorDiv'><div class='cs_SelectorVer' csid='cs_SelectorVer' style='left:100px;top:0px;'></div><div class='cs_SelectorHor' csid='cs_SelectorHor' style='left:0px;top:100px;'></div></div></td>";html += "<td><div class='cs_LumSelect_Mini' csid='cs_LumSelect'><div csid='cs_LumSelectArrow'></div><div class='cs_LumSelectLine' csid='cs_LumSelectLine' style='left:0px;top:0px;'></div></div></td>";html += "</tr>";html += "<tr><td style='padding-top:10px;' colspan='2'>";html += "<table class='cs_ColorArea_Mini' cellpadding='0px' cellspacing='0px'>";html += "<tr><td rowspan='2' valign='top' style='text-align:left;'><div class='cs_EndColor_Mini' csid='cs_EndColor' ></div></td><td>"+this.language.labelHue+":</td><td><input tabindex='1' class='cs_Input_Mini"+X+"' csid='cs_InputHue' value='' /></td><td>"+this.language.labelRed+":</td><td><input tabindex='4' class='cs_Input_Mini"+X+"' csid='cs_InputRed' value='' /></td></tr>";html += "<tr><td>"+this.language.labelSat+":</td><td><input tabindex='2' class='cs_Input_Mini"+X+"' csid='cs_InputSat' value='' /></td><td>"+this.language.labelGreen+":</td><td><input tabindex='4' class='cs_Input_Mini"+X+"' csid='cs_InputGreen' value='' /></td></tr>";html += "<tr><td style='vertical-align:top;width:80px;text-align:left;'># <input csid='cs_Hex' class='cs_Hex_Mini"+X+"'></td><td>"+this.language.labelLum+":</td><td><input tabindex='2' class='cs_Input_Mini"+X+"' csid='cs_InputLum' value='' /></td><td>"+this.language.labelBlue+":</td><td><input tabindex='4' class='cs_Input_Mini"+X+"' csid='cs_InputBlue' value='' /></td></tr>";if (this._cc){html += "<tr><td colspan='6'><input tabindex='7' class='cs_CustomColorAdd_Mini' csid='cs_CustomColorAdd' type='button' value='"+this.language.btnAddColor+"'></td></tr>";html += "<tr><td colspan='6'><div class='cs_CustomColors_Mini' csid='cs_CustomColors'></div></td></tr>";}
 html += "</table>";html += "</td></tr>";html += "</table>";html += "<table class='cs_ButtonsPanel' cellpadding='0' cellspacing='0' style='width:100%;'><tr><td style='width:100%;'><input tabindex='9' class='cs_ButtonCancel' csid='cs_ButtonCancel' type='button' value='"+this.language.btnCancel+"' /><input tabindex='8' class='cs_ButtonOk' csid='cs_ButtonOk' type='button' value='"+this.language.btnSelect+"' /></td></tr></table>";html += "</td><td style='width:2px;background:url("+(this.imgURL||"")+"right.gif);'></td></tr>";html += "<tr><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"left_bottom.gif);'></td><td style='height:2px;background:url("+(this.imgURL||"")+"bottom.gif);'></td><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"right_bottom.gif);'></td></tr>";html += "</table>";html +="</div>";}else {var html = "<div class='dhtmlxcolorpicker" + (this.skinName != '' ? '_' + this.skinName : '') + "' csid='cs_Content' style='display:none;'>";if ((document.all)&&((this.container.style.position=="absolute")))
 html +="<iframe src='"+(this.imgURL||"")+"blank.html' style='position:absolute;top:0px;left:0px;width:320px;height:"+(this._cc?454:407)+"px;z-index:-1;'></iframe>";html += "<table cellpadding='0' cellspacing='0'>";html += "<tr><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"left_top.gif);'></td><td style='height:2px;background:url("+(this.imgURL||"")+"top.gif);'></td><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"right_top.gif);'></td></tr>";html += "<tr><td style='width:2px;background:url("+(this.imgURL||"")+"left.gif);'></td><td style='width:316px;height:"+(this._cc?446:392)+"px;background:#E6E5E5;'>";html +="<table class='cs_ContentTable' csid='cs_ContentTable' cellpadding='0px' cellspacing='0px'>";html += "<tr>";html += "<td><div class='cs_SelectorDiv' csid='cs_SelectorDiv'><div class='cs_SelectorVer' csid='cs_SelectorVer' style='left:100px;top:0px;'></div><div class='cs_SelectorHor' csid='cs_SelectorHor' style='left:0px;top:100px;'></div></div></td>";html += "<td><div class='cs_LumSelect' csid='cs_LumSelect'><div class='cs_LumSelectArrow' csid='cs_LumSelectArrow' style='left:16px;top:124px;'></div><div class='cs_LumSelectLine' csid='cs_LumSelectLine' style='left:0px;top:0px;'></div></div></td>";html += "</tr>";html += "<tr><td style='padding-top:10px;' colspan='2'>";html += "<table class='cs_ColorArea' cellpadding='0px' cellspacing='0px'>";html += "<tr><td rowspan='3'><div class='cs_EndColor' csid='cs_EndColor'></div></td><td valign='top' style='text-align:center;width:80px;'># <input csid='cs_Hex' class='cs_Hex'></td><td>"+this.language.labelHue+":</td><td><input tabindex='1' class='cs_Input' csid='cs_InputHue' value='' /></td><td>"+this.language.labelRed+":</td><td><input tabindex='4' class='cs_Input' csid='cs_InputRed' value='' /></td></tr>";html += "<tr><td></td><td>"+this.language.labelSat+":</td><td><input tabindex='2' class='cs_Input' csid='cs_InputSat' value='' /></td><td>"+this.language.labelGreen+":</td><td><input tabindex='4' class='cs_Input' csid='cs_InputGreen' value='' /></td></tr>";html += "<tr><td></td><td>"+this.language.labelLum+":</td><td><input tabindex='2' class='cs_Input' csid='cs_InputLum' value='' /></td><td>"+this.language.labelBlue+":</td><td><input tabindex='4' class='cs_Input' csid='cs_InputBlue' value='' /></td></tr>";if (this._cc){html += "<tr><td>";html += "<div class='cs_CustomColors' csid='cs_CustomColors'></div>";html += "</td><td></td><td colspan='4' valign='top'><input tabindex='7' class='cs_CustomColorAdd' csid='cs_CustomColorAdd' type='button' value='"+this.language.btnAddColor+"'></td></tr>";}
 html += "</table>";html += "</td></tr>";html += "</table>";html += "<table cellpadding='0' cellspacing='0' style='width:100%;'><tr><td style='height:49px;background:url("+(this.imgURL||"")+"buttons_panel.gif);'><input tabindex='9' class='cs_ButtonCancel' csid='cs_ButtonCancel' type='button' value='"+this.language.btnCancel+"' /><input tabindex='8' class='cs_ButtonOk' csid='cs_ButtonOk' type='button' value='"+this.language.btnSelect+"' /></td></tr></table>";html += "</td><td style='width:2px;background:url("+(this.imgURL||"")+"right.gif);'></td></tr>";html += "<tr><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"left_bottom.gif);'></td><td style='height:2px;background:url("+(this.imgURL||"")+"bottom.gif);'></td><td style='width:2px;height:2px;background:url("+(this.imgURL||"")+"right_bottom.gif);'></td></tr>";html += "</table>";html +="</div>";}
 if (!this.fullview)this.container.style.width="252px";else 
 this.container.style.width="320px";this.container.innerHTML = html;this._initCsIdElement();if (!this.fullview)this.elements['cs_SelectorDiv'].style.backgroundImage='url('+(this.imgURL||"")+'colormini.png)';else
 this.elements['cs_SelectorDiv'].style.backgroundImage='url('+(this.imgURL||"")+'color.png)';this.elements['cs_SelectorDiv'].z = this;this.elements['cs_LumSelect'].z = this;this.elements['cs_LumSelectArrow'].z = this;this.z = this;this._drawLum();this._colorizeLum(this.old_hue, this.old_sat);this._initEvents();if (this._cc)this._initCustomColors();this.ColorNum = 0;this.restoreFromHSV();this._drawValues();}
dhtmlXColorPicker.prototype._initCsIdElement = function(obj)
{if (obj == null)obj = this.container;var childs = obj.childNodes;var l = childs.length;for (var i=0;i<l;i++){if (childs[i].nodeType == 1){var attr = childs[i].getAttribute('csid');if (attr !== null){this.elements[attr] = childs[i];}
 if (childs[i].childNodes.length > 0){this._initCsIdElement(childs[i]);}
 }
 }
}
dhtmlXColorPicker.prototype._initEvents = function()
{this.elements['cs_SelectorDiv'].onmousedown = this._startMoveColor;this.elements['cs_SelectorDiv'].ondblclick = this.clickOk;this.elements['cs_LumSelect'].onmousedown = this._startMoveLum;this.elements['cs_LumSelect'].ondblclick = this.clickOk;this.elements['cs_LumSelectArrow'].onmousedown = this._startMoveLum;if (this._cc){this.elements['cs_CustomColorAdd'].z = this;this.elements['cs_CustomColorAdd'].onclick = this.addCustomColor;this.elements['cs_CustomColorAdd'].onmouseover = this.hoverButton;this.elements['cs_CustomColorAdd'].onmouseout = this.normalButton;}
 var inputs = new Array('cs_InputHue', 'cs_InputRed', 'cs_InputSat', 'cs_InputGreen', 'cs_InputLum', 'cs_InputBlue');for (var i=0;i<inputs.length;i++){this.elements[inputs[i]].z = this;this.elements[inputs[i]].onchange = i%2?this._changeValueRGB:this._changeValueHSV;}
 this.elements['cs_Hex'].z = this;this.elements['cs_Hex'].onchange = this._changeValueHEX;this.elements['cs_ButtonOk'].z = this;this.elements['cs_ButtonOk'].onclick = this.clickOk;this.elements['cs_ButtonOk'].onmouseover = this.hoverButton;this.elements['cs_ButtonOk'].onmouseout = this.normalButton;this.elements['cs_ButtonCancel'].z = this;this.elements['cs_ButtonCancel'].onclick = this.clickCancel;this.elements['cs_ButtonCancel'].onmouseover = this.hoverButton;this.elements['cs_ButtonCancel'].onmouseout = this.normalButton;}
dhtmlXColorPicker.prototype.resetHandlers = function(ev)
{}
dhtmlXColorPicker.prototype.clickOk = function(ev)
{var z = this.z;var t=z.getSelectedColor();z.callEvent ("onSelect", [t[0]]);if (z.hideSelfOnSelect)z.hide();}
dhtmlXColorPicker.prototype.clickCancel = function(ev)
{var z = this.z;z.callEvent("onCancel",[]);if (this.z.hideSelfOnSelect)this.z.hide();}
dhtmlXColorPicker.prototype._setCrossPos = function(ev)
{var z = this.z;var offset = z._getOffset(this.elements['cs_SelectorDiv']);var y = ev.clientY - offset[0];if (y < 0)y = 0;else if (y > this.colorSelectH)y = this.colorSelectH;var x = ev.clientX - offset[1];if (x < 0)x = 0;else if (x > this.colorSelectW)x = this.colorSelectW;z.elements['cs_SelectorVer'].style.left = x+'px';z.elements['cs_SelectorHor'].style.top = y+'px';var H = x==this.colorSelectW?0:360*x/this.colorSelectW;var S = 1-y/this.colorSelectH;return [H, S];}
dhtmlXColorPicker.prototype._getScrollers = function(){return ([(document.body.scrollLeft||document.documentElement.scrollLeft),(document.body.scrollTop||document.documentElement.scrollTop)]);}
dhtmlXColorPicker.prototype._setLumPos = function(ev)
{var z = this.z;var offset = z._getOffset(z.elements['cs_LumSelect']);var y = ev.clientY - offset[0] - 4;if (y < -3)y = -3;if (y > this.colorSelectH-4)y = this.colorSelectH-4;z.elements['cs_LumSelectArrow'].style.top = y+'px';z.elements['cs_LumSelectLine'].style.top = y+4+'px';var V = (y+3)/this.colorSelectH;return V;}
dhtmlXColorPicker.prototype._startMoveColor = function(ev)
{var z = this.z;if (ev == null)ev = event;z.elements['cs_SelectorDiv'].onmousedown = null;z.b_move = document.body.onmousemove;z.b_up = document.body.onmouseup;var self=z;document.body.onmousemove = function(e) {if (e ==null)e = event;self._mouseMoveColor(e);};document.body.onmouseup = function(e) {if (e ==null)e = event;self._stopMoveColor(e);self = null;};z.elements['cs_SelectorDiv'].onmousemove = z._mouseMoveColor;z.elements['cs_SelectorDiv'].onmouseup = z._stopMoveColor;var HS = z._setCrossPos(ev);z.h = HS[0];z.s = HS[1];var col = z._calculateColor();z._colorizeLum(col[0], col[1]);}
dhtmlXColorPicker.prototype._mouseMoveColor = function(ev)
{var z = this.z;if (ev == null)ev = event;var HS = z._setCrossPos(ev);if (z.isClickOnly)return;z.h = HS[0];z.s = HS[1];var col = z._calculateColor();z._colorizeLum(col[0], col[1]);}
dhtmlXColorPicker.prototype._stopMoveColor = function(ev)
{var z = this.z;if (ev == null)ev = event;z.elements['cs_SelectorDiv'].onmousedown = z._startMoveColor;z.elements['cs_SelectorDiv'].onmousemove = null;z.elements['cs_SelectorDiv'].onmouseup = null;document.body.onmousemove = z.b_move;document.body.onmouseup = z.b_up;var HS = z._setCrossPos(ev);z.h = HS[0];z.s = HS[1];var col = z._calculateColor();z._colorizeLum(col[0], col[1]);}
dhtmlXColorPicker.prototype._startMoveLum = function(ev)
{var z = this.z;if (ev == null)ev = event;z.elements['cs_LumSelect'].onmousedown = null;z.elements['cs_LumSelectArrow'].onmousedown = null;z.elements['cs_LumSelect'].onmousemove = z._mouseMoveLum;z.elements['cs_LumSelect'].onmouseup = z._stopMoveLum;z.b_move = document.body.onmousemove;z.b_up = document.body.onmouseup;z.b_selstart = document.body.onselectstart;var self=z;document.body.onmousemove = function(e) {if (e == null)e = event;self._mouseMoveLum(e);}
 document.body.onmouseup = function(e) {if (e == null)e = event;self._stopMoveLum(e);self = null;}
 document.body.onselectstart = function() {return false}
 z.v = z._setLumPos(ev);z._calculateColor();}
dhtmlXColorPicker.prototype._mouseMoveLum = function(ev)
{var z = this.z;if (ev == null)ev = event;z.v = z._setLumPos(ev);if (z.isClickOnly)return;z._calculateColor();}
dhtmlXColorPicker.prototype._stopMoveLum = function(ev)
{var z = this.z;if (ev == null)ev = event;z.elements['cs_LumSelect'].onmousedown = z._startMoveLum;z.elements['cs_LumSelectArrow'].onmousedown = z._startMoveLum;z.elements['cs_LumSelect'].onmousemove = null;z.elements['cs_LumSelect'].onmouseup = null;z.v = z._setLumPos(ev);z._calculateColor();document.body.onmousemove = z.b_move;document.body.onmouseup = z.b_up;document.body.onselectstart = z.b_selstart;}
dhtmlXColorPicker.prototype._getOffset = function(node)
{var top = this._getOffsetTop(node);var left = this._getOffsetLeft(node);var mod=this._getScrollers();return [top-mod[1], left-mod[0]];}
dhtmlXColorPicker.prototype._getOffsetTop = function(node)
{var offset = 0;if (node.offsetParent)offset += node.offsetTop+this._getOffsetTop(node.offsetParent);return offset;}
dhtmlXColorPicker.prototype._getOffsetLeft = function(node)
{var offset = 0;if (node.offsetParent)offset += node.offsetLeft+this._getOffsetLeft(node.offsetParent);return offset;}
dhtmlXColorPicker.prototype._calculateColor = function()
{if (this.restoreFrom == 'RGB'){var rgb = [this.r, this.g, this.b];}
 else {var rgb = this._hsv2rgb(this.h, this.s, 1-this.v);this.r = rgb[0];this.g = rgb[1];this.b = rgb[2];}
 
 this.hex = this._getColorHEX(rgb);this.elements['cs_EndColor'].style.backgroundColor = '#'+this.hex;this._drawValues();this.restoreFrom = null;return [this.h, this.s, 1-this.v];}
dhtmlXColorPicker.prototype._drawValues = function()
{this.elements['cs_Hex'].value = this.hex;this.elements['cs_InputHue'].value = Math.floor(this.h);this.elements['cs_InputSat'].value = Math.floor(this.s*100);this.elements['cs_InputLum'].value = Math.floor((1-this.v)*100);this.elements['cs_InputRed'].value = Math.floor(this.r);this.elements['cs_InputGreen'].value = Math.floor(this.g);this.elements['cs_InputBlue'].value = Math.floor(this.b);}
dhtmlXColorPicker.prototype.saveColor = function(rgb, num)
{var date = new Date();var datevalue = date.valueOf()+2678400000;date = new Date(datevalue);var str = 'color_'+num+'='+rgb+';expires='+date.toGMTString();document.cookie = str;}
dhtmlXColorPicker.prototype.restoreColor = function(num) {var rgb = false;var name = 'color_'+num;if (document.cookie.length > 0){var pos = document.cookie.indexOf(name+'=');if (pos != -1){var pos2 = document.cookie.indexOf(';', pos);if (pos2 == -1)pos2 = document.cookie.length;var pos3 = document.cookie.indexOf('=', pos)+1;var rgb = document.cookie.substr(pos3, pos2-pos3);}
 }
 return rgb;}
dhtmlXColorPicker.prototype._hsv2rgb = function(h, s, v)
{Hi = Math.floor((h/60))%6;f = h/60-Hi;p = v*(1-s);q = v*(1-f*s);t = v*(1-(1-f)*s);var r = 0;var g = 0;var b = 0;switch(Hi) {case 0:
 r = v;g = t;b = p;break;case 1:
 r = q;g = v;b = p;break;case 2:
 r = p;g = v;b = t;break;case 3:
 r = p;g = q;b = v;break;case 4:
 r = t;g = p;b = v;break;case 5:
 r = v;g = p;b = q;break;}
 r = Math.floor(r*255);g = Math.floor(g*255);b = Math.floor(b*255);return [r, g, b];}
dhtmlXColorPicker.prototype._rgb2hsv = function(r, g, b)
{R = r/255;G = g/255;B = b/255;var MAX = Math.max(R, G, B);var MIN = Math.min(R, G, B);var V = MAX;var S = MAX==0?0:(1-MIN/MAX);var H = 0;if (MAX == MIN){H = 0;}else if (MAX == R && G>=B){H = 60*(G-B)/(MAX-MIN)+0;}else if (MAX == R && G < B){H = 60*(G-B)/(MAX-MIN)+360;}else if (MAX == G){H = 60*(B-R)/(MAX-MIN)+120;}else if (MAX == B){H = 60*(R-G)/(MAX-MIN)+240;}
 return [H, S, V];}
dhtmlXColorPicker.prototype._drawLum = function()
{var color = this.colorSelectH;var lumElemCount = (!this.fullview?30:64);var colorInc = (!this.fullview?8:4);for (var i=0;i<lumElemCount;i++){var d = document.createElement('div');var c = this._dec2hex(color);d.style.backgroundColor = '#'+c+c+c;d.className = 'cs_LumElement';color-=colorInc;this.elements['cs_LumSelect'].appendChild(d);}
}
dhtmlXColorPicker.prototype._colorizeLum = function(hue, sat)
{this.old_hue = hue;this.old_sat = sat;var lum = 255;var colorInc = (!this.fullview?8:4);var l = this.elements['cs_LumSelect'].childNodes.length;for (var i=2;i<l;i++){var v = (lum>255)?1:(lum/255);var rgb = this._hsv2rgb(hue, sat, v);var rgb = '#'+this._getColorHEX(rgb);this.elements['cs_LumSelect'].childNodes[i].style.backgroundColor = rgb;lum-=colorInc;}
 this.callEvent("onChange", [this.getSelectedColor()])
}
dhtmlXColorPicker.prototype._dec2hex = function(dec)
{return window.cs_dechex[dec]||'00';}
dhtmlXColorPicker.prototype._hex2dec = function(hex)
{return parseInt(hex, 16);}
dhtmlXColorPicker.prototype._initCustomColors = function()
{var colors = this.elements['cs_CustomColors'];for (var i=0;i<this.customColorsCount;i++){var d = document.createElement('div');d.className = (this.fullview?'cs_CustomColor':'cs_CustomColor_Mini');d.color_num = i;if (document.all){if (navigator.appName=='Opera'){if (!this.fullview){d.style.width = '18px';d.style.height = '18px';}else {d.style.width = '14px';d.style.height = '14px';}
 }
 else
 if (!this.fullview){if (document.compatMode != "BackCompat")d.style.width = '18px';else 
 d.style.width = '20px';d.style.height = '20px';}else {d.style.width = '16px';d.style.height = '16px';}
 }
 d.z = this;d.onclick=this._selectCustomColor;d.ondblclick=this.clickOk;var color = this.restoreColor(i)||'0,0,0';d.color = color;var rgb = color.split(',');d.style.backgroundColor = '#'+this._getColorHEX(rgb);this.customColors.push(d);colors.appendChild(d);}
}
dhtmlXColorPicker.prototype._reinitCustomColors = function()
{var colors = this.elements['cs_CustomColors'];for (var i=0;i<this.customColorsCount;i++){var d = this.customColors[i];var color = this.restoreColor(i)||'0,0,0';d.color = color;var rgb = color.split(',');d.style.backgroundColor = '#'+this._getColorHEX(rgb);this.customColors[i] = d;}
}
dhtmlXColorPicker.prototype._getColorHEX=function(rgb){var r = this._dec2hex(rgb[0]);var g = this._dec2hex(rgb[1]);var b = this._dec2hex(rgb[2]);return (r+g+b);}
dhtmlXColorPicker.prototype._selectCustomColor = function(ev)
{if (ev == null)ev = event;var z = this.z;if (!this.selected){for (var i = 0;i< z.customColors.length;i++)z.customColors[i].style.border = '1px solid gray';this.style.border = '1px dashed black';this.selected = true;if (z.selectedColor != null){z.customColors[z.selectedColor].style.border = '1px solid gray';z.customColors[z.selectedColor].selected = false;}
 }
 z.selectedColor = this.color_num;z.ColorNum = this.color_num;var color = this.color.split(',');z.r = color[0];z.g = color[1];z.b = color[2];z.restoreFromRGB();}
dhtmlXColorPicker.prototype.addCustomColor = function()
{var z = this.z;if (z.selectedColor != null){var d = z.customColors[z.selectedColor];var n = z.selectedColor;d.style.border = '1px solid gray';z.selectedColor = null;}else {var d = z.customColors[z.ColorNum];var n = z.ColorNum;d.style.border = '1px solid gray';}
 var rgb = z.r+','+z.g+','+z.b;z.saveColor(rgb, n);d.color = rgb;z.ColorNum = z.ColorNum==9?0:z.ColorNum+1;z.customColors[z.ColorNum].style.border = '1px dashed red';d.style.backgroundColor = z.elements['cs_EndColor'].style.backgroundColor;}
dhtmlXColorPicker.prototype.restoreFromRGB = function()
{this.restoreFrom = 'RGB';var HSV = this._rgb2hsv(this.r, this.g, this.b);this.h = HSV[0];this.s = HSV[1];this.v = 1-HSV[2];if (this.ready)this.redraw();}
dhtmlXColorPicker.prototype.restoreFromHSV = function()
{this.restoreFrom = 'HSV';var RGB = this._hsv2rgb(this.h, this.s, this.v);this.r = RGB[0];this.g = RGB[1];this.b = RGB[2];this.redraw();}
dhtmlXColorPicker.prototype.restoreFromHEX = function()
{this.r = this._hex2dec(this.hex.substr(0,2));this.g = this._hex2dec(this.hex.substr(2,2));this.b = this._hex2dec(this.hex.substr(4,2));this.restoreFromRGB();}
dhtmlXColorPicker.prototype.redraw = function()
{var x = this.colorSelectW*this.h/360;var y = (1-this.s)*this.colorSelectH;var top = (this.v)*this.colorSelectH;this.elements['cs_SelectorHor'].style.top = y+"px";this.elements['cs_SelectorVer'].style.left = x+"px";this.elements['cs_LumSelectArrow'].style.top = top-3+"px";this.elements['cs_LumSelectLine'].style.top = top+1+"px";var col = this._calculateColor();this._colorizeLum(col[0], col[1]);}
dhtmlXColorPicker.prototype._changeValueHSV = function()
{var z = this.z;var H = parseInt(z.elements['cs_InputHue'].value)||0;var S = parseInt(z.elements['cs_InputSat'].value)||0;var V = parseInt(z.elements['cs_InputLum'].value)||0;if (H < 0 || H > 359)H = 0;if (S < 0 || S > 100)S = 0;if (V < 0 || V > 100)V = 0;z.elements['cs_InputHue'].value = H;z.elements['cs_InputSat'].value = S;z.elements['cs_InputLum'].value = V;z.h = H;z.s = S/100;z.v = 1-V/100;z.restoreFromHSV();}
dhtmlXColorPicker.prototype._changeValueRGB = function()
{var z = this.z;var R = parseInt(z.elements['cs_InputRed'].value)||0;var G = parseInt(z.elements['cs_InputGreen'].value)||0;var B = parseInt(z.elements['cs_InputBlue'].value)||0;if (R < 0 || R > 255)R = 0;if (G < 0 || G > 255)G = 0;if (B < 0 || B > 255)B = 0;z.elements['cs_InputRed'].value = R;z.elements['cs_InputGreen'].value = G;z.elements['cs_InputBlue'].value = B;z.r = R;z.g = G;z.b = B;z.restoreFromRGB();}
dhtmlXColorPicker.prototype._changeValueHEX = function()
{var z = this.z;var hex = (z.elements['cs_Hex'].value)||000000;hex = hex.replace(/[^a-fA-F0-9]/gi,"0");if (hex.length>6)hex = hex.substr(0,6)
 else while (hex.length<6)hex += '0';z.elements['cs_Hex'].value = hex;z.hex = hex;z.restoreFromHEX();}
dhtmlXColorPicker.prototype.setCustomColors = function(colors)
{colors = colors.split(",");for (var i=0;i<colors.length;i++){var rgb = colors[i];if (rgb.substr(0, 1)== '#') {rgb = rgb.substr(1);}
 var R = this._hex2dec(rgb.substr(0, 2));var G = this._hex2dec(rgb.substr(2, 2));var B = this._hex2dec(rgb.substr(4, 2));rgb = R+','+G+','+B;this.saveColor(rgb, i);}
}
dhtmlXColorPicker.prototype.setColor = function(rgb)
{if (typeof(rgb)!= 'string') {var R = rgb[0];var G = rgb[1];var B = rgb[2];}else if (rgb.indexOf('rgb')!=-1) {var rgbArr = rgb.substr(rgb.indexOf("(")+1,rgb.lastIndexOf(")")-rgb.indexOf("(")-1).split(",");var R = rgbArr[0];var G = rgbArr[1];var B = rgbArr[2];}else {if (rgb.substr(0, 1)== '#') {rgb = rgb.substr(1);}
 var R = this._hex2dec(rgb.substr(0, 2));var G = this._hex2dec(rgb.substr(2, 2));var B = this._hex2dec(rgb.substr(4, 2));}
 R = parseInt(R)||0;G = parseInt(G)||0;B = parseInt(B)||0;if (R < 0 || R > 255)R = 0;if (G < 0 || G > 255)G = 0;if (B < 0 || B > 255)B = 0;this.r = R;this.g = G;this.b = B;this.restoreFromRGB();}
dhtmlXColorPicker.prototype.close = function()
{this.elements['cs_SelectorDiv'].z = null;this.elements['cs_LumSelect'].z = null;this.elements['cs_LumSelectArrow'].z = null;this.elements['cs_ButtonOk'].z = null;this.elements['cs_ButtonCancel'].z = null;if (this.cc)this.elements['cs_CustomColorAdd'].z = null;this.container.innerHTML="";if (this.container._dhx_remove)this.container.parentNode.removeChild(this.container);}
dhtmlXColorPicker.prototype.show = function()
{this.callEvent("onShow",[]);if (this.container.innerHTML=="")return;this.elements['cs_Content'].style.display = '';this.elements['cs_InputHue'].focus()
}
dhtmlXColorPicker.prototype.setPosition = function(x,y)
{this.container.style.position='absolute';this.container.style.top=(y>0?y:10)+"px";this.container.style.left=x+"px";}
dhtmlXColorPicker.prototype.hide = function()
{this.resetHandlers();if (this.elements['cs_Content'])this.elements['cs_Content'].style.display = 'none';}
dhtmlXColorPicker.prototype.setOnSelectHandler = function(func){this.attachEvent ("onSelect", func);}
dhtmlXColorPicker.prototype.setOnCancelHandler = function(func){this.attachEvent ("onCancel", func);}
dhtmlXColorPicker.prototype.getSelectedColor = function(){var rgb_dec = new Array(this.r, this.g, this.b);var rgb_hex = this._dec2hex(this.r)+this._dec2hex(this.g)+this._dec2hex(this.b);var hsl = new Array(this.h, this.s, this.v);return ["#"+rgb_hex,rgb_dec,hsl];}
dhtmlXColorPicker.prototype.linkTo = function(obj1,obj2,obj3){if (typeof(obj1)!="object")
 obj1=document.getElementById(obj1);if (typeof(obj2)!="object")
 obj2=document.getElementById(obj2);if (typeof(obj3)!="object")
 obj3=document.getElementById(obj3);this.linkToObjects = arguments;var self=this;obj2.onclick=function(){var z=self._getOffset(obj1);var s=self._getScrollers();var x=z[1]+s[0];var y=z[0]+s[1];self.setPosition(x+obj1.offsetWidth,y);self.isVisible() ? self.hide() : self.show();};this.setOnSelectHandler(function(color){obj1.style.backgroundColor=color;if (obj3)obj3.value=color;});this.close=this.hide;this.hide();}
dhtmlXColorPicker.prototype.hideOnSelect = function(value) {this.hideSelfOnSelect = value;}
dhtmlXColorPicker.prototype.setImagePath = function(path){this.imgURL = path;}
dhtmlXColorPicker.prototype.init = function(){if (!this.language)this.loadUserLanguage ("en-us");this.generate();this.ready = true;if (this._cc)this._reinitCustomColors();if (this.linkToObjects.length>0)this.linkTo(this.linkToObjects[0],this.linkToObjects[1],this.linkToObjects[2]);if (!this.hideOnInit)this.show();}
dhtmlXColorPicker.prototype.loadUserLanguage = function(lang) {if (!window.dhtmlxColorPickerLangModules [lang])return;this.language = window.dhtmlxColorPickerLangModules [lang];if (this.ready){this.generate();this.show();}
}
dhtmlXColorPicker.prototype.setSkin = function (skin) {this.skinName = skin;if (this.elements['cs_Content'])this.elements['cs_Content'].className = 'dhtmlxcolorpicker' + (skin ? '_' + skin : skin);}
 
dhtmlXColorPicker.prototype.isVisible = function () {return !(this.elements['cs_Content'].style.display == 'none');};dhtmlXColorPicker.prototype.hoverButton = function () {this.className += '_Hover';};dhtmlXColorPicker.prototype.normalButton = function () {this.className = this.className.substr(0, this.className.length-6)
};(function(){dhtmlx.extend_api("dhtmlXColorPicker",{_init:function(obj){return [obj.parent, obj.click, obj.colors, obj.hide, obj.full ];},
 show:"showA",
 link:"linkTo",
 image_path:"setImagePath",
 color:"setColor"
 },{showA:function(){this.init();this.show();}
 });})();function dataProcessor(serverProcessorURL){this.serverProcessor = serverProcessorURL;this.action_param="!nativeeditor_status";this.object = null;this.updatedRows = [];this.autoUpdate = true;this.updateMode = "cell";this._tMode="GET";this.post_delim = "_";this._waitMode=0;this._in_progress={};this._invalid={};this.mandatoryFields=[];this.messages=[];this.styles={updated:"font-weight:bold;",
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
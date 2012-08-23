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
 };})();function dhtmlXForm(parentObj, data) {this.i = {position: "label-left",
 labelWidth: "auto",
 labelHeight: "auto",
 inputWidth: "auto",
 inputHeight: "auto",
 labelAlign: "left",
 noteWidth: "auto",
 offsetTop: 0,
 offsetLeft: 0
 };this.apos_css = {"label-left": "dhxform_item_label_left",
 "label-right": "dhxform_item_label_right",
 "label-top": "dhxform_item_label_top",
 "label-bottom": "dhxform_item_label_bottom", 
 "absolute": "dhxform_item_absolute"
 }
 this.align_css = {left: "dhxform_label_align_left",
 center: "dhxform_label_align_center",
 right: "dhxform_label_align_right"
 }
 
 var that = this;this.skin = (typeof(dhtmlx)!="undefined"?dhtmlx.skin||"dhx_skyblue":"dhx_skyblue");this.setSkin = function(skin) {this.skin = skin;this.cont.className = "dhxform_obj_"+this.skin;this.cont.style.fontSize = "13px";this._updateBlocks();this.forEachItem(function(id){if(that.getItemType(id)=="calendar"){that.doWithItem(id,"setSkin",skin);}});}
 
 this.separator = ",";this.live_validate = false;this._type = "checkbox";this._rGroup = "default";this._idIndex = {};this._indexId = [];this.cont = (typeof(parentObj)=="object"?parentObj:document.getElementById(parentObj));if (!parentObj._isNestedForm){this._parentForm = true;this.cont.style.fontSize = "13px";this.cont.className = "dhxform_obj_"+this.skin;this.setFontSize = function(fs) {this.cont.style.fontSize = fs;this._updateBlocks();}
 
 this.getForm = function() {return this;}
 
 this.cont.onkeypress = function(e) {e = (e||event);if (e.keyCode == 13){var t = (e.target||e.srcElement);if (typeof(t.tagName)!= "undefined" && String(t.tagName).toLowerCase() == "textarea" && !e.ctrlKey) return;that.callEvent("onEnter",[]);}
 }
 
 }
 
 this.b_index = null;this.base = [];this._prepare = function(ofsLeft) {if (this.b_index == null)this.b_index = 0;else this.b_index++;this.base[this.b_index] = document.createElement("DIV");this.base[this.b_index].className = "dhxform_base";if (typeof(ofsLeft)!= "undefined") this.base[this.b_index].style.cssText += " margin-left:"+ofsLeft+"px!important;";this.cont.appendChild(this.base[this.b_index]);}
 
 
 this.setSizes = function() {}
 
 this._mergeSettings = function(data) {var u = -1;var i = {type: "settings"};for (var a in this.i)i[a] = this.i[a];for (var q=0;q<data.length;q++){if (data[q].type == "settings"){for (var a in data[q])i[a] = data[q][a];u = q;}
 }
 data[u>=0?u:data.length] = i;return data;}
 
 this._genStr = function(w) {var s = "";var z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";for (var q=0;q<w;q++)s += z.charAt(Math.round(Math.random() * (z.length-1)));return s;}
 
 this.idPrefix = "dhxForm_"+this._genStr(12)+"_";this._rId = (this._parentForm?this._genStr(12)+"_":parentObj._rId);this.objPull = {};this.itemPull = {};this._ic = 0;this._addItem = function(type, id, data, sId, lp) {if (this.items[type]._index){this.getForm()._indexId.push(id);this.getForm()._idIndex[id] = {ind: this.getForm()._indexId.length-1};this.getForm()._idIndex[id] = {ind: this.getForm()._indexId.length-1};}
 
 if (!type)type = this._type;if (type == "list" && ({"fieldset":true,"block":true})[this.getItemType(lp)] == true) {var tr = this.itemPull[this.idPrefix+lp]._addSubListNode();}else {if (type == "newcolumn"){var tr = {};}else {var tr = document.createElement("DIV");this.base[this.b_index].appendChild(tr);}
 }
 
 tr._idd = id;tr._rId = this._rId;if (typeof(tr.style)!= "undefined") {if (typeof(data.offsetLeft)== "undefined" && this.i.offsetLeft > 0) data.offsetLeft = this.i.offsetLeft;if (typeof(data.offsetTop)== "undefined" && this.i.offsetTop > 0) data.offsetTop = this.i.offsetTop;if (typeof(data.offsetLeft)!= "undefined") tr.style.cssText += " padding-left:"+data.offsetLeft+"px!important;";if (typeof(data.offsetTop)!= "undefined") tr.style.cssText += " padding-top:"+data.offsetTop+"px!important;";}
 
 if (type == "list"){if (sId != null)tr._sId = sId;var listData = this.items[type].render(tr);if (!this.itemPull[this.idPrefix+id]._listObj)this.itemPull[this.idPrefix+id]._listObj = [];if (!this.itemPull[this.idPrefix+id]._list)this.itemPull[this.idPrefix+id]._list = [];if (!this.itemPull[this.idPrefix+id]._listBase)this.itemPull[this.idPrefix+id]._listBase = [];(this.itemPull[this.idPrefix+id]._listObj).push(listData[0]);(this.itemPull[this.idPrefix+id]._list).push(listData[1]);(this.itemPull[this.idPrefix+id]._listBase).push(tr);listData[1].checkEvent = function(evName) {return that.checkEvent(evName);}
 listData[1].callEvent = function(evName, evData) {return that.callEvent(evName, evData);}
 listData[1].getForm = function() {return that.getForm();}
 listData[1]._initObj(this._mergeSettings(data));if (tr._inBlcok)tr.className += " in_block";return listData[1];}
 
 if (type == "newcolumn"){this._prepare(data.offset);return;}
 
 if (({input:true,fieldset:true,block:true,password:true,calendar:true,colorpicker:true})[type] !== true) tr.onselectstart = function(e){e=e||event;e.returnValue=false;return false;}
 
 if (type == "label" && this._ic++ == 0)data._isTopmost = true;if (type == "select" && this.skin == "dhx_terrace")tr._inpWidthFix=6;data.position = this.apos_css[(!data.position||!this.apos_css[data.position]?this.i.position:data.position)];tr.className = data.position+(typeof(data.className)=="string"?" "+data.className:"");if (!data.labelWidth)data.labelWidth = this.i.labelWidth;if (!data.labelHeight)data.labelHeight = this.i.labelHeight;if (typeof(data.wrap)!= "undefined") data.wrap = this._s2b(data.wrap);data.labelAlign = (this.align_css[data.labelAlign]?this.align_css[data.labelAlign]:this.align_css[this.i.labelAlign]);data.inputWidth = (data.width?data.width:(data.inputWidth?data.inputWidth:this.i.inputWidth));if (!data.inputHeight)data.inputHeight = this.i.inputHeight;if (typeof(data.note)!= "undefined") {if (data.note.length != null && data.note[0] != null)data.note = data.note[0];if (typeof(data.note.width)== "undefined") data.note.width = this.i.noteWidth;if (data.note.width == "auto")data.note.width = data.inputWidth;}
 
 tr.checkEvent = function(evName) {return that.checkEvent(evName);}
 tr.callEvent = function(evName, evData) {return that.callEvent(evName, evData);}
 tr.getForm = function() {return that.getForm();}
 tr._autoCheck = function(t) {that._autoCheck(t);}
 
 
 if (typeof(data.readonly)== "string") data.readonly = this._s2b(data.readonly);if (typeof(data.autoStart)== "string") data.autoStart = this._s2b(data.autoStart);if (typeof(data.autoRemove)== "string") data.autoRemove = this._s2b(data.autoRemove);if (typeof(data.titleScreen)== "string") data.titleScreen = this._s2b(data.titleScreen);if (typeof(data.info)== "string") data.info = this._s2b(data.info);if (typeof(data.userdata)!= "undefined") {for (var a in data.userdata)this.getForm().setUserData(id,a,data.userdata[a]);}
 
 
 if (data.validate){if (typeof(data.validate != "undefined")&& (typeof(data.validate) == "function" || typeof(window[data.validate]) == "function")) {tr._validate = [data.validate];}else {tr._validate = String(data.validate).split(this.separator);}
 }
 if (typeof(data.required)!= "undefined") {if (typeof(data.required)== "string") data.required = this._s2b(data.required);tr._required = (data.required==true);}
 if (tr._required){if (!tr._validate)tr._validate = [];var p = false;for (q=0;q<tr._validate.length;q++)p = (p||(tr._validate[q]=="NotEmpty"));if (!p)tr._validate.push("NotEmpty");}
 
 tr._ll = (data.position == this.apos_css["label-left"] || data.position == this.apos_css["label-top"]);this.objPull[this.idPrefix+id] = this.items[type].render(tr, data);this.itemPull[this.idPrefix+id] = tr;}
 
 
 
 this._initObj = function(data) {this._prepare();for (var q=0;q<data.length;q++){if (data[q].type == "settings")for (var a in data[q])this.i[a] = data[q][a];}
 
 for (var q=0;q<data.length;q++){var type = (data[q].type||"");if (this.items[type]){if (!data[q].name)data[q].name = this._genStr(12);var id = data[q].name;if (this.objPull[this.idPrefix+id] != null || type=="radio")id = this._genStr(12);var obj = data[q];obj.label = obj.label||"";obj.value = obj.value;obj.checked = !!obj.checked;obj.disabled = !!obj.disabled;obj.name = obj.name||this._genStr(12);obj.options = obj.options||[];obj.rows = obj.rows||"none";obj.uid = this._genStr(12);this._addItem(type, id, obj);if (this._parentEnabled === false)this._disableItem(id);for (var w=0;w<obj.options.length;w++){if (obj.options[w].list != null){if (!obj.options[w].value)obj.options[w].value = this._genStr();var subList = this._addItem("list", id, obj.options[w].list, obj.options[w].value);subList._subSelect = true;subList._subSelectId = obj.options[w].value;}
 }
 
 
 if (data[q].list != null){if (!data[q].listParent)data[q].listParent = obj.name;var subList = this._addItem("list", id, data[q].list, null, data[q].listParent);}
 }
 }
 this._autoCheck();}
 
 
 
 this._s2b = function(r) {if (r == "true" || r == "1" || r == "yes" || r == true)return true;return false;}
 
 this._xmlSubItems = {item: "list", option: "options", note: "note", userdata: "_userdata"};this._xmlToObject = function(xmlData, rootLevel) {var data = (rootLevel?[]:{});for (var q=0;q<xmlData.childNodes.length;q++){if (typeof(xmlData.childNodes[q].tagName)!= "undefined") {var tg = xmlData.childNodes[q].tagName;if (this._xmlSubItems[tg] != null){var node = this._xmlSubItems[tg];if (typeof(data[node])== "undefined") data[node] = [];var k = {};for (var w=0;w<xmlData.childNodes[q].attributes.length;w++){var attrName = xmlData.childNodes[q].attributes[w].name;var attrValue = xmlData.childNodes[q].attributes[w].value;k[attrName] = attrValue;}
 
 
 if (node == "note")k.text = xmlData.childNodes[q].firstChild.nodeValue;if (node == "_userdata")k.value = xmlData.childNodes[q].firstChild.nodeValue;var data2 = this._xmlToObject(xmlData.childNodes[q]);for (var a in data2){if (a == "_userdata"){if (!k.userdata)k.userdata = {};for (var w=0;w<data2[a].length;w++)k.userdata[data2[a][w].name] = data2[a][w].value;}else {k[a] = data2[a];}
 }
 
 if (rootLevel)data.push(k);else data[node].push(k);}
 
 }
 
 
 }
 
 return data;}
 
 this._xmlParser = function() {if (that._loadType == "json"){eval("var formJSONData="+this.xmlDoc.responseText);if (typeof(formJSONData)== "object" && formJSONData != null) that._initObj(formJSONData);}else {var t = that._xmlToObject(this.getXMLTopNode("items"), true);that._initObj(t);}
 if (that.cont && that.cont.cmp && that.cont.cmp == "form")that.setSizes();that.callEvent("onXLE",[]);if (typeof(that._doOnLoad)== "function") that._doOnLoad();}
 
 this._doOnLoad = null;this._xmlLoader = new dtmlXMLLoaderObject(this._xmlParser, window);this.loadStruct = function(a,b,c) {this._loadType = "xml";if (typeof(b)== "string") {if (b.toLowerCase()== "json") {this._loadType = "json";if (typeof(a)!= "string") {this._initObj(a);return;}
 }
 this._doOnLoad = (c||null);}else {this._doOnLoad = (b||null);}
 this.callEvent("onXLS", []);this._xmlLoader.loadXML(a);}
 this.loadStructString = function(xmlString, onLoadFunction) {this._doOnLoad = (onLoadFunction||null);this._xmlLoader.loadXMLString(xmlString);}
 
 
 
 this._autoCheck = function(enabled) {if (this._locked === true){enabled = false;}else {if (typeof(enabled)== "undefined") enabled = true;}
 for (var a in this.itemPull){var isEnabled = (enabled&&(this.itemPull[a]._udis!==true));this[isEnabled?"_enableItem":"_disableItem"](this.itemPull[a]._idd);if (this.getForm()._idIndex[this.itemPull[a]._idd] != null) {this.getForm()._idIndex[this.itemPull[a]._idd].enabled = isEnabled;}
 
 
 var pEnabled = (isEnabled&&(typeof(this.itemPull[a]._checked)=="boolean"?this.itemPull[a]._checked:true));if (this.itemPull[a]._list){for (var q=0;q<this.itemPull[a]._list.length;q++){var f = true;if (this.itemPull[a]._list[q]._subSelect == true){f = false
 var v = this.getItemValue(this.itemPull[a]._idd);if (!(typeof(v)== "object" && typeof(v.length) == "number")) v = [v];for (var w=0;w<v.length;w++)f = (v[w]==this.itemPull[a]._list[q]._subSelectId)||f;this.itemPull[a]._listObj[q][f?"show":"hide"](this.itemPull[a]._listBase[q]);}
 this.itemPull[a]._list[q]._autoCheck(pEnabled&&f);}
 }
 }
 }
 
 
 
 this.doWithItem = function(id, method, a, b, c, d) {if (typeof(id)== "object") {var group = id[0];var value = id[1];var item = null;var res = null;for (var k in this.itemPull){if ((this.itemPull[k]._value == value || value === null)&& this.itemPull[k]._group == group) return this.objPull[k][method](this.itemPull[k], a, b, c, d);if (this.itemPull[k]._list != null && !res){for (var q=0;q<this.itemPull[k]._list.length;q++){res = this.itemPull[k]._list[q].doWithItem(id, method, a, b, c);}
 }
 }
 if (res != null){return res;}else {if (method == "getType")return this.doWithItem(id[0], "getType");}
 
 }else {if (!this.itemPull[this.idPrefix+id]){var res = null;for (var k in this.itemPull){if (this.itemPull[k]._list && !res){for (var q=0;q<this.itemPull[k]._list.length;q++){if (res == null)res = this.itemPull[k]._list[q].doWithItem(id, method, a, b, c, d);}
 }
 }
 return res;}else {return this.objPull[this.idPrefix+id][method](this.itemPull[this.idPrefix+id], a, b, c, d);}
 }
 }
 
 this.removeItem = function(id, value) {if (value != null)id = this.doWithItem([id, value], "destruct");else this.doWithItem(id, "destruct");this._clearItemData(id);}
 
 this._clearItemData = function(id) {if (this.itemPull[this.idPrefix+id]){id = this.idPrefix+id;try {this.objPull[id] = null;this.itemPull[id] = null;delete this.objPull[id];delete this.itemPull[id];}catch(e) {}
 }else {for (var k in this.itemPull){if (this.itemPull[k]._list){for (var q=0;q<this.itemPull[k]._list.length;q++)this.itemPull[k]._list[q]._clearItemData(id);}
 }
 }
 }
 
 this.isItem = function(id, value) {if (value != null)id = [id, value];return this.doWithItem(id, "isExist");}
 
 this.getItemType = function(id, value) {id = [id, (value||null)];return this.doWithItem(id, "getType");}
 
 this.getItemsList = function() {var list = [];var exist = [];for (var a in this.itemPull){var id = null;if (this.itemPull[a]._group){id = this.itemPull[a]._group;}else {id = a.replace(this.idPrefix, "");}
 if (exist[id] != true)list.push(id);exist[id] = true;}
 return list;}
 
 
 this.forEachItem = function(handler) {for (var a in this.objPull){handler(String(a).replace(this.idPrefix,""));if (this.itemPull[a]._list){for (var q=0;q<this.itemPull[a]._list.length;q++)this.itemPull[a]._list[q].forEachItem(handler);}
 }
 }
 
 
 this.setItemLabel = function(id, value, text) {if (text != null)id = [id, value];else text = value;this.doWithItem(id, "setText", text);}
 
 this.getItemLabel = function(id, value) {if (value != null)id = [id, value];return this.doWithItem(id, "getText");}
 
 this.setItemText = this.setItemLabel;this.getItemText = this.getItemLabel;this._enableItem = function(id) {this.doWithItem(id, "enable");}
 
 this._disableItem = function(id) {this.doWithItem(id, "disable");}
 
 this._isItemEnabled = function(id) {return this.doWithItem(id, "isEnabled");}
 
 
 this.checkItem = function(id, value) {if (value != null)id = [id, value];this.doWithItem(id, "check");this._autoCheck();}
 
 this.uncheckItem = function(id, value) {if (value != null)id = [id, value];this.doWithItem(id, "unCheck");this._autoCheck();}
 
 this.isItemChecked = function(id, value) {if (value != null)id = [id, value];return this.doWithItem(id, "isChecked");}
 
 this.getCheckedValue = function(id) {return this.doWithItem([id, null], "getChecked");}
 
 
 
 
 this._getRGroup = function(id, val) {for (var a in this.itemPull){if (this.itemPull[a]._group == id && (val == null || this.itemPull[a]._value == val)) return this.itemPull[a]._idd;if (this.itemPull[a]._list != null){for (var q=0;q<this.itemPull[a]._list.length;q++){var r = this.itemPull[a]._list[q]._getRGroup(id, val);if (r != null)return r;}
 }
 }
 return null;}
 
 this.setItemValue = function(id, value) {if (this.getItemType(id)== "radio") {if (this._getRGroup(id, value)!= null) this.checkItem(id, value);else this.uncheckItem(id, this.getCheckedValue(id));return null;}
 return this.doWithItem(id, "setValue", value);}
 
 this.getItemValue = function(id, param) {this._updateValues();if (this.getItemType(id)== "radio") return this.getCheckedValue(id);return this.doWithItem(id, "getValue", param);}
 
 this.updateValues = function() {this._updateValues();}
 
 
 this.showItem = function(id, value) {if (value != null)id = [id,value];this.doWithItem(id, "show");}
 
 this.hideItem = function(id, value) {if (value != null)id = [id,value];this.doWithItem(id, "hide");}
 
 this.isItemHidden = function(id, value) {if (value != null)id = [id,value];return this.doWithItem(id, "isHidden");}
 
 
 this.getOptions = function(id) {return this.doWithItem(id, "getOptions");}
 
 
 this.setItemWidth = function(id, width) {this.doWithItem(id, "setWidth", width);}
 
 this.getItemWidth = function(id) {return this.doWithItem(id, "getWidth");}
 
 this.setItemHeight = function(id, height) {this.doWithItem(id, "setHeight", height);}
 
 this.setItemFocus = function(id) {this.doWithItem(id, "setFocus");}
 
 
 
 
 
 this._updateValues = function() {for (var a in this.itemPull){if (this.objPull[a] && typeof(this.objPull[a].updateValue)== "function") {this.objPull[a].updateValue(this.itemPull[a]);}
 if (this.itemPull[a]._list){for (var q=0;q<this.itemPull[a]._list.length;q++){this.itemPull[a]._list[q]._updateValues();}
 }
 }
 }
 
 
 this._getItemByName = function(id) {for (var a in this.itemPull){if (this.itemPull[a]._idd == id)return this.itemPull[a];if (this.itemPull[a]._list != null){for (var q=0;q<this.itemPull[a]._list.length;q++){var r = this.itemPull[a]._list[q]._getItemByName(id);if (r != null)return r;}
 }
 }
 return null;}
 this._resetValidateCss = function(item) {item.className = (item.className).replace(item._vcss,"");item._vcss = null;}
 this.setValidateCss = function(name, state, custom) {var item = this[this.getItemType(name)=="radio"?"_getRGroup":"_getItemByName"](name);if (!item)return;if (item._vcss != null)this._resetValidateCss(item);item._vcss = (typeof(custom)=="string"?custom:"validate_"+(state===true?"ok":"error"));item.className += " "+item._vcss;}
 this.resetValidateCss = function(name) {for (var a in this.itemPull){if (this.itemPull[a]._vcss != null)this._resetValidateCss(this.itemPull[a]);if (this.itemPull[a]._list != null){for (var q=0;q<this.itemPull[a]._list.length;q++)this.itemPull[a]._list[q].resetValidateCss();}
 }
 }
 
 this.validate = function(type) {this._updateValues();if (this.callEvent("onBeforeValidate",[])== false) return;var completed = true;this.forEachItem(function(name){completed = that.doWithItem(name,"_validate") && completed;});this.callEvent("onAfterValidate",[completed]);return completed;}
 
 this.validateItem = function(name) {return this.doWithItem(name,"_validate");}
 
 this.enableLiveValidation = function(state) {this.live_validate = (state==true);}
 
 
 
 
 this.setReadonly = function(id, state) {this.doWithItem(id, "setReadonly", state);}
 
 this.isReadonly = function(id) {return this.doWithItem(id, "isReadonly");}
 
 
 
 this.getFirstActive = function(withFocus) {for (var q=0;q<this._indexId.length;q++){var k = true;if (withFocus == true){var t = this.getItemType(this._indexId[q]);if (!dhtmlXForm.prototype.items[t].setFocus)k = false;}
 if (k && this._idIndex[this._indexId[q]].enabled)return this._indexId[q];}
 return null;}
 
 this.setFocusOnFirstActive = function() {var k = this.getFirstActive(true);if (k != null)this.setItemFocus(k);}
 
 
 
 this.enableItem = function(id, value) {if (value != null)id = [id,value];this.doWithItem(id, "userEnable");this._autoCheck();}
 
 this.disableItem = function(id, value) {if (value != null)id = [id,value];this.doWithItem(id, "userDisable");this._autoCheck();}
 
 this.isItemEnabled = function(id, value) {if (value != null)id = [id,value];return this.doWithItem(id, "isUserEnabled");}
 
 this.clear = function() {var usedRAs = {};this.formId = (new Date()).valueOf();this.resetDataProcessor("inserted");for (var a in this.itemPull){var t = this.itemPull[a]._idd;if (this.itemPull[a]._type == "ch")this.uncheckItem(t);if (this.itemPull[a]._type in {"ta":1,"editor":1,"calendar":1,"pw":1,"hd":1})this.setItemValue(t, "");if (this.itemPull[a]._type == "combo")(this.getCombo(t)).selectOption(0);if (this.itemPull[a]._type == "se"){var opts = this.getOptions(t);if (opts.length > 0)opts[0].selected = true;}
 
 if (this.itemPull[a]._type == "ra"){var g = this.itemPull[a]._group;if (!usedRAs[g]){this.checkItem(g, this.doWithItem(t, "_getFirstValue"));usedRAs[g] = true;}
 }
 
 if (this.itemPull[a]._list)for (var q=0;q<this.itemPull[a]._list.length;q++)this.itemPull[a]._list[q].clear();}
 usedRAs = null;if (this._parentForm)this._autoCheck();this.resetValidateCss();}
 
 this.unload = function() {for (var a in this.objPull)this.removeItem(String(a).replace(this.idPrefix,""));this.detachAllEvents();if (this._ccTm)window.clearTimeout(this._ccTm);if (window.dhtmlXFormLs[this._rId]){for (var q=0;q<window.dhtmlXFormLs[this._rId].inps.lenght;q++)window.dhtmlXFormLs[this._rId].inps[q] = null;for (var a in window.dhtmlXFormLs[this._rId].vals)window.dhtmlXFormLs[this._rId].vals[a] = null;for (var a in window.dhtmlXFormLs[this._rId])window.dhtmlXFormLs[this._rId][a] = null;window.dhtmlXFormLs[this._rId] = null;try {delete window.dhtmlXFormLs[this._rId];}catch(e){}
 }
 
 this._xmlLoader.destructor();this._xmlLoader = null;this._xmlParser = null;this._xmlToObject = null;this.loadXML = null;this.loadXMLString = null;this.items = null;this.objPull = null;this.itemPull = null;this._addItem = null;this._genStr = null;this._initObj = null;this._autoCheck = null;this._clearItemData = null;this._enableItem = null;this._disableItem = null;this._isItemEnabled = null;this.forEachItem = null;this.isItem = null;this.clear = null;this.doWithItem = null;this.getItemType = null;this.removeItem = null;this.unload = null;this.getForm = null;this.attachEvent = null;this.callEvent = null;this.checkEvent = null;this.detachEvent = null;this.eventCatcher = null;this.setItemPosition = null;this.getItemPosition = null;this._setPosition = null;this._getPosition = null;this.setItemLabel = null;this.getItemLabel = null
 this.setItemText = null;this.getItemText = null;this.setItemValue = null;this.getItemValue = null;this.showItem = null;this.hideItem = null;this.isItemHidden = null;this.checkItem = null;this.uncheckItem = null;this.isItemChecked = null;this.getOptions = null;this._ic = null;this._ulToObject = null;this.loadStruct = null;this.loadStructString = null;this.remove = null;this.setFontSize = null;this.setItemHeight = null;this.setItemWidth = null;this.setSkin = null;this._rGroup = null;this._type = null;this._parentEnabled = null;this._parentForm = null;this._doLock = null;this._mergeSettings = null;this._locked = null;this._prepare = null;this.detachAllEvents = null;this.getCheckedValue = null;this.getItemWidth = null;this.setUserData = null;this.getUserData = null;this.setRTL = null;this.setSizes = null;this.getCalendar = null;this.getColorPicker = null;this.getCombo = null;this.getEditor = null;this.setFormData = null;this.getFormData = null;this.getItemsList = null;this.lock = null;this.unlock = null;this.isLocked = null;this.setReadonly = null;this.isReadonly = null;this.apos_css = null;this.align_css = null;this.b_index = null;this.i = null;this.skin = null;this.idPrefix = null;this._subSelect = null;this._subSelectId = null;for (var q=0;q<this.base.length;q++){while (this.base[q].childNodes.length > 0)this.base[q].removeChild(this.base[q].childNodes[0]);if (this.base[q].parentNode)this.base[q].parentNode.removeChild(this.base[q]);this.base[q] = null;}
 this.base = null;this.cont.onkeypress = null;this.cont.className = "";this.cont = null;}
 
 for (var a in this.items){this.items[a].t = a;if (typeof(this.items[a]._index)== "undefined") {this.items[a]._index = true;}
 
 if (!this.items[a].show){this.items[a].show = function(item) {item.style.display = "";if (item._listObj)for (var q=0;q<item._listObj.length;q++)item._listObj[q].show(item._listBase[q]);}
 }
 
 if (!this.items[a].hide){this.items[a].hide = function(item) {item.style.display = "none";if (item._listObj)for (var q=0;q<item._listObj.length;q++)item._listObj[q].hide(item._listBase[q]);}
 }
 
 if (!this.items[a].isHidden){this.items[a].isHidden = function(item) {return (item.style.display == "none");}
 }
 
 if (!this.items[a].userEnable){this.items[a].userEnable = function(item) {item._udis = false;}
 }
 
 if (!this.items[a].userDisable){this.items[a].userDisable = function(item) {item._udis = true;}
 }
 
 if (!this.items[a].isUserEnabled){this.items[a].isUserEnabled = function(item) {return (item._udis!==true);}
 }
 
 if (!this.items[a].getType){this.items[a].getType = function() {return this.t;}
 }
 
 if (!this.items[a].isExist){this.items[a].isExist = function() {return true;}
 }
 
 if (!this.items[a].validate){this.items[a]._validate = function(item) {if (!item._validate || !item._enabled)return true;if (item._type == "ch"){var val = (this.isChecked(item)?this.getValue(item):0);}else {var val = this.getValue(item);}
 
 var r = true;for (var q=0;q<item._validate.length;q++){var v = "is"+item._validate[q];if (val.length == 0 && v != "isNotEmpty"){}else {var f = dhtmlxValidation[v];if (typeof(f)!= "function" && typeof(item._validate[q]) == "function") f = item._validate[q];if (typeof(f)!= "function" && typeof(window[item._validate[q]]) == "function") f = window[item._validate[q]];r = ((typeof(f)=="function"?f(val):new RegExp(item._validate[q]).test(val)) && r);f = null;}
 }
 
 if (!(item.callEvent("onValidate"+(r?"Success":"Error"),[item._idd,val,r])===false)) item.getForm().setValidateCss(item._idd, r);return r;}
 }
 
 
 }
 
 
 this._locked = false;this._doLock = function(state) {var t = (state===true?true:false);if (this._locked == t)return;else this._locked = t;this._autoCheck(!this._locked);}
 this.lock = function() {this._doLock(true);}
 this.unlock = function() {this._doLock(false);}
 this.isLocked = function() {return this._locked;}
 
 
 this.setNumberFormat = function(id, format, g_sep, d_sep) {return this.doWithItem(id, "setNumberFormat", format, g_sep, d_sep);}
 
 
 dhtmlxEventable(this);this.attachEvent("_onButtonClick", function(name, cmd){this.callEvent("onButtonClick", [name, cmd]);});this._updateBlocks = function() {this.forEachItem(function(id){if (that.getItemType(id)== "block" || that.getItemType(id) == "combo") {that.doWithItem(id,"_setCss",that.skin,that.cont.style.fontSize);}
 });}
 
 if (!window.dhtmlXFormLs[this._rId]){window.dhtmlXFormLs[this._rId] = {form: this,
 inps: [],
 vals: {}
 };}
 
 
 this._isObj = function(k) {return (k != null && typeof(k) == "object" && typeof(k.length) == "undefined");}
 this._copyObj = function(r) {if (this._isObj(r)) {var t = {};for (var a in r){if (typeof(r[a])== "object" && r[a] != null) t[a] = this._copyObj(r[a]);else t[a] = r[a];}
 }else {var t = [];for (var a=0;a<r.length;a++){if (typeof(r[a])== "object" && r[a] != null) t[a] = this._copyObj(r[a]);else t[a] = r[a];}
 }
 return t;}
 
 
 if (data != null && typeof(data)== "object") {this._initObj(this._copyObj(data));};if (this._parentForm){this._updateBlocks();}
 
 this._ccTm = null;this._ccDo = function() {for (var a in window.dhtmlXFormLs){for (var q=0;q<window.dhtmlXFormLs[a].inps.length;q++){var idd = window.dhtmlXFormLs[a].inps[q]._idd;if (String(window.dhtmlXFormLs[a].inps[q].tagName).toLowerCase() == "select") {var v = "";if (window.dhtmlXFormLs[a].inps[q].selectedIndex >= 0 && window.dhtmlXFormLs[a].inps[q].selectedIndex < window.dhtmlXFormLs[a].inps[q].options.length){v = window.dhtmlXFormLs[a].inps[q].options[window.dhtmlXFormLs[a].inps[q].selectedIndex].value;}
 }else {var v = window.dhtmlXFormLs[a].inps[q].value;}
 if (v != window.dhtmlXFormLs[a].vals[idd]){window.dhtmlXFormLs[a].vals[idd] = v;window.dhtmlXFormLs[a].form.callEvent("onInputChange",[idd,v,this]);}
 }
 }
 if (this._ccTm)window.clearTimeout(this._ccTm);this._ccTm = window.setTimeout(function(){that._ccDo();},70);}
 
 this._ccDo();return this;};dhtmlXForm.prototype.getInput = function(id) {return this.doWithItem(id, "getInput");};dhtmlXForm.prototype.getSelect = function(id) {return this.doWithItem(id, "getSelect");};dhtmlXForm.prototype.items = {};dhtmlXForm.prototype.items.checkbox = {render: function(item, data) {item._type = "ch";item._enabled = true;item._checked = false;item._value = String(data.value);item._ro = (data.readonly==true);if (data._autoInputWidth !== false)data.inputWidth = 14;this.doAddLabel(item, data);this.doAddInput(item, data, "INPUT", "TEXT", true, true, "dhxform_textarea");item.childNodes[item._ll?1:0].className += " dhxform_img_node";var p = document.createElement("DIV");p.className = "dhxform_img chbx0";item.appendChild(p);if (!isNaN(data.inputLeft)) item.childNodes[item._ll?1:0].style.left = parseInt(data.inputLeft)+"px";if (!isNaN(data.inputTop)) item.childNodes[item._ll?1:0].style.top = parseInt(data.inputTop)+"px";item.childNodes[item._ll?1:0].appendChild(p);item.childNodes[item._ll?1:0].firstChild.value = String(data.value);item._updateImgNode = function(item, state) {if (item.getForm().skin != "dhx_terrace") return;var t = item.childNodes[item._ll?1:0].lastChild;if (state){t.className = t.className.replace(/dhxform_img/gi,"dhxform_actv_c");}else {t.className = t.className.replace(/dhxform_actv_c/gi,"dhxform_img");}
 t = null;}
 
 if (data.checked == true)this.check(item);if (data.hidden == true)this.hide(item);if (data.disabled == true)this.userDisable(item);this.doAttachEvents(item);return this;},
 
 destruct: function(item) {this.doUnloadNestedLists(item);this.doDestruct(item);},
 
 doAddLabel: function(item, data) {var t = document.createElement("DIV");t.className = "dhxform_label "+data.labelAlign;if (data.wrap == true)t.style.whiteSpace = "normal";if (item._ll){item.insertBefore(t,item.firstChild);}else {item.appendChild(t);}
 
 if (typeof(data.tooltip)!= "undefined") t.title = data.tooltip;t.innerHTML = "<div class='dhxform_label_nav_link' "+
 "onfocus='if(this.parentNode.parentNode._updateImgNode)this.parentNode.parentNode._updateImgNode(this.parentNode.parentNode,true);' "+
 "onblur='if(this.parentNode.parentNode._updateImgNode)this.parentNode.parentNode._updateImgNode(this.parentNode.parentNode,false);' "+
 "onkeypress='e=event||window.arguments[0];if(e.keyCode==32||e.charCode==32){e.cancelBubble=true;e.returnValue=false;_dhxForm_doClick(this,\"mousedown\");return false;}' "+
 (_dhxForm_isIPad?"ontouchstart='e=event;e.preventDefault();_dhxForm_doClick(this,\"mousedown\");' ":"")+
 "role='link' tabindex='0'>"+data.label+(data.info?"<span class='dhxform_info'>[?]</span>":"")+(item._required?"<span class='dhxform_item_required'>*</span>":"")+'</div>';if (!isNaN(data.labelWidth)) t.firstChild.style.width = parseInt(data.labelWidth)+"px";if (!isNaN(data.labelHeight)) t.firstChild.style.height = parseInt(data.labelHeight)+"px";if (!isNaN(data.labelLeft)) t.style.left = parseInt(data.labelLeft)+"px";if (!isNaN(data.labelTop)) t.style.top = parseInt(data.labelTop)+"px";},
 
 doAddInput: function(item, data, el, type, pos, dim, css) {var p = document.createElement("DIV");p.className = "dhxform_control";if (item._ll){item.appendChild(p);}else {item.insertBefore(p,item.firstChild);}
 
 var t = document.createElement(el);t.className = css;t.name = item._idd;t._idd = item._idd;t.id = data.uid;if (typeof(type)== "string") t.type = type;if (el == "INPUT" || el == "TEXTAREA"){t.onkeyup = function(e) {e = e||event;item.callEvent("onKeyUp",[this,e]);};}
 if (el == "INPUT" || el == "TEXTAREA" || el == "SELECT"){var id2 = item.getForm()._rId;if (window.dhtmlXFormLs && window.dhtmlXFormLs[id2]){window.dhtmlXFormLs[id2].inps.push(t);window.dhtmlXFormLs[id2].vals[t._idd] = "";}
 }
 
 p.appendChild(t);if (data.readonly)this.setReadonly(item, true);if (data.hidden == true)this.hide(item);if (data.disabled == true)this.userDisable(item);if (pos){if (!isNaN(data.inputLeft)) p.style.left = parseInt(data.inputLeft)+"px";if (!isNaN(data.inputTop)) p.style.top = parseInt(data.inputTop)+"px";}
 
 var u = "";if (dim){if (!isNaN(data.inputWidth)) u += "width:"+parseInt(data.inputWidth)+"px;";if (!isNaN(data.inputHeight)) u += "height:"+parseInt(data.inputHeight)+"px;";}
 if (typeof(data.style)== "string") u += data.style;t.style.cssText = u;if (data.maxLength)t.setAttribute("maxLength", data.maxLength);if (data.connector)t.setAttribute("connector",data.connector);if (typeof(data.note)== "object") {var note = document.createElement("DIV");note.className = "dhxform_note";note.style.width = (isNaN(data.note.width)?t.offsetWidth:parseInt(data.note.width))+"px";note._w = data.note.width;note.innerHTML = data.note.text;p.appendChild(note);note = null;}
 
 },
 
 doUnloadNestedLists: function(item) {if (!item._list)return;for (var q=0;q<item._list.length;q++){item._list[q].unload();item._list[q] = null;item._listObj[q] = null;item._listBase[q].parentNode.removeChild(item._listBase[q]);item._listBase[q] = null;}
 item._list = null;item._listObj = null;item._listBase = null;},
 
 doDestruct: function(item) {item.callEvent = null;item.checkEvent = null;item.getForm = null;item._autoCheck = null;item._checked = null;item._enabled = null;item._idd = null;item._type = null;item._value = null;item._group = null;item.onselectstart = null;item.childNodes[item._ll?1:0].onmousedown = null;item.childNodes[item._ll?1:0].ontouchstart = null;item.childNodes[item._ll?0:1].onmousedown = null;item.childNodes[item._ll?0:1].ontouchstart = null;item.childNodes[item._ll?0:1].childNodes[0].onkeypress = null;item.childNodes[item._ll?0:1].childNodes[0].ontouchstart = null;item.childNodes[item._ll?0:1].removeChild(item.childNodes[item._ll?0:1].childNodes[0]);while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.parentNode.removeChild(item);item = null;},
 
 doAttachEvents: function(item) {var that = this;item.childNodes[item._ll?1:0][_dhxForm_isIPad?"ontouchstart":"onmousedown"] = function(e) {e = e||event;if (e.preventDefault)e.preventDefault();var t = (e.target||e.srcElement);if (!this.parentNode._enabled || this.parentNode._ro || (typeof(t.className)!= "undefined" && t.className == "dhxform_note")) {e.cancelBubble = true;e.returnValue = false;return false;}
 that.doClick(this.parentNode);}
 
 item.childNodes[item._ll?0:1].childNodes[0][_dhxForm_isIPad?"ontouchstart":"onmousedown"] = function(e) {e = e||event;if (e.preventDefault)e.preventDefault();if (!this.parentNode.parentNode._enabled){e.cancelBubble = true;e.returnValue = false;return false;}
 
 var t = e.target||e.srcElement;if (typeof(t.className)!= "undefined" && t.className == "dhxform_info") {this.parentNode.parentNode.callEvent("onInfo",[this.parentNode.parentNode._idd]);e.cancelBubble = true;e.returnValue = false;return false;}
 that.doClick(this.parentNode.parentNode);}
 },
 
 doClick: function(item) {item.childNodes[item._ll?0:1].childNodes[0].focus();if (!item._enabled || item._ro)return;if (item.checkEvent("onBeforeChange")) if (item.callEvent("onBeforeChange", [item._idd, item._value, item._checked])!== true) return;this.setChecked(item, !item._checked);item._autoCheck();item.callEvent("onChange", [item._idd, item._value, item._checked]);},
 
 doCheckValue: function(item) {if (item._checked && item._enabled){item.childNodes[item._ll?1:0].firstChild.setAttribute("name", String(item._idd));}else {item.childNodes[item._ll?1:0].firstChild.removeAttribute("name");}
 },
 
 setChecked: function(item, state) {item._checked = (state===true?true:false);item.childNodes[item._ll?1:0].lastChild.className = item.childNodes[item._ll?1:0].lastChild.className.replace(/chbx[0-1]{1}/gi,"")+(item._checked?" chbx1":" chbx0");this.doCheckValue(item);},
 
 check: function(item) {this.setChecked(item, true);},
 
 unCheck: function(item) {this.setChecked(item, false);},
 
 isChecked: function(item) {return item._checked;},
 
 enable: function(item) {if (String(item.className).search("disabled") >= 0) item.className = String(item.className).replace(/disabled/gi,"");item._enabled = true;item.childNodes[item._ll?0:1].childNodes[0].tabIndex = 0;item.childNodes[item._ll?0:1].childNodes[0].removeAttribute("disabled");this.doCheckValue(item);},
 
 disable: function(item) {if (String(item.className).search("disabled") < 0) item.className += " disabled";item._enabled = false;item.childNodes[item._ll?0:1].childNodes[0].tabIndex = -1;item.childNodes[item._ll?0:1].childNodes[0].setAttribute("disabled", "true");this.doCheckValue(item);},
 
 isEnabled: function(item) {return item._enabled;},
 
 setText: function(item, text) {item.childNodes[item._ll?0:1].childNodes[0].innerHTML = text;},
 
 getText: function(item) {return item.childNodes[item._ll?0:1].childNodes[0].innerHTML;},
 
 setValue: function(item, value) {this.setChecked(item,(value===true||item._value===value));},
 
 getValue: function(item) {return item._value;},
 
 setReadonly: function(item, state) {item._ro = (state===true);},
 
 isReadonly: function(item) {return item._ro;}
 
};dhtmlXForm.prototype.items.radio = {input: {},
 
 r: {},
 
 firstValue: {},
 
 render: function(item, data, uid) {item._type = "ra";item._enabled = true;item._checked = false;item._group = data.name;item._value = data.value;item._uid = uid;item._ro = (data.readonly==true);this.r[item._idd] = item;data.inputWidth = 14;this.doAddLabel(item, data);this.doAddInput(item, data, "INPUT", "TEXT", true, true, "dhxform_textarea");item.childNodes[item._ll?1:0].className += " dhxform_img_node";var p = document.createElement("DIV");p.className = "dhxform_img rdbt0";item.appendChild(p);if (!isNaN(data.inputLeft)) item.childNodes[item._ll?1:0].style.left = parseInt(data.inputLeft)+"px";if (!isNaN(data.inputTop)) item.childNodes[item._ll?1:0].style.top = parseInt(data.inputTop)+"px";item.childNodes[item._ll?1:0].appendChild(p);item.childNodes[item._ll?1:0].firstChild.value = String(data.value);item._updateImgNode = function(item, state) {if (item.getForm().skin != "dhx_terrace") return;var t = item.childNodes[item._ll?1:0].lastChild;if (state){t.className = t.className.replace(/dhxform_img/gi,"dhxform_actv_r");}else {t.className = t.className.replace(/dhxform_actv_r/gi,"dhxform_img");}
 t = null;}
 
 
 if (this.input[data.name] == null){var k = document.createElement("INPUT");k.type = "HIDDEN";k.name = data.name;k.firstValue = item._value;item.appendChild(k);this.input[data.name] = k;}
 
 if (!this.firstValue[data.name])this.firstValue[data.name] = data.value;if (data.checked == true)this.check(item);if (data.hidden == true)this.hide(item);if (data.disabled == true)this.userDisable(item);this.doAttachEvents(item);return this;},
 
 destruct: function(item, value) {if (item.lastChild == this.input[item._group]){var done = false;for (var a in this.r){if (!done && this.r[a]._group == item._group && this.r[a]._idd != item._idd){this.r[a].appendChild(this.input[item._group]);done = true;}
 }
 if (!done){this.input[item._group].parentNode.removeChild(this.input[item._group]);this.input[item._group] = null;this.firstValue[item._group] = null;}
 }
 
 var id = item._idd;this.doUnloadNestedLists(item);this.doDestruct(item);return id;},
 
 doClick: function(item) {item.childNodes[item._ll?0:1].childNodes[0].focus();if (!(item._enabled && !item._checked)) return;if (item._ro)return;var args = [item._group, item._value, true];if (item.checkEvent("onBeforeChange")) if (item.callEvent("onBeforeChange", args)!== true) return;this.setChecked(item, true);item.getForm()._autoCheck();item.callEvent("onChange", args);},
 
 doCheckValue: function(item) {var value = null;for (var a in this.r){if (this.r[a]._checked && this.r[a]._enabled && this.r[a]._group == item._group && this.r[a]._rId == item._rId)value = this.r[a]._value;}
 if (value != null){this.input[item._group].setAttribute("name", String(item._group));this.input[item._group].setAttribute("value", value);this.input[item._group]._value = value;}else {this.input[item._group].removeAttribute("name");this.input[item._group].removeAttribute("value");this.input[item._group]._value = null;}
 },
 
 setChecked: function(item, state) {state = (state===true);for (var a in this.r){if (this.r[a]._group == item._group && this.r[a]._rId == item._rId){var needCheck = false;if (this.r[a]._idd == item._idd){if (this.r[a]._checked != state){this.r[a]._checked = state;needCheck = true;}
 }else {if (this.r[a]._checked){this.r[a]._checked = false;needCheck = true;}
 }
 if (needCheck){var t = this.r[a].childNodes[this.r[a]._ll?1:0].childNodes[1];t.className = t.className.replace(/rdbt[0-1]{1}/gi,"")+(this.r[a]._checked?" rdbt1":" rdbt0");t = null;}
 }
 }
 this.doCheckValue(item);},
 
 getChecked: function(item) {return this.input[item._group]._value;},
 
 _getFirstValue: function(item) {return this.firstValue[item._group];},
 
 _getId: function(item) {return item._idd;},
 
 setValue: function(item, value) {}
};(function(){for (var a in {doAddLabel:1,doAddInput:1,doDestruct:1,doUnloadNestedLists:1,doAttachEvents:1,check:1,unCheck:1,isChecked:1,enable:1,disable:1,isEnabled:1,setText:1,getText:1,getValue:1,setReadonly:1,isReadonly:1})dhtmlXForm.prototype.items.radio[a] = dhtmlXForm.prototype.items.checkbox[a];})();dhtmlXForm.prototype.items.select = {render: function(item, data) {item._type = "se";item._enabled = true;item._value = null;item._newValue = null;if ((_isFF||_isIE)&& typeof(data.inputWidth) == "number") data.inputWidth+=(item._inpWidthFix||2);this.doAddLabel(item, data);this.doAddInput(item, data, "SELECT", null, true, true, "dhxform_select");this.doAttachEvents(item);this.doLoadOpts(item, data);if (data.connector){var that = this;item._connector_working = true;dhtmlxAjax.get(data.connector, function(loader) {var opts = loader.doXPath("//item");var opt_data = [];for (var i=0;i<opts.length;i++){opt_data[i] = {label:opts[i].getAttribute("label"), value:opts[i].getAttribute("value"), selected: (opts[i].getAttribute("selected")!=null)};};that.doLoadOpts(item, {options:opt_data}, true);item._connector_working = false;if (item._connector_value != null){that.setValue(item, item._connector_value);item._connector_value = null;}
 });}
 
 return this;},
 
 destruct: function(item) {this.doUnloadNestedLists(item);item.callEvent = null;item.checkEvent = null;item.getForm = null;item._autoCheck = null;item._enabled = null;item._idd = null;item._type = null;item._value = null;item._newValue = null;item.onselectstart = null;item.childNodes[item._ll?1:0].childNodes[0].onclick = null;item.childNodes[item._ll?1:0].childNodes[0].onkeydown = null;item.childNodes[item._ll?1:0].childNodes[0].onchange = null;item.childNodes[item._ll?1:0].childNodes[0].onblur = null;item.childNodes[item._ll?1:0].childNodes[0].onkeyup = null;item.childNodes[item._ll?1:0].removeChild(item.childNodes[item._ll?1:0].childNodes[0]);while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.parentNode.removeChild(item);item = null;},
 
 doAddLabel: function(item, data) {var j = document.createElement("DIV");j.className = "dhxform_label "+data.labelAlign;j.innerHTML = "<label for='"+data.uid+"'>"+
 data.label+
 (data.info?"<span class='dhxform_info'>[?]</span>":"")+
 (item._required?"<span class='dhxform_item_required'>*</span>":"")+
 "</label>";if (data.wrap == true)j.style.whiteSpace = "normal";if (typeof(data.tooltip)!= "undefined") j.title = data.tooltip;item.appendChild(j);if (typeof(data.label)== "undefined" || data.label == null || data.label.length == 0) j.style.display = "none";if (!isNaN(data.labelWidth)) j.style.width = parseInt(data.labelWidth)+"px";if (!isNaN(data.labelHeight)) j.style.height = parseInt(data.labelHeight)+"px";if (!isNaN(data.labelLeft)) j.style.left = parseInt(data.labelLeft)+"px";if (!isNaN(data.labelTop)) j.style.top = parseInt(data.labelTop)+"px";if (data.info){j.onclick = function(e) {e = e||event;var t = e.target||e.srcElement;if (typeof(t.className)!= "undefined" && t.className == "dhxform_info") {this.parentNode.callEvent("onInfo",[this.parentNode._idd]);e.cancelBubble = true;e.returnValue = false;return false;}
 }
 }
 },
 
 doAttachEvents: function(item) {var t = item.childNodes[1].childNodes[0];var that = this;t.onclick = function() {that.doOnChange(this);that.doValidate(this.parentNode.parentNode);}
 t.onkeydown = function() {that.doOnChange(this);that.doValidate(this.parentNode.parentNode);}
 t.onchange = function() {that.doOnChange(this);that.doValidate(this.parentNode.parentNode);}
 },
 
 doValidate: function(item) {if (item.getForm().live_validate) this._validate(item);},
 
 doLoadOpts: function(item, data, callEvent) {var t = item.childNodes[item._ll?1:0].childNodes[0];var opts = data.options;for (var q=0;q<opts.length;q++){var t0 = opts[q].text||opts[q].label;if (!t0 || typeof(t0)== "undefined") t0 = "";var opt = new Option(t0, opts[q].value);if (typeof(opts[q].img_src)== "string") opt.setAttribute("img_src", opts[q].img_src);t.options.add(opt);if (opts[q].selected == true || opts[q].selected == "true"){opt.selected = true;item._value = opts[q].value;}
 }
 if (callEvent === true)item.callEvent("onOptionsLoaded", [item._idd]);this._checkNoteWidth(item);},
 
 doOnChange: function(sel) {var item = sel.parentNode.parentNode;item._newValue = (sel.selectedIndex>=0?sel.options[sel.selectedIndex].value:null);if (item._newValue != item._value){if (item.checkEvent("onBeforeChange")) {if (item.callEvent("onBeforeChange", [item._idd, item._value, item._newValue])!== true) {for (var q=0;q<sel.options.length;q++)if (sel.options[q].value == item._value)sel.options[q].selected = true;return;}
 }
 item._value = item._newValue;item.callEvent("onChange", [item._idd, item._value]);}
 item._autoCheck();},
 
 setText: function(item, text) {if (!text)text = "";item.childNodes[item._ll?0:1].childNodes[0].innerHTML = text;item.childNodes[item._ll?0:1].style.display = (text.length==0||text==null?"none":"");},
 
 getText: function(item) {return item.childNodes[item._ll?0:1].childNodes[0].innerHTML;},
 
 enable: function(item) {if (String(item.className).search("disabled") >= 0) item.className = String(item.className).replace(/disabled/gi,"");item._enabled = true;item.childNodes[item._ll?1:0].childNodes[0].removeAttribute("disabled");},
 
 disable: function(item) {if (String(item.className).search("disabled") < 0) item.className += " disabled";item._enabled = false;item.childNodes[item._ll?1:0].childNodes[0].setAttribute("disabled", true);},
 
 getOptions: function(item) {return item.childNodes[item._ll?1:0].childNodes[0].options;},
 
 setValue: function(item, val) {if (item._connector_working){item._connector_value = val;return;}
 var opts = this.getOptions(item);for (var q=0;q<opts.length;q++){if (opts[q].value == val){opts[q].selected = true;item._value = opts[q].value;}
 }
 window.dhtmlXFormLs[item.getForm()._rId].vals[item._idd] = item._value;},
 
 getValue: function(item) {var k = -1;var opts = this.getOptions(item);for (var q=0;q<opts.length;q++)if (opts[q].selected)k = opts[q].value;return k;},
 
 setWidth: function(item, width) {item.childNodes[item._ll?1:0].childNodes[0].style.width = width+"px";},
 
 getSelect: function(item) {return item.childNodes[item._ll?1:0].childNodes[0];},
 
 setFocus: function(item) {item.childNodes[item._ll?1:0].childNodes[0].focus();},
 
 _checkNoteWidth: function(item) {var t;if (item.childNodes[item._ll?1:0].childNodes[1] != null){t = item.childNodes[item._ll?1:0].childNodes[1];if (t.className != null && t.className.search(/dhxform_note/gi)>= 0 && t._w == "auto") t.style.width = item.childNodes[item._ll?1:0].childNodes[0].offsetWidth+"px";}
 t = null;}
 
};(function(){for (var a in {doAddInput:1,doUnloadNestedLists:1,isEnabled:1})dhtmlXForm.prototype.items.select[a] = dhtmlXForm.prototype.items.checkbox[a];})();dhtmlXForm.prototype.items.multiselect = {doLoadOpts: function(item, data, callEvent) {var t = item.childNodes[item._ll?1:0].childNodes[0];t.multiple = true;if (!isNaN(data.size)) t.size = Number(data.size);item._value = [];item._newValue = [];var opts = data.options;for (var q=0;q<opts.length;q++){var opt = new Option(opts[q].text||opts[q].label, opts[q].value);t.options.add(opt);if (opts[q].selected == true || opts[q].selected == "true"){opt.selected = true;item._value.push(opts[q].value);}
 }
 if (callEvent === true)item.callEvent("onOptionsLoaded", [item._idd]);this._checkNoteWidth(item);},
 
 doAttachEvents: function(item) {var t = item.childNodes[item._ll?1:0].childNodes[0];var that = this;t.onblur = function() {that.doOnChange(this);}
 
 t.onclick = function() {item._autoCheck();}
 
 },
 
 doOnChange: function(sel) {var item = sel.parentNode.parentNode;item._newValue = [];for (var q=0;q<sel.options.length;q++)if (sel.options[q].selected)item._newValue.push(sel.options[q].value);if ((item._value).sort().toString() != (item._newValue).sort().toString()) {if (item.checkEvent("onBeforeChange")) {if (item.callEvent("onBeforeChange", [item._idd, item._value, item._newValue])!== true) {var k = {};for (var q=0;q<item._value.length;q++)k[item._value[q]] = true;for (var q=0;q<sel.options.length;q++)sel.options[q].selected = (k[sel.options[q].value] == true);k = null;return;}
 }
 item._value = [];for (var q=0;q<item._newValue.length;q++)item._value.push(item._newValue[q]);item.callEvent("onChange", [item._idd, item._value]);}
 
 
 item._autoCheck();},
 
 setValue: function(item, val) {var k = {};if (typeof(val)== "string") val = val.split(",");if (typeof(val)!= "object") val = [val];for (var q=0;q<val.length;q++)k[val[q]] = true;var opts = this.getOptions(item);for (var q=0;q<opts.length;q++)opts[q].selected = (k[opts[q].value] == true);item._autoCheck();},
 
 getValue: function(item) {var k = [];var opts = this.getOptions(item);for (var q=0;q<opts.length;q++)if (opts[q].selected)k.push(opts[q].value);return k;}
};(function() {for (var a in dhtmlXForm.prototype.items.select){if (!dhtmlXForm.prototype.items.multiselect[a])dhtmlXForm.prototype.items.multiselect[a] = dhtmlXForm.prototype.items.select[a];}
})();dhtmlXForm.prototype.items.input = {render: function(item, data) {var ta = (!isNaN(data.rows));item._type = "ta";item._enabled = true;this.doAddLabel(item, data);this.doAddInput(item, data, (ta?"TEXTAREA":"INPUT"), (ta?null:"TEXT"), true, true, "dhxform_textarea");this.doAttachEvents(item);if (ta)item.childNodes[item._ll?1:0].childNodes[0].rows = data.rows;if (typeof(data.numberFormat)!= "undefined") {var a,b=null,c=null;if (typeof(data.numberFormat)!= "string") {a = data.numberFormat[0];b = data.numberFormat[1]||null;c = data.numberFormat[2]||null;}else {a = data.numberFormat;if (typeof(data.groupSep)== "string") b = data.groupSep;if (typeof(data.decSep)== "string") c = data.decSep;}
 this.setNumberFormat(item, a, b, c, false);}
 
 this.setValue(item, data.value);return this;},
 
 doAttachEvents: function(item) {var that = this;if (item._type = "ta"){item.childNodes[item._ll?1:0].childNodes[0].onfocus = function() {var i = this.parentNode.parentNode;if (i._df != null){this.value = i._value||"";window.dhtmlXFormLs[i.getForm()._rId].vals[i._idd] = this.value;}
 }
 }
 
 item.childNodes[item._ll?1:0].childNodes[0].onblur = function() {var i = this.parentNode.parentNode;that.updateValue(i);if (i.getForm().live_validate) that._validate(i);i = null;}
 },
 
 updateValue: function(item) {var value = item.childNodes[item._ll?1:0].childNodes[0].value;var t = this;if (item._value != value){if (item.checkEvent("onBeforeChange")) if (item.callEvent("onBeforeChange",[item._idd, item._value, value])!== true) {if (item._df != null)t.setValue(item, item._value);else item.childNodes[item._ll?1:0].childNodes[0].value = item._value;return;}
 
 if (item._df != null)t.setValue(item, value);else item._value = value;item.callEvent("onChange",[item._idd, value]);return;}
 if (item._df != null)this.setValue(item, item._value);},
 
 setValue: function(item, value) {item._value = (typeof(value) != "undefined" && value != null ? value : "");var v = (item._value||"");var k = item.childNodes[item._ll?1:0].childNodes[0];if (item._df != null && typeof(this._getFmtValue)== "function") v = this._getFmtValue(item, v);if (k.value != v){k.value = v;window.dhtmlXFormLs[item.getForm()._rId].vals[item._idd] = k.value;}
 
 k = null;},
 
 getValue: function(item) {return (typeof(item._value) != "undefined" && item._value != null ? item._value : "");},
 
 setReadonly: function(item, state) {item._ro = (state===true);if (item._ro){item.childNodes[item._ll?1:0].childNodes[0].setAttribute("readOnly", "true");}else {item.childNodes[item._ll?1:0].childNodes[0].removeAttribute("readOnly");}
 },
 
 isReadonly: function(item) {if (!item._ro)item._ro = false;return item._ro;},
 
 getInput: function(item) {return item.childNodes[item._ll?1:0].childNodes[0];},
 
 setNumberFormat: function(item, format, g_sep, d_sep, refresh) {if (typeof(refresh)!= "boolean") refresh = true;if (format == ""){item._df = null;if (refresh)this.setValue(item, item._value);return true;}
 
 if (typeof(format)!= "string") return;var t = format.match(/^([^\.\,0-9]*)([0\.\,]*)([^\.\,0-9]*)/);if (t == null || t.length != 4)return false;item._df = {i_len: false,
 i_sep: (typeof(g_sep)=="string"?g_sep:","),
 
 d_len: false,
 d_sep: (typeof(d_sep)=="string"?d_sep:"."),
 
 s_bef: (typeof(t[1])=="string"?t[1]:""),
 s_aft: (typeof(t[3])=="string"?t[3]:"")
 };var f = t[2].split(".");if (f[1] != null)item._df.d_len = f[1].length;var r = f[0].split(",");if (r.length > 1)item._df.i_len = r[r.length-1].length;if (refresh)this.setValue(item, item._value);return true;},
 
 _getFmtValue: function(item, v) {var r = v.match(/^(-)?([0-9]{1,})(\.([0-9]{1,}))?$/);if (r != null && r.length == 5){var v0 = "";if (r[1] != null)v0 += r[1];v0 += item._df.s_bef;if (item._df.i_len !== false){var i = 0;var v1 = "";for (var q=r[2].length-1;q>=0;q--){v1 = ""+r[2][q]+v1;if (++i == item._df.i_len && q > 0){v1=item._df.i_sep+v1;i=0;}
 }
 v0 += v1;}else {v0 += r[2];}
 
 if (item._df.d_len !== false){if (r[4] == null)r[4] = "";while (r[4].length < item._df.d_len)r[4] += "0";eval("var t0 = new RegExp(/\\d{"+item._df.d_len+"}/);");var t1 = (r[4]).match(t0);if (t1 != null)v0 += item._df.d_sep+t1;t0 = t1 = null;}
 
 v0 += item._df.s_aft;return v0;}
 
 return v;}
 
};(function(){for (var a in {doAddLabel:1,doAddInput:1,destruct:1,doUnloadNestedLists:1,setText:1,getText:1,enable:1,disable:1,isEnabled:1,setWidth:1,setFocus:1})dhtmlXForm.prototype.items.input[a] = dhtmlXForm.prototype.items.select[a];})();dhtmlXForm.prototype.items.password = {render: function(item, data) {item._type = "pw";item._enabled = true;this.doAddLabel(item, data);this.doAddInput(item, data, "INPUT", "PASSWORD", true, true, "dhxform_textarea");this.doAttachEvents(item);this.setValue(item, data.value);return this;}
};(function(){for (var a in {doAddLabel:1,doAddInput:1,doAttachEvents:1,destruct:1,doUnloadNestedLists:1,setText:1,getText:1,setValue:1,getValue:1,updateValue:1,enable:1,disable:1,isEnabled:1,setWidth:1,setReadonly:1,isReadonly:1,setFocus:1,getInput:1})dhtmlXForm.prototype.items.password[a] = dhtmlXForm.prototype.items.input[a];})();dhtmlXForm.prototype.items.file = {render: function(item, data) {item._type = "fl";item._enabled = true;this.doAddLabel(item, data);this.doAddInput(item, data, "INPUT", "FILE", true, false, "dhxform_textarea");item.childNodes[item._ll?1:0].childNodes[0].onchange = function() {item.callEvent("onChange", [item._idd, this.value]);}
 
 return this;},
 
 setValue: function(){},
 
 getValue: function(item) {return item.childNodes[item._ll?1:0].childNodes[0].value;}
 
};(function(){for (var a in {doAddLabel:1,doAddInput:1,destruct:1,doUnloadNestedLists:1,setText:1,getText:1,enable:1,disable:1,isEnabled:1,setWidth:1})dhtmlXForm.prototype.items.file[a] = dhtmlXForm.prototype.items.input[a];})();dhtmlXForm.prototype.items.label = {_index: false,
 
 render: function(item, data) {item._type = "lb";item._enabled = true;item._checked = true;var t = document.createElement("DIV");t.className = "dhxform_txt_label2"+(data._isTopmost?" topmost":"");t.innerHTML = data.label;item.appendChild(t);if (data.hidden == true)this.hide(item);if (data.disabled == true)this.userDisable(item);if (!isNaN(data.labelWidth)) t.style.width = parseInt(data.labelWidth)+"px";if (!isNaN(data.labelHeight)) t.style.height = parseInt(data.labelHeight)+"px";if (!isNaN(data.labelLeft)) t.style.left = parseInt(data.labelLeft)+"px";if (!isNaN(data.labelTop)) t.style.top = parseInt(data.labelTop)+"px";return this;},
 
 destruct: function(item) {this.doUnloadNestedLists(item);item._autoCheck = null;item._enabled = null;item._type = null;item.callEvent = null;item.checkEvent = null;item.getForm = null;item.onselectstart = null;item.parentNode.removeChild(item);item = null;},
 
 enable: function(item) {if (String(item.className).search("disabled") >= 0) item.className = String(item.className).replace(/disabled/gi,"");item._enabled = true;},
 
 disable: function(item) {if (String(item.className).search("disabled") < 0) item.className += " disabled";item._enabled = false;},
 
 setText: function(item, text) {item.firstChild.innerHTML = text;},

 getText: function(item) {return item.firstChild.innerHTML;}
 
};(function(){for (var a in {doUnloadNestedLists:1,isEnabled:1})dhtmlXForm.prototype.items.label[a] = dhtmlXForm.prototype.items.checkbox[a];})();dhtmlXForm.prototype.items.button = {render: function(item, data) {item._type = "bt";item._enabled = true;item._name = data.name;item.className = String(item.className).replace("item_label_top","item_label_left").replace("item_label_right","item_label_left");if (!isNaN(data.width)) var w = Math.max(data.width,10);var k = (typeof(w) != "undefined");item.innerHTML = '<div class="dhxform_btn" role="link" tabindex="0" dir="ltr" '+(k?' style="width:'+w+'px;"':'')+
 'onkeypress="e=event||window.arguments[0];if((e.keyCode==32||e.charCode==32||e.keyCode==13||e.charCode==13)&&!this.parentNode._busy){this.parentNode._busy=true;e.cancelBubble=true;e.returnValue=false;_dhxForm_doClick(this.childNodes[0],[\'mousedown\',\'mouseup\']);return false;}" '+
 'ontouchstart="e=event;e.preventDefault();if(!this.parentNode._busy){this.parentNode._busy=true;_dhxForm_doClick(this.childNodes[0],[\'mousedown\',\'mouseup\']);}" '+
 'onblur="_dhxForm_doClick(this.childNodes[0],\'mouseout\');" >'+
 '<table cellspacing="0" cellpadding="0" border="0" align="left" style="font-size:inherit;'+(k?'width:'+w+'px;table-layout:fixed;':'')+'">'+
 '<tr>'+
 '<td class="btn_l"><div class="btn_l">&nbsp;</div></td>'+
 '<td class="btn_m" '+(k?'style="width:'+(w-10)+'px;"':'')+'>'+
 '<div class="btn_txt'+(k?" btn_txt_fixed_size":"")+'">'+data.value+'</div></td>'+
 '<td class="btn_r"><div class="btn_r">&nbsp;</div></td>'+
 '</tr>'+
 '</table>'+
 "</div>";if (!isNaN(data.inputLeft)) item.childNodes[0].style.left = parseInt(data.inputLeft)+"px";if (!isNaN(data.inputTop)) item.childNodes[0].style.top = parseInt(data.inputTop)+"px";if (data.hidden == true)this.hide(item);if (data.disabled == true)this.userDisable(item);if (typeof(data.tooltip)!= "undefined") item.firstChild.title = data.tooltip;item.onselectstart = function(e){e=e||event;e.cancelBubble=true;e.returnValue=false;return false;}
 item.childNodes[0].onselectstart = function(e){e=e||event;e.cancelBubble=true;e.returnValue=false;return false;}
 
 item.childNodes[0].childNodes[0].onmouseover = function(){var t = this.parentNode.parentNode;if (!t._enabled)return;this._isOver = true;this.className = "dhxform_btn_over";t = null;}
 item.childNodes[0].childNodes[0].onmouseout = function(){var t = this.parentNode.parentNode;if (!t._enabled)return;this.className = "";this._allowClick = false;this._pressed = false;this._isOver = false;t = null;}
 item.childNodes[0].childNodes[0].onmousedown = function(){if (this._pressed)return;var t = this.parentNode.parentNode;if (!t._enabled)return;this.className = "dhxform_btn_pressed";this._allowClick = true;this._pressed = true;t = null;}
 
 item.childNodes[0].childNodes[0].onmouseup = function(){if (!this._pressed)return;var t = this.parentNode.parentNode;if (!t._enabled)return;t._busy = false;this.className = (this._isOver?"dhxform_btn_over":"");if (this._pressed && this._allowClick)t.callEvent("_onButtonClick", [t._name, t._cmd]);this._allowClick = false;this._pressed = false;t = null;}
 
 return this;},
 
 destruct: function(item) {this.doUnloadNestedLists(item);item.callEvent = null;item.checkEvent = null;item.getForm = null;item._autoCheck = null;item._type = null;item._enabled = null;item._cmd = null;item._name = null;item.onselectstart = null;item.childNodes[0].onselectstart = null;item.childNodes[0].onkeypress = null;item.childNodes[0].ontouchstart = null;item.childNodes[0].onblur = null;item.childNodes[0].childNodes[0].onmouseover = null;item.childNodes[0].childNodes[0].onmouseout = null;item.childNodes[0].childNodes[0].onmousedown = null;item.childNodes[0].childNodes[0].onmouseup = null;while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.parentNode.removeChild(item);item = null;},
 
 enable: function(item) {if (String(item.className).search("disabled") >= 0) item.className = String(item.className).replace(/disabled/gi,"");item._enabled = true;item.childNodes[0].tabIndex = 0;item.childNodes[0].removeAttribute("disabled");},
 
 disable: function(item) {if (String(item.className).search("disabled") < 0) item.className += " disabled";item._enabled = false;item.childNodes[0].tabIndex = -1;item.childNodes[0].setAttribute("disabled", "true");},
 
 setText: function(item, text) {item.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[1].childNodes[0].innerHTML = text;},

 getText: function(item) {return item.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[1].childNodes[0].innerHTML;}
 
};(function(){for (var a in {doUnloadNestedLists:1,isEnabled:1})dhtmlXForm.prototype.items.button[a] = dhtmlXForm.prototype.items.checkbox[a];})();dhtmlXForm.prototype.items.hidden = {_index: false,
 
 render: function(item, data) {item.style.display = "none";item._name = data.name;item._type = "hd";item._enabled = true;var t = document.createElement("INPUT");t.type = "HIDDEN";t.name = data.name;t.value = (data.value||"")
 item.appendChild(t);return this;},
 
 destruct: function(item) {this.doUnloadNestedLists(item);while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item._autoCheck = null;item._name = null;item._type = null;item._enabled = null;item.onselectstart = null;item.callEvent = null;item.checkEvent = null;item.getForm = null;item.parentNode.removeChild(item);item = null;},
 
 enable: function(item) {item._enabled = true;item.childNodes[0].setAttribute("name", item._name);},
 
 disable: function(item) {item._enabled = false;item.childNodes[0].removeAttribute("name");},
 
 show: function() {},
 
 hide: function() {},
 
 isHidden: function() {return true;},
 
 setValue: function(item, val) {item.childNodes[0].value = val;window.dhtmlXFormLs[item.getForm()._rId].vals[item._idd] = item.childNodes[0].value;},
 
 getValue: function(item) {return item.childNodes[0].value;},
 
 getInput: function(item) {return item.childNodes[0];}
 
};(function(){for (var a in {doUnloadNestedLists:1,isEnabled:1})dhtmlXForm.prototype.items.hidden[a] = dhtmlXForm.prototype.items.checkbox[a];})();dhtmlXForm.prototype.items.list = {_index: false,
 
 render: function(item) {item._type = "list";item._enabled = true;item._isNestedForm = true;item.className = "dhxform_base_nested";return [this, new dhtmlXForm(item)];},
 
 destruct: function(item) {}
};dhtmlXForm.prototype.items.fieldset = {_index: false,
 
 render: function(item, data) {item._type = "fs";if (typeof(parseInt(data.inputWidth)) == "number") {if (_isFF||_isOpera)data.inputWidth -= 12;}
 
 item._width = data.width;item._enabled = true;item._checked = true;item.className = "fs_"+data.position+(typeof(data.className)=="string"?" "+data.className:"");var f = document.createElement("FIELDSET");f.className = "dhxform_fs";var align = String(data.labelAlign).replace("align_","");f.innerHTML = "<legend class='fs_legend' align='"+align+"' style='text-align:"+align+"'>"+data.label+"</legend>";item.appendChild(f);if (!isNaN(data.inputLeft)) f.style.left = parseInt(data.inputLeft)+"px";if (!isNaN(data.inputTop)) f.style.top = parseInt(data.inputTop)+"px";if (data.inputWidth != "auto")if (!isNaN(data.inputWidth)) f.style.width = parseInt(data.inputWidth)+"px";item._addSubListNode = function() {var t = document.createElement("DIV");this.childNodes[0].appendChild(t);return t;}
 
 if (data.hidden == true)this.hide(item);if (data.disabled == true)this.userDisable(item);return this;},
 
 destruct: function(item) {this.doUnloadNestedLists(item);item._checked = null;item._enabled = null;item._idd = null;item._type = null;item._width = null;item.onselectstart = null;item._addSubListNode = null;item._autoCheck = null;item.callEvent = null;item.checkEvent = null;item.getForm = null;while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.parentNode.removeChild(item);item = null;},
 
 setText: function(item, text) {item.childNodes[0].childNodes[0].innerHTML = text;},
 
 getText: function(item) {return item.childNodes[0].childNodes[0].innerHTML;},
 
 enable: function(item) {item._enabled = true;if (String(item.className).search("disabled") >= 0) item.className = String(item.className).replace(/disabled/gi,"");},
 
 disable: function(item) {item._enabled = false;if (String(item.className).search("disabled") < 0) item.className += " disabled";},
 
 setWidth: function(item, width) {item.childNodes[0].style.width = width+"px";item._width = width;},
 
 getWidth: function(item) {return item._width;}
 
};(function(){for (var a in {doUnloadNestedLists:1,isEnabled:1})dhtmlXForm.prototype.items.fieldset[a] = dhtmlXForm.prototype.items.checkbox[a];})();dhtmlXForm.prototype.items.block = {_index: false,
 
 render: function(item, data) {item._type = "bl";item._width = data.width;item._enabled = true;item._checked = true;item.className = "block_"+data.position+(typeof(data.className)=="string"?" "+data.className:"");var b = document.createElement("DIV");b.className = "dhxform_block";if (data.style)b.style.cssText = data.style;if (typeof(data.id)!= "undefined") b.id = data.id;item.appendChild(b);if (!isNaN(data.inputLeft)) b.style.left = parseInt(data.inputLeft)+"px";if (!isNaN(data.inputTop)) b.style.top = parseInt(data.inputTop)+"px";if (data.inputWidth != "auto")if (!isNaN(data.inputWidth)) b.style.width = parseInt(data.inputWidth)+"px";item._addSubListNode = function() {var t = document.createElement("DIV");t._inBlcok = true;this.childNodes[0].appendChild(t);return t;}
 
 if (data.hidden == true)this.hide(item);if (data.disabled == true)this.userDisable(item);return this;},
 
 _setCss: function(item, skin, fontSize) {item.firstChild.className = "dhxform_obj_"+skin+" dhxform_block";item.firstChild.style.fontSize = fontSize;}
};(function(){for (var a in {enable:1,disable:1,isEnabled:1,setWidth:1,getWidth:1,doUnloadNestedLists:1,destruct:1})dhtmlXForm.prototype.items.block[a] = dhtmlXForm.prototype.items.fieldset[a];})();dhtmlXForm.prototype.items.newcolumn = {_index: false
};dhtmlXForm.prototype.items.template = {render: function(item, data) {var ta = (!isNaN(data.rows));item._type = "tp";item._enabled = true;if (data.format){if (typeof(data.format)== "function") item.format = data.format;if (typeof(window[data.format])== "function") item.format = window[data.format];}
 if (!item.format)item.format = function(name, value) {return value;}
 
 this.doAddLabel(item, data);this.doAddInput(item, data, "DIV", null, true, true, "dhxform_item_template");item._value = (data.value||"");item.childNodes[1].childNodes[0].innerHTML = item.format(item._idd, item._value);return this;},
 
 
 
 
 setValue: function(item, value) {item._value = value;item.childNodes[1].childNodes[0].innerHTML = item.format(item._idd, item._value);},
 
 getValue: function(item) {return item._value;},
 
 enable: function(item) {if (String(item.className).search("disabled") >= 0) item.className = String(item.className).replace(/disabled/gi,"");item._enabled = true;},
 
 disable: function(item) {if (String(item.className).search("disabled") < 0) item.className += " disabled";item._enabled = false;}
 
};(function(){for (var a in {doAddLabel:1,doAddInput:1,destruct:1,doUnloadNestedLists:1,setText:1,getText:1,isEnabled:1,setWidth:1})dhtmlXForm.prototype.items.template[a] = dhtmlXForm.prototype.items.select[a];})();dhtmlXForm.prototype._ulToObject = function(ulData, a) {var obj = [];for (var q=0;q<ulData.childNodes.length;q++){if (String(ulData.childNodes[q].tagName||"").toLowerCase() == "li") {var p = {};var t = ulData.childNodes[q];for (var w=0;w<a.length;w++)if (t.getAttribute(a[w])!= null) p[String(a[w]).replace("ftype","type")] = t.getAttribute(a[w]);if (!p.label)try {p.label = t.firstChild.nodeValue;}catch(e){}
 var n = t.getElementsByTagName("UL");if (n[0] != null)p[(p.type=="select"?"options":"list")] = dhtmlXForm.prototype._ulToObject(n[0], a);for (var w=0;w<t.childNodes.length;w++){if (String(t.childNodes[w].tagName||"").toLowerCase() == "userdata") {if (!p.userdata)p.userdata = {};p.userdata[t.childNodes[w].getAttribute("name")] = t.childNodes[w].firstChild.nodeValue;}
 }
 obj[obj.length] = p;}
 if (String(ulData.childNodes[q].tagName||"").toLowerCase() == "div") {var p = {};p.type = "label";try {p.label = ulData.childNodes[q].firstChild.nodeValue;}catch(e){}
 obj[obj.length] = p;}
 }
 return obj;};dhtmlxEvent(window, "load", function(){var a = [
 "ftype", "name", "value", "label", "check", "checked", "disabled", "text", "rows", "select", "selected", "width", "style", "className",
 "labelWidth", "labelHeight", "labelLeft", "labelTop", "inputWidth", "inputHeight", "inputLeft", "inputTop", "position", "size"
 ];var k = document.getElementsByTagName("UL");var u = [];for (var q=0;q<k.length;q++){if (k[q].className == "dhtmlxForm"){var formNode = document.createElement("DIV");u[u.length] = {nodeUL:k[q], nodeForm:formNode, data:dhtmlXForm.prototype._ulToObject(k[q], a), name:(k[q].getAttribute("name")||null)};}
 }
 for (var q=0;q<u.length;q++){u[q].nodeUL.parentNode.insertBefore(u[q].nodeForm, u[q].nodeUL);var listObj = new dhtmlXForm(u[q].nodeForm, u[q].data);if (u[q].name !== null)window[u[q].name] = listObj;var t = (u[q].nodeUL.getAttribute("oninit")||null);u[q].nodeUL.parentNode.removeChild(u[q].nodeUL);u[q].nodeUL = null;u[q].nodeForm = null;u[q].data = null;u[q] = null;if (t){if (typeof(t)== "function") t();else if (typeof(window[t])== "function") window[t]();}
 }
});if (window.dhtmlXContainer){if (!dhtmlx.attaches)dhtmlx.attaches = {};if (!dhtmlx.attaches["attachForm"]){dhtmlx.attaches["attachForm"] = function(data) {var obj = document.createElement("DIV");obj.id = "dhxFormObj_"+this._genStr(12);obj.style.position = "relative";obj.style.width = "100%";obj.style.height = "100%";obj.style.overflow = "auto";obj.cmp = "form";this.attachObject(obj, false, true, false);this.vs[this.av].form = new dhtmlXForm(obj, data);this.vs[this.av].form.setSkin(this.skin);this.vs[this.av].form.setSizes();this.vs[this.av].formObj = obj;if (this.skin == "dhx_terrace"){this.adjust();this.updateNestedObjects();}
 
 return this.vs[this.av].form;}
 }
 
 if (!dhtmlx.detaches)dhtmlx.detaches = {};if (!dhtmlx.detaches["detachForm"]){dhtmlx.detaches["detachForm"] = function(contObj) {if (!contObj.form)return;contObj.form.unload();contObj.form = null;contObj.formObj = null;contObj.attachForm = null;}
 }
};dhtmlXForm.prototype.setUserData = function(id, name, value, rValue) {if (typeof(rValue)!= "undefined") {var k = this.doWithItem([id,name], "_getId");if (k != null){id = k;name = value;value = rValue;}
 }
 if (!this._userdata)this._userdata = {};this._userdata[id] = (this._userdata[id]||{});this._userdata[id][name] = value;};dhtmlXForm.prototype.getUserData = function(id, name, rValue) {if (typeof(rValue)!= "undefined") {var k = this.doWithItem([id,name], "_getId");if (k != null){id = k;name = rValue;}
 }
 if (this._userdata != null && typeof(this._userdata[id])!= "undefined" && typeof(this._userdata[id][name]) != "undefined") return this._userdata[id][name];return "";};dhtmlXForm.prototype.setRTL = function(state) {this._rtl = (state===true?true:false);for (var q=0;q<this.base.length;q++){if (this._rtl){if (String(this.base[q].className).search(/dhxform_rtl/gi) < 0) this.base[q].className += " dhxform_rtl";}else {if (String(this.base[q].className).search(/dhxform_rtl/gi) >= 0) this.base[q].className = String(this.base[q].className).replace(/dhxform_rtl/gi,"");}
 }
};_dhxForm_doClick = function(obj, evType) {if (typeof(evType)== "object") {var t = evType[1];evType = evType[0];}
 if (document.createEvent){var e = document.createEvent("MouseEvents");e.initEvent(evType, true, false);obj.dispatchEvent(e);}else if (document.createEventObject){var e = document.createEventObject();e.button = 1;obj.fireEvent("on"+evType, e);}
 if (t)window.setTimeout(function(){_dhxForm_doClick(obj,t);},100);}
dhtmlXForm.prototype.setFormData = function(t) {for (var a in t){var r = this.getItemType(a);switch (r) {case "checkbox":
 this[t[a]==true||parseInt(t[a])==1||t[a]=="true"?"checkItem":"uncheckItem"](a);break;case "radio":
 this.checkItem(a,t[a]);break;case "input":
 case "textarea":
 case "select":
 case "multiselect":
 case "hidden":
 case "template":
 case "combo":
 case "calendar":
 case "colorpicker":
 case "editor":
 this.setItemValue(a,t[a]);break;default:
 if (this["setFormData_"+r]){this["setFormData_"+r](a,t[a]);}else {if (!this.hId)this.hId = this._genStr(12);this.setUserData(this.hId, a, t[a]);}
 break;}
 }
};dhtmlXForm.prototype.getFormData = function(p0, only_fields) {this._updateValues();var r = {};var that = this;for (var a in this.itemPull){var i = this.itemPull[a]._idd;var t = this.itemPull[a]._type;if (t == "ch")r[i] = (this.isItemChecked(i)?this.getItemValue(i):0);if (t == "ra" && !r[this.itemPull[a]._group])r[this.itemPull[a]._group] = this.getCheckedValue(this.itemPull[a]._group);if (t in {se:1,ta:1,pw:1,hd:1,tp:1,fl:1,calendar:1,combo:1,editor:1,colorpicker:1})r[i] = this.getItemValue(i,p0);if (this["getFormData_"+t])r[i] = this["getFormData_"+t](i);if (t == "up"){var r0 = this.getItemValue(i);for (var a0 in r0)r[a0] = r0[a0];}
 
 if (this.itemPull[a]._list){for (var q=0;q<this.itemPull[a]._list.length;q++){var k = this.itemPull[a]._list[q].getFormData(p0,only_fields);for (var b in k)r[b] = k[b];}
 }
 }
 
 if (!only_fields && this.hId && this._userdata[this.hId]){for (var a in this._userdata[this.hId]){if (!r[a])r[a] = this._userdata[this.hId][a];}
 }
 return r;};dhtmlXForm.prototype.adjustParentSize = function(pId) {var kx = 0;var ky = -1;for (var q=0;q<this.base.length;q++){kx += this.base[q].offsetWidth;if (this.base[q].offsetHeight > ky)ky = this.base[q].offsetHeight;}
 
 
 var isLayout = false;try {isLayout = (this.cont.parentNode.parentNode.parentNode.parentNode._isCell==true);if (isLayout)var layoutCell = this.cont.parentNode.parentNode.parentNode.parentNode;}catch(e){};if (isLayout && typeof(layoutCell)!= "undefined") {if (kx > 0)layoutCell.setWidth(kx+10);if (ky > 0)layoutCell.setHeight(ky+layoutCell.firstChild.firstChild.offsetHeight+5);isLayout = layoutCell = null;return;}
 
 
 var isWindow = false;try {isWindow = (this.cont.parentNode.parentNode.parentNode.parentNode._isWindow==true);if (isWindow)var winCell = this.cont.parentNode.parentNode.parentNode.parentNode;}catch(e){};if (isWindow && typeof(winCell)!= "undefined") {this.cont.style.display = "none";if (kx > 0 || ky > 0)winCell._adjustToContent(kx+10,ky+10);this.cont.style.display = "";isWindow = winCell = null;return;}
};_dhxForm_isIPad = (navigator.userAgent.search(/iPad/gi)>=0);dhtmlXForm.prototype.load = function(url, type, callback) {var form = this;form.callEvent("onXLS",[]);if (typeof type == 'function'){callback = type;type = 'xml';}
 
 dhtmlxAjax.get(url, function(loader){var data ={};if (type == "json"){eval("data="+loader.xmlDoc.responseText);}else {var top = loader.doXPath("//data")[0];if (top && top.getAttribute("dhx_security"))
 dhtmlx.security_key = top.getAttribute("dhx_security");var tags = loader.doXPath("//data/*");for (var i=0;i < tags.length;i++){data[tags[i].tagName] = tags[i].firstChild?tags[i].firstChild.nodeValue:"";};}
 
 var id = url.match(/(\?|\&)id\=([a-z0-9_]*)/i);if (id && id[0])id = id[0].split("=")[1];if (form.callEvent("onBeforeDataLoad", [id, data])){form.formId = id;form._last_load_data = data;form.setFormData(data);form.resetDataProcessor("updated");}
 
 
 form.callEvent("onXLE",[]);if (callback)callback.call(this);});};dhtmlXForm.prototype.reset = function() {if (this.callEvent("onBeforeReset",[this.formId,this.getFormData()])){if (this._last_load_data)this.setFormData(this._last_load_data);this.callEvent("onAfterReset", [this.formId]);}
};dhtmlXForm.prototype.send = function(url, mode, callback, skipValidation) {if (typeof mode == 'function'){callback = mode;mode = 'post';}
 if (skipValidation !== true && !this.validate()) return;var formdata = this.getFormData(true);var data = [];for (var key in formdata)data.push(key+"="+encodeURIComponent(formdata[key]));var afterload = function(loader){if (callback)callback.call(this, loader, loader.xmlDoc.responseText);};if (mode == 'get')dhtmlxAjax.get(url+(url.indexOf("?")==-1?"?":"&")+data.join("&"), afterload);else
 dhtmlxAjax.post(url, data.join("&"), afterload);};dhtmlXForm.prototype.save = function(url, type){};dhtmlXForm.prototype.dummy = function() {};dhtmlXForm.prototype._changeFormId = function(oldid, newid) {this.formId = newid;};dhtmlXForm.prototype._dp_init = function(dp) {dp._methods=["dummy","dummy","_changeFormId","dummy"];dp._getRowData=function(id,pref){var data = this.obj.getFormData(true);data[this.action_param] = this.obj.getUserData(id, this.action_param);return data;};dp._clearUpdateFlag=function(){};dp.attachEvent("onAfterUpdate",function(sid, action, tid, tag){if (action == "inserted" || action == "updated"){this.obj.resetDataProcessor("updated");this.obj._last_load_data = this.obj.getFormData(true);}
 this.obj.callEvent("onAfterSave",[this.obj.formId, tag]);return true;});dp.autoUpdate = false;dp.setTransactionMode("POST", true);this.dp = dp;this.formId = (new Date()).valueOf();this.resetDataProcessor("inserted");this.save = function(){if (!this.callEvent("onBeforeSave",[this.formId, this.getFormData()])) return;if (!this.validate()) return;dp.sendData();};};dhtmlXForm.prototype.resetDataProcessor=function(mode){if (!this.dp)return;this.dp.updatedRows = [];this.dp._in_progress = [];this.dp.setUpdated(this.formId,true,mode);};if (!window.dhtmlxValidation){dhtmlxValidation = function(){};dhtmlxValidation.prototype = {isEmpty: function(value) {return value == '';},
 isNotEmpty: function(value) {return !value == '';},
 isValidBoolean: function(value) {return !!value.match(/^(0|1|true|false)$/);},
 isValidEmail: function(value) {return !!value.match(/(^[a-z]([a-z0-9_\.]*)@([a-z_\.]*)([.][a-z]{3})$)|(^[a-z]([a-z_\.]*)@([a-z_\-\.]*)(\.[a-z]{2,3})$)/i);},
 isValidInteger: function(value) {return !!value.match(/(^-?\d+$)/);},
 isValidNumeric: function(value) {return !!value.match(/(^-?\d\d*[\.|,]\d*$)|(^-?\d\d*$)|(^-?[\.|,]\d\d*$)/);},
 isValidAplhaNumeric: function(value) {return !!value.match(/^[_\-a-z0-9]+$/gi);},
 
 isValidDatetime: function(value) {var dt = value.match(/^(\d{4})-(\d{2})-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/);return dt && !!(dt[1]<=9999 && dt[2]<=12 && dt[3]<=31 && dt[4]<=59 && dt[5]<=59 && dt[6]<=59) || false;},
 
 isValidDate: function(value) {var d = value.match(/^(\d{4})-(\d{2})-(\d{2})$/);return d && !!(d[1]<=9999 && d[2]<=12 && d[3]<=31) || false;},
 
 isValidTime: function(value) {var t = value.match(/^(\d{1,2}):(\d{1,2}):(\d{1,2})$/);return t && !!(t[1]<=24 && t[2]<=59 && t[3]<=59) || false;},
 
 isValidIPv4: function(value) {var ip = value.match(/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/);return ip && !!(ip[1]<=255 && ip[2]<=255 && ip[3]<=255 && ip[4]<=255) || false;},
 isValidCurrency: function(value) {return value.match(/^\$?\s?\d+?[\.,\,]?\d+?\s?\$?$/) && true || false;},
 
 isValidSSN: function(value) {return value.match(/^\d{3}\-?\d{2}\-?\d{4}$/) && true || false;},
 
 isValidSIN: function(value) {return value.match(/^\d{9}$/) && true || false;}
 };dhtmlxValidation = new dhtmlxValidation();};window.dhtmlXFormLs = {};dhtmlXForm.prototype.items.calendar = {render: function(item, data) {var t = this;item._type = "calendar";item._enabled = true;this.doAddLabel(item, data);this.doAddInput(item, data, "INPUT", "TEXT", true, true, "dhxform_textarea");item.childNodes[item._ll?1:0].childNodes[0]._idd = item._idd;item._f = (data.dateFormat||"%d-%m-%Y");item._f0 = (data.serverDateFormat||item._f);item._c = new dhtmlXCalendarObject(item.childNodes[item._ll?1:0].childNodes[0], data.skin||item.getForm().skin||"dhx_skyblue");item._c._nullInInput = true;item._c.enableListener(item.childNodes[item._ll?1:0].childNodes[0]);item._c.setDateFormat(item._f);if (!data.enableTime)item._c.hideTime();if (!isNaN(data.weekStart)) item._c.setWeekStartDay(data.weekStart);if (typeof(data.calendarPosition)!= "undefined") item._c.setPosition(data.calendarPosition);item._c._itemIdd = item._idd;item._c.attachEvent("onBeforeChange", function(d) {if (item._value != d){if (item.checkEvent("onBeforeChange")) {if (item.callEvent("onBeforeChange",[item._idd, item._value, d])!== true) {return false;}
 }
 
 item._value = d;t.setValue(item, d);item.callEvent("onChange", [this._itemIdd, item._value]);}
 return true;});this.setValue(item, data.value);return this;},
 
 getCalendar: function(item) {return item._c;},
 
 setSkin: function(item, skin) {item._c.setSkin(skin);},
 
 setValue: function(item, value) {if (!value || value == null || typeof(value)== "undefined" || value == "") {item._value = null;item.childNodes[item._ll?1:0].childNodes[0].value = "";}else {item._value = (value instanceof Date ? value : item._c._strToDate(value, item._f0));item.childNodes[item._ll?1:0].childNodes[0].value = item._c._dateToStr(item._value, item._f);}
 item._c.setDate(item._value);window.dhtmlXFormLs[item.getForm()._rId].vals[item._idd] = item.childNodes[item._ll?1:0].childNodes[0].value;},
 
 getValue: function(item, asString) {var d = item._c.getDate();if (asString===true && d == null)return "";return (asString===true?item._c._dateToStr(d,item._f0):d);},
 
 destruct: function(item) {item._c.unload();item._c = null;try {delete item._c;}catch(e){}
 
 item._f = null;try {delete item._f;}catch(e){}
 
 item._f0 = null;try {delete item._f0;}catch(e){}
 
 
 item.childNodes[item._ll?1:0].childNodes[0]._idd = null;this.d2(item);item = null;}
 
};(function(){for (var a in {doAddLabel:1,doAddInput:1,doUnloadNestedLists:1,setText:1,getText:1,enable:1,disable:1,isEnabled:1,setWidth:1,setReadonly:1,isReadonly:1,setFocus:1,getInput:1})dhtmlXForm.prototype.items.calendar[a] = dhtmlXForm.prototype.items.input[a];})();dhtmlXForm.prototype.items.calendar.d2 = dhtmlXForm.prototype.items.input.destruct;dhtmlXForm.prototype.getCalendar = function(name) {return this.doWithItem(name, "getCalendar");};dhtmlXForm.prototype.items.colorpicker = {ev: false,
 
 
 inp: null,
 
 
 colorpicker: {},
 
 
 cz: {},
 
 render: function(item, data) {var t = this;item._type = "colorpicker";item._enabled = true;this.doAddLabel(item, data);this.doAddInput(item, data, "INPUT", "TEXT", true, true, "dhxform_textarea");item._value = (data.value||"");item.childNodes[item._ll?1:0].childNodes[0].value = item._value;this.cz[item._idd] = document.createElement("DIV");this.cz[item._idd].style.position = "absolute";this.cz[item._idd].style.top = "0px";this.cz[item._idd].style.zIndex = 249;document.body.insertBefore(this.cz[item._idd], document.body.firstChild);this.colorpicker[item._idd] = new dhtmlXColorPicker(this.cz[item._idd], null, null, true);this.colorpicker[item._idd].setImagePath(data.imagePath||"");this.colorpicker[item._idd].init();this.colorpicker[item._idd].elements.cs_Content.onclick = function(e){(e||event).cancelBubble=true;}
 
 
 this.colorpicker[item._idd].setOnSelectHandler(function(color){if (item._value != color){if (item.checkEvent("onBeforeChange")) {if (item.callEvent("onBeforeChange",[item._idd, item._value, color])!== true) {return;}
 }
 
 item._value = color;t.setValue(item, color);item.callEvent("onChange", [item._idd, item._value]);}
 });item.childNodes[item._ll?1:0].childNodes[0]._idd = item._idd;item.childNodes[item._ll?1:0].childNodes[0].onclick = function(){if (t.colorpicker[this._idd].isVisible()) {t.colorpicker[this._idd].hide();t.inp = null;}else {t.colorpicker[this._idd].setPosition(getAbsoluteLeft(this), getAbsoluteTop(this)+this.offsetHeight-1);t.colorpicker[this._idd].setColor(item._value);t.colorpicker[this._idd].show();t.inp = this._idd;}
 }
 
 if (!this.ev){if (_isIE)document.body.attachEvent("onclick",this.clickEvent);else window.addEventListener("click",this.clickEvent,false);this.ev = true;}
 
 return this;},
 
 clickEvent: function() {dhtmlXForm.prototype.items.colorpicker.hideAllColorPickers();},
 
 hideAllColorPickers: function() {for (var a in this.colorpicker)if (a != this.inp)this.colorpicker[a].hide();this.inp = null;},
 
 getColorPicker: function(item) {return this.colorpicker[item._idd];},
 
 destruct: function(item) {this.colorpicker[item._idd].elements.cs_Content.onclick = null;this.colorpicker[item._idd].unload();this.colorpicker[item._idd] = null;try {delete this.colorpicker[item._idd];}catch(e){}
 
 this.cz[item._idd].parentNode.removeChild(this.cz[item._idd]);this.cz[item._idd] = null;try {delete this.cz[item._idd];}catch(e){}
 
 
 var k = 0;for (var a in this.colorpicker)k++;if (k == 0){if (_isIE)document.body.detachEvent("onclick",this.clickEvent);else window.removeEventListener("click",this.clickEvent,false);this.ev = false;}
 
 
 item.childNodes[item._ll?1:0].childNodes[0]._idd = null;this.d2(item);item = null;}
};(function(){for (var a in {doAddLabel:1,doAddInput:1,doUnloadNestedLists:1,setText:1,getText:1,enable:1,disable:1,isEnabled:1,setWidth:1,setReadonly:1,isReadonly:1,setValue:1,getValue:1,setFocus:1,getInput:1})dhtmlXForm.prototype.items.colorpicker[a] = dhtmlXForm.prototype.items.input[a];})();dhtmlXForm.prototype.items.colorpicker.d2 = dhtmlXForm.prototype.items.input.destruct;dhtmlXForm.prototype.getColorPicker = function(name) {return this.doWithItem(name, "getColorPicker");};dhtmlXColorPicker.prototype.unload = function() {this.elements.cs_SelectorVer.parentNode.removeChild(this.elements.cs_SelectorVer);this.elements.cs_SelectorHor.parentNode.removeChild(this.elements.cs_SelectorHor);this.elements.cs_SelectorVer = null;this.elements.cs_SelectorHor = null;this.elements.cs_SelectorDiv.ondblclick = null;this.elements.cs_SelectorDiv.onmousedown = null;this.elements.cs_SelectorDiv.z = null;this.elements.cs_SelectorDiv.parentNode.removeChild(this.elements.cs_SelectorDiv);this.elements.cs_SelectorDiv = null;this.elements.cs_LumSelectArrow.onmousedown = null;this.elements.cs_LumSelectArrow.z = null;this.elements.cs_LumSelectArrow.parentNode.removeChild(this.elements.cs_LumSelectArrow);this.elements.cs_LumSelectArrow = null;this.elements.cs_LumSelectLine.parentNode.removeChild(this.elements.cs_LumSelectLine);this.elements.cs_LumSelectLine = null;while (this.elements.cs_LumSelect.childNodes.length > 0)this.elements.cs_LumSelect.removeChild(this.elements.cs_LumSelect.childNodes[0]);this.elements.cs_LumSelect.ondblclick = null;this.elements.cs_LumSelect.onmousedown = null;this.elements.cs_LumSelect.z = null;this.elements.cs_LumSelect.parentNode.removeChild(this.elements.cs_LumSelect);this.elements.cs_LumSelect = null;this.elements.cs_EndColor.parentNode.removeChild(this.elements.cs_EndColor);this.elements.cs_EndColor = null;this.elements.cs_InputHue.onchange = null;this.elements.cs_InputHue.z = null;this.elements.cs_InputHue.parentNode.removeChild(this.elements.cs_InputHue);this.elements.cs_InputHue = null;this.elements.cs_InputRed.onchange = null;this.elements.cs_InputRed.z = null;this.elements.cs_InputRed.parentNode.removeChild(this.elements.cs_InputRed);this.elements.cs_InputRed = null;this.elements.cs_InputSat.onchange = null;this.elements.cs_InputSat.z = null;this.elements.cs_InputSat.parentNode.removeChild(this.elements.cs_InputSat);this.elements.cs_InputSat = null;this.elements.cs_InputGreen.onchange = null;this.elements.cs_InputGreen.z = null;this.elements.cs_InputGreen.parentNode.removeChild(this.elements.cs_InputGreen);this.elements.cs_InputGreen = null;this.elements.cs_Hex.onchange = null;this.elements.cs_Hex.z = null;this.elements.cs_Hex.parentNode.removeChild(this.elements.cs_Hex);this.elements.cs_Hex = null;this.elements.cs_InputLum.onchange = null;this.elements.cs_InputLum.z = null;this.elements.cs_InputLum.parentNode.removeChild(this.elements.cs_InputLum);this.elements.cs_InputLum = null;this.elements.cs_InputBlue.onchange = null;this.elements.cs_InputBlue.z = null;this.elements.cs_InputBlue.parentNode.removeChild(this.elements.cs_InputBlue);this.elements.cs_InputBlue = null;this.elements.cs_ButtonOk.onclick = null;this.elements.cs_ButtonOk.onmouseout = null;this.elements.cs_ButtonOk.onmouseover = null;this.elements.cs_ButtonOk.z = null;this.elements.cs_ButtonOk.parentNode.removeChild(this.elements.cs_ButtonOk);this.elements.cs_ButtonOk = null;this.elements.cs_ButtonCancel.onclick = null;this.elements.cs_ButtonCancel.onmouseout = null;this.elements.cs_ButtonCancel.onmouseover = null;this.elements.cs_ButtonCancel.z = null;this.elements.cs_ButtonCancel.parentNode.removeChild(this.elements.cs_ButtonCancel);this.elements.cs_ButtonCancel = null;this.elements.cs_ContentTable.parentNode.removeChild(this.elements.cs_ContentTable);this.elements.cs_ContentTable = null;this.elements.cs_Content.parentNode.removeChild(this.elements.cs_Content);this.elements.cs_Content = null;this.z = null;this.detachAllEvents();this.attachEvent = null;this.callEvent = null;this.checkEvent = null;this.eventCatcher = null;this.detachEvent = null;this.detachAllEvents = null;this.generate = null;this.resetHandlers = null;this.clickOk = null;this.clickCancel = null;this.saveColor = null;this.restoreColor = null;this.addCustomColor = null;this.restoreFromRGB = null;this.restoreFromHSV = null;this.restoreFromHEX = null;this.redraw = null;this.setCustomColors = null;this.setColor = null;this.close = null;this.setPosition = null;this.hide = null;this.setOnSelectHandler = null;this.setOnCancelHandler = null;this.getSelectedColor = null;this.linkTo = null;this.hideOnSelect = null;this.setImagePath = null;this.init = null;this.loadUserLanguage = null;this.setSkin = null;this.isVisible = null;this.hoverButton = null;this.normalButton = null;this.show = null;this.showA = null;this.unload = null;this._initCsIdElement = null;this._initEvents = null;this._setCrossPos = null;this._getScrollers = null;this._setLumPos = null;this._startMoveColor = null;this._mouseMoveColor = null;this._stopMoveColor = null;this._startMoveLum = null;this._mouseMoveLum = null;this._stopMoveLum = null;this._getOffset = null;this._getOffsetTop = null;this._getOffsetLeft = null;this._calculateColor = null;this._drawValues = null;this._hsv2rgb = null;this._rgb2hsv = null;this._drawLum = null;this._colorizeLum = null;this._dec2hex = null;this._hex2dec = null;this._initCustomColors = null;this._reinitCustomColors = null;this._getColorHEX = null;this._selectCustomColor = null;this._changeValueHSV = null;this._changeValueRGB = null;this._changeValueHEX = null;this.container = null;this.elements = null;this.language = null;this.linkToObjects = null;this.customColors = null;};dhtmlXForm.prototype.items.combo = {render: function(item, data) {item._type = "combo";item._enabled = true;item._value = null;item._newValue = null;this.doAddLabel(item, data);this.doAddInput(item, data, "SELECT", null, true, true, "dhxform_select");this.doAttachEvents(item);this.doLoadOpts(item, data);item.onselectstart = function(e){e=e||event;e.returnValue=true;return true;}
 
 
 item.childNodes[item._ll?1:0].childNodes[0].setAttribute("opt_type", data.comboType||"");item._combo = new dhtmlXComboFromSelect(item.childNodes[item._ll?1:0].childNodes[0]);item._combo._currentComboValue = item._combo.getSelectedValue();item._combo.DOMelem_input.id = data.uid;if (data.connector){var that = this;item._connector_working = true;item._combo.loadXML(data.connector, function(){item.callEvent("onOptionsLoaded", [item._idd]);item._connector_working = false;if (item._connector_value != null){that.setValue(item, item._connector_value);item._connector_value = null;}
 });}
 if (data.filtering)item._combo.enableFilteringMode(true);if (data.readonly == true)this.setReadonly(item, true);if (data.style)item._combo.DOMelem_input.style.cssText += data.style;if (typeof(window.addEventListener)== "function" && item.getForm().skin == "dhx_terrace") {item._combo.DOMelem_input.addEventListener("focus", function(){var k = this.parentNode.parentNode;k._inFocus = true;if (k.className.search(/combo_in_focus/)< 0) k.className += " combo_in_focus";k = null;}, false);item._combo.DOMelem_input.addEventListener("blur", function(){var k = this.parentNode.parentNode;if (k.className.search(/combo_in_focus/)>= 0) k.className = k.className.replace(/combo_in_focus/gi,"");k = null;}, false);}
 
 return this;},
 
 destruct: function(item) {item.childNodes[item._ll?1:0].childNodes[0].onchange = null;item._combo._currentComboValue = null;item._combo.destructor();item._combo = null;item._apiChange = null;this.d2(item);item = null;},
 
 doAttachEvents: function(item) {var that = this;item.childNodes[item._ll?1:0].childNodes[0].onchange = function() {that.doOnChange(this);that.doValidate(this.DOMParent.parentNode.parentNode);}
 },
 
 doValidate: function(item) {if (item.getForm().hot_validate) this._validate(item);},
 
 doOnChange: function(combo) {var item = combo.DOMParent.parentNode.parentNode;if (item._apiChange)return;combo._newComboValue = combo.getSelectedValue();if (combo._newComboValue != combo._currentComboValue){if (item.checkEvent("onBeforeChange")) {if (item.callEvent("onBeforeChange", [item._idd, combo._currentComboValue, combo._newComboValue])!== true) {window.setTimeout(function(){combo.setComboValue(combo._currentComboValue);},1);return false;}
 }
 combo._currentComboValue = combo._newComboValue;item.callEvent("onChange", [item._idd, combo._currentComboValue]);}
 item._autoCheck(item._enabled);},
 
 enable: function(item) {if (String(item.className).search("disabled") >= 0) item.className = String(item.className).replace(/disabled/gi,"");item._enabled = true;item._combo.disable(false);item._combo.DOMelem_button.src = (window.dhx_globalImgPath?dhx_globalImgPath:"")+'combo_select'+(dhtmlx.skin?"_"+dhtmlx.skin:"")+'.gif';},
 
 disable: function(item) {if (String(item.className).search("disabled") < 0) item.className += " disabled";item._enabled = false;item._combo.disable(true);item._combo.DOMelem_button.src = (window.dhx_globalImgPath?dhx_globalImgPath:"")+'combo_select_dis'+(dhtmlx.skin?"_"+dhtmlx.skin:"")+'.gif';},
 
 getCombo: function(item) {return item._combo;},
 
 setValue: function(item, val) {if (item._connector_working){item._connector_value = val;return;}
 item._apiChange = true;item._combo.setComboValue(val);item._combo._currentComboValue = item._combo.getActualValue();item._apiChange = false;},
 
 getValue: function(item) {return item._combo.getActualValue();},
 
 setWidth: function(item, width) {item.childNodes[item._ll?1:0].childNodes[0].style.width = width+"px";},
 
 setReadonly: function(item, state) {if (!item._combo)return;item._combo_ro = state;item._combo.readonly(item._combo_ro);},

 isReadonly: function(item, state) {return item._combo_ro||false;},
 
 _setCss: function(item, skin, fontSize) {item._combo.DOMlist.style.fontSize = fontSize;}
 
};(function(){for (var a in {doAddLabel:1,doAddInput:1,doLoadOpts:1,doUnloadNestedLists:1,setText:1,getText:1,isEnabled:1,_checkNoteWidth:1})dhtmlXForm.prototype.items.combo[a] = dhtmlXForm.prototype.items.select[a];})();dhtmlXForm.prototype.items.combo.d2 = dhtmlXForm.prototype.items.select.destruct;dhtmlXForm.prototype.getCombo = function(name) {return this.doWithItem(name, "getCombo");};dhtmlXForm.prototype.items.editor = {editor: {},
 
 render: function(item, data) {var ta = (!isNaN(data.rows));item._type = "editor";item._enabled = true;this.doAddLabel(item, data);this.doAddInput(item, data, "DIV", null, true, true, "dhxform_item_template");item._value = (data.value||"");item.childNodes[item._ll?1:0].childNodes[0].className += " dhxeditor_inside";var that = this;this.editor[item._idd] = new dhtmlXEditor(item.childNodes[item._ll?1:0].childNodes[0]);this.editor[item._idd].setContent(item._value);this.editor[item._idd].attachEvent("onAccess",function(t, ev){_dhxForm_doClick(document.body, "click");if (t == "blur")that.doOnBlur(item, this);item.callEvent("onEditorAccess", [item._idd, t, ev, this, item.getForm()]);});this.editor[item._idd].attachEvent("onToolbarClick", function(a){item.callEvent("onEditorToolbarClick", [item._idd, a, this, item.getForm()]);});if (data.readonly)this.setReadonly(item, true);item.childNodes[item._ll?0:1].childNodes[0].removeAttribute("for");item.childNodes[item._ll?0:1].childNodes[0].onclick = function() {that.editor[item._idd]._focus();}
 
 
 return this;},
 
 
 
 doOnBlur: function(item, editor) {var t = editor.getContent();if (item._value != t){if (item.checkEvent("onBeforeChange")) {if (item.callEvent("onBeforeChange",[item._idd, item._value, t])!== true) {editor.setContent(item._value);return;}
 }
 
 item._value = t;item.callEvent("onChange",[item._idd, t]);}
 },
 
 setValue: function(item, value) {if (item._value == value)return;item._value = value;this.editor[item._idd].setContent(item._value);},
 
 getValue: function(item) {item._value = this.editor[item._idd].getContent();return item._value;},
 
 enable: function(item) {this.editor[item._idd].setReadonly(false);this.doEn(item);},
 
 disable: function(item) {this.editor[item._idd].setReadonly(true);this.doDis(item);},
 
 setReadonly: function(item, mode) {this.editor[item._idd].setReadonly(mode);},
 
 getEditor: function(item) {return (this.editor[item._idd]||null);},
 
 destruct: function(item) {item.childNodes[item._ll?0:1].childNodes[0].onclick = null;this.editor[item._idd].unload();this.editor[item._idd] = null;this.d2(item);item = null;},
 
 setFocus: function(item) {this.editor[item._idd]._focus();}
 
};(function(){for (var a in {doAddLabel:1,doAddInput:1,doUnloadNestedLists:1,setText:1,getText:1,setWidth:1,isEnabled:1})dhtmlXForm.prototype.items.editor[a] = dhtmlXForm.prototype.items.template[a];})();dhtmlXForm.prototype.items.editor.d2 = dhtmlXForm.prototype.items.select.destruct;dhtmlXForm.prototype.items.editor.doEn = dhtmlXForm.prototype.items.select.enable;dhtmlXForm.prototype.items.editor.doDis = dhtmlXForm.prototype.items.select.disable;dhtmlXForm.prototype.getEditor = function(name) {return this.doWithItem(name, "getEditor");};function dataProcessor(serverProcessorURL){this.serverProcessor = serverProcessorURL;this.action_param="!nativeeditor_status";this.object = null;this.updatedRows = [];this.autoUpdate = true;this.updateMode = "cell";this._tMode="GET";this.post_delim = "_";this._waitMode=0;this._in_progress={};this._invalid={};this.mandatoryFields=[];this.messages=[];this.styles={updated:"font-weight:bold;",
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
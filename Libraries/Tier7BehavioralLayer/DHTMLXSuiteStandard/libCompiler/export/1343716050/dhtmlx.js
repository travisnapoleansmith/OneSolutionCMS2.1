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
 };})();function dhtmlXMenuObject(baseId, skin) {var main_self = this;this.addBaseIdAsContextZone = null;this.isDhtmlxMenuObject = true;this.skin = (skin != null ? skin : (typeof(dhtmlx) != "undefined" && typeof(dhtmlx.skin) == "string" ? dhtmlx.skin : "dhx_skyblue"));this.imagePath = "";this._isIE6 = false;if (_isIE)this._isIE6 = (window.XMLHttpRequest==null?true:false);if (baseId == null){this.base = document.body;}else {var baseObj = (typeof(baseId)=="string"?document.getElementById(baseId):baseId);if (baseObj != null){this.base = baseObj;if (!this.base.id)this.base.id = (new Date()).valueOf();while (this.base.childNodes.length > 0){this.base.removeChild(this.base.childNodes[0]);}
 this.base.className += " dhtmlxMenu_"+this.skin+"_Middle dir_left";this.base._autoSkinUpdate = true;if (this.base.oncontextmenu)this.base._oldContextMenuHandler = this.base.oncontextmenu;this.addBaseIdAsContextZone = this.base.id;this.base.onselectstart = function(e) {e = e || event;e.returnValue = false;return false;}
 this.base.oncontextmenu = function(e) {e = e || event;e.returnValue = false;return false;}
 }else {this.base = document.body;}
 }
 
 this.topId = "dhxWebMenuTopId";if (!this.extendedModule){var t = function(){alert(this.i18n.dhxmenuextalert);};var extMethods = new Array("setItemEnabled", "setItemDisabled", "isItemEnabled", "_changeItemState", "getItemText", "setItemText",
 "loadFromHTML", "hideItem", "showItem", "isItemHidden", "_changeItemVisible", "setUserData", "getUserData",
 "setOpenMode", "setWebModeTimeout", "enableDynamicLoading", "_updateLoaderIcon", "getItemImage", "setItemImage",
 "clearItemImage", "setAutoShowMode", "setAutoHideMode", "setContextMenuHideAllMode", "getContextMenuHideAllMode",
 "setVisibleArea", "setTooltip", "getTooltip", "setHotKey", "getHotKey", "setItemSelected", "setTopText", "setRTL",
 "setAlign", "setHref", "clearHref", "getCircuit", "_clearAllSelectedSubItemsInPolygon", "_checkArrowsState",
 "_addUpArrow", "_addDownArrow", "_removeUpArrow", "_removeDownArrow", "_isArrowExists", "_doScrollUp", "_doScrollDown",
 "_countPolygonItems", "setOverflowHeight", "_getRadioImgObj", "_setRadioState", "_radioOnClickHandler",
 "getRadioChecked", "setRadioChecked", "addRadioButton", "_getCheckboxState", "_setCheckboxState", "_readLevel",
 "_updateCheckboxImage", "_checkboxOnClickHandler", "setCheckboxState", "getCheckboxState", "addCheckbox", "serialize");for (var q=0;q<extMethods.length;q++)if (!this[extMethods[q]])this[extMethods[q]] = t;extMethods = null;}
 
 
 this.fixedPosition = false;this.menuSelected = -1;this.menuLastClicked = -1;this.idPrefix = "";this.itemTagName = "item";this.itemTextTagName = "itemtext";this.userDataTagName = "userdata";this.itemTipTagName = "tooltip";this.itemHotKeyTagName = "hotkey";this.itemHrefTagName = "href";this.dirTopLevel = "bottom";this.dirSubLevel = "right";this.menuX1 = null;this.menuX2 = null;this.menuY1 = null;this.menuY2 = null;this.menuMode = "web";this.menuTimeoutMsec = 400;this.menuTimeoutHandler = null;this.autoOverflow = false;this.idPull = {};this.itemPull = {};this.userData = {};this.radio = {};this._rtl = false;this._align = "left";this.menuTouched = false;this.zIndInit = 1200;this.zInd = this.zIndInit;this.zIndStep = 50;this.menuModeTopLevelTimeout = true;this.menuModeTopLevelTimeoutTime = 200;this._topLevelBottomMargin = 1;this._topLevelRightMargin = 0;this._topLevelOffsetLeft = 1;this._arrowFFFix = (_isIE?(document.compatMode=="BackCompat"?0:-4):-4);this.setSkin = function(skin) {var oldSkin = this.skin;this.skin = skin;switch (this.skin){case "dhx_black":
 case "dhx_blue":
 case "dhx_skyblue":
 case "dhx_web":
 this._topLevelBottomMargin = 2;this._topLevelRightMargin = 1;this._topLevelOffsetLeft = 1;this._arrowFFFix = (_isIE?(document.compatMode=="BackCompat"?0:-4):-4);break;case "dhx_web":
 this._arrowFFFix = 0;break;case "dhx_terrace":
 this._topLevelBottomMargin = 0;this._topLevelRightMargin = 0;this._topLevelOffsetLeft = 0;this._arrowFFFix = (_isIE?(document.compatMode=="BackCompat"?0:-4):-4);break;}
 if (this.base._autoSkinUpdate){this.base.className = this.base.className.replace("dhtmlxMenu_"+oldSkin+"_Middle", "")+" dhtmlxMenu_"+this.skin+"_Middle";}
 
 for (var a in this.idPull){this.idPull[a].className = String(this.idPull[a].className).replace(oldSkin, this.skin);}
 }
 this.setSkin(this.skin);this.dLoad = false;this.dLoadUrl = "";this.dLoadSign = "?";this.loaderIcon = false;this.limit = 0;this._scrollUpTM = null;this._scrollUpTMTime = 20;this._scrollUpTMStep = 3;this._scrollDownTM = null;this._scrollDownTMTime = 20;this._scrollDownTMStep = 3;this.context = false;this.contextZones = {};this.contextMenuZoneId = false;this.contextAutoShow = true;this.contextAutoHide = true;this.contextHideAllMode = true;this._selectedSubItems = new Array();this._openedPolygons = new Array();this._addSubItemToSelected = function(item, polygon) {var t = true;for (var q=0;q<this._selectedSubItems.length;q++){if ((this._selectedSubItems[q][0] == item)&& (this._selectedSubItems[q][1] == polygon)) {t = false;}}
 if (t == true){this._selectedSubItems.push(new Array(item, polygon));}
 return t;}
 this._removeSubItemFromSelected = function(item, polygon) {var m = new Array();var t = false;for (var q=0;q<this._selectedSubItems.length;q++){if ((this._selectedSubItems[q][0] == item)&& (this._selectedSubItems[q][1] == polygon)) {t = true;}else {m[m.length] = this._selectedSubItems[q];}}
 if (t == true){this._selectedSubItems = m;}
 return t;}
 this._getSubItemToDeselectByPolygon = function(polygon) {var m = new Array();for (var q=0;q<this._selectedSubItems.length;q++){if (this._selectedSubItems[q][1] == polygon){m[m.length] = this._selectedSubItems[q][0];m = m.concat(this._getSubItemToDeselectByPolygon(this._selectedSubItems[q][0]));var t = true;for (var w=0;w<this._openedPolygons.length;w++){if (this._openedPolygons[w] == this._selectedSubItems[q][0]){t = false;}}
 if (t == true){this._openedPolygons[this._openedPolygons.length] = this._selectedSubItems[q][0];}
 this._selectedSubItems[q][0] = -1;this._selectedSubItems[q][1] = -1;}
 }
 return m;}
 
 
 this._hidePolygon = function(id) {if (this.idPull["polygon_" + id] != null){if (typeof(this._menuEffect)!= "undefined" && this._menuEffect !== false) {this._hidePolygonEffect("polygon_"+id);}else {if (this.idPull["polygon_"+id].style.display == "none")return;this.idPull["polygon_"+id].style.display = "none";if (this.idPull["arrowup_"+id] != null){this.idPull["arrowup_"+id].style.display = "none";}
 if (this.idPull["arrowdown_"+id] != null){this.idPull["arrowdown_"+id].style.display = "none";}
 this._updateItemComplexState(id, true, false);if (this._isIE6){if (this.idPull["polygon_"+id+"_ie6cover"] != null){this.idPull["polygon_"+id+"_ie6cover"].style.display = "none";}}
 }
 
 id = String(id).replace(this.idPrefix, "");if (id == this.topId)id = null;this.callEvent("onHide", [id]);if (this.skin == "dhx_terrace" && this.itemPull[this.idPrefix+id].parent == this.idPrefix+this.topId){this._improveTerraceButton(this.idPrefix+id, true);}
 
 
 }
 }
 this._showPolygon = function(id, openType) {var itemCount = this._countVisiblePolygonItems(id);if (itemCount == 0)return;var pId = "polygon_"+id;if ((this.idPull[pId] != null)&& (this.idPull[id] != null)) {if (this.menuModeTopLevelTimeout && this.menuMode == "web" && !this.context){if (!this.idPull[id]._mouseOver && openType == this.dirTopLevel)return;}
 
 
 if (!this.fixedPosition)this._autoDetectVisibleArea();var arrUpH = 0;var arrDownH = 0;var arrowUp = null;var arrowDown = null;this.idPull[pId].style.visibility = "hidden";this.idPull[pId].style.left = "0px";this.idPull[pId].style.top = "0px";this.idPull[pId].style.display = "";this.idPull[pId].style.zIndex = this.zInd;if (this.autoOverflow){if (this.idPull[pId].firstChild.offsetHeight > this.menuY1+this.menuY2){var t0 = Math.floor((this.menuY2-this.menuY1-35)/24);this.limit = t0;}else {this.limit = 0;if (this.idPull["arrowup_"+id] != null)this._removeUpArrow(String(id).replace(this.idPrefix,""));if (this.idPull["arrowdown_"+id] != null)this._removeDownArrow(String(id).replace(this.idPrefix,""));}
 }
 
 
 if (this.limit > 0 && this.limit < itemCount){if (this.idPull["arrowup_"+id] == null)this._addUpArrow(String(id).replace(this.idPrefix,""));if (this.idPull["arrowdown_"+id] == null)this._addDownArrow(String(id).replace(this.idPrefix,""));arrowUp = this.idPull["arrowup_"+id];arrowUp.style.visibility = "hidden";arrowUp.style.display = "";arrowUp.style.zIndex = this.zInd;arrUpH = arrowUp.offsetHeight;arrowDown = this.idPull["arrowdown_"+id];arrowDown.style.visibility = "hidden";arrowDown.style.display = "";arrowDown.style.zIndex = this.zInd;arrDownH = arrowDown.offsetHeight;}
 
 
 if (this.limit > 0){if (this.limit < itemCount){this.idPull[pId].style.height = 24*this.limit+"px";this.idPull[pId].scrollTop = 0;}else {this.idPull[pId].style.height = "";}
 }
 
 this.zInd += this.zIndStep;if (this.itemPull[id] != null){var parPoly = "polygon_"+this.itemPull[id]["parent"];}else if (this.context){var parPoly = this.idPull[this.idPrefix+this.topId];}
 
 
 
 
 var srcX = (this.idPull[id].tagName != null ? getAbsoluteLeft(this.idPull[id]) : this.idPull[id][0]);var srcY = (this.idPull[id].tagName != null ? getAbsoluteTop(this.idPull[id]) : this.idPull[id][1]);var srcW = (this.idPull[id].tagName != null ? this.idPull[id].offsetWidth : 0);var srcH = (this.idPull[id].tagName != null ? this.idPull[id].offsetHeight : 0);var x = 0;var y = 0;var w = this.idPull[pId].offsetWidth;var h = this.idPull[pId].offsetHeight + arrUpH + arrDownH;if (openType == "bottom"){if (this._rtl){x = srcX + (srcW!=null?srcW:0) - w;}else {if (this._align == "right"){x = srcX + srcW - w;}else {x = srcX - 1 + (openType==this.dirTopLevel?this._topLevelRightMargin:0);}
 }
 y = srcY - 1 + srcH + this._topLevelBottomMargin;}
 if (openType == "right"){x = srcX + srcW - 1;y = srcY + 2;}
 if (openType == "left"){x = srcX - this.idPull[pId].offsetWidth + 2;y = srcY + 2;}
 if (openType == "top"){x = srcX - 1;y = srcY - h + 2;}
 
 
 if (this.fixedPosition){var mx = 65536;var my = 65536;}else {var mx = (this.menuX2!=null?this.menuX2:0);var my = (this.menuY2!=null?this.menuY2:0);if (mx == 0){if (window.innerWidth){mx = window.innerWidth;my = window.innerHeight;}else {mx = document.body.offsetWidth;my = document.body.scrollHeight;}
 }
 }
 if (x+w > mx && !this._rtl){x = srcX - w + 2;}
 if (x < this.menuX1 && this._rtl){x = srcX + srcW - 2;}
 if (x < 0){x = 0;}
 if (y+h > my && this.menuY2 != null){y = Math.max(srcY + srcH - h + 2, (this._isVisibleArea?this.menuY1+2:2));if (this.context && this.idPrefix+this.topId == id && arrowDown != null){y = y-2;}
 if (this.itemPull[id] != null && !this.context){if (this.itemPull[id]["parent"] == this.idPrefix+this.topId)y = y - this.base.offsetHeight;}
 }
 
 this.idPull[pId].style.left = x+"px";this.idPull[pId].style.top = y+arrUpH+"px";if (typeof(this._menuEffect)!= "undefined" && this._menuEffect !== false) {this._showPolygonEffect(pId);}else {this.idPull[pId].style.visibility = "";if (this.limit > 0 && this.limit < itemCount){arrowUp.style.left = x+"px";arrowUp.style.top = y+"px";arrowUp.style.width = w+this._arrowFFFix+"px";arrowUp.style.visibility = "";arrowDown.style.left = x+"px";arrowDown.style.top = y+h-arrDownH+"px";arrowDown.style.width = w+this._arrowFFFix+"px";arrowDown.style.visibility = "";this._checkArrowsState(id);}
 
 
 if (this._isIE6){var pIdIE6 = pId+"_ie6cover";if (this.idPull[pIdIE6] == null){var ifr = document.createElement("IFRAME");ifr.className = "dhtmlxMenu_IE6CoverFix_"+this.skin;ifr.frameBorder = 0;ifr.setAttribute("src", "javascript:false;");document.body.insertBefore(ifr, document.body.firstChild);this.idPull[pIdIE6] = ifr;}
 this.idPull[pIdIE6].style.left = x+"px";this.idPull[pIdIE6].style.top = y+"px";this.idPull[pIdIE6].style.width = w+"px";this.idPull[pIdIE6].style.height = h+"px";this.idPull[pIdIE6].style.zIndex = this.idPull[pId].style.zIndex-1;this.idPull[pIdIE6].style.display = "";}
 }
 
 id = String(id).replace(this.idPrefix, "");if (id == this.topId)id = null;this.callEvent("onShow", [id]);if (this.skin == "dhx_terrace" && this.itemPull[this.idPrefix+id].parent == this.idPrefix+this.topId){this._improveTerraceButton(this.idPrefix+id, false);}
 
 
 }
 }
 
 this._redistribSubLevelSelection = function(id, parentId) {while (this._openedPolygons.length > 0)this._openedPolygons.pop();var i = this._getSubItemToDeselectByPolygon(parentId);this._removeSubItemFromSelected(-1, -1);for (var q=0;q<i.length;q++){if ((this.idPull[i[q]] != null)&& (i[q] != id)) {if (this.itemPull[i[q]]["state"] == "enabled"){this.idPull[i[q]].className = "sub_item";}}}
 
 for (var q=0;q<this._openedPolygons.length;q++){if (this._openedPolygons[q] != parentId){this._hidePolygon(this._openedPolygons[q]);}}
 
 if (this.itemPull[id]["state"] == "enabled"){this.idPull[id].className = "sub_item_selected";if (this.itemPull[id]["complex"] && this.dLoad && (this.itemPull[id]["loaded"]=="no")) {if (this.loaderIcon == true){this._updateLoaderIcon(id, true);}
 var xmlLoader = new dtmlXMLLoaderObject(this._xmlParser, window);this.itemPull[id]["loaded"] = "get";this.callEvent("onXLS", []);xmlLoader.loadXML(this.dLoadUrl+this.dLoadSign+"action=loadMenu&parentId="+id.replace(this.idPrefix,"")+"&etc="+new Date().getTime());}
 
 if (this.itemPull[id]["complex"] || (this.dLoad && (this.itemPull[id]["loaded"] == "yes"))) {if ((this.itemPull[id]["complex"])&& (this.idPull["polygon_" + id] != null)) {this._updateItemComplexState(id, true, true);this._showPolygon(id, this.dirSubLevel);}
 }
 this._addSubItemToSelected(id, parentId);this.menuSelected = id;}
 }
 
 this._doOnClick = function(id, type, casState) {this.menuLastClicked = id;if (this.itemPull[this.idPrefix+id]["href_link"] != null && this.itemPull[this.idPrefix+id].state == "enabled"){var form = document.createElement("FORM");var k = String(this.itemPull[this.idPrefix+id]["href_link"]).split("?");form.action = k[0];if (k[1] != null){var p = String(k[1]).split("&");for (var q=0;q<p.length;q++){var j = String(p[q]).split("=");var m = document.createElement("INPUT");m.type = "hidden";m.name = (j[0]||"");m.value = (j[1]||"");form.appendChild(m);}
 }
 if (this.itemPull[this.idPrefix+id]["href_target"] != null){form.target = this.itemPull[this.idPrefix+id]["href_target"];}
 form.style.display = "none";document.body.appendChild(form);form.submit();if (form != null){document.body.removeChild(form);form = null;}
 return;}
 
 
 if (type.charAt(0)=="c") return;if (type.charAt(1)=="d") return;if (type.charAt(2)=="s") return;if (this.checkEvent("onClick")) {this.callEvent("onClick", [id, this.contextMenuZoneId, casState]);}else {if ((type.charAt(1)== "d") || (this.menuMode == "win" && type.charAt(2) == "t")) return;}
 if (this.context && this._isContextMenuVisible()&& this.contextAutoHide) {this._hideContextMenu();}else {if (this._clearAndHide)this._clearAndHide();}
 }
 
 this._doOnTouchMenu = function(id) {if (this.menuTouched == false){this.menuTouched = true;if (this.checkEvent("onTouch")) {this.callEvent("onTouch", [id]);}
 }
 }
 
 
 
 this._searchMenuNode = function(node, menu) {var m = new Array();for (var q=0;q<menu.length;q++){if (typeof(menu[q])== "object") {if (menu[q].length == 5){if (typeof(menu[q][0])!= "object") {if ((menu[q][0].replace(this.idPrefix, "")== node) && (q == 0)) {m = menu;}}}
 var j = this._searchMenuNode(node, menu[q]);if (j.length > 0){m = j;}
 }
 }
 return m;}
 
 
 this._getMenuNodes = function(node) {var m = new Array;for (var a in this.itemPull){if (this.itemPull[a]["parent"] == node){m[m.length] = a;}}
 return m;}
 
 this._genStr = function(w) {var s = "";var z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";for (var q=0;q<w;q++)s += z.charAt(Math.round(Math.random() * (z.length-1)));return s;}
 
 this.getItemType = function(id) {id = this.idPrefix+id;if (this.itemPull[id] == null){return null;}
 return this.itemPull[id]["type"];}
 
 this.forEachItem = function(handler) {for (var a in this.itemPull){handler(String(a).replace(this.idPrefix, ""));}
 }
 
 this._clearAndHide = function() {main_self.menuSelected = -1;main_self.menuLastClicked = -1;while (main_self._openedPolygons.length > 0){main_self._openedPolygons.pop();}
 for (var q=0;q<main_self._selectedSubItems.length;q++){var id = main_self._selectedSubItems[q][0];if (main_self.idPull[id] != null){if (main_self.itemPull[id]["state"] == "enabled"){if (main_self.idPull[id].className == "sub_item_selected")main_self.idPull[id].className = "sub_item";if (main_self.idPull[id].className == "dhtmlxMenu_"+main_self.skin+"_TopLevel_Item_Selected"){if (main_self.itemPull[id]["cssNormal"] != null){main_self.idPull[id].className = main_self.itemPull[id]["cssNormal"];}else {main_self.idPull[id].className = "dhtmlxMenu_"+main_self.skin+"_TopLevel_Item_Normal";}
 }
 }
 }
 main_self._hidePolygon(id);}
 
 
 main_self.menuTouched = false;if (main_self.context){if (main_self.contextHideAllMode){main_self._hidePolygon(main_self.idPrefix+main_self.topId);main_self.zInd = main_self.zIndInit;}else {main_self.zInd = main_self.zIndInit+main_self.zIndStep;}
 }
 }
 
 this._doOnLoad = function() {}
 
 this.loadXML = function(xmlFile, onLoadFunction) {if (onLoadFunction)this._doOnLoad = function() {onLoadFunction();};this.callEvent("onXLS", []);this._xmlLoader.loadXML(xmlFile);}
 
 this.loadXMLString = function(xmlString, onLoadFunction) {if (onLoadFunction)this._doOnLoad = function() {onLoadFunction();};this._xmlLoader.loadXMLString(xmlString);}
 this._buildMenu = function(t, parentId) {var u = 0;for (var q=0;q<t.childNodes.length;q++){if (t.childNodes[q].tagName == this.itemTagName){var r = t.childNodes[q];var item = {};item["id"] = this.idPrefix+(r.getAttribute("id")||this._genStr(24));item["title"] = r.getAttribute("text")||"";item["imgen"] = r.getAttribute("img")||"";item["imgdis"] = r.getAttribute("imgdis")||"";item["tip"] = "";item["hotkey"] = "";if (r.getAttribute("cssNormal")!= null) {item["cssNormal"] = r.getAttribute("cssNormal");}
 
 item["type"] = r.getAttribute("type")||"item";if (item["type"] == "checkbox"){item["checked"] = (r.getAttribute("checked")!=null);item["imgen"] = "chbx_"+(item["checked"]?"1":"0");item["imgdis"] = item["imgen"];}
 if (item["type"] == "radio"){item["checked"] = (r.getAttribute("checked")!=null);item["imgen"] = "rdbt_"+(item["checked"]?"1":"0");item["imgdis"] = item["imgen"];item["group"] = r.getAttribute("group")||this._genStr(24);if (this.radio[item["group"]]==null){this.radio[item["group"]] = new Array();}
 this.radio[item["group"]][this.radio[item["group"]].length] = item["id"];}
 
 item["state"] = (r.getAttribute("enabled")!=null||r.getAttribute("disabled")!=null?(r.getAttribute("enabled")=="false"||r.getAttribute("disabled")=="true"?"disabled":"enabled"):"enabled");item["parent"] = (parentId!=null?parentId:this.idPrefix+this.topId);item["complex"] = (this.dLoad?(r.getAttribute("complex")!=null?true:false):(this._buildMenu(r,item["id"])>0));if (this.dLoad && item["complex"]){item["loaded"] = "no";}
 this.itemPull[item["id"]] = item;for (var w=0;w<r.childNodes.length;w++){var tagNm = r.childNodes[w].tagName;if (tagNm != null){tagNm = tagNm.toLowerCase();}
 
 if (tagNm == this.userDataTagName){var d = r.childNodes[w];if (d.getAttribute("name")!=null) {this.userData[item["id"]+"_"+d.getAttribute("name")] = (d.firstChild!=null&&d.firstChild.nodeValue!=null?d.firstChild.nodeValue:"");}
 }
 
 if (tagNm == this.itemTextTagName){item["title"] = r.childNodes[w].firstChild.nodeValue;}
 
 if (tagNm == this.itemTipTagName){item["tip"] = r.childNodes[w].firstChild.nodeValue;}
 
 if (tagNm == this.itemHotKeyTagName){item["hotkey"] = r.childNodes[w].firstChild.nodeValue;}
 
 if (tagNm == this.itemHrefTagName && item["type"] == "item"){item["href_link"] = r.childNodes[w].firstChild.nodeValue;if (r.childNodes[w].getAttribute("target")!= null) {item["href_target"] = r.childNodes[w].getAttribute("target");}
 }
 }
 u++;}
 }
 return u;}
 
 this._xmlParser = function() {if (main_self.dLoad){var t = this.getXMLTopNode("menu");parentId = (t.getAttribute("parentId")!=null?t.getAttribute("parentId"):null);if (parentId == null){main_self._buildMenu(t, null);main_self._initTopLevelMenu();}else {main_self._buildMenu(t, main_self.idPrefix+parentId);main_self._addSubMenuPolygon(main_self.idPrefix+parentId, main_self.idPrefix+parentId);if (main_self.menuSelected == main_self.idPrefix+parentId){var pId = main_self.idPrefix+parentId;var isTop = main_self.itemPull[main_self.idPrefix+parentId]["parent"]==main_self.idPrefix+main_self.topId;var level = ((isTop&&(!main_self.context))?main_self.dirTopLevel:main_self.dirSubLevel);var isShow = false;if (isTop && main_self.menuModeTopLevelTimeout && main_self.menuMode == "web" && !main_self.context){var item = main_self.idPull[main_self.idPrefix+parentId];if (item._mouseOver == true){var delay = main_self.menuModeTopLevelTimeoutTime - (new Date().getTime()-item._dynLoadTM);if (delay > 1){item._menuOpenTM = window.setTimeout(function(){main_self._showPolygon(pId, level);}, delay);isShow = true;}
 }
 }
 if (!isShow){main_self._showPolygon(pId, level);}
 }
 main_self.itemPull[main_self.idPrefix+parentId]["loaded"] = "yes";if (main_self.loaderIcon == true){main_self._updateLoaderIcon(main_self.idPrefix+parentId, false);}
 }
 this.destructor();main_self.callEvent("onXLE",[]);}else {var t = this.getXMLTopNode("menu");main_self._buildMenu(t, null);main_self.init();main_self.callEvent("onXLE",[]);main_self._doOnLoad();}
 }
 this._xmlLoader = new dtmlXMLLoaderObject(this._xmlParser, window);this._showSubLevelItem = function(id,back) {if (document.getElementById("arrow_" + this.idPrefix + id)!= null) {document.getElementById("arrow_" + this.idPrefix + id).style.display = (back?"none":"");}
 if (document.getElementById("image_" + this.idPrefix + id)!= null) {document.getElementById("image_" + this.idPrefix + id).style.display = (back?"none":"");}
 if (document.getElementById(this.idPrefix + id)!= null) {document.getElementById(this.idPrefix + id).style.display = (back?"":"none");}
 }
 
 this._hideSubLevelItem = function(id) {this._showSubLevelItem(id,true)
 }
 
 this.idPrefix = this._genStr(12);this._bodyClick = function(e) {e = e||event;if (e.button == 2 || (_isOpera && e.ctrlKey == true)) return;if (main_self.context){if (main_self.contextAutoHide && (!_isOpera || (main_self._isContextMenuVisible()&& _isOpera))) main_self._hideContextMenu();}else {if (main_self._clearAndHide)main_self._clearAndHide();}
 }
 this._bodyContext = function(e) {e = e||event;var t = (e.srcElement||e.target).className;if (t.search("dhtmlxMenu")!= -1 && t.search("SubLevelArea") != -1) return;var toHide = true;var testZone = e.target || e.srcElement;while (testZone != null){if (testZone.id != null)if (main_self.isContextZone(testZone.id)) toHide = false;if (testZone == document.body)toHide = false;testZone = testZone.parentNode;}
 if (toHide)main_self.hideContextMenu();}
 
 if (_isIE){document.body.attachEvent("onclick", this._bodyClick);document.body.attachEvent("oncontextmenu", this._bodyContext);}else {window.addEventListener("click", this._bodyClick, false);window.addEventListener("contextmenu", this._bodyContext, false);}
 
 
 this._UID = this._genStr(32);dhtmlxMenuObjectLiveInstances[this._UID] = this;dhtmlxEventable(this);return this;}
dhtmlXMenuObject.prototype.init = function() {if (this._isInited == true)return;if (this.dLoad){this.callEvent("onXLS", []);this._xmlLoader.loadXML(this.dLoadUrl+this.dLoadSign+"action=loadMenu&etc="+new Date().getTime());}else {this._initTopLevelMenu();this._isInited = true;}
}
dhtmlXMenuObject.prototype._countVisiblePolygonItems = function(id) {var count = 0;for (var a in this.itemPull){var par = this.itemPull[a]["parent"];var tp = this.itemPull[a]["type"];if (this.idPull[a] != null){if (par == id && (tp == "item" || tp == "radio" || tp == "checkbox")&& this.idPull[a].style.display != "none") {count++;}
 }
 }
 return count;}
dhtmlXMenuObject.prototype._redefineComplexState = function(id) {if (this.idPrefix+this.topId == id){return;}
 if ((this.idPull["polygon_"+id] != null)&& (this.idPull[id] != null)) {var u = this._countVisiblePolygonItems(id);if ((u > 0)&& (!this.itemPull[id]["complex"])) {this._updateItemComplexState(id, true, false);}
 if ((u == 0)&& (this.itemPull[id]["complex"])) {this._updateItemComplexState(id, false, false);}
 }
}
dhtmlXMenuObject.prototype._updateItemComplexState = function(id, state, over) {if ((!this.context)&& (this._getItemLevelType(id.replace(this.idPrefix,"")) == "TopLevel")) {this.itemPull[id]["complex"] = state;return;}
 if ((this.idPull[id] == null)|| (this.itemPull[id] == null)) {return;}
 
 this.itemPull[id]["complex"] = state;if (id == this.idPrefix+this.topId)return;var arrowObj = null;var item = this.idPull[id].childNodes[this._rtl?0:2];if (item.childNodes[0])if (String(item.childNodes[0].className).search("complex_arrow") === 0) arrowObj = item.childNodes[0];if (this.itemPull[id]["complex"]){if (arrowObj == null){arrowObj = document.createElement("DIV");arrowObj.className = "complex_arrow";arrowObj.id = "arrow_"+id;while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.appendChild(arrowObj);}
 
 
 if (this.dLoad && (this.itemPull[id]["loaded"] == "get")&& this.loaderIcon) {if (arrowObj.className != "complex_arrow_loading")arrowObj.className = "complex_arrow_loading";}else {arrowObj.className = "complex_arrow";}
 
 return;}
 
 if ((!this.itemPull[id]["complex"])&& (arrowObj!=null)) {item.removeChild(arrowObj);if (this.itemPull[id]["hotkey_backup"] != null && this.setHotKey){this.setHotKey(id.replace(this.idPrefix, ""), this.itemPull[id]["hotkey_backup"]);}
 }
 
}
dhtmlXMenuObject.prototype._getItemLevelType = function(id) {return (this.itemPull[this.idPrefix+id]["parent"]==this.idPrefix+this.topId?"TopLevel":"SubLevelArea");}
dhtmlXMenuObject.prototype._redistribTopLevelSelection = function(id, parent) {var i = this._getSubItemToDeselectByPolygon("parent");this._removeSubItemFromSelected(-1, -1);for (var q=0;q<i.length;q++){if (i[q] != id){this._hidePolygon(i[q]);}
 if ((this.idPull[i[q]] != null)&& (i[q] != id)) {this.idPull[i[q]].className = this.idPull[i[q]].className.replace(/Selected/g, "Normal");}
 }
 
 if (this.itemPull[this.idPrefix+id]["state"] == "enabled"){this.idPull[this.idPrefix+id].className = "dhtmlxMenu_"+this.skin+"_TopLevel_Item_Selected";this._addSubItemToSelected(this.idPrefix+id, "parent");this.menuSelected = (this.menuMode=="win"?(this.menuSelected!=-1?id:this.menuSelected):id);if ((this.itemPull[this.idPrefix+id]["complex"])&& (this.menuSelected != -1)) {this._showPolygon(this.idPrefix+id, this.dirTopLevel);}
 }
}
dhtmlXMenuObject.prototype._initTopLevelMenu = function() {this.dirTopLevel = "bottom";this.dirSubLevel = (this._rtl?"left":"right");if (this.context){this.idPull[this.idPrefix+this.topId] = new Array(0,0);this._addSubMenuPolygon(this.idPrefix+this.topId, this.idPrefix+this.topId);}else {var m = this._getMenuNodes(this.idPrefix + this.topId);for (var q=0;q<m.length;q++){if (this.itemPull[m[q]]["type"] == "item")this._renderToplevelItem(m[q], null);if (this.itemPull[m[q]]["type"] == "separator")this._renderSeparator(m[q], null);}
 }
}
dhtmlXMenuObject.prototype._renderToplevelItem = function(id, pos) {var main_self = this;var m = document.createElement("DIV");m.id = id;if (this.itemPull[id]["state"] == "enabled" && this.itemPull[id]["cssNormal"] != null){m.className = this.itemPull[id]["cssNormal"];}else {m.className = "dhtmlxMenu_"+this.skin+"_TopLevel_Item_"+(this.itemPull[id]["state"]=="enabled"?"Normal":"Disabled");}
 
 
 if (this.itemPull[id]["title"] != ""){var t1 = document.createElement("DIV");t1.className = "top_level_text";t1.innerHTML = this.itemPull[id]["title"];m.appendChild(t1);}
 
 if (this.itemPull[id]["tip"].length > 0)m.title = this.itemPull[id]["tip"];if ((this.itemPull[id]["imgen"]!="")||(this.itemPull[id]["imgdis"]!="")) {var imgTop=this.itemPull[id][(this.itemPull[id]["state"]=="enabled")?"imgen":"imgdis"];if (imgTop){var img = document.createElement("IMG");img.border = "0";img.id = "image_"+id;img.src= this.imagePath+imgTop;img.className = "dhtmlxMenu_TopLevel_Item_Icon";if (m.childNodes.length > 0 && !this._rtl)m.insertBefore(img, m.childNodes[0]);else m.appendChild(img);}
 }
 m.onselectstart = function(e) {e = e || event;e.returnValue = false;return false;}
 m.oncontextmenu = function(e) {e = e || event;e.returnValue = false;return false;}
 
 if (!this.cont){this.cont = document.createElement("DIV");this.cont.dir = "ltr";this.cont.className = (this._align=="right"?"align_right":"align_left");this.base.appendChild(this.cont);}
 
 
 if (pos != null){pos++;if (pos < 0)pos = 0;if (pos > this.cont.childNodes.length - 1)pos = null;}
 if (pos != null)this.cont.insertBefore(m, this.cont.childNodes[pos]);else this.cont.appendChild(m);this.idPull[m.id] = m;if (this.itemPull[id]["complex"] && (!this.dLoad)) this._addSubMenuPolygon(this.itemPull[id]["id"], this.itemPull[id]["id"]);m.onmouseover = function() {if (main_self.menuMode == "web"){window.clearTimeout(main_self.menuTimeoutHandler);}
 
 var i = main_self._getSubItemToDeselectByPolygon("parent");main_self._removeSubItemFromSelected(-1, -1);for (var q=0;q<i.length;q++){if (i[q] != this.id){main_self._hidePolygon(i[q]);}
 if ((main_self.idPull[i[q]] != null)&& (i[q] != this.id)) {if (main_self.itemPull[i[q]]["cssNormal"] != null){main_self.idPull[i[q]].className = main_self.itemPull[i[q]]["cssNormal"];}else {if (main_self.idPull[i[q]].className == "sub_item_selected")main_self.idPull[i[q]].className = "sub_item";main_self.idPull[i[q]].className = main_self.idPull[i[q]].className.replace(/Selected/g, "Normal");}
 }
 }
 
 if (main_self.itemPull[this.id]["state"] == "enabled"){this.className = "dhtmlxMenu_"+main_self.skin+"_TopLevel_Item_Selected";main_self._addSubItemToSelected(this.id, "parent");main_self.menuSelected = (main_self.menuMode=="win"?(main_self.menuSelected!=-1?this.id:main_self.menuSelected):this.id);if (main_self.dLoad && (main_self.itemPull[this.id]["loaded"]=="no")) {if (main_self.menuModeTopLevelTimeout && main_self.menuMode == "web" && !main_self.context){this._mouseOver = true;this._dynLoadTM = new Date().getTime();}
 var xmlLoader = new dtmlXMLLoaderObject(main_self._xmlParser, window);main_self.itemPull[this.id]["loaded"] = "get";main_self.callEvent("onXLS", []);xmlLoader.loadXML(main_self.dLoadUrl+main_self.dLoadSign+"action=loadMenu&parentId="+this.id.replace(main_self.idPrefix,"")+"&etc="+new Date().getTime());}
 if ((!main_self.dLoad)|| (main_self.dLoad && (!main_self.itemPull[this.id]["loaded"] || main_self.itemPull[this.id]["loaded"]=="yes"))) {if ((main_self.itemPull[this.id]["complex"])&& (main_self.menuSelected != -1)) {if (main_self.menuModeTopLevelTimeout && main_self.menuMode == "web" && !main_self.context){this._mouseOver = true;var showItemId = this.id;this._menuOpenTM = window.setTimeout(function(){main_self._showPolygon(showItemId, main_self.dirTopLevel);}, main_self.menuModeTopLevelTimeoutTime);}else {main_self._showPolygon(this.id, main_self.dirTopLevel);}
 }
 }
 }
 main_self._doOnTouchMenu(this.id.replace(main_self.idPrefix, ""));}
 m.onmouseout = function() {if (!((main_self.itemPull[this.id]["complex"])&& (main_self.menuSelected != -1)) && (main_self.itemPull[this.id]["state"]=="enabled")) {if (main_self.itemPull[this.id]["cssNormal"] != null){m.className = main_self.itemPull[this.id]["cssNormal"];}else {m.className = "dhtmlxMenu_"+main_self.skin+"_TopLevel_Item_Normal";}
 }
 if (main_self.menuMode == "web"){window.clearTimeout(main_self.menuTimeoutHandler);main_self.menuTimeoutHandler = window.setTimeout(function(){main_self._clearAndHide();}, main_self.menuTimeoutMsec, "JavaScript");}
 if (main_self.menuModeTopLevelTimeout && main_self.menuMode == "web" && !main_self.context){this._mouseOver = false;window.clearTimeout(this._menuOpenTM);}
 }
 m.onclick = function(e) {if (main_self.menuMode == "web"){window.clearTimeout(main_self.menuTimeoutHandler);}
 
 if (main_self.menuMode != "web" && main_self.itemPull[this.id]["state"] == "disabled"){return;}
 
 e = e || event;e.cancelBubble = true;e.returnValue = false;if (main_self.menuMode == "win"){if (main_self.itemPull[this.id]["complex"]){if (main_self.menuSelected == this.id){main_self.menuSelected = -1;var s = false;}else {main_self.menuSelected = this.id;var s = true;}
 if (s){main_self._showPolygon(this.id, main_self.dirTopLevel);}else {main_self._hidePolygon(this.id);}
 }
 }
 var tc = (main_self.itemPull[this.id]["complex"]?"c":"-");var td = (main_self.itemPull[this.id]["state"]!="enabled"?"d":"-");var cas = {"ctrl": e.ctrlKey, "alt": e.altKey, "shift": e.shiftKey};main_self._doOnClick(this.id.replace(main_self.idPrefix, ""), tc+td+"t", cas);return false;}
 
 if (this.skin == "dhx_terrace"){this._improveTerraceSkin();}
}
dhtmlXMenuObject.prototype.setImagePath = function() {}
dhtmlXMenuObject.prototype.setIconsPath = function(path) {this.imagePath = path;}
dhtmlXMenuObject.prototype.setIconPath = dhtmlXMenuObject.prototype.setIconsPath;dhtmlXMenuObject.prototype._updateItemImage = function(id, levelType) {id = this.idPrefix+id;var isTopLevel = (this.itemPull[id]["parent"] == this.idPrefix+this.topId && !this.context);var imgObj = null;if (isTopLevel){for (var q=0;q<this.idPull[id].childNodes.length;q++){try {if (this.idPull[id].childNodes[q].className == "dhtmlxMenu_TopLevel_Item_Icon")imgObj = this.idPull[id].childNodes[q];}catch(e) {}
 }
 }else {try {var imgObj = this.idPull[id].childNodes[this._rtl?2:0].childNodes[0];}catch(e) {}
 }
 
 if (this.itemPull[id]["type"] == "radio"){var imgSrc = this.itemPull[id][(this.itemPull[id]["state"]=="enabled"?"imgen":"imgdis")];}else {var imgSrc = this.itemPull[id][(this.itemPull[id]["state"]=="enabled"?"imgen":"imgdis")];}
 
 if (imgSrc.length > 0){if (imgObj != null){imgObj.src = this.imagePath+imgSrc;}else {if (isTopLevel){var imgObj = document.createElement("IMG");imgObj.className = "dhtmlxMenu_TopLevel_Item_Icon";imgObj.src = this.imagePath+imgSrc;imgObj.border = "0";imgObj.id = "image_"+id;if (!this._rtl && this.idPull[id].childNodes.length > 0)this.idPull[id].insertBefore(imgObj,this.idPull[id].childNodes[0]);else this.idPull[id].appendChild(imgObj);}else {var imgObj = document.createElement("IMG");imgObj.className = "sub_icon";imgObj.src = this.imagePath+imgSrc;imgObj.border = "0";imgObj.id = "image_"+id;var item = this.idPull[id].childNodes[this._rtl?2:0];while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.appendChild(imgObj);}
 }
 }else {if (imgObj != null)imgObj.parentNode.removeChild(imgObj);}
}
dhtmlXMenuObject.prototype.removeItem = function(id, _isTId, _recCall) {if (!_isTId)id = this.idPrefix + id;var pId = null;if (id != this.idPrefix+this.topId){if (this.itemPull[id] == null)return;if (this.idPull["polygon_"+id] && this.idPull["polygon_"+id]._tmShow)window.clearTimeout(this.idPull["polygon_"+id]._tmShow);var t = this.itemPull[id]["type"];if (t == "separator"){var item = this.idPull["separator_"+id];if (this.itemPull[id]["parent"] == this.idPrefix+this.topId){item.onclick = null;item.onselectstart = null;item.id = null;item.parentNode.removeChild(item);}else {item.childNodes[0].childNodes[0].onclick = null;item.childNodes[0].childNodes[0].onselectstart = null;item.childNodes[0].childNodes[0].id = null;item.childNodes[0].removeChild(item.childNodes[0].childNodes[0]);item.removeChild(item.childNodes[0]);item.parentNode.removeChild(item);}
 this.idPull["separator_"+id] = null;this.itemPull[id] = null;delete this.idPull["separator_"+id];delete this.itemPull[id];item = null;}else {pId = this.itemPull[id]["parent"];var item = this.idPull[id];item.onclick = null;item.oncontextmenu = null;item.onmouseover = null;item.onmouseout = null;item.onselectstart = null;item.id = null;while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.parentNode.removeChild(item);this.idPull[id] = null;this.itemPull[id] = null;delete this.idPull[id];delete this.itemPull[id];item = null;}
 t = null;}
 
 
 for (var a in this.itemPull)if (this.itemPull[a]["parent"] == id)this.removeItem(a, true, true);var p2 = new Array(id);if (pId != null && !_recCall){if (this.idPull["polygon_"+pId] != null){if (this.idPull["polygon_"+pId].tbd.childNodes.length == 0){p2.push(pId);this._updateItemComplexState(pId, false, false);}
 }
 }
 
 
 for (var q=0;q<p2.length;q++){if (this.idPull["polygon_"+p2[q]]){var p = this.idPull["polygon_"+p2[q]];p.onclick = null;p.oncontextmenu = null;p.tbl.removeChild(p.tbd);p.tbd = null;p.removeChild(p.tbl);p.tbl = null;p.id = null;p.parentNode.removeChild(p);p = null;if (this._isIE6){var pc = "polygon_"+p2[q]+"_ie6cover";if (this.idPull[pc] != null){document.body.removeChild(this.idPull[pc]);delete this.idPull[pc];}
 }
 if (this.idPull["arrowup_"+id] != null && this._removeArrow)this._removeArrow("arrowup_"+id);if (this.idPull["arrowdown_"+id] != null && this._removeArrow)this._removeArrow("arrowdown_"+id);this.idPull["polygon_"+p2[q]] = null;delete this.idPull["polygon_"+p2[q]];}
 }
 p2 = null;if (this.skin == "dhx_terrace" && arguments.length == 1)this._improveTerraceSkin();}
dhtmlXMenuObject.prototype._getAllParents = function(id) {var parents = new Array();for (var a in this.itemPull){if (this.itemPull[a]["parent"] == id){parents[parents.length] = this.itemPull[a]["id"];if (this.itemPull[a]["complex"]){var t = this._getAllParents(this.itemPull[a]["id"]);for (var q=0;q<t.length;q++){parents[parents.length] = t[q];}
 }
 }
 }
 return parents;}
 




dhtmlXMenuObject.prototype.renderAsContextMenu = function() {this.context = true;if (this.base._autoSkinUpdate == true){this.base.className = this.base.className.replace("dhtmlxMenu_"+this.skin+"_Middle","");this.base._autoSkinUpdate = false;}
 if (this.addBaseIdAsContextZone != null){this.addContextZone(this.addBaseIdAsContextZone);}
}
dhtmlXMenuObject.prototype.addContextZone = function(zoneId) {if (zoneId == document.body){zoneId = "document.body."+this.idPrefix;var zone = document.body;}else {var zone = document.getElementById(zoneId);}
 var zoneExists = false;for (var a in this.contextZones){zoneExists = zoneExists || (a == zoneId) || (this.contextZones[a] == zone);}
 if (zoneExists == true)return false;this.contextZones[zoneId] = zone;var main_self = this;if (_isOpera){this.operaContext = function(e){main_self._doOnContextMenuOpera(e, main_self);}
 zone.addEventListener("mouseup", this.operaContext, false);}else {if (zone.oncontextmenu != null && !zone._oldContextMenuHandler)zone._oldContextMenuHandler = zone.oncontextmenu;zone.oncontextmenu = function(e) {for (var q in dhtmlxMenuObjectLiveInstances){if (q != main_self._UID){if (dhtmlxMenuObjectLiveInstances[q].context){dhtmlxMenuObjectLiveInstances[q]._hideContextMenu();}
 }
 }
 
 e = e||event;e.cancelBubble = true;e.returnValue = false;main_self._doOnContextBeforeCall(e, this);return false;}
 }
}
dhtmlXMenuObject.prototype._doOnContextMenuOpera = function(e, main_self) {for (var q in dhtmlxMenuObjectLiveInstances){if (q != main_self._UID){if (dhtmlxMenuObjectLiveInstances[q].context){dhtmlxMenuObjectLiveInstances[q]._hideContextMenu();}
 }
 }
 
 e.cancelBubble = true;e.returnValue = false;if (e.button == 0 && e.ctrlKey == true){main_self._doOnContextBeforeCall(e, this);}
 return false;}
dhtmlXMenuObject.prototype.removeContextZone = function(zoneId) {if (!this.isContextZone(zoneId)) return false;if (zoneId == document.body)zoneId = "document.body."+this.idPrefix;var zone = this.contextZones[zoneId];if (_isOpera){zone.removeEventListener("mouseup", this.operaContext, false);}else {zone.oncontextmenu = (zone._oldContextMenuHandler!=null?zone._oldContextMenuHandler:null);zone._oldContextMenuHandler = null;}
 try {this.contextZones[zoneId] = null;delete this.contextZones[zoneId];}catch(e){}
 return true;}
dhtmlXMenuObject.prototype.isContextZone = function(zoneId) {if (zoneId == document.body && this.contextZones["document.body."+this.idPrefix] != null)return true;var isZone = false;if (this.contextZones[zoneId] != null){if (this.contextZones[zoneId] == document.getElementById(zoneId)) isZone = true;}
 return isZone;}
dhtmlXMenuObject.prototype._isContextMenuVisible = function() {if (this.idPull["polygon_"+this.idPrefix+this.topId] == null)return false;return (this.idPull["polygon_"+this.idPrefix+this.topId].style.display == "");}
dhtmlXMenuObject.prototype._showContextMenu = function(x, y, zoneId) {this._clearAndHide();if (this.idPull["polygon_"+this.idPrefix+this.topId] == null)return false;window.clearTimeout(this.menuTimeoutHandler);this.idPull[this.idPrefix+this.topId] = new Array(x, y);this._showPolygon(this.idPrefix+this.topId, "bottom");this.callEvent("onContextMenu", [zoneId]);}
dhtmlXMenuObject.prototype._hideContextMenu = function() {if (this.idPull["polygon_"+this.idPrefix+this.topId] == null)return false;this._clearAndHide();this._hidePolygon(this.idPrefix+this.topId);this.zInd = this.zIndInit;}
dhtmlXMenuObject.prototype._doOnContextBeforeCall = function(e, cZone) {this.contextMenuZoneId = cZone.id;this._clearAndHide();this._hideContextMenu();var p = (e.srcElement||e.target);var px = (_isIE||_isOpera||_KHTMLrv?e.offsetX:e.layerX);var py = (_isIE||_isOpera||_KHTMLrv?e.offsetY:e.layerY);var mx = getAbsoluteLeft(p)+px;var my = getAbsoluteTop(p)+py;if (this.checkEvent("onBeforeContextMenu")) {if (this.callEvent("onBeforeContextMenu", [cZone.id,e])) {if (this.contextAutoShow){this._showContextMenu(mx, my);this.callEvent("onAfterContextMenu", [cZone.id,e]);}
 }
 }else {if (this.contextAutoShow){this._showContextMenu(mx, my);this.callEvent("onAfterContextMenu", [cZone.id]);}
 }
}
dhtmlXMenuObject.prototype.showContextMenu = function(x, y) {this._showContextMenu(x, y, false);}
dhtmlXMenuObject.prototype.hideContextMenu = function() {this._hideContextMenu();}
dhtmlXMenuObject.prototype._autoDetectVisibleArea = function() {if (this._isVisibleArea)return;this.menuX1 = document.body.scrollLeft;this.menuX2 = this.menuX1+(window.innerWidth||document.body.clientWidth);this.menuY1 = Math.max((_isIE?document.documentElement:document.getElementsByTagName("html")[0]).scrollTop, document.body.scrollTop);this.menuY2 = this.menuY1+(_isIE?Math.max(document.documentElement.clientHeight||0,document.documentElement.offsetHeight||0,document.body.clientHeight||0):window.innerHeight);}
dhtmlXMenuObject.prototype.getItemPosition = function(id) {id = this.idPrefix+id;var pos = -1;if (this.itemPull[id] == null)return pos;var parent = this.itemPull[id]["parent"];var obj = (this.idPull["polygon_"+parent]!=null?this.idPull["polygon_"+parent].tbd:this.cont);for (var q=0;q<obj.childNodes.length;q++){if (obj.childNodes[q]==this.idPull["separator_"+id]||obj.childNodes[q]==this.idPull[id]){pos = q;}}
 return pos;}
dhtmlXMenuObject.prototype.setItemPosition = function(id, pos) {id = this.idPrefix+id;if (this.idPull[id] == null){return;}
 
 var isOnTopLevel = (this.itemPull[id]["parent"] == this.idPrefix+this.topId);var itemData = this.idPull[id];var itemPos = this.getItemPosition(id.replace(this.idPrefix,""));var parent = this.itemPull[id]["parent"];var obj = (this.idPull["polygon_"+parent]!=null?this.idPull["polygon_"+parent].tbd:this.cont);obj.removeChild(obj.childNodes[itemPos]);if (pos < 0)pos = 0;if (isOnTopLevel && pos < 1){pos = 1;}
 
 if (pos < obj.childNodes.length){obj.insertBefore(itemData, obj.childNodes[pos]);}else {obj.appendChild(itemData);}
}
dhtmlXMenuObject.prototype.getParentId = function(id) {id = this.idPrefix+id;if (this.itemPull[id] == null){return null;}
 return ((this.itemPull[id]["parent"]!=null?this.itemPull[id]["parent"]:this.topId).replace(this.idPrefix,""));}
dhtmlXMenuObject.prototype.addNewSibling = function(nextToId, itemId, itemText, disabled, imgEnabled, imgDisabled) {var id = this.idPrefix+(itemId!=null?itemId:this._genStr(24));var parentId = this.idPrefix+(nextToId!=null?this.getParentId(nextToId):this.topId);this._addItemIntoGlobalStrorage(id, parentId, itemText, "item", disabled, imgEnabled, imgDisabled);if ((parentId == this.idPrefix+this.topId)&& (!this.context)) {this._renderToplevelItem(id, this.getItemPosition(nextToId));}else {this._renderSublevelItem(id, this.getItemPosition(nextToId));}
}
dhtmlXMenuObject.prototype.addNewChild = function(parentId, pos, itemId, itemText, disabled, imgEnabled, imgDisabled) {if (parentId == null){if (this.context){parentId = this.topId;}else {this.addNewSibling(parentId, itemId, itemText, disabled, imgEnabled, imgDisabled);if (pos != null)this.setItemPosition(itemId, pos);return;}
 }
 itemId = this.idPrefix+(itemId!=null?itemId:this._genStr(24));if (this.setHotKey)this.setHotKey(parentId, "");parentId = this.idPrefix+parentId;this._addItemIntoGlobalStrorage(itemId, parentId, itemText, "item", disabled, imgEnabled, imgDisabled);if (this.idPull["polygon_"+parentId] == null){this._renderSublevelPolygon(parentId, parentId);}
 this._renderSublevelItem(itemId, pos-1);this._redefineComplexState(parentId);}
dhtmlXMenuObject.prototype._addItemIntoGlobalStrorage = function(itemId, itemParentId, itemText, itemType, disabled, img, imgDis) {var item = {id: itemId,
 title: itemText,
 imgen: (img!=null?img:""),
 imgdis: (imgDis!=null?imgDis:""),
 type: itemType,
 state: (disabled==true?"disabled":"enabled"),
 parent: itemParentId,
 complex:false,
 hotkey: "",
 tip: ""};this.itemPull[item.id] = item;}
dhtmlXMenuObject.prototype._addSubMenuPolygon = function(id, parentId) {var s = this._renderSublevelPolygon(id, parentId);var j = this._getMenuNodes(parentId);for (q=0;q<j.length;q++){if (this.itemPull[j[q]]["type"] == "separator"){this._renderSeparator(j[q], null);}else {this._renderSublevelItem(j[q], null);}}
 if (id == parentId){var level = "topLevel";}else {var level = "subLevel";}
 for (var q=0;q<j.length;q++){if (this.itemPull[j[q]]["complex"]){this._addSubMenuPolygon(id, this.itemPull[j[q]]["id"]);}}
}
dhtmlXMenuObject.prototype._renderSublevelPolygon = function(id, parentId) {var s = document.createElement("DIV");s.className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_Polygon "+(this._rtl?"dir_right":"");s.dir = "ltr";s.oncontextmenu = function(e) {e = e||event;e.returnValue = false;e.cancelBubble = true;return false;}
 s.id = "polygon_" + parentId;s.onclick = function(e) {e = e || event;e.cancelBubble = true;}
 s.style.display = "none";document.body.insertBefore(s, document.body.firstChild);var tbl = document.createElement("TABLE");tbl.className = "dhtmlxMebu_SubLevelArea_Tbl";tbl.cellSpacing = 0;tbl.cellPadding = 0;tbl.border = 0;var tbd = document.createElement("TBODY");tbl.appendChild(tbd);s.appendChild(tbl);s.tbl = tbl;s.tbd = tbd;this.idPull[s.id] = s;if (this.sxDacProc != null){this.idPull["sxDac_" + parentId] = new this.sxDacProc(s, s.className);if (_isIE){this.idPull["sxDac_" + parentId]._setSpeed(this.dacSpeedIE);this.idPull["sxDac_" + parentId]._setCustomCycle(this.dacCyclesIE);}else {this.idPull["sxDac_" + parentId]._setSpeed(this.dacSpeed);this.idPull["sxDac_" + parentId]._setCustomCycle(this.dacCycles);}
 }
 return s;}
dhtmlXMenuObject.prototype._renderSublevelItem = function(id, pos) {var main_self = this;var tr = document.createElement("TR");tr.className = (this.itemPull[id]["state"]=="enabled"?"sub_item":"sub_item_dis");var t1 = document.createElement("TD");t1.className = "sub_item_icon";var icon = this.itemPull[id][(this.itemPull[id]["state"]=="enabled"?"imgen":"imgdis")];if (icon != ""){var tp = this.itemPull[id]["type"];if (tp=="checkbox"||tp=="radio"){var img = document.createElement("DIV");img.id = "image_"+this.itemPull[id]["id"];img.className = "sub_icon "+icon;t1.appendChild(img);}
 if (!(tp=="checkbox"||tp=="radio")) {var img = document.createElement("IMG");img.id = "image_"+this.itemPull[id]["id"];img.className = "sub_icon";img.src = this.imagePath+icon;t1.appendChild(img);}
 }
 
 
 var t2 = document.createElement("TD");t2.className = "sub_item_text";if (this.itemPull[id]["title"] != ""){var t2t = document.createElement("DIV");t2t.className = "sub_item_text";t2t.innerHTML = this.itemPull[id]["title"];t2.appendChild(t2t);}else {t2.innerHTML = "&nbsp;";}
 
 
 var t3 = document.createElement("TD");t3.className = "sub_item_hk";if (this.itemPull[id]["complex"]){var arw = document.createElement("DIV");arw.className = "complex_arrow";arw.id = "arrow_"+this.itemPull[id]["id"];t3.appendChild(arw);}else {if (this.itemPull[id]["hotkey"].length > 0 && !this.itemPull[id]["complex"]){var t3t = document.createElement("DIV");t3t.className = "sub_item_hk";t3t.innerHTML = this.itemPull[id]["hotkey"];t3.appendChild(t3t);}else {t3.innerHTML = "&nbsp;";}
 }
 tr.appendChild(this._rtl?t3:t1);tr.appendChild(t2);tr.appendChild(this._rtl?t1:t3);tr.id = this.itemPull[id]["id"];tr.parent = this.itemPull[id]["parent"];if (this.itemPull[id]["tip"].length > 0)tr.title = this.itemPull[id]["tip"];if (!this._hideTMData)this._hideTMData = {};tr.onselectstart = function(e) {e = e || event;e.returnValue = false;return false;}
 tr.onmouseover = function(e) {if (main_self.menuMode == "web"){if (main_self._hideTMData[this.id])window.clearTimeout(main_self._hideTMData[this.id]);window.clearTimeout(main_self.menuTimeoutHandler);}
 if (!this._visible)main_self._redistribSubLevelSelection(this.id, this.parent);this._visible = true;}
 if (main_self.menuMode == "web"){tr.onmouseout = function() {if (main_self.menuTimeoutHandler)window.clearTimeout(main_self.menuTimeoutHandler);main_self.menuTimeoutHandler = window.setTimeout(function(){main_self._clearAndHide();}, main_self.menuTimeoutMsec, "JavaScript");var k = this;if (main_self._hideTMData[this.id])window.clearTimeout(main_self._hideTMData[this.id]);main_self._hideTMData[this.id] = window.setTimeout(function(){k._visible=false;}, 50);}
 }
 tr.onclick = function(e) {if (!main_self.checkEvent("onClick")&& main_self.itemPull[this.id]["complex"]) return;e = e || event;e.cancelBubble = true;e.returnValue = false;tc = (main_self.itemPull[this.id]["complex"]?"c":"-");td = (main_self.itemPull[this.id]["state"]=="enabled"?"-":"d");var cas = {"ctrl": e.ctrlKey, "alt": e.altKey, "shift": e.shiftKey};switch (main_self.itemPull[this.id]["type"]) {case "checkbox":
 main_self._checkboxOnClickHandler(this.id.replace(main_self.idPrefix, ""), tc+td+"n", cas);break;case "radio":
 main_self._radioOnClickHandler(this.id.replace(main_self.idPrefix, ""), tc+td+"n", cas);break;case "item":
 main_self._doOnClick(this.id.replace(main_self.idPrefix, ""), tc+td+"n", cas);break;}
 return false;}
 
 var polygon = this.idPull["polygon_"+this.itemPull[id]["parent"]];if (pos != null){pos++;if (pos < 0)pos = 0;if (pos > polygon.tbd.childNodes.length - 1)pos = null;}
 if (pos != null && polygon.tbd.childNodes[pos] != null)polygon.tbd.insertBefore(tr, polygon.tbd.childNodes[pos]);else polygon.tbd.appendChild(tr);this.idPull[tr.id] = tr;}
dhtmlXMenuObject.prototype._renderSeparator = function(id, pos) {var level = (this.context?"SubLevelArea":(this.itemPull[id]["parent"]==this.idPrefix+this.topId?"TopLevel":"SubLevelArea"));if (level == "TopLevel" && this.context)return;var main_self = this;if (level != "TopLevel"){var tr = document.createElement("TR");tr.className = "sub_sep";var td = document.createElement("TD");td.colSpan = "3";tr.appendChild(td);}
 
 var k = document.createElement("DIV");k.id = "separator_"+id;k.className = (level=="TopLevel"?"top_sep":"sub_sep");k.onselectstart = function(e) {e = e || event;e.returnValue = false;}
 k.onclick = function(e) {e = e || event;e.cancelBubble = true;var cas = {"ctrl": e.ctrlKey, "alt": e.altKey, "shift": e.shiftKey};main_self._doOnClick(this.id.replace("separator_" + main_self.idPrefix, ""), "--s", cas);}
 if (level == "TopLevel"){if (pos != null){pos++;if (pos < 0){pos = 0;}
 
 if (this.cont.childNodes[pos] != null){this.cont.insertBefore(k, this.cont.childNodes[pos]);}else {this.cont.appendChild(k);}
 }else {var last = this.cont.childNodes[this.cont.childNodes.length-1];if (String(last).search("TopLevel_Text") == -1) {this.cont.appendChild(k);}else {this.cont.insertBefore(k, last);}
 }
 this.idPull[k.id] = k;}else {var polygon = this.idPull["polygon_"+this.itemPull[id]["parent"]];if (pos != null){pos++;if (pos < 0)pos = 0;if (pos > polygon.tbd.childNodes.length - 1)pos = null;}
 if (pos != null && polygon.tbd.childNodes[pos] != null)polygon.tbd.insertBefore(tr, polygon.tbd.childNodes[pos]);else polygon.tbd.appendChild(tr);td.appendChild(k);this.idPull[k.id] = tr;}
}
dhtmlXMenuObject.prototype.addNewSeparator = function(nextToId, itemId) {itemId = this.idPrefix+(itemId!=null?itemId:this._genStr(24));var parentId = this.idPrefix+this.getParentId(nextToId);this._addItemIntoGlobalStrorage(itemId, parentId, "", "separator", false, "", "");this._renderSeparator(itemId, this.getItemPosition(nextToId));}
dhtmlXMenuObject.prototype.hide = function() {this._clearAndHide();}
dhtmlXMenuObject.prototype.clearAll = function() {this.removeItem(this.idPrefix+this.topId, true);this._isInited = false;this.idPrefix = this._genStr(12);}
dhtmlXMenuObject.prototype.unload = function() {if (_isIE){document.body.detachEvent("onclick", this._bodyClick);document.body.detachEvent("oncontextmenu", this._bodyContext);}else {window.removeEventListener("click", this._bodyClick, false);window.removeEventListener("contextmenu", this._bodyContext, false);}
 this._bodyClick = null;this._bodyContext = null;this.removeItem(this.idPrefix+this.topId, true);this.itemPull = null;this.idPull = null;if (this.context)for (var a in this.contextZones)this.removeContextZone(a);if (this.cont != null){this.cont.className = "";this.cont.parentNode.removeChild(this.cont);this.cont = null;}
 
 if (this.base != null){this.base.className = "";if (!this.context)this.base.oncontextmenu = (this.base._oldContextMenuHandler||null);this.base.onselectstart = null;this.base = null;}
 this.setSkin = null;this.detachAllEvents();if (this._xmlLoader){this._xmlLoader.destructor();this._xmlLoader = null;}
 
 this._align = null;this._arrowFFFix = null;this._isIE6 = null;this._isInited = null;this._rtl = null;this._scrollDownTMStep = null;this._scrollDownTMTime = null;this._scrollUpTMStep = null;this._scrollUpTMTime = null;this._topLevelBottomMargin = null;this._topLevelOffsetLeft = null;this._topLevelBottomMargin = null;this._topLevelRightMargin = null;this.addBaseIdAsContextZone = null;this.context = null;this.contextAutoHide = null;this.contextAutoShow = null;this.contextHideAllMode = null;this.contextMenuZoneId = null;this.dLoad = null;this.dLoadSign = null;this.dLoadUrl = null;this.loaderIcon = null;this.fixedPosition = null;this.dirSubLevel = null;this.dirTopLevel = null;this.limit = null;this.menuSelected = null;this.menuLastClicked = null;this.idPrefix = null;this.imagePath = null;this.menuMode = null;this.menuModeTopLevelTimeout = null;this.menuModeTopLevelTimeoutTime = null;this.menuTimeoutHandler = null;this.menuTimeoutMsec = null;this.menuTouched = null;this.isDhtmlxMenuObject = null;this.itemHotKeyTagName = null;this.itemHrefTagName = null;this.itemTagName = null;this.itemTextTagName = null;this.itemTipTagName = null;this.userDataTagName = null;this.skin = null;this.topId = null;this.dacCycles = null;this.dacCyclesIE = null;this.dacSpeed = null;this.dacSpeedIE = null;this.zInd = null;this.zIndInit = null;this.zIndStep = null;this._enableDacSupport = null;this._selectedSubItems = null;this._openedPolygons = null;this._addSubItemToSelected = null;this._removeSubItemFromSelected = null;this._getSubItemToDeselectByPolygon = null;this._hidePolygon = null;this._showPolygon = null;this._redistribSubLevelSelection = null;this._doOnClick = null;this._doOnTouchMenu = null;this._searchMenuNode = null;this._getMenuNodes = null;this._genStr = null;this._clearAndHide = null;this._doOnLoad = null;this.getItemType = null;this.forEachItem = null;this.init = null;this.loadXML = null;this.loadXMLString = null;this._buildMenu = null;this._xmlParser = null;this._showSubLevelItem = null;this._hideSubLevelItem = null;this._countVisiblePolygonItems = null;this._redefineComplexState = null;this._updateItemComplexState = null;this._getItemLevelType = null;this._redistribTopLevelSelection = null;this._initTopLevelMenu = null;this._renderToplevelItem = null;this.setImagePath = null;this.setIconsPath = null;this.setIconPath = null;this._updateItemImage = null;this.removeItem = null;this._getAllParents = null;this.renderAsContextMenu = null;this.addContextZone = null;this.removeContextZone = null;this.isContextZone = null;this._isContextMenuVisible = null;this._showContextMenu = null;this._doOnContextBeforeCall = null;this._autoDetectVisibleArea = null;this._addItemIntoGlobalStrorage = null;this._addSubMenuPolygon = null;this._renderSublevelPolygon = null;this._renderSublevelItem = null;this._renderSeparator = null;this._hideContextMenu = null;this.clearAll = null;this.getItemPosition = null;this.setItemPosition = null;this.getParentId = null;this.addNewSibling = null;this.addNewChild = null;this.addNewSeparator = null;this.attachEvent = null;this.callEvent = null;this.checkEvent = null;this.eventCatcher = null;this.detachEvent = null;this.dhx_Event = null;this.unload = null;this.items = null;this.radio = null;this.detachAllEvents = null;this.hide = null;this.showContextMenu = null;this.hideContextMenu = null;this._changeItemState = null;this._changeItemVisible = null;this._updateLoaderIcon = null;this._clearAllSelectedSubItemsInPolygon = null;this._checkArrowsState = null;this._addUpArrow = null;this._addDownArrow = null;this._removeUpArrow = null;this._removeDownArrow = null;this._isArrowExists = null;this._doScrollUp = null;this._doScrollDown = null;this._countPolygonItems = null;this._getRadioImgObj = null;this._setRadioState = null;this._radioOnClickHandler = null;this._getCheckboxState = null;this._setCheckboxState = null;this._readLevel = null;this._updateCheckboxImage = null;this._checkboxOnClickHandler = null;this._removeArrow = null;this.setItemEnabled = null;this.setItemDisabled = null;this.isItemEnabled = null;this.getItemText = null;this.setItemText = null;this.loadFromHTML = null;this.hideItem = null;this.showItem = null;this.isItemHidden = null;this.setUserData = null;this.getUserData = null;this.setOpenMode = null;this.setWebModeTimeout = null;this.enableDynamicLoading = null;this.getItemImage = null;this.setItemImage = null;this.clearItemImage = null;this.setAutoShowMode = null;this.setAutoHideMode = null;this.setContextMenuHideAllMode = null;this.getContextMenuHideAllMode = null;this.setVisibleArea = null;this.setTooltip = null;this.getTooltip = null;this.setHotKey = null;this.getHotKey = null;this.setItemSelected = null;this.setTopText = null;this.setRTL = null;this.setAlign = null;this.setHref = null;this.clearHref = null;this.getCircuit = null;this.contextZones = null;this.setOverflowHeight = null;this.userData = null;this.getRadioChecked = null;this.setRadioChecked = null;this.addRadioButton = null;this.setCheckboxState = null;this.getCheckboxState = null;this.addCheckbox = null;this.serialize = null;this.extendedModule = null;dhtmlxMenuObjectLiveInstances[this._UID] = null;try {delete dhtmlxMenuObjectLiveInstances[this._UID];}catch(e) {}
 this._UID = null;}
var dhtmlxMenuObjectLiveInstances = {};dhtmlXMenuObject.prototype.i18n = {dhxmenuextalert: "dhtmlxmenu_ext.js required"
};(function(){dhtmlx.extend_api("dhtmlXMenuObject",{_init:function(obj){return [obj.parent, obj.skin];},
 align:"setAlign",
 top_text:"setTopText",
 context:"renderAsContextMenu",
 icon_path:"setIconsPath",
 open_mode:"setOpenMode",
 rtl:"setRTL",
 skin:"setSkin",
 dynamic:"enableDynamicLoading",
 xml:"loadXML",
 items:"items",
 overflow:"setOverflowHeight"
 },{items:function(arr,parent){var pos = 100000;var lastItemId = null;for (var i=0;i < arr.length;i++){var item=arr[i];if (item.type == "separator"){this.addNewSeparator(lastItemId, pos, item.id);lastItemId = item.id;}else {this.addNewChild(parent, pos, item.id, item.text, item.disabled, item.img, item.img_disabled);lastItemId = item.id;if (item.items)this.items(item.items,item.id);}
 }
 }
 });})();dhtmlXMenuObject.prototype._improveTerraceSkin = function() {for (var a in this.itemPull){if (this.itemPull[a].parent == this.idPrefix+this.topId && this.idPull[a] != null){var bl = false;var br = false;if (this.idPull[a].parentNode.firstChild == this.idPull[a]){bl = true;}
 
 
 if (this.idPull[a].parentNode.lastChild == this.idPull[a]){br = true;}
 
 
 for (var b in this.itemPull){if (this.itemPull[b].type == "separator" && this.itemPull[b].parent == this.idPrefix+this.topId){if (this.idPull[a].nextSibling == this.idPull["separator_"+b]){br = true;}
 if (this.idPull[a].previousSibling == this.idPull["separator_"+b]){bl = true;}
 }
 }
 
 this.idPull[a].style.borderLeft = (bl?"1px solid #cecece":"0px solid white");this.idPull[a].style.borderTopLeftRadius = this.idPull[a].style.borderBottomLeftRadius = (bl?"5px":"0px");this.idPull[a].style.borderTopRightRadius = this.idPull[a].style.borderBottomRightRadius = (br?"5px":"0px");this.idPull[a]._bl = bl;this.idPull[a]._br = br;}
 }
 
};dhtmlXMenuObject.prototype._improveTerraceButton = function(id, state) {if (state){this.idPull[id].style.borderBottomLeftRadius = (this.idPull[id]._bl ? "5px" : "0px");this.idPull[id].style.borderBottomRightRadius = (this.idPull[id]._br ? "5px" : "0px");}else {this.idPull[id].style.borderBottomLeftRadius = "0px";this.idPull[id].style.borderBottomRightRadius = "0px";}
};dhtmlXMenuObject.prototype.extendedModule = "DHXMENUEXT";dhtmlXMenuObject.prototype.setItemEnabled = function(id) {this._changeItemState(id, "enabled", this._getItemLevelType(id));}
dhtmlXMenuObject.prototype.setItemDisabled = function(id) {this._changeItemState(id, "disabled", this._getItemLevelType(id));}
dhtmlXMenuObject.prototype.isItemEnabled = function(id) {return (this.itemPull[this.idPrefix+id]!=null?(this.itemPull[this.idPrefix+id]["state"]=="enabled"):false);}
dhtmlXMenuObject.prototype._changeItemState = function(id, newState, levelType) {var t = false;var j = this.idPrefix + id;if ((this.itemPull[j] != null)&& (this.idPull[j] != null)) {if (this.itemPull[j]["state"] != newState){this.itemPull[j]["state"] = newState;if (this.itemPull[j]["parent"] == this.idPrefix+this.topId && !this.context){this.idPull[j].className = "dhtmlxMenu_"+this.skin+"_TopLevel_Item_"+(this.itemPull[j]["state"]=="enabled"?"Normal":"Disabled");}else {this.idPull[j].className = "sub_item"+(this.itemPull[j]["state"]=="enabled"?"":"_dis");}
 
 this._updateItemComplexState(this.idPrefix+id, this.itemPull[this.idPrefix+id]["complex"], false);this._updateItemImage(id, levelType);if ((this.idPrefix + this.menuLastClicked == j)&& (levelType != "TopLevel")) {this._redistribSubLevelSelection(j, this.itemPull[j]["parent"]);}
 if (levelType == "TopLevel" && !this.context){}
 }
 }
 return t;}
dhtmlXMenuObject.prototype.getItemText = function(id) {return (this.itemPull[this.idPrefix+id]!=null?this.itemPull[this.idPrefix+id]["title"]:"");}
dhtmlXMenuObject.prototype.setItemText = function(id, text) {id = this.idPrefix + id;if ((this.itemPull[id] != null)&& (this.idPull[id] != null)) {this._clearAndHide();this.itemPull[id]["title"] = text;if (this.itemPull[id]["parent"] == this.idPrefix+this.topId && !this.context){var tObj = null;for (var q=0;q<this.idPull[id].childNodes.length;q++){try {if (this.idPull[id].childNodes[q].className == "top_level_text")tObj = this.idPull[id].childNodes[q];}catch(e) {}
 }
 if (String(this.itemPull[id]["title"]).length == "" || this.itemPull[id]["title"] == null) {if (tObj != null)tObj.parentNode.removeChild(tObj);}else {if (!tObj){tObj = document.createElement("DIV");tObj.className = "top_level_text";if (this._rtl && this.idPull[id].childNodes.length > 0)this.idPull[id].insertBefore(tObj,this.idPull[id].childNodes[0]);else this.idPull[id].appendChild(tObj);}
 tObj.innerHTML = this.itemPull[id]["title"];}
 }else {var tObj = null;for (var q=0;q<this.idPull[id].childNodes[1].childNodes.length;q++){if (String(this.idPull[id].childNodes[1].childNodes[q].className||"")== "sub_item_text") tObj = this.idPull[id].childNodes[1].childNodes[q];}
 if (String(this.itemPull[id]["title"]).length == "" || this.itemPull[id]["title"] == null) {if (tObj){tObj.parentNode.removeChild(tObj);tObj = null;this.idPull[id].childNodes[1].innerHTML = "&nbsp;";}
 }else {if (!tObj){tObj = document.createElement("DIV");tObj.className = "sub_item_text";this.idPull[id].childNodes[1].innerHTML = "";this.idPull[id].childNodes[1].appendChild(tObj);}
 tObj.innerHTML = this.itemPull[id]["title"];}
 }
 }
}
dhtmlXMenuObject.prototype.loadFromHTML = function(objId, clearAfterAdd, onLoadFunction) {this.itemTagName = "DIV";if (typeof(objId)== "string") {objId = document.getElementById(objId);}
 this._buildMenu(objId, null);this.init();if (clearAfterAdd){objId.parentNode.removeChild(objId);}
 if (onLoadFunction != null){onLoadFunction();}
}
dhtmlXMenuObject.prototype.hideItem = function(id) {this._changeItemVisible(id, false);}
dhtmlXMenuObject.prototype.showItem = function(id) {this._changeItemVisible(id, true);}
dhtmlXMenuObject.prototype.isItemHidden = function(id) {var isHidden = null;if (this.idPull[this.idPrefix+id] != null){isHidden = (this.idPull[this.idPrefix+id].style.display == "none");}
 return isHidden;}
dhtmlXMenuObject.prototype._changeItemVisible = function(id, visible) {var itemId = this.idPrefix+id;if (this.itemPull[itemId] == null)return;if (this.itemPull[itemId]["type"] == "separator"){itemId = "separator_"+itemId;}
 if (this.idPull[itemId] == null)return;this.idPull[itemId].style.display = (visible?"":"none");this._redefineComplexState(this.itemPull[this.idPrefix+id]["parent"]);}
dhtmlXMenuObject.prototype.setUserData = function(id, name, value) {this.userData[this.idPrefix+id+"_"+name] = value;}
dhtmlXMenuObject.prototype.getUserData = function(id, name) {return (this.userData[this.idPrefix+id+"_"+name]!=null?this.userData[this.idPrefix+id+"_"+name]:null);}
dhtmlXMenuObject.prototype.setOpenMode = function(mode) {if (mode == "win" || mode == "web")this.menuMode = mode;else this.menuMode == "web";}
dhtmlXMenuObject.prototype.setWebModeTimeout = function(tm) {this.menuTimeoutMsec = (!isNaN(tm)?tm:400);}
dhtmlXMenuObject.prototype.enableDynamicLoading = function(url, icon) {this.dLoad = true;this.dLoadUrl = url;this.dLoadSign = (String(this.dLoadUrl).search(/\?/)==-1?"?":"&");this.loaderIcon = icon;this.init();}
dhtmlXMenuObject.prototype._updateLoaderIcon = function(id, state) {if (this.idPull[id] == null)return;if (String(this.idPull[id].className).search("TopLevel_Item") >= 0) return;var ind = (this._rtl?0:2);if (!this.idPull[id].childNodes[ind])return;if (!this.idPull[id].childNodes[ind].childNodes[0])return;var aNode = this.idPull[id].childNodes[ind].childNodes[0];if (String(aNode.className).search("complex_arrow") === 0) aNode.className = "complex_arrow"+(state?"_loading":"");}
dhtmlXMenuObject.prototype.getItemImage = function(id) {var imgs = new Array(null, null);id = this.idPrefix+id;if (this.itemPull[id]["type"] == "item"){imgs[0] = this.itemPull[id]["imgen"];imgs[1] = this.itemPull[id]["imgdis"];}
 return imgs;}
dhtmlXMenuObject.prototype.setItemImage = function(id, img, imgDis) {if (this.itemPull[this.idPrefix+id]["type"] != "item")return;this.itemPull[this.idPrefix+id]["imgen"] = img;this.itemPull[this.idPrefix+id]["imgdis"] = imgDis;this._updateItemImage(id, this._getItemLevelType(id));}
dhtmlXMenuObject.prototype.clearItemImage = function(id) {this.setItemImage(id, "", "");}
dhtmlXMenuObject.prototype.setAutoShowMode = function(mode) {this.contextAutoShow = (mode==true?true:false);}
dhtmlXMenuObject.prototype.setAutoHideMode = function(mode) {this.contextAutoHide = (mode==true?true:false);}
dhtmlXMenuObject.prototype.setContextMenuHideAllMode = function(mode) {this.contextHideAllMode = (mode==true?true:false);}
dhtmlXMenuObject.prototype.getContextMenuHideAllMode = function() {return this.contextHideAllMode;}
dhtmlXMenuObject.prototype.setVisibleArea = function(x1, x2, y1, y2) {this._isVisibleArea = true;this.menuX1 = x1;this.menuX2 = x2;this.menuY1 = y1;this.menuY2 = y2;}
dhtmlXMenuObject.prototype.setTooltip = function(id, tip) {id = this.idPrefix+id;if (!(this.itemPull[id] != null && this.idPull[id] != null)) return;this.idPull[id].title = (tip.length > 0 ? tip : null);this.itemPull[id]["tip"] = tip;}
dhtmlXMenuObject.prototype.getTooltip = function(id) {if (this.itemPull[this.idPrefix+id] == null)return null;return this.itemPull[this.idPrefix+id]["tip"];}
dhtmlXMenuObject.prototype.setHotKey = function(id, hkey) {id = this.idPrefix+id;if (!(this.itemPull[id] != null && this.idPull[id] != null)) return;if (this.itemPull[id]["parent"] == this.idPrefix+this.topId && !this.context)return;if (this.itemPull[id]["complex"])return;var t = this.itemPull[id]["type"];if (!(t == "item" || t == "checkbox" || t == "radio")) return;var hkObj = null;try {if (this.idPull[id].childNodes[this._rtl?0:2].childNodes[0].className == "sub_item_hk")hkObj = this.idPull[id].childNodes[this._rtl?0:2].childNodes[0];}catch(e){}
 
 if (hkey.length == 0){this.itemPull[id]["hotkey_backup"] = this.itemPull[id]["hotkey"];this.itemPull[id]["hotkey"] = "";if (hkObj != null)hkObj.parentNode.removeChild(hkObj);}else {this.itemPull[id]["hotkey"] = hkey;this.itemPull[id]["hotkey_backup"] = null;if (hkObj == null){hkObj = document.createElement("DIV");hkObj.className = "sub_item_hk";var item = this.idPull[id].childNodes[this._rtl?0:2];while (item.childNodes.length > 0)item.removeChild(item.childNodes[0]);item.appendChild(hkObj);}
 hkObj.innerHTML = hkey;}
}
dhtmlXMenuObject.prototype.getHotKey = function(id) {if (this.itemPull[this.idPrefix+id] == null)return null;return this.itemPull[this.idPrefix+id]["hotkey"];}
dhtmlXMenuObject.prototype.setItemSelected = function(id) {if (this.itemPull[this.idPrefix+id] == null)return null;}
dhtmlXMenuObject.prototype.setTopText = function(text) {if (this.context)return;if (this._topText == null){this._topText = document.createElement("DIV");this._topText.className = "dhtmlxMenu_TopLevel_Text_"+(this._rtl?"left":(this._align=="left"?"right":"left"));this.base.appendChild(this._topText);}
 this._topText.innerHTML = text;}
dhtmlXMenuObject.prototype.setAlign = function(align) {if (this._align == align)return;if (align == "left" || align == "right"){this._align = align;if (this.cont)this.cont.className = (this._align=="right"?"align_right":"align_left");if (this._topText != null)this._topText.className = "dhtmlxMenu_TopLevel_Text_"+(this._align=="left"?"right":"left");}
}
dhtmlXMenuObject.prototype.setHref = function(itemId, href, target) {if (this.itemPull[this.idPrefix+itemId] == null)return;this.itemPull[this.idPrefix+itemId]["href_link"] = href;if (target != null)this.itemPull[this.idPrefix+itemId]["href_target"] = target;}
dhtmlXMenuObject.prototype.clearHref = function(itemId) {if (this.itemPull[this.idPrefix+itemId] == null)return;delete this.itemPull[this.idPrefix+itemId]["href_link"];delete this.itemPull[this.idPrefix+itemId]["href_target"];}
dhtmlXMenuObject.prototype.getCircuit = function(id) {var parents = new Array(id);while (this.getParentId(id)!= this.topId) {id = this.getParentId(id);parents[parents.length] = id;}
 return parents.reverse();}
dhtmlXMenuObject.prototype._clearAllSelectedSubItemsInPolygon = function(polygon) {var subIds = this._getSubItemToDeselectByPolygon(polygon);for (var q=0;q<this._openedPolygons.length;q++){if (this._openedPolygons[q] != polygon){this._hidePolygon(this._openedPolygons[q]);}}
 for (var q=0;q<subIds.length;q++){if (this.idPull[subIds[q]] != null){if (this.itemPull[subIds[q]]["state"] == "enabled"){this.idPull[subIds[q]].className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_Item_Normal";}}}
}
dhtmlXMenuObject.prototype._checkArrowsState = function(id) {var polygon = this.idPull["polygon_"+id];var arrowUp = this.idPull["arrowup_"+id];var arrowDown = this.idPull["arrowdown_"+id];if (polygon.scrollTop == 0){arrowUp.className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_ArrowUp_Disabled";}else {arrowUp.className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_ArrowUp" + (arrowUp.over ? "_Over" : "");}
 if (polygon.scrollTop + polygon.offsetHeight < polygon.scrollHeight){arrowDown.className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_ArrowDown" + (arrowDown.over ? "_Over" : "");}else {arrowDown.className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_ArrowDown_Disabled";}
}
dhtmlXMenuObject.prototype._addUpArrow = function(id) {var main_self = this;var arrow = document.createElement("DIV");arrow.pId = this.idPrefix+id;arrow.id = "arrowup_"+this.idPrefix+id;arrow.className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_ArrowUp";arrow.innerHTML = "<div class='dhtmlxMenu_"+this.skin+"_SubLevelArea_Arrow'><div class='dhtmlxMenu_SubLevelArea_Arrow_Icon'></div></div>";arrow.style.display = "none";arrow.over = false;arrow.onselectstart = function(e) {e = e||event;e.returnValue = false;return false;}
 arrow.oncontextmenu = function(e) {e = e||event;e.returnValue = false;return false;}
 
 arrow.onmouseover = function() {if (main_self.menuMode == "web"){window.clearTimeout(main_self.menuTimeoutHandler);}
 main_self._clearAllSelectedSubItemsInPolygon(this.pId);if (this.className == "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowUp_Disabled")return;this.className = "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowUp_Over";this.over = true;main_self._canScrollUp = true;main_self._doScrollUp(this.pId, true);}
 arrow.onmouseout = function() {if (main_self.menuMode == "web"){window.clearTimeout(main_self.menuTimeoutHandler);main_self.menuTimeoutHandler = window.setTimeout(function(){main_self._clearAndHide();}, main_self.menuTimeoutMsec, "JavaScript");}
 this.over = false;main_self._canScrollUp = false;if (this.className == "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowUp_Disabled")return;this.className = "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowUp";window.clearTimeout(main_self._scrollUpTM);}
 arrow.onclick = function(e) {e = e||event;e.returnValue = false;e.cancelBubble = true;return false;}
 
 
 
 document.body.insertBefore(arrow, document.body.firstChild);this.idPull[arrow.id] = arrow;}
dhtmlXMenuObject.prototype._addDownArrow = function(id) {var main_self = this;var arrow = document.createElement("DIV");arrow.pId = this.idPrefix+id;arrow.id = "arrowdown_"+this.idPrefix+id;arrow.className = "dhtmlxMenu_"+this.skin+"_SubLevelArea_ArrowDown";arrow.innerHTML = "<div class='dhtmlxMenu_"+this.skin+"_SubLevelArea_Arrow'><div class='dhtmlxMenu_SubLevelArea_Arrow_Icon'></div></div>";arrow.style.display = "none";arrow.over = false;arrow.onselectstart = function(e) {e = e||event;e.returnValue = false;return false;}
 arrow.oncontextmenu = function(e) {e = e||event;e.returnValue = false;return false;}
 
 arrow.onmouseover = function() {if (main_self.menuMode == "web"){window.clearTimeout(main_self.menuTimeoutHandler);}
 main_self._clearAllSelectedSubItemsInPolygon(this.pId);if (this.className == "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowDown_Disabled")return;this.className = "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowDown_Over";this.over = true;main_self._canScrollDown = true;main_self._doScrollDown(this.pId, true);}
 arrow.onmouseout = function() {if (main_self.menuMode == "web"){window.clearTimeout(main_self.menuTimeoutHandler);main_self.menuTimeoutHandler = window.setTimeout(function(){main_self._clearAndHide();}, main_self.menuTimeoutMsec, "JavaScript");}
 this.over = false;main_self._canScrollDown = false;if (this.className == "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowDown_Disabled")return;this.className = "dhtmlxMenu_"+main_self.skin+"_SubLevelArea_ArrowDown";window.clearTimeout(main_self._scrollDownTM);}
 arrow.onclick = function(e) {e = e||event;e.returnValue = false;e.cancelBubble = true;return false;}
 document.body.insertBefore(arrow, document.body.firstChild);this.idPull[arrow.id] = arrow;}
dhtmlXMenuObject.prototype._removeUpArrow = function(id) {var fullId = "arrowup_"+this.idPrefix+id;this._removeArrow(fullId);}
dhtmlXMenuObject.prototype._removeDownArrow = function(id) {var fullId = "arrowdown_"+this.idPrefix+id;this._removeArrow(fullId);}
dhtmlXMenuObject.prototype._removeArrow = function(fullId) {var arrow = this.idPull[fullId];arrow.onselectstart = null;arrow.oncontextmenu = null;arrow.onmouseover = null;arrow.onmouseout = null;arrow.onclick = null;if (arrow.parentNode)arrow.parentNode.removeChild(arrow);arrow = null;this.idPull[fullId] = null;try {delete this.idPull[fullId];}catch(e) {}
}
dhtmlXMenuObject.prototype._isArrowExists = function(id) {if (this.idPull["arrowup_"+id] != null && this.idPull["arrowdown_"+id] != null)return true;return false;}
dhtmlXMenuObject.prototype._doScrollUp = function(id, checkArrows) {var polygon = this.idPull["polygon_"+id];if (this._canScrollUp && polygon.scrollTop > 0){var theEnd = false;var nextScrollTop = polygon.scrollTop - this._scrollUpTMStep;if (nextScrollTop < 0){theEnd = true;nextScrollTop = 0;}
 polygon.scrollTop = nextScrollTop;if (!theEnd){var that = this;this._scrollUpTM = window.setTimeout(function() {that._doScrollUp(id, false);}, this._scrollUpTMTime);}
 }else {this._canScrollUp = false;this._checkArrowsState(id);}
 if (checkArrows){this._checkArrowsState(id);}
}
dhtmlXMenuObject.prototype._doScrollDown = function(id, checkArrows) {var polygon = this.idPull["polygon_"+id];if (this._canScrollDown && polygon.scrollTop + polygon.offsetHeight <= polygon.scrollHeight){var theEnd = false;var nextScrollTop = polygon.scrollTop + this._scrollDownTMStep;if (nextScrollTop + polygon.offsetHeight > polygon.scollHeight){theEnd = true;nextScrollTop = polygon.scollHeight - polygon.offsetHeight;}
 polygon.scrollTop = nextScrollTop;if (!theEnd){var that = this;this._scrollDownTM = window.setTimeout(function() {that._doScrollDown(id, false);}, this._scrollDownTMTime);}
 }else {this._canScrollDown
 this._checkArrowsState(id);}
 if (checkArrows){this._checkArrowsState(id);}
}
dhtmlXMenuObject.prototype._countPolygonItems = function(id) {var count = 0;for (var a in this.itemPull){var par = this.itemPull[a]["parent"];var tp = this.itemPull[a]["type"];if (par == this.idPrefix+id && (tp == "item" || tp == "radio" || tp == "checkbox")) {count++;}
 }
 return count;}
dhtmlXMenuObject.prototype.setOverflowHeight = function(itemsNum) {if (itemsNum === "auto"){this.limit = 0;this.autoOverflow = true;return;}
 
 
 if (this.limit == 0 && itemsNum <= 0)return;this._clearAndHide();if (this.limit >= 0 && itemsNum > 0){this.limit = itemsNum;return;}
 
 
 if (this.limit > 0 && itemsNum <= 0){for (var a in this.itemPull){if (this._isArrowExists(a)) {var b = String(a).replace(this.idPrefix, "");this._removeUpArrow(b);this._removeDownArrow(b);this.idPull["polygon_"+a].style.height = "";}
 }
 this.limit = 0;return;}
}
dhtmlXMenuObject.prototype._getRadioImgObj = function(id) {try {var imgObj = this.idPull[this.idPrefix+id].childNodes[(this._rtl?2:0)].childNodes[0] }catch(e) {var imgObj = null;}
 return imgObj;}
dhtmlXMenuObject.prototype._setRadioState = function(id, state) {var imgObj = this._getRadioImgObj(id);if (imgObj != null){var rObj = this.itemPull[this.idPrefix+id];rObj["checked"] = state;rObj["imgen"] = "rdbt_"+(rObj["checked"]?"1":"0");rObj["imgdis"] = rObj["imgen"];imgObj.className = "sub_icon "+rObj["imgen"];}
}
dhtmlXMenuObject.prototype._radioOnClickHandler = function(id, type, casState) {if (type.charAt(1)=="d" || this.itemPull[this.idPrefix+id]["group"]==null) return;var group = this.itemPull[this.idPrefix+id]["group"];if (this.checkEvent("onRadioClick")) {if (this.callEvent("onRadioClick", [group, this.getRadioChecked(group), id, this.contextMenuZoneId, casState])) {this.setRadioChecked(group, id);}
 }else {this.setRadioChecked(group, id);}
 
 if (this.checkEvent("onClick")) this.callEvent("onClick", [id]);}
dhtmlXMenuObject.prototype.getRadioChecked = function(group) {var id = null;for (var q=0;q<this.radio[group].length;q++){var itemId = this.radio[group][q].replace(this.idPrefix, "");var imgObj = this._getRadioImgObj(itemId);if (imgObj != null){var checked = (imgObj.className).match(/rdbt_1$/gi);if (checked != null)id = itemId;}
 }
 return id;}
dhtmlXMenuObject.prototype.setRadioChecked = function(group, id) {if (this.radio[group] == null)return;for (var q=0;q<this.radio[group].length;q++){var itemId = this.radio[group][q].replace(this.idPrefix, "");this._setRadioState(itemId, (itemId==id));}
}
dhtmlXMenuObject.prototype.addRadioButton = function(mode, nextToId, pos, itemId, itemText, group, state, disabled) {if (this.context && nextToId == this.topId){}else {if (this.itemPull[this.idPrefix+nextToId] == null)return;if (mode == "child" && this.itemPull[this.idPrefix+nextToId]["type"] != "item")return;}
 
 
 
 var id = this.idPrefix+(itemId!=null?itemId:this._genStr(24));var img = "rdbt_"+(state?"1":"0");var imgDis = img;if (mode == "sibling"){var parentId = this.idPrefix+this.getParentId(nextToId);this._addItemIntoGlobalStrorage(id, parentId, itemText, "radio", disabled, img, imgDis);this._renderSublevelItem(id, this.getItemPosition(nextToId));}else {var parentId = this.idPrefix+nextToId;this._addItemIntoGlobalStrorage(id, parentId, itemText, "radio", disabled, img, imgDis);if (this.idPull["polygon_"+parentId] == null){this._renderSublevelPolygon(parentId, parentId);}
 this._renderSublevelItem(id, pos-1);this._redefineComplexState(parentId);}
 
 var gr = (group!=null?group:this._genStr(24));this.itemPull[id]["group"] = gr;if (this.radio[gr]==null){this.radio[gr] = new Array();}
 this.radio[gr][this.radio[gr].length] = id;if (state == true)this.setRadioChecked(gr, String(id).replace(this.idPrefix, ""));}
dhtmlXMenuObject.prototype._getCheckboxState = function(id) {if (this.itemPull[this.idPrefix+id] == null)return null;return this.itemPull[this.idPrefix+id]["checked"];}
dhtmlXMenuObject.prototype._setCheckboxState = function(id, state) {if (this.itemPull[this.idPrefix+id] == null)return;this.itemPull[this.idPrefix+id]["checked"] = state;}
dhtmlXMenuObject.prototype._updateCheckboxImage = function(id) {if (this.idPull[this.idPrefix+id] == null)return;this.itemPull[this.idPrefix+id]["imgen"] = "chbx_"+(this._getCheckboxState(id)?"1":"0");this.itemPull[this.idPrefix+id]["imgdis"] = this.itemPull[this.idPrefix+id]["imgen"];try {this.idPull[this.idPrefix+id].childNodes[(this._rtl?2:0)].childNodes[0].className = "sub_icon "+this.itemPull[this.idPrefix+id]["imgen"];}catch(e){}
}
dhtmlXMenuObject.prototype._checkboxOnClickHandler = function(id, type, casState) {if (type.charAt(1)=="d") return;if (this.itemPull[this.idPrefix+id] == null)return;var state = this._getCheckboxState(id);if (this.checkEvent("onCheckboxClick")) {if (this.callEvent("onCheckboxClick", [id, state, this.contextMenuZoneId, casState])) {this.setCheckboxState(id, !state);}
 }else {this.setCheckboxState(id, !state);}
 
 if (this.checkEvent("onClick")) this.callEvent("onClick", [id]);}
dhtmlXMenuObject.prototype.setCheckboxState = function(id, state) {this._setCheckboxState(id, state);this._updateCheckboxImage(id);}
dhtmlXMenuObject.prototype.getCheckboxState = function(id) {return this._getCheckboxState(id);}
dhtmlXMenuObject.prototype.addCheckbox = function(mode, nextToId, pos, itemId, itemText, state, disabled) {if (this.context && nextToId == this.topId){}else {if (this.itemPull[this.idPrefix+nextToId] == null)return;if (mode == "child" && this.itemPull[this.idPrefix+nextToId]["type"] != "item")return;}
 
 var img = "chbx_"+(state?"1":"0");var imgDis = img;if (mode == "sibling"){var id = this.idPrefix+(itemId!=null?itemId:this._genStr(24));var parentId = this.idPrefix+this.getParentId(nextToId);this._addItemIntoGlobalStrorage(id, parentId, itemText, "checkbox", disabled, img, imgDis);this.itemPull[id]["checked"] = state;this._renderSublevelItem(id, this.getItemPosition(nextToId));}else {var id = this.idPrefix+(itemId!=null?itemId:this._genStr(24));var parentId = this.idPrefix+nextToId;this._addItemIntoGlobalStrorage(id, parentId, itemText, "checkbox", disabled, img, imgDis);this.itemPull[id]["checked"] = state;if (this.idPull["polygon_"+parentId] == null){this._renderSublevelPolygon(parentId, parentId);}
 this._renderSublevelItem(id, pos-1);this._redefineComplexState(parentId);}
}
dhtmlXMenuObject.prototype._readLevel = function(parentId) {var xml = "";for (var a in this.itemPull){if (this.itemPull[a]["parent"] == parentId){var imgEn = "";var imgDis = "";var hotKey = "";var itemId = String(this.itemPull[a]["id"]).replace(this.idPrefix,"");var itemType = "";var itemText = (this.itemPull[a]["title"]!=""?' text="'+this.itemPull[a]["title"]+'"':"");var itemState = "";if (this.itemPull[a]["type"] == "item"){if (this.itemPull[a]["imgen"] != "")imgEn = ' img="'+this.itemPull[a]["imgen"]+'"';if (this.itemPull[a]["imgdis"] != "")imgDis = ' imgdis="'+this.itemPull[a]["imgdis"]+'"';if (this.itemPull[a]["hotkey"] != "")hotKey = '<hotkey>'+this.itemPull[a]["hotkey"]+'</hotkey>';}
 if (this.itemPull[a]["type"] == "separator"){itemType = ' type="separator"';}else {if (this.itemPull[a]["state"] == "disabled")itemState = ' enabled="false"';}
 if (this.itemPull[a]["type"] == "checkbox"){itemType = ' type="checkbox"'+(this.itemPull[a]["checked"]?' checked="true"':"");}
 if (this.itemPull[a]["type"] == "radio"){itemType = ' type="radio" group="'+this.itemPull[a]["group"]+'" '+(this.itemPull[a]["checked"]?' checked="true"':"");}
 xml += "<item id='"+itemId+"'"+itemText+itemType+imgEn+imgDis+itemState+">";xml += hotKey;if (this.itemPull[a]["complex"])xml += this._readLevel(a);xml += "</item>";}
 }
 return xml;}
dhtmlXMenuObject.prototype.serialize = function() {var xml = "<menu>"+this._readLevel(this.idPrefix+this.topId)+"</menu>";return xml;}
function dataProcessor(serverProcessorURL){this.serverProcessor = serverProcessorURL;this.action_param="!nativeeditor_status";this.object = null;this.updatedRows = [];this.autoUpdate = true;this.updateMode = "cell";this._tMode="GET";this.post_delim = "_";this._waitMode=0;this._in_progress={};this._invalid={};this.mandatoryFields=[];this.messages=[];this.styles={updated:"font-weight:bold;",
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
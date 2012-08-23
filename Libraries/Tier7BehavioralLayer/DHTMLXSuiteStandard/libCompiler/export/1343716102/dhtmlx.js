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
 };})();function dhtmlXWindowsSngl(){}
function dhtmlXWindowsBtn(){}
function dhtmlXWindows() {if (!window.dhtmlXContainer){alert(this.i18n.dhx);return;}
 
 this.engine = "dhx";var engineFunc = "_"+this.engine+"_Engine";if (!this[engineFunc]){alert(this.i18n.noenginealert);return;}else {this[engineFunc]();}
 
 this._isIPad = (navigator.userAgent.search(/iPad/gi)>=0);var that = this;this.pathPrefix = "dhxwins_";this.imagePath = dhtmlx.image_path||"codebase/imgs/";this.setImagePath = function(path) {this.imagePath = path;}
 
 
 this.skin = (typeof(dhtmlx) != "undefined" && typeof(dhtmlx.skin) == "string" ? dhtmlx.skin : "dhx_skyblue");this.skinParams = {"dhx_black" : {"header_height": 21, "border_left_width": 2, "border_right_width": 2, "border_bottom_height": 2 },
 "dhx_blue" : {"header_height": 21, "border_left_width": 2, "border_right_width": 2, "border_bottom_height": 2 },
 "dhx_skyblue" : {"header_height": 21, "border_left_width": 2, "border_right_width": 2, "border_bottom_height": 2 }
 };this.setSkin = function(skin) {this.skin = skin;this._engineRedrawSkin();}
 
 
 
 this.isWindow = function(id) {var t = (this.wins[id] != null);return t;}
 
 
 this.findByText = function(text) {var wins = new Array();for (var a in this.wins){if (this.wins[a].getText().search(text, "gi") >= 0) {wins[wins.length] = this.wins[a];}
 }
 return wins;}
 
 
 this.window = function(id) {var win = null;if (this.wins[id] != null){win = this.wins[id];}
 return win;}
 
 
 this.forEachWindow = function(handler) {for (var a in this.wins){handler(this.wins[a]);}
 }
 
 
 
 this.getBottommostWindow = function() {var bottommost = this.getTopmostWindow();for (var a in this.wins){if (this.wins[a].zi < bottommost.zi){bottommost = this.wins[a];}
 }
 return (bottommost.zi != 0 ? bottommost : null);}
 
 
 this.getTopmostWindow = function(visibleOnly) {var topmost = {"zi": 0};for (var a in this.wins){if (this.wins[a].zi > topmost.zi){if (visibleOnly == true && !this._isWindowHidden(this.wins[a])) {topmost = this.wins[a];}
 if (visibleOnly != true){topmost = this.wins[a];}
 }
 }
 return (topmost.zi != 0 ? topmost : null);}
 
 
 this.wins = {};for (var a in this.wins)delete this.wins[a];this.autoViewport = true;this._createViewport = function() {this.vp = document.body;this._clearVPCss();this.vp._css = (String(this.vp.className).length > 0 ? this.vp.className : "");this.vp.className += " dhtmlx_skin_"+this.skin+(this._r?" dhx_wins_rtl":"");this.modalCoverI = document.createElement("IFRAME");this.modalCoverI.frameBorder = "0";this.modalCoverI.className = "dhx_modal_cover_ifr";this.modalCoverI.setAttribute("src","javascript:false;");this.modalCoverI.style.display = "none";this.modalCoverI.style.zIndex = 0;this.vp.appendChild(this.modalCoverI);this.modalCoverD = document.createElement("DIV");this.modalCoverD.className = "dhx_modal_cover_dv";this.modalCoverD.style.display = "none";this.modalCoverD.style.zIndex = 0;this.vp.appendChild(this.modalCoverD);this._vpcover = document.createElement("DIV");this._vpcover.className = "dhx_content_vp_cover";this._vpcover.style.display = "none";this.vp.appendChild(this._vpcover);this._carcass = document.createElement("DIV");this._carcass.className = "dhx_carcass_resmove";this._carcass.style.display = "none";if (_isIE){this._carcass.innerHTML = "<iframe border=0 frameborder=0 style='filter: alpha(opacity=0);width: 100%;height:100%;position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;'></iframe><div style='position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;'></div>";this._carcass.childNodes[0].setAttribute("src","javascript:false;");}
 this._carcass.onselectstart = function(e) {e = e||event;e.returnValue = false;}
 this.vp.appendChild(this._carcass);}
 this._clearVPCss = function(css) {this.vp.className = String(this.vp.className).replace(/[a-z_]{1,}/gi,function(t){return({"dhtmlx_skin_dhx_skyblue":1,"dhtmlx_skin_dhx_blue":1,"dhtmlx_skin_dhx_black":1,"dhtmlx_skin_dhx_web":1,"dhtmlx_skin_dhx_terrace":1}[t]==1?"":t);});}
 this._autoResizeViewport = function() {for (var a in this.wins){if (this.wins[a]._isFullScreened){this.wins[a]._content.style.width = document.body.offsetWidth-(_isIE?4:0)+"px";if (document.body.offsetHeight == 0){if (window.innerHeight){this.wins[a]._content.style.height = window.innerHeight+"px";}else {this.wins[a]._content.style.height = document.body.scrollHeight+"px";}
 }else {this.wins[a]._content.style.height = document.body.offsetHeight-(_isIE?4:0)+"px";}
 
 if (this.wins[a].layout != null && _isOpera){this.wins[a].layout._fixCellsContentOpera950();}
 this.wins[a].updateNestedObjects();}
 if (this.wins[a]._isMaximized && this.wins[a].style.display != "none"){this._restoreWindow(a);this._maximizeWindow(a);}
 }
 
 if (this.vp == document.body)return;if (this.autoViewport == false)return;this.vp.style.width = (_isIE ? document.body.offsetWidth - 4 : window.innerWidth) + "px";this.vp.style.height = (_isIE ? document.body.offsetHeight - 4 : window.innerHeight) + "px";for (var a in this.wins){var win = this.wins[a];var overX = false;var overY = false;if (win.x > this.vp.offsetWidth - 10){win.x = this.vp.offsetWidth - 10;overX = true;}
 var skinParams = (win._skinParams!=null?win._skinParams:this.skinParams[this.skin]);if (win.y + skinParams["header_height"] > this.vp.offsetHeight){win.y = this.vp.offsetHeight - skinParams["header_height"];overY = true;}
 if (overX || overY){this._engineRedrawWindowPos(win);}
 }
 }
 
 this.enableAutoViewport = function(state) {if (this.vp != document.body)return;this.autoViewport = state;if (state == false){if (this.vp == document.body)document.body.className = this.vp._css;this.vp.removeChild(this.modalCoverI);this.vp.removeChild(this.modalCoverD);this.vp.removeChild(this._vpcover);this.vp.removeChild(this._carcass);this.vp = null;this.vp = document.createElement("DIV");this.vp.autocreated = true;this.vp.className = "dhtmlx_winviewport dhtmlx_skin_"+this.skin+(this._r?" dhx_wins_rtl":"");this.vp.style.left = "0px";this.vp.style.top = "0px";document.body.appendChild(this.vp);this.vp.ax = 0;this.vp.ay = 0;this._autoResizeViewport();this.vp.appendChild(this.modalCoverI);this.vp.appendChild(this.modalCoverD);this.vp.appendChild(this._vpcover);this.vp.appendChild(this._carcass);}
 }
 
 this.attachViewportTo = function(objId) {if (this.autoViewport == false){this.vp.removeChild(this.modalCoverI);this.vp.removeChild(this.modalCoverD);this.vp.removeChild(this._vpcover);this.vp.removeChild(this._carcass);if (this.vp != document.body)this.vp.parentNode.removeChild(this.vp);this.vp = null;this.vp = (typeof(objId)=="string"?document.getElementById(objId):objId);this.vp.autocreated = false;this._clearVPCss();this.vp.className += " dhtmlx_skin_"+this.skin+(this._r?" dhx_wins_rtl":"");this.vp.style.position = "relative";this.vp.style.overflow = "hidden";this.vp.ax = 0;this.vp.ay = 0;this.vp.appendChild(this.modalCoverI);this.vp.appendChild(this.modalCoverD);this.vp.appendChild(this._vpcover);this.vp.appendChild(this._carcass);}
 }
 
 this.setViewport = function(x, y, width, height, parentObj) {if (this.autoViewport == false){this.vp.style.left = x + "px";this.vp.style.top = y + "px";this.vp.style.width = width + "px";this.vp.style.height = height + "px";if (parentObj != null){parentObj.appendChild(this.vp);}
 this.vp.ax = getAbsoluteLeft(this.vp);this.vp.ay = getAbsoluteTop(this.vp);}
 }
 
 this._effects = {"move" : false, "resize" : false};this.setEffect = function(efName, efValue) {if ((this._effects[efName] != null)&& (typeof(efValue) == "boolean")) {this._effects[efName] = efValue;}
 }
 
 this.getEffect = function(efName) {return this._effects[efName];}
 
 
 this.createWindow = function(id, x, y, width, height) {var win = document.createElement("DIV");win.className = "dhtmlx_window_inactive";win.dir = "ltr";for (var a in this.wins){this.wins[a].zi += this.zIndexStep;this.wins[a].style.zIndex = this.wins[a].zi;}
 
 win.zi = this.zIndexStep;win.style.zIndex = win.zi;win.active = false;win._isWindow = true;win.isWindow = true;win.w = Number(width);win.h = Number(height);win.x = x;win.y = y;this._engineFixWindowPosInViewport(win);win._isModal = false;win._allowResize = true;win.maxW = "auto";win.maxH = "auto";win.minW = 200;win.minH = 140;win.iconsPresent = true;win.icons = new Array(this.imagePath+this.pathPrefix+this.skin+"/active/icon_normal.gif", this.imagePath+this.pathPrefix+this.skin+"/inactive/icon_normal.gif");win._allowMove = true;win._allowMoveGlobal = true;win._allowResizeGlobal = true;win._keepInViewport = false;var skin = this.skinParams[this.skin];win.idd = id;this.vp.appendChild(win);this._engineSetWindowBody(win);this._engineRedrawWindowPos(win);this._engineRedrawWindowSize(win);this._engineUpdateWindowIcon(win, win.icons[0]);this._engineDiableOnSelectInWindow(win, true);this.wins[id] = win;dhtmlxEventable(win);this._engineGetWindowHeader(win)[this._isIPad?"ontouchstart":"onmousedown"] = function(e) {e = e||event;var w = that.wins[this.idd];if (!w.isOnTop()) w.bringToTop();if (that._engineGetWindowHeaderState(w)) return;if (!that._engineCheckHeaderMouseDown(w, e)) return;if (!w._allowMove || !w._allowMoveGlobal)return;that._wasMoved = false;w.moveOffsetX = w.x - (that._isIPad?e.touches[0].clientX:e.clientX);w.moveOffsetY = w.y - (that._isIPad?e.touches[0].clientY:e.clientY);that.movingWin = w;if (that._effects["move"] == false){that._carcass.x = that.movingWin.x;that._carcass.y = that.movingWin.y;that._carcass.w = parseInt(that.movingWin.style.width)+(_isIE?0:-2);that._carcass.h = parseInt(that.movingWin.style.height)+(_isIE?0:-2);that._carcass.style.left = that._carcass.x+"px";that._carcass.style.top = that._carcass.y+"px";that._carcass.style.width = that._carcass.w+"px";that._carcass.style.height = that._carcass.h+"px";that._carcass.style.zIndex = that._getTopZIndex(true)+1;that._carcass._keepInViewport = win._keepInViewport;}
 that._blockSwitcher(true);that._vpcover.style.zIndex = that.movingWin.style.zIndex-1;that._vpcover.style.display = "";e.returnValue = false;e.cancelBubble = true;return false;}
 
 this._engineGetWindowHeader(win).ondblclick = function(e) {var w = that.wins[this.idd];if (!that._engineCheckHeaderMouseDown(w, e||event)) {return;}
 if (w._allowResizeGlobal && !w._isParked){if (w._isMaximized == true){that._restoreWindow(w.idd);}else {that._maximizeWindow(w.idd);}
 }
 
 
 
 
 w = null;}
 
 
 
 win.setText = function(text) {that._engineGetWindowLabel(this).innerHTML = text;}
 
 
 win.getText = function() {return that._engineGetWindowLabel(this).innerHTML;}
 
 
 win.getId = function() {return this.idd;}
 
 
 win.show = function() {that._showWindow(this);}
 
 
 win.hide = function() {that._hideWindow(this);}
 
 
 win.minimize = function() {that._restoreWindow(this.idd);}
 
 
 win.maximize = function() {that._maximizeWindow(this.idd);}
 
 
 win.close = function() {that._closeWindow(this.idd);}
 
 
 win.park = function() {if (this._isParkedAllowed){that._parkWindow(this.winId);}
 }
 
 
 win.stick = function() {that._stickWindow(this.idd);}
 
 win.unstick = function() {that._unstickWindow(this.idd);}
 
 win.isSticked = function() {return this._isSticked;}
 
 
 win.setIcon = function(iconEnabled, iconDisabled) {that._setWindowIcon(win, iconEnabled, iconDisabled);}
 
 
 win.getIcon = function() {return that._getWindowIcon(this);}
 
 
 win.clearIcon = function() {that._clearWindowIcons(this);}
 
 
 win.restoreIcon = function() {that._restoreWindowIcons(this);}
 
 
 win.keepInViewport = function(state) {this._keepInViewport = state;}
 
 
 win.setModal = function(state) {if (state == true){if (that.modalWin != null || that.modalWin == this)return;that._setWindowModal(this, true);}else {if (that.modalWin != this)return;that._setWindowModal(this, false);}
 }
 
 
 win.isModal = function() {return this._isModal;}
 
 
 win.isHidden = function() {return that._isWindowHidden(this);}
 
 
 win.isMaximized = function() {return this._isMaximized;}
 
 
 win.isParked = function() {return this._isParked;}
 
 
 win.allowPark = function() {that._allowParking(this);}
 
 win.denyPark = function() {that._denyParking(this);}
 
 win.isParkable = function() {return this._isParkedAllowed;}
 
 
 win.allowResize = function() {that._allowReszieGlob(this);}
 
 win.denyResize = function() {that._denyResize(this);}
 
 
 win.isResizable = function() {return this._allowResizeGlobal;}
 
 
 win.allowMove = function() {if (!this._isMaximized){this._allowMove = true;}
 this._allowMoveGlobal = true;}
 
 win.denyMove = function() {this._allowMoveGlobal = false;}
 
 win.isMovable = function() {return this._allowMoveGlobal;}
 
 
 win.bringToTop = function() {that._bringOnTop(this);that._makeActive(this);}
 
 
 win.bringToBottom = function() {that._bringOnBottom(this);}
 
 
 win.isOnTop = function() {return that._isWindowOnTop(this);}
 
 
 win.isOnBottom = function() {return that._isWindowOnBottom(this);}
 
 
 win.setPosition = function(x, y) {this.x = x;this.y = y;that._engineFixWindowPosInViewport(this);that._engineRedrawWindowPos(this);}
 
 
 win.getPosition = function() {return new Array(this.x, this.y);}
 
 
 win.setDimension = function(width, height) {if (width != null){if (this.maxW != "auto")if (width > this.maxW)width = this.maxW;if (width < this.minW)width = this.minW;this.w = width;}
 if (height != null){if (this.maxH != "auto")if (height > this.maxH)height = this.maxH;if (height < this.minH)height = this.minH;this.h = height;}
 that._fixWindowDimensionInViewport(this);that._engineFixWindowPosInViewport(this);that._engineRedrawWindowSize(this);this.updateNestedObjects();}
 
 
 win.getDimension = function() {return new Array(this.w, this.h);}
 
 
 win.setMaxDimension = function(maxWidth, maxHeight) {this.maxW = (isNaN(maxWidth)?"auto":maxWidth);this.maxH = (isNaN(maxHeight)?"auto":maxHeight);that._engineRedrawWindowSize(this);}
 
 
 win.getMaxDimension = function() {return new Array(this.maxW, this.maxH);}
 
 
 win.setMinDimension = function(minWidth, minHeight) {if (minWidth != null){this.minW = minWidth;}
 if (minHeight != null){this.minH = minHeight;}
 that._fixWindowDimensionInViewport(this);that._engineRedrawWindowPos(this);}
 
 
 win.getMinDimension = function() {return new Array(this.minW, this.minH);}
 
 win._adjustToContent = function(cw, ch) {that._engineAdjustWindowToContent(this, cw, ch);}
 win._doOnAttachMenu = function() {that._engineRedrawWindowSize(this);this.updateNestedObjects();}
 win._doOnAttachToolbar = function() {that._engineRedrawWindowSize(this);this.updateNestedObjects();}
 win._doOnAttachStatusBar = function() {that._engineRedrawWindowSize(this);this.updateNestedObjects();}
 win._doOnFrameMouseDown = function() {this.bringToTop();}
 win._doOnFrameContentLoaded = function() {that.callEvent("onContentLoaded",[this]);}
 

 
 
 win.addUserButton = function(id, pos, title, label) {var userBtn = that._addUserButton(this, id, pos, title, label);return userBtn;}
 
 
 win.removeUserButton = function(id) {id = String(id).toLowerCase();if (!((id == "minmax1")|| (id == "minmax2") || (id == "park") || (id == "close") || (id == "stick") || (id == "unstick") || (id == "help"))) {if (btn != null){that._removeUserButton(this, id);}
 }
 }
 
 win.progressOn = function() {that._engineSwitchWindowProgress(this, true);}
 
 win.progressOff = function() {that._engineSwitchWindowProgress(this, false);}
 
 win.setToFullScreen = function(state) {that._setWindowToFullScreen(this, state);}
 
 win.showHeader = function() {that._engineSwitchWindowHeader(this, true);}
 
 win.hideHeader = function() {that._engineSwitchWindowHeader(this, false);}
 
 win.progressOff();win.canStartResize = false;win.onmousemove = function(e) {if (_isIE && this._isMaximized)return true;e = e || event;var targetObj = e.target || e.srcElement;if (String(targetObj.className).search("dhtmlx_wins_resizer") < 0) targetObj = null;if (!this._allowResize || this._allowResizeGlobal == false || !targetObj){if (targetObj){if (targetObj.style.cursor != "default")targetObj.style.cursor = "default";}
 if (this.style.cursor != "default")this.style.cursor = "default";this.canStartResize = false;return true;}
 
 if (that.resizingWin != null)return;if (that.movingWin != null)return;if (this._isParked)return;if (that._isIPad){var px = e.touches[0].clientX;var py = e.touches[0].clientY;}else {var px = (_isIE||_isOpera?e.offsetX:e.layerX);var py = (_isIE||_isOpera?e.offsetY:e.layerY);}
 
 
 var resDir = that._engineAllowWindowResize(win, targetObj, px, py);if (resDir == null){this.canStartResize = false;if (targetObj.style.cursor != "default")targetObj.style.cursor = "default";if (this.style.cursor != "default")this.style.cursor = "default";return;}
 
 that.resizingDirs = resDir;var xy = {x:e.clientX,y:e.clientY};switch (that.resizingDirs) {case "border_left":
 targetObj.style.cursor = "w-resize";this.resizeOffsetX = this.x - xy.x;break;case "border_right":
 targetObj.style.cursor = "e-resize";this.resizeOffsetXW = this.x + this.w - xy.x;break;case "border_top":
 targetObj.style.cursor = "n-resize";this.resizeOffsetY = this.y - xy.y;break;case "border_bottom":
 targetObj.style.cursor = "n-resize";this.resizeOffsetYH = this.y + this.h - xy.y;break;case "corner_left":
 targetObj.style.cursor = "sw-resize";this.resizeOffsetX = this.x - e.clientX;this.resizeOffsetYH = this.y + this.h - xy.y;break;case "corner_up_left":
 targetObj.style.cursor = "nw-resize";this.resizeOffsetY = this.y - xy.y;this.resizeOffsetX = this.x - xy.x;break;case "corner_right":
 targetObj.style.cursor = "nw-resize";this.resizeOffsetXW = this.x + this.w - xy.x;this.resizeOffsetYH = this.y + this.h - xy.y;break;case "corner_up_right":
 targetObj.style.cursor = "sw-resize";this.resizeOffsetY = this.y - xy.y;this.resizeOffsetXW = this.x + this.w - xy.x;break;}
 this.canStartResize = true;this.style.cursor = targetObj.style.cursor;e.cancelBubble = true;e.returnValue = false;return false;}
 win.onmousedown = function(e) {if (that._getActive()!= this) that._makeActive(this);that._bringOnTop(this);if (this.canStartResize){that._blockSwitcher(true);that.resizingWin = this;if (!that._effects["resize"]){that._carcass.x = that.resizingWin.x;that._carcass.y = that.resizingWin.y;that._carcass.w = Number(that.resizingWin.w)+(_isIE?0:-2);that._carcass.h = Number(that.resizingWin.h)+(_isIE?0:-2);that._carcass.style.left = that._carcass.x+"px";that._carcass.style.top = that._carcass.y+"px";that._carcass.style.width = that._carcass.w+"px";that._carcass.style.height = that._carcass.h+"px";that._carcass.style.zIndex = that._getTopZIndex(true)+1;that._carcass.style.cursor = this.style.cursor;that._carcass._keepInViewport = this._keepInViewport;that._carcass.style.display = "";}
 
 that._vpcover.style.zIndex = that.resizingWin.style.zIndex-1;that._vpcover.style.display = "";if (this.vs[this.av].layout){this.callEvent("_onBeforeTryResize", [this]);}
 e = e||event;}
 
 }
 
 this._addDefaultButtons(win.idd);win.button = function(id) {id = String(id).toLowerCase();var b = null;if (this.btns[id] != null){b = this.btns[id];}
 return b;}
 
 
 win.center = function() {that._centerWindow(this, false);}
 
 win.centerOnScreen = function() {that._centerWindow(this, true);}
 
 
 
 win._attachContent("empty", null);win._redraw = function() {that._engineRedrawWindowSize(this);}
 
 win.bringToTop();this._engineRedrawWindowSize(win);return this.wins[id];}
 
 this.zIndexStep = 50;this._getTopZIndex = function(ignoreSticked) {var topZIndex = 0;for (var a in this.wins){if (ignoreSticked == true){if (this.wins[a].zi > topZIndex){topZIndex = this.wins[a].zi;}
 }else {if (this.wins[a].zi > topZIndex && !this.wins[a]._isSticked){topZIndex = this.wins[a].zi;}
 }
 }
 return topZIndex;}
 
 this.movingWin = null;this._moveWindow = function(e) {if (this.movingWin != null){if (!this.movingWin._allowMove || !this.movingWin._allowMoveGlobal){return;}
 if (this._effects["move"] == true){if (this._engineGetWindowHeader(this.movingWin).style.cursor != "move") {this._engineGetWindowHeader(this.movingWin).style.cursor = "move";}
 
 this._wasMoved = true;this.movingWin.x = (this._isIPad?e.touches[0].clientX:e.clientX) + this.movingWin.moveOffsetX;this.movingWin.y = (this._isIPad?e.touches[0].clientY:e.clientY) + this.movingWin.moveOffsetY;this._engineFixWindowPosInViewport(this.movingWin);this._engineRedrawWindowPos(this.movingWin);}else {if (this._carcass.style.display != ""){this._carcass.style.display = "";}
 
 if (this._carcass.style.cursor != "move"){this._carcass.style.cursor = "move";}
 if (this._engineGetWindowHeader(this.movingWin).style.cursor != "move") {this._engineGetWindowHeader(this.movingWin).style.cursor = "move";}
 
 this._carcass.x = (this._isIPad?e.touches[0].clientX:e.clientX) + this.movingWin.moveOffsetX;this._carcass.y = (this._isIPad?e.touches[0].clientY:e.clientY) + this.movingWin.moveOffsetY;this._wasMoved = true;this._engineFixWindowPosInViewport(this._carcass);this._carcass.style.left = this._carcass.x+"px";this._carcass.style.top = this._carcass.y+"px";}
 }
 
 if (this.resizingWin != null){if (!this.resizingWin._allowResize){return;}
 
 
 
 var xy = {x:e.clientX,y:e.clientY};if (this.resizingDirs == "border_left" || this.resizingDirs == "corner_left" || this.resizingDirs == "corner_up_left"){if (this._effects["resize"]){var ofs = xy.x + this.resizingWin.resizeOffsetX;var sign = (ofs > this.resizingWin.x ? -1 : 1);newW = this.resizingWin.w + Math.abs(ofs - this.resizingWin.x)*sign;if ((newW < this.resizingWin.minW)&& (sign < 0)) {this.resizingWin.x = this.resizingWin.x + this.resizingWin.w - this.resizingWin.minW;this.resizingWin.w = this.resizingWin.minW;}else {this.resizingWin.w = newW;this.resizingWin.x = ofs;}
 this._engineRedrawWindowPos(this.resizingWin);this._engineRedrawWindowSize(this.resizingWin);}else {var ofs = xy.x + this.resizingWin.resizeOffsetX;var sign = (ofs > this._carcass.x ? -1 : 1);newW = this._carcass.w + Math.abs(ofs - this._carcass.x)*sign;if (newW > this.resizingWin.maxW){newW = this.resizingWin.maxW;ofs = this._carcass.x + this._carcass.w - this.resizingWin.maxW;}
 if ((newW < this.resizingWin.minW)&& (sign < 0)) {this._carcass.x = this._carcass.x + this._carcass.w - this.resizingWin.minW;this._carcass.w = this.resizingWin.minW;}else {this._carcass.w = newW;this._carcass.x = ofs;}
 this._carcass.style.left = this._carcass.x+"px";this._carcass.style.width = this._carcass.w+"px";}
 }
 
 if (this.resizingDirs == "border_right" || this.resizingDirs == "corner_right" || this.resizingDirs == "corner_up_right"){if (this._effects["resize"]){var ofs = xy.x - (this.resizingWin.x + this.resizingWin.w) + this.resizingWin.resizeOffsetXW;newW = this.resizingWin.w + ofs;if (newW < this.resizingWin.minW){newW = this.resizingWin.minW;}
 this.resizingWin.w = newW;this._engineRedrawWindowPos(this.resizingWin);this._engineRedrawWindowSize(this.resizingWin);}else {var ofs = xy.x - (this._carcass.x + this._carcass.w) + this.resizingWin.resizeOffsetXW;newW = this._carcass.w + ofs;if (newW < this.resizingWin.minW)newW = this.resizingWin.minW;if (this.resizingWin.maxW != "auto")if (newW > this.resizingWin.maxW)newW = this.resizingWin.maxW;this._carcass.w = newW;this._carcass.style.width = this._carcass.w+"px";}
 }
 
 if (this.resizingDirs == "border_bottom" || this.resizingDirs == "corner_left" || this.resizingDirs == "corner_right"){if (this._effects["resize"]){var ofs = xy.y - (this.resizingWin.y + this.resizingWin.h) + this.resizingWin.resizeOffsetYH;newH = this.resizingWin.h + ofs;if (newH < this.resizingWin.minH)newH = this.resizingWin.minH;this.resizingWin.h = newH;this._engineRedrawWindowPos(this.resizingWin);this._engineRedrawWindowSize(this.resizingWin);}else {var ofs = xy.y - (this._carcass.y + this._carcass.h) + this.resizingWin.resizeOffsetYH;newH = this._carcass.h + ofs;if (newH < this.resizingWin.minH)newH = this.resizingWin.minH;if (newH > this.resizingWin.maxH)newH = this.resizingWin.maxH;this._carcass.h = newH;this._carcass.style.height = this._carcass.h+"px";}
 }
 if (this.resizingDirs == "border_top" || this.resizingDirs == "corner_up_right" || this.resizingDirs == "corner_up_left"){if (this._effects["resize"]){}else {var ofs = xy.y + this.resizingWin.resizeOffsetY;var sign = (ofs > this.resizingWin.y ? -1 : 1);newH = this.resizingWin.h + Math.abs(ofs - this.resizingWin.y)*sign;if (newH > this.resizingWin.maxH){newH = this.resizingWin.maxH;ofs = this.resizingWin.y + this.resizingWin.h - this.resizingWin.maxH;}
 if ((newH < this.resizingWin.minH)&& (sign < 0)) {this._carcass.y = this._carcass.y + this._carcass.h - this.resizingWin.minH;this._carcass.h = this.resizingWin.minH;}else {this._carcass.h = newH+(_isIE?0:-2);this._carcass.y = ofs;}
 this._carcass.style.top = this._carcass.y+"px";this._carcass.style.height = this._carcass.h+"px";}
 }
 }
 }
 
 this._stopMove = function() {if (this.movingWin != null){if (this._effects["move"]){var win = this.movingWin;this.movingWin = null;this._blockSwitcher(false);this._engineGetWindowHeader(win).style.cursor = "";if (_isFF){win.h++;that._engineRedrawWindowPos(win);win.h--;that._engineRedrawWindowPos(win);}
 }else {this._carcass.style.cursor = "";this._carcass.style.display = "none";var win = this.movingWin;this._engineGetWindowHeader(win).style.cursor = "";this.movingWin = null;this._blockSwitcher(false);win.setPosition(parseInt(this._carcass.style.left), parseInt(this._carcass.style.top));}
 
 this._vpcover.style.display = "none";if (this._wasMoved){if (win.checkEvent("onMoveFinish")) {win.callEvent("onMoveFinish",[win]);}else {this.callEvent("onMoveFinish",[win]);}
 }
 this._wasMoved = false;}
 if (this.resizingWin != null){var win = this.resizingWin;this.resizingWin = null;this._blockSwitcher(false);if (!this._effects["resize"]){this._carcass.style.display = "none";win.setDimension(this._carcass.w+(_isIE?0:2), this._carcass.h+(_isIE?0:2));win.setPosition(this._carcass.x, this._carcass.y);}else {win.updateNestedObjects();}
 
 if (win.vs[win.av].layout){win.vs[win.av].layout.callEvent("onResize", []);}
 
 
 
 this._vpcover.style.display = "none";if (win.checkEvent("onResizeFinish")) {win.callEvent("onResizeFinish",[win]);}else {this.callEvent("onResizeFinish",[win]);}
 }
 }
 
 
 
 
 
 this._fixWindowDimensionInViewport = function(win) {if (win.w < win.minW){win.w = win.minW;}
 if (win._isParked)return;if (win.h < win.minH){win.h = win.minH;}
 }
 
 this._bringOnTop = function(win) {var cZIndex = win.zi;var topZIndex = this._getTopZIndex(win._isSticked);for (var a in this.wins){if (this.wins[a] != win){if (win._isSticked || (!win._isSticked && !this.wins[a]._isSticked)) {if (this.wins[a].zi > cZIndex){this.wins[a].zi = this.wins[a].zi - this.zIndexStep;this.wins[a].style.zIndex = this.wins[a].zi;}
 }
 }
 }
 win.zi = topZIndex;win.style.zIndex = win.zi;}
 
 this._makeActive = function(win, ignoreFocusEvent) {for (var a in this.wins){if (this.wins[a] == win){var needEvent = false;if (this.wins[a].className != "dhtmlx_window_active" && !ignoreFocusEvent){needEvent = true;}
 this.wins[a].className = "dhtmlx_window_active";this._engineUpdateWindowIcon(this.wins[a], this.wins[a].icons[0]);if (needEvent == true){if (win.checkEvent("onFocus")) {win.callEvent("onFocus",[win]);}else {this.callEvent("onFocus",[win]);}
 }
 }else {this.wins[a].className = "dhtmlx_window_inactive";this._engineUpdateWindowIcon(this.wins[a], this.wins[a].icons[1]);}
 }
 }
 
 this._getActive = function() {var win = null;for (var a in this.wins){if (this.wins[a].className == "dhtmlx_window_active"){win = this.wins[a];}
 }
 return win;}
 
 this._centerWindow = function(win, onScreen) {if (win._isMaximized == true)return;if (onScreen == true){var vpw = (_isIE?document.body.offsetWidth:window.innerWidth);var vph = (_isIE?document.body.offsetHeight:window.innerHeight);}else {var vpw = (this.vp==document.body?document.body.offsetWidth:(Number(parseInt(this.vp.style.width))&&String(this.vp.style.width).search("%")==-1?parseInt(this.vp.style.width):this.vp.offsetWidth));var vph = (this.vp==document.body?document.body.offsetHeight:(Number(parseInt(this.vp.style.height))&&String(this.vp.style.height).search("%")==-1?parseInt(this.vp.style.height):this.vp.offsetHeight));}
 var newX = Math.round((vpw/2) - (win.w/2));var newY = Math.round((vph/2) - (win.h/2));win.x = newX;win.y = newY;this._engineFixWindowPosInViewport(win);this._engineRedrawWindowPos(win);}
 
 this._addDefaultButtons = function(winId) {var win = this.wins[winId];var btnStick = this._engineGetWindowButton(win, "stick");btnStick.title = this.i18n.stick;btnStick.isVisible = false;btnStick.style.display = "none";btnStick._isEnabled = true;btnStick.isPressed = false;btnStick.label = "stick";btnStick._doOnClick = function() {this.isPressed = true;that._stickWindow(this.winId);}
 
 
 var btnSticked = this._engineGetWindowButton(win, "sticked");btnSticked.title = this.i18n.unstick;btnSticked.isVisible = false;btnSticked.style.display = "none";btnSticked._isEnabled = true;btnSticked.isPressed = false;btnSticked.label = "sticked";btnSticked._doOnClick = function() {this.isPressed = false;that._unstickWindow(this.winId);}
 
 
 var btnHelp = this._engineGetWindowButton(win, "help");btnHelp.title = this.i18n.help;btnHelp.isVisible = false;btnHelp.style.display = "none";btnHelp._isEnabled = true;btnHelp.isPressed = false;btnHelp.label = "help";btnHelp._doOnClick = function() {that._needHelp(this.winId);}
 
 
 var btnPark = this._engineGetWindowButton(win, "park");btnPark.titleIfParked = this.i18n.parkdown;btnPark.titleIfNotParked = this.i18n.parkup;btnPark.title = btnPark.titleIfNotParked;btnPark.isVisible = true;btnPark._isEnabled = true;btnPark.isPressed = false;btnPark.label = "park";btnPark._doOnClick = function() {that._parkWindow(this.winId);}
 
 
 var btnMinMax1 = this._engineGetWindowButton(win, "minmax1");btnMinMax1.title = this.i18n.maximize;btnMinMax1.isVisible = true;btnMinMax1._isEnabled = true;btnMinMax1.isPressed = false;btnMinMax1.label = "minmax1";btnMinMax1._doOnClick = function() {that._maximizeWindow(this.winId);}
 
 
 var btnMinMax2 = this._engineGetWindowButton(win, "minmax2");btnMinMax2.title = this.i18n.restore;btnMinMax2.isVisible = false;btnMinMax2.style.display = "none";btnMinMax2._isEnabled = true;btnMinMax2.isPressed = false;btnMinMax2.label = "minmax2";btnMinMax2._doOnClick = function() {that._restoreWindow(this.winId);}
 
 
 var btnClose = this._engineGetWindowButton(win, "close");btnClose.title = this.i18n.close;btnClose.isVisible = true;btnClose._isEnabled = true;btnClose.isPressed = false;btnClose.label = "close";btnClose._doOnClick = function() {that._closeWindow(this.winId);}
 
 
 var btnDock = this._engineGetWindowButton(win, "dock");btnDock.title = this.i18n.dock;btnDock.style.display = "none";btnDock.isVisible = false;btnDock._isEnabled = true;btnDock.isPressed = false;btnDock.label = "dock";btnDock._doOnClick = function() {}
 
 
 win._isSticked = false;win._isParked = false;win._isParkedAllowed = true;win._isMaximized = false;win._isDocked = false;win.btns = {};win.btns["stick"] = btnStick;win.btns["sticked"] = btnSticked;win.btns["help"] = btnHelp;win.btns["park"] = btnPark;win.btns["minmax1"] = btnMinMax1;win.btns["minmax2"] = btnMinMax2;win.btns["close"] = btnClose;win.btns["dock"] = btnDock;for (var a in win.btns){win.btns[a].winId = win.idd;this._attachEventsOnButton(win.idd, a);}
 
 win = btnStick = btnSticked = btnHelp = btnPark = btnMinMax1 = btnMinMax2 = btnClose = btnDock = null;}
 this._attachEventsOnButton = function(winId, btnId) {var btn = this.wins[winId].btns[btnId];if (!this._isIPad){btn.onmouseover = function() {if (this._isEnabled){this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_over_"+(this.isPressed?"pressed":"default");}else {this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_disabled";}
 }
 btn.onmouseout = function() {if (this._isEnabled){this.isPressed = false;this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_default";}else {this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_disabled";}
 }
 btn.onmousedown = function() {if (this._isEnabled){this.isPressed = true;this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_over_pressed";}else {this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_disabled";}
 }
 btn.onmouseup = function() {if (this._isEnabled){var wasPressed = this.isPressed;this.isPressed = false;this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_over_default";if (wasPressed){if (this.checkEvent("onClick")) {this.callEvent("onClick", [that.wins[this.winId], this]);}else {this._doOnClick();}
 }
 }else {this.className = "dhtmlx_wins_btns_button dhtmlx_button_"+this.label+"_disabled";}
 }
 
 }else {btn.ontouchstart = function(e) {e.cancelBubble = true;e.returnValue = false;return false;}
 btn.ontouchend = function(e) {e.cancelBubble = true;e.returnValue = false;if (!this._isEnabled)return false;if (this.checkEvent("onClick")) {this.callEvent("onClick", [that.wins[this.winId], this]);}else {this._doOnClick();}
 
 
 return false;}
 
 }
 

 btn.show = function() {that._showButton(that.wins[this.winId], this.label, true);}
 btn.hide = function() {that._hideButton(that.wins[this.winId], this.label, true);}
 btn.enable = function() {that._enableButton(that.wins[this.winId], this.label);}
 btn.disable = function() {that._disableButton(that.wins[this.winId], this.label);}
 btn.isEnabled = function() {return this._isEnabled;}
 btn.isHidden = function() {return (!this.isVisible);}
 
 dhtmlxEventable(btn);btn = null;}
 this._parkWindow = function(winId, parkBeforeMinMax) {var win = this.wins[winId];if (!win._isParkedAllowed && !parkBeforeMinMax)return;if (this.enableParkEffect && win.parkBusy)return;if (win._isParked){if (this.enableParkEffect && !parkBeforeMinMax){win.parkBusy = true;this._doParkDown(win);}else {win.h = win.lastParkH;this._engineRedrawWindowSize(win);this._engineDoOnWindowParkDown(win);win.updateNestedObjects();win.btns["park"].title = win.btns["park"].titleIfNotParked;if (win._allowResizeGlobal == true){this._enableButton(win, "minmax1");this._enableButton(win, "minmax2");}
 win._isParked = false;if (!parkBeforeMinMax)if (win.checkEvent("onParkDown")) win.callEvent("onParkDown", [win]);else this.callEvent("onParkDown", [win]);}
 }else {if (this.enableParkEffect && !parkBeforeMinMax){win.lastParkH = (String(win.h).search(/\%$/)==-1?win.h:win.offsetHeight);if (win._allowResizeGlobal == true){this._disableButton(win, "minmax1");this._disableButton(win, "minmax2");}
 if (this.enableParkEffect){win.parkBusy = true;this._doParkUp(win);}else {var skinParams = (win._skinParams!=null?win._skinParams:this.skinParams[this.skin]);win.h = skinParams["header_height"] + skinParams["border_bottom_height"];win.btns["park"].title = win.btns["park"].titleIfParked;}
 }else {win.lastParkH = (String(win.h).search(/\%$/)==-1?win.h:win.offsetHeight);win.h = this._engineGetWindowParkedHeight(win);this._engineRedrawWindowSize(win);this._engineDoOnWindowParkUp(win);win.btns["park"].title = win.btns["park"].titleIfParked;win._isParked = true;if (!parkBeforeMinMax)if (win.checkEvent("onParkUp")) win.callEvent("onParkUp", [win]);else this.callEvent("onParkUp", [win]);}
 }
 win = null;}
 
 this._allowParking = function(win) {win._isParkedAllowed = true;this._enableButton(win, "park");}
 this._denyParking = function(win) {win._isParkedAllowed = false;this._disableButton(win, "park");}
 
 
 this.enableParkEffect = false;this.parkStartSpeed = 80;this.parkSpeed = this.parkStartSpeed;this.parkTM = null;this.parkTMTime = 5;this._doParkUp = function(win) {if (String(win.h).search(/\%$/) != -1) {win.h = win.offsetHeight;}
 win.h -= this.parkSpeed;var hh = this._engineGetWindowParkedHeight(win);if (win.h <= hh){win.h = hh;this._engineGetWindowButton(win, "park").title = this._engineGetWindowButton(win, "park").titleIfParked;win._isParked = true;win.parkBusy = false;this._engineRedrawWindowSize(win);this._engineDoOnWindowParkUp(win);if (win.checkEvent("onParkUp")) win.callEvent("onParkUp", [win]);else this.callEvent("onParkUp", [win]);}else {this._engineRedrawWindowSize(win);this.parkTM = window.setTimeout(function(){that._doParkUp(win);}, this.parkTMTime);}
 }
 
 this._doParkDown = function(win) {win.h += this.parkSpeed;if (win.h >= win.lastParkH){win.h = win.lastParkH;this._engineGetWindowButton(win, "park").title = this._engineGetWindowButton(win, "park").titleIfNotParked;if (win._allowResizeGlobal == true){this._enableButton(win, "minmax1");this._enableButton(win, "minmax2");}
 win._isParked = false;win.parkBusy = false;this._engineRedrawWindowSize(win);win.updateNestedObjects();this._engineDoOnWindowParkDown(win);if (win.checkEvent("onParkDown")) win.callEvent("onParkDown", [win]);else this.callEvent("onParkDown", [win]);}else {this._engineRedrawWindowSize(win);this.parkTM = window.setTimeout(function(){that._doParkDown(win);}, this.parkTMTime);}
 }
 this._enableButton = function(win, btn) {var button = this._engineGetWindowButton(win, btn);if (!button)return;button._isEnabled = true;button.className = "dhtmlx_wins_btns_button dhtmlx_button_"+button.label+"_default";button = null;}
 
 this._disableButton = function(win, btn) {var button = this._engineGetWindowButton(win, btn);if (!button)return;button._isEnabled = false;button.className = "dhtmlx_wins_btns_button dhtmlx_button_"+win.btns[btn].label+"_disabled";button = null;}
 
 this._allowReszieGlob = function(win) {win._allowResizeGlobal = true;this._enableButton(win, "minmax1");this._enableButton(win, "minmax2");}
 
 this._denyResize = function(win) {win._allowResizeGlobal = false;this._disableButton(win, "minmax1");this._disableButton(win, "minmax2");}
 
 this._maximizeWindow = function(winId) {var win = this.wins[winId];if (win._allowResizeGlobal == false)return;var isParkedBeforeMinMax = win._isParked;if (isParkedBeforeMinMax)this._parkWindow(win.idd, true);win.lastMaximizeX = win.x;win.lastMaximizeY = win.y;win.lastMaximizeW = win.w;win.lastMaximizeH = win.h;if (win.maxW != "auto" && win.maxW != "auto"){win.x = Math.round(win.x+(win.w-win.maxW)/2);win.y = Math.round(win.y+(win.h-win.maxH)/2);win._allowMove = true;}else {win.x = 0;win.y = 0;win._allowMove = false;}
 win._isMaximized = true;win._allowResize = false;win.w = (win.maxW == "auto" ? (this.vp == document.body ? "100%" : (this.vp.style.width != "" && String(this.vp.style.width).search("%") == -1 ? parseInt(this.vp.style.width) : this.vp.offsetWidth)) : win.maxW);win.h = (win.maxH == "auto" ? (this.vp == document.body ? "100%" : (this.vp.style.height != "" && String(this.vp.style.width).search("%") == -1 ? parseInt(this.vp.style.height) : this.vp.offsetHeight)) : win.maxH);this._hideButton(win, "minmax1");this._showButton(win, "minmax2");this._engineRedrawWindowPos(win);if (isParkedBeforeMinMax){this._parkWindow(win.idd, true);}else {this._engineRedrawWindowSize(win);win.updateNestedObjects();}
 
 if (win.checkEvent("onMaximize")) win.callEvent("onMaximize", [win]);else this.callEvent("onMaximize", [win]);win = null;}
 
 this._restoreWindow = function(winId) {var win = this.wins[winId];if (win._allowResizeGlobal == false)return;if (win.layout)win.layout._defineWindowMinDimension(win);var isParkedBeforeMinMax = win._isParked;if (isParkedBeforeMinMax)this._parkWindow(win.idd, true);if (win.maxW != "auto" && win.maxW != "auto"){win.x = Math.round(win.x+(win.w-win.lastMaximizeW)/2);win.y = Math.round(win.y+(win.h-win.lastMaximizeH)/2);}else {win.x = win.lastMaximizeX;win.y = win.lastMaximizeY;}
 win.w = win.lastMaximizeW;win.h = win.lastMaximizeH;win._isMaximized = false;win._allowMove = win._allowMoveGlobal;win._allowResize = true;this._fixWindowDimensionInViewport(win);this._hideButton(win, "minmax2");this._showButton(win, "minmax1");this._engineRedrawWindowPos(win);if (isParkedBeforeMinMax){this._parkWindow(win.idd, true);}else {this._engineRedrawWindowSize(win);win.updateNestedObjects();}
 
 if (win.checkEvent("onMinimize")) win.callEvent("onMinimize", [win]);else this.callEvent("onMinimize", [win]);win = null;}
 this._showButton = function(win, btn, userShow) {var button = this._engineGetWindowButton(win, btn);if (!button)return;if ((!userShow && button._userHide)|| button.isVisible === true) return;button.isVisible = true;button.style.display = "";button.style.visibility = "visible";button._userHide = !(userShow==true);this._engineRedrawWindowTitle(win);button = null;}
 
 this._hideButton = function(win, btn, userHide) {var button = this._engineGetWindowButton(win, btn);if (!button || (!userHide && button.isVisible === false)) return;button.isVisible = false;button.style.display = "none";button.style.visibility = "hidden";button._userHide = (userHide==true);this._engineRedrawWindowTitle(win);button = null;}
 this._showWindow = function(win) {win.style.display = "";if (win.checkEvent("onShow")) {win.callEvent("onShow", [win]);}else {this.callEvent("onShow", [win]);}
 
 var w = this._getActive();if (w == null){this._bringOnTop(win);this._makeActive(win);}else if (this._isWindowHidden(w)) {this._bringOnTop(win);this._makeActive(win);}
 }
 
 this._hideWindow = function(win) {win.style.display = "none";if (win.checkEvent("onHide")) {win.callEvent("onHide", [win]);}else {this.callEvent("onHide", [win]);}
 
 var w = this.getTopmostWindow(true);if (w != null){this._bringOnTop(w);this._makeActive(w);}
 }
 
 this._isWindowHidden = function(win) {var isHidden = (win.style.display == "none");return isHidden;}
 
 this._closeWindow = function(winId) {var win = this.wins[winId];if (this._focusFixIE){this._focusFixIE.style.top = (this.vp==document.body?0:getAbsoluteTop(this.vp))+Number(win.y)+"px";this._focusFixIE.focus();}
 
 
 if (win.checkEvent("onClose")) {if (!win.callEvent("onClose", [win])) return;}else {if(!this.callEvent("onClose", [win])) return;}
 
 
 
 
 win = null;this._removeWindowGlobal(winId);var latest = {"zi": 0 };for (var a in this.wins){if (this.wins[a].zi > latest.zi){latest = this.wins[a];}}
 if (latest != null){this._makeActive(latest);}
 
 
 }
 
 this._needHelp = function(winId) {var win = this.wins[winId];if (win.checkEvent("onHelp")) {win.callEvent("onHelp", [win]);}else {this.callEvent("onHelp", [win]);}
 win = null;}
 this._setWindowIcon = function(win, iconEnabled, iconDisabled) {win.iconsPresent = true;win.icons[0] = this.imagePath + iconEnabled;win.icons[1] = this.imagePath + iconDisabled;this._engineUpdateWindowIcon(win, win.icons[win.isOnTop()?0:1]);}
 
 this._getWindowIcon = function(win) {if (win.iconsPresent){return new Array(win.icons[0], win.icons[1]);}else {return new Array(null, null);}
 }
 
 this._clearWindowIcons = function(win) {win.iconsPresent = false;win.icons[0] = this.imagePath + this.pathPrefix + this.skin + "/active/icon_blank.gif";win.icons[1] = this.imagePath + this.pathPrefix + this.skin + "/inactive/icon_blank.gif";this._engineUpdateWindowIcon(win, win.icons[win.isOnTop()?0:1]);}
 
 this._restoreWindowIcons = function(win) {win.iconsPresent = true;win.icons[0] = this.imagePath + this.pathPrefix + this.skin + "/active/icon_normal.gif";win.icons[1] = this.imagePath + this.pathPrefix + this.skin + "/inactive/icon_normal.gif";this._engineUpdateWindowIcon(win, win.icons[win.className=="dhtmlx_window_active"?0:1]);}
 
 this._attachWindowContentTo = function(win, obj, w, h) {var data = this._engineGetWindowContent(win).parentNode;data.parentNode.removeChild(data);win.hide();data.style.left = "0px";data.style.top = "0px";data.style.width = (w!=null?w:obj.offsetWidth)+"px";data.style.height = (h!=null?h:obj.offsetHeight)+"px";data.style.position = "relative";obj.appendChild(data);this._engineGetWindowContent(win).style.width = data.style.width;this._engineGetWindowContent(win).style.height = data.style.height;}
 
 this._setWindowToFullScreen = function(win, state) {if (state == true){var data = win._content;data.parentNode.removeChild(data);win.hide();win._isFullScreened = true;data.style.left = "0px";data.style.top = "0px";data.style.width = document.body.offsetWidth-(_isIE?4:0)+"px";if (document.body.offsetHeight == 0){if (window.innerHeight){data.style.height = window.innerHeight+"px";}else {data.style.height = document.body.scrollHeight+"px";}
 }else {data.style.height = document.body.offsetHeight-(_isIE?4:0)+"px";}
 
 data.style.position = "absolute";document.body.appendChild(data);}else if (state == false){var data = win.childNodes[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[1];var base = win._content;document.body.removeChild(base);data.appendChild(base);win._isFullScreened = false;win.setDimension(win.w, win.h);win.show();win.bringToTop();win.center();}
 win.updateNestedObjects();}
 
 this._isWindowOnTop = function(win) {var state = (this.getTopmostWindow() == win);return state;}
 
 this._bringOnBottom = function(win) {for (var a in this.wins){if (this.wins[a].zi < win.zi){this.wins[a].zi += this.zIndexStep;this.wins[a].style.zIndex = this.wins[a].zi;}
 }
 win.zi = 50;win.style.zIndex = win.zi;this._makeActive(this.getTopmostWindow());}
 
 this._isWindowOnBottom = function(win) {var state = true;for (var a in this.wins){if (this.wins[a] != win){state = state && (this.wins[a].zi > win.zi);}
 }
 return state;}
 
 this._stickWindow = function(winId) {var win = this.wins[winId];win._isSticked = true;this._hideButton(win, "stick");this._showButton(win, "sticked");this._bringOnTop(win);win = null;}
 
 this._unstickWindow = function(winId) {var win = this.wins[winId];win._isSticked = false;this._hideButton(win, "sticked");this._showButton(win, "stick");this._bringOnTopAnyStickedWindows();win = null;}
 
 this._addUserButton = function(win, id, pos, title) {id = String(id).toLowerCase();var userButton = this._engineAddUserButton(win, id, pos);userButton.title = title;userButton.isVisible = true;userButton._isEnabled = true;userButton.isPressed = false;userButton.label = id;win.btns[id] = userButton;win.btns[id].winId = win.idd
 win.btns[id]._doOnClick = function(){};this._attachEventsOnButton(win.idd, id);userButton = null;}
 
 
 this._removeUserButton = function(win, buttonId) {this._removeButtonGlobal(win, buttonId);}
 
 this._blockSwitcher = function(state) {for (var a in this.wins){if (state == true){this.wins[a].showCoverBlocker();}else {this.wins[a].hideCoverBlocker();}
 }
 }
 
 this.resizingWin = null;this.modalWin = null;this.resizingDirs = "none";if (_isIE){this._focusFixIE = document.createElement("INPUT");this._focusFixIE.className = "dhx_windows_ieonclosefocusfix";this._focusFixIE.style.position = "absolute";this._focusFixIE.style.width = "1px";this._focusFixIE.style.height = "1px";this._focusFixIE.style.border = "none";this._focusFixIE.style.background = "none";this._focusFixIE.style.left = "-10px";this._focusFixIE.style.fontSize = "1px";document.body.appendChild(this._focusFixIE);}
 
 this._createViewport();this._doOnMouseUp = function() {if (that != null)that._stopMove();}
 this._doOnMoseMove = function(e) {e = e||event;if (that != null)that._moveWindow(e);}
 this._resizeTM = null;this._resizeTMTime = 200;this._lw = null;this._doOnResize = function() {if (that._lw != document.documentElement.clientHeight){window.clearTimeout(that._resizeTM);that._resizeTM = window.setTimeout(function(){that._autoResizeViewport();}, that._resizeTMTime);}
 that._lw = document.documentElement.clientHeight;}
 this._doOnUnload = function() {that.unload();}
 this._doOnSelectStart = function(e) {e = e||event;if (that.movingWin != null || that.resizingWin != null)e.returnValue = false;}
 if (_isIE){document.body.attachEvent("onselectstart", this._doOnSelectStart);}
 
 dhtmlxEvent(window, "resize", this._doOnResize);dhtmlxEvent(document.body, "unload", this._doOnUnload);if (this._isIPad){document.addEventListener("touchmove", this._doOnMoseMove, false);document.addEventListener("touchend", this._doOnMouseUp, false);}else {dhtmlxEvent(document.body, "mouseup", this._doOnMouseUp);dhtmlxEvent(this.vp, "mousemove", this._doOnMoseMove);dhtmlxEvent(this.vp, "mouseup", this._doOnMouseUp);}
 
 
 this._setWindowModal = function(win, state) {if (state == true){this._makeActive(win);this._bringOnTop(win);this.modalWin = win;win._isModal = true;this.modalCoverI.style.zIndex = win.zi - 2;this.modalCoverI.style.display = "";this.modalCoverD.style.zIndex = win.zi - 2;this.modalCoverD.style.display = "";}else {this.modalWin = null;win._isModal = false;this.modalCoverI.style.zIndex = 0;this.modalCoverI.style.display = "none";this.modalCoverD.style.zIndex = 0;this.modalCoverD.style.display = "none";}
 }
 
 this._bringOnTopAnyStickedWindows = function() {var wins = new Array();for (var a in this.wins){if (this.wins[a]._isSticked){wins[wins.length] = this.wins[a];}}
 for (var q=0;q<wins.length;q++){this._bringOnTop(wins[q]);}
 
 if (wins.length == 0){for (var a in this.wins){if (this.wins[a].className == "dhtmlx_window_active"){this._bringOnTop(this.wins[a]);}
 }
 }
 }
 
 
 this.unload = function() {this._clearAll();}
 
 this._removeButtonGlobal = function(winId, buttonId) {if (!this.wins[winId])return;if (!this.wins[winId].btns[buttonId])return;var btn = this.wins[winId].btns[buttonId];btn.title = null;btn.isVisible = null;btn._isEnabled = null;btn.isPressed = null;btn.label = null;btn._doOnClick = null;btn.detachAllEvents();btn.attachEvent = null;btn.callEvent = null;btn.checkEvent = null;btn.detachEvent = null;btn.detachAllEvents = null;btn.disable = null;btn.enable = null;btn.eventCatcher = null;btn.hide = null;btn.isEnabled = null;btn.isHidden = null;btn.show = null;btn.onmousedown = null;btn.onmouseout = null;btn.onmouseover = null;btn.onmouseup = null;btn.ontouchstart = null;btn.ontouchend = null;if (btn.parentNode)btn.parentNode.removeChild(btn);btn = null;this.wins[winId].btns[buttonId] = null;delete this.wins[winId].btns[buttonId];}
 
 
 this._removeWindowGlobal = function(winId) {var win = this.wins[winId];if (this.modalWin == win)this._setWindowModal(win, false);var t = win.coverBlocker();t.onselectstart = null;t = null;this._engineDiableOnSelectInWindow(win, false);win._dhxContDestruct();this._engineGetWindowHeader(win).onmousedown = null;this._engineGetWindowHeader(win).ondblclick = null;this.movingWin = null;this.resizingWin = null;for (var a in win.btns)this._removeButtonGlobal(win, a);win.btns = null;win.detachAllEvents();win._adjustToContent = null;win._doOnAttachMenu = null;win._doOnAttachStatusBar = null;win._doOnAttachToolbar = null;win._doOnFrameMouseDown = null;win._doOnFrameContentLoaded = null;win._redraw = null;win.addUserButton = null;win.allowMove = null;win.allowPark = null;win.allowResize = null;win.attachEvent = null;win.bringToBottom = null;win.bringToTop = null;win.callEvent = null;win.center = null;win.centerOnScreen = null;win.checkEvent = null;win.clearIcon = null;win.close = null;win.denyMove = null;win.denyPark = null;win.denyResize = null;win.detachEvent = null;win.detachAllEvents = null;win.eventCatcher = null;win.getDimension = null;win.getIcon = null;win.getId = null;win.getMaxDimension = null;win.getMinDimension = null;win.getPosition = null;win.getText = null;win.hide = null;win.hideHeader = null;win.isHidden = null;win.isMaximized = null;win.isModal = null;win.isMovable = null;win.isOnBottom = null;win.isOnTop = null;win.isParkable = null;win.isParked = null;win.isResizable = null;win.isSticked = null;win.keepInViewport = null;win.maximize = null;win.minimize = null;win.park = null;win.progressOff = null;win.progressOn = null;win.removeUserButton = null;win.restoreIcon = null;win.setDimension = null;win.setIcon = null;win.setMaxDimension = null;win.setMinDimension = null;win.setModal = null;win.setPosition = null;win.setText = null;win.setToFullScreen = null;win.show = null;win.showHeader = null;win.stick = null;win.unstick = null;win.onmousemove = null;win.onmousedown = null;win.icons = null;win.button = null;win._dhxContDestruct = null;win.dhxContGlobal.obj = null;win.dhxContGlobal.setContent = null;win.dhxContGlobal.dhxcont = null;win.dhxContGlobal = null;if (win._frame){while (win._frame.childNodes.length > 0)win._frame.removeChild(win._frame.childNodes[0]);win._frame = null;}
 
 
 this._parseNestedForEvents(win);win._content = null;win.innerHTML = "";win.parentNode.removeChild(win);win = null;this.wins[winId] = null;delete this.wins[winId];}
 
 this._removeEvents = function(obj) {obj.onmouseover = null;obj.onmouseout = null;obj.onmousemove = null;obj.onclick = null;obj.ondblclick = null;obj.onmouseenter = null;obj.onmouseleave = null;obj.onmouseup = null;obj.onmousewheel = null;obj.onmousedown = null;obj.onselectstart = null;obj.onfocus = null;obj.style.display = "";obj = null;}
 this._parseNestedForEvents = function(obj) {this._removeEvents(obj);for (var q=0;q<obj.childNodes.length;q++){if (obj.childNodes[q].tagName != null){this._parseNestedForEvents(obj.childNodes[q]);}
 }
 obj = null;}
 
 this._clearAll = function() {this._clearDocumentEvents();for (var a in this.wins)this._removeWindowGlobal(a);this.wins = null;this._parseNestedForEvents(this._carcass);while (this._carcass.childNodes.length > 0)this._carcass.removeChild(this._carcass.childNodes[0]);this._carcass.onselectstart = null;this._carcass.parentNode.removeChild(this._carcass);this._carcass = null;this._parseNestedForEvents(this._vpcover);this._vpcover.parentNode.removeChild(this._vpcover);this._vpcover = null;this._parseNestedForEvents(this.modalCoverD);this.modalCoverD.parentNode.removeChild(this.modalCoverD);this.modalCoverD = null;this._parseNestedForEvents(this.modalCoverI);this.modalCoverI.parentNode.removeChild(this.modalCoverI);this.modalCoverI = null;if (this.vp.autocreated == true)this.vp.parentNode.removeChild(this.vp);this.vp = null;for (var a in this.skinParams){delete this.skinParams[a];}
 this.skinParams = null;this._effects = null;this._engineSkinParams = null;this._addDefaultButtons = null;this._addUserButton = null;this._allowParking = null;this._allowReszieGlob = null;this._attachEventsOnButton = null;this._attachWindowContentTo = null;this._autoResizeViewport = null;this._blockSwitcher = null;this._bringOnBottom = null;this._bringOnTop = null;this._bringOnTopAnyStickedWindows = null;this._centerWindow = null;this._clearAll = null;this._clearDocumentEvents = null;this._clearWindowIcons = null;this._closeWindow = null;this._createViewport = null;this._denyParking = null;this._denyResize = null;this._dhx_Engine = null;this._disableButton = null;this._doOnMoseMove = null;this._doOnMouseUp = null;this._doOnResize = null;this._doOnSelectStart = null;this._doOnUnload = null;this._doParkDown = null;this._doParkUp = null;this._enableButton = null;this._engineAddUserButton = null;this._engineAdjustWindowToContent = null;this._engineAllowWindowResize = null;this._engineCheckHeaderMouseDown = null;this._engineDiableOnSelectInWindow = null;this._engineDoOnWindowParkDown = null;this._engineDoOnWindowParkUp = null;this._engineFixWindowPosInViewport = null;this._engineGetWindowButton = null;this._engineGetWindowContent = null;this._engineGetWindowHeader = null;this._engineGetWindowHeaderState = null;this._engineGetWindowLabel = null;this._engineGetWindowParkedHeight = null;this._engineRedrawSkin = null;this._engineRedrawWindowPos = null;this._engineRedrawWindowSize = null;this._engineRedrawWindowTitle = null;this._engineSetWindowBody = null;this._engineSwitchWindowHeader = null;this._engineSwitchWindowProgress = null;this._engineUpdateWindowIcon = null;this._fixWindowDimensionInViewport = null;this._genStr = null;this._getActive = null;this._getTopZIndex = null;this._getWindowIcon = null;this._hideButton = null;this._hideWindow = null;this._isWindowHidden = null;this._isWindowOnBottom = null;this._isWindowOnTop = null;this._makeActive = null;this._maximizeWindow = null;this._moveWindow = null;this._needHelp = null;this._parkWindow = null;this._parseNestedForEvents = null;this._removeButtonGlobal = null;this._removeEvents = null;this._removeUserButton = null;this._removeWindowGlobal = null;this._restoreWindow = null;this._restoreWindowIcons = null;this._setWindowIcon = null;this._setWindowModal = null;this._setWindowToFullScreen = null;this._showButton = null;this._showWindow = null;this._stickWindow = null;this._stopMove = null;this._unstickWindow = null;this.attachEvent = null;this.attachViewportTo = null;this.callEvent = null;this.checkEvent = null;this.createWindow = null;this.detachEvent = null;this.enableAutoViewport = null;this.eventCatcher = null;this.findByText = null;this.forEachWindow = null;this.getBottommostWindow = null;this.getEffect = null;this.getTopmostWindow = null;this.isWindow = null;this.setEffect = null;this.setImagePath = null;this.setSkin = null;this.setViewport = null;this.unload = null;this.window = null;that = null;}
 
 this._clearDocumentEvents = function() {if (_isIE){window.detachEvent("onresize", this._doOnResize);document.body.detachEvent("onselectstart", this._doOnSelectStart);document.body.detachEvent("onmouseup", this._doOnMouseUp);document.body.detachEvent("onunload", this._doOnUnload);this.vp.detachEvent("onmousemove", this._doOnMoseMove);this.vp.detachEvent("onmouseup", this._doOnMouseUp);}else {window.removeEventListener("resize", this._doOnResize, false);document.body.removeEventListener("mouseup", this._doOnMouseUp, false);document.body.removeEventListener("unload", this._doOnUnload, false);this.vp.removeEventListener("mousemove", this._doOnMoseMove, false);this.vp.removeEventListener("mouseup", this._doOnMouseUp, false);}
 }
 
 
 
 
 this._genStr = function(w) {var s = "";var z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";for (var q=0;q<w;q++)s += z.charAt(Math.round(Math.random() * (z.length-1)));return s;}
 
 dhtmlxEventable(this);return this;};dhtmlXWindows.prototype._dhx_Engine = function() {this._engineEnabled = true;this._engineName = "dhx";this._engineSkinParams = {dhx_blue: {"hh": 21, "lbw": 2, "rbw": 2, "lch": 2, "lcw": 14, "rch": 14, "rcw": 14, "bbh": 2, "mnh": 23, "tbh": 25, "sbh": 20, "noh_t": null, "noh_h": null},
 dhx_black: {"hh": 21, "lbw": 2, "rbw": 2, "lch": 2, "lcw": 14, "rch": 14, "rcw": 14, "bbh": 2, "mnh": 23, "tbh": 25, "sbh": 20, "noh_t": null, "noh_h": null},
 dhx_skyblue: {"hh": 29, "lbw": 2, "rbw": 2, "lch": 2, "lcw": 14, "rch": 14, "rcw": 14, "bbh": 2, "mnh": 23, "tbh": 25, "sbh": 20, "noh_t": 5, "noh_h": -10},
 dhx_web: {"hh": 27, "lbw": 5, "rbw": 5, "lch": 5, "lcw": 14, "rch": 14, "rcw": 14, "bbh": 5, "mnh": 23, "tbh": 25, "sbh": 20, "noh_t": 5, "noh_h": -10},
 dhx_terrace: {"hh": 37, "lbw": 5, "rbw": 5, "lch": 5, "lcw": 14, "rch": 14, "rcw": 14, "bbh": 5, "mnh": 23, "tbh": 25, "sbh": 20, "noh_t": 5, "noh_h": -10}
 };this._isIE6 = false;if (_isIE)this._isIE6 = (window.XMLHttpRequest==null?true:false);this._engineSetWindowBody = function(win) {win.innerHTML = "<div iswin='1' class='dhtmlx_wins_body_outer' style='position: relative;'>"+
 (this._isIE6?"<iframe src='javascript:false;' frameborder='0' class='dhtmlx_wins_ie6_cover_fix' onload='this.contentWindow.document.body.style.overflow=\"hidden\";'></iframe>":"")+
 "<div class='dhtmlx_wins_icon'></div>"+
 "<div class='dhtmlx_wins_progress'></div>"+
 "<div class='dhtmlx_wins_title'>dhtmlxWindow</div>"+
 "<div class='dhtmlx_wins_btns'>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_sticked_default'></div>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_stick_default'></div>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_help_default'></div>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_park_default'></div>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_minmax2_default'></div>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_minmax1_default'></div>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_close_default'></div>"+
 "<div class='dhtmlx_wins_btns_button dhtmlx_button_dock_default'></div>"+
 "</div>"+
 "<div class='dhtmlx_wins_body_inner'></div>"+
 "<div winResT='yes' class='dhtmlx_wins_resizer_t' style='display:none;'></div>"+
 "<div winResL='yes' class='dhtmlx_wins_resizer_l'></div>"+
 "<div winResR='yes' class='dhtmlx_wins_resizer_r'></div>"+
 "<div winResB='yes' class='dhtmlx_wins_resizer_b'></div>"+
 "<div class='white_line'></div>"+
 "<div class='white_line2'></div>"+
 "</div>";win.dhxContGlobal = new dhtmlXContainer(win);if (this.skin == "dhx_skyblue"){win.dhxContGlobal.obj._offsetWidth = -10;win.dhxContGlobal.obj._offsetHeight = -5;win.dhxContGlobal.obj._offsetLeft = 5;win.dhxContGlobal.obj._offsetHeightSaved = win.dhxContGlobal.obj._offsetHeight;}
 if (this.skin == "dhx_web"){win.dhxContGlobal.obj._offsetWidth = -10;win.dhxContGlobal.obj._offsetHeight = -5;win.dhxContGlobal.obj._offsetLeft = 5;win.dhxContGlobal.obj._offsetHeightSaved = win.dhxContGlobal.obj._offsetHeight;}
 win.skin = this.skin;win.dhxContGlobal.setContent(win.childNodes[0].childNodes[(this._isIE6?5:4)]);var t = win.coverBlocker();t.onselectstart = function(e) {e = e||event;e.returnValue = false;e.cancelBubble = true;}
 t = null;}
 
 
 this._engineDiableOnSelectInWindow = function(win, state) {var data = new Array();data[0] = win.childNodes[0].childNodes[(this._isIE6?1:0)];data[1] = win.childNodes[0].childNodes[(this._isIE6?2:1)];data[2] = win.childNodes[0].childNodes[(this._isIE6?3:2)];data[3] = win.childNodes[0].childNodes[(this._isIE6?4:3)];data[4] = win.childNodes[0].childNodes[(this._isIE6?6:5)];data[5] = win.childNodes[0].childNodes[(this._isIE6?7:6)];data[6] = win.childNodes[0].childNodes[(this._isIE6?8:7)];data[7] = win.childNodes[0].childNodes[(this._isIE6?9:8)];for (var q=0;q<data.length;q++){data[q].onselectstart = (state?function(e){e=e||event;e.returnValue=false;return false;}:null);data[q] = null;}
 data = null;}
 
 
 this._engineGetWindowHeader = function(win) {win.childNodes[0].idd = win.idd;return win.childNodes[0];}
 
 
 this._engineRedrawWindowSize = function(win) {win.style.width = (String(win.w).search("%")==-1?win.w+"px":win.w);win.style.height = (String(win.h).search("%")==-1?win.h+"px":win.h);var body = win.childNodes[0];body.style.width = win.clientWidth+"px";body.style.height = win.clientHeight+"px";if (body.offsetWidth > win.clientWidth){body.style.width = win.clientWidth*2-body.offsetWidth+"px";}
 if (body.offsetHeight > win.clientHeight){var px = win.clientHeight*2-body.offsetHeight;if (px < 0)px = 0;body.style.height = px+"px";}
 
 var hh = (win._noHeader==true?win._hdrSize:this._engineSkinParams[this.skin]["hh"]);this._engineRedrawWindowTitle(win);win.adjustContent(body, hh);}
 
 
 this._engineRedrawWindowPos = function(win) {if (win._isFullScreened)return;win.style.left = win.x + "px";win.style.top = win.y + "px";}
 
 
 this._engineFixWindowPosInViewport = function(win) {var hh = (win._noHeader==true?win._hdrSize:this._engineSkinParams[this.skin]["hh"]);if (win._keepInViewport){if (win.x < 0){win.x = 0;}
 if (win.x + win.w > this.vp.offsetWidth){win.x = this.vp.offsetWidth - win.w;}
 
 if (win.y + win.h > this.vp.offsetHeight){win.y = this.vp.offsetHeight - win.h;}
 if (win.y < 0){win.y = 0;}
 }else {if (win.y + hh > this.vp.offsetHeight){win.y = this.vp.offsetHeight - hh;}
 if (win.y < 0){win.y = 0;}
 if (win.x + win.w - 10 < 0){win.x = 10 - win.w;}
 if (win.x > this.vp.offsetWidth - 10){win.x = this.vp.offsetWidth - 10;}
 }
 
 }
 
 
 this._engineCheckHeaderMouseDown = function(win, ev) {if (this._isIPad){var x = ev.touches[0].clientX;var y = ev.touches[0].clientY;var obj = ev.target||ev.srcElement;if (obj == win.childNodes[0] || obj == win.childNodes[0].childNodes[0] || obj == win.childNodes[0].childNodes[2] || obj == win.childNodes[0].childNodes[3])return true;return false;}else {var x = (_isIE||_isOpera?ev.offsetX:ev.layerX);var y = (_isIE||_isOpera?ev.offsetY:ev.layerY);var obj = ev.target||ev.srcElement;}
 
 var hh = (win._noHeader==true?win._hdrSize:this._engineSkinParams[this.skin]["hh"]);if (y <= hh && (obj == win.childNodes[0] || obj == win.childNodes[0].childNodes[(this._isIE6?1:0)] || obj == win.childNodes[0].childNodes[(this._isIE6?3:2)] || obj == win.childNodes[0].childNodes[(this._isIE6?4:3)])) return true;return false;}
 
 
 this._engineGetWindowContent = function(win) {alert("_engineGetWindowContent");}
 
 
 this._engineGetWindowButton = function(win, buttonName) {buttonName = String(buttonName).toLowerCase();var buttonObj = null;var buttonStyle = "dhtmlx_button_"+buttonName+"_";for (var q=0;q<win.childNodes[0].childNodes[(this._isIE6?4:3)].childNodes.length;q++) {var buttonTemp = win.childNodes[0].childNodes[(this._isIE6?4:3)].childNodes[q];if (String(buttonTemp.className).search(buttonStyle) != -1) {buttonObj = buttonTemp;}
 buttonTemp = null;}
 return buttonObj;}
 
 
 this._engineAddUserButton = function(win, buttonName, buttonPos) {if (isNaN(buttonPos)) buttonPos = 0;var button = document.createElement("DIV");button.className = "dhtmlx_wins_btns_button dhtmlx_button_"+buttonName+"_default";var buttonPoly = win.childNodes[0].childNodes[(this._isIE6?4:3)];buttonPos = buttonPoly.childNodes.length - buttonPos;if (buttonPos < 0)buttonPos = 0;if (buttonPos >= buttonPoly.childNodes.length){buttonPoly.appendChild(button);}else {buttonPoly.insertBefore(button, buttonPoly.childNodes[buttonPos]);}
 this._engineRedrawWindowTitle(win);return button;}
 
 
 this._engineGetWindowParkedHeight = function(win) {return this._engineSkinParams[this.skin]["hh"]+1;}
 
 
 this._engineDoOnWindowParkDown = function(win) {win.childNodes[0].childNodes[(this._isIE6?6:5)].style.display = (win._noHeader==true?"":"none");win.childNodes[0].childNodes[(this._isIE6?7:6)].style.display = "";win.childNodes[0].childNodes[(this._isIE6?8:7)].style.display = "";win.childNodes[0].childNodes[(this._isIE6?9:8)].style.display = "";}
 
 
 this._engineDoOnWindowParkUp = function(win) {win.childNodes[0].childNodes[(this._isIE6?6:5)].style.display = "none";win.childNodes[0].childNodes[(this._isIE6?7:6)].style.display = "none";win.childNodes[0].childNodes[(this._isIE6?8:7)].style.display = "none";win.childNodes[0].childNodes[(this._isIE6?9:8)].style.display = "none";}
 
 
 this._engineUpdateWindowIcon = function(win, icon) {win.childNodes[0].childNodes[(this._isIE6?1:0)].style.backgroundImage = "url('"+icon+"')";}
 
 
 this._engineAllowWindowResize = function(win, targetObj, mouseX, mouseY) {if (!targetObj.getAttribute)return;var sk = this._engineSkinParams[this.skin];var hh = (win._noHeader==true?win._hdrSize:this._engineSkinParams[this.skin]["hh"]);if (targetObj.getAttribute("winResL")!= null) {if (targetObj.getAttribute("winResL")== "yes") {if (mouseY >= hh){if (mouseY >= win.h - sk["lch"])return "corner_left";if (mouseY <= sk["lch"] && win._noHeader == true)return "corner_up_left";return "border_left";}
 }
 }
 if (targetObj.getAttribute("winResR")!= null) {if (targetObj.getAttribute("winResR")== "yes") {if (mouseY >= hh){if (mouseY >= win.h - sk["rch"])return "corner_right";if (mouseY <= sk["rch"] && win._noHeader == true)return "corner_up_right";return "border_right";}
 }
 }
 if (targetObj.getAttribute("winResT")!= null) {if (targetObj.getAttribute("winResT")== "yes" && win._noHeader == true) {if (mouseX <= sk["lcw"])return "corner_up_left";if (mouseX >= win.w - sk["rcw"])return "corner_up_right";return "border_top";}
 }
 if (targetObj.getAttribute("winResB")!= null) {if (targetObj.getAttribute("winResB")== "yes") {if (mouseX <= sk["lcw"])return "corner_left";if (mouseX >= win.w - sk["rcw"])return "corner_right";return "border_bottom";}
 }
 return null;}
 
 
 this._engineAdjustWindowToContent = function(win, w, h) {var newW = w+win.w-win.vs[win.av].dhxcont.clientWidth;var newH = h+win.h-win.vs[win.av].dhxcont.clientHeight;win.setDimension(newW, newH);}
 
 
 this._engineRedrawSkin = function() {this.vp.className = (this.vp==document.body&&this.vp._css?this.vp._css+" ":"")+"dhtmlx_winviewport dhtmlx_skin_"+this.skin+(this._r?" dhx_wins_rtl":"");var sk = this._engineSkinParams[this.skin];for (var a in this.wins){if (this.skin == "dhx_skyblue"){this.wins[a].dhxContGlobal.obj._offsetTop = (this.wins[a]._noHeader?sk["noh_t"]:null);this.wins[a].dhxContGlobal.obj._offsetWidth = -10;this.wins[a].dhxContGlobal.obj._offsetHeight = (this.wins[a]._noHeader?sk["noh_h"]:-5);this.wins[a].dhxContGlobal.obj._offsetLeft = 5;this.wins[a].dhxContGlobal.obj._offsetHeightSaved = -5;}else {this.wins[a].dhxContGlobal.obj._offsetWidth = null;this.wins[a].dhxContGlobal.obj._offsetHeight = null;this.wins[a].dhxContGlobal.obj._offsetLeft = null;this.wins[a].dhxContGlobal.obj._offsetTop = null;this.wins[a].dhxContGlobal.obj._offsetHeightSaved = null;}
 this.wins[a].skin = this.skin;this._restoreWindowIcons(this.wins[a]);this._engineRedrawWindowSize(this.wins[a]);}
 }
 
 
 this._engineSwitchWindowProgress = function(win, state) {if (state == true){win.childNodes[0].childNodes[(this._isIE6?1:0)].style.display = "none";win.childNodes[0].childNodes[(this._isIE6?2:1)].style.display = "";}else {win.childNodes[0].childNodes[(this._isIE6?2:1)].style.display = "none";win.childNodes[0].childNodes[(this._isIE6?1:0)].style.display = "";}
 }
 
 
 this._engineSwitchWindowHeader = function(win, state) {if (!win._noHeader)win._noHeader = false;if (state != win._noHeader)return;win._noHeader = (state==true?false:true);win._hdrSize = 0;win.childNodes[0].childNodes[(this._isIE6?5:4)].className = "dhtmlx_wins_body_inner"+(win._noHeader?" dhtmlx_wins_no_header":"");win.childNodes[0].childNodes[(this._isIE6?6:5)].style.display = (win._noHeader?"":"none");win.childNodes[0].childNodes[(this._isIE6?1:0)].style.display = (win._noHeader?"none":"");win.childNodes[0].childNodes[(this._isIE6?3:2)].style.display = (win._noHeader?"none":"");win.childNodes[0].childNodes[(this._isIE6?4:3)].style.display = (win._noHeader?"none":"");var sk = this._engineSkinParams[this.skin];if (win._noHeader){win.dhxContGlobal.obj._offsetHeightSaved = win.dhxContGlobal.obj._offsetHeight;win.dhxContGlobal.obj._offsetHeight = sk["noh_h"];win.dhxContGlobal.obj._offsetTop = sk["noh_t"];}else {win.dhxContGlobal.obj._offsetHeight = win.dhxContGlobal.obj._offsetHeightSaved;win.dhxContGlobal.obj._offsetTop = null;}
 this._engineRedrawWindowSize(win);}
 
 
 this._engineGetWindowHeaderState = function(win) {return (win._noHeader?true:false);}
 
 
 this._engineGetWindowLabel = function(win) {return win.childNodes[0].childNodes[(this._isIE6?3:2)];}
 
 
 this._engineRedrawWindowTitle = function(win) {if (win._noHeader!==true){var p2 = win.childNodes[0].childNodes[(this._isIE6?1:0)].offsetWidth;var p3 = win.childNodes[0].childNodes[(this._isIE6?4:3)].offsetWidth;var newW = win.offsetWidth-p2-p3-24;if (newW < 0)newW = "100%";else newW += "px";win.childNodes[0].childNodes[(this._isIE6?3:2)].style.width = newW;}
 }
 
};dhtmlXWindows.prototype.i18n = {dhxcontaler: "dhtmlxcontainer.js is missed on the page",
 noenginealert: "No dhtmlxWindows engine was found.",
 stick: "Stick",
 unstick: "Unstick",
 help: "Help",
 parkdown: "Park Down",
 parkup: "Park Up",
 maximize: "Maximize",
 restore: "Restore",
 close: "Close",
 dock: "Dock"
};(function(){dhtmlx.extend_api("dhtmlXWindows",{_init:function(obj){return [];},
 _patch:function(obj){obj.old_createWindow=obj.createWindow;obj.createWindow=function(obj){if (arguments.length>1)return this.old_createWindow.apply(this,arguments);var res = this.old_createWindow(obj.id,(obj.x||obj.left),(obj.y||obj.top),obj.width,obj.height);res.allowMoveA=function(mode){if (mode)this.allowMove();else this.denyMove();}
 res.allowParkA=function(mode){if (mode)this.allowPark();else this.denyPark();}
 res.allowResizeA=function(mode){if (mode)this.allowResize();else this.denyResize();}
 
 
 for (var a in obj){if (map[a])res[map[a]](obj[a]);else if (a.indexOf("on")==0){res.attachEvent(a,obj[a]);}
 }
 return res;}
 },
 animation:"setEffect",
 image_path:"setImagePath",
 skin:"setSkin",
 viewport:"_viewport",
 wins:"_wins"
 },{_viewport:function(data){if (data.object){this.enableAutoViewport(false);this.attachViewportTo(data.object);}else {this.enableAutoViewport(false);this.setViewport(data.left, data.top, data.width, data.height, data.parent);}
 },
 _wins:function(arr){for (var q=0;q<arr.length;q++){var win = arr[q];this.createWindow(win.id, win.left, win.top, win.width, win.height);if (win.text)this.window(win.id).setText(win.text);if (win.keep_in_viewport)this.window(win.id).keepInViewport(true);if (win.deny_resize)this.window(win.id).denyResize();if (win.deny_park)this.window(win.id).denyPark();if (win.deny_move)this.window(win.id).denyMove();}
 }
 });var map={move:"allowMoveA",
 park:"allowParkA",
 resize:"allowResizeA",
 center:"center",
 modal:"setModal",
 caption:"setText",
 header:"showHeader"
 };})();function dhtmlXContainer(obj) {var that = this;this.obj = obj;obj = null;this.obj._padding = true;this.dhxcont = null;this.st = document.createElement("DIV");this.st.style.position = "absolute";this.st.style.left = "-200px";this.st.style.top = "0px";this.st.style.width = "100px";this.st.style.height = "1px";this.st.style.visibility = "hidden";this.st.style.overflow = "hidden";document.body.insertBefore(this.st, document.body.childNodes[0]);this.obj._getSt = function() {return that.st;}
 
 this.obj.dv = "def";this.obj.av = this.obj.dv;this.obj.cv = this.obj.av;this.obj.vs = {};this.obj.vs[this.obj.av] = {};this.obj.view = function(name) {if (!this.vs[name]){this.vs[name] = {};this.vs[name].dhxcont = this.vs[this.dv].dhxcont;var mainCont = document.createElement("DIV");mainCont.style.position = "relative";mainCont.style.left = "0px";mainCont.style.width = "200px";mainCont.style.height = "200px";mainCont.style.overflow = "hidden";mainCont.style.visibility = "";that.st.appendChild(mainCont);this.vs[name].dhxcont.mainCont[name] = mainCont;mainCont = null;}
 
 this.avt = this.av;this.av = name;return this;}
 
 this.obj.setActive = function() {if (!this.vs[this.av])return;this.cv = this.av;if (this.vs[this.avt].dhxcont == this.vs[this.avt].dhxcont.mainCont[this.avt].parentNode){that.st.appendChild(this.vs[this.avt].dhxcont.mainCont[this.avt]);if (this.vs[this.avt].menu)that.st.appendChild(document.getElementById(this.vs[this.avt].menuId));if (this.vs[this.avt].toolbar)that.st.appendChild(document.getElementById(this.vs[this.avt].toolbarId));if (this.vs[this.avt].sb)that.st.appendChild(document.getElementById(this.vs[this.avt].sbId));}
 
 
 
 
 if (this._isCell){}
 
 
 
 if (this.vs[this.av].dhxcont != this.vs[this.av].dhxcont.mainCont[this.av].parentNode){this.vs[this.av].dhxcont.insertBefore(this.vs[this.av].dhxcont.mainCont[this.av],this.vs[this.av].dhxcont.childNodes[this.vs[this.av].dhxcont.childNodes.length-1]);if (this.vs[this.av].menu)this.vs[this.av].dhxcont.insertBefore(document.getElementById(this.vs[this.av].menuId), this.vs[this.av].dhxcont.childNodes[0]);if (this.vs[this.av].toolbar)this.vs[this.av].dhxcont.insertBefore(document.getElementById(this.vs[this.av].toolbarId), this.vs[this.av].dhxcont.childNodes[(this.vs[this.av].menu?1:0)]);if (this.vs[this.av].sb)this.vs[this.av].dhxcont.insertBefore(document.getElementById(this.vs[this.av].sbId), this.vs[this.av].dhxcont.childNodes[this.vs[this.av].dhxcont.childNodes.length-1]);}
 
 if (this._doOnResize)this._doOnResize();if (this._isWindow)this.updateNestedObjects();this.avt = null;}
 
 this.obj._viewRestore = function() {var t = this.av;if (this.avt){this.av = this.avt;this.avt = null;}
 return t;}
 
 this.setContent = function(data) {this.obj.vs[this.obj.av].dhxcont = data;this.obj._init();data = null;}
 
 this.obj._init = function() {this.vs[this.av].dhxcont.innerHTML = "<div ida='dhxMainCont' style='position: relative;left: 0px;top: 0px;overflow: hidden;'></div>"+
 "<div class='dhxcont_content_blocker' style='display: none;'></div>";this.vs[this.av].dhxcont.mainCont = {};this.vs[this.av].dhxcont.mainCont[this.av] = this.vs[this.av].dhxcont.childNodes[0];}
 
 this.obj._genStr = function(w) {var s = "";var z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";for (var q=0;q<w;q++)s += z.charAt(Math.round(Math.random() * (z.length-1)));return s;}
 
 this.obj.setMinContentSize = function(w, h) {this.vs[this.av]._minDataSizeW = w;this.vs[this.av]._minDataSizeH = h;}
 
 this.obj._setPadding = function(p, altCss) {if (typeof(p)== "object") {this._offsetTop = p[0];this._offsetLeft = p[1];this._offsetWidth = p[2];this._offsetHeight = p[3];p = null;}else {this._offsetTop = p;this._offsetLeft = p;this._offsetWidth = -p*2;this._offsetHeight = -p*2;}
 this.vs[this.av].dhxcont.className = "dhxcont_global_content_area "+(altCss||"");}
 
 this.obj.moveContentTo = function(cont) {for (var a in this.vs){cont.view(a).setActive();var pref = null;if (this.vs[a].grid)pref = "grid";if (this.vs[a].tree)pref = "tree";if (this.vs[a].tabbar)pref = "tabbar";if (this.vs[a].folders)pref = "folders";if (this.vs[a].layout)pref = "layout";if (pref != null){cont.view(a).attachObject(this.vs[a][pref+"Id"], false, true, false);cont.vs[a][pref] = this.vs[a][pref];cont.vs[a][pref+"Id"] = this.vs[a][pref+"Id"];cont.vs[a][pref+"Obj"] = this.vs[a][pref+"Obj"];this.vs[a][pref] = null;this.vs[a][pref+"Id"] = null;this.vs[a][pref+"Obj"] = null;}
 
 if (this.vs[a]._frame){cont.vs[a]._frame = this.vs[a]._frame;this.vs[a]._frame = null;}
 
 if (this.vs[a].menu != null){if (cont.cv == cont.av){cont.vs[cont.av].dhxcont.insertBefore(document.getElementById(this.vs[a].menuId), cont.vs[cont.av].dhxcont.childNodes[0]);}else {var st = cont._getSt();st.appendChild(document.getElementById(this.vs[a].menuId));st = null;}
 cont.vs[a].menu = this.vs[a].menu;cont.vs[a].menuId = this.vs[a].menuId;cont.vs[a].menuHeight = this.vs[a].menuHeight;this.vs[a].menu = null;this.vs[a].menuId = null;this.vs[a].menuHeight = null;if (this.cv == this.av && this._doOnAttachMenu)this._doOnAttachMenu("unload");if (cont.cv == cont.av && cont._doOnAttachMenu)cont._doOnAttachMenu("move");}
 
 if (this.vs[a].toolbar != null){if (cont.cv == cont.av){cont.vs[cont.av].dhxcont.insertBefore(document.getElementById(this.vs[a].toolbarId), cont.vs[cont.av].dhxcont.childNodes[(cont.vs[cont.av].menu!=null?1:0)]);}else {var st = cont._getSt();st.appendChild(document.getElementById(this.vs[a].toolbarId));st = null;}
 
 cont.vs[a].toolbar = this.vs[a].toolbar;cont.vs[a].toolbarId = this.vs[a].toolbarId;cont.vs[a].toolbarHeight = this.vs[a].toolbarHeight;this.vs[a].toolbar = null;this.vs[a].toolbarId = null;this.vs[a].toolbarHeight = null;if (this.cv == this.av && this._doOnAttachToolbar)this._doOnAttachToolbar("unload");if (cont.cv == cont.av && cont._doOnAttachToolbar)cont._doOnAttachToolbar("move");}
 
 if (this.vs[a].sb != null){if (cont.cv == cont.av){cont.vs[cont.av].dhxcont.insertBefore(document.getElementById(this.vs[a].sbId), cont.vs[cont.av].dhxcont.childNodes[cont.vs[cont.av].dhxcont.childNodes.length-1]);}else {var st = cont._getSt();st.appendChild(document.getElementById(this.vs[a].sbId));return st;}
 
 cont.vs[a].sb = this.vs[a].sb;cont.vs[a].sbId = this.vs[a].sbId;cont.vs[a].sbHeight = this.vs[a].sbHeight;this.vs[a].sb = null;this.vs[a].sbId = null;this.vs[a].sbHeight = null;if (this.cv == this.av && this._doOnAttachStatusBar)this._doOnAttachStatusBar("unload");if (cont.cv == cont.av && cont._doOnAttachStatusBar)cont._doOnAttachStatusBar("move");}
 
 
 var objA = this.vs[a].dhxcont.mainCont[a];var objB = cont.vs[a].dhxcont.mainCont[a];while (objA.childNodes.length > 0)objB.appendChild(objA.childNodes[0]);}
 
 cont.view(this.av).setActive();cont = null;}
 
 this.obj.adjustContent = function(parentObj, offsetTop, marginTop, notCalcWidth, offsetBottom) {var dhxcont = this.vs[this.av].dhxcont;var mainCont = dhxcont.mainCont[this.av];dhxcont.style.left = (this._offsetLeft||0)+"px";dhxcont.style.top = (this._offsetTop||0)+offsetTop+"px";var cw = parentObj.clientWidth+(this._offsetWidth||0);if (notCalcWidth !== true)dhxcont.style.width = Math.max(0, cw)+"px";if (notCalcWidth !== true)if (dhxcont.offsetWidth > cw)dhxcont.style.width = Math.max(0, cw*2-dhxcont.offsetWidth)+"px";var ch = parentObj.clientHeight+(this._offsetHeight||0);dhxcont.style.height = Math.max(0, ch-offsetTop)+(marginTop!=null?marginTop:0)+"px";if (dhxcont.offsetHeight > ch - offsetTop)dhxcont.style.height = Math.max(0, (ch-offsetTop)*2-dhxcont.offsetHeight)+"px";if (offsetBottom)if (!isNaN(offsetBottom)) dhxcont.style.height = Math.max(0, parseInt(dhxcont.style.height)-offsetBottom)+"px";if (this.vs[this.av]._minDataSizeH != null){if (parseInt(dhxcont.style.height)< this.vs[this.av]._minDataSizeH) dhxcont.style.height = this.vs[this.av]._minDataSizeH+"px";}
 if (this.vs[this.av]._minDataSizeW != null){if (parseInt(dhxcont.style.width)< this.vs[this.av]._minDataSizeW) dhxcont.style.width = this.vs[this.av]._minDataSizeW+"px";}
 
 if (notCalcWidth !== true){mainCont.style.width = dhxcont.clientWidth+"px";if (mainCont.offsetWidth > dhxcont.clientWidth)mainCont.style.width = Math.max(0, dhxcont.clientWidth*2-mainCont.offsetWidth)+"px";}
 
 var menuOffset = (this.vs[this.av].menu!=null?(!this.vs[this.av].menuHidden?this.vs[this.av].menuHeight:0):0);var toolbarOffset = (this.vs[this.av].toolbar!=null?(!this.vs[this.av].toolbarHidden?this.vs[this.av].toolbarHeight:0):0);var statusOffset = (this.vs[this.av].sb!=null?(!this.vs[this.av].sbHidden?this.vs[this.av].sbHeight:0):0);mainCont.style.height = dhxcont.clientHeight+"px";if (mainCont.offsetHeight > dhxcont.clientHeight)mainCont.style.height = Math.max(0, dhxcont.clientHeight*2-mainCont.offsetHeight)+"px";mainCont.style.height = Math.max(0, parseInt(mainCont.style.height)-menuOffset-toolbarOffset-statusOffset)+"px";mainCont = null;dhxcont = null;parentObj = null;}
 this.obj.coverBlocker = function() {return this.vs[this.av].dhxcont.childNodes[this.vs[this.av].dhxcont.childNodes.length-1];}
 this.obj.showCoverBlocker = function() {var t = this.coverBlocker();t.style.display = "";t = null;}
 this.obj.hideCoverBlocker = function() {var t = this.coverBlocker();t.style.display = "none";t = null;}
 this.obj.updateNestedObjects = function(fromInit) {if (this.skin == "dhx_terrace"){var mtAttached = (this.vs[this.av].menu != null || this.vs[this.av].toolbar != null);if (this.vs[this.av].grid){var gTop = (mtAttached||this._isWindow?14:0);var gBottom = (this._isWindow?14:0);var gLeft = (this._isWindow?14:0);if (fromInit){if (!this._isWindow){this.vs[this.av].grid.entBox.style.border = "0px solid white";this.vs[this.av].grid.skin_h_correction = -2;}
 
 this.vs[this.av].grid.dontSetSizes = true;this.vs[this.av].gridObj.style.position = "absolute";}
 
 this.vs[this.av].gridObj.style.top = gTop+"px";this.vs[this.av].gridObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)-gTop-gBottom+"px";this.vs[this.av].gridObj.style.left = gLeft+"px";this.vs[this.av].gridObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)-(gLeft*2)+"px";this.vs[this.av].grid.setSizes();}
 
 if (this.vs[this.av].tree){var gTop = (mtAttached||this._isWindow?14:0);var gBottom = (this._isWindow?14:0);var gLeft = (this._isWindow?14:0);if (fromInit){this.vs[this.av].treeObj.style.position = "absolute";}
 
 this.vs[this.av].treeObj.style.top = gTop+"px";this.vs[this.av].treeObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)-gTop-gBottom+"px";this.vs[this.av].treeObj.style.left = gLeft+"px";this.vs[this.av].treeObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)-(gLeft*2)+"px";}
 
 if (this.vs[this.av].form){var gTop = (mtAttached||this._isWindow?14:0);var gBottom = (this._isWindow?14:0);var gLeft = (this._isWindow?14:0);if (fromInit){this.vs[this.av].formObj.style.position = "absolute";}
 
 this.vs[this.av].formObj.style.top = gTop+"px";this.vs[this.av].formObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)-gTop-gBottom+"px";this.vs[this.av].formObj.style.left = gLeft+"px";this.vs[this.av].formObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)-(gLeft*2)+"px";this.vs[this.av].form.setSizes();}
 
 if (this.vs[this.av].layout){if (fromInit){if (!this._isWindow && !this._isCell)this.vs[this.av].layout._hideBorders();}
 
 
 var gTop = (this._isCell&&this._noHeader&&!mtAttached?0:14);var gBottom = (this._isCell&&this._noHeader?0:14)
 var gLeft = (this._isCell&&this._noHeader?0:14);this.vs[this.av].layoutObj.style.top = gTop+"px";this.vs[this.av].layoutObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)-gTop-gBottom+"px";this.vs[this.av].layoutObj.style.left = gLeft+"px";this.vs[this.av].layoutObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)-(gLeft*2)+"px";this.vs[this.av].layout.setSizes();}
 
 if (this.vs[this.av].accordion){if (fromInit){this.vs[this.av].accordion._hideBorders = true;}
 
 var gTop = (this._isCell&&this._noHeader&&!mtAttached?0:14);var gBottom = (this._isCell&&this._noHeader?0:14)
 var gLeft = (this._isCell&&this._noHeader?0:14);this.vs[this.av].accordionObj.style.top = gTop+"px";this.vs[this.av].accordionObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)-gTop-gBottom+"px";this.vs[this.av].accordionObj.style.left = gLeft+"px";this.vs[this.av].accordionObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)-(gLeft*2)+"px";this.vs[this.av].accordion.setSizes();}
 
 
 if (this.vs[this.av].tabbar != null){var gTop = (!mtAttached && this._isCell && this._noHeader ? 0:14);var gBottom = (this._isCell && this._noHeader ? gTop : 28);var gLeft = (this._isCell && this._noHeader ? 0 : 14);this.vs[this.av].tabbarObj.style.top = gTop+"px";this.vs[this.av].tabbarObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)-gBottom+"px";this.vs[this.av].tabbarObj.style.left = gLeft+"px";this.vs[this.av].tabbarObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)-(gLeft*2)+"px";this.vs[this.av].tabbar.adjustOuterSize();}
 
 if (this.vs[this.av].editor){if (fromInit){if (this.vs[this.av].editor.tb != null && this.vs[this.av].editor.tb instanceof dhtmlXToolbarObject){}
 
 }
 
 var gTop = 14;var gLeft = 14;this.vs[this.av].editorObj.style.top = gTop+"px";this.vs[this.av].editorObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)-(gTop*2)+"px";this.vs[this.av].editorObj.style.left = gLeft+"px";this.vs[this.av].editorObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)-(gLeft*2)+"px";if (!_isIE)this.vs[this.av].editor._prepareContent(true);this.vs[this.av].editor.setSizes();}
 
 
 if (this.vs[this.av].dockedCell){this.vs[this.av].dockedCell.updateNestedObjects();}
 
 return;}
 
 if (this.vs[this.av].grid){this.vs[this.av].grid.setSizes();}
 if (this.vs[this.av].sched){this.vs[this.av].sched.setSizes();}
 if (this.vs[this.av].tabbar){this.vs[this.av].tabbar.adjustOuterSize();}
 if (this.vs[this.av].folders){this.vs[this.av].folders.setSizes();}
 if (this.vs[this.av].editor){if (!_isIE)this.vs[this.av].editor._prepareContent(true);this.vs[this.av].editor.setSizes();}
 
 
 if (this.vs[this.av].layout){if ((this._isAcc || this._isTabbarCell)&& this.skin == "dhx_skyblue") {this.vs[this.av].layoutObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)+2+"px";this.vs[this.av].layoutObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)+2+"px";}else {this.vs[this.av].layoutObj.style.width = this.vs[this.av].dhxcont.mainCont[this.av].style.width;this.vs[this.av].layoutObj.style.height = this.vs[this.av].dhxcont.mainCont[this.av].style.height;}
 this.vs[this.av].layout.setSizes();}
 
 if (this.vs[this.av].accordion != null){if (this.skin == "dhx_web"){this.vs[this.av].accordionObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)+"px";this.vs[this.av].accordionObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)+"px";}else {this.vs[this.av].accordionObj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)+2+"px";this.vs[this.av].accordionObj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)+2+"px";}
 this.vs[this.av].accordion.setSizes();}
 
 if (this.vs[this.av].dockedCell){this.vs[this.av].dockedCell.updateNestedObjects();}
 
 if (this.vs[this.av].form)this.vs[this.av].form.setSizes();}
 
 this.obj.attachStatusBar = function() {if (this.vs[this.av].sb)return;var sbObj = document.createElement("DIV");if (this._isCell){sbObj.className = "dhxcont_sb_container_layoutcell";}else {sbObj.className = "dhxcont_sb_container";}
 sbObj.id = "sbobj_"+this._genStr(12);sbObj.innerHTML = "<div class='dhxcont_statusbar'></div>";if (this.cv == this.av)this.vs[this.av].dhxcont.insertBefore(sbObj, this.vs[this.av].dhxcont.childNodes[this.vs[this.av].dhxcont.childNodes.length-1]);else that.st.appendChild(sbObj);sbObj.setText = function(text) {this.childNodes[0].innerHTML = text;}
 sbObj.getText = function() {return this.childNodes[0].innerHTML;}
 sbObj.onselectstart = function(e) {e=e||event;e.returnValue=false;return false;}
 
 this.vs[this.av].sb = sbObj;this.vs[this.av].sbHeight = (this.skin=="dhx_web"?41:(this.skin=="dhx_skyblue"?23:sbObj.offsetHeight));this.vs[this.av].sbId = sbObj.id;if (this._doOnAttachStatusBar)this._doOnAttachStatusBar("init");this.adjust();return this.vs[this._viewRestore()].sb;}
 
 this.obj.detachStatusBar = function() {if (!this.vs[this.av].sb)return;this.vs[this.av].sb.setText = null;this.vs[this.av].sb.getText = null;this.vs[this.av].sb.onselectstart = null;this.vs[this.av].sb.parentNode.removeChild(this.vs[this.av].sb);this.vs[this.av].sb = null;this.vs[this.av].sbHeight = null;this.vs[this.av].sbId = null;this._viewRestore();if (this._doOnAttachStatusBar)this._doOnAttachStatusBar("unload");}
 
 this.obj.getFrame = function(){return this.getView()._frame;};this.obj.getView = function(name){return this.vs[name||this.av];};this.obj.attachMenu = function(skin) {if (this.vs[this.av].menu)return;var menuObj = document.createElement("DIV");menuObj.style.position = "relative";menuObj.style.overflow = "hidden";menuObj.id = "dhxmenu_"+this._genStr(12);if (this.cv == this.av)this.vs[this.av].dhxcont.insertBefore(menuObj, this.vs[this.av].dhxcont.childNodes[0]);else that.st.appendChild(menuObj);if (typeof(skin)!= "object") {this.vs[this.av].menu = new dhtmlXMenuObject(menuObj.id, (skin||this.skin));}else {skin.parent = menuObj.id;this.vs[this.av].menu = new dhtmlXMenuObject(skin);}
 this.vs[this.av].menuHeight = (this.skin=="dhx_web"?29:menuObj.offsetHeight);this.vs[this.av].menuId = menuObj.id;if (this._doOnAttachMenu)this._doOnAttachMenu("init");this.adjust();return this.vs[this._viewRestore()].menu;}
 
 this.obj.detachMenu = function() {if (!this.vs[this.av].menu)return;var menuObj = document.getElementById(this.vs[this.av].menuId);this.vs[this.av].menu.unload();this.vs[this.av].menu = null;this.vs[this.av].menuId = null;this.vs[this.av].menuHeight = null;if (menuObj)menuObj.parentNode.removeChild(menuObj);menuObj = null;this._viewRestore();if (this._doOnAttachMenu)this._doOnAttachMenu("unload");}
 
 this.obj.attachToolbar = function(skin) {if (this.vs[this.av].toolbar)return;var toolbarObj = document.createElement("DIV");toolbarObj.style.position = "relative";toolbarObj.style.overflow = "hidden";toolbarObj.id = "dhxtoolbar_"+this._genStr(12);if (this.cv == this.av)this.vs[this.av].dhxcont.insertBefore(toolbarObj, this.vs[this.av].dhxcont.childNodes[(this.vs[this.av].menu!=null?1:0)]);else that.st.appendChild(toolbarObj);if (typeof(skin)!= "object") {this.vs[this.av].toolbar = new dhtmlXToolbarObject(toolbarObj.id, (skin||this.skin));}else {skin.parent = toolbarObj.id;this.vs[this.av].toolbar = new dhtmlXToolbarObject(skin);}
 this.vs[this.av].toolbarHeight = toolbarObj.offsetHeight;this.vs[this.av].toolbarId = toolbarObj.id;if (this._doOnAttachToolbar)this._doOnAttachToolbar("init");this.adjust();var t = this;this.vs[this.av].toolbar.attachEvent("_onIconSizeChange",function(size){t.vs[t.av].toolbarHeight = this.cont.offsetHeight;t.vs[t.av].toolbarId = this.cont.id;if (t._doOnAttachToolbar)t._doOnAttachToolbar("iconSizeChange");});if (this.skin != "dhx_terrace")this.vs[this.av].toolbar.callEvent("_onIconSizeChange",[]);return this.vs[this._viewRestore()].toolbar;}
 
 this.obj.detachToolbar = function() {if (!this.vs[this.av].toolbar)return;var toolbarObj = document.getElementById(this.vs[this.av].toolbarId);this.vs[this.av].toolbar.unload();this.vs[this.av].toolbar = null;this.vs[this.av].toolbarId = null;this.vs[this.av].toolbarHeight = null;if (toolbarObj)toolbarObj.parentNode.removeChild(toolbarObj);toolbarObj = null;this._viewRestore();if (this._doOnAttachToolbar)this._doOnAttachToolbar("unload");}
 
 this.obj.attachGrid = function() {if (this._isWindow && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this._redraw();}
 
 var obj = document.createElement("DIV");obj.id = "dhxGridObj_"+this._genStr(12);obj.style.width = "100%";obj.style.height = "100%";obj.cmp = "grid";document.body.appendChild(obj);this.attachObject(obj.id, false, true, false);this.vs[this.av].grid = new dhtmlXGridObject(obj.id);this.vs[this.av].grid.setSkin(this.skin);if (this.skin == "dhx_skyblue" || this.skin == "dhx_black" || this.skin == "dhx_blue"){this.vs[this.av].grid.entBox.style.border = "0px solid white";this.vs[this.av].grid._sizeFix = 2;}
 this.vs[this.av].gridId = obj.id;this.vs[this.av].gridObj = obj;if (this.skin == "dhx_terrace"){this.adjust();this.updateNestedObjects(true);}
 
 return this.vs[this._viewRestore()].grid;}
 
 this.obj.attachScheduler = function(day,mode,cont_id,scheduler) {scheduler = scheduler || window.scheduler;var ready = 0;if (cont_id){obj = document.getElementById(cont_id);if (obj)ready = 1;}
 if (!ready){var tabs = cont_id || '<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div><div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div><div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>';var obj = document.createElement("DIV");obj.id = "dhxSchedObj_"+this._genStr(12);obj.innerHTML = '<div id="'+obj.id+'" class="dhx_cal_container" style="width:100%;height:100%;"><div class="dhx_cal_navline"><div class="dhx_cal_prev_button">&nbsp;</div><div class="dhx_cal_next_button">&nbsp;</div><div class="dhx_cal_today_button"></div><div class="dhx_cal_date"></div>'+tabs+'</div><div class="dhx_cal_header"></div><div class="dhx_cal_data"></div></div>';document.body.appendChild(obj.firstChild);}
 
 this.attachObject(obj.id, false, true, false);this.vs[this.av].sched = scheduler;this.vs[this.av].schedId = obj.id;scheduler.setSizes = scheduler.update_view;scheduler.destructor=function(){};scheduler.init(obj.id,day,mode);return this.vs[this._viewRestore()].sched;}
 
 this.obj.attachTree = function(rootId) {if (this._isWindow && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this._redraw();}
 
 var obj = document.createElement("DIV");obj.id = "dhxTreeObj_"+this._genStr(12);obj.style.width = "100%";obj.style.height = "100%";obj.cmp = "tree";document.body.appendChild(obj);this.attachObject(obj.id, false, true, false);this.vs[this.av].tree = new dhtmlXTreeObject(obj.id, "100%", "100%", (rootId||0));this.vs[this.av].tree.setSkin(this.skin);this.vs[this.av].tree.allTree.childNodes[0].style.marginTop = "2px";this.vs[this.av].tree.allTree.childNodes[0].style.marginBottom = "2px";this.vs[this.av].treeId = obj.id;this.vs[this.av].treeObj = obj;if (this.skin == "dhx_terrace"){this.adjust();this.updateNestedObjects(true);}
 
 return this.vs[this._viewRestore()].tree;}
 
 this.obj.attachTabbar = function(mode) {if (this._isWindow && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.style.border = "none";this.setDimension(this.w, this.h);}
 
 var obj = document.createElement("DIV");obj.id = "dhxTabbarObj_"+this._genStr(12);obj.style.width = "100%";obj.style.height = "100%";obj.style.overflow = "hidden";obj.cmp = "tabbar";if (!this._isWindow)obj._hideBorders = true;document.body.appendChild(obj);this.attachObject(obj.id, false, true, false);if (this._isCell){this.hideHeader();obj._hideBorders = false;this._padding = false;}
 
 this.vs[this.av].tabbar = new dhtmlXTabBar(obj.id, mode||"top", (this.skin=="dhx_terrace"?null:20));if (!this._isWindow && this.skin != "dhx_terrace")this.vs[this.av].tabbar._s.expand = true;this.vs[this.av].tabbar.setSkin(this.skin);this.vs[this.av].tabbar.adjustOuterSize();this.vs[this.av].tabbarId = obj.id;this.vs[this.av].tabbarObj = obj;if (this.skin == "dhx_terrace"){this.adjust();this.updateNestedObjects(true);}
 
 return this.vs[this._viewRestore()].tabbar;}
 
 this.obj.attachFolders = function() {if (this._isWindow && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this._redraw();}
 var obj = document.createElement("DIV");obj.id = "dhxFoldersObj_"+this._genStr(12);obj.style.width = "100%";obj.style.height = "100%";obj.style.overflow = "hidden";obj.cmp = "folders";document.body.appendChild(obj);this.attachObject(obj.id, false, true, false);this.vs[this.av].folders = new dhtmlxFolders(obj.id);this.vs[this.av].folders.setSizes();this.vs[this.av].foldersId = obj.id;this.vs[this.av].foldersObj = obj;return this.vs[this._viewRestore()].folders;}
 
 this.obj.attachAccordion = function() {if (this._isWindow && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this._redraw();}
 
 var obj = document.createElement("DIV");obj.id = "dhxAccordionObj_"+this._genStr(12);this._padding = true;if (this.skin == "dhx_web"){obj.style.left = "0px";obj.style.top = "0px";obj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)+"px";obj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)+"px";}else if (this.skin != "dhx_terrace"){obj.style.left = "-1px";obj.style.top = "-1px";obj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)+2+"px";obj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)+2+"px";}
 
 
 obj.style.position = "relative";obj.cmp = "accordion";document.body.appendChild(obj);this.attachObject(obj.id, false, true, false);this.vs[this.av].accordion = new dhtmlXAccordion(obj.id, this.skin);this.vs[this.av].accordion.setSizes();this.vs[this.av].accordionId = obj.id;this.vs[this.av].accordionObj = obj;if (this.skin == "dhx_terrace"){this.adjust();this.updateNestedObjects(true);}
 
 return this.vs[this._viewRestore()].accordion;}
 
 this.obj.attachLayout = function(view, skin) {if (this._isCell && this.skin == "dhx_skyblue"){this.hideHeader();this.vs[this.av].dhxcont.style.border = "0px solid white";this.adjustContent(this.childNodes[0], 0);}
 
 if (this._isCell && this.skin == "dhx_web"){this.hideHeader();}
 
 this._padding = true;var obj = document.createElement("DIV");obj.id = "dhxLayoutObj_"+this._genStr(12);obj.style.overflow = "hidden";obj.style.position = "absolute";obj.style.left = "0px";obj.style.top = "0px";obj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)+"px";obj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)+"px";if ((this._isTabbarCell || this._isAcc)&& (this.skin == "dhx_skyblue")) {obj.style.left = "-1px";obj.style.top = "-1px";obj.style.width = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.width)+2+"px";obj.style.height = parseInt(this.vs[this.av].dhxcont.mainCont[this.av].style.height)+2+"px";}
 
 
 obj.dhxContExists = true;obj.cmp = "layout";document.body.appendChild(obj);this.attachObject(obj.id, false, true, false);this.vs[this.av].layout = new dhtmlXLayoutObject(obj, view, (skin||this.skin));if (this._isWindow)this.attachEvent("_onBeforeTryResize", this.vs[this.av].layout._defineWindowMinDimension);this.vs[this.av].layoutId = obj.id;this.vs[this.av].layoutObj = obj;if (this.skin == "dhx_terrace"){if (this._isCell){this.style.backgroundColor = "transparent";this.vs[this.av].dhxcont.style.backgroundColor = "transparent";this.hideHeader();}
 this.adjust();this.updateNestedObjects(true);}
 
 return this.vs[this._viewRestore()].layout;}
 
 this.obj.attachEditor = function(skin) {if (this._isWindow && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this._redraw();}
 
 var obj = document.createElement("DIV");obj.id = "dhxEditorObj_"+this._genStr(12);obj.style.position = "relative";obj.style.display = "none";obj.style.overflow = "hidden";obj.style.width = "100%";obj.style.height = "100%";obj.cmp = "editor";document.body.appendChild(obj);if (this.skin == "dhx_terrace")obj._attached = true;this.attachObject(obj.id, false, true, false);this.vs[this.av].editor = new dhtmlXEditor(obj.id, skin||this.skin);this.vs[this.av].editorId = obj.id;this.vs[this.av].editorObj = obj;if (this.skin == "dhx_terrace"){this.adjust();this.updateNestedObjects(true);}
 
 return this.vs[this._viewRestore()].editor;}
 
 this.obj.attachMap = function(opts) {var obj = document.createElement("DIV");obj.id = "GMapsObj_"+this._genStr(12);obj.style.position = "relative";obj.style.display = "none";obj.style.overflow = "hidden";obj.style.width = "100%";obj.style.height = "100%";obj.cmp = "gmaps";document.body.appendChild(obj);this.attachObject(obj.id, false, true, true);if (!opts)opts = {center: new google.maps.LatLng(40.719837,-73.992348), zoom: 11, mapTypeId: google.maps.MapTypeId.ROADMAP};this.vs[this.av].gmaps = new google.maps.Map(obj, opts);return this.vs[this.av].gmaps;}
 
 
 this.obj.attachObject = function(obj, autoSize, localCall, adjustMT) {if (typeof(obj)== "string") obj = document.getElementById(obj);if (autoSize){obj.style.visibility = "hidden";obj.style.display = "";var objW = obj.offsetWidth;var objH = obj.offsetHeight;}
 this._attachContent("obj", obj);if (autoSize && this._isWindow){obj.style.visibility = "";this._adjustToContent(objW, objH);}
 
 if (this.skin == "dhx_terrace"){if (this.vs[this.av].menu != null || this.vs[this.av].toolbar != null){this.adjust(typeof(adjustMT)=="undefined"||adjustMT==true);this.updateNestedObjects(true);}
 }
 if (!localCall){this._viewRestore();}
 
 }
 
 this.obj.detachObject = function(remove, moveTo) {var p = null;var pObj = null;var t = ["tree","grid","layout","tabbar","accordion","folders"];for (var q=0;q<t.length;q++){if (this.vs[this.av][t[q]]){p = this.vs[this.av][t[q]];pObj = this.vs[this.av][t[q]+"Obj"];if (remove){if (p.unload)p.unload();if (p.destructor)p.destructor();while (pObj.childNodes.length > 0)pObj.removeChild(pObj.childNodes[0]);pObj.parentNode.removeChild(pObj);pObj = null;p = null;}else {document.body.appendChild(pObj);pObj.style.display = "none";}
 this.vs[this.av][t[q]] = null;this.vs[this.av][t[q]+"Id"] = null;this.vs[this.av][t[q]+"Obj"] = null;}
 }
 
 if (p != null && pObj != null)return new Array(p, pObj);if (remove && this.vs[this.av]._frame){this._detachURLEvents();this.vs[this.av]._frame = null;}
 
 var objA = this.vs[this.av].dhxcont.mainCont[this.av];while (objA.childNodes.length > 0){if (remove == true){objA.removeChild(objA.childNodes[0]);}else {var obj = objA.childNodes[0];if (moveTo != null){if (typeof(moveTo)!= "object") moveTo = document.getElementById(moveTo);moveTo.appendChild(obj);}else {document.body.appendChild(obj);}
 obj.style.display = "none";}
 }
 
 objA = moveTo = null;}
 
 
 this.obj.appendObject = function(obj) {if (typeof(obj)== "string") {obj = document.getElementById(obj);}
 this._attachContent("obj", obj, true);}
 
 this.obj.attachHTMLString = function(str) {this._attachContent("str", str);var z=str.match(/<script[^>]*>[^\f]*?<\/script>/g)||[];for (var i=0;i<z.length;i++){var s=z[i].replace(/<([\/]{0,1})script[^>]*>/g,"")
 if (s){if (window.execScript)window.execScript(s);else window.eval(s);}
 }
 }
 
 this.obj.attachURL = function(url, ajax) {this._attachContent((ajax==true?"urlajax":"url"), url, false);if (this.skin == "dhx_terrace"){if (this.vs[this.av].menu != null || this.vs[this.av].toolbar != null){this.adjust(true);this.updateNestedObjects(true);}
 }
 this._viewRestore();}
 this.obj.adjust = function(adjustMT) {if (this.skin == "dhx_skyblue"){if (this.vs[this.av].menu){if (this._isWindow || this._isLayout){this.vs[this.av].menu._topLevelOffsetLeft = 0;document.getElementById(this.vs[this.av].menuId).style.height = "26px";this.vs[this.av].menuHeight = document.getElementById(this.vs[this.av].menuId).offsetHeight;if (this._doOnAttachMenu)this._doOnAttachMenu("show");}
 if (this._isCell){document.getElementById(this.vs[this.av].menuId).className += " in_layoutcell";this.vs[this.av].menuHeight = 25;}
 if (this._isAcc){document.getElementById(this.vs[this.av].menuId).className += " in_acccell";this.vs[this.av].menuHeight = 25;}
 if (this._doOnAttachMenu)this._doOnAttachMenu("adjust");}
 if (this.vs[this.av].toolbar){if (this._isWindow){document.getElementById(this.vs[this.av].toolbarId).className += " in_window";}
 if (this._isLayout){document.getElementById(this.vs[this.av].toolbarId).className += " in_layout";}
 if (this._isCell){document.getElementById(this.vs[this.av].toolbarId).className += " in_layoutcell";}
 if (this._isAcc){document.getElementById(this.vs[this.av].toolbarId).className += " in_acccell";}
 if (this._isTabbarCell){document.getElementById(this.vs[this.av].toolbarId).className += " in_tabbarcell";}
 }
 }
 
 if (this.skin == "dhx_web"){if (this.vs[this.av].toolbar){if (this._isWindow){document.getElementById(this.vs[this.av].toolbarId).className += " in_window";}
 if (this._isLayout){document.getElementById(this.vs[this.av].toolbarId).className += " in_layout";}
 if (this._isCell){document.getElementById(this.vs[this.av].toolbarId).className += " in_layoutcell";}
 if (this._isAcc){document.getElementById(this.vs[this.av].toolbarId).className += " in_acccell";}
 if (this._isTabbarCell){document.getElementById(this.vs[this.av].toolbarId).className += " in_tabbarcell";}
 }
 }
 
 if (this.skin == "dhx_terrace"){var mtLRPad = 0;if (this._isWindow || this._isCell || this._isAcc || this._isTabbarCell)mtLRPad = 14;if (this._isCell && this._noHeader)mtLRPad = 0;var mtTPad = 0;if (this._isWindow || this._isCell || this._isAcc || this._isTabbarCell)mtTPad = 14;if (this._isCell && this._noHeader)mtTPad = 0;var mBPad = ((adjustMT == true && !this.vs[this.av].toolbar) || this._isLayout ? 14 : 0);var tBPad = (adjustMT == true || this._isLayout ? 14 : 0);var mtAttached = false;if (this.vs[this.av].menu){document.getElementById(this.vs[this.av].menuId).style.marginLeft = mtLRPad+"px";document.getElementById(this.vs[this.av].menuId).style.marginRight = mtLRPad+"px";document.getElementById(this.vs[this.av].menuId).style.marginTop = mtTPad+"px";document.getElementById(this.vs[this.av].menuId).style.marginBottom = mBPad+"px";this.vs[this.av].menuHeight = 32+mtTPad+mBPad;if (this._doOnAttachMenu)this._doOnAttachMenu("show");mtAttached = true;}
 
 if (this.vs[this.av].toolbar){if (mtTPad == 0 && this.vs[this.av].menu != null & this._isCell)mtTPad = 14;document.getElementById(this.vs[this.av].toolbarId).style.marginLeft = mtLRPad+"px";document.getElementById(this.vs[this.av].toolbarId).style.marginRight = mtLRPad+"px";document.getElementById(this.vs[this.av].toolbarId).style.marginTop = mtTPad+"px";document.getElementById(this.vs[this.av].toolbarId).style.marginBottom = tBPad+"px";this.vs[this.av].toolbarHeight = 32+mtTPad+tBPad;if (this._doOnAttachToolbar)this._doOnAttachToolbar("show");mtAttached = true;}
 }
 }
 
 
 this.obj._attachContent = function(type, obj, append) {if (append !== true){if (this.vs[this.av]._frame){this._detachURLEvents();this.vs[this.av]._frame = null;}
 while (this.vs[this.av].dhxcont.mainCont[this.av].childNodes.length > 0)this.vs[this.av].dhxcont.mainCont[this.av].removeChild(this.vs[this.av].dhxcont.mainCont[this.av].childNodes[0]);}
 
 if (type == "url"){if (this._isWindow && obj.cmp == null && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this._redraw();}
 var fr = document.createElement("IFRAME");fr.frameBorder = 0;fr.border = 0;fr.style.width = "100%";fr.style.height = "100%";fr.setAttribute("src","javascript:false;");this.vs[this.av].dhxcont.mainCont[this.av].appendChild(fr);fr.src = obj;this.vs[this.av]._frame = fr;this._attachURLEvents();}else if (type == "urlajax"){if (this._isWindow && obj.cmp == null && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this.vs[this.av].dhxcont.mainCont[this.av].style.backgroundColor = "#FFFFFF";this._redraw();}
 var t = this;var tav = String(this.av).valueOf();var xmlParser = function(){var tmp = t.av;t.av = tav;t.attachHTMLString(this.xmlDoc.responseText, this);t.av = tmp;if (t._doOnFrameContentLoaded)t._doOnFrameContentLoaded();this.destructor();}
 var xmlLoader = new dtmlXMLLoaderObject(xmlParser, window);xmlLoader.dhxWindowObject = this;xmlLoader.loadXML(obj);}else if (type == "obj"){if (this._isWindow && obj.cmp == null && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this.vs[this.av].dhxcont.mainCont[this.av].style.backgroundColor = "#FFFFFF";this._redraw();}
 this.vs[this.av].dhxcont._frame = null;this.vs[this.av].dhxcont.mainCont[this.av].appendChild(obj);this.vs[this.av].dhxcont.mainCont[this.av].style.overflow = (append===true?"auto":"hidden");obj.style.display = "";}else if (type == "str"){if (this._isWindow && obj.cmp == null && this.skin == "dhx_skyblue"){this.vs[this.av].dhxcont.mainCont[this.av].style.border = "#a4bed4 1px solid";this.vs[this.av].dhxcont.mainCont[this.av].style.backgroundColor = "#FFFFFF";this._redraw();}
 this.vs[this.av].dhxcont._frame = null;this.vs[this.av].dhxcont.mainCont[this.av].innerHTML = obj;}
 }
 
 this.obj._attachURLEvents = function() {var t = this;var fr = this.vs[this.av]._frame;if (_isIE){fr.onreadystatechange = function(a) {if (fr.readyState == "complete"){try {fr.contentWindow.document.body.onmousedown=function(){if(t._doOnFrameMouseDown)t._doOnFrameMouseDown();};}catch(e){};try{if(t._doOnFrameContentLoaded)t._doOnFrameContentLoaded();}catch(e){};}
 }
 }else {fr.onload = function() {try{fr.contentWindow.onmousedown=function(){if(t._doOnFrameMouseDown)t._doOnFrameMouseDown();};}catch(e){};try{if(t._doOnFrameContentLoaded)t._doOnFrameContentLoaded();}catch(e){};}
 }
 }
 
 this.obj._detachURLEvents = function() {if (_isIE){try {this.vs[this.av]._frame.onreadystatechange = null;this.vs[this.av]._frame.contentWindow.document.body.onmousedown = null;this.vs[this.av]._frame.onload = null;}catch(e) {};}else {try {this.vs[this.av]._frame.contentWindow.onmousedown = null;this.vs[this.av]._frame.onload = null;}catch(e) {};}
 }
 
 this.obj.showMenu = function() {if (!(this.vs[this.av].menu && this.vs[this.av].menuId)) return;if (document.getElementById(this.vs[this.av].menuId).style.display != "none") return;this.vs[this.av].menuHidden = false;if (this._doOnAttachMenu)this._doOnAttachMenu("show");document.getElementById(this.vs[this.av].menuId).style.display = "";this._viewRestore();}
 
 this.obj.hideMenu = function() {if (!(this.vs[this.av].menu && this.vs[this.av].menuId)) return;if (document.getElementById(this.vs[this.av].menuId).style.display == "none") return;document.getElementById(this.vs[this.av].menuId).style.display = "none";this.vs[this.av].menuHidden = true;if (this._doOnAttachMenu)this._doOnAttachMenu("hide");this._viewRestore();}
 
 this.obj.showToolbar = function() {if (!(this.vs[this.av].toolbar && this.vs[this.av].toolbarId)) return;if (document.getElementById(this.vs[this.av].toolbarId).style.display != "none") return;this.vs[this.av].toolbarHidden = false;if (this._doOnAttachToolbar)this._doOnAttachToolbar("show");document.getElementById(this.vs[this.av].toolbarId).style.display = "";this._viewRestore();}
 
 this.obj.hideToolbar = function() {if (!(this.vs[this.av].toolbar && this.vs[this.av].toolbarId)) return;if (document.getElementById(this.vs[this.av].toolbarId).style.display == "none") return;this.vs[this.av].toolbarHidden = true;document.getElementById(this.vs[this.av].toolbarId).style.display = "none";if (this._doOnAttachToolbar)this._doOnAttachToolbar("hide");this._viewRestore();}
 
 this.obj.showStatusBar = function() {if (!(this.vs[this.av].sb && this.vs[this.av].sbId)) return;if (document.getElementById(this.vs[this.av].sbId).style.display != "none") return;this.vs[this.av].sbHidden = false;if (this._doOnAttachStatusBar)this._doOnAttachStatusBar("show");document.getElementById(this.vs[this.av].sbId).style.display = "";this._viewRestore();}
 
 this.obj.hideStatusBar = function() {if (!(this.vs[this.av].sb && this.vs[this.av].sbId)) return;if (document.getElementById(this.vs[this.av].sbId).style.display == "none") return;this.vs[this.av].sbHidden = true;document.getElementById(this.vs[this.av].sbId).style.display = "none";if (this._doOnAttachStatusBar)this._doOnAttachStatusBar("hide");this._viewRestore();}
 
 this.obj._dhxContDestruct = function() {var av = this.av;for (var a in this.vs){this.av = a;this.detachMenu();this.detachToolbar();this.detachStatusBar();this.detachObject(true);this.vs[a].dhxcont.mainCont[a] = null;}
 
 for (var a in this.vs){this.vs[a].dhxcont.mainCont = null;this.vs[a].dhxcont.innerHTML = "";this.vs[a].dhxcont = null;this.vs[a] = null;}
 this.vs = null;this.attachMenu = null;this.attachToolbar = null;this.attachStatusBar = null;this.detachMenu = null;this.detachToolbar = null;this.detachStatusBar = null;this.showMenu = null;this.showToolbar = null;this.showStatusBar = null;this.hideMenu = null;this.hideToolbar = null;this.hideStatusBar = null;this.attachGrid = null;this.attachScheduler = null;this.attachTree = null;this.attachTabbar = null;this.attachFolders = null;this.attachAccordion = null;this.attachLayout = null;this.attachEditor = null;this.attachObject = null;this.detachObject = null;this.appendObject = null;this.attachHTMLString = null;this.attachURL = null;this.attachMap = null;this.view = null;this.show = null;this.adjust = null;this.setMinContentSize = null;this.moveContentTo = null;this.adjustContent = null;this.coverBlocker = null;this.showCoverBlocker = null;this.hideCoverBlocker = null;this.updateNestedObjects = null;this._attachContent = null;this._attachURLEvents = null;this._detachURLEvents = null;this._viewRestore = null;this._setPadding = null;this._init = null;this._genStr = null;this._dhxContDestruct = null;this._getSt = null;this.getFrame = null;this.getView = null;this.setActive = null;that.st.innerHTML = "";that.st.parentNode.removeChild(that.st);that.st = null;that.setContent = null;that.dhxcont = null;that.obj = null;that = null;if (dhtmlx.detaches)for (var a in dhtmlx.detaches)dhtmlx.detaches[a](this);}
 
 
 if (dhtmlx.attaches)for (var a in dhtmlx.attaches)this.obj[a] = dhtmlx.attaches[a];return this;}
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
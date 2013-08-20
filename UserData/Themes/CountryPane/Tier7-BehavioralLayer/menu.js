// JavaScript Document
//	alert("Testing This Out");

menu();

function menu() 
{
	var alllistLi = document.getElementById("TopPanel1").getElementsByTagName("ul");
	walkMenuHide(alllistLi);
}

function walkMenuHide(node)
{
	///alert(node.length);
	//var restrictedLi;
	//var listLi
	//length = node.length;
	//alert(length);
	var length = node.length
	length--
	var i = length;
	while (i > 0)
	{
		//restrictedLi = node[i];
		//divideLiElements(node[i]);
		restrictedLi = node[i];
		divideLiElements(restrictedLi);
		//listLi = restrictedLi.getElementsByTagName("li");
		//modifyChildNodes(listLi, "#FF0000");
		
		//node.onmousover = dummy;
		//node.addEventListener("click", dummy, false);
		//restrictedLi.attachEvent("onmouseover", dummy);
		//hideNode(listLi);
		
		//node.addEventListener("mouseover", showNode(listLi), false);
		//unsetArray(restrictedLi);
		//unsetArray(listLi);
		
		///if (restrictedLi)
		///{
			///alert("I HAVE SOMETHING!");
		///}
		//alert("TESTING" + i);
		//showNode(listLi);
		if (node[i].parentNode.addEventListener)
		{	
			node[i].parentNode.addEventListener("mouseover", hoverover, false);
			node[i].parentNode.addEventListener("mouseout", hoverout, false);
		}
		if (node[i].parentNode.attachEvent)
		{
			node[i].parentNode.attachEvent("onmouseover", hoverover);
			node[i].parentNode.attachEvent("onmouseout", hoverout);
		}
		
		i--;
	}
	///node[1].addEventListener("mouseover", hoverover, false);
	///node[1].addEventListener("mouseout", hoverout, false);
	//node[20].style.visibility = "visible";
	//node[1].onmouseover = dummy;
	
}

function divideLiElements(node)
{
	listLi = node.getElementsByTagName("li");
	hideNode(listLi);
}

function modifyChildNodes(node, color)
{
	for (i = 0; i < node.length; i++)
	{
		node[i].style.color = color;
		//node[i].style.visibility = "hidden";
	}
	
}

function hoverover(e) 
{
	//var alllistLi = document.getElementsByTagName("li");
	//e.stopPropagation();
	if (this.getElementsByTagName)
	{
		this.style.color = "#FF0000";
		
		var idname = this.id;
		var alllistLi = document.getElementById(idname).getElementsByTagName("li");
		showNode(alllistLi);
		//alert(alllistLi[0].textContent);
		
		idname2 = idname.replace("Top", "Sub");
		var i = 1;
		subidname = idname2 + '-' + i;
		while (document.getElementById(subidname).getElementsByTagName("li"))
		{
			//subidname = idname2 + '-' + i;
			hidealllistLi = document.getElementById(subidname).getElementsByTagName("li");
			//alert(hidealllistLi[1].showContent);
			hideNode(hidealllistLi);
			i++;
			subidname = idname2 + '-' + i;
		}
		//alllistLi[0].onmouseover = hoverover;
		//alllistLi[0].addEventListener("mouseover", hoverover, false);
		//if (alllistLi.mouseover) {
			//alert("TESTING");
		//}
		//alert (subidname);
		
		//alert(idname);
		//var alllistLi = this.getElementsByTagName("li");
		//alert(alllistLi.length);
		//alert(alllistLi[0].className);
		//alert(e);
		//var alllistLi = this.childNodes[1].getElementsByTagName("li");
		//alert (this.childNodes[1].id);
		//alert (this.childNodes[1].textContent); //Top Menu Name
		//alert (this.childNodes[3].textContent); // Sub Menu List
		//alert (this.childNodes[3].childNodes[1].textContent); // Sub Menu Name
		
		//showNode(this.childNodes[3]);
		//alert (this.childNodes[1].childNodes[1].textContent);
		//alllistLi.id = "TopMenu";
		//alert(alllistLi.id);
		//alllistLi.childNodes[1].id = "SubMenu1";
		//alert(alllistLi.length);
		//alert(alllistLi.childNodes[1].id);
		//var alllistClass = document.getElementsByTagName("class");
		//var classelement = alllistClass.textContent();
		//alert (alllistClass.length);
		//alert(this.childNodes[1].nodeType);
		//alert("test");
		///alert (e.childNodes[1].nodeType);
		//alert(this.childNodes[3].textContent);
		//alert(this.childNodes[3].childNodes[1].textContent);
		//alert(this.childNodes[3].style.visiblity);
		//this.childNodes[3].childNodes[1].style.visiblity = "visible";
		//alert(this.firstChild.textContent);
		//alert(this.style.visibility);
		//this.style.visibility = "visible";
		//showNode(this.childNodes[3]);
		//alert(alllistLi.nodeType);
		//showNode(alllistLi);
		//hideNode(hidealllistLi);
		//hideNode(this.childNodes[3]);
		//this.childNodes[3].style.color = "#DD0000";
		//hideNode(this.childNodes[3]);
		//this.childNodes[3].visibility = "hidden";
		//alert (alllistLi.childNodes[1].visibility);
		/*
		var i = 1;
		while (i < alllistLi.length)
		{
			alllistLi[i].style.visibility = "hidden";
			i++;
		}
		*/
		/*
		i = 1;
		while (i < alllistLi.length)
		{
			
			
		}
		*/
		//alert (alllistLi[0].textContent);
		//alert (alllistLi[0].style.visibility);
		//alllistLi[1].style.visibility = "hidden";
		//alllistLi[2].style.visibility = "hidden";
		//alllistLi[3].style.visibility = "hidden";
		//alllistLi[4].style.visibility = "hidden";
		//alllistLi[5].style.visibility = "hidden";
		//alllistLi[6].style.visibility = "hidden";
		//alllistLi[7].style.visibility = "hidden";
		//alert (alllistLi[1].style.visibility);
		//alert (alllistLi.length);
		//hideNode(this.childNodes[3].childNodes[1]);
		//showNode(this.getElementsByTagName("li"));
		//hideNode(alllistLi.getElementsByTagName("ul"));
		//showNode(this.childNodes[3]);
		//hideNode(alllistLi.childNodes[1]);
		//showNode2(alllistLi);
		
	} 
	else
	{
		//alert(this.idname2);
		//alert(this.length);
	}
	
	//this.style.color = "#FF0000";
	//var i = 1;
	//var alllistLi2 = alllistLi.childNodes[i].getElementsByTagName("li");
	//while (i < alllistLi.length)
	//{
		//hideNode(alllistLi2);
		//i++;
	//}
	//alert("TESTING");
	//var alllistLi = this;
	//this.style.visibility = "visible";
	////this.style.visibility = "hidden";
	//this.parentNode.style.color = "#FF0000";
	
	//var restrictedLi = this.getElementsByTagName("li");
	//this.childNodes[1].style.visibility = "visible";
	//showNode(alllistLi);
	//this.nextSibling.style.visibility = "visible";
	//showNode(alllistLi[1]);
	//alllistLi[4].style.visibility = "visible";
	//alert ("TESTING THIS OUT");
	//alert(alllistLi[10].nodeType);	
}

function hoverout(e) 
{
	//var alllistLi = document.getElementsByTagName("li");
	//e.stopPropagation();
	if (this.getElementsByTagName)
	{
		var alllistLi = this.getElementsByTagName("li");
		this.style.color = "#000000";
		hideNode(alllistLi);
	}
	//this.style.visibility = "hidden";
	///this.style.visibility = "visible";
	//this.parentNode.style.color = "#000000";
	
	//showNode(alllistLi[1]);
	//alllistLi[4].style.visibility = "visible";
	//alert ("TESTING THIS OUT");
	//alert(alllistLi[10].nodeType);	
}

function hideNode(node) 
{
	for (i = 0; i < node.length; i++)
	{
		node[i].style.visibility = "hidden";
	}
}

function showNode2(node)
{
	for (i = 0; i < node.length; i++)
	{
		node[i].style.visibility = "visible";
	}  
}

function showNode(node) 
{
	for (i = 0; i < node.length; i++)
	{
		node[i].style.visibility = "visible";
	}   
}


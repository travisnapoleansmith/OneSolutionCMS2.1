mainmenu();

function mainmenu(){
jQuery(" #menu ul ").css({display: "none"}); // Opera Fix
jQuery(" #menu li").hover(show, hide);
}
 
function show(e) 
{
	 jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(0);
}

function hide(e)
{
	jQuery(this).find('ul:first').css({visibility: "hidden"});
}
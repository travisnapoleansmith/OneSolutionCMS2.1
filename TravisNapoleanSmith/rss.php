<?php
$var = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
$var .= "<rss version=\"2.0\">\n";
$var .= "<channel>\n";
$var .= "	<title>MY RSS FEED</title>\n";
$var .= "	<link>http://beta.travisnapoleansmith.org/rss.php</link>\n";
$var .= "	<description>This is a description of my feed!</description>\n";
$var .= "	<lastBuildDate>Mon, 12 Sept 2005 18:37:00 GMT</lastBuildDate>\n";
$var .= "	<language>en-us</language>\n";
	
$var .= "	<item>\n";
$var .= "		<title>Title of my item</title>\n";
$var .= "		<link>http://beta.travisnapoleansmith.org/rss.php</link>\n";
$var .= "		<pubDate>Mon, 12 Sep 2005 18:37:00 GMT</pubDate>\n";
$var .= "		<description>This is my description</description>\n";
$var .= "	</item>\n";
$var .= "</channel>\n";
$var .= "</rss>\n";

print "$var";
//$myFile = 'rss.xml';
//$file = fopen($myFile, 'w');
//if ($file) {
	//fwrite($file, $var);
	//fclose($file);
	//header("Location: http://beta.travisnapoleansmith.org/rss.xml");
	//print "DOG\n";
//}
?>
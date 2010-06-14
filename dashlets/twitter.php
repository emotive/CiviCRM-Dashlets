<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<body>

<style>
.dashlet-twitter-username {font-size: 13px; font-weight: bold; font-family: Verdana, sans-serif;}
.dashlet-twitter-followers, .feed-title, .feed-description {font-size: 11px; font-family: Verdana, sans-serif;}
.feed-icon {float:left; width:20px; padding-right:5px;padding-bottom: 10px;}
.feed-date {font-style: italic; color: gray;}
a:link, a:visited {color: #027AC6;text-decoration: none;}
#twitter_feed {height: 120px; overflow-y: scroll;}

</style>

<?php
include 'config.inc';



function string_getInsertedString($long_string,$short_string,$is_html=false){
  if($short_string>=strlen($long_string))return false;
  $insertion_length=strlen($long_string)-strlen($short_string);
  for($i=0;$i<strlen($short_string);++$i){
    if($long_string[$i]!=$short_string[$i])break;
  }
  $inserted_string=substr($long_string,$i,$insertion_length);
  if($is_html && $inserted_string[$insertion_length-1]=='<'){
    $inserted_string='<'.substr($inserted_string,0,$insertion_length-1);
  }
  return $inserted_string;
}

function DOMElement_getOuterHTML($document,$element){
  $html=$document->saveHTML();
  $element->parentNode->removeChild($element);
  $html2=$document->saveHTML();
  return string_getInsertedString($html,$html2,true);
}

function getFollowers($username){
  $x = file_get_contents("http://twitter.com/".$username);
  $doc = new DomDocument;
  @$doc->loadHTML($x);
  $ele = $doc->getElementById('follower_count');
  $innerHTML=preg_replace('/^<[^>]*>(.*)<[^>]*>$/',"\\1",DOMElement_getOuterHTML($doc,$ele));
  return $innerHTML;
}
echo "<img src='/dashlets/images/twitter.png' border='0' align='right'><h1 class='dashlet-twitter-username'><a href='http://twitter.com/".$twitterid."'  target='_blank'>@".$twitterid."</a></h1>";
echo "<div class='dashlet-twitter-followers'>You have <strong>".getFollowers($twitterid)."</strong> followers on Twitter.</div>";


include_once $_SERVER['DOCUMENT_ROOT'] . '/dashlets/inc/simplepie.inc'; 
$feed = new SimplePie('http://search.twitter.com/search.atom?q=+-from%3A'.$twitterid.'+'.$twitterid);


?>

<hr style="margin-bottom:15px;">
<div id="twitter_feed">
<?php foreach($feed->get_items(0, 15) as $item): ?>
<?php foreach ($item->get_authors() as $author)
{
	$author_name = $author->get_name();
	$author_link = $author->get_link();
}
?>

   <div class="feed-item-container">
     <div class="feed-icon"><a target="_blank" href="<?php echo $item->get_permalink(); ?>"><img src="/dashlets/images/chat.png" border="0"></a></div>
    <p class="feed-description"><a target=_blank href="<?php echo $author_link ?>"><?php echo $author_name."</a>: ".$item->get_title(); ?>
     <span class="feed-date">(posted <?php echo $item->get_date('F j | g:i a'); ?>)</span>    </p>
   </div>
<?php endforeach;?>

</div>
	
</body>
</html>
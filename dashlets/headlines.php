<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<body>

<style>
a:link, a:visited {color: #027AC6;text-decoration: none;}
#headlines_feed {height: 180px; overflow-y: scroll;}

</style>

<?php
include 'config.inc';


include_once $_SERVER['DOCUMENT_ROOT'] . '/dashlets/inc/simplepie.inc'; 
$feed = new SimplePie('http://rds.yahoo.com/_ylt=A0wNdCb9ygpM5y0BSXDQtDMD/SIG=140qb4m0b/EXP=1275862141/**http%3a//news.search.yahoo.com/rss%3fei=UTF-8%26p='.$search_keywords.'%26fr=news-us-ss%26type=all%26age=all');

?>

<div id="headlines_feed">
<?php foreach($feed->get_items(0, 10) as $item): ?>

   <div class="feed-item-container">
    <p class="feed-description">
    	<strong><a target="_blank" href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a><br></strong>
    	<?php echo $item->get_description(); ?>
    </p>
   </div>
<?php endforeach;?>

</div>
	
</body>
</html>
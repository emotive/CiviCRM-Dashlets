<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<body>

<style>
a:link, a:visited {color: #027AC6;text-decoration: none;}
#headlines_feed {height: 180px; overflow-y: scroll;}
.feed-date {font-style: italic; color: gray;}
</style>

<?php
include 'config.inc';


include_once $_SERVER['DOCUMENT_ROOT'] . '/dashlets/inc/simplepie.inc'; 
$feed = new SimplePie('http://blogsearch.google.com/blogsearch_feeds?hl=en&scoring=d&as_drrb=q&as_qdr=a&q='.$search_keywords.'&ie=utf-8&num=10&output=rss');


?>

<div id="headlines_feed">
<?php foreach($feed->get_items(0, 10) as $item): ?>
<?php foreach ($item->get_authors() as $author)
{
	$author_name = $author->get_name();
	$author_link = $author->get_link();
}
?>
   <div class="feed-item-container">
    <p class="feed-description">
    	<strong><a target="_blank" href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a><br></strong>
    	<?php echo $item->get_description(); ?>
    	<br><span class="feed-date">Posted <?php echo $item->get_date('F j | g:i a'); ?> by <?php echo $author_name ?></span>   
    </p>
   </div>
<?php endforeach;?>

</div>
	
</body>
</html>
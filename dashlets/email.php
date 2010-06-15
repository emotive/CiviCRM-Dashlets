<style>
table {border: 1px solid #DDD;border-collapse: collapse;margin: 0.5em 0.1em;width: 99%;background-color: #f7f7f7;}
td {border: 1px groove #DDD;padding: 4px;vertical-align: top;font-size: 11px; font-family: Verdana, sans-serif;}
.rowhead {font-weight: bold;background-color: #E6E6E6;}
.rowtotal {font-weight: bold;}
</style>


<?php 
//Show errors remove this later
error_reporting(E_ALL);
ini_set('display_errors', '1');


include 'config.inc';

$link = mysql_connect($mysql_host, $mysql_login, $mysql_pass);
mysql_select_db($mysql_db, $link);

// get the last 7 mailings that are complete
$result = mysql_query("SELECT name, id FROM civicrm_mailing where is_completed = 1 order by id desc limit 7", $link);



?>

<table>
	<tr class='rowhead'>
		<td>Mailing</td>
		<td>Date</td>
		<td>Delivered</td>
		<td>Opened</td>
		<td>Clicks</td>
		<td>Bounces</td>
		<td>Unsub</td>
	</tr>

<?php 
	// loop through and display details on the returned mailings
	while($recent_mailings = mysql_fetch_array($result)) {;
	
	// Get date sent
	$date_result = mysql_query("SELECT end_date FROM civicrm_mailing_job where mailing_id = ".$recent_mailings['id']." order by end_date desc", $link);
	$mailing_date = mysql_fetch_array($date_result);

	// Get total delivered
	$delivered_result = mysql_query("select * from civicrm_mailing_job, civicrm_mailing_event_queue, civicrm_mailing_event_delivered where civicrm_mailing_job.id = civicrm_mailing_event_queue.job_id and civicrm_mailing_event_queue.id = civicrm_mailing_event_delivered.event_queue_id and civicrm_mailing_job.mailing_id = ".$recent_mailings['id']."", $link);
	$mailing_delivered = mysql_num_rows($delivered_result);
	
	// Get total opened
	$opened_result = mysql_query("select * from civicrm_mailing_job, civicrm_mailing_event_queue, civicrm_mailing_event_opened where civicrm_mailing_job.id = civicrm_mailing_event_queue.job_id and civicrm_mailing_event_queue.id = civicrm_mailing_event_opened.event_queue_id and civicrm_mailing_job.mailing_id = ".$recent_mailings['id']."", $link);
	$mailing_opened = mysql_num_rows($opened_result);

	// Get total bounces
	$bounce_result = mysql_query("select * from civicrm_mailing_job, civicrm_mailing_event_queue, civicrm_mailing_event_bounce where civicrm_mailing_job.id = civicrm_mailing_event_queue.job_id and civicrm_mailing_event_queue.id = civicrm_mailing_event_bounce.event_queue_id and civicrm_mailing_job.mailing_id = ".$recent_mailings['id']."", $link);
	$mailing_bounce = mysql_num_rows($bounce_result);

	// Get total unsubscribes
	$unsubscribe_result = mysql_query("select * from civicrm_mailing_job, civicrm_mailing_event_queue, civicrm_mailing_event_unsubscribe where civicrm_mailing_job.id = civicrm_mailing_event_queue.job_id and civicrm_mailing_event_queue.id = civicrm_mailing_event_unsubscribe.event_queue_id and civicrm_mailing_job.mailing_id = ".$recent_mailings['id']."", $link);
	$mailing_unsubscribe = mysql_num_rows($unsubscribe_result);
		
	// Get total clicks
	$trackable_url_open_result = mysql_query("select * from civicrm_mailing_job, civicrm_mailing_event_queue, civicrm_mailing_event_trackable_url_open where civicrm_mailing_job.id = civicrm_mailing_event_queue.job_id and civicrm_mailing_event_queue.id = civicrm_mailing_event_trackable_url_open.event_queue_id and civicrm_mailing_job.mailing_id = ".$recent_mailings['id']."", $link);
	$mailing_trackable_url_open = mysql_num_rows($trackable_url_open_result);
		
		
?>

	<tr>
		<td><?php echo $recent_mailings['name'] ?></td>
		<td><?php echo substr($mailing_date['end_date'],5,11) ?></td>
		<td><?php echo $mailing_delivered ?></td>
		<td><?php echo $mailing_opened ?></td>
		<td><?php echo $mailing_trackable_url_open ?></td>
		<td><?php echo $mailing_bounce ?></td>
		<td><?php echo $mailing_unsubscribe ?></td>
	</tr>
	
<?php } ?>


</table>
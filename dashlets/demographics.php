<?php 
include 'config.inc';
?>

<style>
#quantcast_col1, #quantcast_col2 {width: 270px; float: left;}
#quantcast_container {margin-right: 10px; margin-bottom: 10px;}
#quantcast_heading {background: #ccc; font-size: 11px; font-style: bold; padding: 5px; font-family: Verdana, sans-serif;}
#quantcast_data {border: #ccc solid thin; padding: 5px;}
</style>


<div id="quantcast_col1">

<div id="quantcast_container">
	<div id="quantcast_heading">Gender</div>
	<div id="quantcast_data">
		<iframe id="gender" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="0" height="49" width="250"  src="http://www.quantcast.com/profile/embed?img=http%3A//www.quantcast.com/profile/demographicGraph%3Fdemo%3Dgender%26wunit%3Dwd%253A<?php echo $quantcast_domain ?>%26country%3DUS&w=250&h=80&showDeleteButtons=false&wunit=Charts.Demographics.gender.<?php echo $quantcast_id ?>"></iframe>
	</div>
</div>

<div id="quantcast_container">
	<div id="quantcast_heading">Age</div>
	<div id="quantcast_data">
		<iframe id="age" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="0" height="94" width="250"  src="http://www.quantcast.com/profile/embed?img=http%3A//www.quantcast.com/profile/demographicGraph%3Fdemo%3Dage%26wunit%3Dwd%253A<?php echo $quantcast_domain ?>%26country%3DUS&w=250&h=125&showDeleteButtons=false&wunit=Charts.Demographics.age.<?php echo $quantcast_id ?>"></iframe>
	</div>
</div>

<div id="quantcast_container">
	<div id="quantcast_heading">Ethnicity</div>
	<div id="quantcast_data">
		<iframe id="ethnicity" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="0" height="94" width="250"  src="http://www.quantcast.com/profile/embed?img=http%3A//www.quantcast.com/profile/demographicGraph%3Fdemo%3Dethnicity%26wunit%3Dwd%253A<?php echo $quantcast_domain ?>%26country%3DUS&w=250&h=125&showDeleteButtons=false&wunit=Charts.Demographics.ethnicity.<?php echo $quantcast_id ?>"></iframe>
	</div>
</div>

<div id="quantcast_container">
	<div id="quantcast_heading">Education</div>
	<div id="quantcast_data">
		<iframe id="education" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="0" height="64" width="250"  src="http://www.quantcast.com/profile/embed?img=http%3A//www.quantcast.com/profile/demographicGraph%3Fdemo%3Deducation%26wunit%3Dwd%253A<?php echo $quantcast_domain ?>%26country%3DUS&w=250&h=95&showDeleteButtons=false&wunit=Charts.Demographics.education.<?php echo $quantcast_id ?>"></iframe>
	</div>
</div>


<div id="quantcast_container">
	<div id="quantcast_heading">Household Income</div>
	<div id="quantcast_data">
		<iframe id="income" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="0" height="79" width="250"  src="http://www.quantcast.com/profile/embed?img=http%3A//www.quantcast.com/profile/demographicGraph%3Fdemo%3Dincome%26wunit%3Dwd%253A<?php echo $quantcast_domain ?>%26country%3DUS&w=250&h=110&showDeleteButtons=false&wunit=Charts.Demographics.income.<?php echo $quantcast_id ?>"></iframe>
	</div>
</div>


</div>


<div id="quantcast_col2">

<div id="quantcast_container">
	<div id="quantcast_heading">Children</div>
	<div id="quantcast_data">
		<iframe id="children" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="0" height="184" width="250"  src="http://www.quantcast.com/profile/embed?img=http%3A//www.quantcast.com/profile/demographicGraph%3Fdemo%3Dchildren%26wunit%3Dwd%253A<?php echo $quantcast_domain ?>%26country%3DUS&w=250&h=215&showDeleteButtons=false&wunit=Charts.Demographics.children.<?php echo $quantcast_id ?>"></iframe>
	</div>
</div>






<div id="quantcast_container">
	<div id="quantcast_heading">Internet Usage At</div>
	<div id="quantcast_data" style="height:50px;overflow:hidden;">
		<img src="http://www.quantcast.com/profile/workHomeGraph?size=small&wunit=wd:<?php echo $quantcast_domain ?>" border="0">
	</div>
</div>







<div id="quantcast_container">
	<div id="quantcast_heading">Visitor Freqency</div>
	<div id="quantcast_data">
		<iframe id="frequency" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="0" height="125" width="250"  src="http://www.quantcast.com/profile/embed?img=http%3A//www.quantcast.com/profile/pieGraph%3Fwunit%3Dwd%253A<?php echo $quantcast_domain ?>%26country%3DUS&w=250&h=156&showDeleteButtons=false&wunit=Charts.Traffic.FrequencyGraph.Site.<?php echo $quantcast_id ?>"></iframe>
	</div>
</div>



</div>







<script>
document.getElementById('age').src=document.getElementById('age').src;
document.getElementById('frequency').src=document.getElementById('frequency').src;
document.getElementById('children').src=document.getElementById('children').src;
document.getElementById('gender').src=document.getElementById('gender').src;
document.getElementById('ethnicity').src=document.getElementById('ethnicity').src;
document.getElementById('income').src=document.getElementById('income').src;
document.getElementById('education').src=document.getElementById('education').src;
</script>




<?php
	$counter = simplexml_load_file("counter.xml");
	echo "Number of views: ". $counter->counter[0];
?>
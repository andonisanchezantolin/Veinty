<?php
	$count = simplexml_load_file("counter.xml");
	$numCount = $count->counter[0];
	$count->counter[0] = $numCount + 1;
	$count->asXML("counter.xml");
?>
<?php
	
	$start_day = explode("-", '2019-03-16');
	$year = $start_day[0];
	$month = $start_day[1];
	$day = $start_day[2];

	print 'year = ' . $year . '<br>';
	print 'month = ' . $month . '<br>';
	print 'day = ' . $day . '<br>';

	//$the_time = mktime(0,0,0,$month,$day,$year,0);
	$the_time = mktime(0,0,0,$month,$day,$year);

	//$the_time = mktime($start_time[0], $start_time[1], 0, 0, 0, 0);
	//$the_time = mktime($start_time[0], $start_time[1], $start_time[2], 0, 0, 0);

	/*
	mktime (	[ int $hour = date("H") 
				[, int $minute = date("i") 
				[, int $second = date("s") 
				[, int $month = date("n") 
				[, int $day = date("j") 
				[, int $year = date("Y") 
				, int $is_dst = -1 
			]]]]]]] ) : int
	*/

	print 'the_time = ' . $the_time . '<br>'; // 1552662000

?>
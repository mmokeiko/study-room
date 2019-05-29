<?php
	$str = 'message test';
	if (ereg('test', $str)) {
		print 'ereg() test'.'<br>';
	}

	if (preg_match('/test/', $str)){
		print 'preg_match() test'.'<br>';
	}

?>
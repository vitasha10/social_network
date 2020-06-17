<?php
	global $SCRIPT_START_TIME;
	
	$pageload	= number_format(microtime(TRUE)-$SCRIPT_START_TIME, 6, '.', '');
	$loadavg	= '';
	if( function_exists('sys_getloadavg') ) {
		$sys_loadavg	= sys_getloadavg();
		$loadavg	= implode(', ', $sys_loadavg);
	}
	
	$sql1	= $GLOBALS['db1']->get_debug_info();
	
	$debug_info_mysql = '<em>Query Number:</em> <strong>'.count($sql1->queries).'</strong><br /> ';
	$debug_info_mysql .= '<em>Query Time:</em> <strong>'.(( $sql1->time > 1 )? '<span style="color: red;">'.floatval($sql1->time).'</span>' : floatval($sql1->time)).'</strong><br /> ';
	$debug_info_mysql .= '<table id="table_assigned_vars"><tr><td><h2>Query Time</h2></td><td><h2>Query Value</h2></td></tr>';
	
	foreach($sql1->queries as $query) {
		$debug_info_mysql .= '<tr><td>'. ( ( floatval($query->time) > 0.5 )? '<span style="color: red;">'.$query->time.'</span>' : $query->time ).'</td><td>'. $query->query .'</td></tr>';
	}
	
	$debug_info_mysql .= '</table>';
	
	$debug_template = '
			
	<!DOCTYPE html>
	<html>
	<head>
	    <title>Debug Console</title>
		<style type="text/css">
			
			* {margin:0; padding:0; font-size: 100%;}
			html, body {font-family:arial, helvetica, tahoma, verdana, "lucida grande", sans-serif; font-size:12px; line-height:1.3; color:#666; background:#fff;}
			h1 {margin:0; text-align:left; padding:2px; font-weight:normal; font-size:16px; border-top:1px solid #999; border-bottom:1px solid #E5E5E5; background:whiteSmoke; line-height:40px;}
			h1 img {width:100px; height:40px; margin:0 20px 0 10px; float:left;}
			h2 {color:#DD4B39; text-align:left; font-weight:bold; border-bottom:1px solid #E5E5E5; margin:10px 0 15px; padding:2px 10px; font-size:12px;}
			body {background:#fff;}
			p {margin:0; font-style:italic; text-align:center;}
			table {width:100%;}
			th, td {font-family:monospace; vertical-align:top; text-align:left;}
			td {color:green;}
			.odd {background-color:#eeeeee;}
			.even {background-color:#fafafa;}
			.exectime {font-size:0.8em; font-style:italic;}
			.container {padding:0 10px;}
			#table_assigned_vars th {color:blue;}
			#table_config_vars th {color:maroon;}
		</style>
	</head>
	<body>
		<h1>Debug Console  -  <span style="font-weight:bold;">'. htmlspecialchars($K->SITE_TITLE) .'</span></h1>
	
		<h2>Execution info</h2>
	
		<div class="container">
			<em>Execution Time:</em> <strong>'.$pageload.'</strong><br />
			<em>Memory Usage:</em> <strong>'.round(memory_get_usage()/(1024*1024),5).'</strong><br /> '.
			(!empty($loadavg)? '<em>Server Load Average:</em> <strong>'.( ( $sys_loadavg[0] > 2 )? '<span style="color: red;">'.$loadavg.'</span>' : $loadavg).'</strong>' : '' ) .'
		</div>
			
		<h2>Assigned template variables</h2>
			
			
		<h2>MySQL Queries</h2>
		'.$debug_info_mysql.'
	
	</body>
	</html>';
	
	
	$debug_template = strtr($debug_template, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));
	
	echo 	'<script type="text/javascript">
	    			_debug_console = window.open("","consoled41d8cd98f00b204e9800998ecf8427e","width=680,height=600,resizable,scrollbars=yes");
	    			_debug_console.document.write("'. $debug_template.'");
	    			_debug_console.document.close();
				</script>';
?>
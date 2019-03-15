<?php

time diffrence in php

$date_time = date("Y-m-d H:i:s");
				$last_request_time = $user->modified ;
				
				$start  = date_create('2018-02-12');
				$end 	= date_create(); // Current time and da
				$diff  	= date_diff( $start, $end );
print_r($start);echo "<br>";print_r($end);echo "<br>";
				$diff_year = $diff->y ;
				$diff_month = $diff->m ;
				$diff_day = $diff->d ;
				$diff_hours = $diff->h ;
				
				//$diff_inhours = $diff->hours ;
				
				$dteDiff  = $start->diff($end); 
				echo $dteDiff->format('%R%a days');echo "<br>";
				 print $dteDiff->format("%H:%I:%S");die;
				echo $diff_inhours;die;	
				
?>
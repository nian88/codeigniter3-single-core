<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   function getDuration($strcheckin ="Y-m-d H:i:s",$strcheckout ="Y-m-d H:i:s") {
		$checkout = new DateTime(date($strcheckout));
		$checkin = new DateTime(date($strcheckin));
		$duration = $checkout->diff($checkin);

		$dayInMinutes = $duration->d * 	24 * 60; 
		$HourInMinutes = $duration->h * 60 ; 
		$minutesInMinutes = $duration->i ; 
		print_r($dayInMinutes + $HourInMinutes + $minutesInMinutes);
   }
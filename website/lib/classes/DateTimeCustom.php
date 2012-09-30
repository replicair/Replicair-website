<?php

//class DateTimeFrench extends DateTime {
class DateTimeCustom {
    
	const LANG_FR = "FR";
	const LANG_EN = "EN";
	
	const TZ_UTC = "UTC";
	
	const FORMAT_MYSQL = "Y-m-d H:i:s";
	const FORMAT_SIMPLE = "d/m/Y";
	
	const NOW = "now";
	
	var $lang;
	var $tz;
	var $time;
	
	public function DateTimeCustom($date,$format=DateTimeCustom::FORMAT_MYSQL,$lang=DateTimeCustom::LANG_FR,$timezone=DateTimeCustom::TZ_UTC) {
		$this->lang = $lang;
		$this->tz = $timezone;
		if ($date == DateTimeCustom::NOW) {
			$this->time = strtotime($date);
		}
		else {
			//2001-03-10 17:16:18 (the MySQL DATETIME format)
			//10/03/2001 (format de l interface)
			if ($format == DateTimeCustom::FORMAT_MYSQL) {
				$this->time = mktime(substr($date, 11,2),substr($date, 14,2),substr($date, 17,2),substr($date, 5,2),substr($date, 8,2),substr($date,0,4));
			}
			else if ($format == DateTimeCustom::FORMAT_SIMPLE) {
				$this->time = mktime(0,0,0,substr($date, 3,2),substr($date, 0,2),substr($date, 6,4));
			}
		}
	}
	
	public function format($format) {
		if ($this->lang == DateTimeCustom::LANG_EN) {
			return date($format,$this->time);
		}
		elseif ($this->lang == DateTimeCustom::LANG_FR) {
        	$english = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
        	$french = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre');
        	return str_replace($english, $french, date($format,$this->time));
		}
    }
}
?>
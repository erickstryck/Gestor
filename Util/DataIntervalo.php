<?php 
class DataIntervalo{
	
	function __construct(){
		
	}


	public static function dias($date){
		return date('d/m/Y', strtotime('+1 day', strtotime(self::format($date))));
	}

	public static function semanas($date){
		return date('d/m/Y', strtotime('+1 week', strtotime(self::format($date))));
	}

	public static function quinzenas($date){
		return date('d/m/Y', strtotime('+15 days', strtotime(self::format($date))));
	}

	public static function meses($date){
		return date('d/m/Y', strtotime('+1 month', strtotime(self::format($date))));
	}

	public static function bimestres($date){
		return date('d/m/Y', strtotime('+2 months', strtotime(self::format($date))));
	}

	public static function trimestres($date){
		return date('d/m/Y', strtotime('+3 months', strtotime(self::format($date))));
	}

	public static function semestres($date){
		return date('d/m/Y', strtotime('+6 months', strtotime(self::format($date))));
	}

	public static function anos($date){
		return date('d/m/Y', strtotime('+1 year', strtotime(self::format($date))));
	}

	private static function format($date){
		$myDateTime = DateTime::createFromFormat('d-m-Y', $date);
		return $myDateTime->format('Y-m-d');
	}
	
}
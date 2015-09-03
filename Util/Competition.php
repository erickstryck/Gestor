<?php 

class Competition {
	private $isLock; 
	private static $instance; 

	function __construct(){
		$this->isLock = false; 
	}

	public function lock(){	
		if($this->isLock) var_dump($this->isLock); 	
		return $this->isLock; 
	}

	public function defineLock($arg){
		$this->isLock = (boolean) $arg; 
	}

	public static function getInstance(){
		if(self::$instance == null )
			self::$instance = new Competition(); 
		
		return self::$instance; 
	}

}
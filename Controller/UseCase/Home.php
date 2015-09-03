<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'HomeView.php'); 

class Home extends GenericController {
	private $homeView; 

	public function __construct() {
		$this->homeView = new HomeView(); 
	}

	public function indexView(){
		$this->homeView->indexView(); 
	}

}
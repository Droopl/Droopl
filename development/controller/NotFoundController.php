<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class NotFoundController extends AppController{


	public function __construct(){

	}

	public function notFound(){

		echo "PAGE NOT FOUND 404 !!";
	}


}



<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		$this->load->library('varvee'); 
		$v = new Varvee();
    $this->data["top"] = $v->getTopFive();
    $this->_render('pages/main');
	}
}


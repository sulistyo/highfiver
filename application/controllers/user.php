<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	}

	public function detail()
	{
    $this->load->library('varvee');
    $v = new Varvee();
		$playerId = $this->uri->segment(3);
		$playerInfo = $v->getPlayerInfo($playerId);
		$this->data["player"] = $playerInfo;
		$this->_render('pages/detail');
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */

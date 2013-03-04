<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	public function index()
	{
		$this->load->library('unit_test');
		$this->load->library('varvee'); 
		$v = new Varvee();
			
		//*******************************************************
		//*Test case A1
		//*Leaderboard - Normal case 
		//*******************************************************
		$v->url_leaderboard = 'http://edy.li/vnn-test/a1.html';
		$test_name = '[Leaderboard] Normal';
		$this->unit->run($v->getTopFive(), 'is_array', $test_name);


		//*******************************************************
		//*Test case A2
		//*Leaderboard - HTML structure has changed
		//*******************************************************
		$v->url_leaderboard = 'http://edy.li/vnn-test/a2.html';
		$test_name = '[Leaderboard] HTML structure has changed';
		$result = 0;
		$this->unit->run($v->getTopFive(), $result, $test_name);


		//*******************************************************
		//*Test case A3
		//*Leaderboard - Column structure has changed
		//*******************************************************
		$v->url_leaderboard = 'http://edy.li/vnn-test/a3.html';
		$test_name = '[Leaderboard] Column structure is changed';
		$result = 0;
		$this->unit->run($v->getTopFive(), $result, $test_name);


		//*******************************************************
		//*Test case A4
		//*Leaderboard - only fewer than 5 <tr> is returned
		//*******************************************************
		$v->url_leaderboard = 'http://edy.li/vnn-test/a4.html';
		$test_name = '[Leaderboard] Result is less than 5 rows';
		$this->unit->run($v->getTopFive(), 'is_array', $test_name);


		//*******************************************************
		//*Test case 5
		//*Leaderboard - error 404
		//*******************************************************
		$v->url_leaderboard = 'http://edy.li/vnn-test/a5.html';
		$test_name = '[Leaderboard] URL has changed or page cannot be displayed';
		$result = 0;
		$this->unit->run($v->getTopFive(), $result, $test_name);




		//*******************************************************
		//*Test case B1
		//*PlayerInfo - Normal case 
		//*******************************************************
		$v->url_player = 'http://edy.li/vnn-test/b1.html';
		$test_name = '[PlayerInfo] Normal';
		$this->unit->run($v->getPlayerInfo(), 'is_array', $test_name);


		//*******************************************************
		//*Test case 2
		//*PlayerInfo - HTML structure has changed
		//*******************************************************
		$v->url_player = 'http://edy.li/vnn-test/b2.html';
		$test_name = '[PlayerInfo] HTML structure has changed';
		$result = 0;
		$this->unit->run($v->getPlayerInfo(), $result, $test_name);


		//*******************************************************
		//*Test case 3
		//*PlayerInfo - Column structure has changed
		//*******************************************************
		$v->url_player = 'http://edy.li/vnn-test/b3.html';
		$test_name = '[PlayerInfo] Column structure is changed';
		$result = 0;
		$this->unit->run($v->getPlayerInfo(), $result, $test_name);


		//*******************************************************
		//*Test case 4
		//*PlayerInfo - only fewer than 5 <tr> is returned
		//*******************************************************
		$v->url_player = 'http://edy.li/vnn-test/b4.html';
		$test_name = '[PlayerInfo] Result is less than 5 rows';
		$this->unit->run($v->getPlayerInfo(), 'is_array', $test_name);


		//*******************************************************
		//*Test case 5
		//*PlayerInfo - error 404
		//*******************************************************
		$v->url_player = 'http://edy.li/vnn-test/b5.html';
		$test_name = '[PlayerInfo] URL has changed or page cannot be displayed';
		$result = 0;
		$this->unit->run($v->getPlayerInfo(), $result, $test_name);


		$this->data["result"] = $this->unit->report();
    $this->_render('pages/test');

	}
}


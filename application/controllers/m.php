<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		$this->load->helper('dom'); 
		$html = file_get_html('http://www.varvee.com/team/individual_leaderboard/54/27/');
		$count = 0;
		$prevScore = 0;
		$rank = 0;
		foreach($html->find('tr[class]') as $e)
		{
			$rawData = $e->children(3)->children(0);
			$score = $e->children(6)->plaintext;
			if ($count > 5 || ($count == 5  && $score < $prevScore && $prevScore > 0)) break;
			if ($prevScore != $score) $rank++;
			$id = array_pop(explode('/', $rawData->href));
			$name = $rawData->innertext;
			$data[] = array('name' => $name, 'id' =>$id, 'rank' => $rank);
			$count++;
			$prevScore = $score;
		}
    $this->data["top"] = $data;
    $this->_render('pages/main');
	}
}


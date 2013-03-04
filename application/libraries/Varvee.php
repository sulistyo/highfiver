<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Varvee {
		private $api;
		var $sportId;
		var $url_leaderboard;
		var $url_player;

		public function __construct(){
			  $this->api = & get_instance();
	    	$this->api->load->helper('dom');

				//for men basketball
				$this->sportId = '27';
				$this->url_leaderboard = 'http://www.varvee.com/team/individual_leaderboard/54/'.$this->sportId;
			  $this->url_player = 'http://www.varvee.com/team/player/'.$this->sportId;

		}   
    public function getTopFive()
    {
				//define the end-point url
  	  	$html = file_get_html($this->url_leaderboard);

				foreach($html->find('h1') as $h)
				{
						if ($h->plaintext == 'Oops...'){
								return 0;
						}
				}

				$count = 0;
		    $prevScore = 0;
		    $rank = 0;
			
				//only parse all <tr> that has class attribute to speed things up
		    foreach($html->find('tr[class]') as $e)
		    {
			      $rawData = $e->children(3)->children(0);
						if(!isset($rawData->href)){
								return 0;
						}else{
					      $score = $e->children(6)->plaintext;

								//only take the top 5 on the rank. If the score is tied, both will be displayed
					      if ($count > 5 || ($count == 5  && $score < $prevScore && $prevScore > 0)) break;
			  		    if ($prevScore != $score) $rank++;

								//only take the player id (last string in the url)
					      $id = array_pop(explode('/', $rawData->href));

					      $name = $rawData->innertext;
    		  			$data[] = array('name' => $name, 'id' =>$id, 'rank' => $rank);
			  		    $count++;
					      $prevScore = $score;
						}
			    }
					if (isset($data)){
							return $data;
					}else{
							return 0;
					}
	    }
			public function getPlayerInfo($playerId = null)
			{
					if($playerId != ""){
							$this->url_player .= '/'.$playerId;
					}
	  	  	$html = file_get_html($this->url_player);
					foreach($html->find('h1') as $h)
					{
							if ($h->plaintext == 'Oops...'){
									return 0;
							}
					}
			    $name = $html->find('div.profile-name',0)->plaintext;
			    $club = $html->find('div.detail',0)->plaintext;
			    $city = $html->find('div.detail',1)->plaintext;

					//only parse all <tr> that has class attribute to speed things up
			    foreach($html->find('tr[class]') as $e)
			    {
							//remove all characters other than alphanumeric and space, then trim the white space
				      $opponent = trim(preg_replace("/[^a-zA-Z ]/", "", $e->children(1)->plaintext));

							//W or L?
				      $status = substr($e->children(2)->plaintext,0,1);

							//If status is not either W or L, then the column structure has changed
							if (strtoupper($status) != "W" && strtoupper($status) != "L"){
									return 0;
							}

				      $score = explode("-",substr($e->children(2)->plaintext,1));

							//check if the team L, take the score on the right
				      $team_score = (strtoupper($status) == "L"?$score[1]:$score[0]);
				      $player_score = $e->children(3)->plaintext;
				      $data[] = array(
                  "opponent" => $opponent,
                  "status" => $status,
                  "team_score" => $team_score,
                  "player_score" => $player_score
              );
			    }
					//if data is not set, that means the html structure has changed
					if (isset($data)){
					    $player = array (
                "name" => $name,
                "club" => $club,
                "city" => $city,
                "data" => $data
    		      );
							return $player;
					}else{
							return 0;
					}
			}

}

/* End of file Varvee.php */

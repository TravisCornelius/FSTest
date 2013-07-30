<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$params['apikey'] = 'AI39si6z4YQFzj2Q1VhuJtcLeu-XzSc888Y1PArnSS4fUnPpE_4Oodjyi0KmewQPT-YO296g3hEMYNqnQ44alQVOFQ49i_2JQQ';	
		$this->load->library('youtube', $params);
		
		/**
	     * You could add extra params if neccessary
	     *
	     * @param array $params additional parameters to pass to youtube see: http://code.google.com/apis/youtube/2.0/reference.html#Query_parameter_definitions
	     * @return the xml response from youtube.
	     */
		$ytParams = array(
			'start-index'=>1, 
			'max-results'=>4);
		
		$playlist = 'PL07B32D2A9CDF22DE';
	
		$xmlstring = $this->youtube->getPlaylistFeed($playlist, $ytParams);
		$xml = simplexml_load_string($xmlstring);
		
		
		
		$d = "<div class=\"video\" style=\"float: right;\">";
		$d .=  "<table>
                <tr>
                    <td style=\"padding-top: 10px; padding-left: 5px;\">
                        <img src=\" ";

		$d .= base_url('img/tv1.png'); 
		
		$d .= " \" alt=\"\">
                    </td>
                    <td>
                        <a>RELATED VIDEOS</a>
                    </td>
                </tr>
            </table>";
			
		$i = 1;	
		foreach($xml->entry as $entry){
			foreach($entry->link as $link){
				if($link['rel']=="alternate"){
					$d .= "<div class = \"back" . $i ."\">";
					$d .= "<p><a href=\"". $link['href'] . "\">" . $entry->title . "</a>";
					$d .= "<img src= \"".  base_url('img/tv2.png') . "\">";
					$d .= "</p>";
					$d .= "</div>";
					$i++;
				}
			}
		}
		$d .= "</div>";
		
		$data['main_content' ] = 'home';
		$data['youtubeVideos'] = $d;
		$this->load->view('includes/template', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
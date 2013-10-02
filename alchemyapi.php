<?php

class AlchemyAPI {
	
	private $_API_KEY;
	private $_ENDPOINTS;
    private $_BASE_URL = 'http://access.alchemyapi.com/calls';

	public function AlchemyAPI() {
		$this->_API_KEY = '535876947cb79d604223995e48126b9e9dd58c5c';
		$this->_ENDPOINTS['sentiment']['url'] = '/url/URLGetTextSentiment';
		$this->_ENDPOINTS['sentiment']['text'] = '/text/TextGetTextSentiment';
		$this->_ENDPOINTS['sentiment']['html'] = '/html/HTMLGetTextSentiment';
		$this->_ENDPOINTS['sentiment_targeted']['url'] = '/url/URLGetTargetedSentiment';
		$this->_ENDPOINTS['sentiment_targeted']['text'] = '/text/TextGetTargetedSentiment';
		$this->_ENDPOINTS['sentiment_targeted']['html'] = '/html/HTMLGetTargetedSentiment';
		$this->_ENDPOINTS['author']['url'] = '/url/URLGetAuthor';
		$this->_ENDPOINTS['author']['html'] = '/html/HTMLGetAuthor';
		$this->_ENDPOINTS['keywords']['url'] = '/url/URLGetRankedKeywords';
		$this->_ENDPOINTS['keywords']['text'] = '/text/TextGetRankedKeywords';
		$this->_ENDPOINTS['keywords']['html'] = '/html/HTMLGetRankedKeywords';
		$this->_ENDPOINTS['concepts']['url'] = '/url/URLGetRankedConcepts';
		$this->_ENDPOINTS['concepts']['text'] = '/text/TextGetRankedConcepts';
		$this->_ENDPOINTS['concepts']['html'] = '/html/HTMLGetRankedConcepts';
		$this->_ENDPOINTS['entities']['url'] = '/url/URLGetRankedNamedEntities';
		$this->_ENDPOINTS['entities']['text'] = '/text/TextGetRankedNamedEntities';
		$this->_ENDPOINTS['entities']['html'] = '/html/HTMLGetRankedNamedEntities';
		$this->_ENDPOINTS['category']['url']  = '/url/URLGetCategory';
		$this->_ENDPOINTS['category']['text'] = '/text/TextGetCategory';
		$this->_ENDPOINTS['category']['html'] = '/html/HTMLGetCategory';
		$this->_ENDPOINTS['relations']['url']  = '/url/URLGetRelations';
		$this->_ENDPOINTS['relations']['text'] = '/text/TextGetRelations';
		$this->_ENDPOINTS['relations']['html'] = '/html/HTMLGetRelations';
		$this->_ENDPOINTS['language']['url']  = '/url/URLGetLanguage';
		$this->_ENDPOINTS['language']['text'] = '/text/TextGetLanguage';
		$this->_ENDPOINTS['language']['html'] = '/html/HTMLGetLanguage';
		$this->_ENDPOINTS['text_clean']['url']  = '/url/URLGetText';
		$this->_ENDPOINTS['text_clean']['html'] = '/html/HTMLGetText';
		$this->_ENDPOINTS['text_raw']['url']  = '/url/URLGetRawText';
		$this->_ENDPOINTS['text_raw']['html'] = '/html/HTMLGetRawText';
		$this->_ENDPOINTS['text_title']['url']  = '/url/URLGetTitle';
		$this->_ENDPOINTS['text_title']['html'] = '/html/HTMLGetTitle';
		$this->_ENDPOINTS['feeds']['url']  = '/url/URLGetFeedLinks';
		$this->_ENDPOINTS['feeds']['html'] = '/html/HTMLGetFeedLinks';
		$this->_ENDPOINTS['microformats']['url']  = '/url/URLGetMicroformatData';
		$this->_ENDPOINTS['microformats']['html'] = '/html/HTMLGetMicroformatData';
	}

	public function entities($flavor, $data, $options) {
		if (!array_key_exists($flavor, $this->_ENDPOINTS['entities'])) {
			return array('status'=>'ERROR','statusInfo'=>'Entity extration for ' . $flavor . ' not available');
		}

		$url = $this->_BASE_URL .
				$this->_ENDPOINTS['entities'][$flavor] . 
				'?apikey=' . $this->_API_KEY .
				'&' . $flavor . '=' . rawurlencode($data) .
				'&outputMode=json';
		
		foreach($options as $key => $value) {
			$url = $url . '&' . $key . '=' . $value;
		}
					
		return $this->analyze($url);
	}


	private function analyze($url) {
		$params = array('http' => array('method' => 'GET',
								'Content-type'=> 'application/x-www-form-urlencoded'));
		
		$fp = @fopen($url, 'rb',false, stream_context_create($params));
		$response = @stream_get_contents($fp);
		fclose($fp);
		return json_decode($response, true);
	}
}

?>


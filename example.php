<?php	
	require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();
	


	$demo_text = 'Yesterday dumb Bob destroyed my fancy iPhone in beautiful Denver, Colorado. I guess I will have to head over to the Apple Store and buy a new one.';
	$demo_url = 'http://blog.programmableweb.com/2011/09/16/new-api-billionaire-text-extractor-alchemy/';
	$demo_html = '<html><head><title>Python Demo | AlchemyAPI</title></head><body><h1>Did you know that AlchemyAPI works on HTML?</h1><p>Well, you do now.</p></body></html>';


	echo PHP_EOL;
	echo PHP_EOL;
	echo '############################################', PHP_EOL;
	echo '#   Entity Extraction Example              #', PHP_EOL;
	echo '############################################', PHP_EOL;
	echo PHP_EOL;
	echo PHP_EOL;
	
	echo 'Processing text: ', $demo_text, PHP_EOL;
	echo PHP_EOL;

	$response = $alchemyapi->entities('text',$demo_text, array('sentiment'=>1));

	if ($response['status'] == 'OK') {
		echo '## Response Object ##', PHP_EOL;
		echo print_r($response);

		echo PHP_EOL;
		echo '## Entities ##', PHP_EOL;
		foreach ($response['entities'] as $entity) {
			echo 'text: ', $entity['text'], PHP_EOL;
			echo 'type: ', $entity['type'], PHP_EOL;
			echo 'relevance: ', $entity['relevance'], PHP_EOL;
			echo 'sentiment: ', $entity['sentiment']['type'], PHP_EOL;
			echo PHP_EOL;
		}
	} else {
		echo 'Error in the entity extraction call: ', $response['statusInfo'];
	}


?>

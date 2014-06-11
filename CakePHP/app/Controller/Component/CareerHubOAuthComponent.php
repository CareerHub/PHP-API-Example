<?php

App::uses('Component', 'Controller');

class CareerHubOAuthComponent extends Component {
    public function initialize(Controller $controller) {
    	$this->controller = $controller;
    }

    public function getAccessToken($type) {
    	$access_token = $this->controller->Session->read($type . '_access_token');

    	if(empty($access_token)) {
    		$this->redirectToSecure($type);
    	}

    	return $access_token;
   	}

   	public function redirectToSecure($type) {
   		$current = '/' . $this->controller->request->url;

   		$this->controller->Session->write('return_url', $current);

   		$this->controller->redirect(
      		array('controller' => 'secure', 'action' => 'index', $type => true)
  		);
   	}
}
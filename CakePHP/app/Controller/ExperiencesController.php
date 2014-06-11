<?php

App::uses('AppController', 'Controller');
App::uses('CareerHubOAuth', 'Controller/Component');

App::import('Vendor', 'RestClient');

class ExperiencesController extends AppController {
	public $components = array('CareerHubOAuth');
	public $helpers = array('Html', 'Form');

	public function error() {
		$data = $this->Session->read('error_request');
		$result = $this->Session->read('error_result');
		
		$this->set('data', $data);
		$this->set('result', $result);
	}

	public function students_index() {
		$api = $this->getRestClient('/api/jobseeker/v1/', 'students');

		$result = $api->get('/experiences');

		$this->set('result', $result);

		$this->ensureSuccess($result, 'students');

		$this->render('index');
	}

	public function students_detail($id) {
		$api = $this->getRestClient('/api/jobseeker/v1/experiences', 'students');

		$result = $api->get($id);

		$this->set('result', $result);

		$this->ensureSuccess($result, 'students');
	}

	public function trusted_index() {
		
	}

	public function trusted_student() {
		$studentId = $this->request->query['studentId'];

		$api = $this->getRestClient('/api/trusted/v1/experiences/', 'trusted');

		$result = $api->get($studentId);
		$this->set('result', $result);

		$this->ensureSuccess($result, 'trusted');

		$this->render('index');
	}

	public function trusted_detail($id) {
		$studentId = $this->request->query['studentId'];

		$api = $this->getRestClient('/api/trusted/v1/experiences/', 'trusted');

		$result = $api->get($studentId . '/' . $id);

		$this->set('result', $result);

		$this->ensureSuccess($result, 'trusted');

		$this->render('detail');
	}

	public function trusted_add() {
	}

	public function trusted_edit($id) {
		$studentId = $this->request->query['studentId'];
		$api = $this->getRestClient('/api/trusted/v1/experiences/', 'trusted');

		if ($this->request->is(array('post', 'put'))) {

			// save post
			$data = $this->request->data;

			$result = $api->put($studentId . '/' . $id, $data);
			$this->ensureSuccess($result, 'trusted');

	    } else {
			$result = $api->get($studentId . '/' . $id);
			$this->ensureSuccess($result, 'trusted');

	        $this->request->data = $result->decode_response();
	    }

        $this->render('form');
	}

	private function ensureSuccess($result, $type) {
		$code = $result->info->http_code;

		if($code == 403) {
			$this->CareerHubOAuth->redirectToSecure($type);
		} else if($code != 200) {
			$this->Session->write('error_request', $this->request->data);
			$this->Session->write('error_result', $result);
			$this->redirect(array('action' => 'error', $this->request->prefix => false));
		}

		return $code == 200;
	}

	private function getRestClient($resource, $type) {
		$access_token = $this->CareerHubOAuth->getAccessToken($type);

		$api = new RestClient(array(
	    	'base_url' => 'http://localhost/careerhub/' . $resource,
	    	'format', 'json',
	    	'headers' => array('Authorization' => 'Bearer ' . $access_token)
	    ));

		$api->register_decoder('json', create_function('$a', "return json_decode(\$a, TRUE);"));

		return $api;
	}
}

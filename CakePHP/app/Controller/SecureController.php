<?php

App::import('Vendor', 'ohmy/Auth2');
App::import('Vendor', 'ohmy/Auth/Promise');
App::import('Vendor', 'ohmy/Auth/Flow');
App::import('Vendor', 'ohmy/Auth2/Auth2Flow');
App::import('Vendor', 'ohmy/Auth2/Flow/ThreeLegged');
App::import('Vendor', 'ohmy/Auth2/Flow/ThreeLegged/Authorize');
App::import('Vendor', 'ohmy/Auth2/Flow/ThreeLegged/Access');
App::import('Vendor', 'ohmy/Components/Http');
App::import('Vendor', 'ohmy/Components/Http/Curl/Request');
App::import('Vendor', 'ohmy/Components/Http/Curl/Response');


App::import('Vendor', 'RestClient');

App::uses('OAuthConfig', 'Model');

App::uses('AppController', 'Controller');

use ohmy\Auth2;

class SecureController extends AppController {

  public function public_index() {

  }

  public function trusted_index() {
    $config = $this->getConfig();

    // Send as 
    $api = new RestClient(array(
      'base_url' => $config->tokenEndpoint,
      'format', 'json'
    ));

    $result = $api->post('/', array(
      'grant_type' => 'client_credentials',
      'client_id' => $config->clientKey,
      'client_secret' => $config->clientSecret,
      'scope' => 'Trusted.Experiences'
    ));
              
    $this->Session->write('trusted_access_token', $result['access_token']);

    //$this->set('result', $result);
    $this->redirectToReturnUrl();
  }

  public function students_index() {
    // using https://github.com/sudocode/ohmy-auth

      $config = $this->getConfig();
      $oauth = Auth2::legs(3)
          
          ->set(array(
              'id'       => $config->clientKey,
              'secret'   => $config->clientSecret,
              'redirect' => 'http://localhost:8282/php-api-example/students/secure',
              'scope' => 'JobSeeker.Profile'
          ))
          
          ->authorize($config->authEndpoint)
          ->access($config->tokenEndpoint)
          ->finally(function($data) use(&$access_token) {
              $access_token = $data['access_token'];
              $this->Session->write('students_access_token', $access_token);
              redirectToReturnUrl();
          });
  }

  private function redirectToReturnUrl() {
      $returnUrl = $this->Session->read('return_url');

      if (!empty($returnUrl)) {
        $this->redirect($returnUrl);
      } else {
        $this->redirect('/');
      }
  }

  private function getConfig() {
      return new OAuthConfig('api.demo.php', 'abcdefghijklmnop', 'http://localhost/careerhub/oauth/auth', 'http://localhost/careerhub/oauth/token');
  }
}
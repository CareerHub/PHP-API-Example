<?php

class OAuthConfig {
	public $clientKey = null;
	public $clientSecret = null;

	public $authEndpoint = null;
	public $tokenEndpoint = null;

    public function __construct($clientKey, $clientSecret, $authEndpoint, $tokenEndpoint) {
        $this->clientKey = $clientKey;
        $this->clientSecret = $clientSecret;
        $this->authEndpoint = $authEndpoint;
        $this->tokenEndpoint = $tokenEndpoint;
    }

	public function getAuthRedirect($requestToken) {
		return $authEndpoint . '?code=' . $requestToken;
	}
}
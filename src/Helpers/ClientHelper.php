<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Helpers;

use GuzzleHttp\Client;
use kamermans\OAuth2\GrantType\PasswordCredentials;
use kamermans\OAuth2\OAuth2Middleware;
use GuzzleHttp\HandlerStack;
use MaillotF\Pcvue\PcvueBridgeBundle\Utils\CustomTokenPersistence;
use MaillotF\Pcvue\PcvueBridgeBundle\Exception\PcVueException;

/**
 * Description of ClientHelper
 *
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class ClientHelper
{

	/**
	 * Construct and return OAuth2 Client
	 * 
	 * @param \MaillotF\Pcvue\PcvueBridgeBundle\Manager\Config $config
	 * @param bool $verifySSL
	 * @param bool $strict
	 * @return Client|null
	 * @throws PcVueException
	 * @author Flavien Maillot 
	 */
	public static function constructAndGetOAuthClient(\MaillotF\Pcvue\PcvueBridgeBundle\Manager\Config $config, bool $verifySSL = false, bool $strict = false): ?Client
	{
		$OAuthURL = $config->getBaseURL() . '/OAuth/token';

		// Authorization client - this is used to request OAuth access tokens
		$reauth_client = new Client([
			// URL for access_token request
			'base_uri' => $OAuthURL,
			'verify' => false
		]);

		$token_persistence = new CustomTokenPersistence($config->getTmpDir(), $config->getScope());

		// This grant type is used to get a new Access Token and Refresh Token when
		//  no valid Access Token or Refresh Token is available
		$grant_type = new PasswordCredentials($reauth_client, $config->getReauthConfig());

		// This grant type is used to get a new Access Token and Refresh Token when
		//  only a valid Refresh Token is available
		$refresh_grant_type = new \kamermans\OAuth2\GrantType\RefreshToken($reauth_client, $config->getReauthConfig());

		$oAuth2Middleware = new OAuth2Middleware($grant_type, $refresh_grant_type);
		$oAuth2Middleware->setTokenPersistence($token_persistence);

		$stack = HandlerStack::create();
		$stack->push($oAuth2Middleware);

		try
		{
			$client = new Client([
				'handler' => $stack,
				'auth' => 'oauth',
				'verify' => $verifySSL
			]);
			return ($client);
		} catch (ClientException $e)
		{
			if ($strict == true)
				throw new PcVueException($e->getMessage());
		}
		return null;
	}

}

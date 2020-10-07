<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Utils;

use kamermans\OAuth2\Persistence\TokenPersistenceInterface;
use kamermans\OAuth2\Token\TokenInterface;

/**
 * Description of CustomTokenPersistence
 *
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class CustomTokenPersistence implements TokenPersistenceInterface
{

	/**
	 *
	 * @var string 
	 */
	private $file = '';

	public function __construct(string $tmp_dir, string $scope = 'RealtimeData')
	{
		$this->file = $tmp_dir . 'token' . $scope . '.json';
	}

	/**
	 * Save the token in the file
	 * 
	 * @param TokenInterface $token
	 * @return void
	 * @author Flavien Maillot 
	 */
	public function saveToken(TokenInterface $token): void
	{
		$value = $token->serialize();
		file_put_contents($this->file, json_encode($value));
	}

	/**
	 * Restore the token from the file
	 * 
	 * @param TokenInterface $token
	 * @return array|null
	 * @author Flavien Maillot 
	 */
	public function restoreToken(TokenInterface $token)
	{
		$value = @file_get_contents($this->file);
		$value = $value === false ? null : $token->unserialize(json_decode($value, true));
		return $value;
	}

	/**
	 * Delete the token
	 * 
	 * @return void
	 */
	public function deleteToken(): void
	{
		@unlink($this->file);
	}

	/**
	 * 
	 * @return bool
	 */
	public function hasToken(): bool
	{
		return (true);
	}
}

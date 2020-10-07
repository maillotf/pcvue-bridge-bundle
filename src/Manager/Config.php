<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Manager;

/**
 * Description of Config
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Manager
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Config implements ConfigInterface
{
	
	private $protocol;
	
	private $host;
	
	private $port;
	
	private $client_id;
	
	private $client_secret;
	
	private $username;
	
	private $password;
	
	private $scope = null;
	
	private $tmp_dir;
	
	private $tokens_path;
	
	private $tokens;

	public function __construct(
			string $protocol,
			string $host,
			string $port,
			string $client_id,
			string $client_secret,
			string $username,
			string $password,
			string $root_dir
			)
	{
		$this->setProtocol($protocol)
				->setHost($host)
				->setPort($port)
				->setClientId($client_id)
				->setClientSecret($client_secret)
				->setUsername($username)
				->setPassword($password)
				->setTmpDir($root_dir)
				->setTokensPath($root_dir . 'token.json')
				;
		
		//Initialisation du fichier JSession
		if (!file_exists(dirname($this->getTokensPath()))) 
			mkdir(dirname($this->getTokensPath()), 0700, true);

		//Token pour le realtime
		if (!isset($this->getTokens()['RealtimeData']))
			$this->setToken(array('accessToken' => null, 'refreshToken' => null, 'expiresAt' => 1), 'RealtimeData');
		
		//Token pour le realtime
		if (!isset($this->getTokens()['HistoricalData']))
			$this->setToken(array('accessToken' => null, 'refreshToken' => null, 'expiresAt' => 1), 'HistoricalData');
	}

	/**
	 * 
	 * @param string $protocol
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setProtocol(string $protocol): ConfigInterface
	{
		$this->protocol = $protocol;
		return ($this);
	}
	
	/**
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getProtocol(): string
	{
		return ($this->protocol);
	}
	
	/**
	 * 
	 * @param string $host
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setHost(string $host): ConfigInterface
	{
		$this->host = $host;
		return ($this);
	}
	
	/**
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getHost(): string
	{
		return ($this->host);
	}
	
	/**
	 * 
	 * @param int $port
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setPort(int $port): ConfigInterface
	{
		$this->port = $port;
		return ($this);
	}
	
	/**
	 * 
	 * @return int
	 * @author Flavien Maillot 
	 */
	public function getPort():int
	{
		return $this->port;
	}
	
	/**
	 * 
	 * @param string $client_id
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setClientId(string $client_id): ConfigInterface
	{
		$this->client_id = $client_id;
		return ($this);
	}
	
	/**
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getClientId():string
	{
		return $this->client_id;
	}
	
	/**
	 * Define the client secret
	 * 
	 * @param string $client_secret
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setClientSecret(string $client_secret): ConfigInterface
	{
		$this->client_secret = $client_secret;
		return ($this);
	}
	
	/**
	 * Get the client secret
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getClientSecret():string
	{
		return $this->client_secret;
	}
	
	/**
	 * Define username
	 * 
	 * @param string $username
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setUsername(string $username): ConfigInterface
	{
		$this->username = $username;
		return ($this);
	}
	
	/**
	 * Get username
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getUsername():string
	{
		return $this->username;
	}
	
	/**
	 * Define password
	 * 
	 * @param string $password
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setPassword(string $password): ConfigInterface
	{
		$this->password = $password;
		return ($this);
	}
	
	/**
	 * Get password
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getPassword():string
	{
		return $this->password;
	}
	
	/**
	 * Define scope
	 * 
	 * @param string $scope
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setScope(string $scope): ConfigInterface
	{
		$this->scope = $scope;
		return ($this);
	}
	
	/**
	 * Get scope
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getScope():string
	{
		return $this->scope;
	}
	
	/**
	 * Define tmp dir
	 * 
	 * @param string $tmp_dir
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setTmpDir(string $tmp_dir): ConfigInterface
	{
		$this->tmp_dir = $tmp_dir;
		return ($this);
	}
	
	/**
	 * Get the tmp dir
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getTmpDir():string
	{
		return $this->tmp_dir;
	}
	
	/**
	 * 
	 * @param string $path
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 */
	public function setTokensPath(string $path): ConfigInterface
	{
		$this->tokens_path = $path;
		return ($this);
	}
	
	/**
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getTokensPath(): string
	{
		return ($this->tokens_path);
	}
	
	/**
	 * 
	 * @param array $tokens
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setTokens(array $tokens): ConfigInterface
	{
		$this->tokens = $tokens;
		return ($this);
	}
	
	/**
	 * 
	 * @return array|null
	 * @author Flavien Maillot 
	 */
	public function getTokens(): ?array
	{
		if (file_exists($this->getTokensPath())) 
		{
			$this->tokens = json_decode(file_get_contents($this->getTokensPath()), true);
			if (is_array($this->tokens))
				return ($this->tokens);
			else
				return (array());
		}
		return (null);
	}
	
	/**
	 * 
	 * @param array $token
	 * @param string $scope
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function setToken(array $token, string $scope): ConfigInterface
	{
		$jtoken = array($scope => $token);
		if (($tokens = $this->getTokens()) == null)
			$tokens = array();
		$datas = array_merge($tokens, $jtoken);
		file_put_contents($this->getTokensPath(), json_encode($datas));
		return ($this);
	}
	
	/**
	 * 
	 * @return string|null
	 * @author Flavien Maillot 
	 */
	public function getToken(): ?string
	{
		if (($tokens = $this->getTokens()) != null)
		{
			return ($tokens[$this->getScope()]);
		}
		return (null);
	}
	
	/**
	 * 
	 * @param string $token
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function updateToken(string $token): ConfigInterface
	{
		$scope = $this->getScope();
		$jtoken = array($scope => $token);
		$tokens = $this->getTokens();
		$datas = array_merge($tokens, $jtoken);
		file_put_contents($this->getTokensPath(), json_encode($datas));
		return ($this);
	}
	
	/**
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getBaseURL(): string
	{
		return $this->getProtocol() . '://' . $this->getHost() . ':' . $this->getPort();
	}
	
	/**
	 * 
	 * @param string|null $refresh_token
	 * @return array
	 * @author Flavien Maillot 
	 */
	public function getReauthConfig(?string $refresh_token = null): array
	{
		$reauth_config = array(
			"client_id" => $this->getClientId(),
			"client_secret" => $this->getClientSecret(),
			"scope" => $this->getScope(),
			"state" => time(), // optional
			"username" => $this->getUsername(),
			"password" => $this->getPassword(),
		);
		
		if ($refresh_token != null)
			$reauth_config['refresh_token'] = $refresh_token;
		
		return $reauth_config;
	}
}

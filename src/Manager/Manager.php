<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Manager;

use GuzzleHttp\Client;
use MaillotF\Pcvue\PcvueBridgeBundle\Exception\PcVueException;

/**
 * Description of ClientManager
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\Manager
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Manager implements ManagerInterface
{
	/**
	 *
	 * @var ConfigInterface 
	 */
	private $config = null;
	
	/**
	 *
	 * @var Client
	 */
	private $client = null;
	
	/**
	 *
	 * @var string
	 */
	private $reasonPhrase = '';

	/**
	 *
	 * @var int
	 */
	private $statusCode = 200;
	
	/**
	 *
	 * @var array
	 */
	private $responseHeaders = array();
	
	/**
	 *
	 * @var 
	 */
	private $response = '';
	
	public function __construct(
			ConfigInterface $config
			)
	{
		$this->config = $config;
	}
	
	/**
	 * 
	 * @param \Psr\Http\Client\ClientInterface $client
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @author Flavien Maillot 
	 */
	public function setClient(\GuzzleHttp\ClientInterface $client): ManagerInterface
	{
		$this->client = $client;
		return ($this);
	}
	
	/**
	 * 
	 * @return \Psr\Http\Client\ClientInterface|null
	 * @author Flavien Maillot 
	 */
	public function getClient(): ?\Psr\Http\Client\ClientInterface
	{
		return ($this->client);
	}
	
	/**
	 * 
	 * @param string $scope
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @author Flavien Maillot 
	 */
	public function setScope(string $scope): ManagerInterface
	{
		$this->config->setScope($scope);
		return ($this);
	}
	
	/**
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getScope(): string
	{
		return ($this->config->getScope());
	}
	
	/**
	 * 
	 * @param \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface $config
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @author Flavien Maillot 
	 */
	public function setConfig(ConfigInterface $config): ManagerInterface
	{
		$this->config = $config;
		return ($this);
	}

	/**
	 * 
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ConfigInterface
	 * @author Flavien Maillot 
	 */
	public function getConfig(): ConfigInterface
	{
		return ($this->config);
	}
	
	/**
	 * Use get method and prepare response
	 * 
	 * @param string $path
	 * @param bool $strict
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @throws PcVueException
	 * @author Flavien Maillot 
	 */
	public function get(string $path, bool $strict = true): ManagerInterface
	{
		if ($this->client == null)
			throw PcVueException('Client undefined');
		$url = $this->config->getBaseURL() . '/' . $path;
		try
		{
			/* @var $response Psr7\Response */
			$response = $this->client->get($url);
			
			$this->setStatusCode($response->getStatusCode());
			$this->setReasonPhrase($response->getReasonPhrase());
			$this->setResponseHeader($response->getHeaders());
			
			$this->setResponse($response->getBody()->getContents());
			return ($this);
		} 
		catch (\kamermans\OAuth2\Exception\AccessTokenRequestException $e)
		{
			$message = $e->getMessage();
		}
		catch (\GuzzleHttp\Exception\ServerException $e)
		{
			$message = $e->getMessage();
		}
		catch (\GuzzleHttp\Exception\ClientException $e)
		{
			$message = $e->getMessage();
		}
		if ($strict == true)
			throw new PcVueException($message);
		else
			return ($this);
	}

	/**
	 * Use get method and prepare response
	 * 
	 * @param string $path
	 * @param type $datas
	 * @param bool $strict
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @throws PcVueException
	 * @author Flavien Maillot 
	 */
	public function post(string $path, $datas, bool $strict = true): ManagerInterface
	{
		if ($this->client == null)
			throw PcVueException('Client undefined');
		$url = $this->config->getBaseURL() . '/' . $path;
		$message = null;
		try
		{
			/* @var $response Psr7\Response */
			$response = $this->client->post($url, array(
				'body' => json_encode($datas),
				'headers' => array('content-type' => 'application/json')
				));
			
			$this->setStatusCode($response->getStatusCode());
			$this->setReasonPhrase($response->getReasonPhrase());
			$this->setResponseHeader($response->getHeaders());
			
			$this->setResponse($response->getBody()->getContents());
			return ($this);
		} 
		catch (\kamermans\OAuth2\Exception\AccessTokenRequestException $e)
		{
			$message = $e->getMessage();
		}
		catch (\GuzzleHttp\Exception\ServerException $e)
		{
			$message = $e->getMessage();
		}
		catch (\GuzzleHttp\Exception\ClientException $e)
		{
			$message = $e->getMessage();
		}
		if ($strict == true)
			throw new PcVueException($message);
		else
			return ($this);
	}
	
	/**
	 * Define the reason phrase
	 * 
	 * @param string $reasonPhrase
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @author Flavien Maillot 
	 */
	private function setReasonPhrase(string $reasonPhrase): ManagerInterface
	{
		$this->reasonPhrase = $reasonPhrase;
		return ($this);
	}
	
	/**
	 * 
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getReasonPhrase(): string
	{
		return ($this->reasonPhrase);
	}
	
	/**
	 * 
	 * @param int $statusCode
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @author Flavien Maillot 
	 */
	private function setStatusCode(int $statusCode): ManagerInterface
	{
		$this->statusCode = $statusCode;
		return ($this);
	}
	
	/**
	 * 
	 * @return int
	 * @author Flavien Maillot 
	 */
	public function getStatusCode(): int
	{
		return ($this->statusCode);
	}
	
	/**
	 * 
	 * @param type $responseHeaders
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 * @author Flavien Maillot 
	 */
	private function setResponseHeader($responseHeaders): ManagerInterface
	{
		$this->responseHeaders = $responseHeaders;
		return ($this);
	}
	
	/**
	 * 
	 * @return array
	 * @author Flavien Maillot 
	 */
	public function getResponseHeader(): array
	{
		return ($this->responseHeaders);
	}
	
	/**
	 * 
	 * 
	 * @param type $response
	 * @return \MaillotF\Pcvue\PcvueBridgeBundle\Manager\ManagerInterface
	 */
	private function setResponse($response): ManagerInterface
	{
		$contentType = $this->getResponseHeader()['Content-Type'][0];
		$contentTypeAttr = array();
		preg_match('/([\w\/]*); charset=(.*)/', $contentType, $contentTypeAttr);
		$charset = strtoupper($contentTypeAttr[2]);

		if ($charset == 'UTF-16')
			$response = mb_convert_encoding($response, 'UTF-8', 'UTF-16');
		$this->response = $response;
		return ($this);
	}
	
	/**
	 *  
	 * @return string
	 * @author Flavien Maillot 
	 */
	public function getResponse()
	{
		return ($this->response);
	}
	
	/**
	 * 
	 * @return type
	 * @author Flavien Maillot 
	 */
	public function getReponseFormated()
	{
		//The last param is to get array
		$result = json_decode($this->response, true);
		return ($result);
	}	
	
}

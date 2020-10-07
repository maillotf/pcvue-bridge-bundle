<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MaillotF\Pcvue\PcvueBridgeBundle\Manager;

/**
 *
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
interface ManagerInterface
{

	public function setClient(\GuzzleHttp\ClientInterface $client): ManagerInterface;

	public function getClient(): ?\Psr\Http\Client\ClientInterface;

	public function setScope(string $scope): ManagerInterface;

	public function getScope(): string;

	public function setConfig(ConfigInterface $config): ManagerInterface;

	public function getConfig(): ConfigInterface;

	public function get(string $path, bool $strict = true): ManagerInterface;

	public function post(string $path, $datas, bool $strict = true): ManagerInterface;

	public function getReasonPhrase(): string;

	public function getStatusCode(): int;

	public function getResponseHeader(): array;

	public function getResponse();

	public function getReponseFormated();
}

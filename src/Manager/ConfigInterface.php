<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Manager;

/**
 *
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
interface ConfigInterface
{

	public function setProtocol(string $protocol): ConfigInterface;

	public function getProtocol(): string;

	public function setHost(string $host): ConfigInterface;

	public function getHost(): string;

	public function setPort(int $port): ConfigInterface;

	public function getPort(): int;

	public function setClientId(string $client_id): ConfigInterface;

	public function getClientId(): string;

	public function setClientSecret(string $client_secret): ConfigInterface;

	public function getClientSecret(): string;

	public function setUsername(string $username): ConfigInterface;

	public function getUsername(): string;

	public function setPassword(string $password): ConfigInterface;

	public function getPassword(): string;

	public function setScope(string $scope): ConfigInterface;

	public function getScope(): string;

	public function setTmpDir(string $tmp_dir): ConfigInterface;

	public function getTmpDir(): string;

	public function setTokensPath(string $path): ConfigInterface;

	public function getTokensPath(): string;

	public function setTokens(array $tokens): ConfigInterface;

	public function getTokens(): ?array;

	public function setToken(array $token, string $scope): ConfigInterface;

	public function getToken(): ?string;

	public function updateToken(string $token): ConfigInterface;

	public function getBaseURL(): string;

	public function getReauthConfig(?string $refresh_token = null): array;
}

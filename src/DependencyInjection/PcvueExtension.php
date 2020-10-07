<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Description of PapercutExtension
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\DependencyInjection
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class PcvueExtension extends Extension
{

	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		// Authentication
		$container->setParameter('pcvue.authentication.protocol', $config['authentication']['protocol']);
		$container->setParameter('pcvue.authentication.host', $config['authentication']['host']);
		$container->setParameter('pcvue.authentication.port', $config['authentication']['port']);
		$container->setParameter('pcvue.authentication.client_id', $config['authentication']['client_id']);
		$container->setParameter('pcvue.authentication.client_secret', $config['authentication']['client_secret']);
		$container->setParameter('pcvue.authentication.username', $config['authentication']['username']);
		$container->setParameter('pcvue.authentication.password', $config['authentication']['password']);
		$container->setParameter('pcvue.authentication.root_dir', $config['authentication']['root_dir']);

		// load services for bundle
		$loader = new YamlFileLoader(
				$container,
				new FileLocator(__DIR__ . '/../Resources/config')
		);
		$loader->load('services.yml');
	}

}

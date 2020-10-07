<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Description of Configuration
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle\DependencyInjection
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class Configuration implements ConfigurationInterface
{
	/**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
		$builder = new TreeBuilder('pcvue');

        $builder->getRootNode()->addDefaultsIfNotSet()
            ->children()
				->arrayNode('authentication')
                    ->isRequired()
                    ->children()
                        ->scalarNode('protocol')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
						->scalarNode('host')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
						->scalarNode('port')
                            ->isRequired()
							->defaultValue(80)
                        ->end()
						->scalarNode('client_id')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
						->scalarNode('client_secret')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
						->scalarNode('username')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
						->scalarNode('password')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
						->scalarNode('root_dir')
                            ->defaultValue('%kernel.project_dir%/var/tmp/pcvue/')
                        ->end()
					->end()
				->end()
			->end()
		;
		return ($builder);
	}
}

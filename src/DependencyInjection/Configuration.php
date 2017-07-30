<?php

namespace GeoSocio\HttpSerializerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\DependencyInjection\Extension\ConfigurationExtensionInterface;

/**
 * {@inheritdoc}
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('geosocio_http_serializer');

        $rootNode
            ->children()
                ->scalarNode('default_format')->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}

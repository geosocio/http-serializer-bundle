<?php

namespace GeoSocio\HttpSerializerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds tagged group resolvers to the group resolver manager.
 */
class GroupResolverPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container) : void
    {
        $this->addResolvers(
            $container,
            'geosocio_http_serializer.request_group_resolver_manager',
            'geosocio_http_serializer.request_group_resolver'
        );
        $this->addResolvers(
            $container,
            'geosocio_http_serializer.response_group_resolver_manager',
            'geosocio_http_serializer.response_group_resolver'
        );
    }

    /**
     * Add the Resolvers.
     *
     * @param ContainerBuilder $container
     * @param string $service
     * @param string $tag
     *
     * @return void
     */
    protected function addResolvers(ContainerBuilder $container, string $service, string $tag)
    {
        if (!$container->has($service)) {
            return;
        }

        $definition = $container->getDefinition($service);
        $taggedServices = $container->findTaggedServiceIds($tag);

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addResolver', [
                    new Reference($id)
                ]);
            }
        }
    }
}

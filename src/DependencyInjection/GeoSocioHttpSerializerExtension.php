<?php

namespace GeoSocio\HttpSerializerBundle\DependencyInjection;

use GeoSocio\HttpSerializer\ArgumentResolver\ContentArrayResolver;
use GeoSocio\HttpSerializer\ArgumentResolver\ContentClassResolver;
use GeoSocio\HttpSerializer\EventListener\KernelViewListener;
use GeoSocio\HttpSerializer\EventListener\KernelExceptionListener;
use GeoSocio\HttpSerializer\GroupResolver\RequestGroupResolverManager;
use GeoSocio\HttpSerializer\GroupResolver\ResponseGroupResolverManager;
use GeoSocio\HttpSerializer\Loader\RequestGroupLoader;
use GeoSocio\HttpSerializer\Loader\ResponseGroupLoader;
use GeoSocio\HttpSerializer\Serializer\ExceptionNormalizer;
use GeoSocio\HttpSerializer\Serializer\ConstraintViolationNormalizer;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * {@inheritdoc}
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class GeoSocioHttpSerializerExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'geosocio_http_serializer';
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Group Resolver
        $container->register(
            'geosocio_http_serializer.request_group_resolver_manager',
            RequestGroupResolverManager::class
        )
            ->setPublic(false);
        $container->register(
            'geosocio_http_serializer.response_group_resolver_manager',
            ResponseGroupResolverManager::class
        )
            ->setPublic(false);

        // Group Loader
        $container->register('geosocio_http_serializer.request_group_loader', RequestGroupLoader::class)
            ->setArguments([
                new Reference('controller_resolver'),
                new Reference('annotation_reader'),
            ])
            ->addTag('geosocio_http_serializer.request_group_resolver')
            ->setPublic(false);
        $container->register('geosocio_http_serializer.response_group_loader', ResponseGroupLoader::class)
            ->setArguments([
                new Reference('controller_resolver'),
                new Reference('annotation_reader'),
            ])
            ->addTag('geosocio_http_serializer.response_group_resolver')
            ->setPublic(false);

        // Return Listener
        $serializer = new Reference('serializer');
        $container->register('geosocio_http_serializer.return_listener', KernelViewListener::class)
            ->setArguments([
                $serializer,
                $serializer,
                $serializer,
                new Reference('event_dispatcher'),
                new Reference('geosocio_http_serializer.response_group_resolver_manager'),
            ])
            ->addTag('kernel.event_listener', ['event' => 'kernel.view'])
            ->setPublic(false);

        // Exception Listener
        $serializer = new Reference('serializer');
        $container->register('geosocio_http_serializer.exception_listener', KernelExceptionListener::class)
            ->setArguments([
                $serializer,
                $serializer,
                $serializer,
                new Reference('event_dispatcher'),
                $config['default_format'] ?? null
            ])
            ->addTag('kernel.event_listener', ['event' => 'kernel.exception'])
            ->setPublic(false);

        // Exception Normalizer
        $container->register('geosocio_http_serializer.serializer_exception', ExceptionNormalizer::class)
            ->setArguments([
                '%kernel.environment%'
            ])
            ->addTag('serializer.normalizer')
            ->setPublic(false);

        // Constraint Violation Normalizer
        $container->register(
            'geosocio_http_serializer.serializer_constraint_violation',
            ConstraintViolationNormalizer::class
        )
            ->addTag('serializer.normalizer')
            ->setPublic(false);

        // Content Class Resolver
        $serializer = new Reference('serializer');
        $container->register('geosocio_http_serializer.content_class_resolver', ContentClassResolver::class)
            ->setArguments([
                $serializer,
                $serializer,
                $serializer,
                new Reference('event_dispatcher'),
                new Reference('validator'),
                new Reference('geosocio_http_serializer.request_group_resolver_manager'),
            ])
            ->addTag('controller.argument_value_resolver')
            ->setPublic(false);

        // Content Array Resolver
        $container->register('geosocio_http_serializer.content_array_resolver', ContentArrayResolver::class)
            ->setArguments([
                new Reference('serializer')
            ])
            ->addTag('controller.argument_value_resolver')
            ->setPublic(false);
    }
}

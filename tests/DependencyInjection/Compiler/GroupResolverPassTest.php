<?php

namespace GeoSocio\HttpSerializerBundle\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Adds tagged group resolvers to the group resolver manager.
 */
class GroupResolverPassTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    public function testProcess()
    {
        $pass = new GroupResolverPass();

        $containerBuilder = $this->getMockBuilder(ContainerBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $containerBuilder->method('has')
            ->willReturnOnConsecutiveCalls(false, true);

        $definition = $this->getMockBuilder(Definition::class)
            ->disableOriginalConstructor()
            ->getMock();

        $containerBuilder->method('getDefinition')
            ->willReturn($definition);
        $containerBuilder->method('findTaggedServiceIds')
            ->willReturn([
                'geosocio_http_serializer.response_group_loader' => [
                    'geosocio_http_serializer.response_group_resolver' => [],
                ]
            ]);

        $this->assertNull($pass->process($containerBuilder));
    }
}

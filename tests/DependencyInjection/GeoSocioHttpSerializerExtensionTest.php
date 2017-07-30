<?php

namespace GeoSocio\HttpSerializerBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Extension Test
 */
class GeoSocioHttpSerializerExtensionTest extends TestCase
{
    /**
     * Test Get Alias
     */
    public function testGetAlias()
    {
        $alias = 'geosocio_http_serializer';
        $extension = new GeoSocioHttpSerializerExtension();

        $this->assertEquals($alias, $extension->getAlias());
    }

    /**
     * Test Load
     */
    public function testLoad()
    {
        $definition = $this->getMockBuilder(Definition::class)
            ->disableOriginalConstructor()
            ->getMock();
        $definition->method('setArguments')
            ->willReturnSelf();
        $definition->method('setPublic')
            ->willReturnSelf();
        $definition->method('addTag')
            ->willReturnSelf();

        $container = $this->getMockBuilder(ContainerBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container->method('register')
            ->willReturn($definition);

        $extension = new GeoSocioHttpSerializerExtension();

        $this->assertNull($extension->load([], $container));
    }
}

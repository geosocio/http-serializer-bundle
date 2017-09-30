<?php

namespace GeoSocio\HttpSerializerBundle\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
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

        $this->assertNull($pass->process($containerBuilder));
    }
}

<?php

namespace GeoSocio\HttpSerializerBundle;

use GeoSocio\HttpSerializerBundle\DependencyInjection\GeoSocioHttpSerializerExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Bundle Test
 */
class GeoSocioHttpSerializerBundleTest extends TestCase
{

    /**
     * Test Get Container Extension
     */
    public function testGetContainerExtension()
    {
        $bundle = new GeoSocioHttpSerializerBundle();

        $extension = $bundle->getContainerExtension();

        $this->assertInstanceOf(GeoSocioHttpSerializerExtension::class, $extension);
    }

    /**
     * Test Get Container Extension
     */
    public function testBuild()
    {
        $bundle = new GeoSocioHttpSerializerBundle();

        $continerBuilder = $this->getMockBuilder(ContainerBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertNull($bundle->build($continerBuilder));
    }
}

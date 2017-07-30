<?php

namespace GeoSocio\HttpSerializerBundle;

use GeoSocio\HttpSerializerBundle\DependencyInjection\GeoSocioHttpSerializerExtension;
use PHPUnit\Framework\TestCase;

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
}

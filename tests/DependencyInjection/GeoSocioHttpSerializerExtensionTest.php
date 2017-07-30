<?php

namespace GeoSocio\HttpSerializerBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;

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
}

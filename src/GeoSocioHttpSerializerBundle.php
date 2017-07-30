<?php

namespace GeoSocio\HttpSerializerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GeoSocioHttpSerializerBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        if ($this->extension === null) {
            $extension = $this->createContainerExtension();
            $this->extension = $extension ?? false;
        }

        return $this->extension ?? null;
    }
}

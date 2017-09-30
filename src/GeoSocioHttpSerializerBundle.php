<?php

namespace GeoSocio\HttpSerializerBundle;

use GeoSocio\HttpSerializerBundle\DependencyInjection\Compiler\GroupResolverPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
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

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new GroupResolverPass());
    }
}

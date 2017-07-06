<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\DependencyInjection\MergeExtensionConfigurationPass;

require __DIR__.'/vendor/autoload.php';

$parameterBag = new \Symfony\Component\DependencyInjection\ParameterBag\ParameterBag();
$container = new \Symfony\Component\DependencyInjection\Container($parameterBag);
$builder = new \Symfony\Component\DependencyInjection\ContainerBuilder($parameterBag);


$builder->register('event_dispatcher', EventDispatcher::class);
$builder->register('request_stack', \Symfony\Component\HttpFoundation\RequestStack::class);
/**
 * MONGOBUNDLE
 */
$builder->register('annotation_reader', \Doctrine\Common\Annotations\AnnotationReader::class);

$bundles = [];
$bundles[] = new \Symfony\Bundle\SecurityBundle\SecurityBundle();
$bundles[] = new  Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle();
$bundles[] = new \MyBundle\MyBundle();


$extensions = [];
/** @var \Symfony\Component\HttpKernel\Bundle\Bundle $bundle */
foreach ($bundles as $bundle){
    $extension = $bundle->getContainerExtension();
    $builder->registerExtension($extension);
    $extensions[] = $extension->getAlias();
}

$kernelConfigBundles = [];
foreach ($bundles as $bundle){
    $kernelConfigBundles[$bundle->getName()] = get_class($bundle);
    $bundle->build($builder);
}

/**
 * bundles config load
 */
$builder->getCompilerPassConfig()->setMergePass(new MergeExtensionConfigurationPass($extensions));

/**
 * base config
 */
$loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader(
        $builder,
        new FileLocator(__DIR__)
);
$loader->load('config/services.yml');
$loader->load('config/config.yml');


$builder->getParameterBag()->add([
    'kernel.name' => 'TESZT',
    'kernel.root_dir' => __DIR__,
    'kernel.environment' => 'dev',
    'kernel.bundles' => $kernelConfigBundles,
    'kernel.cache_dir' => __DIR__.'/cache'
]);


$builder->compile();


$dumper = new Symfony\Component\DependencyInjection\Dumper\PhpDumper($builder);
file_put_contents('container.php', $dumper->dump(['class' => 'MyContainer']));

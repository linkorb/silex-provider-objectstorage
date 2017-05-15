<?php

namespace LinkORB\ObjectStorage\Provider;

use RuntimeException;

use ObjectStorage\Service;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ObjectStorageServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['object_storage.adapter'] = function ($app) {
            $configPath = $app['storage.config_path'];
            $config = $app['config.loader.ini']->load($configPath);
            if (!array_key_exists('general', $config)) {
                throw new RuntimeException(
                    "Unable to configure Storage Adapter: missing \"general\" section from \"{$configPath}\"."
                );
            }
            if (!array_key_exists('adapter', $config['general'])) {
                throw new RuntimeException(
                    "Unable to configure Storage Adapter: missing \"adapter\" key from \"{$configPath}\"."
                );
            }
            $adapter = $config['general']['adapter'];
            if (!array_key_exists($adapter, $config)) {
                throw new RuntimeException(
                    "Unable to configure Storage Adapter: missing \"{$adapter}\" section from \"{$configPath}\"."
                );
            }
            $class = '\\ObjectStorage\\Adapter\\' . ucfirst($adapter) . 'Adapter';
            if (!class_exists($class)) {
                throw new RuntimeException(
                    "Unable to configure Storage Adapter: missing class providing \"adapter\" ({$class})."
                );
            }
            return $class::build($config[$adapter]);
        };

        $app['object_storage.service'] = function ($app) {
            return new Service($app['object_storage.adapter']);
        };
    }
}

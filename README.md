# linkorb/silex-provider-objectstorage

Provides the `ObjectStorage\Service` from [linkorb/objectstorage][] as a
service named `object_storage.service`.


## Install

Install using composer:-

    $ composer require linkorb/silex-provider-objectstorage

Then, [configure the storage service][objectstorage.conf] and register the
provider, passing the configuration values to the `register` method:-

    // app/app.php
    use LinkORB\ObjectStorage\Provider\ObjectStorageServiceProvider;
    ...
    $app->register(
        new ObjectStorageServiceProvider,
        ['object_storage.config' => [...]]
    );

## Usage

See the [documentation for linkorb/objectstorage][linkorb/objectstorage].


[linkorb/objectstorage]: <https://github.com/linkorb/objectstorage>
  "linkorb/objectstorage at GitHub"
[objectstorage.conf]: <https://github.com/linkorb/objectstorage/blob/master/objectstorage.conf.dist>
  "objectstorage/objectstorage.conf.dist - linkorb/objectstorage"

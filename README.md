# Simple EventStore Manager Bundle #

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/421ed4fab69c4702ab3d2fec40e3aaa4)](https://www.codacy.com/app/mauretto78/simple-event-store-manager-bundle?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=mauretto78/simple-event-store-manager-bundle&amp;utm_campaign=Badge_Grade)
[![license](https://img.shields.io/github/license/mauretto78/simple-event-store-manager-bundle.svg)]()
[![Packagist](https://img.shields.io/packagist/v/mauretto78/simple-event-store-manager-bundle.svg)]()

This is the official Symfony bundle for [Simple EventStore Manager package](https://github.com/mauretto78/simple-event-store-manager).

## Install Guide ##

#### Step 1: Include Simple EventStore Manager Bundle in your project with composer:

```bash
composer require mauretto78/simple-event-store-manager-bundle
```

#### Step 2: Setup your config.yml to configure your driver and connection parameters

Here is an example:

```yml
# Simple EventStore Manager
simple_event_store_manager:
    driver: 'mongo'
    api_format: 'yaml'
    parameters:
        host: 'localhost'
        username: ~
        password: ~
        database: 'eventstore_demo'
        port: '27017'
    elastic:
        host: 'localhost'
        port: '9200'
```

* `api_format` is an optional parameter; you can choose between `json` (default), `xml` or `yaml`
* `elastic` is an optional parameter; you can send your events to a Elastic server

Please refer to [Simple EventStore Manager page](https://github.com/mauretto78/simple-event-store-manager) for more details.

#### Step 3: Setup your AppKernel.php by adding the Simple EventStore Manager Bundle 

```php
// ..
$bundles[] = new SimpleEventStoreManager\Bundle\SimpleEventStoreManagerBundle();
```

#### Step 4: Setup yor routing.yml

Add these lines at the bottom of your `routing.yml` file:

```yaml
_simple_event_store_manager:
    resource: '@SimpleEventStoreManagerBundle/Resources/config/routing.yml'
```

## Usage Guide ##

You can use `EventsManager` in your Controllers:

```php
// ..

$manager = $this->container->get('simple_event_store_manager');
$eventManager = $manager->getMananger();

// store events in an aggregate
$eventManager->storeEvents(
    'name-of-your-aggregate',
    [
        ...
    ]
);

```

Or inject it into your services and classes:

```yaml
services:
     # ...

     AppBundle\Your\Service:
         arguments: ['@simple_event_store_manager']
         
```

Please refer to [official documentation of Simple EventStore Manager](https://github.com/mauretto78/simple-event-store-manager) for basic usage of this Library.

## API support ##

An API endpoint is automatically exposed to `/_events/{aggregate}/{page}` route; it will automatically paged with **25 records per page**. 

When a page is complete, it will set automatically an infinite cache on it.

## Support ##

If you found an issue or had an idea please refer [to this section](https://github.com/mauretto78/simple-event-store-manager-bundle/issues).

## Authors

* **Mauro Cassani** - [github](https://github.com/mauretto78)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

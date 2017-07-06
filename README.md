# Simple EventStore Manager Bundle #

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
    parameters:
        host: 'localhost'
        username: ~
        password: ~
        database: 'eventstore_demo'
        port: '27017'
```

Please refer to [Simple EventStore Manager page](https://github.com/mauretto78/simple-event-store-manager) for more details.

#### Step 3: Setup your AppKernel.php by adding the InMemoryList Bundle

```php
// ..
$bundles[] = new SimpleEventStoreManager\Bundle\EventStoreManagerBundle();
```
#### Step 4: Setup yor routing.yml

Add these lines at the bottom of your `routing.yml` file:

```yaml
_simple_event_store_manager:
    resource: '@SimpleEventStoreManager/Resources/config/routing.yml'
```

## Usage Guide ##

## Support ##

If you found an issue or had an idea please refer [to this section](https://github.com/mauretto78/simple-event-store-manager-bundle/issues).

## Authors

* **Mauro Cassani** - [github](https://github.com/mauretto78)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
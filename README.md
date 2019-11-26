# Disable Plugins

This plugins allows you to define disabled plugins using PHP constants.


## Installation

### Composer

`composer require lukasbesch/disable-plugins`

### Manual

Download [the latest release](https://github.com/lukasbesch/disable-plugins/releases/latest) and place it in your `wp-content/plugins` folder.


## Usage

### Standard WordPress

Place this in your `wp-config.php` and add your plugins.

```php
if (!defined('DISABLED_PLUGINS') {
    define('DISABLED_PLUGINS', serialize([
        'autoptimize/autoptimize.php',
        'updraftplus/updraftplus.php',
        'wp-super-cache/wp-cache.php',
        'w3-total-cache/w3-total-cache.php',
    ]));
}
```

### Bedrock

Place this in your `config/environments/development.php ` and add your plugins.

```php
Config::define('DISABLED_PLUGINS', serialize([
    'autoptimize/autoptimize.php',
    'updraftplus/updraftplus.php',
    'wp-super-cache/wp-cache.php',
    'w3-total-cache/w3-total-cache.php',
]));
```

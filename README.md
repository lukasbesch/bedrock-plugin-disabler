# Disable Plugins

This plugins allows you to define disabled plugins using PHP constants.


## Installation

### Bedrock / Composer-based site

`composer require lukasbesch/disable-plugins`

It will be installed as a `wordpress-muplugin` by default. This only works for sites using [Bedrock](https://github.com/roots/bedrock).

### Standard WordPress / Manual

Download [the latest release](https://github.com/lukasbesch/disable-plugins/releases/latest) and place it in your `wp-content/plugins` folder.


## Usage

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

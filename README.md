# Bedrock Plugin Disabler

Define an array of plugins that deactivate automatically in certain environments (e.g. caching plugins in development).

Inspired by [this blog post](https://kamilgrzegorczyk.com/2018/05/02/how-to-disable-plugins-on-certain-environment/) by [Kamil Grzegorczyk](https://kamilgrzegorczyk.com/).
Uses [a fork](https://gist.github.com/Rarst/4402927) of the [`DisablePlugins` class](https://gist.github.com/markjaquith/1044546) written by [Mark Jaquith](http://markjaquith.com/).

## Installation

This plugin is designed to work with [Bedrock](https://github.com/roots/bedrock) based sites, and will **not** work with a Standard WordPress installation.

`composer require lukasbesch/bedrock-plugin-disabler`

It will be installed as a `wordpress-muplugin`.  
If you try to activate it as a regular plugin, the plugin will deactivate itself with a notice.

#### Manual Installation (not recommended)

Download [the latest release](https://github.com/lukasbesch/bedrock-plugin-disabler/releases/latest) and place it in your `web/app/mu-plugins` folder.

## Usage

Place this in your `config/environments/development.php ` and add your plugins.

```php
Config::define('DISABLED_PLUGINS', [
    'autoptimize/autoptimize.php',
    'updraftplus/updraftplus.php',
    'wp-super-cache/wp-cache.php',
    'w3-total-cache/w3-total-cache.php',
]);
```

PHP 5.6+ can store arrays in constants, but you can also provide serialized data:

```php
Config::define('DISABLED_PLUGINS', serialize([
    'autoptimize/autoptimize.php',
]));

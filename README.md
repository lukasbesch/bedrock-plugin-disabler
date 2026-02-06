# Bedrock Plugin Disabler
[![Packagist](https://img.shields.io/packagist/vpre/lukasbesch/bedrock-plugin-disabler.svg?style=flat-square)](https://packagist.org/packages/lukasbesch/bedrock-plugin-disabler)
[![Supported PHP Versions](https://img.shields.io/packagist/php-v/lukasbesch/bedrock-plugin-disabler.svg?style=flat-square)](https://github.com/lukasbesch/bedrock-plugin-disabler)
[![GitHub Repository Size](https://img.shields.io/github/languages/code-size/lukasbesch/bedrock-plugin-disabler.svg?style=flat-square)](https://github.com/lukasbesch/bedrock-plugin-disabler)
[![Build Status](https://img.shields.io/circleci/build/github/lukasbesch/bedrock-plugin-disabler?style=flat-square)](https://circleci.com/gh/lukasbesch/bedrock-plugin-disabler)
[![Downloads](https://img.shields.io/packagist/dt/lukasbesch/bedrock-plugin-disabler.svg?style=flat-square)](https://packagist.org/packages/lukasbesch/bedrock-plugin-disabler)



Define an array of plugins that deactivate automatically in certain environments (e.g. caching plugins in development).

Inspired by [this blog post](https://kamilgrzegorczyk.com/2018/05/02/how-to-disable-plugins-on-certain-environment/) by [Kamil Grzegorczyk](https://kamilgrzegorczyk.com/).
Uses [a fork](https://gist.github.com/Rarst/4402927) of the [`DisablePlugins` class](https://gist.github.com/markjaquith/1044546) written by [Mark Jaquith](http://markjaquith.com/).

## Installation

This plugin is designed to work with [Bedrock](https://github.com/roots/bedrock) based sites, and will **not** work with a Standard WordPress installation.

```bash
$ composer require lukasbesch/bedrock-plugin-disabler
```

It will be installed as a `wordpress-muplugin`.  
If you try to activate it as a regular plugin, the plugin will deactivate itself with a notice.

#### Manual Installation (not recommended)

Download [the latest release](https://github.com/lukasbesch/bedrock-plugin-disabler/releases/latest) and place it in your `web/app/mu-plugins` folder.

## Usage

Define the constant `DISABLED_PLUGINS` with an array of the plugins main files you want to deactivate in your preferred environment configuration, for example `config/environments/development.php`:

```php
Config::define('DISABLED_PLUGINS', [
    'autoptimize/autoptimize.php',
    'updraftplus/updraftplus.php',
    'wp-super-cache/wp-cache.php',
    'w3-total-cache/w3-total-cache.php',
]);
```

If you have an older Bedrock installation ([< 1.9.0](https://github.com/roots/bedrock/releases/tag/1.9.0)) you have to define the constant using the regular `define()` function:

```php
if (! defined('DISABLED_PLUGINS')
    define('DISABLED_PLUGINS', [
        'autoptimize/autoptimize.php',
    ]);
}
```

You can also provide serialized data:

```php
Config::define('DISABLED_PLUGINS', serialize([
    'autoptimize/autoptimize.php',
]));

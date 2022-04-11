<?php
/*
Plugin Name:  Bedrock Plugin Disabler
Plugin URI:   https://github.com/lukasbesch/bedrock-plugin-disabler/
Description:  Define an array of plugins that should be deactivated automatically in certain environments.
Version:      1.3.0
Author:       Lukas Besch, Kamil Grzegorczyk
Author URI:   https://lukasbesch.com/
License:      MIT License
*/

use Besch\PluginDisabler;

require_once(__DIR__ . '/src/Plugin.php');

new PluginDisabler\Plugin(__FILE__);

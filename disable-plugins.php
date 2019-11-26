<?php
/*
Plugin Name:  Disable plugins
Plugin URI:   https://lukasbesch.com/
Description:  Disable certain plugins in non-production environments using PHP constants.
Version:      1.0.0
Author:       Lukas Besch
Author URI:   https://lukasbesch.com/
License:      MIT License
*/

if (defined('DISABLED_PLUGINS') && ! empty(DISABLED_PLUGINS)) {
    function get_disabled_plugins()
    {
        $plugins_to_disable = unserialize(DISABLED_PLUGINS, [false]);
        return (!empty($plugins_to_disable) && is_array($plugins_to_disable)) ? $plugins_to_disable : [];
    }

    function show_plugin_not_activatable_notice()
    {
        global $wp_list_table;
        $plugins_to_disable = get_disabled_plugins();
        foreach ($wp_list_table->items as $key => $val) {
            if (in_array($key, $plugins_to_disable, true)) {
                $item = $wp_list_table->items[$key];
                $item['Name'] = '[Disabled] ' . $item['Name'];
                $item['Description'] .= '<br><strong style="color:red">Disabled in this environment.</strong>';
                unset($wp_list_table->items[$key]);
                $wp_list_table->items[$key] = $item;
            }
        }
    }

    $plugins_to_disable = get_disabled_plugins();

    if (!empty($plugins_to_disable) && is_array($plugins_to_disable)) {
        require_once(__DIR__ . '/disable-plugins-class.php');
        $utility = new DisablePlugins($plugins_to_disable);

        // part below is optional but for me it is crucial
        // error_log('Locally disabled plugins: ' . var_export($plugins_to_disable, true));
    }

    add_action('pre_current_active_plugins', 'show_plugin_not_activatable_notice');
}

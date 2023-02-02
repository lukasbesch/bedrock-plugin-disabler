<?php

namespace Besch\PluginDisabler;

/**
 * Class Plugin
 *
 * The main plugin file.
 *
 * @package Besch\PluginDisabler
 */
class Plugin
{
    public $plugin_file;
    public $disabled_plugins = [];

    /**
     * Plugin constructor.
     */
    public function __construct($plugin_file)
    {
        $this->plugin_file = $plugin_file;

        $is_mu_plugin = defined('WPMU_PLUGIN_DIR') &&
                        realpath(WPMU_PLUGIN_DIR) === realpath(dirname($plugin_file, 2));
        if (! $is_mu_plugin) {
            // prevent activation as a regular plugin
            register_activation_hook($plugin_file, [$this, 'preventPluginActivation']);
            // print notice and deactivate as the plugin is already activated (for whatever reason)
            add_action('admin_notices', [$this, 'printNoticeAndDeactivate' ]);
        }

        // disable the specified plugins after all other must-use plugins are loaded
        add_action('muplugins_loaded', [$this, 'disablePlugins']);
    }

    /**
     * Get the disabled plugins.
     *
     * @return array
     */
    public function getDisabledPlugins()
    {
        if (defined('DISABLED_PLUGINS') && !empty(DISABLED_PLUGINS)) {
            $plugins = is_string(DISABLED_PLUGINS) ? unserialize(DISABLED_PLUGINS, [false]) : DISABLED_PLUGINS;
        }
        return !empty($plugins) && is_array($plugins) ? $plugins : [];
    }

    /**
     * Prevent plugin to be activated as a regular plugin.
     * Used as the activation hook.
     */
    public function preventPluginActivation()
    {
        wp_die(
            __('Plugin Disabler only works as a must-use plugin in a bedrock site.', 'plugin-disabler'),
            __('Plugin Disabler', 'plugin-disabler'),
            ['back_link' => true]
        );
    }

    /**
     * Prints the admin notice that the plugin should be installed
     * as a must-use plugin and deactivates the plugin itself.
     */
    public function printNoticeAndDeactivate()
    {
        $class = 'notice notice-error';
        $message = __('Plugin Disabler only works as a must-use plugin in a bedrock site.', 'plugin-disabler');
        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));

        // deactivate self
        deactivate_plugins(plugin_basename($this->plugin_file));
    }

    /**
     * Run the Disabler.
     */
    public function disablePlugins($plugins = null)
    {
        /**
         * Set disabled plugins.
         */
        $this->disabled_plugins = $this->getDisabledPlugins();

        /**
         * Run the disabler.
         */
        if (empty($this->disabled_plugins)) {
            return;
        }

        // Disable the plugins.
        require_once(__DIR__ . '/DisablePlugins.php');
        new DisablePlugins($this->disabled_plugins);

        /**
         * Add the disabled notice.
         */
        if (! empty($this->disabled_plugins)) {
            add_action('pre_current_active_plugins', [$this, 'disabledNotice']);
        }
    }

    /**
     * Add the disabled plugins to the end of the list and add a notice.
     */
    public function disabledNotice()
    {
        global $wp_list_table;
        foreach ($wp_list_table->items as $key => $val) {
            if (in_array($key, $this->disabled_plugins, true)) {
                $item = $wp_list_table->items[$key];
                $item['Name'] = '[Disabled] ' . $item['Name'];
                $item['Description'] .= '<br><strong style="color:red">Disabled in this environment.</strong>';
                unset($wp_list_table->items[$key]);
                $wp_list_table->items[$key] = $item;
            }
        }
    }
}

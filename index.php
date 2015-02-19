<?php
/**
 * @package callmaker
 * @version 0.1
 */
/*
Plugin Name: callmaker
Description: Callmaker helps you boost website conversion by establishing phone calls with your visitors via VOIP.
Author: callmaker
Version: 0.1
Author URI: http://callmaker.ru
*/

$sServiceUrl = 'callback.center'; // todo для продакшена другой адрес сайта ;)
$sScriptUrl = 'http://callback.center/witget/witget_test.js'; // todo для продакшена другой адрес виджета ;)

require_once('include/functions.php');

add_action('admin_menu', 'digitaldali_callmaker_admin_add_menus');

function digitaldali_callmaker_admin_add_menus()
{
    add_menu_page('Callmaker', 'Callmaker', 1, dirname(__FILE__) . '/' . basename(__FILE__), 'digitaldali_callmaker_admin_panel');
    add_submenu_page(dirname(__FILE__) . '/' . basename(__FILE__), 'Callmaker Settings', 'Settings', 1, dirname(__FILE__) . '/' . basename(__FILE__), 'digitaldali_callmaker_admin_panel');

    $callmaker_login = get_option('callmaker_login');
    if (empty($callmaker_login)) {
        add_submenu_page(dirname(__FILE__) . '/' . basename(__FILE__), 'Callmaker Registration', 'Registration', 1, dirname(__FILE__) . '/register.php', 'digitaldali_callmaker_admin_register');
    }
}

function digitaldali_callmaker_admin_panel()
{
    require_once(dirname(__FILE__) . '/include/settings.php');
}

function digitaldali_callmaker_admin_register()
{
    require_once(dirname(__FILE__) . '/include/register.php');
}

if (!function_exists('embedCallmaker')) {
    function embedCallmaker()
    {
        if (!is_admin()) {
            global $sScriptUrl;
            $embedPlugin = (get_option('show_callmaker_widget') == true);
            if ($embedPlugin) {
                add_action('wp_footer', 'digitaldali_callmaker_embed');
                wp_register_script('digitaldali_callmaker_widget_js', $sScriptUrl, '', '1.0', true);
                wp_enqueue_script('digitaldali_callmaker_widget_js');
            }
        }
    }
}

add_action('init', 'embedCallmaker');

function digitaldali_callmaker_embed()
{
    ?>
    <script type="text/javascript">
        clbId = '<?= get_option('callmaker_login'); ?>';
    </script>
<?php
}




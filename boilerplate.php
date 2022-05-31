<?php

/**
 * Plugin Name:       {{BPREPLACENAME}}
 * Plugin URI:        https://github.com/{{BPREPLACEGITHUB}}/{{BPREPLACESLUG}}
 * Description:       {{BPREPLACEDESCRIPTION}}
 * Version:           1.0.0
 * Author:            {{BPREPLACEAUTHOR}}
 * Author URI:        https://github.com/{{BPREPLACEGITHUB}}
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       {{BPREPLACESLUG}}
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('{{BPREPLACECAPSCONSTANT}}_PATH', plugin_dir_path(__FILE__));
define('{{BPREPLACECAPSCONSTANT}}_URL', plugins_url('', __FILE__));
define('{{BPREPLACECAPSCONSTANT}}_TEMPLATE_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'templates/');
define('{{BPREPLACECAPSCONSTANT}}_TEXT_DOMAIN', '{{BPREPLACESLUG}}');

load_plugin_textdomain({{BPREPLACECAPSCONSTANT}}_TEXT_DOMAIN, false, {{BPREPLACECAPSCONSTANT}}_PATH . '/languages');

require_once {{BPREPLACECAPSCONSTANT}}_PATH . 'Public.php';

// Register the autoloader
require __DIR__ . '/vendor/autoload.php';

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('{{BPREPLACESLUG}}');
    $acfExportManager->setExportFolder({{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        '{{BPREPLACESLUG}}-settings' => 'group_61ea7a87e8aaa' //Update with acf id here, settings view
    ));
    $acfExportManager->import();
});

// Start application
new {{BPREPLACENAMESPACE}}\App();

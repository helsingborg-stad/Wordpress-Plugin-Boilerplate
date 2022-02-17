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
 * Text Domain:       mod-{{BPREPLACESLUG}}
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('{{BPREPLACECAPSCONSTANT}}_PATH', plugin_dir_path(__FILE__));
define('{{BPREPLACECAPSCONSTANT}}_URL', plugins_url('', __FILE__));
define('{{BPREPLACECAPSCONSTANT}}_TEMPLATE_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'templates/');

load_plugin_textdomain('{{BPREPLACESLUG}}', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once {{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once {{BPREPLACECAPSCONSTANT}}_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new {{BPREPLACENAMESPACE}}\Vendor\Psr4ClassLoader();
$loader->addPrefix('{{BPREPLACENAMESPACE}}', {{BPREPLACECAPSCONSTANT}}_PATH);
$loader->addPrefix('{{BPREPLACENAMESPACE}}', {{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
$acfExportManager = new \AcfExportManager\AcfExportManager();
$acfExportManager->setTextdomain('{{BPREPLACESLUG}}');
$acfExportManager->setExportFolder({{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/AcfFields/');
$acfExportManager->autoExport(array(
    '{{BPREPLACESLUG}}-settings' => 'group_61ea7a87e8aaa' //Update with acf id here, settings view
));
$acfExportManager->import();

// Start application
new {{BPREPLACENAMESPACE}}\App();
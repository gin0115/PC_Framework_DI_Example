<?php
/**
 * @wordpress-plugin
 * Plugin Name:     PinkCrab Plugin Framework Example 1
 * Plugin URI:      https://github.com/Pink-Crab
 * Description:     Example of using the PinkCrab plugin framework to create MVC style plugins and themes.
 * Version:         1.0.0
 * Author:          Glynn Quelch
 * Author URI:      https://github.com/gin0115
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     gin0115_pcpf_example1
 */

use Gin0115\WP\PC_PF_Example1\Activation;
use Gin0115\WP\PC_PF_Example1\Deactivation;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

// Registers all of our plugin lifecylce hooks.
register_activation_hook(
	__FILE__,
	array( new Activation( $GLOBALS['wpdb'] ), 'activate' )
);

register_deactivation_hook(
	__FILE__,
	array( new Deactivation(), 'deactivate' )
);

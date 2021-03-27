<?php

declare(strict_types=1);

/**
 * Handles all the data used by App_Config
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

// Get the path of the plugin base.
$base_path  = \dirname( __DIR__, 1 );
$plugin_dir = \basename( $base_path );
$wp_uploads = \wp_upload_dir();

return array(
	'plugin'    => array(
		'version' => '0.1.0',
	),
	'path'      => array(
		'plugin'         => $base_path,
		'view'           => $base_path . '/views',
		'assets'         => $base_path . '/assets',
		'upload_root'    => $wp_uploads['basedir'],
		'upload_current' => $wp_uploads['path'],
	),
	'url'       => array(
		'plugin'         => plugins_url( $plugin_dir ),
		'view'           => plugins_url( $plugin_dir ) . '/views',
		'assets'         => plugins_url( $plugin_dir ) . '/assets',
		'upload_root'    => $wp_uploads['baseurl'],
		'upload_current' => $wp_uploads['url'],
	),
	'db_tables' => array(
		// This allows the use of Config::db_tables('quotes') to access the table name
		// You can use Config::db_tables('quotes')
		// or pass App_Config as a dependency and use $app_config->db_tables('quotes');
		'quotes' => 'gin0115_pcpf_quotes',
	),
);

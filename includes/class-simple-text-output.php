<?php

class Simple_Text_Output {

	protected $loader;

	protected $plugin_slug;

	protected $version;

	public function __construct() {

		$this->plugin_slug = 'simple_text_output-slug';
		$this->version = '2017-09-25-00';

		$this->load_dependencies();
		$this->define_admin_hooks();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname(__FILE__) ) .'admin/class-simple-text-output-admin.php';
		
		require_once plugin_dir_path( __FILE__ ) . 'class-simple-text-output-loader.php';
		$this->loader = new Simple_Text_Output_Loader();
	}

	private function define_admin_hooks() {

		if( is_admin() ) {
			$admin = new Simple_Text_Output_Admin( $this->get_version() );
			
			$this->loader->add_action( 'admin_menu', $admin, 'add_plugin_page' );
			$this->loader->add_action( 'admin_init', $admin, 'page_init' );
		}
	}

	public function run() {
		$this->loader->run();
	}

	public function get_version() {
		return $this->version;
	}
}
<?php

class Simple_Text_Output_Manager {

	protected $loader;

	protected $plugin_slug;

	protected $version;

	public function __construct() {

		$this->plugin_slug = 'simple_text_output-slug';
		$this->version = '2017-09-25-00';
	}

	private function load_dependencies() {

	}

	private function define_admin_hooks() {

	}

	public function run() {

	}
 
	public function get_version() {
		return $this->version;
	}
}
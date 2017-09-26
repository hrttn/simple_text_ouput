<?php
/**
 * Simple Text Output is the core plugin responsible for including and
 * instantiating all of the code that composes the plugin
 *
 * @package STO
 */
 
/**
 * Simple Text Output is the core plugin responsible for including and
 * instantiating all of the code that composes the plugin.
 *
 * Simple Text Output includes an instance to the Simple Text Output
 * Loader which is responsible for coordinating the hooks that exist within the
 * plugin.
 *
 * It also maintains a reference to the plugin slug which can be used in
 * internationalization, and a reference to the current version of the plugin
 * so that we can easily update the version in a single place to provide
 * cache busting functionality when including scripts and styles.
 *
 * @since    2017-09-25-00
 */
class Simple_Text_Output {
	/**
	 * A reference to the loader class that coordinates the hooks and callbacks
	 * throughout the plugin.
	 *
	 * @access protected
	 * @var    Simple_Text_Output_Loader   $loader    Manages hooks between the WordPress hooks and the callback functions.
	 */
	protected $loader;

	/**
	 * Represents the slug of the plugin that can be used throughout the plugin
	 * for internationalization and other purposes.
	 *
	 * @access protected
	 * @var    string   $plugin_slug    The single, hyphenated string used to identify this plugin.
	 */
	protected $plugin_slug;

	/**
	 * Maintains the current version of the plugin so that we can use it throughout
	 * the plugin.
	 *
	 * @access protected
	 * @var    string   $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Represents the options of the plugin that is used to
	 * retrieve the text of the shortcode
	 *
	 * @access protected
	 * @var    mixed   $options    Value set for the option.
	 */
	protected $options;

	/**
	 * Instantiates the plugin by setting up the core properties and loading
	 * all necessary dependencies and defining the hooks.
	 *
	 * The constructor will define both the plugin slug and the version
	 * attributes, but will also use internal functions to import all the
	 * plugin dependencies, add the shortcodes and will leverage the 
	 * Simple_Text_Output_Loader for registering the hooks and the callback 
	 * functions used throughout the plugin.
	 */
	public function __construct() {

		$this->plugin_slug = 'simple_text_output-slug';
		$this->version = '2017-09-26-00';

		$this->load_dependencies();
		$this->define_admin_hooks();

		add_shortcode('simple_text_output', array($this, 'shortcode'));
	}

	/**
	 * Imports the Simple Text Output administration classes, and the Simple Text Output Loader.
	 *
	 * The Simple Text Output administration class defines the new settings page on the WordPress
	 * dashboard
	 * 
	 * The Simple Text Output is the class that will coordinate the hooks and callbacks
	 * from WordPress and the plugin. This function instantiates and sets the reference to the
	 * $loader class property.
	 *
	 * @access    private
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( dirname(__FILE__) ) .'admin/class-simple-text-output-admin.php';
		
		require_once plugin_dir_path( __FILE__ ) . 'class-simple-text-output-loader.php';
		$this->loader = new Simple_Text_Output_Loader();
	}

	/**
	 * Defines the hooks and callback functions that are used for creating the settings page
	 *
	 * This function relies on the Simple Text Output Admin class and the Simple Text Output
	 * Loader class property.
	 *
	 * @access    private
	 */
	private function define_admin_hooks() {

		if( is_admin() ) {
			$admin = new Simple_Text_Output_Admin( $this->get_version() );
			
			$this->loader->add_action( 'admin_menu', $admin, 'add_plugin_page' );
			$this->loader->add_action( 'admin_init', $admin, 'page_init' );
		}
	}

	/**
	 * Sets this class into motion.
	 *
	 * Executes the plugin by calling the run method of the loader class which will
	 * register all of the hooks and callback functions used throughout the plugin
	 * with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * Returns the current version of the plugin to the caller.
	 *
	 * @return    string    $this->version    The current version of the plugin.
	*/
	public function get_version() {
		return $this->version;
	}

	/**
	 * Returns the text from the option that will be used in the shortcode [simple_text_output]
	 *
	 * @return    string    $text	The text from the option
	*/
	public function shortcode() {
		$this->options = get_option( 'simple-text-input' );
		$text = esc_attr( $this->options['text-input']);
		
		return $text;
	}
}
<?php
 
class Simple_Text_Output_Admin {

	protected $version;

	public function __construct( $version ) {
		$this->version = $version;

	}

	public function enqueue_styles() {

	}

	public function add_plugin_page() {
		add_options_page(
			'Simple Text Output', 
			'Simple Text Ouput', 
			'manage_options', 
			'simple_text_output', 
			array( $this, 'create_admin_page' )
		);
	}


	public function create_admin_page() {
		
		// Set class property
		$this->options = get_option( 'simple-text-input' );
		?>
		<div class="wrap">
			<h1>Simple Text Output Settings</h1>
			<form method="post" action="options.php">
			<?php
				// This prints out all hidden setting fields
				settings_fields( 'simple-text-input' );
				do_settings_sections( 'simple-text-output-admin' );
				submit_button();
			?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
		
		register_setting(
			'simple-text-input', // Option group
			'simple-text-input', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'settings-simple-text-ouput', // ID
			'Text to display', // Title
			array( $this, 'print_section_info' ), // Callback
			'simple-text-output-admin' // Page
		);  

		add_settings_field(
			'text-input', // ID
			'Your text', // Title 
			array( $this, 'title_callback' ), // Callback
			'simple-text-output-admin', // Page
			'settings-simple-text-ouput' // Section           
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
 	 * @param array $input Contains all settings fields as array keys
	 */
	private function sanitize( $input ) {
		$new_input = array();

		if( isset( $input['text-input'] ) ) {
			$new_input['text-input'] = sanitize_text_field( $input['text-input'] );
		}
		
		return $new_input;
	}

	/** 
	 * Print the Section text
	 */
	private function print_section_info() {
		print 'Enter the text you want to be displayed when you use the shortcode [simple-text-output].';
	}


	/** 
	 * Get the settings option array and print one of its values
	 */
	private function title_callback() {
		printf(
			'<input type="text" id="title" name="simple-text-input[text-input]" value="%s" />',
			isset( $this->options['text-input'] ) ? esc_attr( $this->options['text-input']) : ''
		);
	}
}
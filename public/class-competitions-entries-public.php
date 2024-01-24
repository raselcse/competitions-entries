<?php

class Competitions_Entries_Public {


	private $plugin_name;


	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/competitions-entries-public.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( 'competitions-entries-public', plugin_dir_url( __FILE__ ) . 'js/competitions-entries-public.js', array( 'jquery' ), $this->version, false );
        wp_localize_script('competitions-entries-public', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
		if (is_page('competition-list/submit-entry')) {
			wp_enqueue_script('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@10', array('jquery'), null, true);
		}
	} 

}
<?php


class Competitions_Entries_Activator {


	public static function activate() {


		$parent_page = get_page_by_path('competition-list');
		$parent_page_id = $parent_page ? $parent_page->ID : 0;

		if (!$parent_page_id) {
			// Create the parent page
			$parent_page_data = array(
				'post_title'    => 'Competition List', // Title of the parent page
				'post_name'     => 'competition-list',
				'post_content'  => '[competition_list]', // Add your list shortcode or content here
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'post_author'   => 1, // Set the author ID
				'ping_status'   => 'closed',
				'comment_status'=> 'closed',
			);

			// Insert the parent page and get its ID
			$parent_page_id = wp_insert_post($parent_page_data);
		}

		// Create the child page with the parent page ID
		$page_data = array(
			'post_title'    => 'Submit Entry',
			'post_name'     => 'submit-entry',
			'post_content'  => '[submit_entry_form]', // Add your form shortcode or content here
			'post_status'   => 'publish',
			'post_type'     => 'page',
			'post_author'   => 1, // Set the author ID
			'post_parent'   => $parent_page_id, // Set the parent page ID
			'ping_status'   => 'closed',
			'comment_status'=> 'closed',
		);

		// Insert the child page and get its ID
		$page_id = wp_insert_post($page_data);

	}
	

}

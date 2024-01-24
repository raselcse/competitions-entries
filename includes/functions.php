<?php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/custom-cpt.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/custom-fields.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/all-shortcode.php';

// add submit button after end content
function trpia_inject_submit_entry_button($content) {
   
    if (is_single() && get_post_type() === 'competitions') {
        $post_id = get_the_ID();
        $submit_entry_url = esc_url(add_query_arg(array('competition_id' => $post_id), site_url('/competition-list/submit-entry')));
        $button_html = '<div class="submit-entry-wrapper"><a href="' . $submit_entry_url . '" class="submit-entry-button">Submit Entry</a></div>';
        $content .= $button_html;
    }

    return $content;
}

add_filter('the_content', 'trpia_inject_submit_entry_button');

// Handle Ajax submission
add_action('wp_ajax_submit_entry', 'trpia_submit_entry_callback');
add_action('wp_ajax_nopriv_submit_entry', 'trpia_submit_entry_callback');

function trpia_submit_entry_callback() {
    // Verify nonce
    if (!isset($_POST['submit_entry_nonce_field']) || !wp_verify_nonce($_POST['submit_entry_nonce_field'], 'submit_entry_nonce')) {
        die('Permission check failed');
    }

    // Retrieve form data
    $competition_id = absint($_POST['competition_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_text_field($_POST['email']);
    $phone = absint($_POST['phone']);
    $description = sanitize_text_field($_POST['description']);

    // Create new entry post
    $entry_post = array(
        'post_title'    => $first_name,
        'post_type'     => 'entries',
        'post_status'   => 'publish',
    );

    $entry_post_id = wp_insert_post($entry_post);

    // Add meta fields
    update_post_meta($entry_post_id, '_entry_competition_id', $competition_id);
    update_post_meta($entry_post_id, '_entry_first_name', $first_name);
    update_post_meta($entry_post_id, '_entry_last_name', $last_name);
    update_post_meta($entry_post_id, '_entry_email', $email);
    update_post_meta($entry_post_id, '_entry_phone', $phone);
    update_post_meta($entry_post_id, '_entry_description', $description);

    if ($entry_post_id) {
        echo 'Entry submitted successfully!';
    } else {
        echo 'Error submitting entry.';
    }

    wp_die();
}

// fixed permalink issue.
function flush_permalinks_on_competition_list_visit() {
    global $wp;

    
    if (is_page('competition-list')) {

        // Check if the flushing has already been done
        $flushed_flag = get_option('competition_list_flushed', false);

        if (!$flushed_flag) {
         
            flush_rewrite_rules();

            // Set the flag to indicate that flushing has been done
            update_option('competition_list_flushed', true);
        }
    }
}

// Hook the function to an action that is triggered on every page load
add_action('wp', 'flush_permalinks_on_competition_list_visit');
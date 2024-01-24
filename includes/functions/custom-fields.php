<?php
// Add custom fields to 'Entries' post type
function trpia_add_entries_custom_fields() {
    add_meta_box(
        'entries_custom_fields',   
        'Entry Details',           
        'trpia_display_entries_custom_fields', 
        'entries',                 
        'normal',                 
        'high'         
    );
}

add_action('add_meta_boxes', 'trpia_add_entries_custom_fields');

// Display custom fields in 'Entries' post type in a single column
function trpia_display_entries_custom_fields($post) {
    $first_name = get_post_meta($post->ID, '_entry_first_name', true);
    $last_name = get_post_meta($post->ID, '_entry_last_name', true);
    $email = get_post_meta($post->ID, '_entry_email', true);
    $phone = get_post_meta($post->ID, '_entry_phone', true);
    $description = get_post_meta($post->ID, '_entry_description', true);
    $competition_id = get_post_meta($post->ID, '_entry_competition_id', true);

    ?>
   <div class="entry-custom-field-section">
        <div class="custom-field-item">
            <label for="entry_first_name">First Name:</label>
            <input type="text" id="entry_first_name" name="entry_first_name" value="<?php echo esc_attr($first_name); ?>" />
        </div>

        <div class="custom-field-item">
            <label for="entry_last_name">Last Name:</label>
            <input type="text" id="entry_last_name" name="entry_last_name" value="<?php echo esc_attr($last_name); ?>" />
        </div>

        <div class="custom-field-item">
            <label for="entry_email">Email:</label>
            <input type="email" id="entry_email" name="entry_email" value="<?php echo esc_attr($email); ?>" />
        </div>

        <div class="custom-field-item">
            <label for="entry_phone">Phone:</label>
            <input type="tel" id="entry_phone" name="entry_phone" value="<?php echo esc_attr($phone); ?>" />
        </div>

        <div class="custom-field-item">
            <label for="entry_description">Description:</label>
            <textarea id="entry_description" name="entry_description"><?php echo esc_textarea($description); ?></textarea>
        </div>

        <div class="custom-field-item">
            <label for="entry_competition_id">Competition ID:</label>
            <input type="text" id="entry_competition_id" name="entry_competition_id" value="<?php echo esc_attr($competition_id); ?>" />
        </div>
   </div>
    <?php
}

// Save custom fields data when 'Entries' post type is saved
function trpia_save_entries_custom_fields($post_id) {
    
    if (isset($_POST['entry_first_name'])) {
        update_post_meta($post_id, '_entry_first_name', sanitize_text_field($_POST['entry_first_name']));
    }
  
    if (isset($_POST['entry_last_name'])) {
        update_post_meta($post_id, '_entry_last_name', sanitize_text_field($_POST['entry_last_name']));
    }

    if (isset($_POST['entry_email'])) {
        update_post_meta($post_id, '_entry_email', sanitize_email($_POST['entry_email']));
    }

    if (isset($_POST['entry_phone'])) {
        update_post_meta($post_id, '_entry_phone', sanitize_text_field($_POST['entry_phone']));
    }

    if (isset($_POST['entry_description'])) {
        update_post_meta($post_id, '_entry_description', sanitize_textarea_field($_POST['entry_description']));
    }

    if (isset($_POST['entry_competition_id'])) {
        update_post_meta($post_id, '_entry_competition_id', sanitize_text_field($_POST['entry_competition_id']));
    }
}

add_action('save_post_entries', 'trpia_save_entries_custom_fields');
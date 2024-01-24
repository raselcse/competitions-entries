<?php
// Shortcode for displaying competition list
function trpia_competition_list_shortcode() {
    $args = array(
        'post_type' => 'competitions',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <div class="competition-item">
                <div class="competition-thumbnail">
                <?php the_post_thumbnail('thumbnail'); ?>
                </div>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>   
                <div class="competition-content">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="read-more-link">Read More</a>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No competitions found.';
    endif;

    return ob_get_clean();
}

add_shortcode('competition_list', 'trpia_competition_list_shortcode');

function trpia_submit_entry_form_shortcode() {
    $post_id_param = isset($_GET['competition_id']) ? absint($_GET['competition_id']) : 0;
    ob_start();
    ?>
    <div class="submit-entry-from-section">
        <form action="#" method="post" id="submit-entry-form">
            <?php
            // Add nonce field
            wp_nonce_field('submit_entry_nonce', 'submit_entry_nonce_field');
            ?>
            <input type="hidden" name="competition_id" id="competition_id" value="<?php echo esc_attr($post_id_param); ?>">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" id="phone" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            <div class="form-group">
                <input type="button" id="submit-entry-btn" value="Submit Entry">
            </div>
            
        </form>

    <div id="submission-response"></div>
</div>
   <?php
    return ob_get_clean();
}

add_shortcode('submit_entry_form', 'trpia_submit_entry_form_shortcode');
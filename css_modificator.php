<?php
/*
Plugin Name: Css modificator
Description: Allow users to edit the CSS of individual posts.
Version: 1.0
Author: Luca
*/

// Enqueue the CSS editor script
function enqueue_custom_css_editor() {
    if (is_single()) {
        wp_enqueue_script('custom-css-editor', plugins_url('custom-css-editor.js', __FILE__), array('jquery'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_css_editor');

// Add a custom CSS textarea to the post editor
function add_custom_css_meta_box() {
    add_meta_box('custom-css', 'Custom CSS', 'render_custom_css_meta_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_custom_css_meta_box');

function render_custom_css_meta_box($post) {
    $custom_css = get_post_meta($post->ID, 'custom_css', true);
    ?>
    <textarea name="custom-css" id="custom-css" rows="10" style="grille_de_courswidth: 100%;"><?php echo esc_textarea($custom_css); ?></textarea>
    <?php
}

// Save the custom CSS when the post is saved
function save_custom_css($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

    if (isset($_POST['custom-css'])) {
        update_post_meta($post_id, 'custom_css', $_POST['custom-css']);
    }
}
function enfiler_script_css2()
{
   $version_css =  filemtime(plugin_dir_path(__FILE__) . 'style.scss');
   $version_js = filemtime(plugin_dir_path(__FILE__) . 'js/custom-css-editor.js');
   wp_enqueue_style('style_carrousel',
        plugin_dir_url(__FILE__) . 'style.scss',
        array(),
        $version_css
);
    wp_enqueue_script('custom-css-editor.js',
            plugin_dir_url(__FILE__) . 'js/custom-css-editor.js',
            array(),
            $version_js,
            true
    );
    

}
add_action('wp_enqueue_scripts', 'enfiler_script_css2' );
add_action('save_post', 'save_custom_css');
<?php
/*
Plugin Name: Ancreninator
Description: Ajoute une ancre html au article choisie
Version: 1.0
Author: Luca
*/



// Ajoute un champ d'ancrage après le titre dans l'éditeur d'articles
function custom_anchor_meta_box() {
    add_meta_box(
        'custom_anchor_meta_box',
        'Ajouter une ancre à cet article',
        'custom_anchor_meta_box_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('edit_form_after_title', 'custom_anchor_meta_box');

// Affiche le champ de case à cocher
function custom_anchor_meta_box_callback($post) {
    $value = get_post_meta($post->ID, '_custom_anchor', true);
    ?>
    <label for="custom_anchor">
        <input type="checkbox" name="custom_anchor" id="custom_anchor" <?php checked($value, 'on'); ?>>
        Ajouter une ancre avec le nom de l'article
    </label>
    <?php
}

// Enregistre la valeur du champ
function save_custom_anchor_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['custom_anchor'])) {
        update_post_meta($post_id, '_custom_anchor', 'on');
    } else {
        delete_post_meta($post_id, '_custom_anchor');
    }
}
add_action('save_post', 'save_custom_anchor_meta_box');

// Ajoute l'ancrage si la case est cochée
function add_custom_anchor_to_content($content) {
    global $post;
    $value = get_post_meta($post->ID, '_custom_anchor', true);
    
    if ($value === 'on') {
        $content = '<a name="' . sanitize_title($post->post_title) . '"></a>' . $content;
    }

    return $content;
}
add_filter('the_content', 'add_custom_anchor_to_content');
?>

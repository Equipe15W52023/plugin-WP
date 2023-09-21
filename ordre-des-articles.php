<?php
/**
 * Plugin Name: Organisateur des articles
 * Description: Plugin pour sélectionner l'ordre des articles.
 * Version: 1.0
 * Author: Luca Ruggeri (en collaboration avec ChatGPT)
 */

// Fonction pour ajouter des champs de commande d'ordre aux articles
function custom_post_order_metabox() {
    add_meta_box('custom_post_order', 'Ordre de l\'article', 'custom_post_order_callback', 'post', 'side', 'default');
}

// Fonction de callback pour l'affichage du champ de commande d'ordre
function custom_post_order_callback($post) {
    $order = get_post_meta($post->ID, 'custom_post_order', true);
    ?>
    <label for="custom_post_order">Ordre : </label>
    <input type="number" name="custom_post_order" id="custom_post_order" value="<?php echo esc_attr($order); ?>" />
    <?php
}

// Fonction pour enregistrer la valeur de l'ordre
function custom_post_order_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return $post_id;
    
    if (isset($_POST['custom_post_order'])) {
        update_post_meta($post_id, 'custom_post_order', sanitize_text_field($_POST['custom_post_order']));
    }
}

// Fonction pour personnaliser la requête et trier les articles par ordre
function custom_post_order_query($query) {
    if (is_home() && $query->is_main_query()) {
        $query->set('orderby', 'meta_value_num');
        $query->set('meta_key', 'custom_post_order');
        $query->set('order', 'ASC');
    }
}

// Ajouter des actions WordPress
add_action('add_meta_boxes', 'custom_post_order_metabox');
add_action('save_post', 'custom_post_order_save');
add_action('pre_get_posts', 'custom_post_order_query');

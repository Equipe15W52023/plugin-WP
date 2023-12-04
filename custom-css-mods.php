<?php
/*
Plugin Name: Custom CSS Mods
Description: Plugin pour gérer les styles CSS personnalisés pour chaque article.
Version: 1.5
Author: Luca
*/

// Ajouter une page d'administration personnalisée
function custom_css_menu_page() {
    add_menu_page(
        'CSS Personnalisé',
        'CSS Personnalisé',
        'manage_options',
        'custom-css-menu-page',
        'display_custom_css_menu_page',
        'dashicons-admin-generic', // icône facultative
        99 // position dans le menu
    );
}

add_action('admin_menu', 'custom_css_menu_page');

// Afficher la page d'administration
function display_custom_css_menu_page() {
    ?>
    <div class="wrap">
        <h1>CSS Personnalisé</h1>
        <form method="post" action="options.php">
            <?php settings_fields('custom-css-settings'); ?>
            <?php do_settings_sections('custom-css-settings'); ?>
            <?php submit_button(); ?>
        </form>

        <h2>Articles dans la catégorie "principal"</h2>
        <ul>
            <?php
            $args = array(
                'category_name' => 'principal',
                'posts_per_page' => -1,
            );

            $articles = get_posts($args);

            foreach ($articles as $article) {
                $article_id = $article->ID;
                ?>
                <li>
                    <strong><?php echo esc_html($article->post_title); ?></strong>
                    <form method="post" action="">
                        <?php wp_nonce_field('update_custom_css', 'custom_css_nonce'); ?>
                        <input type="hidden" name="article_id" value="<?php echo esc_attr($article_id); ?>">

                        <!-- Ajouter des champs pour chaque propriété CSS -->
                        <label for="background_color">Couleur de fond :</label>
                        <input type="color" name="background_color" value="<?php echo esc_attr(get_post_meta($article_id, 'background_color', true)); ?>">

                        <label for="text_color">Couleur du texte :</label>
                        <input type="color" name="text_color" value="<?php echo esc_attr(get_post_meta($article_id, 'text_color', true)); ?>">

                        <label for="animation">Animation :</label>
                        <input type="text" name="animation" value="<?php echo esc_attr(get_post_meta($article_id, 'animation', true)); ?>">

                        <label for="background_image">Image de fond :</label>
                        <input type="text" name="background_image" value="<?php echo esc_attr(get_post_meta($article_id, 'background_image', true)); ?>">

                        <input type="submit" name="update_custom_css" value="Mettre à jour le CSS">
                    </form>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}

// Ajouter des sections et des champs au formulaire
function custom_css_settings() {
    add_settings_section(
        'custom-css-section',
        'Styles CSS Personnalisés',
        '__return_false',
        'custom-css-settings'
    );

    add_settings_field(
        'custom-css-field',
        'Styles CSS',
        'display_custom_css_field',
        'custom-css-settings',
        'custom-css-section'
    );
}

add_action('admin_init', 'custom_css_settings');

// Afficher le champ de style CSS
function display_custom_css_field() {
    $custom_css = get_option('custom_css_setting', '');
    ?>
    <textarea name="custom_css_setting" rows="10" cols="50"><?php echo esc_textarea($custom_css); ?></textarea>
    <?php
}

// Sauvegarder les options
function register_custom_css_setting() {
    register_setting('custom-css-settings', 'custom_css_setting');
}

add_action('admin_init', 'register_custom_css_setting');

// Appliquer les styles CSS dans le head du site
function apply_custom_css() {
    if (is_single()) {
        $article_id = get_the_ID();

        // Récupérer les propriétés CSS spécifiques à chaque article
        $background_color = get_post_meta($article_id, 'background_color', true);
        $text_color = get_post_meta($article_id, 'text_color', true);
        $animation = get_post_meta($article_id, 'animation', true);
        $background_image = get_post_meta($article_id, 'background_image', true);

        // Construire le style CSS spécifique à l'article
        $custom_css_article = "
            background-color: $background_color;
            color: $text_color;
            animation: $animation;
            background-image: url('$background_image');
        ";

        if (!empty($custom_css_article)) {
            echo '<style type="text/css">' . wp_kses_post($custom_css_article) . '</style>';
        }
    } else {
        $custom_css = get_option('custom_css_setting', '');

        if (!empty($custom_css)) {
            echo '<style type="text/css">' . wp_kses_post($custom_css) . '</style>';
        }
    }
}

add_action('wp_head', 'apply_custom_css');

// Enregistrer le CSS personnalisé pour chaque article
function save_custom_css_mods() {
    if (isset($_POST['update_custom_css']) && isset($_POST['custom_css_nonce']) && wp_verify_nonce($_POST['custom_css_nonce'], 'update_custom_css')) {
        $article_id = sanitize_text_field($_POST['article_id']);

        // Enregistrez chaque propriété CSS dans les métadonnées de l'article
        update_post_meta($article_id, 'background_color', sanitize_text_field($_POST['background_color']));
        update_post_meta($article_id, 'text_color', sanitize_text_field($_POST['text_color']));
        update_post_meta($article_id, 'animation', sanitize_text_field($_POST['animation']));
        update_post_meta($article_id, 'background_image', esc_url_raw($_POST['background_image']));
    }
}

add_action('admin_init', 'save_custom_css_mods');
?>

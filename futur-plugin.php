<?php
/*
Plugin Name: Futur Plugin
Description: Extension pour afficher la liste des articles de la catégorie "Futur" à l'aide d'un shortcode.
Version: 1.1
Author: Sharly
*/

// Fonction pour afficher la liste des articles de la catégorie "Futur"
function afficher_articles_futur() {
    $args = array(
        'category_name' => 'Futur',
        'posts_per_page' => -1
    );

    $futur = new WP_Query($args);

    if ($futur->have_posts()) {
        echo '<div class="sections-futur">';

        while ($futur->have_posts()) {
            $futur->the_post();

            $futur_titre = get_the_title();
            $futur_contenu = wp_strip_all_tags( get_the_content() );
            // $futur_contenu = get_field('contenu');
            $futur_desc = get_field('description');

            echo '<div class="section-futur">';
            echo '<h2>' . esc_html($futur_titre) . '</h2>';
            echo '<p class="desc-futur">' . esc_html($futur_desc) . '</p>';
            echo '<div class="texte-futur">';
            echo '<h2>' . esc_html($futur_titre) . '</h2>';
            echo '<p>' . esc_html($futur_contenu) . '<p>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
}

// Créez un shortcode pour afficher la liste des articles de la catégorie "Futur"
function shortcode_afficher_articles_futur($atts) {
    ob_start(); // Démarrez la mémoire tampon de sortie
    afficher_articles_futur(); // Affichez la liste des articles de la catégorie "Futur"
    $futur_content = ob_get_clean(); // Récupérez le contenu de la mémoire tampon
    return $futur_content;
}

add_shortcode('afficher_futur', 'shortcode_afficher_articles_futur');

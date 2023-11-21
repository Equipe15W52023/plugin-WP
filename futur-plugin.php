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

            echo '<div class="section-futur section-ferme">';
            echo '<h2>' . esc_html($futur_titre) . '</h2>';
            echo '<p class="desc-futur">' . esc_html($futur_desc) . '</p>';
            echo '<div class="texte-futur">';
            echo '<span class="bouton-x-futur">' . '</span>';
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

/*
 filemtime() // retourne en milliseconde le temps de la dernière sauvegarde
plugin_dir_path() // retourne le chemin du répertoire du plugin
__FILE__ // une constante contenant le chemin du fichier en train de s'exécuter
wp_enqueue_style() // Intègre le link:css dans la page
wp_enqueue_script() // intègre le script dans la page
wp_enqueue_scripts // le hook qui permettra d'enfiler le css et le script
*/

function enfiler_script_css_futur()
{
   $version_js = filemtime(plugin_dir_path(__FILE__) . 'js/futur.js');
    wp_enqueue_script('futur.js',
            plugin_dir_url(__FILE__) . 'js/futur.js',
            array(),
            $version_js,
            true
    );
}
add_action('wp_enqueue_scripts', 'enfiler_script_css_futur' );
add_shortcode('afficher_futur', 'shortcode_afficher_articles_futur');

<?php
/*
Plugin Name: Grille de Cours
Description: Un plugin pour afficher des articles de la catégorie "Cours".
Version: 1.2
Author: Luca Ruggeri
*/
error_reporting(0);

function mon_plugin_shortcode() {
    // Commencez à construire le contenu du shortcode
    $shortcode_content = '<div class="session-buttons">';
    // Boucle pour afficher les boutons de session
    $sessions = array('Session 1', 'Session 2', 'Session 3', 'Session 4', 'Session 5', 'Session 6'); // Liste des sessions
    foreach ($sessions as $key => $session) {
        $shortcode_content .= '<button class="session-button" data-session="' . ($key + 1) . '">';
        $shortcode_content .= '<span class="nom-session-button bouton-ferme" data-session="' . ($key + 1) . '">Session ' . '</span>';
        $shortcode_content .= '<span class="num-session-button" data-session="' . ($key + 1) . '">' . ($key + 1) . '</span>';
        $shortcode_content .= '</button>';
    }
    $shortcode_content .= '</div>';

    // Ajoutez une div pour le contenu des sessions
    $shortcode_content .= '<div class="sessions-container">';
    
    foreach ($sessions as $session) {
        // Récupération des articles de la catégorie "Cours" et de la session actuelle
        $sessionCategory = $session; // Utilisez une variable distincte
        $args = array(
            'post_type' => 'post',
            'category_name' => 'cours', // Catégorie "Cours"
            'posts_per_page' => -1,
            'category_name' => $sessionCategory, // Utilisez la variable distincte
        );
    

        $query = new WP_Query($args);

        // Vérifiez s'il y a des articles pour cette session
        if ($query->have_posts()) {
            $shortcode_content .= '<div class="session">';
            $shortcode_content .= '<h2>' . esc_html($session) . '</h2>'; // Titre de la session
            while ($query->have_posts()) : $query->the_post();
                // Obtenez le titre de l'article
                $article_title = get_the_title();
                $article_content = get_the_content();


                // Ajoutez chaque article dans une div nommée "cours"
                $shortcode_content .= '<div class="cours cours-ferme">';
                $shortcode_content .= '<h3>' . $article_title . '</h3>';
                $shortcode_content .= '<div class="texte-cours">';
                $shortcode_content .= '<span class="bouton-x">' . '</span>';
                $shortcode_content .= '<h3>' . $article_title . '</h3>';
                $shortcode_content .= '<p>' . $article_content . '</p>';
                $shortcode_content .= '</div>';
                $shortcode_content .= '</div>';
            endwhile;
            $shortcode_content .= '</div>';
        }
        
        // Réinitialisez la requête personnalisée pour la prochaine session
        wp_reset_postdata();
    }

    // Terminez la div des sessions
    $shortcode_content .= '</div>';

    // Retournez le contenu du shortcode
    return $shortcode_content;
}


/*
 filemtime() // retourne en milliseconde le temps de la dernière sauvegarde
plugin_dir_path() // retourne le chemin du répertoire du plugin
__FILE__ // une constante contenant le chemin du fichier en train de s'exécuter
wp_enqueue_style() // Intègre le link:css dans la page
wp_enqueue_script() // intègre le script dans la page
wp_enqueue_scripts // le hook qui permettra d'enfiler le css et le script
*/

function enfiler_script_css()
{
   $version_css =  filemtime(plugin_dir_path(__FILE__) . 'style.scss');
   $version_js = filemtime(plugin_dir_path(__FILE__) . 'js/grille_de_cours.js');
   wp_enqueue_style('style_carrousel',
        plugin_dir_url(__FILE__) . 'style.scss',
        array(),
        $version_css
);
    wp_enqueue_script('grille_de_cours.js',
            plugin_dir_url(__FILE__) . 'js/grille_de_cours.js',
            array(),
            $version_js,
            true
    );
    

}
add_action('wp_enqueue_scripts', 'enfiler_script_css' );
add_shortcode('mon_shortcode', 'mon_plugin_shortcode');
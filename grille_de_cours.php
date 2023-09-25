<?php
/*
Plugin Name: Grille de Cours
Description: Un plugin pour afficher des articles de la catégorie "Cours".
Version: 1.0
Author: Luca Ruggeri
*/

function mon_plugin_shortcode() {
    // Commencez à construire le contenu du shortcode
    $shortcode_content = '<div class="sessions-container">';

    // Boucle pour afficher les sessions
    $sessions = array('Session 1', 'Session 2', 'Session 3', 'Session 4', 'Session 5', 'Session 6'); // Liste des sessions

    foreach ($sessions as $session) {
        // Récupération des articles de la catégorie "Cours" et de la session actuelle
        $args = array(
            'post_type' => 'post',
            'category_name' => 'cours', // Catégorie "Cours"
            'posts_per_page' => -1,
            'category_name' => $session, // Catégorie de session actuelle
        );

        $query = new WP_Query($args);

        // Vérifiez s'il y a des articles pour cette session
        if ($query->have_posts()) {
            $shortcode_content .= '<div class="session">';
            $shortcode_content .= '<h2>' . esc_html($session) . '</h2>'; // Titre de la session
            while ($query->have_posts()) : $query->the_post();
                // Obtenez le titre de l'article
                $article_title = get_the_title();
                // Obtenez le contenu de l'article
                $article_content = get_the_content();

                // Ajoutez chaque article dans une div nommée "cours"
                $shortcode_content .= '<div class="cours">';
                $shortcode_content .= '<h3>' . $article_title . '</h3>';
                $shortcode_content .= '<p>' . $article_content . '</p>';
                $shortcode_content .= '</div>';
            endwhile;
            $shortcode_content .= '</div>';
        }
        
        // Réinitialisez la requête personnalisée pour la prochaine session
        wp_reset_postdata();
    }

    // Terminez la div des sessions
    $shortcode_content .= '</div>';

    // Ajoutez des boutons pour basculer entre les sessions
    $shortcode_content .= '<div class="session-buttons">';
    foreach ($sessions as $key => $session) {
        $shortcode_content .= '<button class="session-button" data-session="' . ($key + 1) . '">Session ' . ($key + 1) . '</button>';
    }
    $shortcode_content .= '</div>';

    // Retournez le contenu du shortcode
    return $shortcode_content;
}

add_shortcode('mon_shortcode', 'mon_plugin_shortcode');
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
    var sessionButtons = document.querySelectorAll('.session-button');
    var sessions = document.querySelectorAll('.session');

    // Fonction pour masquer toutes les sessions
    function hideAllSessions() {
        sessions.forEach(function (session) {
            session.style.display = 'none';
        });
    }

    // Par défaut, masquez toutes les sessions sauf la première
    hideAllSessions();
    sessions[0].style.display = 'block';

    // Ajoutez des gestionnaires d'événements aux boutons
    sessionButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Obtenez le numéro de session à afficher à partir de l'attribut "data-session"
            var sessionNumber = button.getAttribute('data-session');

            // Masquez toutes les sessions
            hideAllSessions();

            // Affichez la session correspondante
            var sessionToShow = document.querySelector('.session:nth-child(' + sessionNumber + ')');
            sessionToShow.style.display = 'block';
        });
    });
});
</script>

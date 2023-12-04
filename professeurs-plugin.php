<?php
/*
Plugin Name: Professeurs Plugin
Description: Extension pour afficher la liste des articles de la catégorie "Prof" à l'aide d'un shortcode.
Version: 2.0
Author: Luca
*/

// Fonction pour afficher la liste des articles de la catégorie "Prof"
function afficher_articles_prof() {
    $args = array(
        'category_name' => 'Prof',
        'posts_per_page' => -1
    );

    $professeurs = new WP_Query($args);

    if ($professeurs->have_posts()) {
        echo '<div class="Section-prof">';

        while ($professeurs->have_posts()) {
            $professeurs->the_post();

            $nom_professeur = get_field('nom_du_professeur');
            $matiere = get_field('matiere');
            $experience = get_field('experience');

            // Récupérer l'URL de l'image directement avec ACF
            $image_prof_url = get_field('image_prof');

            // Récupérer les valeurs spécifiques à chaque article avec get_post_meta
            $couleur_fond = get_post_meta(get_the_ID(), 'couleur_fond_article', true);
            $couleur_texte = get_post_meta(get_the_ID(), 'couleur_texte_article', true);
            
            // Appliquer les styles CSS en fonction des valeurs spécifiques à chaque article
            echo '<div class="professeur" style="background-color: ' . esc_attr($couleur_fond) . '; color: ' . esc_attr($couleur_texte) . ';">';

            // Afficher l'image à gauche du texte
            if (!empty($image_prof_url)) {
                echo '<img src="' . esc_url($image_prof_url) . '" alt="' . esc_attr($nom_professeur) . '" style="max-width: 100px; margin-right: 10px;">';
            }

            echo '<h2>' . esc_html($nom_professeur) . '</h2>';
            echo '<p><strong>Matière :</strong> ' . esc_html($matiere) . '</p>';
            echo '<p><strong>Expérience :</strong> ' . esc_html($experience) . '</p>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo 'Aucun professeur trouvé.';
    }
}

// Créez un shortcode pour afficher la liste des articles de la catégorie "Prof"
function shortcode_afficher_articles_professeurs($atts) {
    ob_start(); // Démarrez la mémoire tampon de sortie
    afficher_articles_prof(); // Affichez la liste des articles de la catégorie "Prof"
    $professeurs_content = ob_get_clean(); // Récupérez le contenu de la mémoire tampon
    return $professeurs_content;
}

add_shortcode('afficher_professeurs', 'shortcode_afficher_articles_professeurs');
?>

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
        'category_name'   => 'Prof',
        'posts_per_page'  => -1
    );

    $professeurs = new WP_Query($args);

    if ($professeurs->have_posts()) {
        echo '<div class="Section-prof">';

        while ($professeurs->have_posts()) {
                // Récupérer la valeur de la palette sélectionnée
    $palette_selectionnee = get_field('palette_couleurs') ;
    if (empty($palette_selectionnee)) {
        echo 'Erreur : Palette non définie.';
    }
    


    // Définir les palettes de couleurs
    $palettes_couleurs = array(
        'palette1' => array('fond' => '#0E3D6D', 'texte' => '#E8E8E8'),
        'palette2' => array('fond' => '#1B72A6', 'texte' => '#1F1F1F'),
        'palette3' => array('fond' => '#F06543', 'texte' => '#E8E8E8')
    );

    // Utiliser la palette sélectionnée ou la première par défaut
    $palette = isset($palettes_couleurs[$palette_selectionnee]) ? $palettes_couleurs[$palette_selectionnee] : $palettes_couleurs['palette2'];

            $professeurs->the_post();

            $nom_professeur = get_field('nom_du_professeur');
            $matiere        = get_field('matiere');
            $experience     = get_field('experience');

            $image_prof_url = get_field('image_prof');

            $couleur_fond  = $palette['fond'];
            $couleur_texte = $palette['texte'];

            echo '<div class="professeur" style="background-color: ' . esc_attr($couleur_fond) . '; color: ' . esc_attr($couleur_texte) . ';">';

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

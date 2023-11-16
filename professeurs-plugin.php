<?php
/*
Plugin Name: Professeurs Plugin
Description: Extension pour afficher la liste des articles de la catégorie "Prof" à l'aide d'un shortcode.
Version: 1.2
Author: Luca
*/

// Fonction pour afficher la liste des articles de la catégorie "Prof"
function afficher_articles_prof() {
    $background_color = get_option('professeurs_background_color', '#ffffff');
    $text_color = get_option('professeurs_text_color', '#000000');

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

            // Appliquer les styles CSS en fonction des options de couleur
            echo '<div class="professeur" style="background-color: ' . esc_attr($background_color) . '; color: ' . esc_attr($text_color) . ';">';
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

// Ajouter une page d'administration
function ajouter_page_administration_professeurs() {
    add_menu_page(
        'Paramètres Professeurs',   // Titre de la page
        'Professeurs Plugin',        // Nom dans le menu
        'manage_options',            // Capacité nécessaire pour accéder à la page
        'parametres_professeurs',    // Slug de la page
        'afficher_page_administration_professeurs' // Fonction pour afficher le contenu de la page
    );

    // Enregistrez les options
    add_action('admin_init', 'enregistrer_options_professeurs');
}

add_action('admin_menu', 'ajouter_page_administration_professeurs');

// Fonction pour afficher le contenu de la page d'administration
function afficher_page_administration_professeurs() {
    ?>
    <div class="wrap">
        <h1>Paramètres Professeurs</h1>
        <form method="post" action="options.php">
            <?php settings_fields('professeurs-settings-group'); ?>
            <?php do_settings_sections('professeurs-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Couleur de fond</th>
                    <td><input type="color" name="professeurs_background_color" value="<?php echo esc_attr(get_option('professeurs_background_color', '#ffffff')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Couleur du texte</th>
                    <td><input type="color" name="professeurs_text_color" value="<?php echo esc_attr(get_option('professeurs_text_color', '#000000')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Fonction pour enregistrer les options
function enregistrer_options_professeurs() {
    register_setting('professeurs-settings-group', 'professeurs_background_color', array(
        'type' => 'string',
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    register_setting('professeurs-settings-group', 'professeurs_text_color', array(
        'type' => 'string',
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    add_settings_section('professeurs-colors', 'Couleurs Professeurs', '', 'professeurs-settings-group');

    add_settings_field('professeurs-background-color', 'Couleur de fond', 'afficher_champ_couleur_background', 'professeurs-settings-group', 'professeurs-colors');

    add_settings_field('professeurs-text-color', 'Couleur du texte', 'afficher_champ_couleur_texte', 'professeurs-settings-group', 'professeurs-colors');
}

function afficher_champ_couleur_background() {
    $value = get_option('professeurs_background_color', '#ffffff');
    echo '<input type="color" name="professeurs_background_color" value="' . esc_attr($value) . '" />';
}

function afficher_champ_couleur_texte() {
    $value = get_option('professeurs_text_color', '#000000');
    echo '<input type="color" name="professeurs_text_color" value="' . esc_attr($value) . '" />';
}

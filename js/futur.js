document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
    var sectionsFutur = document.querySelectorAll('.section-futur');
    // var boutonsPlus = document.querySelectorAll('.bouton-plus');

    // ÉCOUTEURS D'ÉVÉNEMENTS
    // Ajouter des gestionnaires d'événements aux sections 'futur' pour afficher le contenu
    sectionsFutur.forEach(function (section) {
        section.addEventListener('mousedown', function () {
           console.log('X_X');
            // Si la section n'est pas affiché, on l'affiche 
            if(!section.classList.contains('texte-futur-selection')) {
                // Faire apparaitre le contenu des cours en changeant les classes de l'élément
                desactiverSection();
                section.classList.add('texte-futur-selection');
                section.classList.remove('section-ferme');
            } else { // si la section est affichée
                // Enlever l'affichage du contenu séléctionné
                var boutonX = document.querySelector('.texte-futur-selection .bouton-x-futur');
                boutonX.addEventListener('click', function () {
                    console.log('Xx_xX');
                    desactiverSection();
                });
            }
        });
    });


    // FONCTIONS
    // Fonction pour enlever la classe 'cours-selection' des cours non séléctionné
    function desactiverSection() {
        sectionsFutur.forEach(function (section) {
            console.log('-_-');
            section.classList.add('section-ferme');
            section.classList.remove('texte-futur-selection');
        });
    }
});
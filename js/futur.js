document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
    var sectionsFutur = document.querySelectorAll('.section-futur');
    var boutonsPlus = document.querySelectorAll('.bouton-plus');

    // ÉCOUTEURS D'ÉVÉNEMENTS
    // Ajoutez des gestionnaires d'événements au boutons 'plus'
    boutonsPlus.forEach(function (bouton) {
        bouton.addEventListener('mousedown', function () {
            console.log('+_+');
            desactiverSection();
        });
    });

    sectionsFutur.forEach(function (section) {
        section.addEventListener('mousedown', function () {
           console.log('X_X');
            // Si la section n'est pas affiché, on l'affiche 
            if(!section.classList.contains('texte-futur-selection')) {
                // Faire apparaitre le contenu des cours en changeant les classes de l'élément
                var texteFutur = document.querySelector('.texte-futur');
                texteFutur.classList.add('texte-futur-selection');
                section.classList.remove('texte-futur');
            } else { // si la section est affichée
                // Enlever l'affichage du contenu séléctionné
                var boutonX = document.querySelector('.bouton-x-futur');
                boutonX.addEventListener('click', function () {
                    desactiverSection();
                });
            }
        });
    });


    // FONCTIONS
    // Fonction pour enlever la classe 'cours-selection' des cours non séléctionné
    function desactiverSection() {
        sectionsFutur.forEach(function (section) {
            section.classList.add('section-ferme');
            section.classList.remove('texte-futur-selection');
        });
    }
});
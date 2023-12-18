document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
    var backgroundClick = document.querySelector('.background-click');
    var sectionsFutur = document.querySelectorAll('.section-futur');   
    var textesFutur = document.querySelectorAll('.texte-futur'); 
      
    // var corps = document.querySelector('.home');   


    // ÉCOUTEURS D'ÉVÉNEMENTS
    // Ajouter des gestionnaires d'événements aux sections 'futur' pour afficher le contenu
    sectionsFutur.forEach(function (section) {
        section.addEventListener('mousedown', function () {
            
            // Si la section n'est pas affiché, on l'affiche 
            if(!section.classList.contains('texte-futur-selection')) {
                // Faire apparaitre le contenu des cours en changeant les classes de l'élément
                desactiverSection();
                section.classList.toggle('texte-futur-selection');
                section.classList.toggle('section-ferme');

                // Augmenter le z-index de la div "background-click" pour fermer les sections en cliquant n'importe où
                if(section.classList.contains('texte-futur-selection')) {
                    backgroundClick.classList.add('index-plus');
                } else {
                    backgroundClick.classList.remove('index-plus');
                }

                // Appeler l'animation d'affichage
                textesFutur.forEach(function (texteFutur) {
                    if(texteFutur.classList.contains('agrandissement')) {
                        texteFutur.classList.remove('agrandissement');
                        texteFutur.classList.add('agrandissement');
                    } else {
                        texteFutur.classList.add('agrandissement');
                    }
                });
                
            } else { // si la section est affichée
                // Enlever l'affichage du contenu séléctionné
                section.classList.toggle('texte-futur-selection');
                section.classList.toggle('section-ferme');    
                introFutur.classList.toggle('intro-ferme');            
                introTitreFutur.classList.toggle('intro-ferme');            
            }
        });
    });

    // Fermer les sections en cliquant n'importe où
    sectionsFutur.forEach(function (section) {
        backgroundClick.addEventListener('mousedown', function (){
            if(section.classList.contains('texte-futur-selection')) {
                backgroundClick.classList.add('index-plus');
            } else {
                backgroundClick.classList.remove('index-plus');
            }

            section.classList.add('section-ferme');
            section.classList.remove('texte-futur-selection');
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
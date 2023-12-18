document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
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
    

    // FONCTIONS
    // Fonction pour enlever la classe 'cours-selection' des cours non séléctionné
    function desactiverSection() {
        sectionsFutur.forEach(function (section) {
            section.classList.add('section-ferme');
            section.classList.remove('texte-futur-selection');
        });
    }
});
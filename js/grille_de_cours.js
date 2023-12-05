document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
    var sessionButtons = document.querySelectorAll('.session-button');
    var titresSessionButtons = document.querySelectorAll('.nom-session-button');
    var sessions = document.querySelectorAll('.session');
    var sessionCours = document.querySelectorAll('.cours');

    // Fonction pour masquer toutes les sessions
    function hideAllSessions() {
        sessions.forEach(function (session) {
            session.style.display = 'none';
        });
    }

    // ÉLÉMENTS PAR DÉFAUT
    // Par défaut, masquez toutes les sessions sauf la première
    hideAllSessions();
    sessions[0].style.display = 'flex';

    // Par défaut, afficher le bouton de la session 1 comme séléctionné
    sessionButtons[0].classList.add('selection');

    // Enlever l'affichage des titre 'session' des boutons lorsque'ils ne sont pas séléctionné
    // Par défaut, afficher le titre complet du bouton de la session 1
    titresSessionButtons[0].classList.add('bouton-ouvert');


    // ÉCOUTEURS D'ÉVÉNEMENTS
    // Ajoutez des gestionnaires d'événements aux boutons
    sessionButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Obtenez le numéro de session à afficher à partir de l'attribut "data-session"
            var sessionNumber = button.getAttribute('data-session');

            // Masquez toutes les sessions
            hideAllSessions();

            // Affichez la session correspondante
            var sessionToShow = document.querySelector('.session:nth-child(' + sessionNumber + ')');
            sessionToShow.style.display = 'flex';

            // Changez le style du bouton séléctionné
            desactiverSelection();
            button.classList.add('selection');

            // Afficher le titre complet du bouton avec le mot 'session' et désactiver le précédent
            // Variable local pour séléctionner le titre du bouton séléctionné
            var titreSession = document.querySelector('.selection .nom-session-button');
            desactiverTitreBouton();
            titreSession.classList.add('bouton-ouvert');

            // Fermé les cours qui pourrais rester affiché en changeant de session
            desactiverCours();
        });
    })

    // Ajouter des gestionnaires d'événements aux cours pour afficher le contenu
    sessionCours.forEach(function (cours) {
        cours.addEventListener('mousedown', function () {
            // Si le cours n'est pas affiché, on l'affiche 
            if(!cours.classList.contains('cours-selection')) {
                // Faire apparaitre le contenu des cours en changeant les classes de l'élément
                desactiverCours();
                cours.classList.toggle('cours-selection');
                cours.classList.toggle('cours-ferme');
            } else { // si le cours est affiché
                // Enlever l'affichage du contenu du cours séléctionné
                cours.classList.toggle('cours-selection');
                cours.classList.toggle('cours-ferme');
            }
        });
    });


    // FONCTIONS
    // Fonction pour enlever la classe 'selection' des boutons sessions non séléctionné
    function desactiverSelection() {
        sessionButtons.forEach(function (button) {
            button.classList.remove('selection');
        });
    }

    // Fonction pour enlever la classe 'cours-selection' des cours non séléctionné
    function desactiverCours() {
        sessionCours.forEach(function (cours) {
            cours.classList.add('cours-ferme');
            cours.classList.remove('cours-selection');
        });
    }

    // Fonction pour enlever la classe 'bouton-ouvert' des boutons non séléctionné
    function desactiverTitreBouton() {
        titresSessionButtons.forEach(function (titre) {
            titre.classList.add('bouton-ferme');
            titre.classList.remove('bouton-ouvert');
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez les éléments nécessaires
    var sessionButtons = document.querySelectorAll('.session-button');
    var sessions = document.querySelectorAll('.session');
    var sessionCours = document.querySelectorAll('.cours');
    var buttonsFermer = document.querySelectorAll('.bouton-fermer');

    // Fonction pour masquer toutes les sessions
    function hideAllSessions() {
        sessions.forEach(function (session) {
            session.style.display = 'none';
        });
    }

    // Par défaut, masquez toutes les sessions sauf la première
    hideAllSessions();
    sessions[0].style.display = 'flex';

    // Par défaut, afficher le bouton de la session 1 comme séléctionné
    sessionButtons[0].classList.add('selection');


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
        });
    })

    // Ajouter des gestionnaires d'événements aux cours
    sessionCours.forEach(function (cours) {
        cours.addEventListener('click', function () {
            // Faire apparaitre le contenu des cours en changeant les classes de l'élément
            desactiverCours();
            cours.classList.add('cours-selection');
            cours.classList.remove('cours-ferme');
        });
    });

    // Enlever l'affichage du contenu séléctionné
    buttonsFermer.forEach(function(boutonX) {
        boutonX.addEventListener('click', function () {
            console.log('X > X');
            desactiverCours();
        });
    });

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
});
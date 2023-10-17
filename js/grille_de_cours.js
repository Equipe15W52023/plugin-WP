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
    sessions[0].style.display = 'flex';

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
        });
    });
});
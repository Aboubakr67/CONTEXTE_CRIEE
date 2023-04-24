// Récupération de l'heure de début de l'enchère et conversion en objet Date
let startTime = new Date('2023-04-14T14:02:00');
// Durée de chaque lot en millisecondes
let lotDuration = 10 * 60 * 1000;
// Calcul de l'heure de fin de l'enchère
let endTime = new Date(startTime.getTime() + lotDuration);

// Fonction pour mettre à jour l'affichage du compte à rebours
function updateCountdown() {
  let now = new Date();
  let timeLeft = endTime.getTime() - now.getTime();
  if (timeLeft < 0) {
    // L'enchère est terminée, afficher un message approprié
    document.getElementById('countdown').innerHTML = 'Enchère terminée.';
  } else {
    // L'enchère est en cours, afficher le compte à rebours
    let minutesLeft = Math.floor(timeLeft / (60 * 1000));
    let secondsLeft = Math.floor((timeLeft - minutesLeft * 60 * 1000) / 1000);
    document.getElementById('countdown').innerHTML = minutesLeft + ':' + secondsLeft.toString().padStart(2, '0');
    setTimeout(updateCountdown, 1000);
  }
}

// Démarrer le compte à rebours
updateCountdown();

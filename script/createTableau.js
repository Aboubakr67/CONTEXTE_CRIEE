// Récupération de tous les checkboxes dans la page
const checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Parcours de tous les checkboxes pour ajouter un événement lorsqu'ils sont cochés
checkboxes.forEach(function(checkbox) {
  checkbox.addEventListener('change', function() {
    if(this.checked) {
      // Récupération de la ligne parente du checkbox
      const row = this.parentNode.parentNode;

      // Récupération des informations de la ligne
      const nomEspece = row.cells[0].textContent;
      const nomBateau = row.cells[1].textContent;
      const nomQualite = row.cells[2].textContent;
      const poidsBrutLot = row.cells[3].textContent;

      // Ajout des informations à un objet JavaScript
      const ligneCochee = {
        nomEspece: nomEspece,
        nomBateau: nomBateau,
        nomQualite: nomQualite,
        poidsBrutLot: poidsBrutLot
      };

      console.log(ligneCochee.nomEspece); // Affichage des informations dans la console
    }
  });
});

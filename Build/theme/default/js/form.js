var nbclic=0  // Initialisation à 0 du nombre de clic
function envoie_form() { // Fonction appelée par le bouton
  nbclic++; // nbclic+1
  if (nbclic>1) { // Plus de 1 clic
     return false;
  } else {        // 1 seul clic
     return true;
  }
}
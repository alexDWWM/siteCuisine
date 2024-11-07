const myModal = document.getElementById('myModal');
const myInput = document.getElementById('myInput');

let form = document.getElementById('formRecette');
let subBtn = document.getElementById('subBtn');
console.log(subBtn)
let modal = document.getElementById('myModal');

subBtn.addEventListener('click', function(e) {
  e.preventDefault();
  
  const nom = document.querySelector('#add_recettes_nom').value
  const image = document.querySelector('#add_recettes_image').value
  const temps = document.querySelector('#add_recettes_temps').value
  const description = document.querySelector('#add_recettes_description').value
  const categorieCheck = Array.from(document.querySelectorAll('input[name="add_recettes[categorie][]"]:checked'))
  .map(checkbox => checkbox.value);
  const difficulte = document.querySelector('input[name="add_recettes[difficulte]"]:checked').value
  const budget = document.querySelector('input[name="add_recettes[budget]"]:checked').value
  const saison = document.querySelector('input[name="add_recettes[saison]"]:checked').value
console.log(saison)
  let donnees = {
    'nom':nom,
    'image':image,
    'temps':temps,
    'description':description,
    'categorie':categorieCheck,
    'difficulte':difficulte,
    'budget':budget,
    'saison':saison,
  }

  fetch("recettes", {
    method: 'POST',
    body: JSON.stringify(donnees)
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {

          modal.show();
          console.log("cool");
      } else {

          alert("Erreur lors de l'enregistrement : " + data.message);
      }
  })
  .catch(error => {
      console.error('Erreur:', error);
      alert("PPP");
  });
});
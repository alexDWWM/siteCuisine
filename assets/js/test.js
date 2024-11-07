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
  const categorieCheck = document.querySelectorAll('input[name="add_recettes[categorie][]"]:checked').value

  const difficulte = document.querySelector('#add_recettes_difficulte').value
  const budget = document.querySelector('#add_recettes_budget').value
  const saison = document.querySelector('#add_recettes_saison').value
  console.log(categorieCheck);
  fetch("recettes", {
    method: 'POST',
    body: formData
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
      alert("Une erreur est survenue lors de l'enregistrement.");
  });
});








// document.addEventListener('DOMContentLoaded', function() {
//   $('#multiTabModal a').on('click', function (e) {
//     e.preventDefault();
//     $(this).tab('show');
//   });
// });
          

// import { Modal } from 'bootstrap';

// document.addEventListener('DOMContentLoaded', () => {
//   const modalTriggerButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
//   modalTriggerButtons.forEach(button => {
//     button.addEventListener('click', () => {
//       const target = button.getAttribute('data-bs-target');
//       const modalElement = document.querySelector(target);
//       const modal = new Modal(modalElement);
//       modal.show();
//     });
//   });
// });
        
    

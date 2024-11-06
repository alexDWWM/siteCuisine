const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})

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
        
    

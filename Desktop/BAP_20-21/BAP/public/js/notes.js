/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/notes.js ***!
  \*******************************/
//Voor iedere note zet een effect op de edit knop
//Haal deze not op en open een modal voor deze te editen
// let edit_note_buttons = document.querySelectorAll('.edit-note-button');
// let baseURL = window.location.origin;
// for(let i = 0; i < edit_note_buttons.length; i ++){
//     edit_note_buttons[i].addEventListener('click', ()=>{
//         document.body.style.overflow = "hidden";
//         document.body.style.height = "100vh";
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//               },
//             type: "POST",
//             url: baseURL + '/specific/note',  
//             data: { 
//                 user_id: edit_note_buttons[i].getAttribute("data-u"),
//                 note_id: edit_note_buttons[i].getAttribute("data-n"),
//             },
//             success: function(response){ // What to do if we succeed
//               let modal = document.getElementById('notes-modal-div');
//               modal.style.display ="flex";
//               modal.innerHTML = "<div id='modal'><div id='modal-close-button'><a href='#' id='close-modal-button'><i class='fas fa-times'></i></a></div><h3>Pas uw notitie aan</h3><textarea id='modal-text-area' required>" + response[0]["content"] + "</textarea><a href='#' data-n='" + response[0]["id"] + "' id='note-edit-submit'>Pas Aan</a></div>";
//               //Sluit modal button
//               let closeButton = document.getElementById('close-modal-button');
//               closeButton.addEventListener('click',(e)=>{
//                 e.preventDefault();
//                 modal.style.display ="none";
//                 document.body.style.overflow = "";
//                 document.body.style.height = "";
//               })
//               //Submit de note edit
//               let submitLink = document.getElementById('note-edit-submit');
//               submitLink.addEventListener('click', (e)=>{
//                 e.preventDefault();
//                 let textarea = document.getElementById('modal-text-area');
//                 if(textarea.value == ''){
//                   modal.style.display ="none";
//                   document.body.style.overflow = "";
//                   document.body.style.height = "";
//                 }else{
//                   //Ajax call op de note edit door te voeren
//                   $.ajax({
//                     headers: {
//                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },
//                     type: "POST",
//                     url: baseURL + '/edit-submit-note/' + edit_note_buttons[i].getAttribute("data-u"), 
//                     data: { 
//                         note_id: response[0]["id"],
//                         note_content: textarea.value,
//                     }, success: function(response){
//                       window.location.reload();
//                     }
//                   })
//                 }
//               })
//             },
//             error: function(response){
//               console.log('Error'+response);
//           }
//         })
//     })
// }
// /* Verwijder alle notes modal */
// let notesContainer = document.getElementById('notes-container')
// if(notesContainer != null){
//     let deleteModalButton = document.getElementById('delete-all-notes-button');
//     let deleteAllModal = document.getElementById('notes-delete-all-modal-div');
//     deleteModalButton.addEventListener('click', ()=>{
//       deleteAllModal.style.display ="flex";
//       document.body.style.overflow = "hidden";
//         document.body.style.height = "100vh";
//       let deleteAllNotesCancel = document.getElementById('cancel-delete-all-notes');
//       deleteAllNotesCancel.addEventListener('click', ()=>{
//         deleteAllModal.style.display ="none";
//         document.body.style.overflow = "";
//         document.body.style.height = "";
//       })
//     });
// }
// Searchbar //
var typingTimer; //timer identifier

var doneTypingInterval = 1000; //time in ms, 1 second for example
//grote searchbar

var input = $('#notes-field'); //kleine searchbar
//on keyup, start the countdown

input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTypingNotes, doneTypingInterval);
}); //on keydown, clear the countdown 

input.on('keydown', function () {
  clearTimeout(typingTimer);
});

function doneTypingNotes() {
  var baseURL = window.location.origin; //Ajax call

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: baseURL + '/notes/noteupload',
    data: {
      note: document.querySelector('#notes-field').value,
      user_id: document.querySelector('#notes-field').getAttribute('data-i')
    },
    success: function success(response) {},
    error: function error(response, request, status, errorThrown) {
      console.log('Error');
      console.log(response);
      console.log(request);
      console.log(status);
      console.log(errorThrown);
    }
  });
}
/******/ })()
;
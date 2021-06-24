/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/pdfdownload.js ***!
  \*************************************/
var button = document.getElementById('download-list-button');
console.log(button);
button.addEventListener('click', function () {
  var doc = new jsPDF(); //create jsPDF object

  doc.fromHTML(document.getElementById("test"), // page element which you want to print as PDF
  15, 15, {
    'width': 170 //set width

  }, function (a) {
    doc.save("HTML2PDF.pdf"); // save file name as HTML2PDF.pdf
  });
});
/******/ })()
;
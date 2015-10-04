/* all hotkeys now in the cmd.js */

// window.onkeydown = window.onkeyup = window.onkeypress = function(e) {
//   if(e.keyCode == 123)
//     e.preventDefault();
//   if (e.ctrlKey)
//     if (e.type == 'keydown' || e.type == 'keypress' || e.type == 'keyup')
//         e.preventDefault();
// }
// window.ondragstart = document.onselectstart = function(e) {
//   e.preventDefault();
//   return false;
// }
// window.oncontextmenu = function(e) {
//   if ($(e.target).is('img') || $(e.target).is('html')) {
//     e.preventDefault();
//     return false;
//   }
// }

// привязка к домену: 
// if(window.location.hostname != $d || window!=window.top) {
//   $('html').css({'display':'none','visibility':'hidden'}).html('');
// }
// Initialisation de CKeditor

// ClassicEditor
//     .create(document.querySelector('#contentEditor'), {

//         fontFamily: {
//             options: [
//                 'default',
//                 'Arial, Helvetica, sans-serif',
//                 'Courier New, Courier, monospace',
//                 'Georgia, serif',
//                 'Lucida Sans Unicode, Lucida Grande, sans-serif',
//                 'Tahoma, Geneva, sans-serif',
//                 'Times New Roman, Times, serif',
//                 'Trebuchet MS, Helvetica, sans-serif',
//                 'Verdana, Geneva, sans-serif'
//             ],
//             supportAllValues: true
//         },
//         // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
//         fontSize: {
//             options: [10, 12, 14, 'default', 18, 20, 22],
//             supportAllValues: true
//         },

//         toolbar: [
//             'undo', 'redo',
//             '|', 'heading',
//             '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
//             '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
//             '|', 'link', 'blockQuote', 'codeBlock',
//             '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
//         ]
//     })
//     .catch(error => {
//         console.error(error);
//     });;


// document.addEventListener('DOMContentLoaded', function () {
//     const dropdownItems = document.querySelectorAll('.chapterInfos > .dropdown-item');
//     dropdownItems.forEach(function (item, index) {
//         item.addEventListener('click', function () {
//             const chapterName = this.dataset.chapterName;
//             const chapterIdeas = this.dataset.chapterIdeas;
//             document.querySelector('#chapitreEnCours').textContent = chapterName;
//             // document.querySelector('#contentEditor').value = chapterIdeas;
//             // CKEDITOR.instances['#contentEditor'].setData('<h1>coucou</h1>')
//             console.log('coucou');
//             console.log(CKEDITOR.instances['#contentEditor']);
//             document.querySelector('#numberOfChapter').textContent = `Chapitre ${index + 1}`;
//         });
//     });
// });


// const config = {
// 	blockToolbar: [ 'paragraph', 'heading1', 'heading2', '|', 'bulletedList', 'numberedList' ]
// 



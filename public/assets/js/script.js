// window.addEventListener('load', function () {
//     console.log('Chargée.');
// });

$(document).ready(function () {
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function () {
        $(this).parent(".card").find(".toggle").addClass("rotate");
    }).on('hide.bs.collapse', function () {
        $(this).parent(".card").find(".toggle").removeClass("rotate");
    });
});


// Mise en surbrillance des personnages nommés dans le text

// function searchNameForCollapse() {
//     let textArea = document.querySelector("#contentIdeas").value.toLowerCase();
//     let indexCaracterId = document.querySelectorAll('.nameCharacter span:first-of-type  ');
//     console.log(indexCaracterId);
//     // let index = [1, 2, 3, 4, 5, 6 ,7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26,];
//     for (let i = 0; i <= indexCaracterId.length; i++) {
//         let firstName = document.querySelector("#character" + i + "FirstName");
//         if (!firstName) {
//             continue;
//         }
//         firstName = firstName.textContent.toLowerCase();
//         if (textArea.toLowerCase().includes(firstName)) {
//             document.querySelector("#character" + i + "FirstName").style.color = 'red';
//         } else {
//             document.querySelector("#character" + i + "FirstName").style.color = 'black';
//         }
//     }
//     console.log("--------------------------");
// }

// document.addEventListener('keydown', function (event) {
//     if (event.code == 'Space') {
//         searchNameForCollapse();
//     }
// });
// searchNameForCollapse();


// function searchNameForCollapse() {
//     let textArea = document.querySelector("#contentIdeas").value.toLowerCase();
//     let indexCaracterId = document.querySelectorAll('.nameCharacter span:first-of-type');
//     indexCaracterId.forEach(element => {
//         console.log(element.id);
//         const indexId = (element.id).match(/\d*/g);
//         console.log(indexId);
//         let tabId = [];
//         for (let i = 0; i <= indexCharacterId.length; i++) {
//             tabId.push(indexId);
//             console.log(tabId)
//         }
//         for (let i = 0; i <= tabId.length; i++) {
//             let firstName = document.querySelector("#character" + i + "FirstName");
//             if (!firstName) {
//                 continue;
//             }
//             firstName = firstName.textContent.toLowerCase();
//             if (textArea.toLowerCase().includes(firstName)) {
//                 document.querySelector("#character" + i + "FirstName").style.color = 'red';
//             } else {
//                 document.querySelector("#character" + i + "FirstName").style.color = 'black';
//             }
//         }
//     });
//     console.log("--------------------------");
// }


// Affichage chapterIdeas, chapterName and indexChapter 

document.addEventListener('DOMContentLoaded', function () {
    // console.log(CKEDITOR);

    const dropdownItems = document.querySelectorAll('.chapterInfos > .dropdown-item');
    dropdownItems.forEach(function (item, index) {
        item.addEventListener('click', function () {
            const chapterName = this.dataset.chapterName;
            const chapterIdeas = this.dataset.chapterIdeas;
            document.querySelector('#chapitreEnCours').textContent = chapterName;
            document.querySelector('#contentIdeas').value = chapterIdeas;
            document.querySelector('#numberOfChapter').textContent = `Chapitre ${index + 1}`;
        });
    });
});

// Affichage du titre de la story dans nav

document.addEventListener('DOMContentLoaded', function () {
    console.log(stories);
    let storiesObject = JSON.parse(stories.replace(/&quot;/g, '"'));
    console.log(storiesObject);
    const dropdownStory = document.querySelectorAll('.dropdown-item.story');
    console.log(dropdownStory);
    dropdownStory.forEach(function (item) {
        console.log(item.dataset.story);
    });
});
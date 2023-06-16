// window.addEventListener('load', function () {
//     console.log('Chargée.');
// });

// ---------------------- MODE SOMBRE -----------------------


var buttonToggle = document.getElementById('buttonToggle');
var body = document.getElementsByTagName('body')[0];
var dark_theme = 'dark';

buttonToggle.addEventListener('click', function () {

    if (body.classList.contains(dark_theme)) {
        body.classList.remove(dark_theme);
    }

    else {
        body.classList.add(dark_theme);
    }
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


function searchNameForCollapse() {
    let textArea = document.querySelector("#contentIdeas").value.toLowerCase();
    let indexCaracterId = document.querySelectorAll('.nameCharacter span:first-of-type');
    indexCaracterId.forEach(element => {
        console.log(element.id);
        const indexId = (element.id).match(/\d*/g);
        console.log(indexId);
        let tabId = [];
        for (let i = 0; i <= indexCharacterId.length; i++) {
            tabId.push(indexId);
            console.log(tabId)
        }
        for (let i = 0; i <= tabId.length; i++) {
            let firstName = document.querySelector("#character" + i + "FirstName");
            if (!firstName) {
                continue;
            }
            firstName = firstName.textContent.toLowerCase();
            if (textArea.toLowerCase().includes(firstName)) {
                document.querySelector("#character" + i + "FirstName").style.color = 'red';
            } else {
                document.querySelector("#character" + i + "FirstName").style.color = 'black';
            }
        }
    });
    console.log("--------------------------");
}


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

// document.addEventListener('DOMContentLoaded', function () {
//     console.log(stories);
//     let storiesObject = JSON.parse(stories.replace(/&quot;/g, '"'));
//     console.log(storiesObject);
//     const dropdownStory = document.querySelectorAll('.dropdown-item.story');
//     console.log(dropdownStory);
//     dropdownStory.forEach(function (item) {
//         console.log(item.dataset.story);
//     });
// });

// Message flash timeout 5 secondes

document.querySelector('#navbarFlash').textContent != "";
setTimeout(function () {
    document.querySelector('#navbarFlash').textContent = "";
}, 5000);


// Récupère l'élément select du dropdown
var selectDropdown = document.getElementById('storizzz');

// Ajoute un événement change
// selectDropdown.addEventListener('change', function () {
//     // Récupère l'ID de l'histoire sélectionnée
//     var storyId = this.value;

//     // Effectue une requête AJAX pour récupérer les données de l'histoire
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', '/story/' + storyId, true);
//     xhr.onload = function () {
//         if (xhr.status === 200) {
//             // Succès de la requête AJAX, les données sont disponibles dans xhr.responseText
//             var storyData = JSON.parse(xhr.responseText);

//             // Affiche les parties de l'histoire dans la page
//             displayStoryParts(storyData);
//         }
//     };
//     xhr.send();
// });

function displayStoryParts(storyData) {
    // Récupère les éléments HTML où tu veux afficher les parties de l'histoire
    var chapterContainer = document.getElementById('contentIdeasgit status');
    var categoryContainer = document.getElementById('category-container');
    var characterContainer = document.getElementById('character-container');

    // Efface le contenu précédent des conteneurs
    chapterContainer.innerHTML = '';
    categoryContainer.innerHTML = '';
    characterContainer.innerHTML = '';

    // Parcours les parties de l'histoire et les affiche dans les conteneurs respectifs
    storyData.chapters.forEach(function (chapter) {
        chapterContainer.innerHTML += '<p>' + chapter.title + '</p>';
    });

    storyData.categories.forEach(function (category) {
        categoryContainer.innerHTML += '<p>' + category.name + '</p>';
    });

    storyData.characters.forEach(function (character) {
        characterContainer.innerHTML += '<p>' + character.name + '</p>';
    });

    // Récupère le premier chapitre de la liste
    var firstChapter = storyData.chapters[0];

    // Récupère le contenu des idées du premier chapitre
    var firstChapterIdeas = firstChapter.ideas;

    // Affiche le contenu des idées dans le conteneur approprié
    var contentIdeasContainer = document.getElementById('contentIdeas');
    contentIdeasContainer.innerHTML = '<p>' + firstChapterIdeas + '</p>';

    // Récupère les noms de tous les chapitres
    var chapterNames = storyData.chapters.map(function (chapter) {
        return chapter.title;
    });

    // Affiche les noms des chapitres dans le dropdown "dropdownChapter"
    var dropdownChapter = document.getElementById('dropdownChapter');
    dropdownChapter.innerHTML = '';

    chapterNames.forEach(function (chapterName) {
        dropdownChapter.innerHTML += '<option>' + chapterName + '</option>';
    });
}
function getStoryData(storyUrl) {
    console.log('pouet');
    console.log(storyUrl);
    $.get(storyUrl, (data) => {
        console.log(data)
    });
}



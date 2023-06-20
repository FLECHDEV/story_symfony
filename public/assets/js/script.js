// window.addEventListener('load', function () {
//     console.log('Chargée.');
// });

// ---------------------- MODE SOMBRE -----------------------

function toggleTheme() {
    let body = document.getElementsByTagName('body')[0];
    let contentIdeas = document.getElementById('contentIdeas');
    let navbarbrand = document.querySelector('.navbar-brand');
    let cardBody = document.querySelectorAll('.card-body');
    let navlink = document.querySelectorAll('.nav-link');
    let darkThemeClass = 'dark-theme';
    let theme = getCookie('theme');

    if (theme === 'dark-theme') {
        body.classList.add(darkThemeClass);
        applyDarkTheme();
        $('#mode').text('Dark Mode');
    } else {
        applyLightTheme();
        $('#mode').text('Light Mode');
    }

    let buttonToggle = document.getElementById('buttonToggle');
    buttonToggle.addEventListener('click', function () {
        if (body.classList.contains(darkThemeClass)) {
            body.classList.remove(darkThemeClass);
            setCookie('theme', 'light');
            applyLightTheme();
            $('#mode').text('Light Mode');
        } else {
            body.classList.add(darkThemeClass);
            setCookie('theme', 'dark-theme');
            applyDarkTheme();
            $('#mode').text('Dark Mode');
        }
    });

    // Gestion de la checkbox
    let blackAndWhiteCheckbox = document.getElementById('blackAndWhite');
    blackAndWhiteCheckbox.addEventListener('change', function () {
        if (this.checked) {
            body.classList.remove(darkThemeClass);
            setCookie('theme', 'light');
            applyLightTheme();
            $('#mode').text('Light Mode');
        } else {
            body.classList.add(darkThemeClass);
            setCookie('theme', 'dark-theme');
            applyDarkTheme();
            $('#mode').text('Dark Mode');
        }
    });

    function applyLightTheme() {
        contentIdeas.style.backgroundColor = "white";
        contentIdeas.style.color = "black";
        navbarbrand.style.color = "black";
        navlink.forEach(function (userItem) {
            userItem.style.color = "black";
        });
        cardBody.forEach(function (bodyItem) {
            bodyItem.style.color = "black";
            bodyItem.style.backgroundColor = "white";
        });
    }

    function applyDarkTheme() {
        contentIdeas.style.backgroundColor = "rgb(42, 42, 42)";
        contentIdeas.style.color = "white";
        navbarbrand.style.color = "white";
        navlink.forEach(function (userItem) {
            userItem.style.color = "white";
        });
        cardBody.forEach(function (bodyItem) {
            bodyItem.style.color = "white";
            bodyItem.style.backgroundColor = "rgb(42, 42, 42)";
        });
    }
}

// Appel initial de la fonction lors du chargement de la page
document.addEventListener('DOMContentLoaded', function () {
    toggleTheme();
});

// enregistrement du thème dans le cookie
function setCookie(name, value) {
    let d = new Date();
    d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// récupération du thème à partir du cookie
function getCookie(cname) {
    let theme = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');

    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }

        if (c.indexOf(theme) == 0) {
            return c.substring(theme.length, c.length);
        }
    }

    return "";
}

// Mise en surbrillance des personnages nommés dans le text


function searchNameForCollapse() {
    let textArea = document.querySelector("#contentIdeas").value.toLowerCase();
    let indexCharacterId = document.querySelectorAll('.nameCharacter span.name');

    indexCharacterId.forEach((element, index) => {
        const indexId = element.parentElement.id.match(/\d+/);
        let firstName = element.textContent.toLowerCase();

        if (textArea.includes(firstName)) {
            element.classList.add('highlight');
        } else {
            element.classList.remove('highlight');
        }
    });
}

// Appel initial de la fonction lors du chargement de la page
document.addEventListener('DOMContentLoaded', function () {
    searchNameForCollapse();
});

// Appel de la fonction lors de la saisie dans le textarea
document.querySelector("#contentIdeas").addEventListener('input', function () {
    searchNameForCollapse();
});
searchNameForCollapse();


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
            window.__chapterSelectedId__ = this.dataset.chapterId
            searchNameForCollapse();
        });
    });
});


// MESSAGE FLASH TIMEOUT 5 SECONDES

document.querySelector('#navbarFlash').textContent != "";
setTimeout(function () {
    document.querySelector('#navbarFlash').textContent = "";
}, 5000);


// Récupère l'élément select du dropdown
let selectDropdown = document.getElementById('storizzz');

function getStoryData(storyUrl) {
    console.log('pouet');
    console.log(storyUrl);
    $.get(storyUrl, (data) => {
        console.log(data);
        $('#selectedStory')[0].textContent = data.name;
        $('#selectedStory')[0].dataset.id = data.id;
        console.log($('#selectedStory')[0].dataset);
    });
}

// ---------------- CHARGEMENTS -------------------------

let __chapterSelectedId__ = null;

function loadInitialChapter(titre, content) {
    document.querySelector('#chapitreEnCours').textContent = titre;
    document.querySelector('#contentIdeas').value = content;
    document.querySelector('#numberOfChapter').textContent = `Chapitre ${index + 1}`;
}

function updateChapter(url) {
    console.log(url);
    console.log(window.__chapterSelectedId__);
    let chapterContent = document.querySelector('#contentIdeas').value;
    console.log(chapterContent);
    url = url.replace('fragmentToReplace', window.__chapterSelectedId__);
    $.post(url, { chapterContent: chapterContent }).done(function (data) {
        alert('update!!');
        $('.alert').alert('update !!')
    });
}




// -------------- SELECTION DES PERSONNAGES PAR CATEGORY --------------------------------


function filterCharactersByCategory(category) {
    let characterCards = document.getElementsByClassName('card-category');
    let selectedCategory = sessionStorage.getItem('selectedCategory'); // Récupérer la catégorie sélectionnée depuis sessionStorage

    if (!selectedCategory) {
        selectedCategory = 'Tous'; // Si aucune catégorie n'est sélectionnée, afficher tous les personnages
    }

    // Mettre à jour la valeur du dropdown avec la catégorie sélectionnée
    let dropdownButton = document.getElementById('dropdownMenuButton');
    dropdownButton.textContent = selectedCategory;

    if (category === 'Tous') {
        // Afficher tous les personnages en supprimant la classe 'hidden' de toutes les cartes
        for (let i = 0; i < characterCards.length; i++) {
            characterCards[i].classList.remove('hidden');
        }
    } else {
        // Parcourir toutes les cartes de personnages et masquer celles qui n'appartiennent pas à la catégorie sélectionnée
        for (let i = 0; i < characterCards.length; i++) {
            let characterCategory = characterCards[i].getAttribute('data-category');

            if (characterCategory !== category) {
                characterCards[i].classList.add('hidden');
            } else {
                characterCards[i].classList.remove('hidden');
            }
        }
    }
}

// Fonction pour enregistrer la catégorie sélectionnée dans sessionStorage
function saveSelectedCategory(category) {
    sessionStorage.setItem('selectedCategory', category);
}

// Fonction pour charger la catégorie sélectionnée lors du rechargement de la page
function loadSelectedCategory() {
    let selectedCategory = sessionStorage.getItem('selectedCategory');
    if (selectedCategory) {
        filterCharactersByCategory(selectedCategory);
    } else {
        filterCharactersByCategory('Tous'); // Afficher toutes les cartes si aucune catégorie sélectionnée
    }
}

// Appeler la fonction loadSelectedCategory au chargement de la page
window.onload = loadSelectedCategory;


// function filterCharactersByCategory(category) {
//     let characterCards = document.getElementsByClassName('card-category');

//     if (category === 'Tous') {
//         // Afficher tous les personnages en supprimant la classe 'hidden' de toutes les cartes
//         for (let i = 0; i < characterCards.length; i++) {
//             characterCards[i].classList.remove('hidden');
//         }
//     } else {
//         // Parcourir toutes les cartes de personnages et masquer celles qui n'appartiennent pas à la catégorie sélectionnée
//         for (let i = 0; i < characterCards.length; i++) {
//             let characterCategory = characterCards[i].getAttribute('data-category');

//             if (characterCategory !== category) {
//                 characterCards[i].classList.add('hidden');
//             } else {
//                 characterCards[i].classList.remove('hidden');
//             }
//         }
//     }
// }

// Récupérer la catégorie sélectionnée depuis le stockage local
// const selectedCategory = localStorage.getItem('selectedCategory');

// // Appliquer le filtre avec la catégorie précédemment sélectionnée ou 'Tous' par défaut
// filterCharactersByCategory(selectedCategory || 'Tous');



// function filterCharactersByCategory(category) {
//     let characterCards = document.getElementsByClassName('card-category');

//     if (category === 'Tous') {
//         // Afficher tous les personnages en supprimant la classe 'hidden' de toutes les cartes
//         for (let i = 0; i < characterCards.length; i++) {
//             characterCards[i].classList.remove('hidden');
//         }
//     } else {
//         // Parcourir toutes les cartes de personnages et masquer celles qui n'appartiennent pas à la catégorie sélectionnée
//         for (let i = 0; i < characterCards.length; i++) {
//             let characterCategory = characterCards[i].getAttribute('data-category');

//             if (characterCategory !== category) {
//                 characterCards[i].classList.add('hidden');
//             } else {
//                 characterCards[i].classList.remove('hidden');
//             }
//         }
//     }
// }

// // Récupérer la catégorie sélectionnée depuis le stockage local
// const selectedCategory = localStorage.getItem('selectedCategory');

// // Appliquer le filtre avec la catégorie précédemment sélectionnée ou 'Tous' par défaut
// filterCharactersByCategory(selectedCategory || 'Tous');

// function filterCharactersByCategory(category) {
//     let characterCards = document.getElementsByClassName('card-category');

//     if (category === 'Tous') {
//         // Afficher tous les personnages en supprimant la classe 'hidden'
//         for (let i = 0; i < characterCards.length; i++) {
//             characterCards[i].classList.remove('hidden');
//         }
//     } else {
//         // Parcourir toutes les cartes de personnages et masquer celles qui n'appartiennent pas à la catégorie sélectionnée
//         for (let i = 0; i < characterCards.length; i++) {
//             let characterCategory = characterCards[i].getAttribute('data-category');

//             if (characterCategory !== category) {
//                 characterCards[i].classList.add('hidden');
//             } else {
//                 characterCards[i].classList.remove('hidden');
//             }
//         }
//     }
// }

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


console.log(document.querySelector("#character4Firstname"));

function searchNameForCollapse() {
    let textArea = document.querySelector("#textChapter").value.toLowerCase();
    let charactersId = document.querySelectorAll(".characterId");
    console.log(charactersId);
    let index = [];
    for (let i = 0; i <= charactersId.length; i++) {
        index.push(charactersId.dataset.value);
        console.log(index);
    }

    for (let i = 0; i <= index.length; i++) {
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
}

document.addEventListener('keydown', function (event) {
    if (event.code == 'Space') {
        searchNameForCollapse();
    }
});
searchNameForCollapse();



// Affichage chapterIdeas, chapterName and indexChapter 

document.addEventListener('DOMContentLoaded', function () {
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(function (item, index) {
        item.addEventListener('click', function () {
            const indexChapter = index;
            console.log(indexChapter);
            const chapterName = this.dataset.chapterName;
            const chapterIdeas = this.dataset.chapterIdeas;
            document.getElementById('chapitreEnCours').textContent = chapterName;
            document.getElementById('textChapter').value = chapterIdeas;
            document.querySelector('#numberOfChapter').textContent = `Chapitre ${indexChapter}`;
            console.log( document.querySelector('#numberOfChapter').textContent);
        });
    });
});

// Affichage du titre de la story dans nav

//     document.addEventListener('DOMContentLoaded', function () {
//     const dropdownStory = document.querySelectorAll('.dropdown-item story');
//     console.log(dropdownStory);
//     dropdownStory.forEach(function (item) {
//         item.addEventListener('click', function () {
//             const storyName = this.dataset.storyName;
//             document.getElementById('displayStory').textContent = storyName;
//             console.log(storyName);
//         });
//     });
// });
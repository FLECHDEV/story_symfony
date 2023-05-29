// window.addEventListener('load', function () {
//     console.log('Chargée.');
// });

let textArea = document.querySelector("#textChapter").value.toLowerCase();
let nameCharacters = document.querySelectorAll(".nameCharacter");

console.log(textArea);

function searchNameForCollapse() {
    for (let i = 0; i < nameCharacters.length; i++) {
        let nameTab = nameCharacters[i].textContent.toLowerCase();
        console.log(nameTab);
        const firstnameRegex = /^[^\s]+/;
        let resultName = nameTab.match(firstnameRegex);
        console.log(resultName);

        if (textArea.includes(resultName)) {
            console.log("Le prènom existe!");
            document.getElementById(`nameCharacter${i + 1}`).style.color = 'red';
        } else {
            console.log("Le prènom n'existe pas!");
            document.getElementById(`nameCharacter${i + 1}`).style.color = 'black';
        }
    }
    console.log("--------------------------");
}

searchNameForCollapse();

document.addEventListener('keydown', function (event) {
    if (event.code == 'Space') {
        searchNameForCollapse();
        // window.location.reload();
    }
});

$(document).ready(function () {
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function () {
        $(this).parent(".card").find(".toggle").addClass("rotate");
    }).on('hide.bs.collapse', function () {
        $(this).parent(".card").find(".toggle").removeClass("rotate");
    });
});
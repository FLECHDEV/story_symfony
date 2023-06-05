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
    let index = [1, 2, 3, 4, 5,6 ,7, 8, 9, 10, 11, 12, 13, 14];
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
    console.log("--------------------------");
}

document.addEventListener('keydown', function (event) {
    if (event.code == 'Space') {
        searchNameForCollapse();
    }
});
searchNameForCollapse();

import './bootstrap';

document
    .getElementById("closeButton")
    .addEventListener("click", function () {
        const menuDiv = document.getElementById("menuDiv");
        menuDiv.classList.add("hidden"); // Adds the 'hidden' class to make the div disappear
    });
document
    .getElementById("show_div")
    .addEventListener("click", function () {
        const menuDiv = document.getElementById("menuDiv");
        menuDiv.classList.remove("hidden"); // Adds the 'hidden' class to make the div disappear
    });

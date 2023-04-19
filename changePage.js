
let links = [];
let currentPage = "addBook" // default - should match the ids from the nav links in index
let debug = null;

function updateNavSelection() {
    for (let link of links) {
        if (link.id == currentPage) {
            link.style.setProperty("--bg-var", "rgb(107, 124, 139)");
        }
        else {
            link.style.setProperty("--bg-var", "rgb(94, 108, 122)");
        }
    }
}

// after body has loaded
document.body.onload = function(){
    // setup debug
    debug = document.createElement("p");
    debug.style.color = "red";
    document.querySelector("footer").appendChild(debug); // debug text in footer
    function dlog(message) {
        debug.appendChild(document.createTextNode(message));
    }
    // end setup debug

    // get nav links
    links = document.body.querySelectorAll("a");

    // set onclick event
    for (let link of links) {
        link.addEventListener("click", function() {
            // update nav and change iframe src
            currentPage = link.id;
            updateNavSelection();
        });
    }
};

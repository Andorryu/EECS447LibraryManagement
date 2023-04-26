
let links = [];
let debug = null;

currentPage = 'search';

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
window.onload = function(){
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
    updateNavSelection(); // initial update

    // get iframe
    iframe = document.body.querySelector("iframe");
    currentPage = iframe.src.replace('.html', '');

    // set onclick event
    for (let link of links) {
        link.addEventListener("click", function() {
            // update nav and change iframe src
            currentPage = link.id;
            updateNavSelection();

            // iframe
            if (link.id != "logOut") {
                iframe.setAttribute("src", link.id+".html"); // links will change iframe src to html files whose name matches the link id
            }
            else {
                // do logout
                window.location.href = "logIn.html";
            }
        });
    }
};

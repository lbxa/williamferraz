document.addEventListener("DOMContentLoaded", function() {
    let head = document.querySelector("head");

    let loadJS = function(src) {
        let jslink = document.createElement("script");
        jslink.src = src;
        head.appendChild(jslink);
        console.log(jslink);
    };

    console.log("Additional JS files loaded:");
    loadJS("js/ripple_effect.js");
    loadJS("js/carousel.js");
});

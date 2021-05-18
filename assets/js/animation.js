/**
 *
 * Hoa
 * Created at 17-05-2021
 * click menu responsive
 *
 */
function myFunction() {
    let x = document.getElementById("my-top-nav");
    if (x.className === "top-bar__menu") {
        x.className += " responsive";
    } else {
        x.className = "top-bar__menu";
    }
}
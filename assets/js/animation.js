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

/**
 *
 * Hoa
 * Created at 19-05-2021
 * Preview Image - update product
 *
 */
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("upload-preview").src = oFREvent.target.result;
    };
};
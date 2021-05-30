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
function PreviewImage(id) {
    let oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById(`image-${id}`).files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById(`upload-preview-${id}`).src = oFREvent.target.result;
    };
};

/**
 *
 * Hoa
 * Created at 30-05-2021
 * show modal img
 *
 */
var modal = document.getElementById("myModalImg");
var modalImg = document.getElementById("img01");
function showModalImg(e){
    modal.style.display = "block";
    modalImg.src = e.src;
}

// Get the <span> element that closes the modal
var close = document.getElementsByClassName("close-img")[0];

// When the user clicks on <span> (x), close the modal
close.onclick = function() {
    modal.style.display = "none";
}
document.addEventListener("DOMContentLoaded", function () {
let image = document.querySelector(".view-image");

let preview1 = document.querySelector(".image-preview-box .preview-1");

let preview2 = document.querySelector(".image-preview-box .preview-2");

let preview3 = document.querySelector(".image-preview-box .preview-3");

let preview4 = document.querySelector(".image-preview-box .preview-4");

preview1.addEventListener("click", function () {
  image.src = preview1.src;

  preview1.classList.add("active-image");

  preview2.classList.remove("active-image");

  preview3.classList.remove("active-image");

  preview4.classList.remove("active-image");
});

preview2.addEventListener("click", function () {
  image.src = preview2.src;

  preview2.classList.add("active-image");

  preview1.classList.remove("active-image");

  preview3.classList.remove("active-image");

  preview4.classList.remove("active-image");
});

preview3.addEventListener("click", function () {
  image.src = preview3.src;

  preview3.classList.add("active-image");

  preview1.classList.remove("active-image");

  preview2.classList.remove("active-image");

  preview4.classList.remove("active-image");
});

preview4.addEventListener("click", function () {
  image.src = preview4.src;

  preview4.classList.add("active-image");

  preview1.classList.remove("active-image");

  preview2.classList.remove("active-image");

  preview3.classList.remove("active-image");
});
});
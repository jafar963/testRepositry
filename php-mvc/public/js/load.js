function myLoad() {
    setTimeout(changePage, 2000);
}

function changePage() {
    window.location.replace(window.location.origin + "/php-mvc/home/homepage");
}
import Jquery from 'jquery';
window.$ = Jquery;

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

window.showToast = function (message, color) {
    if (!window.toast) { window.toast = new bootstrap.Toast(document.getElementById('liveToast'));  }

    var toastBody = document.querySelector('#liveToast .toast-body');
    if (toastBody) { toastBody.innerHTML = message; }

    var toastColor = document.querySelector('#liveToast.toast');
    if (toastColor) { toastColor.classList.remove('bg-success', 'bg-dark', 'bg-warning', 'bg-info'); }
    if (color) { toastColor.classList.add('bg-' + color); }

    window.toast.show();
};

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) })

window.showOffsetCanvas = function (id) {
    const offcanvas = new bootstrap.Offcanvas(id);
    offcanvas.show();
}

var stickyBar = $(".sticky");
var windowScroll = $(window);
windowScroll.on("scroll", function () {
    var scroll = windowScroll.scrollTop();
    if (scroll < 200) {
        stickyBar.removeClass("shadow-sm position-fixed top-0 animate__animated animate__fadeInDown");
        $('.checkout .sticky-top.total').removeClass('top');
    } else {
        stickyBar.addClass("shadow-sm position-fixed top-0 animate__animated animate__fadeInDown");
        $('.checkout .sticky-top.total').addClass('top');
    }
});

$(window).on('load', function () {
    $('#preloader').fadeOut("slow");
});

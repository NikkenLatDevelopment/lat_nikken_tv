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

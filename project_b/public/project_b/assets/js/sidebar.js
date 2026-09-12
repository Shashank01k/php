document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const page = document.querySelector('.page-with-sidebar');

    if (!sidebar || !sidebarToggle || !page) {
        return;
    }

    sidebarToggle.addEventListener('click', function () {

        sidebar.classList.toggle('active');
        page.classList.toggle('sidebar-open');

    });

});
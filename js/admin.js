// Project : Fatdonald's
// File: admin.js
// Authors: Joshua

$(document).ready(sidebarListener);

function sidebarListener() {
    $('#sidebarCollapse').click(collapse);
}

function collapse() {
    $('#sidebar, #content').toggleClass('active');
    $('.collapse.in').toggleClass('in');
    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
}

function confirmDelete() {
    return confirm('Are you sure?');
}

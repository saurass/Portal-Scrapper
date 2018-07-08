/**
 * Created by Ritik on 18-05-2018.
 */

function deleteEntry(dataid, action) {
    var request = $.ajax({
        url: "script.php",
        type: "POST",
        data: {
            id: dataid,
            action: action
        },
        dataType: "html"
    });

    request.done(function (msg) {
        reloadTable();
        imp();
    });

    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function addEntryField() {
    $("#addOnly").removeClass('hidden-tr');
    var request = $.ajax({
        url: "addNew.php",
        type: "POST",
        data: {},
        dataType: "html"
    });

    request.done(function (msg) {
        document.getElementById('addOnly').innerHTML = msg;
    });

    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

}

function addData() {

    var name = document.getElementById('name').value;
    var color = document.getElementById('color').value;
    var color_c = document.getElementById('color-c').value;
    var str = name + '*' + color + '*' + color_c;
    var request = $.ajax({
        url: "script.php",
        type: "POST",
        data: {
            id: str,
            action: 'A'
        },
        dataType: "html"
    });

    request.done(function (msg) {
        reloadTable();
        imp();
    });

    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function reloadTable() {
    var request = $.ajax({
        url: "script.php",
        type: "POST",
        data: {
            id: 'N/A',
            action: 'R'
        },
        dataType: "html"
    });
    request.done(function (msg) {
        document.getElementById('dataFields').innerHTML = msg;
        imp();
    });
}

$(document).ready(function () {
    $('#colorTable').DataTable({
        "drawCallback": function () {
            $(".fg-button").addClass("btn-flat m-10");
            $(".ui-state-disabled").addClass("disabled");
        }
    });
    imp();
});

function imp() {
    $('.tooltipped').tooltip();
    $(".fg-button").addClass("btn-flat m-10");
    $(".ui-state-disabled").addClass("disabled");
    $('select').addClass('browser-default');
    $('.modal').modal();
}
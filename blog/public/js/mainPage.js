$(document).ready(function () {

    $('#news').hide();
    $('#news').slideDown();

    var button_click = false;

function notDisplay(str) {
        for (var i = 0; $(str + i).length != 0; i++) {
            $(str + i).hide();
        }
    }

    function Cancel(){
        $("#addEl").show();
        $("#updateAllEl").show();
        $("#sendEl").show();
        $("#delEl").show();
        $("#changeEmailEl").show();
        $("#cancelEl").hide();
        $("#news").find("input").hide();
        button_click = false;
    }

    $("#add").on("click", function () {
        var result = confirm("Are you really want to add news");

        if (!result){
            $("#add").attr('form', '');
        }
        else {
            $("#add").attr('form', 'addForm');
        }
    });

$("#updateAll").on("click", function () {

    var result = confirm("Are you really want to update all the news");

    if (!result){
        $("#updateAll").attr('form', '');
    }
    else {
        $("#updateAll").attr('form', 'updateAllForm');
    }

});

$("#delete").on("click", function () {
    if (!button_click) {
        $("#addEl").hide();
        $("#updateAllEl").hide();
        $("#sendEl").hide();
        $("#changeEmailEl").hide();
        $("#cancelEl").show();
        $("#news").find("input").show();
        button_click = true;
    }
    else {
        var result = confirm("Are you really want to delete the news");

        if (result) {
            button_click = false;
            $("#delete").attr('form', 'deleteForm');
        }
        else {
            Cancel();
        }
    }
});


$("#send").on("click", function () {

        if (!button_click) {
            $("#addEl").hide();
            $("#updateAllEl").hide();
            $("#delEl").hide();
            $("#changeEmailEl").hide();

            $("#cancelEl").show();
            $("#news").find("input").attr('form', 'sendForm');
            $("#news").find("input").show();
            button_click = true;
        }
        else {
            button_click = false;
            $("#send").attr('form', 'sendForm');

        }

    });

$("#search").on("click", function () {

    if ($("#searchText").val().trim() == ""){
        alert("Please, write text");
        $("#search").attr('form', '');
    }
    else {
        $("#search").attr('form', 'search-form');
    }

});




$("#cancel").on("click", function () {

    Cancel();
});

});

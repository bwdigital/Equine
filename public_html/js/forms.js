$(document).ready(function() {
    $('.onlyDate').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('.date').datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });

    $("input[type='text']").on("click", function () {
        $(this).select();
    });

    $('input.formatInput').each(function(){
        $(this).autoNumeric('init', {vMin: $(this).attr('data-vMin') ,vMax: $(this).attr('data-vMax'), aSep: '' });
    });

    if (navigator.userAgent.indexOf('Chrome') != -1) {
        $('input[type=date]').on('click', function(event) {
            event.preventDefault();
        });
    }

    $(".various").fancybox({
        maxWidth	: 800,
        maxHeight	: 600,
        fitToView	: true,
        width		: '70%',
        height		: '70%',
        autoSize	: false,
        closeClick	: false,
        openEffect	: 'none',
        closeEffect	: 'none'
    });

    $('.selectBoxes').click(function(){
        var count = $("[name='test[]'][type='checkbox']:checked").length;
        if(count>0){
            $('#selectBoxesButton').fadeIn();
        }else{
            $('#selectBoxesButton').fadeOut();
        }
    });

    $("#selectAllBox").click(function () {
        if ($("#selectAllBox").is(':checked')) {
            $(".selectBoxes").each(function () {
                $(this).prop("checked", true);
            });
        } else {
            $(".selectBoxes").each(function () {
                $(this).prop("checked", false);
            });
        }
        var count = $("[name='test[]'][type='checkbox']:checked").length;
        if(count>0){
            $('#selectBoxesButton').fadeIn();
        }else{
            $('#selectBoxesButton').fadeOut();
        }
    });

    //Set horse auto complete box
    $(".horseAutoCompleteSelector").select2({
        placeholder: "Select the horse",
        minimumInputLength: 1,
        allowClear: true,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: siteURL + "horse/list/json",
            dataType: 'jsonp',
            data: function (term, page) {
                return {
                    q: term, // search term
                    limit: 10
                };
            },
            results: function (data, page) { // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to alter remote JSON data
                return {results: data.horses};
            }
        },
        initSelection: function(element, callback) {
            var id=$(element).val();
            if (id!=="") {
                $.ajax( siteURL + "horse/"+ id + "/json", {
                    data: {},
                    dataType: "jsonp"
                }).done(function(data) { callback(data); });
                if( typeof $(element).data('stableinfo') !== 'undefined'){
                    updateHorseDetailByAjax(id);
                }
            }
        },
        formatResult: function(data){
            var markup = "<table><tr>";
            markup += "<td><div>" + data.name + "</div></td>";
            markup += "</td></tr></table>"
            return markup;
        },
        formatSelection: function(data){
            return data.name;
        },
        dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
        escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
    });

    $(".horseAutoCompleteSelector").on("select2-selecting", function(e) {
        if( typeof $(e.target).data('stableinfo') !== 'undefined'){
            updateHorseDetailByAjax(e.val);
        }
    });

    //Set User auto complete box
    $(".userAutoCompleteSelector").select2({
        placeholder: "Select the user",
        minimumInputLength: 1,
        allowClear: true,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: siteURL + "user/list/json",
            dataType: 'jsonp',
            data: function (term, page) {
                return {
                    q: term,
                    type: $(this).attr('data-userType'),
                    limit: 10
                };
            },
            results: function (data, page) { // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to alter remote JSON data
                return {results: data.users};
            }
        },
        initSelection: function(element, callback) {
            var id=$(element).val();
            if (id!=="") {
                $.ajax( siteURL + "user/"+ id + "/json", {
                    data: {},
                    dataType: "jsonp"
                }).done(function(data) { callback(data); });
                if( typeof $(element).data('stableinfo') !== 'undefined'){
                    updateHorseDetailByAjax(id);
                }
            }
        },
        formatResult: function(data){
            var markup = "<table><tr>";
            markup += "<td><div>" + data.firstname + "</div></td>";
            markup += "</td></tr></table>"
            return markup;
        },
        formatSelection: function(data){
            return data.firstname;
        },
        dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
        escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
    });

});


function printPopup(url,windowName) {
    var newwindow = window.open(url,'printWindow' + windowName,'height=600,width=800');
    if (window.focus) {
        newwindow.focus();
    }
    return false;
}

//Horse Selection for test forms
function updateHorseDetailByAjax(horseId){
    if(horseId!=0){
        $.get( siteURL + "horse/"+ horseId + "/json",
            function(data) {
                if(typeof data.dob === 'string' && data.dob.length>0){
                    var bdate = new moment(data.dob);
                    $('#horseTestFormBDay').html(bdate.format('MMMM Do YYYY'));
                }else{
                    $('#horseTestFormBDay').html('----');
                }
                $('#horseTestFormGender').html(data.gender);
                console.log(data);
                if(typeof data.breed !== 'undefined'){
                    $('#horseTestFormBreed').html(data.breed.name);
                }
                if(typeof data.trainer !== 'undefined'){
                    $('#horseTestFormTrainer').html(data.trainer.firstname);
                }
                if(typeof data.stable !== 'undefined'){
                    $('#horseTestFormStable').html(data.stable.name);
                }
                if(typeof data.owner !== 'undefined'){
                    $('#horseTestFormOwner').html(data.owner.firstname);
                }
            }, "json");
    }else{
        $('#horseTestFormBDay').html('----');
        $('#horseTestFormGender').html('----');
        $('#horseTestFormBreed').html('----');
        $('#horseTestFormTrainer').html('----');
        $('#horseTestFormStable').html('----');
    }

}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function deleteTest(url){
    var r = confirm("Do you want to delete this test?");
    if (r==true){
        window.location = url;
    }
    return false;
}
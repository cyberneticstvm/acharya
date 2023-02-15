$(function(){
    "use strict"

    $('form').submit(function(){
        $(".btn-submit").attr("disabled", true);
        $(".btn-submit").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>");
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#datatable-basic').DataTable({
        pagingType: "numbers"
    });

    $(".rad_at").click(function(){
        var col = $(this).data('col');
        var aid = $(this).data('aid');
        var val = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/updateAttendance',
            data: {'col': col, 'aid': aid, 'val': val},
            success: function(response){
                alert(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(XMLHttpRequest);
            }
        });
    });

    $(".chkModule").change(function(){
        var mid = $(this).data('mid');
        var val = 0;
        if($(this).is(":checked")){
            val = 1;
        };
        $.ajax({
            type: 'GET',
            url: '/syllabus-status/update',
            data: {'mid': mid, 'val': val},
            success: function(response){
                alert(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(XMLHttpRequest);
            }
        });
    });

    $(".attTD").each(function(){
        if($(this).text() == 'L'){
            $(this).addClass('text-warning');
        }
        if($(this).text() == 'P'){
            $(this).addClass('text-success');
        }
        if($(this).text() == 'A'){
            $(this).addClass('text-danger');
        }
    });
});

setTimeout(function () {
    $(".alert").hide('slow');
}, 3000);

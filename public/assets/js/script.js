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

    $(document).ready(function() {
        $('.select2').select2();
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

    $(".att tr").each(function(){
        var dis = $(this);
        var p = 0; var l = 0; var a = 0;
        dis.find('td').each(function(){
            if($(this).text() == 'L'){
                $(this).addClass('text-warning');
                l += 1;
            }
            if($(this).text() == 'P'){
                $(this).addClass('text-success');
                p += 1;
            }
            if($(this).text() == 'A'){
                $(this).addClass('text-danger');
                a += 1;
            }
        });
        dis.find("td:nth-last-child(1)").text(l).addClass('text-center text-warning');
        dis.find("td:nth-last-child(2)").text(a).addClass('text-center text-danger');
        dis.find("td:nth-last-child(3)").text(p).addClass('text-center text-success');;
    })

    $(".bforSyl").change(function(){
        var bid = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/getDropDown',
            data: {'bid': bid},
            success: function(response){
                $(".bSyl").html(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(XMLHttpRequest);
            }
        });
    })
});

setTimeout(function () {
    $(".alert").hide('slow');
}, 3000);


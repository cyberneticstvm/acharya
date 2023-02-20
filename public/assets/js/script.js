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

$(function(){
    "use strict";
    var ctx5 = document.getElementById("stud-reg-chart").getContext("2d");
    $.getJSON('/studentregchart/', function(response){
        new Chart(ctx5, {
            type: "bar",
            data: {
              labels: [response[11].mname, response[10].mname, response[9].mname, response[8].mname, response[7].mname, response[6].mname, response[5].mname, response[4].mname, response[3].mname, response[2].mname, response[1].mname, response[0].mname],
              datasets: [{
                label: "Sales by age",
                weight: 5,
                borderWidth: 0,
                borderRadius: 4,
                backgroundColor: '#cb0c9f',
                data: [response[11].ptot, response[10].ptot, response[9].ptot, response[8].ptot, response[7].ptot, response[6].ptot, response[5].ptot, response[4].ptot, response[3].ptot, response[2].ptot, response[1].ptot, response[0].ptot],
                fill: false,
                maxBarThickness: 35
              }],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false,
                }
              },
              scales: {
                y: {
                  grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                  },
                  ticks: {
                    display: true,
                    padding: 10,
                    color: '#9ca2b7'
                  }
                },
                x: {
                  grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: true,
                    drawTicks: true,
                  },
                  ticks: {
                    display: true,
                    color: '#9ca2b7',
                    padding: 10
                  }
                },
              },
            },
          });
    });

    var ctx4 = document.getElementById("stud-fee-chart").getContext("2d");
    $.getJSON('/studentfeechart/', function(response){
        new Chart(ctx4, {
        type: "pie",
        data: {
            labels: ['Admission Fee', 'Batch Fee'],
            datasets: [{
            label: "Projects",
            weight: 9,
            cutout: 0,
            tension: 0.9,
            pointRadius: 2,
            borderWidth: 2,
            backgroundColor: ['#17c1e8', '#cb0c9f'],
            data: [response['afee'], response['bfee']],
            fill: false
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
            legend: {
                display: true,
            }
            },
            interaction: {
            intersect: false,
            mode: 'index',
            },
            scales: {
            y: {
                grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                },
                ticks: {
                display: false
                }
            },
            x: {
                grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                },
                ticks: {
                display: false,
                }
            },
            },
        },
        });
    });

    var ctx3 = document.getElementById("stud-canc-chart").getContext("2d");
    var gradientStroke1 = ctx3.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.02)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //

    $.getJSON('/studentcancelledchart/', function(response){
        new Chart(ctx3, {
            type: "line",
            data: {
              labels: [response[11].mname, response[10].mname, response[9].mname, response[8].mname, response[7].mname, response[6].mname, response[5].mname, response[4].mname, response[3].mname, response[2].mname, response[1].mname, response[0].mname],
              datasets: [{
                label: "Visitors",
                tension: 0.5,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#cb0c9f",
                borderWidth: 2,
                backgroundColor: gradientStroke1,
                data: [response[11].ptot, response[10].ptot, response[9].ptot, response[8].ptot, response[7].ptot, response[6].ptot, response[5].ptot, response[4].ptot, response[3].ptot, response[2].ptot, response[1].ptot, response[0].ptot],
                maxBarThickness: 6,
                fill: true
              }],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false,
                }
              },
              interaction: {
                intersect: false,
                mode: 'index',
              },
              scales: {
                y: {
                  grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                  },
                  ticks: {
                    display: true,
                    padding: 10,
                    color: '#9ca2b7'
                  }
                },
                x: {
                  grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                  },
                  ticks: {
                    display: true,
                    padding: 10,
                    color: '#9ca2b7'
                  }
                },
              },
            },
        });      
    });
});



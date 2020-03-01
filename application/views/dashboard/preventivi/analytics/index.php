<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<title>Preventivi</title>

<!-- Device Analytics -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="box-title">Piattaforma</h4>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card-body">
                    <div style="height: 34vh" id="traffic-chart" class="traffic-chart"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-body">
                    <div class="progress-box progress-1">

                        <div id="top_first_platform_label" class="por-txt">Device 1</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_first_platform_bar" class="progress-bar bg-flat-color-1" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-box progress-2">

                        <div id="top_two_platform_label" class="por-txt">Device 2</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_two_platform_bar" class="progress-bar bg-flat-color-2" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-box progress-2">

                        <div id="top_three_platform_label" class="por-txt">Device 3</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_three_platform_bar" class="progress-bar bg-flat-color-3" role="progressbar" style="width: 0%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="card-body"></div>
    </div>
</div>





<div style="margin-top: 10px;" class="col-lg-12">
    <div class="card">

        <div class="row">

            <div class="col-lg-6">
                <div class="card-body">
                    <h4 class="box-title">Budget </h4>
                </div>

                <div class="card-body">

                    <div class="progress-box progress-1">
                        <div id="top_first_budget_label" class="por-txt">0 &euro;</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_first_budget_bar" class="progress-bar bg-flat-color-1" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress-box progress-2">
                        <div id="top_two_budget_label" class="por-txt">0 &euro;</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_two_budget_bar"  class="progress-bar bg-flat-color-2" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress-box progress-2">
                        <div id="top_three_budget_label" class="por-txt">0 &euro;</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_three_budget_bar" class="progress-bar bg-flat-color-3" role="progressbar" style="width: 0%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card-body">
                    <h4 class="box-title">Località</h4>
                </div>

                <div class="card-body">
                    <div class="progress-box progress-1">
                        <div id="top_first_location_label" class="por-txt">NaN</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_first_location_bar" class="progress-bar bg-flat-color-1" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress-box progress-2">
                        <div id="top_two_location_label" class="por-txt">NaN</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_two_location_bar" class="progress-bar bg-flat-color-2" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress-box progress-2">
                        <div id="top_three_location_label" class="por-txt">NaN</div>
                        <div class="progress mb-2" style="height: 5px;">
                            <div id="top_three_location_bar" class="progress-bar bg-flat-color-3" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body"></div>
    </div>
</div>




<script>


    function getParam()
    {
        var url = "<?php echo $homepage; ?>api/analytics/getall";
        $.post( url, function( data ) {
            var response = JSON.parse(data);
            var record   = parseInt(response['record'][0]['line']);

            ['first','two','three'].forEach(function (val,index) {

                try {
                    $("#top_"+ val +"_budget_label").html((response['budget'][index]['Budget'] + " &euro;"));
                    $("#top_"+val+"_budget_bar").css('width', ((response['budget'][index]['Richieste'] / record *100) + "%"));


                    $("#top_"+ val +"_location_label").html((response['location'][index]['Location']));
                    $("#top_"+val+"_location_bar").css('width', ((response['location'][index]['Richieste'] / record *100) + "%"));

                    $("#top_"+ val +"_platform_label").html((response['piattaforma'][index]['Piattaforma']));
                    $("#top_"+val+"_platform_bar").css('width', ((response['piattaforma'][index]['Richieste'] / record *100) + "%"));
                }catch (e) {

                }
            });
        });


    }

    jQuery(document).ready(function($)
    {
        "use strict";

        if ($('#traffic-chart').length)
        {
            var chart = new Chartist.Line('#traffic-chart', {
                labels: [],
                series: [
                    [0, 18000, 35000,  25000,  22000,  0],
                    [0, 33000, 15000,  20000,  15000,  300],
                    [0, 15000, 28000,  15000,  30000,  5000]
                ]
            }, {
                low: 0,
                showArea: true,
                showLine: false,
                showPoint: false,
                fullWidth: true,
                axisX: {
                    showGrid: true
                }
            });

            chart.on('draw', function(data) {
                if(data.type === 'line' || data.type === 'area') {
                    data.element.animate({
                        d: {
                            begin: 2000 * data.index,
                            dur: 2000,
                            from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                            to: data.path.clone().stringify(),
                            easing: Chartist.Svg.Easing.easeOutQuint
                        }
                    });
                }
            });
        }

        getParam();

         setInterval(function(){
            getParam()
          }, 8000);

    });
</script>
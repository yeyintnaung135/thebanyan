<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">

    <title>Members Tree Structure</title>

    <link rel="icon" type="image/x-icon" href="../img/logo.ico">
    <link rel="stylesheet" href="{{asset('ccss/font.css')}}">
    <link rel="stylesheet" href="{{asset('ccss/jquery.orgchart.css')}}">
    <link rel="stylesheet" href="{{asset('ccss/ccstyle.css')}}">
    <link rel="stylesheet" href="{{asset('ccss/cstyle.css')}}">

</head>
<body>
<div id="chart-container"></div>
<div class="home-link">


</div>
<script type="text/javascript" src="{{asset('cjs/jquery.3.0.1.js')}}"></script>
<script type="text/javascript" src="{{asset('cjs/jqmock.js')}}"></script>

<script type="text/javascript" src="{{asset('cjs/jquery.orgchart.js')}}"></script>
<script>
    var d;

    $(document).ready(function () {
        initOrgchart('{{$id}}');
    });
    function initOrgchart(rootClass) {
        $('#chart-container').orgchart({
            'chartClass': rootClass,
            'data': 'http://'+document.location.hostname+'/the-banyan/public/api/v1/data_tree_chart/'+rootClass,
            'nodeContent': 'dept',
            'createNode': function ($node, data) {
                if ($node.is('.drill-down')) {
                    var assoClass = data.className.match(/[0-9]+/)[0];
                    var drillDownIcon = $('<i>', {
                        'class': 'fa fa-arrow-circle-down drill-icon',
                        'click': function () {
                            $('#chart-container').find('.orgchart:visible').addClass('hidden');
                            if (!$('#chart-container').find('.orgchart.' + assoClass).length) {
                                initOrgchart(assoClass);
                            } else {
                                $('#chart-container').find('.orgchart.' + assoClass).removeClass('hidden');
                            }
                        }
                    });
                    $node.append(drillDownIcon);
                } else if ($node.is('.drill-up')) {
                    var assoClass = data.className.match(/[0-9]+/)[0];
                    var drillUpIcon = $('<i>', {
                        'class': 'fa fa-arrow-circle-up drill-icon',
                        'click': function () {
                            $('#chart-container').find('.orgchart:visible').addClass('hidden').end()
                                .find('.drill-down.' + assoClass).closest('.orgchart').removeClass('hidden');
                            if (!$('#chart-container').find('.orgchart.' + assoClass).length) {
                                initOrgchart(assoClass);
                            } else {
                                $('#chart-container').find('.orgchart.' + assoClass).removeClass('hidden');
                            }
                        }
                    });
                    $node.append(drillUpIcon);
                }
            }
        });
    }
</script>
</body>
</html>
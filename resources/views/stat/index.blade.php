<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Адміністративна панель</title>

        <!-- Bootstrap -->
        <link href="./css/bootstrap.css" rel="stylesheet">
        <link href=".//css/font-awesome.css" rel="stylesheet">
        <link href=".//css/stat.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="./lib/bootstrap.js"></script>
        <script src='./lib/moment.min.js'></script>
    </head>
    <body>
        <div class="header navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="http://www.oe.if.ua/"><img  src="./img/OE_logo.bmp"></a>
                </div>
                <div class="collapse navbar-collapse" id="responsive-menu">
                    <ul class="nav navbar-nav">
                        <li class="header-href"><a href="{{ route('manage') }}">Admin page</a></li>
                        <li class="header-href"><a href="{{ route('index') }}">Calendar</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">Натисність <strong>лівою</strong> кнопкою миші на поле вводу та виберіть дату</h1>
                    <div class="col-xs-5"></div>
                    <div class="col-xs-3">
                        <input type="date" id="dataToday" class="input-date">
                        <script>
                            document.getElementById('dataToday').valueAsDate = new Date();
                        </script>
                    </div>
                    <div class="col-xs-4"></div>
                </div>

                <div class="col-md-4 zagStat">
                    <p>Загальна статистика та статистика по періодах</p>
                    <div class="blockStat">
                        <label>Година з</label>
                        <input type="text" class="form-control" id="time_start">
                        <label>по</label>
                        <input type="text" class="form-control" id="time_end">
                    </div>
                    <button type="button" class="statVud btn btn-warning">Видати статистику за даний період</button>
                    <table class="table table-striped">
                        <caption>Cтатистика за Вибраний період</caption>
                        <tr>
                            <th>Кіслькість зареєстрованих</th>
                            <th>З живої черги</th>
                            <th>З онлайн черги</th>
                        </tr>
                        <tr>
                            <td id="day_period_all">{{$counts['all']}}</td>
                            <td id="day_period_real">{{$counts['real_queue']}}</td>
                            <td id="day_period_online">{{$counts['online_queue']}}</td>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-striped">
                        <caption>Загальна статистика за день</caption>
                        <tr>
                            <th>Кіслькість зареєстрованих</th>
                            <th>З живої черги</th>
                            <th>З онлайн черги</th>
                        </tr>
                        <tr>
                            <td id="all_day_all">{{$counts['all']}}</td>
                            <td id="all_day_real">{{$counts['real_queue']}}</td>
                            <td id="all_day_online">{{$counts['online_queue']}}</td>
                        </tr>
                    </table>

                </div>
                <div class="col-md-8">
                    <table class="table table-striped" id="main_queue_table">
                            <caption>Таблтця моніторингу споживачів</caption>
                            <tr>
                                <th>Період</th>
                                <th>ПІП</th>
                                <th>Код</th>
                                <th>Особовий</th>
                                <th>Жива черга\онлайн</th>
                            </tr>
                        @foreach ($periods as $key=>$period)

                        <tr class="rowInTable1 queue_period" data-value="{{substr($period['period_start_time'] ,0, -3)}}">
                            <td rowspan="{{$period['count']}}" class="contentInTable1" >{{substr($period['period_start_time'] ,0, -3)}} - {{substr($period['period_end_time'], 0, -3)}}</td>

                            @foreach ($period['queue'] as $k => $que)
                            @if ($k != 0)
                        <tr class="rowInTable1 queue_period" data-value="{{substr($period['period_start_time'] ,0, -3)}}">
                            @endif
                            <td class="contentInTable1">{{$que->user_name}}</td>
                            @if($que->is_real_queue)
                            <td class="contentInTable1">{{$que->real_queue_key}}</td>
                            @else
                            <td class="contentInTable1">{{substr($que->register_key,-4)}}</td>
                            @endif
                            <td class="contentInTable1">{{$que->user_personal_key}}</td>
                            @if($que->is_real_queue)
                            <td class="contentInTable1">Жива</td>
                            @else
                            <td class="contentInTable1">Онлайн</td>
                            @endif
                        </tr>
                        @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="container footer" id="footer">
            <div class="row footer-content">
                <div class="col-xs-3 footer-emblem">
                    <a href="http://www.oe.if.ua/"><img class="footer-img" src="./img/OE_logo.bmp"></a>
                </div>
                <div class="col-xs-6 obl-info">
                    <p class="obl-info-first">© ПАТ "Прикарпаттяобленерго" - 2015</p>
                    <p class="obl-info-second">Сайт ПАТ "Прикарпаттяобленерго" працює з 13.07.2001 року.</p>
                </div>
                <div class="col-xs-6"></div>
            </div>
        </div>
    </body>
<script>
    $(function(){
        /**
         * change periods by selected date
         */
    $('#dataToday').change(function(){//confirm present
        $.ajax({//send data
            dataType: 'json',
            method:"POST", //Todo Перевести на метод пост
            url: '{{ route('stat_queue_day_status') }}',
            data:{
                date : $(this).val(),
                _token: '{{csrf_token()}}'//todo вичитати про токени (повинні бути в кожному ajax запиті
            }
        }).done(function(data){//change labels and disable button

console.log(data);
            var res = '<caption>Таблиця моніторингу споживачів</caption>'+
                '<tr>'+
                '<th>Період</th>'+
                '<th>ПІП</th>'+
                '<th>Код</th>'+
                '<th>Особовий</th>'+
                '<th>Додати</th>'+
                '</tr> ';
            $.each(data.periods, function( key, period){
               res =  res + '<tr class="rowInTable1 queue_period" data-value="'+period.period_start_time.slice(0,-3)+'">'+
                    '<td rowspan="'+period.count+'" class="contentInTable1">'+period.period_start_time.slice(0,-3)+ '-'+ period.period_end_time.slice(0,-3)+'</td>';
                if(period.queue.length == 0){
                    res= res+ '</tr>';

                }else{
                    $.each(period.queue, function(k, que){
                        if (k != 0){
                            res = res +  '<tr class="rowInTable1 queue_period" data-value="'+period.period_start_time.slice(0,-3)+'">';
                        }
                        res = res + '<td class="contentInTable1">'+que.user_name+'</td>';
                        if(que.is_real_queue){
                            console.log(typeof que.register_key);
                            res = res+ '<td class="contentInTable1">'+que.register_key+'</td>';
                        }else{
                            res = res+ '<td class="contentInTable1">'+que.register_key+'</td>';
                        }
                           res = res + '<td class="contentInTable1">'+que.user_personal_key+'</td>';
                        if(que.is_real_queue){
                            res = res + '<td class="contentInTable1 btnConfirm">жива черга</td>';
                        }else{
                            res = res + '<td class="contentInTable1 btnConfirm">Інтернет черга';
                            res = res + '</td>';
                        }
                        res = res + '</tr>';
                    });
                }
            });

            $('#main_queue_table').children().remove();
            $('#main_queue_table').append(res);

            $('#all_day_all').text(data.counts.all);
            $('#all_day_real').text(data.counts.real_queue);
            $('#all_day_online').text(data.counts.online_queue);

            $('#day_period_all').text(data.counts.all);
            $('#day_period_real').text(data.counts.real_queue);
            $('#day_period_online').text(data.counts.online_queue);
            //hidePeriods();
        });
    });
    $('.statVud').click(function(){
        var time_start = $('#time_start').val();
        var time_end = $('#time_end').val();
        var count_all = 0;
        var count_real = 0;
        var count_online = 0;
        $('.queue_period').each(function(){
            if(time_start <= $(this).attr('data-value') && time_end > $(this).attr('data-value')){
                $(this).show();
                if($(this).children().length > 1){
                        if($(this).children().eq(4).text() == "Інтернет черга"){
                            count_real +=1;
                        }
                count_all += 1;
                }
            }else{
                $(this).hide();
            }
        });
        $('#day_period_all').text(count_all);
        $('#day_period_real').text(count_real);
        $('#day_period_online').text(count_all - count_real);
    });
    });
</script>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$myTest->topic->title}} - {{$myTest->student->fio}} </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <h1 class="my-5">{{$myTest->student->fio}} <small class="text-muted">{{$myTest->student->work}}</small></h1>
            </div>
            <div class="col col-12">
                <div class="alert alert-info"><b>{{$myTest->topic->title}}</b>
                    <hr><b>{{$myTest->student->fio}}</b>
                    <hr><b>Savollar soni: </b> {{$myTest->questionCount()}}
                    <hr><b>Boshlanish vaqti: </b> {{$myTest->created_at}}
                    <hr><b>Tamomlanish vaqti: </b> {{date('Y-m-d h:i:s', strtotime($myTest->created_at . ' +' . $myTest->topic->t_time . ' minutes'))}} <span class="badge badge-danger">+{{$myTest->topic->t_time}}</span>
                    <hr><b>Tugallangan vaqti: </b> {{$myTest->updated_at}}
                </div>
            </div>
            @php
                $increment = 0;
            @endphp
            @foreach($myTest->answers as $answer)
            @php
                $increment++;
            @endphp
            <div class="col col-12">
                <div id="{{$answer->question_id}}" class="alert alert-{{$answer->correct==0 ? 'danger' : 'success'}}">
                    <b>{{$increment}}. {{$answer->question->question_text}}</b>

                    <hr><b>Sizning javobingiz: </b> {{$answer->myvarint->option}} {{$answer->correct==0 ? '❌' : '✅'}}

                    <hr><b>To'g'ri javob: </b>
                    @foreach($answer->question->rights as $rightItem)
                        {{$rightItem->option}}
                    @endforeach;
                    <hr><b>{{$answer->created_at}} </b>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
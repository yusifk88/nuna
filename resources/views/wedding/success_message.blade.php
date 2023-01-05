<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuna - {{$wedding->tag}} . RSVP Successful </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container">


    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card mt-4" style="border: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">

                            @if($wedding->photo_one)
                                <img alt="photo of {{$wedding->groom_name}} and {{$wedding->bride_name}}"
                                     class="img-fluid img-thumbnail" src="{{$wedding->photo_one}}">
                            @elseif($wedding->photo_two)
                                <img alt="photo of {{$wedding->groom_name}} and {{$wedding->bride_name}}"
                                     class="img-fluid img-thumbnail" src="{{$wedding->photo_two}}">
                            @elseif($wedding->photo_three)
                                <img alt="photo of {{$wedding->groom_name}} and {{$wedding->bride_name}}"
                                     class="img-fluid img-thumbnail" src="{{$wedding->photo_three}}">
                            @elseif($wedding->photo_four)
                                <img alt="photo of {{$wedding->groom_name}} and {{$wedding->bride_name}}"
                                     class="img-fluid img-thumbnail" src="{{$wedding->photo_four}}">
                            @endif


                        </div>
                        <div class="col-md-8 text-center">

                            <h1 style="font-size: 70px">🎉</h1>

                            <h4>Thank you {{$name}}</h4>
                            <p class="text-muted">Wow! We are so touched by your generous effort to witness our wedding.
                                We would be more than happy to have you on our biggest day. Again thank you, we would be
                                expecting you.</p>

                            <a class="btn btn-primary btn-lg" href="{{url("/w",$wedding->tag)}}">Go back</a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuna - Support {{$wedding->groom_name}} and {{$wedding->bride_name}} </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mt-4" style="border: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 border">

                            <div class="alert alert-primary mt-2">
                                <p>Please fill the form to submit your gift to {{$wedding->groom_name}} and {{$wedding->bride_name}}.</p>
                            </div>
                            <form method="post" action="{{route('initCheckout',$wedding->id)}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name" class="text-muted mt-3">Name*</label>
                                        <input autofocus required class="form-control form-control-lg" id="name" type="text" name="name">
                                    </div>

                                      <div class="col-md-12">
                                        <label class="text-muted mt-3" for="email">Email*</label>
                                        <input required class="form-control form-control-lg" id="email" type="email" name="email">
                                    </div>


                                      <div class="col-md-12">
                                        <label class="text-muted mt-3" for="phone_number">Phone Number*</label>
                                        <input required class="form-control form-control-lg" id="phone_number" type="tel" name="phone_number">
                                    </div>


                                      <div class="col-md-12">
                                        <label class="text-muted mt-3" for="amount">Amount*</label>
                                        <input required class="form-control form-control-lg" id="amount" type="number" name="amount">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="text-muted mt-3" for="attending">Am attending</label>
                                        <input checked  id="attending" type="checkbox" name="attending">
                                    </div>

                                    <div class="col-md-12">
                                      <button class="btn btn-success btn-lg w-100 mt-5">Send Gift!</button>
                                    </div>


                                </div>
                            </form>

                        </div>
                        <div class="col-md-6 bg-light pt-3 text-center">


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

                            <h1 style="font-size: 50px" class="mt-5">Thank You❤️</h1>

                            <p class="text-muted">Thank you for the gift, we appreciate your kind gesture.</p>

                            <a class="btn btn-primary btn-lg btn-link w-100" href="{{url("/w",$wedding->tag)}}">Go back</a>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>

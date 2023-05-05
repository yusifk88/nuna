<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuna - Payment Successful</title>

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
                        <div class="col-md-6 mx-auto text-center">


                            <div class="alert alert-success text-center">
                                <h3>Payment successful!</h3>
                                You have successfully contributed <strong>GHS{{number_format($amount,2)}}</strong>
                                to <strong>{{$wedding->groom_name}} and {{$wedding->bride_name}}.</strong>
                                <br>We will notify them of your contribution
                                <h4>Thank You</h4>
                            </div>

                            <a class="btn btn-primary btn-lg" href="{{url("/w",$wedding->tag)}}">Back to wedding
                                page</a>


                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</body>
</html>
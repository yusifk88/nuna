<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify {{$user->first_name}}</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

</head>
<body class="bg-light">

<div class="container p-5">
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Verification Request</h3>
                    @if(!$user->approved)
                    <small class="text-warning">Pending</small>
                    @else
                        <small class="text-success">Verified</small>

                    @endif

                </div>
                <div class="card-body">
                    <h3>Photo of ID Card</h3>
                    <img class="img img-thumbnail" src="{{$request->card_image_url}}">


                    <div class="list-group">

                        <div class="list-group-item">
                            <p class="mb-0">{{$request->id_number}}</p>
                            <small>ID Number</small>
                        </div>


                        <div class="list-group-item">
                            <p class="mb-0">{{$request->id_type}}</p>
                            <small>ID Type</small>
                        </div>




                    </div>
                </div>
            </div>




            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">User Information</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">

                        <div class="list-group-item">
                            <p class="mb-0">{{$user->first_name}} {{$user->last_name}}</p>
                            <small>Name</small>
                        </div>


                        <div class="list-group-item">
                            <p class="mb-0">{{$user->birth_date}}</p>
                            <small>Date of birth</small>
                        </div>

                        <div class="list-group-item">
                            <p class="mb-0">{{$user->phone_number}}</p>
                            <small>Phone Number</small>
                        </div>

                        <div class="list-group-item">
                            <p class="mb-0">{{$user->country_code}}</p>
                            <small>Country</small>
                        </div>

                        <div class="list-group-item">
                            <p class="mb-0">{{$user->email}}</p>
                            <small>Email</small>
                        </div>


                    </div>
                </div>


                <div class="card-footer">
                    @if(!$user->approved)
                    <a href="{{route('verifyAccount',$request->uuid)}}" class="btn btn-success btn-lg w-100 text-white">Verify</a>

                    @else
                        <div class="alert alert-success">
                            This account was already verified
                        </div>

                        <a href="{{route('unverifyAccount',$request->uuid)}}" onclick="return confirm('Are you sure you want to unverify this account? they user would be notified')" class="btn btn-danger btn-lg w-100 text-white" >Unverify</a>

                    @endif
                </div>

            </div>


        </div>
    </div>

</div>

</body>
</html>

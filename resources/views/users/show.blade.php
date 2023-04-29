<x-app-layout>
    <section class="section dashboard">

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>User info.</h3>
                    </div>
                    <div class="card-body">

                        <div class="list-group list-group-flush">

                            <div class="list-group-item border-bottom">
                                @if($user->approved)
                                    <span class="badge bg-success-light text-success p-3">Verified</span>

                                @else

                                    <span
                                        class="badge bg-warning-light p-3 text-warning p-3">Pending Verification</span>

                                @endif
                            </div>

                            <div class="list-group-item border-bottom">
                                <h4>{{$user->first_name}} {{$user->last_name}}</h4>
                                <small class="text-muted">Name</small>
                            </div>

                            <div class="list-group-item border-bottom">
                                <h4>{{$user->email}}</h4>
                                <small class="text-muted">Email</small>
                            </div>

                            <div class="list-group-item border-bottom">
                                <h4>{{$user->phone_number}}</h4>
                                <small class="text-muted">Phone Number </small>
                            </div>

                            <div class="list-group-item border-bottom">
                                <h4>{{$user->birth_date}}</h4>
                                <small class="text-muted">Birth Date </small>
                            </div>

                            <div class="list-group-item border-bottom">
                                <h4>{{$user->country_code}}</h4>
                                <small class="text-muted">Country </small>
                            </div>


                        </div>

                    </div>
                </div>

                @if($identity)
                    <div class="card">
                        <div class="card-header">
                            <h3>Identity info.</h3>
                        </div>
                        <div class="card-body">

                            <img src="{{$identity->card_image_url}}" class="img-fluid">

                            <div class="list-group list-group-flush">

                                <div class="list-group-item border-bottom">
                                    <h4>{{$identity->id_type}}</h4>
                                    <small class="text-muted">ID Type</small>
                                </div>

                                <div class="list-group-item border-bottom">
                                    <h4>{{$identity->id_number}}</h4>
                                    <small class="text-muted">ID Number</small>
                                </div>


                            </div>

                        </div>
                    </div>

                @endif
            </div>
            <div class="col-md-8">
                <div class="card top-selling overflow-auto">
                    <div class="card-header">
                        <h3>Events info.</h3>
                    </div>

                    <div class="card-body">

                        <table class="table table-borderless">

                            <thead>
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">tag</th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($weddings as $wedding)
                                <tr>
                                    <th scope="row"><a><img class="img-fluid"
                                                src="{{$wedding->photo_one}}" alt=""></a></th>
                                    <td><a  target="_blank" href="{{\App\Services\UtilityService::APP_URL."/w/".$wedding->tag}}" class="text-primary fw-bold">{{$wedding->tag}}</a></td>

                                    <td>{{$wedding->created_at}}</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </section>
</x-app-layout>

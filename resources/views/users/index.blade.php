<x-app-layout>
    <section class="section dashboard">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$users->total()}}</h6>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-borderless datatable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Birth Date</th>
                                <th>Country</th>
                                <th>Verified?</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)

                                <tr>
                                    <td ><a href="{{route("users.show",$user->id)}}">{{$user->first_name}} {{$user->last_name}}</a></td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->birth_date}}</td>
                                    <td>{{$user->country_code}}</td>
                                    <td>
                                        @if($user->approved)
                                            <span class="badge bg-success-light p-2 text-success">Approved</span>

                                        @else

                                            <span class="badge bg-warning-light p-2 text-warning">Pending</span>

                                        @endif

                                    </td>

                                    <td>
                                        {{$user->created_at}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>

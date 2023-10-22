<x-app-layout>
    <section class="section dashboard">


        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center p-3">
                        <h2>10</h2>
                        <small>All</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center p-3">
                        <h2 class="text-success">10</h2>
                        <small class="text-success">Verified</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center p-3">
                        <h2 class="text-danger">30</h2>
                        <small class="text-danger">Unverified</small>
                    </div>
                </div>
            </div>


            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2>Verification Requests</h2>
                    </div>
                    <div class="card-body">

                        <table class="table table-sm table-striped">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>ID type</th>
                                <th>ID Number</th>
                                <th>Created At</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($verifications as $verification)

                                @if($verification)
                                    <tr>
                                        <td>

                                            <a href="{{route("users.show",$verification->user->id)}}">
                                                {{$verification->user->first_name}} &nbsp; {{$verification->user->last_name}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$verification->id_type}}
                                        </td>

                                        <td>
                                            {{$verification->id_number}}
                                        </td>
                                        <td>
                                            {{$verification->created_at}}
                                        </td>
                                    </tr>
                                @endif

                            @endforeach

                            </tbody>
                        </table>

                        {{$verifications->links()}}
                    </div>
                </div>
            </div>
        </div>

    </section>
</x-app-layout>

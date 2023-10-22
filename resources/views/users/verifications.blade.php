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

                            @foreach($items as $item)

                                @if($item)
                                    <tr>
                                        <td>

                                            <a href="{{route("users.show",$item->user->id)}}">
                                                {{$item->user->first_name}} &nbsp; {{$item->user->last_name}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$item->id_type}}
                                        </td>

                                        <td>
                                            {{$item->id_number}}
                                        </td>
                                        <td>
                                            {{$item->created_at}}
                                        </td>
                                    </tr>
                                @endif

                            @endforeach

                            </tbody>
                        </table>

                        {{$items->links()}}
                    </div>
                </div>
            </div>
        </div>

    </section>
</x-app-layout>

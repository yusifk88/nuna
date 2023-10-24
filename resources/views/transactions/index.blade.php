<x-app-layout>
    <section class="section dashboard">

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table class="table table-borderless datatable">
                            <thead>
                            <tr>
                                <th scope="col">Amount</th>
                                <th scope="col">Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Event</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($transactions as $transaction)
                                @if($transaction->wedding)


                                <tr>
                                    <td>{{number_format($transaction->amount,2)}}</td>
                                    <td>{{$transaction->name}}</td>
                                    <td>{{$transaction->phone_number}}</td>
                                    <td><a target="_blank" href="{{\App\Services\UtilityService::APP_URL."/w/".$transaction->wedding->tag}}" class="text-primary">{{$transaction->wedding->tag}}</a></td>
                                    <td>
                                        @if($transaction->success)
                                            <span class="badge bg-success-light text-success">Success</span>

                                        @else

                                            <span
                                                class="badge bg-danger-light p-3 text-danger">Failed/Pending</span>

                                        @endif
                                    </td>
                                    <td>{{$transaction->created_at}}</td>
                                </tr>


                                @endif
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer">
                        {{$transactions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

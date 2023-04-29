<x-app-layout>
    <section class="section dashboard">

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card top-selling overflow-auto">
                    <div class="card-body">
                        <table class="table table-borderless datatable">

                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">tag</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Total Charge</th>
                                <th scope="col">Withdrawn</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $charge_rate = \App\Services\UtilityService::CHARGE_RATE;
                            ?>
                            @foreach($weddings as $wedding)
                                <tr>
                                    <th scope="row"><a><img
                                                src="{{$wedding->photo_one}}" alt=""></a></th>
                                    <td><a target="_blank"
                                           href="{{\App\Services\UtilityService::APP_URL."/w/".$wedding->tag}}"
                                           class="text-primary fw-bold">{{$wedding->tag}}</a></td>
                                    <td>GHS{{number_format((double)$wedding->total_amount_sum_amount,2)}}</td>
                                    <td>
                                        GHS{{number_format((double)$wedding->total_amount_sum_amount*$charge_rate,2)}}</td>
                                      <td>
                                        GHS{{number_format((double)$wedding->withdraw_amount,2)}}</td>

                                    <td><a href="{{route("users.show",$wedding->user_id)}}"
                                           class="text-primary fw-bold">{{$wedding->user->first_name}}</a></td>
                                    <td>{{$wedding->created_at}}</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{$weddings->links()}}
                    </div>
                </div>
            </div>
        </div>
        <section>
</x-app-layout>

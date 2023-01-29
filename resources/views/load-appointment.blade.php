<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
    </tr>
    </thead>

    <tbody>
    @if($appointments->count() > 0)
        @foreach($appointments as $key => $appointment)

            <tr class="@if($loop->first && $appointments->currentPage() == 1) bg-success @endif">
                <th scope="row">{{$key+1}}</th>
                <td>{{$appointment->name}}</td>
                <td>{{$appointment->phone}}</td>
                <td>{{convertDateTimeToUserTimeZone(auth()->user()->timezone,$appointment->date,'d-m-Y')}}</td>
                <td>{{convertDateTimeToUserTimeZone(auth()->user()->timezone,$appointment->time,'h:i a')}}</td>
            </tr>
        @endforeach

    @else
        <tr >
            <th colspan="5" class="text-center"> No record Found </th>
        </tr>
    @endif
    </tbody>
</table>

<div class="pagination justify-content-center">
{!!$appointments->links() !!}
</div>


<div class="table-responsive" >
    
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#Game</th>
                <th scope="col">Status</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gameRooms as $room)
                <tr>
                    <td>{{ sprintf("%04d", $room->id)  }}</td>
                    <td>{{ $room->status }}</td>
                    <td>{{ $room->created_at }}</td>
                    <td>
                        <button class="btn btn-success btn-sm">Start</button>
                        <button class="btn btn-danger btn-sm">Cancle</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

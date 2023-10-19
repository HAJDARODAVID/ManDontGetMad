<div style="display: inline">
    <button class="btn btn-primary btn-sm" 
    wire:click='showModal({{ $user }})'>Join</button>

    
    <!-- Modal -->
    <div class="modal" id="joinInRoomsModal" style="display: {{ $display }}">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="availablRooms">Availabl rooms: {{ $selectedUser }}</h5>
            <button type="button" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('joinInRoomsModal').style.display='none';">
                X
            </button>
            </div>
            <div class="modal-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#Game</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                    <tr>
                        <th scope="row">{{ sprintf("%04d", $room->id) }}</th>
                        <td>{{ $room->created_at }}</td>
                        <td>
                        <button type="button" class="btn btn-success" wire:click="joinRoom({{ $room->id }})"
                            onclick="event.preventDefault(); document.getElementById('joinInRoomsModal').style.display='none';"
                            >
                            Join
                        </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>

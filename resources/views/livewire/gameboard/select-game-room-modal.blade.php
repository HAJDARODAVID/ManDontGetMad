

<div >
<!-- Modal -->
<div class="modal" id="availablRoomsModal" style="display: {{ $display }}" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddNewAdmItem">Add new menu item</h5>
        <button type="button" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('availablRoomsModal').style.display='none';">
          X
        </button>
      </div>
      <div class="modal-body" wire:poll.5s.visible>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#Game</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($availableRooms as $rooms)
                <tr>
                  <th scope="row">{{ $rooms->id }}</th>
                  <td>{{ $rooms->created_at }}</td>
                  <td>
                    <button type="button" class="btn btn-success" wire:click="joinRoom({{ $rooms->id }})">
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

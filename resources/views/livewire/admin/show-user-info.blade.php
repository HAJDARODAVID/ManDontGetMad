<div style="display: inline">
    <button class="btn btn-success btn-sm" wire:click='showModal'>Show</button>

    <!-- Modal -->
    <div class="modal" id="showUserInfo-{{ $user }}" style="display: {{ $display }}">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="availablRooms">Player info:</h5>
            <button type="button" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('showUserInfo-{{ $user }}').style.display='none';">
                X
            </button>
            </div>
            <div class="modal-body">
                <h5>@isset($userInfo->name){{ $userInfo->name }} #{{ sprintf("%04d",$userInfo->id) }}@endisset</h5>
                <p>@isset($userInfo->name){{ $userInfo->email }}@endisset</p>
                Last request: @isset( $userInfo->getLastRequest->updated_at){{ $userInfo->getLastRequest->updated_at }}@endisset <br>
                Active game: 
                    @isset($userInfo->getPlayerRoom->game_id){{ sprintf("%04d",$userInfo->getPlayerRoom->game_id) }}@endisset
                    @isset($userInfo->getPlayerRoom->getGameInfo->status) {{ '['.$userInfo->getPlayerRoom->getGameInfo->status.']' }} @endisset 
                <br><br>
                <a class="btn btn-primary">Edit user</a>
            </div>
        </div>
        </div>
    </div>
</div>

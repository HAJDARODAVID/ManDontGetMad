<div class="table-responsive" wire:poll>
    
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#Player</th>
                <th scope="col">Name</th>
                <th scope="col">Is online</th>
                <th scope="col">Active game</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
                <tr>
                    <td>{{ sprintf("%04d", $player->id)  }}</td>
                    <td>{{ $player->name }}</td>
                    <td>YES</td>
                    <td>{{ sprintf("%04d",$player->getPlayerRoom->game_id ?? '0') }} [{{ $player->getPlayerRoom->getGameInfo->status ?? '0' }}]</td>
                    <td>
                        <button class="btn btn-success btn-sm">Show</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

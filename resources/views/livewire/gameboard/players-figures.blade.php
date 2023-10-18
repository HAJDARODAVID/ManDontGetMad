<div>
    <p>IGRAČI!</p>
    @foreach ($players as $player)
        
        {{ $player->user_id }} - {{ $player->getPlayerInfo->name }}<br>
    @endforeach
</div>

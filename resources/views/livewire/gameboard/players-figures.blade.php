<div>   
    
    @foreach ($players as $player) 
        <span class="playerFigure" style="left: {{ $player->getFieldInfo->left }}px; top: {{ $player->getFieldInfo->top }}px; border-color: #{{$player->getFigureInfo->color }};"></span>
    @endforeach
</div>

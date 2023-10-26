<div wire:poll>   
    @foreach ($players as $player) 
        <div class="playerFigure" style="left: {{ $player->getFieldInfo->left }}px; top: {{ $player->getFieldInfo->top }}px; border-color: #{{$player->getFigureInfo->color }};font-size: 40px;">
            <div style="position: absolute;top:-5px; left:7px"> &{{ $player->getFigureSymbol->code }}</div>
        </div>
    @endforeach
</div>


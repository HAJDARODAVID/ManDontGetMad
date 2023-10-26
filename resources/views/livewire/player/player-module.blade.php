<div class="card" wire:poll>
    
    <div class="card-header">
        <span style="color: #@isset($playerInfo->getFigureInfo->color){{$playerInfo->getFigureInfo->color}}@endisset"><b>{{ Auth::user()->name }} </b></span> [#game: @isset($playerInfo->game_id) {{ $playerInfo->game_id }} @endisset]
    </div>

    {{-- Card-body if it's not the players turn --}}
    <div class="card-body" style="display: @if($playerInfo->isMyTurn!=1){{ __('block') }}@else{{ __('none') }} @endif">
        Its not your turn!
    </div>

    {{-- Card-body if player is on turn --}}
    <div style="display: @if($playerInfo->isMyTurn==1){{ __('block') }}@else{{ __('none') }} @endif">
        <div class="card-body">
            Its your turn! Throw the dice!! {{ $diceThrows }}x<br>
            <button wire:click='throwDice'>Throw dice</button> {{ $diceValue }}
        </div>

        <div class="card-body">
        
            @foreach ($playerFigures as $figure)
                <button wire:click='moveFigure({{ $figure->figure_sub_id }})'>{{ $figure->figure_sub_id }}</button><br>   
            @endforeach
        </div>

    </div>
    
</div>

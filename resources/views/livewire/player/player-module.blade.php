<div class="card" wire:poll>
    
    <div class="card-header">
        <span style="color: #@isset($playerInfo->getFigureInfo->color){{$playerInfo->getFigureInfo->color}}@endisset"><b>{{ Auth::user()->name }} </b></span> [#game: @isset($playerInfo->game_id) {{ $playerInfo->game_id }} @endisset]
        @if ($playerInfo->isMyTurn==1)
            ->Turn: {{ $diceThrows }}x    
        @endif
        
    </div>

    {{-- Card-body if it's not the players turn --}}
    <div class="card-body" style="display: @if($playerInfo->isMyTurn!=1){{ __('block') }}@else{{ __('none') }} @endif">
        Its not your turn!
    </div>

    {{-- Card-body if player is on turn --}}
    <div style="display: @if($playerInfo->isMyTurn==1){{ __('block') }}@else{{ __('none') }} @endif">
        <div class="card-body">
            <div class="text-center" style="display: @if($displayBtn) {{ __('block') }} @else {{ __('none') }} @endif">
                <button class="btn btn-success" wire:click='throwDice'>Throw dice!!</button>
            </div>    
            {{-- Show dice --}}
            @isset($diceIcon)
                <div style="background-color: none;height:60px">
                    <div class="text-center" style="position:absolute; top:80px;left:140px">
                        <span style="font-size: 60px;">&{{ $diceIcon }}</span>
                    </div> 
                </div>     
            @endisset  
        </div>

        {{-- Move buttons --}}
        <div class="card-body">
            @foreach ($playerFigures as $figure)
                <div class="text-center" style="margin-bottom: 5px">
                    <button class="btn btn-primary" style="width:250px;" wire:click='moveFigure({{ $figure->figure_sub_id }})'>
                        <span style="font-size: 25px">&{{ $figure->getFigureSymbol->code }}</span>
                    </button>
                </div>  
            @endforeach
        </div>

    </div>
    
</div>

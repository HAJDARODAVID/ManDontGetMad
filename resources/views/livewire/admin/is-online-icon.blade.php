<div wire:poll>
    @if ($isOnline)
        <div style="height: 15px; width: 15px;border-radius: 50%; background-color:green;"></div> 
    @else
        <div style="height: 15px; width: 15px;border-radius: 50%; background-color:red;"></div>
    @endif   
</div>

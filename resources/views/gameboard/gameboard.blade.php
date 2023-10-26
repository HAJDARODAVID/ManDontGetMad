@extends('layouts.game')

@section('content')

<livewire:gameboard.select-game-room-modal  display="{{ $displayModal }}"/>





<div class="gameplata" style="position:absolute;top:260px;left:550px;display: block">

  
    
  {{-- Gameboard-shape --}}
  <div class="hexagon" style="transform: rotate(90deg);"><span></span></div>

  @if (Auth::user()->type == 2)
    @livewire('gameboard.admin-figure')
  @endif
  
  @if (session('gameRoom'))
    <livewire:gameboard.players-figures gameId="{{ session('gameRoom') }}" /> 
  @endif
  

  {{-- Starting-positions --}}
  <x-gameboard.home :top="540" :left="200" color="ff0000" :rotation="0"></x-gameboard.home>
  <x-gameboard.home :top="212" :left="-69" color="51ff00" :rotation="54.5"></x-gameboard.home>
  <x-gameboard.home :top="-172" :left="148" color="2529ff" :rotation="122.5"></x-gameboard.home>
  <x-gameboard.home :top="-201" :left="539" color="ff29f4" :rotation="180"></x-gameboard.home>
  <x-gameboard.home :top="128" :left="808" color="12da97" :rotation="234.5"></x-gameboard.home>
  <x-gameboard.home :top="512" :left="591" color="383e42" :rotation="302.5"></x-gameboard.home>

  {{-- Move fields --}}
  <x-gameboard.move-fields top="399" left="358" rotation="0" baseColor="ff0000" id=""></x-gameboard.move-fields>
  <x-gameboard.move-fields top="249" left="78" rotation="54.5" baseColor="51ff00" id=""></x-gameboard.move-fields>
  <x-gameboard.move-fields top="-56" left="87" rotation="122.5" baseColor="2529ff" id=""></x-gameboard.move-fields>
  <x-gameboard.move-fields top="-213" left="353" rotation="180" baseColor="ff29f4" id=""></x-gameboard.move-fields>
  <x-gameboard.move-fields top="-62" left="634" rotation="234.5" baseColor="12da97" id=""></x-gameboard.move-fields>
  <x-gameboard.move-fields top="244" left="623" rotation="302.5" baseColor="383e42" id=""></x-gameboard.move-fields>
</div>





<script>
    // Make the DIV element draggable:
dragElement(document.getElementById("helper"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

let player = document.getElementById('helper')
function getPosition() {
    let cs = getComputedStyle(player);
    console.log("Top: " + cs.getPropertyValue('top'));
    console.log("Left: " + cs.getPropertyValue('left'));
}

</script>





@endsection
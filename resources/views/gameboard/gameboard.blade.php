@extends('layouts.game')

@section('content')
<div class="gameplata" style="position:fixed;top:260px;left:250px;">
    {{-- Gameboard-shape --}}
    <div class="hexagon" style="transform: rotate(90deg);"><span></span></div>
    
    {{-- Starting-positions --}}
    <x-gameboard.home :top="540" :left="200" color="ff0000" :rotation="90"></x-gameboard.home>
    <x-gameboard.home :top="212" :left="-69" color="51ff00" :rotation="144.5"></x-gameboard.home>
    <x-gameboard.home :top="-172" :left="148" color="2529ff" :rotation="32.5"></x-gameboard.home>
    <x-gameboard.home :top="-201" :left="539" color="ff29f4" :rotation="90"></x-gameboard.home>
    <x-gameboard.home :top="128" :left="808" color="12da97" :rotation="144.5"></x-gameboard.home>
    <x-gameboard.home :top="512" :left="591" color="fae62f" :rotation="32.5"></x-gameboard.home>

    <div id="c" class="circle" style="top:80;left:0"> </div>
</div>





<script>
    // Make the DIV element draggable:
dragElement(document.getElementById("c"));

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

let player = document.getElementById('home')
function getPosition() {
    let cs = getComputedStyle(player);
    console.log("Top: " + cs.getPropertyValue('top'));
    console.log("Left: " + cs.getPropertyValue('left'));
}

</script>





@endsection
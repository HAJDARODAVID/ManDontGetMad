@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
</div>

  
<div class="container">
  <div class="row">
    <div class="col-sm">
      {{-- Header --}}
      <div class="row">
        <div class="col-sm">
          <h4>Game room's:</h4>
        </div>
        <div class="col-sm">
          <livewire:admin.create-new-room>  
        </div>
      </div>
      <br>
      {{-- Body --}}
      <livewire:admin.get-all-game-room-table />
    </div>  
    <div class="col-sm">
      <h4>Player status:</h4>
      <br>
      {{-- Body --}}
      <livewire:admin.get-all-users />
    </div>
  </div>
</div>
@endsection

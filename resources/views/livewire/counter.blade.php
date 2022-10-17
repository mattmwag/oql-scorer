<div style="text-align:center">
    <button wire:click="incrementPos">+15</button>
    <button wire:click="incrementNeg">-5</button>
    <h1>{{ $countPos  }} {{ $countNeg }} <span style="color:red">{{$countPos + $countNeg}}</span></h1>
</div>

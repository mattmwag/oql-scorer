<div>
    <table class="table table-bordered">
        <tr>
            <th>{{ $team1->name }}</th><th><button wire:click="increment(1, 0, 10)">+10</button><button wire:click="increment(1, 0, 5)">+5</button>
                <h1> <span style="color:red">{{$t1bonuses}}</span><span> Total: </span>{{ $t1bonuses + $t1p1 + $t1p2 + $t1p3 + $t1p4 + $t1p1neg + $t1p2neg + $t1p3neg + $t1p4neg }}</h1></th>
        </tr>
        @for ($i = 1; $i < 5; $i++)
            <tr>
                <td> Player {{ $i }}</td><td><select wire:model="t1p{{ $i }}_id" name="players" id="players">
                        <option>Select Player {{ $i }}</option>
                        @foreach ($team1->players()->get() as $player)
                            <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select><button wire:click="increment(1, {{ $i }}, 20)">+20</button><button wire:click="increment(1, {{ $i }}, -10)">-10</button>
                    <span>Buzzes: </span><span style="color:red">{{ ${"t1p".$i} }}</span><span> Negs: </span><span style="color:red">{{ ${"t1p{$i}neg"} }}</span><span> Total: </span>{{  ${"t1p".$i} + ${"t1p{$i}neg"} }}</td>
            </tr>
        @endfor
    </table>
    <table class="table table-bordered">
        <tr>
            <th>{{ $team2->name }}</th><th><button wire:click="increment(2, 0, 10)">+10</button><button wire:click="increment(2, 0, 5)">+5</button>
                <h1> <span style="color:red">{{$t2bonuses}}</span><span> Total: </span>{{ $t2bonuses + $t2p1 + $t2p2 + $t2p3 + $t2p4 + $t2p1neg + $t2p2neg + $t2p3neg + $t2p4neg }}</h1></th>
        </tr>
        @for ($i = 1; $i < 5; $i++)
            <tr>
                <td> Player {{ $i  }}</td><td><select wire:model="t2p{{ $i }}_id" name="players" id="players">
                    <option>Select Player {{ $i }}</option>
                    @foreach ($team2->players()->get() as $player)
                            <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select><button wire:click="increment(2, {{ $i }}, 20)">+20</button><button wire:click="increment(2, {{ $i }}, -10)">-10</button>
                    <span>Buzzes: </span><span style="color:red">{{ ${"t2p".$i} }}</span><span> Negs: </span><span style="color:red">{{ ${"t2p{$i}neg"} }}</span><span> Total: </span>{{  ${"t2p".$i} + ${"t2p{$i}neg"} }}</td>
            </tr>
        @endfor
    </table>
    <button wire:click="save">Close and Save</button>
</div>
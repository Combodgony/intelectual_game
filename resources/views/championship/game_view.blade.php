<?php

if (!isset($game)) {
    return;
}
if (!isset($next_game_id_collapse)) {
    $next_game_id_collapse = 234234;
}
$collaps_id = rand(0, 99999999);
$collaps_id1 = rand(0, 99999999);

$preGame = \App\Models\Game::where('next_game_id', '=', $game->id)->get();

?>

<div id="card-{{$collaps_id}}">

    <div class="card">
        <div class="card-game-header">
            <a class="card-link collapsed" data-toggle="collapse"
               data-parent="#card-{{$next_game_id_collapse}}" href="#card-element-{{$collaps_id1}}">
                Игра № {{$game->id}}
            </a>
            <biv class="action">

                @if($game->status==\App\Models\Game::STATUS_PlAN)
                    <a href="{{ backpack_url('game/'.$game->id.'/generate_scenario') }}">Generate scenario <i
                                class="fa fa-gear"></i></a>
                @endif
                @if($game->status==\App\Models\Game::STATUS_GENERATED)
                    <a href="{{ backpack_url('scenario/'.$game->id.'/view') }}">View scenario <i
                                class="fa fa-eye"></i></a>
                @endif


                <a href="{{ backpack_url('game/'.$game->id.'/edit') }}">Edit <i class="fa fa-edit"></i></a>
            </biv>
        </div>
        <div id="card-element-{{$collaps_id1}}" class="collapse">
            <div class="card-body">
                {{--<div>Описание игры может результаты или кнопки просто</div>--}}
                @if(count($preGame)>0)
                    @foreach($preGame as $preGame1)
                        @include('championship.game_view', ['game'=>$preGame1,'next_game_id_collapse'=>$collaps_id1])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

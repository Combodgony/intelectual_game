<?php

if (!isset($game)) {
    return;
}
if (!isset($next_game_id_collapse)) {
    $next_game_id_collapse = 234234;
}
$collaps_id = rand(0, 99999999);
$collaps_id1 = rand(0, 99999999);
?>

<div id="card-{{$collaps_id}}">

    <div class="card">
        <div class="card-header">
            <a class="card-link collapsed" data-toggle="collapse"
               data-parent="#card-{{$next_game_id_collapse}}" href="#card-element-{{$collaps_id1}}">
                Игра № {{$game->id}}
            </a>
        </div>
        <div id="card-element-{{$collaps_id1}}" class="collapse">
            <div class="card-body">
                {{--<div>Описание игры может результаты или кнопки просто</div>--}}

                <?php
                $preGame = \App\Models\Game::where('next_game_id', '=', $game->id)->get();
                ?>

                @if(count($preGame)>0)
                    @foreach($preGame as $preGame1)
                        @include('championship.game_view', ['game'=>$preGame1,'next_game_id_collapse'=>$collaps_id1])
                    @endforeach
                @endif


            </div>
        </div>
    </div>
</div>

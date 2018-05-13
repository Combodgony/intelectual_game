@extends('scenarion.generate')
@section('scenario')
    <style>
        .scenario {
            display: flex;
            flex-direction: column;
        }

        .scenarion-blok-content {
            margin-left: 25px;
        }

        .scenarion-info {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .scenarion-info .scenarion-blok-content {
            margin-left: 0px;
        }

        .round{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    </style>

    <div class="scenario">
        <div class="scenario-block">
            <h2>Игра № {{$game->id}}</h2>
        </div>
        <div class="scenarion-info">
            <div class="scenario-block">
                <h3>Жюри</h3>
                <div class="scenarion-blok-content">
                    @foreach($game->jury as $jur)
                        {{$jur->name}} <br>
                    @endforeach
                </div>
            </div>
            <div class="scenario-block">
                <h3>Учасники</h3>
                <div class="scenarion-blok-content">
                    @foreach($game->participants as $participant)
                        {{$participant->name}} <br>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="scenario-block">
            <h3>Вопросы</h3>
            <div class="scenarion-blok-content">
                @foreach($game->rounds as $round)
                    <div class="round">
                        <h4><b>Раунд: {{$round->name}}</b></h4>
                        <i>({{$round->max_rating_per_question}} б.)</i>
                    </div>

                    <div class="scenarion-blok-content">
                        @foreach($game->gameParticipants as $participant)
                            <h4>Учасник: {{$participant->command->name}}</h4>

                            <div class="scenarion-blok-content">
                                <?php
                                $questions = \App\Models\GameQuestion::
                                    leftJoin('questions', 'questions.id', '=', 'question_of_game.question_id')
                                    ->where('game_id','=',$game->id)
                                    ->where('participant_of_game_id','=',$participant->id)
                                    ->where('round_id','=',$round->id)->get();
                                ?>

                                @foreach($questions as $question)
                                        {{$question->question}} ({{$question->answer}})<br>
                                @endforeach
                            </div>

                        @endforeach
                    </div>



                @endforeach
            </div>
        </div>

    </div>


@endsection
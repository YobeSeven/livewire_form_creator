@extends("layouts.index")
@section("content")
    <h1 class="text-danger">All answers of form : {{$form->name}}</h1>
    @foreach ($answerForms as $answerForm)
    <h1>{{$answerForm->user}}</h1>
        @foreach ($answerForm->answerQuestions as $answerQuestion)
            <h1>Question : {{ $answerQuestion->question->question }}</h1>
            <h3>Type : {{$answerQuestion->question->type}}</h3>
            @switch($answerQuestion->question->type)
                @case("simple")
                @case("complexe")
                    <h2>Answer : {{ $answerQuestion->answer }}</h2>
                @break
                @case("choix unique")
                @case("choix multiple")
                    <h2>Answer :  {{$answerQuestion->answer}}</h2>
                    @foreach ($answerQuestion->answerChoices as $choice)
                        <h3> choix :{{$choice->choice->choice}} {{$choice->choice->id}}</h3>
                    @endforeach
                @break
                @default
            @endswitch
            <hr>
        @endforeach
        <hr>
    @endforeach
@endsection
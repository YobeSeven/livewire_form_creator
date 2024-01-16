@extends("layouts.index")
@section("content")
    <h1 class="text-danger">FORM : {{$form->name}}</h1>
    <form action="{{route("forms.store" , $form->id)}}" method="POST">
        @csrf
        <div>
            <label for="user">User name</label>
            <input type="text" name="user" id="user">
        </div>
        @foreach ($questions as $question)
            @switch($question->type)
                @case('simple')
                    <div>
                        <label for="reponse_{{ $question->id }}">{{ $question->question }}</label>
                        <input type="text" name="reponse_{{ $question->id }}" id="reponse_{{ $question->id }}" required>
                    </div>
                @break

                @case('complexe')
                    <div>
                        <label for="reponse">{{ $question->question }}</label>
                        <textarea name="reponse_{{ $question->id }}" id="reponse_{{ $question->id }}" cols="30" rows="10" required></textarea>
                    </div>
                @break
                @case('choix unique')
                    <div>
                        <label for="reponse">{{ $question->question }}</label>
                        <div>
                            @foreach ($question->choices->sortBy("order") as $choice)
                                <label for="reponse_{{ $question->id }}">{{$choice->choice}}</label>
                                <input type="radio" name="reponse_{{ $question->id }}" id="reponse_{{ $question->id }}" value="{{$choice->choice}}" required>
                            @endforeach
                        </div>
                    </div>
                @break
                @case('choix multiple')
                    <div>
                        <label for="reponse_{{ $question->id }}">{{$question->question}}</label>
                        <div>
                            @foreach ($question->choices->sortBy("order") as $choice)
                                <label for="reponse_{{ $question->id }}">{{$choice->choice}}</label>
                                <input type="checkbox" name="reponse_{{ $question->id }}[]" id="reponse_{{ $question->id }}_{{ $choice->id }}" value="{{$choice->choice}}">
                                @endforeach
                        </div>
                    </div>
                @break
                @default
            @endswitch
            <hr>
        @endforeach
        <button class="btn btn-primary" type="submit">Envoyer le formulaire</button>
    </form>
@endsection
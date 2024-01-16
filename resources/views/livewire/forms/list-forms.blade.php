<div>
    @foreach ($forms as $form)
        {{-- Info form --}}
        <div>
            <h3>{{$form->id}}</h3>
            <h1>Formulaire :{{$form->name}}</h1>
            <h1>Créateur :{{$form->user}}</h1>
        </div>

        {{-- Destroy --}}
        <form wire:submit.prevent="destroy({{ $form->id }})">
            <input type="hidden" name="form_id" value="{{ $form->id }}">
            <button class="btn btn-danger" type="submit">Supprimer le formulaire</button>
        </form>
        {{-- Finish --}}
        @if ($form->finish)
            <a href="{{route("forms.form" , $form->id)}}">
                <h2>Fill Form</h2>
            </a>
            <a href="{{route("forms.show", $form->id)}}">
                <h2>Answers Form</h2>
            </a>
            @else
        {{-- Edit form --}}
        <a href="{{route("forms.edit" , $form->id)}}">
            <h2>Edit form</h2>
        </a>
        @endif
    @endforeach
</div>

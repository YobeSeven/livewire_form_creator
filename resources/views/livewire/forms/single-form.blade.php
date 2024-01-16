<div>
    <h1 class="text-primay">FORM : {{ $form->name }}</h1>
    <h2 class="text-sucess">CREATOR : {{ $form->user }}</h2>

    <form wire:submit.prevent="storeQuestion">
        {{-- wire:submit.prevent="storeQuestion" --}}
        <div>
            <label for="question">Write your question here :</label>
            <input type="text" wire:model="question" name="question" id="question" required>
        </div>
        <div>
            <label for="type">Choose the type of your question :</label>
            <select wire:model="type" name="type" id="type" required>
                <option value="simple">Simple</option>
                <option value="complexe">Complexe</option>
                <option value="choix unique">Choix Unique</option>
                <option value="choix multiple">Choix Multiple</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Add question</button>
    </form>
    <hr>

    @foreach ($questions as $question)
        <div>
            <h1>Question : {{ $question->question }}</h1>
            <h2>TYPE : {{ $question->type }}</h2>
        </div>

        <div>
            <h2>Order : {{ $question->order }}</h2>
            @if ($question->id !== $firstQuestion->id)
                <form wire:submit.prevent="orderUpQuestion({{ $question->id }})">
                    <button type="submit">Up</button>
                </form>
            @endif
            @if ($question->id !== $lastQuestion->id)
                <form wire:submit.prevent="orderDownQuestion({{ $question->id }})">
                    <button type="submit">Down</button>
                </form>
            @endif
        </div>
        <form wire:submit.prevent="destroyQuestion({{ $question->id }})">
            <button class="btn btn-danger" type="submit">Supprimer la question</button>
        </form>

        @if ($question->type === 'choix unique' || $question->type === 'choix multiple')
            <form wire:submit.prevent="storeChoice({{ $question->id }})">
                @csrf
                <div>
                    <label for="choice">Put ur choice here :</label>
                    <input type="text" wire:model="choice" name="choice" id="choice" required>
                </div>
                <button class="btn btn-success" type="submit">Add choice</button>
            </form>

            <div>
                <ul>
                    @foreach ($question->choices->sortBy('order') as $choice)
                        <li>{{ $choice->choice }}</li>


                        @php
                            $firstChoice = $question->choices->sortBy('order')->first();
                            $lastChoice = $question->choices->sortByDesc('order')->first();
                        @endphp

                        @if ($choice->id !== $firstChoice->id)
                            <form wire:submit.prevent="orderUpChoice({{ $choice->id }})">
                                @csrf
                                @method('PUT')
                                <button type="submit">Up</button>
                            </form>
                        @endif

                        @if ($choice->id !== $lastChoice->id)
                            <form wire:submit.prevent="orderDownChoice({{ $choice->id }})">
                                @csrf
                                @method('PUT')
                                <button type="submit">Down</button>
                            </form>
                        @endif

                        <form wire:submit.prevent="destroyChoice({{ $choice->id }})">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete choice</button>
                        </form>
                    @endforeach
                </ul>
            </div>
        @endif
        <hr>
    @endforeach
    <form action="{{ route('forms.finish', $form->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button class="btn btn-info" type="submit">Finish the creation of form</button>
    </form>
</div>

<div>
    <!-- Create a new counter -->
    <button wire:click="createCounter">Create New Counter</button>

    <!-- List all counters and their specialized increment button -->
    @foreach($counts as $counter)
        <div>
            Counter ID: {{ $counter->id }} - Value: {{ $counter->number }}
            <button class="btn btn-primary" wire:click="increment({{ $counter->id }})">Increment</button>
            <button class="btn btn-primary" wire:click="decrement({{ $counter->id }})">Decrement</button>
            <button class="btn btn-danger" wire:click="destroy({{ $counter->id }})">Destroy</button>
            <button class="btn btn-info" wire:click="zero({{ $counter->id }})">Zero</button>
        </div>
    @endforeach
</div>

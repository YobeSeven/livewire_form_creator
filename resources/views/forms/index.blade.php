@extends("layouts.index")
@section("content")
    <h1 class="text-danger">FORM INDEX</h1>

    @livewire("forms.create-form")
    @livewire("forms.list-forms")
@endsection

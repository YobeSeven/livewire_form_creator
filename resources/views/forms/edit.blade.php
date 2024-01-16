@extends('layouts.index')
@section('content')
    @livewire("forms.single-form" , ['form' => $form])
@endsection

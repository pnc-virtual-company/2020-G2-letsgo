@extends('layouts.frontend.menuTamplate')

@section('body')
    <input list="result" id="autoSuggestion"  name="country"/>
    <datalist id="result">
    </datalist>
   {{-- view --}}
@endsection
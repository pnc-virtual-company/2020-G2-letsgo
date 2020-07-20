@extends('layouts.frontend.menuTamplate')

@section('body')
    <input list="result" id="autoSuggestion"  name="country"/>
    <datalist id="result">
    </datalist>
    <div class="container">
        <table>
            <tr>
                <th>Title</th>
                <th>cat</th>
            </tr>
            @foreach ($events as $item)
            @endforeach
          <tr>
              <td>{{$item->title}}</td>
              {{-- <td>{{$item->category->category}}</td> --}}
          </tr>
        </table>
    </div>
@endsection
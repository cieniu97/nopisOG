@extends('layouts.master')
@section('title')
Uniwersytety
@endsection

@section('content')

<div class="container">
    <div class="row">
        @if (auth()->user()->is_admin)
            <div class="col-12">
                <a href="{{route('universities.create')}}" class="btn btn-light mt-1 mr-md-3"> Dodaj uniwersytet </a>
                <a href="{{route('universities.trashed')}}" class="btn btn-light mt-1 mr-md-3"> Usunięte uniwersytety </a>
            </div>
        @endif
        
        <div class="col-12">
            <table class="table table-dark table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Universytet</th>
                        
                    </tr>
                </thead>
                <tbody>
            
                    @foreach ($universities as $university)

                    <tr>
                        <td> <a href="{{route('universities.show', ['university' => $university->id])}}">{{$university->name}}</a></td>
                    </tr>

                    
                    @endforeach
                </tbody>
            </table>
            
            <div class="row">
                <div class="col">
                    {{$universities->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

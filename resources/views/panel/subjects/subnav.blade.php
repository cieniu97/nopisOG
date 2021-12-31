<div class="bg-dark p-2 align-items-md-center d-flex flex-column d-md-block">
    <a href="{{route('subjects.index')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/subjects')) ? 'active' : '' }}"> Przedmioty </a>
    <a href="{{route('subjects.create')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/subjects/create')) ? 'active' : '' }}"> Dodaj przedmiot </a>
    <a href="{{route('subjects.trashed')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/subjects/trashed')) ? 'active' : '' }}"> Usunięte przedmioty </a>
</div>
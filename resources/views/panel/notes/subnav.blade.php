<div class="bg-dark p-2 align-items-md-center d-flex flex-column d-md-block">
    <a href="{{route('notes.index')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/notes')) ? 'active' : '' }}"> Notatki </a>
    <a href="{{route('notes.create')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/notes/create')) ? 'active' : '' }}"> Dodaj notatki </a>
    <a href="{{route('notes.trashed')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/notes/trashed')) ? 'active' : '' }}"> Usunięte notatki </a>
</div>
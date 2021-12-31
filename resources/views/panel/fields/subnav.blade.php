<div class="bg-dark p-2 align-items-md-center d-flex flex-column d-md-block">
    <a href="{{route('fields.index')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/fields')) ? 'active' : '' }}"> Kierunki </a>
    <a href="{{route('fields.create')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/fields/create')) ? 'active' : '' }}"> Dodaj kierunek </a>
    <a href="{{route('fields.trashed')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/fields/trashed')) ? 'active' : '' }}"> Usunięte kierunki </a>
</div>
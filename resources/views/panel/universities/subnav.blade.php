<div class="bg-dark p-2 align-items-md-center d-flex flex-column d-md-block">
    <a href="{{route('universities.index')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/universities')) ? 'active' : '' }}"> Uniwersytety </a>
    <a href="{{route('universities.create')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/universities/create')) ? 'active' : '' }}"> Dodaj uniwersytet </a>
    <a href="{{route('universities.trashed')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/universities/trashed')) ? 'active' : '' }}"> Usunięte uniwersytety </a>

</div>

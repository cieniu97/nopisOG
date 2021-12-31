<div class="bg-dark p-2 align-items-md-center d-flex flex-column d-md-block">
    <a href="{{route('years.index')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/years')) ? 'active' : '' }}"> Roczniki </a>
    <a href="{{route('years.create')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/years/create')) ? 'active' : '' }}"> Dodaj rocznik </a>
    <a href="{{route('years.trashed')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/years/trashed')) ? 'active' : '' }}"> Usunięte roczniki </a>
</div>
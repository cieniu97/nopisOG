<div class="bg-dark p-2 align-items-md-center d-flex flex-column d-md-block">
    <a href="{{route('exams.index')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/exams')) ? 'active' : '' }}"> Egzaminy </a>
    <a href="{{route('exams.create')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/exams/create')) ? 'active' : '' }}"> Dodaj egzamin </a>
    <a href="{{route('exams.trashed')}}" class="btn btn-outline-light mt-1 mr-md-3 {{ (request()->is('panel/exams/trashed')) ? 'active' : '' }}"> Usunięte egzaminy </a>
</div>
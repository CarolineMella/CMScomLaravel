@extends('adminlte::page')


@section('title', 'Páginas')

@section('content_header')
    <h1>Minhas Páginas
    <a href="{{ route('pages.create') }}" class="btn btn-sm btn-success">Nova Página</a>
    </h1>
@endsection

@section('content')
    
    <div class="card">

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Título</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->title}}</td>
                            <td>
                                <a target="_blank" href="" class="btn btn-sn btn-success">Ver</a>

                                <a href="{{ route('pages.edit', ['page' => $page->id]) }}" class="btn btn-sn btn-info">Editar</a>
                               
                                <form class="d-inline" method="POST" action="{{ route('pages.destroy', ['page' => $page->id]) }}" onsubmit="return confirm('Deseja excluir ?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sn btn-danger">Excluir</button>

                                </form>
    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        
            </table>
        </div>

    </div>

    {{ $pages->links() }}

@endsection

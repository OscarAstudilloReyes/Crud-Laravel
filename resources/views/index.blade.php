@extends('layouts.base')

@section('contenidoPrincipal')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD de Tareas</h2>
        </div>
        <div>
            <a href="{{route('tareas.create')}}" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>

    @if (Session::get('success'))
    <div class="alert alert-success mt-2">
        <strong>{{Session::get('success')}}</strong>
    </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            @foreach ($tareas as $task)
            <tr>
                <td class="fw-bold">{{$task->title}}</td>
                <td> {{$task->description}} </td>
                <td>
                    {{$task->due_date}}
                </td>
                <td>
                    <span class="badge bg-warning fs-6">{{$task->status}}</span>
                </td>
                <td>
                    <a href="{{route('tareas.edit', $task)}}" class="btn btn-warning">Editar</a>

                    <form action="{{route('tareas.destroy', $task)}}" method="post" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
           
        </table>
        {{$tareas->links()}}
    </div>
</div>
@endsection
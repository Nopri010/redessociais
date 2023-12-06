@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($listaUsuarios as $umUser)
            <div class="card mb-3 col-md-7">
                <div class="card-body">
                    <a href="/user/{{ $umUser->id }}" class="fs-3 link-secondary link-offset-2 link-underline-opacity-75  link-underline-opacity-100-hover">
                        {{$umUser->name}}
                    </a>
                    @if(!$usuarioAutenticado->follows->contains($umUser))
                        <a href="/follow/{{ $umUser->id }}" class="btn btn-outline-dark btn-sm fs-5 float-end">Seguir</a>
                    @else
                        <a href="/unfollow/{{ $umUser->id }}" class="btn btn-outline-dark fs-5 float-end">Remover</a>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="col-md-12 fs-5 text-center link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
            {{ $listaUsuarios->links() }}
        </div>
    </div>
</div>
@endsection

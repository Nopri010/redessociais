@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-md-12">
            <div class="card-body">
                <h1 class="fs-1">
                    {{$user->name}}
                    
                    @if(!$usuarioAutenticado->follows->contains($user))
                        <a href="/follow/{{ $user->id }}" class="btn fs-4 btn-outline-dark float-end">Seguir</a>
                    @else
                        <a href="/unfollow/{{ $user->id }}" class="btn fs-4 btn-outline-dark float-end">Remover</a>
                    @endif
                </h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card mb-3 col-md-8">
            <div class="card-body">
                <h2>Posts <span class="badge bg-dark float-end ">{{ $user->posts->count() }}</span></h2> 
                <ul class="list-group">
                    @foreach($user->posts as $post)
                        <li class="list-group-item ">
                            {{$post->content}} 
                            <br> 
                            <span class="float-end"><small>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i:s') }}</small></span>
                            <span class="float-start fw-bold"><small>{{ $post->comments->count() }} comentários {{ $post->likes->count() }} curtidas @if($post->photos->count() > 0) {{ $post->photos->count() }} imagem @endif</small></span>
                            <br>
                            <span class="float-end fw-bold text-body-secondary"><small><a href="/post/{{$post->id}}">Ver Mais</a></small></span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mb-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2>Seguidores <span class="badge bg-dark float-end">{{ $user->followers->count() }}</span></h2>
                    <ul class="list-group">
                        @foreach($user->followers as $follower)
                            <li class="list-group-item">
                                <a href="/user/{{ $follower->id }}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    {{$follower->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h2>Seguindo <span class="badge bg-dark float-end">{{ $user->follows->count() }}</span></h2>
                    <ul class="list-group">
                        @foreach($user->follows as $follows)
                            <li class="list-group-item">
                                <a href="/user/{{ $follows->id }}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    {{$follows->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

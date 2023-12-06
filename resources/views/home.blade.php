@extends('layouts.app')

@section('head')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">    
@endsection
@section('content')
<div class="container">

    <!-- EXIBE MENSAGENS DE SUCESSO -->
    @if(\Session::has('success'))
        <div class="row">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{\Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="card-body">
        <h5 class="fs-1 fw-bold">Faça um novo post:</h5>                
        <form method="POST" action="/post" class="overflow-visible p-0" id="formDropzone" enctype="multipart/form-data" novalidate>
            @csrf
            <input hidden id="file" name="file" multiple="multiple" />
            <div class="form-group">
                <label class="form-label text-muted fw-medium fs-4" for="content">
                            Mensagem:
                        </label>    
                <textarea class="form-control mb-3" name="content" rows="3" placeholder="Escreva um comentário"></textarea>
            </div>
            <div class="form-group mb-4">
                        <label class="form-label text-muted fw-medium fs-4" for="formImage">
                            Imagem:
                        </label>
                        <div class="dropzone dropzone-drag-area form-control" id="previews">      
                            <div class="d-none" id="dzPreviewContainer">
                                <div class="dz-preview dz-file-preview">
                                    <div class="dz-photo">
                                        <img class="dz-thumbnail" data-dz-thumbnail />
                                    </div>
                                    
                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        
                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                <span>Escolha suas imagens</span>
                            </div> 
                        </div>
            </div>
            <div class="form-group">      
                    <button class="btn btn-dark float-end" id="formSubmit" type="submit">
                        <span class="d-none me-2" aria-hidden="true"></span>
                        Enviar
                    </button>
            </div>
        </form>
</div>
        </div>
    </div>
    </div>  

    <div class="row justify-content-center mt-4">
        @for($i=0; $i< count($listaPosts); $i++)
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header fs-4 fw-bold">
                        {{ $listaPosts[$i]->user->name }}
                        <span class="float-end">
                            <small class="text-muted">
                                {{\Carbon\Carbon::parse($listaPosts[$i]->created_at)->format('d/m/Y H:i:s')}}
                            </small>
                            <a href="/post/{{ $listaPosts[$i]->id }}" class="btn btn-dark btn-sm">Detalhes</a>  
                            <a href="/post/{{ $listaPosts[$i]->id }}/destroy" class="btn btn-dark btn-sm">Deletar</a>
                        </span>
                    </div>
                    <div class="card-body">

                    @if($listaPosts[$i]->photos->count() > 0)
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div id="carousel_{{ $i }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @for($j=0; $j<count($listaPosts[$i]->photos); $j++)
                                    <div class="carousel-item @if($j==0) active @endif">
                                        <img src="/storage/image/{{ $listaPosts[$i]->photos[$j]->image_path }}" width="160px" height="150px" />   
                                    </div>
                                    @endfor
                                </div>
                                @if($listaPosts[$i]->photos->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{{ $i }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel_{{ $i }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span classs="position-absolute bottom-50 end-50">{{ $listaPosts[$i]->content }}</span>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <span classs="position-absolute bottom-50 end-50">{{ $listaPosts[$i]->content }}</span>
                        </div>
                    </div>
                    @endif
                    
                    </div>
                    @if($listaPosts[$i]->likes->count() > 0 || $listaPosts[$i]->comments->count() > 0)
                    <div class="card-footer">
                        @if($listaPosts[$i]->comments->count() > 0)
                        <p>
                            Comentários: 
                            <span class="badge rounded-pill bg-dark ">
                            {{ $listaPosts[$i]->comments->count() }}
                            </span>
                        </p>
                        <ul class="list-group">
                            @foreach($listaPosts[$i]->comments as $umComment)
                                <li class="list-group-item">
                                    <a href="/user/{{$umComment->user->id}}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><b>{{$umComment->user->name}}:</b></a> {{ $umComment->content }} 
                                    <small class="text-muted">
                                        {{\Carbon\Carbon::parse($umComment->created_at)->format('d/m/Y h:m')}}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                        @if($listaPosts[$i]->likes->count() > 0)
                        <p class="mt-2">
                            Likes:
                            <span class="badge rounded-pill bg-dark">
                            {{ $listaPosts[$i]->likes->count() }}
                            </span>
                            <ul class="list-group">
                            @foreach($listaPosts[$i]->likes as $umLike)
                                <li class="list-group-item ">
                                <a href="/user/{{ $umLike->user->id }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ $umLike->user->name }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
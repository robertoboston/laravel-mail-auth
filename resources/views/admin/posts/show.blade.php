@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h2>Dettaglio Post {{$post->title}}</h2>
                    <button class="btn btn-primary m-2">
                        <a class="text-white text-decoration-none" href="{{route('admin.posts.index')}}">Torna all'elenco</a>
                    </button>
                </div>
            </div>
            <div class="col-12">
                <img src="{{asset('/storage/' .$post->cover_image)}}" alt="{{$post->title}}" class="w-50">
                <p><strong>Slug:</strong>{{$post->slug}}</p>
                <p><strong>Categoria:</strong>{{$post->category ? $post->category->name : 'Senza categoria'}}</p>
                <label class="d-block"><strong>Contenuto:</strong></label>
                <p>{{$post->content}}</p>
                <p><strong>Tags:</strong></p>
                @forelse($post->tags as $tag)
                {{$tag->name}}
                @empty
                nessun tag associato
                @endforelse
            </div>
        </div>
    </div>
@endsection
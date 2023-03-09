@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 my-5">
            <h2>Aggiungi nuovo post</h2>
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <ul class="list-unstyled">
                <li>{{$error}}</li>
            </ul>
            @endforeach
        </div>
        @endif
        <div class="col-12">
            <form action="{{route('admin.posts.update', $post->slug)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="control-label">
                        Titolo
                    </label>
                    <input type="text" class="form-control" placeholder="Titolo" id="title" name="title">
                    @error('title')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Copertina</label>
                    <div>
                        <img src="{{asset('storage/' .$post->cover_image)}}" class="w-50 mb-3" alt="">
                    </div>
                    <input type="file" name="cover_image" id="cover_image" class="form-control">
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Categoorie</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-3">
                    <div class="control-label">Tags</div>
                    @foreach ($tags as $item)
                    <div class="form-check @error('tags') is-invalid @enderror">
                    <input type="checkbox" value="{{$item->id}}" name="tags[]">
                    <label class="form-check-label">{{$item->name}}</label>
                    </div>
                    @endforeach
                    @error('tags')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Contenuto
                    </label>
                    <textarea class="form-control" placeholder="Contenuto" name="content" id="content"></textarea>
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-sm btn-success">Salva post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
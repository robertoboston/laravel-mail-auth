@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 my-5">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>Elenco categorie</h2>
                </div>
            </div>
        </div>
        <div class="col-12 my-5">
            <table class="table table-striped">
                <thead>
                    <th>Id</th>
                    <th>NOME</th>
                    <th>SLUG</th>
                    <th>AZIONI</th>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->slug}}</td>
                        <td>
                            {{-- azioni per i tag --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
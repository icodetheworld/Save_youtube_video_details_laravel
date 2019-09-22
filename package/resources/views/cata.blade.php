@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
                    <ul class="list-group">
                        <a href="{{ url('/home') }}"><li class="list-group-item">Dashboard</li></a>
                        <a href="{{ url('/category') }}"><li class="list-group-item">Categories</li></a>
                    </ul>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('/cata') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Create New Category</label>
                            <input type="text" name="id" class="form-control" >
                        </div>
                        
                        <input type="submit" class="btn btn-dark btn-sm" value="Submit">
                    </form>
                    <ul class="list-group">
                            @foreach($data as $item)
                            <a data-toggle="collapse" data-target="{{ '#cata'.$item->id }}">
                                <li class="list-group-item">
                                    {{ $item->title }}
                                </li>
                            </a>
        
                            <div id="{{ 'cata'.$item->id }}" class="collapse">
                                <div class="card">
                                    <div class="card-body">
                                            <form action="{{ url('/cata/edit') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Edit Category - {{ $item->title }}</label>
                                                    <input type="text" name="title" class="form-control" value="{{ $item->title }}">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                </div>
                                                <a href="{{ url('/cata/'.$item->id) }}" class="btn btn-primary btn-sm">View</a> <input type="submit" class="btn btn-dark btn-sm" value="Submit"> <a href="{{ url('/cata/delete/'.$item->id) }}" onclick="return confirm('Are you sure want to delete category : {{ $item->title }}')" class="btn btn-danger btn-sm">Delete</a>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

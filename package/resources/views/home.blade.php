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
                <div class="card-header">{{ $page }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('/youtube') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Video URL</label>
                            <input type="text" name="id" class="form-control" placeholder="Video url">
                        </div>
                        <div class="form-group">
                            <select name="cata" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($cata as $item)
                                    <option value="{{ $item->id.','.$item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-dark btn-sm" value="Submit">
                    </form>
                    @foreach($data as $item)
                        <div class="card m-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                    <img src="{{ url($item->thumbnail) }}" width="100%">
                                </div>
                                <div class="col-md-8">
                                    <form action="{{ url('/videos/edit') }}" method="post">
                                        @csrf
                                        <div class="card-title">{{ $item->title }}</div>
                                        <p>Preview : <a href="{{ $item->video_url }}" target="_blank">Link</a></p>
                                        <p>Category: <select name="cata">
                                            <option value="">Select Category</option>
                                            @foreach ($cata as $item2)
                                                <option {{ $item2->id==$item->cata_id? 'selected' : '' }} value="{{ $item2->id.','.$item2->title }}">{{ $item2->title }}</option>    
                                            @endforeach
                                        </select></p>
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" value="Update" class="btn btn-sm btn-dark">
                                        <a href="{{ url('videos/delete/'.$item->id) }}" onclick="return confirm('Are you sure want to delete video - {{ $item->title }}')" class="btn btn-danger btn-sm">Delete</a>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

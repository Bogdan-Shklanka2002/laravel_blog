@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partial.error')
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <form action="{{ route('post.update', $post->id) }}" method='post'>
                {{ csrf_field()}}
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value='{{ $post->title}}'>
                </div>
                <div class="form-group">
                    <label for="body">Text</label>
                    <textarea name="body" class="form-control" id="body" cols='30' rows='5'>{{ $post->body}}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="checkbox" name="status" class="form-control" id="status" cols='30' rows='5' value='{{ $post->status}}'></input>
                </div>
                <input type="submit" value='Update' class='btn btn-success'>
            </form>
        </div>
    </div>
</div>

@endsection
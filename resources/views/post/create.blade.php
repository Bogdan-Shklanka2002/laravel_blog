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
            <form action="{{ route('post.store') }}" method='post'>
                {{ csrf_field()}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="body">Text</label>
                    <textarea name="body" class="form-control" id="body" cols='30' rows='5'></textarea>
                </div>
                <input type="submit" value='submit' class='btn btn-success'>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')

<div class="container"> 
    @include('partial.success')
    <!-- @if (Auth::user() && Auth::user()->hasRole('author'))
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('post.create') }}" class="btn btn-success">CREATE</a>
            </div>
        </div>
    @endif -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Text</th>
                <th>Title post</th>
                <th>Author name</th>
                <th>Status</th>
                @guest
                @else
                    <th>Action</th>
                @endguest
            </tr>
        </thead>
        <tbody>
            @if (count($comments))
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->text }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->author->name }}</td>
                        <td>
                            @if ($comment->status)
                                Published
                            @else
                                Unpublished
                            @endif
                        </td>
                        @guest
                        @else
                        <td>
                            <a href="{{ route('comment.show', $comment->id)}}" class='btn btn-primary'>View</a>
                        </td>
                        @endguest
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>

@endsection

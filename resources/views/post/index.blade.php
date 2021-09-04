@extends('layouts.app')

@section('content')

<div class="container"> 
    @include('partial.success')
    @if (Auth::user() && Auth::user()->hasRole('author'))
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('post.create') }}" class="btn btn-success">CREATE</a>
            </div>
        </div>
    @endif
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                @guest
                @else
                    <th>Action</th>
                @endguest
            </tr>
        </thead>
        <tbody>
            @if (count($posts))
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            @if ($post->status)
                                Published
                            @else
                                Unpublished
                            @endif
                        </td>
                        @guest
                        @else
                        <td>
                            <a href="{{ route('post.show', $post->id)}}" class='btn btn-primary'>View</a>
                        </td>
                        @endguest
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>

@endsection

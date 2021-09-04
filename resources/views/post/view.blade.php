@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
        @include('partial.success')
            <div class="col-md-12 border border-primary rounded" style='background-color:aliceblue'>
                <div class="nav" >
                    <div class="nav-item disabled m-2">Author: {{ $post->user->name}} </div>
                    <div class="nav-item disabled m-2">e-mail: {{ $post->user->email}} </div>
                    <div class="nav-item disabled m-2">Status:
                        @if ($post->status)
                            Published
                        @else
                            Unpublished
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-1 pt-5 pl-3 border border-primary rounded" style='background-color:aliceblue'>
                <h3>{{ $post->title}}</h3>
                <p>{{ $post->body }}</p>
            </div>
            
            <div class="col-md-12 d-flex justify-content-end">
                <p>Date: {{ $post->date }}</p>
            </div>
        </div>
        @if (Auth::user() && Auth::user()->hasRole('admin'))
        <div class="row d-flex justify-content-end">
            <div class="col-md-4 d-flex justify-content-center">
                <a href="{{ route('post.edit', $post->id) }}" class='btn btn-success mr-3'>Edit</a>
            <!-- </div>
            <div class="col-md-4 d-flex justify-content-end border border-primary"> -->
                <form action="{{ route('post.destroy', $post->id)}}" method='POST'>
                    {{ csrf_field()}}
                    @method('DELETE')
                    <input type="submit" value="Delete" class='btn btn-danger'>
                </form>
            </div>
           
        </div>
        @endif

        @if (!(Auth::user() && Auth::user()->id == $post->user_id)) 
            <!-- button add comment -->
            <div class="row d-flex justify-content-end">
                <div class="col-md-8 border border-secondary mt-5 p-3 rounded" style='background-color: rgb(249 202 202)'>
                    <form action="{{ route('comment.store')}}" method='POST' class="d-flex flex-column">
                        {{ csrf_field()}}
                        <label for="comment">Write your comment.</label>
                        <textarea name="text" id="comment" cols="30" rows="5"></textarea>
                        <input type="submit" value="Add" class='btn btn-primary align-self-end mt-2' style="width: 100px">
                        <input type="text" name="post_id" value="{{$post->id}}" style="position:absolute; visibility:hidden">
                        @if (Auth::user())
                            <input name='author_id' type="text" value="{{Auth::user()->id}}" style="position:absolute; visibility:hidden">
                        @else
                            <input name="author_id" type="text" value="0" style=" display:none; visibility:hidden">
                        @endif
                    </form>
                </div>
            </div>
            
        @endif
        @if (count($post->comments))
            @foreach ($post->comments as $comment)
                @if ($comment->status)
                <!-- view comments -->
                @endif
            @endforeach
        @endif

        
    </div>
@endsection
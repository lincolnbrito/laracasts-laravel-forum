@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                        <span class="flex">
                            <a href="{{ route('profile', $thread->creator->name) }}">{{ $thread->creator->name }}</a> posted:
                            {{ $thread->title }}
                        </span>

                        @can('update', $thread)
                        <form action="{{ $thread->path() }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link">Delete Thread</button>
                        </form>
                        @endcan
                    </div>
                </div>

                <div class="panel-body">                   
                    <article>
                        <h4>{{ $thread->title }}</h4>
                        <div class="body">
                            {{ $thread->body }}
                        </div>   
                    </article>               
                </div>
            </div>

            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach

             {{ $replies->links() }}

            @if(auth()->check())
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Post</button>
                </form>
            @else
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion</p>
            @endif

        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                   This thread was published {{ $thread->created_at->diffForHumans() }} by
                    <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural('comment') }}.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

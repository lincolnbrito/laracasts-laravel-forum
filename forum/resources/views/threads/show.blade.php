@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">            
            @foreach($thread->replies as $reply)            
                @include('threads.reply')
            @endforeach
        </div>
    </div>
</div>
@endsection

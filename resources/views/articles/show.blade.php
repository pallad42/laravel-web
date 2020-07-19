@extends('layouts.app')

@section('content')

    <!-- Post Content Column -->
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{$article->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href={{route('users.show', ['user'=>$article->author])}}>{{$article->author->name}}</a>
        </p>

        <p>
            Categories
            @foreach($article->categories as $category)
                <a href="{{route('categories.show', ['category' => $category])}}">{{$category->name}}</a>
            @endforeach
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{$article->created_at}}</p>
        <p>Updated on {{$article->updated_at}}</p>
        <p>Views: <b>{{$article->views}}</b></p>
        <p>Comments: <b>{{count($article->comments)}}</b></p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{asset('storage/images/abstract-image2.jpg')}}" alt="">

        <hr>

        <!-- Post Content -->
        {{$article->content}}

        <hr>

        @auth
            <ul class="list-inline">
                <li class="list-inline-item">
                    <form action="{{route('articles.destroy',['article' => $article])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </li>
                <li class="list-inline-item">
                    <a href="{{route('articles.edit',['article' => $article])}}" class="btn btn-primary">Edit</a>
                </li>
            </ul>

            <hr>
        @endauth

        <h2>Comments</h2>

        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        @foreach($article->getComments() as $comment)
        <!-- Single Comment -->
            <div class="media mb-4" style="background-color: #f0f0f0; padding: 10px;">
                <img class="d-flex mr-3" src="{{asset('storage/images/abstract-image3.jpg')}}" width="80" height="50"
                     alt="">
                <div class="media-body">
                    <h5 class="mt-0"><b><a
                                href="{{route('users.show', ['user'=>$article->author])}}">{{$comment->author->name}}</a></b>
                    </h5>
                    {{$comment->content}}

                    <br/>
                    <a href="#">Reply</a>
                </div>
            </div>

            <!-- Comment with nested comments -->

            @foreach($comment->replies as $reply)
                <div class="media mb-4" style="background-color: #f0f0f0; padding: 10px; margin-left: 100px;">
                    <img class="d-flex mr-3" src="{{asset('storage/images/abstract-image3.jpg')}}" width="80"
                         height="50"
                         alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><b><a
                                    href="{{route('users.show', ['user'=>$reply->author])}}">{{$reply->author->name}}</a></b>
                        </h5>
                        {{$reply->content}}

                        <br/>
                        <a href="#">Reply</a>
                    </div>
                </div>
            @endforeach


        @endforeach

    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                </div>
            </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <a href="#">HTML</a>
                            </li>
                            <li>
                                <a href="#">Freebies</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">JavaScript</a>
                            </li>
                            <li>
                                <a href="#">CSS</a>
                            </li>
                            <li>
                                <a href="#">Tutorials</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
                You can put anything you want inside of these side widgets. They are easy to use, and feature the new
                Bootstrap 4 card containers!
            </div>
        </div>

    </div>

@endsection

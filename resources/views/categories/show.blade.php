@extends('layouts.app')

@section('content')

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h2 class="my-4">Articles with category: <b>{{$category->name}}</b></h2>
        <h3 class="my-4">Found: {{$count}}</h3>

    @foreach($articles as $article)
        <!-- Blog Post -->
            <div class="card mb-4">
                <a href="{{route('articles.show', ['article'=>$article])}}">
                    <img class="card-img-top" src="{{asset('storage/images/abstract-image.jpg')}}" alt="Card image cap">
                </a>
                <div class="card-body">
                    <h2 class="card-title">{{$article->title}}</h2>
                    <p class="card-text">{{substr($article->content, 0, 100)}}...</p>
                    <a href="{{route('articles.show', ['article'=>$article])}}" class="btn btn-primary">Read More
                        &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{$article->created_at}}
                    <a href={{route('users.show', ['user'=>$article->author])}}>{{$article->author->name}}</a>
                    <br/>
                    Views: <b>{{$article->views}}</b> Comments <b>{{count($article->comments)}}</b>
                </div>
            </div>
    @endforeach

    <!-- Pagination -->
        <div class="pagination justify-content-center mb-4">
            {{ $articles->links() }}
        </div>

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
                You can put anything you want inside of these side widgets. They are easy to use, and feature
                the new
                Bootstrap 4 card containers!
            </div>
        </div>

    </div>

@endsection

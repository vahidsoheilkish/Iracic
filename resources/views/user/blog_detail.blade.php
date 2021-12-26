@extends('user/master')

@section('styles')
    <style>
    </style>
@endsection

@section("content")
    <!--slider-->
    <div class="container-fluid slider">
        <div class="row">
            <div id="mycarousel" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#mycarousel" data-slide-to="1"></li>
                    <li data-target="#mycarousel" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/img/user/carousel/seminar3.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Welcome to Irisis Scientific Database</h3>
                            <p>The IRISIS team is ready to inform you of the dear students</p>
                            <button href="#" class="btn btn-light" style="border-radius: 0">Read More</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/img/user/carousel/seminar2.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Welcome to Irisis Scientific Database</h3>
                            <p>The IRISIS team is ready to inform you of the dear students</p>
                            <button href="#" class="btn btn-light" style="border-radius: 0">Read More</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/img/user/carousel/seminar1.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Welcome to Irisis Scientific Database</h3>
                            <p>The IRISIS team is ready to inform you of the dear students</p>
                            <button href="#" class="btn btn-light" style="border-radius: 0">Read More</button>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#mycarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#mycarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="container blog">
        <div class="page-header">
            <h2 class="wow slideInLeft" data-wow-duration="1s">Our Blog</h2>
        </div>
        <div class="row blogsides">
            <div class="col-12 col-md-8 col-lg-9" id="content-container">
                <div id="banner">
                    <img src="/upload/post/{{ $post->imgUrl }}" />
                </div>
                <div class="row weblog-row">
                    <div class="col-12 content-blog ">
                        <span class="post-blog text-muted">
                            <i class="fa fa-calendar calender"></i>
                            {{ date( "Y-m-d " , date_timestamp_get($post->created_at)  ) }}
                        </span>
                        <span class="comment-blog text-muted">
                            <i class="fa fa-comment comment"></i>
                            {{ count($post->comments ) }}
                        </span>
                        <h3>
                            {{ $post->title }}
                        </h3>
                        <p class="titlecontent">
                            {{ $post->body }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div>
                            @foreach($category_name as $cat)
                                <a href="#" class="btn btn-light">{{$cat->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 text-right">
                        <div class="share">
                            <span><i class="fa fa-share-alt"></i>share this post:</span>
                            <span> <a target="_blank" href="#"><i class="fa fa-facebook"></i></a> </span>
                            <span> <a target="_blank" href="#"><i class="fa fa-twitter"></i></a> </span>
                            <span> <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a> </span>
                            <span> <a target="_blank" href="#"><i class="fa fa-instagram"></i></a> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3" id="sidebar-container">
                <div class="input-group searchblog">
                    <input type="text" placeholder="search" />
                    <div class="input-group-append">
                        <button class="btn searchbtn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="widget widget-product-categories">
                    <h3 class="widget-title">Categories</h3>
                    <ul class="product-categories">
                        <li><a href="#">blog1</a> <span class="count">2</span></li>
                        <li><a href="#">blog2</a> <span class="count">5</span></li>
                        <li><a href="#">blog3</a> <span class="count">4</span></li>
                        <li><a href="#">blog4</a> <span class="count">4</span></li>
                    </ul>
                </div>
                <h3 class="popularweblog">Popular Blogs</h3>
                <div class="row">
                    <div class="col-4">
                        <img src="img/blog/thumb/first.jpg" />
                    </div>
                    <div class="col-8 Popular-Blogs-text">
                        <h6>text text text text text</h6>
                        <p class="text-muted">August 9, 2016 </p>
                    </div>
                </div>
                <hr />
                <div class="row Popular-Blogs">
                    <div class="col-4">
                        <img src="img/blog/thumb/first.jpg" />
                    </div>
                    <div class="col-8 Popular-Blogs-text">
                        <h6>text text text text text</h6>
                        <p class="text-muted">August 9, 2016 </p>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-4">
                        <img src="img/blog/thumb/first.jpg" />
                    </div>
                    <div class="col-8 Popular-Blogs-text">
                        <h6>text text text text text</h6>
                        <p class="text-muted">August 9, 2016 </p>
                    </div>
                </div>
                <div class="row">
                    <h3 class="searchtags">Search by Tags</h3>
                    <div class="col-12 tagspart1">
                        <a class="btn btn-light">tag1</a>
                        <a class="btn btn-light">tag2</a>
                        <a class="btn btn-light">tag3</a>
                    </div>
                    <div class="col-12 tagspart2">
                        <a class="btn btn-light">tag4</a>
                        <a class="btn btn-light">tag5</a>
                        <a class="btn btn-light">tag6</a>
                    </div>
                    <div class="col-12 tagspart3">
                        <a class="btn btn-light">tag7</a>
                        <a class="btn btn-light">tag8</a>
                        <a class="btn btn-light">tag9</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--sidebar-sochial media-->
    <div class="container-fluid">
        <div class="row">
            <nav id="social-media-sidebar">
                <ul class="media">
                    <li class="side-social facebook">
                        <a href=""><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="side-social twitter">
                        <a href=#><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="side-social youtube">
                        <a href=#> <i class="fa fa-youtube-play text-secondary"></i></a>
                    </li>
                    <li class="side-social instagram">
                        <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
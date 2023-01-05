<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$wedding->groom_name}} & {{$wedding->bride_name}}'s wedding . Nuna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="{{$wedding->groom_name}} & {{$wedding->bride_name}}'s wedding at {{$wedding->location}}"/>
    <meta name="keywords"
          content="wedding, {{$wedding->groom_name}}, {{$wedding->bride_name}}, {{$wedding->location}}  "/>
    <meta name="author" content="Nuna Technologies"/>

    <meta property="og:title"
          content="{{$wedding->groom_name}} & {{$wedding->bride_name}}'s wedding at {{$wedding->location}}"/>
    <meta property="og:image" content="{{$wedding->photo_one}}"/>
    <meta property="og:url" content="https://mynunna.com/w/{{$wedding->tag}}"/>
    <meta property="og:site_name" content="Nuna"/>
    <meta property="og:description"
          content="{{$wedding->groom_name}} & {{$wedding->bride_name}}'s wedding at {{$wedding->location}}"/>
    <meta name="twitter:title"
          content="{{$wedding->groom_name}} & {{$wedding->bride_name}}'s wedding at {{$wedding->location}}"/>
    <meta name="twitter:image" content="{{$wedding->photo_one}}"/>
    <meta name="twitter:url" content="https://mynunna.com/w/{{$wedding->tag}}"/>
    <meta name="twitter:card"
          content="{{$wedding->groom_name}} & {{$wedding->bride_name}}'s wedding at {{$wedding->location}}"/>

    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon"
          href="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png">

    <!-- Animate.css -->
    <link rel="stylesheet" href="/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="/css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Modernizr JS -->
    <script src="/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="/js/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div class="fh5co-loader"></div>

<div id="page">
    <nav class="fh5co-nav" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="fh5co-logo"><a href="">Wedding<strong>.</strong></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="#fh5co-couple-story">Story</a></li>
                        <li>
                            <a href="#fh5co-gallery">Gallery</a>

                        </li>
                        <li><a href="#fh5co-started">Contact</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({{$wedding->photo_one}});"
            data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>{{$wedding->groom_name}} &amp; {{$wedding->bride_name}}</h1>
                            <h2>We Are Getting Married!</h2>

                            <div class="simply-countdown simply-countdown-one"></div>

                            <a href="#" class="btn btn-primary btn-lg">Send a gift</a>
                            <a href="#" class="btn btn-default btn-lg">Save the date</a>
                            <a href="#fh5co-started" class="btn btn-primary btn-lg">Add RSVP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="fh5co-couple">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                    <h2>Hello!</h2>
                    <h3>{{\Carbon\Carbon::parse($wedding->date_time)->isoFormat('MMMM Do, YYYY')}} {{$wedding->location}}</h3>
                    <p>We invited you to celebrate our wedding</p>
                </div>
            </div>
            <div class="couple-wrap animate-box">
                <div class="couple-half">
                    <div class="groom">
                        <img src="{{$wedding->photo_two ?? '/images/groom.jpg'}}" alt="groom" class="img-responsive">
                    </div>
                    <div class="desc-groom">
                        <h3>{{$wedding->groom_name}}</h3>
                        <p>{{$wedding->story}}</p>
                    </div>
                </div>
                <p class="heart text-center"><i class="icon-heart2"></i></p>
                <div class="couple-half">
                    <div class="bride">
                        <img src="{{$wedding->photo_three ?? '/images/bride.jpg'}}" alt="groom" class="img-responsive">
                    </div>
                    <div class="desc-bride">
                        <h3>{{$wedding->bride_name}}</h3>
                        <p>{{$wedding->story}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-event" class="fh5co-bg" style="background-image:url({{$wedding->photo_one}});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                    <span>Our Special Events</span>
                    <h2>Wedding Events</h2>
                </div>
            </div>
            <div class="row">
                <div class="display-t">
                    <div class="display-tc">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="col-md-6 col-sm-6 text-center">
                                <div class="event-wrap animate-box">
                                    <h3>Main Ceremony</h3>
                                    <div class="event-col">
                                        <i class="icon-clock"></i>
                                        <span>{{\Carbon\Carbon::parse($wedding->date_time)->toTimeString()}}</span>
                                    </div>
                                    <div class="event-col">
                                        <i class="icon-calendar"></i>
                                        <span>{{\Carbon\Carbon::parse($wedding->date_time)->isoFormat('MMMM Do, YYYY')}}</span>

                                    </div>
                                    <div class="event-col">
                                        <i class="icon-add-user"></i>
                                        <span>RSVP person:{{$wedding->rsv_person}}</span>

                                    </div>
                                    <div class="event-col">
                                        <i class="icon-old-phone"></i>
                                        <span>RSVP Phone Number:{{$wedding->rsv_phone_number}}</span>
                                    </div>

                                    <p>{{$wedding->location}}</p>
                                </div>
                            </div>


                            @if($wedding->coordinates)
                                <div class="col-md-6 col-sm-6 text-center">
                                    <div class="event-wrap animate-box">

                                        <?php
                                        $codsArr = explode(',', $wedding->coordinates);
                                        $reversCode = array_reverse($codsArr);
                                        $newCods = implode(",", $reversCode);
                                        ?>
                                        <iframe
                                            width="100%"
                                            height="250"
                                            frameborder="0" style="border:0"
                                            referrerpolicy="no-referrer-when-downgrade"
                                            src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyDlKd1XANeleo81umo7SdNW2cn5w32f8iM&center={{$newCods}}&destination={{$newCods}}&zoom=18&origin={{$newCods}}"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-couple-story">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                    <span>We Love Each Other</span>
                    <h2>Our Story</h2>
                    <p>{{$wedding->story}}</p>
                </div>
            </div>
            {{--            <div class="row">--}}
            {{--                <div class="col-md-12 col-md-offset-0">--}}
            {{--                    <ul class="timeline animate-box">--}}
            {{--                        <li class="animate-box">--}}
            {{--                            <div class="timeline-badge" style="background-image:url(/images/couple-1.jpg);"></div>--}}
            {{--                            <div class="timeline-panel">--}}
            {{--                                <div class="timeline-heading">--}}
            {{--                                    <h3 class="timeline-title">First We Meet</h3>--}}
            {{--                                    <span class="date">December 25, 2015</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="timeline-body">--}}
            {{--                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                        <li class="timeline-inverted animate-box">--}}
            {{--                            <div class="timeline-badge" style="background-image:url(/images/couple-2.jpg);"></div>--}}
            {{--                            <div class="timeline-panel">--}}
            {{--                                <div class="timeline-heading">--}}
            {{--                                    <h3 class="timeline-title">First Date</h3>--}}
            {{--                                    <span class="date">December 28, 2015</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="timeline-body">--}}
            {{--                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                        <li class="animate-box">--}}
            {{--                            <div class="timeline-badge" style="background-image:url(/images/couple-3.jpg);"></div>--}}
            {{--                            <div class="timeline-panel">--}}
            {{--                                <div class="timeline-heading">--}}
            {{--                                    <h3 class="timeline-title">In A Relationship</h3>--}}
            {{--                                    <span class="date">January 1, 2016</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="timeline-body">--}}
            {{--                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>

    <div id="fh5co-gallery" class="fh5co-section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                    <span>Our Memories</span>
                    <h2>Wedding Gallery</h2>
                    <p>{{$wedding->story}}</p>
                </div>
            </div>
            <div class="row row-bottom-padded-md">
                <div class="col-md-12">
                    <ul id="fh5co-gallery-list">
                        @if($wedding->photo_one)

                            <li class="one-third animate-box" data-animate-effect="fadeIn"
                                style="background-image: url({{$wedding->photo_one}}); ">
                                <a href="{{$wedding->photo_one}}">

                                </a>
                            </li>

                        @endif


                        @if($wedding->photo_two)

                            <li class="one-third animate-box" data-animate-effect="fadeIn"
                                style="background-image: url({{$wedding->photo_two}}); ">
                                <a href="{{$wedding->photo_two}}" class="color-2">

                                </a>
                            </li>
                        @endif

                        @if($wedding->photo_three)

                            <li class="one-third animate-box" data-animate-effect="fadeIn"
                                style="background-image: url({{$wedding->photo_three}}); ">
                                <a href="{{$wedding->photo_three}}" class="color-3">

                                </a>
                            </li>

                        @endif
                        @if($wedding->photo_four)


                            <li class="one-third animate-box" data-animate-effect="fadeIn"
                                style="background-image: url({{$wedding->photo_four}}); ">
                                <a href="{{$wedding->photo_four}}" class="color-4">

                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{--    <div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background-image:url(/images/img_bg_5.jpg);">--}}
    {{--        <div class="overlay"></div>--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="display-t">--}}
    {{--                    <div class="display-tc">--}}
    {{--                        <div class="col-md-3 col-sm-6 animate-box">--}}
    {{--                            <div class="feature-center">--}}
    {{--								<span class="icon">--}}
    {{--									<i class="icon-users"></i>--}}
    {{--								</span>--}}

    {{--                                <span class="counter js-counter" data-from="0" data-to="500" data-speed="5000" data-refresh-interval="50">1</span>--}}
    {{--                                <span class="counter-label">Estimated Guest</span>--}}

    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-md-3 col-sm-6 animate-box">--}}
    {{--                            <div class="feature-center">--}}
    {{--								<span class="icon">--}}
    {{--									<i class="icon-user"></i>--}}
    {{--								</span>--}}

    {{--                                <span class="counter js-counter" data-from="0" data-to="1000" data-speed="5000" data-refresh-interval="50">1</span>--}}
    {{--                                <span class="counter-label">We Catter</span>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-md-3 col-sm-6 animate-box">--}}
    {{--                            <div class="feature-center">--}}
    {{--								<span class="icon">--}}
    {{--									<i class="icon-calendar"></i>--}}
    {{--								</span>--}}
    {{--                                <span class="counter js-counter" data-from="0" data-to="402" data-speed="5000" data-refresh-interval="50">1</span>--}}
    {{--                                <span class="counter-label">Events Done</span>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-md-3 col-sm-6 animate-box">--}}
    {{--                            <div class="feature-center">--}}
    {{--								<span class="icon">--}}
    {{--									<i class="icon-clock"></i>--}}
    {{--								</span>--}}

    {{--                                <span class="counter js-counter" data-from="0" data-to="2345" data-speed="5000" data-refresh-interval="50">1</span>--}}
    {{--                                <span class="counter-label">Hours Spent</span>--}}

    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <div id="fh5co-testimonial">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="row animate-box">--}}
    {{--                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">--}}
    {{--                        <span>Best Wishes</span>--}}
    {{--                        <h2>Friends Wishes</h2>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-md-12 animate-box">--}}
    {{--                        <div class="wrap-testimony">--}}
    {{--                            <div class="owl-carousel-fullwidth">--}}
    {{--                                <div class="item">--}}
    {{--                                    <div class="testimony-slide active text-center">--}}
    {{--                                        <figure>--}}
    {{--                                            <img src="/images/couple-1.jpg" alt="user">--}}
    {{--                                        </figure>--}}
    {{--                                        <span>John Doe, via <a href="#" class="twitter">Twitter</a></span>--}}
    {{--                                        <blockquote>--}}
    {{--                                            <p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics"</p>--}}
    {{--                                        </blockquote>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="item">--}}
    {{--                                    <div class="testimony-slide active text-center">--}}
    {{--                                        <figure>--}}
    {{--                                            <img src="/images/couple-2.jpg" alt="user">--}}
    {{--                                        </figure>--}}
    {{--                                        <span>John Doe, via <a href="#" class="twitter">Twitter</a></span>--}}
    {{--                                        <blockquote>--}}
    {{--                                            <p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, at the coast of the Semantics, a large language ocean."</p>--}}
    {{--                                        </blockquote>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="item">--}}
    {{--                                    <div class="testimony-slide active text-center">--}}
    {{--                                        <figure>--}}
    {{--                                            <img src="/images/couple-3.jpg" alt="user">--}}
    {{--                                        </figure>--}}
    {{--                                        <span>John Doe, via <a href="#" class="twitter">Twitter</a></span>--}}
    {{--                                        <blockquote>--}}
    {{--                                            <p>"Far far away, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."</p>--}}
    {{--                                        </blockquote>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    @if($wedding->zoom_link && $wedding->youtube_link)

        <div id="fh5co-services" class="fh5co-section-gray">
            <div class="container">

                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>Join us from anywhere</h2>
                        <p>You can join us via Youtube or zoom, hope you make it</p>
                    </div>
                </div>

                <div class="row">


                    <div class="col-md-6 mx-auto animate-box">
                        <div class="fh5co-video fh5co-bg"
                             style="background-image: url({{$wedding->photo_one ?? '/images/img_bg_4.jpg'}}); ">
                            <a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i
                                    class="icon-video2"></i></a>
                            <div class="overlay"></div>
                        </div>
                    </div>

                    <div class="col-md-6 mx-auto animate-box">
                        @if($wedding->youtube_link)
                            <a class="btn btn-lg btn-danger" href="{{$wedding->youtube_link}}">Schedule Youtube live
                                video</a>
                        @endif

                        @if($wedding->zoom_link)

                            <a class="btn btn-lg btn-primary" href="{{$wedding->zoom_link}}">Schedule Zoom</a>
                        @endif
                    </div>

                </div>


            </div>
        </div>
    @endif


    <div id="fh5co-started" class="fh5co-bg"
         style="background-image:url({{$wedding->photo_one ?? '/images/img_bg_4.jpg'}});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Are You Attending?</h2>
                    <p>Please Fill-up the form to notify you that you're attending. Thanks.</p>
                </div>
            </div>
            <div class="row animate-box">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-inline" method="post" action="{{route("reserve",$wedding->id)}}">
                        {{csrf_field()}}

                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="name" class="sr-only">Full Name*</label>
                                <input name="name" required type="text" class="form-control" id="name" placeholder="Full Name*">
                            </div>
                        </div>

                          <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="name" class="sr-only">Phone Number*</label>
                                <input name="phone_number" required type="tel" class="form-control" id="phone_number" placeholder="Phone Number*">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email(optional)</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Email(optional)">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <button type="submit" class="btn btn-default btn-block">I am Attending</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer id="fh5co-footer" role="contentinfo">
        <div class="container">

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">Nuna</small>
                    </p>
                    <p>
                    <ul class="fh5co-social-icons">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                    </ul>
                    </p>
                </div>
            </div>

        </div>
    </footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="/js/jquery.waypoints.min.js"></script>
<!-- Carousel -->
<script src="/js/owl.carousel.min.js"></script>
<!-- countTo -->
<script src="/js/jquery.countTo.js"></script>

<!-- Stellar -->
<script src="/js/jquery.stellar.min.js"></script>
<!-- Magnific Popup -->
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/magnific-popup-options.js"></script>

<!-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script> -->
<script src="/js/simplyCountdown.js"></script>
<!-- Main -->
<script src="/js/main.js"></script>

<script>
    var d = new Date(new Date().getTime() + 200 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: <?=$year?>,
        month: <?=$month?> + 1,
        day: <?=$day?>,
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: <?=$year?>,
        month: <?=$month?> + 1,
        day: <?=$day?>,
        enableUtc: false
    });
</script>

</body>
</html>


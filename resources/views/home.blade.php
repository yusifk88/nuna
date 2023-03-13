
@extends("welcome")
@section("content")
<!-- Slider Area Start-->
<div class="slider-area ">
    <div class="slider-active">
        <div class="single-slider slider-height slider-padding sky-blue d-flex align-items-center">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6 col-md-9 ">
                        <div class="hero__caption pt-sm-5">
                            <h1 data-animation="fadeInUp" data-delay=".6s">Borderless gifting</h1>
                            <p data-animation="fadeInUp" data-delay=".8s">Nuna gives you the most efficient way to
                                receive gifts, by offering a digital wedding gift table, accessible globally</p>
                            <p class="text-center">
                            <ul class="fh5co-social-icons">
                                <li><a href="https://instagram.com/nunahqq?igshid=ZDdkNTZiNTM="><i style="font-size: 50px" class="icon-instagram"></i></a></li>
                                <li><a href="https://twitter.com/mynunahq?s=20"><i style="font-size: 50px" class="icon-twitter"></i></a></li>
                                <li><a href="https://www.facebook.com/profile.php?id=100086379382319"><i style="font-size: 50px" class="icon-facebook"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/nuna-technologies-limited/"><i style="font-size: 50px" class="icon-linkedin"></i></a></li>
                            </ul>
                            </p>
                            <div class="slider-btns">
                                <!-- Hero-btn -->
                            {{--                                    <a data-animation="fadeInLeft" data-delay="1.0s" href="industries.html"--}}
                            {{--                                       class="btn radius-btn">Download</a>--}}

                            <!-- Begin Mailchimp Signup Form -->

                                <div id="mc_embed_signup" class="card">
                                    <form action="https://mynunaa.us13.list-manage.com/subscribe/post?u=cf98938053d7813a773a3a678&amp;id=391548aa93&amp;f_id=0040e1e2f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll">
                                            <h2>Join Nuna</h2>
                                            <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                                            <div class="mc-field-group">
                                                <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                                                </label>
                                                <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" required>
                                                <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
                                            </div>
                                            <div class="mc-field-group">
                                                <label for="mce-FNAME">First Name </label>
                                                <input type="text" value="" name="FNAME" class="form-control" id="mce-FNAME">
                                                <span id="mce-FNAME-HELPERTEXT" class="helper_text"></span>
                                            </div>
                                            <div class="mc-field-group size1of2">
                                                <label for="mce-PHONE">Phone Number </label>
                                                <input type="text" name="PHONE" class="form-control" value="" id="mce-PHONE">
                                                <span id="mce-PHONE-HELPERTEXT" class="helper_text"></span>
                                            </div>
                                            <div id="mce-responses" class="clear foot">
                                                <div class="response" id="mce-error-response" style="display:none"></div>
                                                <div class="response" id="mce-success-response" style="display:none"></div>
                                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_cf98938053d7813a773a3a678_391548aa93" tabindex="-1" value=""></div>
                                            <div class="optionalParent">
                                                <div class="clear foot">
                                                    <input type="submit" value="Join the Waiting List Now!" name="subscribe" id="mc-embedded-subscribe" class="btn btn-success w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--End mc_embed_signup-->

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero__img  f-right" data-animation="fadeInRight"
                             data-delay="1s">
                            <img src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/main_shot.png" alt="App screenshot fo getting started">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Slider Area End -->
<!-- Best Features Start -->
{{--    <section class="best-features-area section-padd4">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-end">--}}
{{--                <div class="col-xl-8 col-lg-10">--}}
{{--                    <!-- Section Tittle -->--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-10 col-md-10">--}}
{{--                            <div class="section-tittle">--}}
{{--                                <h2>Some of the best features Of Our App!</h2>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Section caption -->--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-xl-6 col-lg-6 col-md-6">--}}
{{--                            <div class="single-features mb-70">--}}
{{--                                <div class="features-icon">--}}
{{--                                    <span class="flaticon-support"></span>--}}
{{--                                </div>--}}
{{--                                <div class="features-caption">--}}
{{--                                    <h3>Easy to Costomize</h3>--}}
{{--                                    <p>Aorem psum olorsit amet ectetur adipiscing elit, sed dov.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-6 col-lg-6 col-md-6">--}}
{{--                            <div class="single-features mb-70">--}}
{{--                                <div class="features-icon">--}}
{{--                                    <span class="flaticon-support"></span>--}}
{{--                                </div>--}}
{{--                                <div class="features-caption">--}}
{{--                                    <h3>Extreme Security</h3>--}}
{{--                                    <p>Aorem psum olorsit amet ectetur adipiscing elit, sed dov.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-6 col-lg-6 col-md-6">--}}
{{--                            <div class="single-features mb-70">--}}
{{--                                <div class="features-icon">--}}
{{--                                    <span class="flaticon-support"></span>--}}
{{--                                </div>--}}
{{--                                <div class="features-caption">--}}
{{--                                    <h3>Customer Support</h3>--}}
{{--                                    <p>Aorem psum olorsit amet ectetur adipiscing elit, sed dov.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-6 col-lg-6 col-md-6">--}}
{{--                            <div class="single-features mb-70">--}}
{{--                                <div class="features-icon">--}}
{{--                                    <span class="flaticon-support"></span>--}}
{{--                                </div>--}}
{{--                                <div class="features-caption">--}}
{{--                                    <h3>Creative Design</h3>--}}
{{--                                    <p>Aorem psum olorsit amet ectetur adipiscing elit, sed dov.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Shpe -->--}}
{{--        <div class="features-shpae d-none d-lg-block">--}}
{{--            <img src="assets/img/shape/best-features.png" alt="">--}}
{{--        </div>--}}
{{--    </section>--}}
<!-- Best Features End -->
<!-- Services Area Start -->

    <div class="row sky-blue">
        <div class="col-md-8 mx-auto">

    <div class="card mt-5">
        <div class="card-body">

            <iframe id="welcome" width="100%" height="600" src="https://www.youtube.com/embed/1iqDY3kCBUo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

        </div>

    </div>
        </div>
    </div>



<section class="service-area sky-blue section-padding2">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="section-tittle text-center">
                    <h2>What you get!</h2>
                </div>
            </div>
        </div>
        <!-- Section caption -->
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="services-caption text-center mb-30">
                    <div class="service-icon">
                        <span class="flaticon-businessman"></span>
                    </div>
                    <div class="service-cap">
                        <h4><a href="#">Free event pages</a></h4>
                        <p>Create and customize event pages for all your cherished milestones  such as weddings, graduations, birthdays, etc</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="services-caption active text-center mb-30">
                    <div class="service-icon">
                        <span class="flaticon-pay"></span>
                    </div>
                    <div class="service-cap">
                        <h4><a href="#">Receive gifts easily</a></h4>
                        <p>Make it easy for your well-wishers to send you gifts from wherever they are</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="services-caption text-center mb-30">
                    <div class="service-icon">
                        <span class="flaticon-plane"></span>
                    </div>
                    <div class="service-cap">
                        <h4><a href="#">Track your guest list</a></h4>
                        <p>Know who would be attending ahead of time</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Area End -->
<!-- Applic App Start -->
<div class="applic-apps section-padding2">
    <div class="container-fluid">
        <div class="row">
            <!-- slider Heading -->
            <div class="col-xl-4 col-lg-4 col-md-8">
                <div class="single-cases-info mb-30">
                    <h3>Nuna<br> Screenshots</h3>
                    {{--                        <p>Lorem ipsum dolor sit amet, consecadipiscing elit, sed do eiusmod tempor incididunt ut ore et--}}
                    {{--                            dolore magna aliqua. Quis ipsum suspendisse gravida. Risus commodo viverra maecenasan lacus--}}
                    {{--                            vel facilisis. </p>--}}
                </div>
            </div>
            <!-- OwL -->
            <div class="col-xl-8 col-lg-8 col-md-col-md-7">
                <div class="app-active owl-carousel">
                    <div class="single-cases-img app-img">
                        <img src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/Apple%20iPhone%2011%20Pro%20Max%20Screenshot%200%20copy.png" alt="">
                    </div>
                    <div class="single-cases-img">
                        <img src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/Apple%20iPhone%2011%20Pro%20Max%20Screenshot%200%20copy%203.png" alt="">
                    </div>
                    <div class="single-cases-img">
                        <img src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/Apple%20iPhone%2011%20Pro%20Max%20Screenshot%200%20copy%202.png" alt="">
                    </div>
                    <div class="single-cases-img">
                        <img src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/Apple%20iPhone%2011%20Pro%20Max%20Screenshot%200%20copy%205.png" alt="">
                    </div>
                    <div class="single-cases-img">
                        <img src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/Apple%20iPhone%2011%20Pro%20Max%20Screenshot%200.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Applic App End -->
<!-- Best Pricing Start -->
<section class="best-pricing pricing-padding" data-background="assets/img/gallery/best_pricingbg.jpg">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="section-tittle section-tittle2 text-center">
                    <h2>Nuna is free!</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Best Pricing End -->
<!-- Pricing Card Start -->
<div class="pricing-card-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 mx-auto">
                <div class="single-card text-center mb-30">
                    <div class="card-top">
                        <span>Life time</span>
                        <h4>$0</h4>
                    </div>
                    <div class="card-bottom">
                        <ul>
                            <li>All features</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Pricing Card End -->
<!-- Our Customer Start -->
{{--    <div class="our-customer section-padd-top30">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="our-customer-wrapper">--}}
{{--                <!-- Section Tittle -->--}}
{{--                <div class="row d-flex justify-content-center">--}}
{{--                    <div class="col-xl-8">--}}
{{--                        <div class="section-tittle text-center">--}}
{{--                            <h2>What Our users<br> Have to Say</h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="customar-active dot-style d-flex dot-style">--}}
{{--                            <div class="single-customer mb-100">--}}
{{--                                <div class="what-img">--}}
{{--                                    <img src="assets/img/shape/man1.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="what-cap">--}}
{{--                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>--}}
{{--                                    <p>Utenim ad minim veniam quisnostrud exercitation ullamcolabor nisiut aliquip ex ea--}}
{{--                                        commodo consequat duis aute irure dolor in represse.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="single-customer mb-100">--}}
{{--                                <div class="what-img">--}}
{{--                                    <img src="assets/img/shape/man2.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="what-cap">--}}
{{--                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>--}}
{{--                                    <p>Utenim ad minim veniam quisnostrud exercitation ullamcolabor nisiut aliquip ex ea--}}
{{--                                        commodo consequat duis aute irure dolor in represse.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="single-customer mb-100">--}}
{{--                                <div class="what-img">--}}
{{--                                    <img src="assets/img/shape/man3.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="what-cap">--}}
{{--                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>--}}
{{--                                    <p>Utenim ad minim veniam quisnostrud exercitation ullamcolabor nisiut aliquip ex ea--}}
{{--                                        commodo consequat duis aute irure dolor in represse.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="single-customer mb-100">--}}
{{--                                <div class="what-img">--}}
{{--                                    <img src="assets/img/shape/man2.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="what-cap">--}}
{{--                                    <h4><a href="#">Welcome To The Best Model Winner Contest</a></h4>--}}
{{--                                    <p>Utenim ad minim veniam quisnostrud exercitation ullamcolabor nisiut aliquip ex ea--}}
{{--                                        commodo consequat duis aute irure dolor in represse.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<!-- Our Customer End -->
<!-- Available App  Start-->
<div class="available-app-area">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-xl-5 col-lg-6">
                <div class="app-caption">
                    <div class="section-tittle section-tittle3">
                        <h2>Available on iOS and Android</h2>
                        <p>Download Nuna on your mobile platform of choice</p>

                        <!-- Begin Mailchimp Signup Form -->

                        <div id="mc_embed_signup" class="card">
                            <form action="https://mynunaa.us13.list-manage.com/subscribe/post?u=cf98938053d7813a773a3a678&amp;id=391548aa93&amp;f_id=0040e1e2f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                    <h2>Join Nuna</h2>
                                    <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                                    <div class="mc-field-group">
                                        <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
                                        </label>
                                        <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL" required>
                                        <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
                                    </div>
                                    <div class="mc-field-group">
                                        <label for="mce-FNAME">First Name </label>
                                        <input type="text" value="" name="FNAME" class="form-control" id="mce-FNAME">
                                        <span id="mce-FNAME-HELPERTEXT" class="helper_text"></span>
                                    </div>
                                    <div class="mc-field-group size1of2">
                                        <label for="mce-PHONE">Phone Number </label>
                                        <input type="text" name="PHONE" class="form-control" value="" id="mce-PHONE">
                                        <span id="mce-PHONE-HELPERTEXT" class="helper_text"></span>
                                    </div>
                                    <div id="mce-responses" class="clear foot">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_cf98938053d7813a773a3a678_391548aa93" tabindex="-1" value=""></div>
                                    <div class="optionalParent">
                                        <div class="clear foot">
                                            <input type="submit" value="Join the Waiting List Now!" name="subscribe" id="mc-embedded-subscribe" class="btn btn-success w-100">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--End mc_embed_signup-->
                        {{--                            <div class="app-btn">--}}
                        {{--                                <a href="#" class="app-btn1"><img src="assets/img/shape/app_btn1.png" alt=""></a>--}}
                        {{--                                <a href="#" class="app-btn2"><img src="assets/img/shape/app_btn2.png" alt=""></a>--}}
                        {{--                            </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="app-img">
                    <img class="img-fluid" src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/Apple%20iPhone%2011%20Pro%20Max%20Screenshot%200%20copy%205.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Shape -->
    <div class="app-shape">
        <img src="assets/img/shape/app-shape-top.png" alt="" class="app-shape-top heartbeat d-none d-lg-block">
        <img src="assets/img/shape/app-shape-left.png" alt="" class="app-shape-left d-none d-xl-block">
        <!-- <img src="assets/img/shape/app-shape-right.png" alt="" class="app-shape-right bounce-animate "> -->
    </div>
</div>
<!-- Available App End-->
<!-- Say Something Start -->
<div class="say-something-aera pt-90 pb-90 fix">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="offset-xl-1 offset-lg-1 col-xl-5 col-lg-5">
                <div class="say-something-cap">
                    <h2>Let's connect, <br> get in touch</h2>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3">
                <div class="say-btn">
                    <a href="mailto:hello@mynunaa.com" class="btn radius-btn">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- shape -->
    <div class="say-shape">
        <img src="assets/img/shape/say-shape-left.png" alt="" class="say-shape1 rotateme d-none d-xl-block">
        <img src="assets/img/shape/say-shape-right.png" alt="" class="say-shape2 d-none d-lg-block">
    </div>
</div>
<!-- Say Something End -->

@endsection

@extends('client.layouts.master')
@section('title', 'Trang chủ | AY-LearnEnglish')
@section('content')
    @include('client.layouts.partials.banner')
    @include('client.home.topCourse')
    <section
        class="expert-instructor eExpert-instruction top-categories py-5 wow  animate__animated animate__fadeInUp opacityOnUp"
        data-wow-duration="1000" data-wow-delay="400">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <h1 class="text-center f-36 mt-0 pt-0 mb-4">Giảng viên của chúng tôi.</h1>
                </div>
            </div>
            <div class="instructor-card eInstuctor">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-4 col-sm-6" data-wow-duration="1000" data-wow-delay="600">
                        <div class="instructor-card-body">
                            <div class="instructor-card-img">
                                <img loading="lazy"
                                    src="{{ asset('themes/client/uploads/user_image/optimized/c65a8b0a510168ef0a311b1f46c7f918.jpg') }}">
                            </div>
                            <div class="instructor-card-text">

                                <a class="text-muted w-100" href="home/instructor_page/12.html">
                                    <h3 class="text-center">Rosalie Ruth</h3>
                                    <p class="ellipsis-line-2">Professional Film Colorist | DaVinci Resolve Trainer</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6" data-wow-duration="1000" data-wow-delay="600">
                        <div class="instructor-card-body">
                            <div class="instructor-card-img">
                                <img loading="lazy"
                                    src="{{ asset('themes/client/uploads/user_image/optimized/4cba25d6c2f7be7968ec1ae9e5c49920.jpg') }}">
                            </div>
                            <div class="instructor-card-text">

                                <a class="text-muted w-100" href="home/instructor_page/6.html">
                                    <h3 class="text-center">Mathew Anderson</h3>
                                    <p class="ellipsis-line-2">Meet Mathew, an innovative and passionate developer.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6" data-wow-duration="1000" data-wow-delay="600">
                        <div class="instructor-card-body">
                            <div class="instructor-card-img">
                                <img loading="lazy"
                                    src="{{ asset('themes/client/uploads/user_image/optimized/95f8ffe52fcc64ac943a9bfa83c00d39.jpg') }}">
                            </div>
                            <div class="instructor-card-text">

                                <a class="text-muted w-100" href="home/instructor_page/1.html">
                                    <h3 class="text-center">John Doe</h3>
                                    <p class="ellipsis-line-2">Adobe Certified Instructor &amp; Adobe Certified Expert
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------  Motivetional Speech Start ---------------->
    <section class="expert-instructor top-categories py-5 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 wow  animate__animated animate__fadeInUp opacityOnUp" data-wow-duration="1000"
                    data-wow-delay="500">
                    <h1 class="text-center f-36 mt-0 pt-0">Think more clearly</h1>
                    <p class="text-center mt-4 mb-24">Gather your thoughts, and make your decisions clearly</p>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <ul class="speech-items">
                <li class="e_border">
                    <div class="Espeech-item">
                        <div class="row  wow  animate__animated animate__fadeInUp opacityOnUp" data-wow-duration="1000"
                            data-wow-delay="700">

                            <div class="col-md-1 col-2">
                                <div class="speech-item-content Nspeech">
                                    <p class="no">1</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12  order-2 order-md-1">
                                <div class="speech-item-content Nspeech2">
                                    <div class="inner">
                                        <h4 class="title">
                                            Unleashing Your Inner Champion </h4>
                                        <p class="info">
                                            Embrace your untapped potential, push your limits, and unlock the champion
                                            within you. This motivational title encourages you to tap into your inner
                                            strength, overcome obstacles, and strive for excellence in all areas of your
                                            life. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-5 col-10 order-1 order-md-1">
                                <div class="speech-item-img">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/uploads/system/motivations/97pz6yQ1iqmjrtGPf83X.png') }}"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="e_border">
                    <div class="Espeech-item">
                        <div class="row  wow  animate__animated animate__fadeInUp opacityOnUp" data-wow-duration="1000"
                            data-wow-delay="700">

                            <div class="col-md-1 col-2">
                                <div class="speech-item-content Nspeech">
                                    <p class="no">2</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12  order-2 order-md-1">
                                <div class="speech-item-content Nspeech2">
                                    <div class="inner">
                                        <h4 class="title">
                                            Embracing the Journey of Growth </h4>
                                        <p class="info">
                                            Life is a constant journey of growth and self-improvement. This motivational
                                            title reminds you to embrace challenges, learn from failures, and celebrate
                                            successes along the way. Embrace the journey of personal and professional
                                            development. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-5 col-10 order-1 order-md-1">
                                <div class="speech-item-img">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/uploads/system/motivations/0IOAkZot1D28MpcGdYBQ.png') }}"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="e_border">
                    <div class="Espeech-item">
                        <div class="row  wow  animate__animated animate__fadeInUp opacityOnUp" data-wow-duration="1000"
                            data-wow-delay="700">

                            <div class="col-md-1 col-2">
                                <div class="speech-item-content Nspeech">
                                    <p class="no">3</p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12  order-2 order-md-1">
                                <div class="speech-item-content Nspeech2">
                                    <div class="inner">
                                        <h4 class="title">
                                            Igniting the Spark of Possibility </h4>
                                        <p class="info">
                                            Within each of us lies a spark of possibility waiting to be ignited. This
                                            motivational title inspires you to dream big, believe in yourself, and
                                            pursue your passions with unwavering determination. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-5 col-10 order-1 order-md-1">
                                <div class="speech-item-img">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/uploads/system/motivations/vdnBeoplXfA75RS3Ks2H.png') }}"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!---------  Motivetional Speech end ---------------->

    <section class="courses blog py-5 wow  animate__animated animate__fadeInUp opacityOnUp" data-wow-duration="1000"
        data-wow-delay="500">
        <div class="container">
            <h1 class="text-center f-36 pt-0"><span>Visit our latest blogs</span></h1>
            <p class="text-center">Visit our valuable articles to get more information.
            <div class="courses-card">
                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-3 wow  animate__animated animate__fadeIn" data-wow-duration="1000"
                        data-wow-delay="700">
                        <a href="blog/details/ai-based-learning-is-the-future-of-corporate-training/4.html"
                            class="courses-card-body">
                            <div class="courses-card-image">
                                <div class="courses-card-image">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/uploads/blog/thumbnail/cd729a9e1214bcc51e7eb6b3f2c07492.png') }}">
                                </div>
                                <div class="courses-card-image-text">
                                    <h3>Education</h3>
                                </div>
                            </div>
                            <div class="courses-text">
                                <h5>AI-Based learning is the future of Corporate Training</h5>
                                <p class="ellipsis-line-2">The corporate world is slowly stepping into the dimension of
                                    Artificial Intelligence. This technolog...</p>
                                <div class="courses-price-border">
                                    <div class="courses-price">
                                        <div class="courses-price-left">
                                            <img loading="lazy" class="rounded-circle"
                                                src="{{ asset('themes/client/uploads/user_image/optimized/95f8ffe52fcc64ac943a9bfa83c00d39.jpg') }}">
                                            <h5>John Doe</h5>
                                        </div>
                                        <div class="courses-price-right ">
                                            <p>Wed, 22 Dec 2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3 wow  animate__animated animate__fadeIn" data-wow-duration="1000"
                        data-wow-delay="700">
                        <a href="blog/details/balance-your-priorities-in-life-and-enjoy-a-beautiful-life/3.html"
                            class="courses-card-body">
                            <div class="courses-card-image">
                                <div class="courses-card-image">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/uploads/blog/thumbnail/f987ff9e08dc0a20fa73e9f4fd6b04e7.png') }}">
                                </div>
                                <div class="courses-card-image-text">
                                    <h3>Lifestyle</h3>
                                </div>
                            </div>
                            <div class="courses-text">
                                <h5>Balance your priorities in life and enjoy a beautiful life</h5>
                                <p class="ellipsis-line-2">Living a productive and meaningful life is a balancing act.
                                    With the pressures of today's demanding ...</p>
                                <div class="courses-price-border">
                                    <div class="courses-price">
                                        <div class="courses-price-left">
                                            <img loading="lazy" class="rounded-circle"
                                                src="{{ asset('themes/client/uploads/user_image/optimized/95f8ffe52fcc64ac943a9bfa83c00d39.jpg') }}">
                                            <h5>John Doe</h5>
                                        </div>
                                        <div class="courses-price-right ">
                                            <p>Wed, 22 Dec 2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3 wow  animate__animated animate__fadeIn" data-wow-duration="1000"
                        data-wow-delay="700">
                        <a href="blog/details/parent-power-will-we-choose-pitchforks-or-partnerships/2.html"
                            class="courses-card-body">
                            <div class="courses-card-image">
                                <div class="courses-card-image">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/uploads/blog/thumbnail/2e29eece1cf79087ddc529c3fd2e229e.png') }}">
                                </div>
                                <div class="courses-card-image-text">
                                    <h3>Education</h3>
                                </div>
                            </div>
                            <div class="courses-text">
                                <h5>Parent Power: Will We Choose Pitchforks or Partnerships?</h5>
                                <p class="ellipsis-line-2">After two tumultuous years of intermittent school closures,
                                    parents and caregivers are claiming thei...</p>
                                <div class="courses-price-border">
                                    <div class="courses-price">
                                        <div class="courses-price-left">
                                            <img loading="lazy" class="rounded-circle"
                                                src="{{ asset('themes/client/uploads/user_image/optimized/95f8ffe52fcc64ac943a9bfa83c00d39.jpg') }}">
                                            <h5>John Doe</h5>
                                        </div>
                                        <div class="courses-price-right ">
                                            <p>Wed, 22 Dec 2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

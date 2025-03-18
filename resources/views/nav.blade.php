<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Home Nine - Software, App, SaaS landing HTML Template</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/fav.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/fav.jpg') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/fav.jpg') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/fav/safari-pinned-tab.svg') }}" color="#fa7070">

    <meta name="msapplication-TileColor" content="#fa7070">
    <meta name="theme-color" content="#fa7070">

    <!-- Dependency Styles -->
    <link rel="stylesheet" href="{{ asset('dependencies/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/fontawesome/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/swiper/css/swiper.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/wow/css/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/magnific-popup/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/components-elegant-icons/css/elegant-icons.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/simple-line-icons/css/simple-line-icons.css') }}"
        type="text/css">



    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&amp;family=Satisfy&amp;display=swap"
        rel="stylesheet">



</head>
<a href="#main_content" data-type="section-switch" class="return-to-top">
    <i class="fa fa-chevron-up"></i>
</a>

<div class="page-loader">
    <div class="loader">
        <!-- Loader -->
        <div class="blobs">
            <div class="blob-center"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
            <defs>
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7"
                        result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            </defs>
        </svg>

    </div>
</div><!-- /.page-loader -->
<header class="site-header header-nine header_trans-fixed" data-top="992">
    <div class="container">
        <div class="header-inner">
            <div class="toggle-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <!-- /.toggle-menu -->

            <div class="site-mobile-logo">
                <a href="index.html" class="logo">
                    <img src="{{ asset('assets/img/logo-four.png') }}" alt="site logo" class="main-logo">
                    <img src="{{ asset('assets/img/logo-four.png') }}" alt="site logo" class="sticky-logo">
                </a>
            </div>

            <nav class="site-nav">
                <div class="close-menu">
                    <span>Close</span>
                    <i class="ei ei-icon_close"></i>
                </div>

                <div class="site-logo">
                    <a href="index-nine.html" class="logo">
                        <img src="{{ asset('assets/img/aob-logo.jpg') }}" alt="site logo" class="main-logo">
                        <img src="{{ asset('assets/img/aob-logo.jpg') }}" alt="site logo" class="sticky-logo">
                    </a>
                </div>
                <!-- /.site-logo -->

                <div class="menu-wrapper" data-top="992">
                    <ul class="site-main-menu">
                        <li class="menu-item-has-children">
                        <li><a href="{{ url('/') }}">Home </a></li>

                        </li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Consultancy</a>

                            <ul class="sub-menu">
                                <li><a href="faq.html">Architecture & Design Considerations</a></li>
                                <li><a href="faq.html">Development Process & Methodology</a></li>
                                <li><a href="faq.html">Scalability Policies & Considerations</a></li>
                                <li><a href="faq.html">Robustness Policies & Considerations</a></li>
                                <li><a href="faq.html">Performance Considerations</a></li>
                                <li><a href="faq.html">Dependency & Library Management</a></li>
                                <li><a href="faq.html">Monitoring & Maintenance</a></li>
                                <li><a href="faq.html">Testing & Quality Assurance</a></li>
                                <li><a href="faq.html">Documentation & Knowledge Sharing</a></li>
                                <li class="menu-item-has-children">
                                    <a href="service.html">Security Policies</a>
                                    <ul class="sub-menu">
                                        <li><a href="portfolio-one.html">Threat Modeling</a></li>
                                        <li><a href="portfolio-one.html">Data Protection & Privacy</a></li>
                                        <li><a href="portfolio-one.html">Authentication & Authorization</a>
                                        </li>
                                        <li><a href="portfolio-one.html">Patch Management</a></li>
                                        <li><a href="portfolio-one.html">Incident Response Planning</a></li>
                                        <li><a href="portfolio-one.html">Compliance Management</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Portfolio</a>
                                </li>
                                <li><a href="faq.html">Faq's</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Technologies</a>

                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="portfolio.html">Cloud Engineers</a>
                                    <ul class="sub-menu">
                                        <li><a href="aws.html">AWS </a></li>
                                        <li><a href="azur.html">Azure </a></li>
                                        <li><a href="gcp.html">GCP </a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="portfolio.html">Cybersecurity specialists</a>
                                    <ul class="sub-menu">
                                        <li><a href="security_analysts.html">Security Analysts </a></li>
                                        <li><a href="Cryptograpy.html">Cryptographers </a></li>
                                        <li><a href="security-architect.html">Security Architects </a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="portfolio.html">AI and data scientists</a>
                                    <ul class="sub-menu">
                                        <li><a href="data-scientist.html">Generalist Data Scientists </a></li>
                                        <li><a href="statistical.html">Statistical Data Scientists </a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="portfolio.html">DevOps</a>
                                    <ul class="sub-menu">
                                        <li><a href="dev.html">DevOps Engineers </a></li>
                                        <li><a href="site-reliability.html">Site Reliability Engineers </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">IT mentor</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="portfolio.html">Technology Stack</a>
                                    <ul class="sub-menu">
                                        <li><a href="front-end.html">Front-End Technologies </a></li>
                                        <li><a href="backend.html">Back-End Technologies </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <li><a href="{{ url('/consultant') }}">Become a Consultant</a></li>
                    </ul>

                    {{-- <div class="nav-right">
                        <a href="signin.html" class="nav-btn">Sign In</a>
                    </div> --}}
                </div>
                <!-- /.menu-wrapper -->

            </nav><!-- /.site-nav -->
        </div><!-- /.header-inner -->
    </div><!-- /.container -->
</header><!-- /.site-header -->

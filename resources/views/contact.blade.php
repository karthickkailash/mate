<!DOCTYPE html>
<html lang="en">




<body id="home-version-1" class="home-version-1" data-style="default">



    <div id="main_content">


        @includeIf('nav')

        <!--==========================-->
        <!--=         Banner         =-->
        <!--==========================-->
        <section class="page-banner-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="page-title-wrapper">
                            <div class="page-title-inner">
                                <h1 class="page-title">Get in touch with Us</h1>

                                <p>
                                    Why I say old chap that is spiffing, young delinquent in my flat bloke<br>
                                    buggered what a plonker.
                                </p>
                            </div>
                            <!-- /.page-title-inner -->
                        </div>
                        <!-- /.page-title-wrapper -->
                    </div>
                    <!-- /.col-lg-8 -->

                    <div class="col-lg-4">
                        <div class="animate-element-contact">
                            <img src="media/animated/001.png" alt="" class="wow pixFadeDown"
                                data-wow-duration="1s">
                            <img src="media/animated/002.png" alt="" class="wow pixFadeUp"
                                data-wow-duration="2s">
                            <img src="media/animated/003.png" alt="" class="wow pixFadeLeft"
                                data-wow-delay="0.3s" data-wow-duration="2s">
                            <img src="media/animated/004.png" alt="man" class="wow pixFadeUp"
                                data-wow-duration="2s">
                        </div>
                        <!-- /.animate-element-contact -->
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->

            <svg class="circle" data-parallax='{"y" : 250}' xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" width="950px" height="950px">
                <path fill-rule="evenodd" stroke="rgb(250, 112, 112)" stroke-width="100px" stroke-linecap="butt"
                    stroke-linejoin="miter" opacity="0.051" fill="none"
                    d="M450.000,50.000 C670.914,50.000 850.000,229.086 850.000,450.000 C850.000,670.914 670.914,850.000 450.000,850.000 C229.086,850.000 50.000,670.914 50.000,450.000 C50.000,229.086 229.086,50.000 450.000,50.000 Z" />
            </svg>

            <ul class="animate-ball">
                <li class="ball"></li>
                <li class="ball"></li>
                <li class="ball"></li>
                <li class="ball"></li>
                <li class="ball"></li>
            </ul>
        </section>
        <!-- /.page-banner -->

        <!--===========================-->
        <!--=         Contact         =-->
        <!--===========================-->
        <section class="contactus">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contact-infos">
                            <div class="contact-info">
                                <h3 class="title">Our Location</h3>
                                <p class="description">
                                    Washington Fulton Street, Suite 640<br>
                                    New York, NY 10010
                                </p>

                                <div class="info phone">
                                    <i class="ei ei-icon_phone"></i>
                                    <span>+1 601 978 2212</span>
                                </div>
                            </div>
                            <!-- /.contact-info -->

                            <div class="contact-info">
                                <h3 class="title">Say Hello</h3>
                                <p class="description">
                                    Washington Fulton Street, Suite 640<br>
                                    New York, NY 10010
                                </p>

                                <div class="info">
                                    <i class="ei ei-icon_mail_alt"></i>
                                    <span>support@pixsaas.com</span>
                                </div>
                            </div>
                            <!-- /.contact-info -->
                        </div>
                        <!-- /.contact-infos -->
                    </div>
                    <!-- /.col-md-4 -->
                    <div class="col-md-8">
                        <div class="contact-froms">
                            <form action="https://saaspik.pixelsigns.art/saaspik/php/mailer.php" class="contact-form"
                                data-pixsaas="contact-froms">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="Name" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>
                                </div>

                                <input type="text" name="subject" placeholder="Subject">

                                <textarea name="content" placeholder="Your Comment" required></textarea>

                                <button type="submit" class="pix-btn submit-btn">
                                    <span class="btn-text">Send Your Massage</span>
                                    <i class="fas fa-spinner fa-spin"></i>
                                </button>
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">


                                <div class="row">
                                    <div class="form-result alert">
                                        <div class="content"></div>
                                    </div>
                                </div>
                            </form>
                            <!-- /.contact-froms -->
                        </div>
                        <!-- /.faq-froms -->
                    </div>
                    <!-- /.col-md-8 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.contactus -->

        <!--========================-->
        <!--=         Map         =-->
        <!--========================-->
        <section id="google-maps">
            <div class="google-map">
                <div class="gmap3-area" data-lat="40.712776" data-lng="-74.005974"
                    data-mrkr="assets/img/map-marker.png">
                </div>
            </div><!-- /.google-map -->
        </section><!-- /#google-maps -->

        <!--=========================-->
        <!--=        Footer         =-->
        <!--=========================-->
        @includeIf('footer')
    </div><!-- /#site -->


</body>


</html>

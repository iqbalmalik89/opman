<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OPMAN Technology Operative Manager</title>
    <meta name="description" content="AIMass Tailwind based SASS Template" />

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('front/assets/img/favicon.png')}}" />

    <!-- Site font -->
    <link href="{{asset('front/assets/fonts/fonts.css')}}" rel="stylesheet" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('front/assets/css/vendors/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('front/assets/css/vendors/jos.css')}}" />
    <link rel="stylesheet" href="{{asset('front/assets/css/vendors/menu.css')}}" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('front/assets/css/custom.css')}}" />

    <!-- Development css -->
    <link href="{{asset('front/assets/css/style.css?v=')}}{{time()}}" rel="stylesheet" />

    <!-- Production css -->
    <!-- <link rel="stylesheet" href="assets/css/style.min.css"> -->
</head>

<body>
    <div class="page-wrapper relative z-[1] bg-white">
        <!--...::: Header Start :::... -->
        <header class="site-header site-header--absolute is--white py-3" id="sticky-menu">
            <div class="global-container">
                <div class="flex items-center justify-between gap-x-8">
                    <!-- Header Logo -->
                   <!--  <a href="index.html" class="">
                        <img src="" alt="OPMAN" width="96" height="24" />
                    </a> -->
                    <!-- Header Logo -->

                    <!-- Header Navigation 
                    <div class="menu-block-wrapper">
                        <div class="menu-overlay"></div>
                        <nav class="menu-block" id="append-menu-header">
                            <div class="mobile-menu-head">
                                <div class="go-back">
                                    <img class="dropdown-icon" src="assets/img/icon-black-long-arrow-right.svg"
                                        alt="cheveron-right" width="16" height="16" />
                                </div>
                                <div class="current-menu-title"></div>
                                <div class="mobile-menu-close">&times;</div>
                            </div>
                            <ul class="site-menu-main is-text-white">
                                <li class="nav-item nav-item-has-children">
                                    <a href="#" class="nav-link-item drop-trigger">Demo
                                        <img class="dropdown-icon" src="assets/img/icon-black-cheveron-right.svg"
                                            alt="cheveron-right" width="16" height="16" /></a>
                                    <ul class="sub-menu" id="submenu-1">
                                        <li class="sub-menu--item">
                                            <a href="index.html">home 01</a>
                                        </li>
                                        <li class="sub-menu--item">
                                            <a href="index-2.html">home 02</a>
                                        </li>
                                        <li class="sub-menu--item">
                                            <a href="index-3.html">home 03</a>
                                        </li>
                                        <li class="sub-menu--item">
                                            <a href="index-4.html"> home 04</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html" class="nav-link-item">About</a>
                                </li>
                                <li class="nav-item nav-item-has-children">
                                    <a href="#" class="nav-link-item drop-trigger">Services
                                        <img class="dropdown-icon" src="assets/img/icon-black-cheveron-right.svg"
                                            alt="cheveron-right" width="16" height="16" /></a>
                                    <ul class="sub-menu" id="submenu-2">
                                        <li class="sub-menu--item">
                                            <a href="services.html">Services</a>
                                        </li>
                                        <li class="sub-menu--item">
                                            <a href="service-details.html">Service Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-has-children">
                                    <a href="#" class="nav-link-item drop-trigger">Pages
                                        <img class="dropdown-icon" src="assets/img/icon-black-cheveron-right.svg"
                                            alt="cheveron-right" width="16" height="16" /></a>
                                    <ul class="sub-menu" id="submenu-3">
                                        <li class="sub-menu--item nav-item-has-children">
                                            <a href="#" data-menu-get="h3" class="drop-trigger">blogs
                                                <img class="dropdown-icon"
                                                    src="assets/img/icon-black-cheveron-right.svg" alt="cheveron-right"
                                                    width="16" height="16" /></a>
                                            <ul class="sub-menu shape-none" id="submenu-4">
                                                <li class="sub-menu--item">
                                                    <a href="blog.html">blogs</a>
                                                </li>
                                                <li class="sub-menu--item">
                                                    <a href="blog-details.html">blog details</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu--item nav-item-has-children">
                                            <a href="#" data-menu-get="h3" class="drop-trigger">Team
                                                <img class="dropdown-icon"
                                                    src="assets/img/icon-black-cheveron-right.svg" alt="cheveron-right"
                                                    width="16" height="16" />
                                            </a>
                                            <ul class="sub-menu shape-none" id="submenu-5">
                                                <li class="sub-menu--item">
                                                    <a href="teams.html">Teams</a>
                                                </li>
                                                <li class="sub-menu--item">
                                                    <a href="team-details.html">Teams Details</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu--item nav-item-has-children">
                                            <a href="#" data-menu-get="h3" class="drop-trigger">FAQ
                                                <img class="dropdown-icon"
                                                    src="assets/img/icon-black-cheveron-right.svg" alt="cheveron-right"
                                                    width="16" height="16" />
                                            </a>
                                            <ul class="sub-menu shape-none" id="submenu-6">
                                                <li class="sub-menu--item">
                                                    <a href="faq.html">FAQ-1</a>
                                                </li>
                                                <li class="sub-menu--item">
                                                    <a href="faq-2.html">FAQ-2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu--item nav-item-has-children">
                                            <a href="#" data-menu-get="h3" class="drop-trigger">Portfolio
                                                <img class="dropdown-icon"
                                                    src="assets/img/icon-black-cheveron-right.svg" alt="cheveron-right"
                                                    width="16" height="16" />
                                            </a>
                                            <ul class="sub-menu shape-none" id="submenu-7">
                                                <li class="sub-menu--item">
                                                    <a href="portfolio.html">Portfolio</a>
                                                </li>
                                                <li class="sub-menu--item">
                                                    <a href="portfolio-details.html">Portfolio Details</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="sub-menu--item">
                                            <a href="pricing.html" data-menu-get="h3" class="drop-trigger">Pricing
                                            </a>
                                        </li>

                                        <li class="sub-menu--item nav-item-has-children">
                                            <a href="#" data-menu-get="h3" class="drop-trigger">Utilities
                                                <img class="dropdown-icon"
                                                    src="assets/img/icon-black-cheveron-right.svg" alt="cheveron-right"
                                                    width="16" height="16" />
                                            </a>
                                            <ul class="sub-menu shape-none" id="submenu-8">
                                                <li class="sub-menu--item">
                                                    <a href="error-404.html">Error 404</a>
                                                </li>
                                                <li class="sub-menu--item">
                                                    <a href="login.html">Login</a>
                                                </li>
                                                <li class="sub-menu--item">
                                                    <a href="signup.html">Sign up</a>
                                                </li>
                                                <li class="sub-menu--item">
                                                    <a href="reset-password.html">Reset Password</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="contact.html" class="nav-link-item">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    Header Navigation -->

                    <!-- Header User Event -->
                   <div class="flex items-center gap-6">
                        <a href="{{route('login')}}"
                            class="button hidden rounded-[20px] border-none bg-colorViolet text-white after:bg-colorOrangyRed hover:border-colorOrangyRed hover:text-white lg:inline-block">Members Login</a>
                        <!-- <a href="signup.html"
                            class="button hidden rounded-[50px] border-none bg-colorViolet text-white after:bg-colorOrangyRed hover:border-colorOrangyRed hover:text-white lg:inline-block">Sign
                            up free</a>-->
                        <!-- Responsive Offcanvas Menu Button -->
                        <div class="block lg:hidden">
                            <button class="mobile-menu-trigger is-white"> </button>
                        </div>
                    </div>
                    <!-- Header User Event -->
                
            </div>
        </header>
        <!--...::: Header End :::... -->

        <main class="main-wrapper relative overflow-hidden">
            <!--...::: Hero Section Start :::... -->
            <section id="hero-section">
                <div class="relative overflow-hidden bg-black text-white">
                    <!-- Section Spacer -->
                    <div class="pb-28 pt-28 md:pb-40 lg:pt-28 xl:pb-[90px] xl:pt-[122px]">
                        <!-- Section Container -->
                        <div class="global-container">
                            <div class="grid grid-cols-1 items-center gap-10 md:grid-cols-[minmax(0,_1fr)_0.7fr]">
                                <!-- Hero Content -->
                                <div>
                                    <h1
                                        class="jos mb-6 max-w-md break-words font-clashDisplay text-5xl font-medium leading-none text-white md:max-w-full md:text-6xl lg:text-7xl xl:text-8xl xxl:text-[100px]">
                                        Operative Management with OPMAN
                                    </h1>
                                    <p class="jos mb-11">
                                        Reduce Workload.  Increase Efficiency. Reduce Risk from Probable to Improbable.
                                    </p>
</div>
                                <!-- Hero Content -->
                                <!-- Hero Image -->
                                <div class="hero-img rounded-2xl bg-black text-right">
                                    <img src="{{asset('front/assets/img/opman1.png')}}" alt="hero-img-2" width="1296" height="600"
                                        class="h-auto w-full" />
                                </div>
                                <!-- Hero Image -->
                            </div>
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Section Spacer -->

                    <!-- Background Gradient -->
                    <div
                        class="absolute left-1/2 top-[80%] h-[1280px] w-[1280px] -translate-x-1/2 rounded-full bg-gradient-to-t from-[#5636C7] to-[#5028DD] blur-[250px]">
                    </div>
                     <div
                        class="absolute bottom-0 left-1/2 h-[77px] w-full -translate-x-1/2 bg-[url({{asset('front/assets/img/th-2/arc-top-shape-1.svg')}})] bg-cover bg-center bg-no-repeat">
                    </div>
                </div>
            </section>
            <!--...::: Hero Section End :::... -->

            <!--...::: Feature Section Start :::... -->
            <section id="feature-section">
                <!-- Section Spacer -->
                <div class="pb-20 pt-1 xl:pb-[130px] xl:pt-[53px]">
                    <!-- Section Container -->
                    <div class="global-container">
                        <!-- Section Content Block -->
                        <div
                            class="jos mb-10 text-left sm:mx-auto sm:text-center md:mb-16 md:max-w-xl lg:mb-20 lg:max-w-3xl xl:max-w-[856px]">
                            <h3
                                class="font-clashDisplay text-4xl font-medium leading-[1.06] sm:text-[44px] lg:text-[56px] xl:text-[75px]">
                                The spreadsheet has retired</h3>
                        </div>
                        <!-- Section Content Block -->
                        <!-- Feature List -->
                        <ul class="grid gap-x-6 gap-y-10 md:grid-cols-2 xl:grid-cols-3">
                            <!-- Feature Item -->
                            <li class="jos flex flex-col gap-x-[30px] gap-y-6 sm:flex-row" data-jos_delay="0.1">
                                <div
                                    class="flex h-20 w-20 items-center justify-center rounded-full bg-white p-4 shadow-[0_4px_60px_0_rgba(0,0,0,0.1)]">
                                    <img src="{{asset('front/assets/img/th-2/icon-feature-1.svg')}}" alt="icon-feature-1" width="49"
                                        height="45" />
                                </div>
                              <div class="flex flex-1 flex-col gap-y-5">
                                <div
                                        class="font-clashDisplay text-[22px] font-medium leading-6 lg:text-[28px] lg:leading-5">
                                        Competency Alerts</div>
                                  <p>Receive operative competency expiry alerts
                                  by email and sms</p>
                              </div>
                            </li>
                            <!-- Feature Item -->
                            <!-- Feature Item -->
                            <li class="jos flex flex-col gap-x-[30px] gap-y-6 sm:flex-row" data-jos_delay="0.2">
                                <div
                                    class="flex h-20 w-20 items-center justify-center rounded-full bg-white p-4 shadow-[0_4px_60px_0_rgba(0,0,0,0.1)]">
                                    <img src="{{asset('front/assets/img/th-2/icon-feature-2.svg')}}" alt="icon-feature-2" width="45"
                                        height="45" />
                                </div>
                                <div class="flex flex-1 flex-col gap-y-5">
                                    <div
                                        class="font-clashDisplay text-[22px] font-medium leading-6 lg:text-[28px] lg:leading-5">SubContractors</div>
                                    <p>Applies to subcontractors too!</p>
                                </div>
                            </li>
                            <!-- Feature Item -->
                            <!-- Feature Item -->
                            <li class="jos flex flex-col gap-x-[30px] gap-y-6 sm:flex-row" data-jos_delay="0.3">
                                <div
                                    class="flex h-20 w-20 items-center justify-center rounded-full bg-white p-4 shadow-[0_4px_60px_0_rgba(0,0,0,0.1)]">
                                    <img src="{{asset('front/assets/img/th-2/icon-feature-3.svg')}}" alt="icon-feature-3" width="36"
                                        height="45" />
                                </div>
                                <div class="flex flex-1 flex-col gap-y-5">
                                    <div
                                        class="font-clashDisplay text-[22px] font-medium leading-6 lg:text-[28px] lg:leading-5"> 1 Point Data Access</div>
                                    <p>Competency evidence, personal profile, contacts </p>
                                </div>
                            </li>
                            <!-- Feature Item -->
                        </ul>
                        <!-- Feature List -->
                    </div>
                    <!-- Section Container -->
                </div>
                <!-- Section Spacer -->
            </section>
            <!--...::: Feature Section End :::... -->

            <!-- Separator -->
            <div class="global-container">
                <div class="h-[1px] w-full bg-[#EAEDF0]"></div>
            </div>
            <!-- Separator -->

            <!--...::: Content Section Start :::... -->
            <section id="content-section-1">
                <!-- Section Spacer -->
                <div class="pb-20 pt-20 md:pb-36 md:pt-32 lg:pb-28 xl:pb-[220px] xl:pt-[130px] xxl:pt-[200px]">
                    <!-- Section Container -->
                    <div class="global-container">
                        <div
                            class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-20 xl:grid-cols-[minmax(0,_.8fr)_1fr] xl:gap-28 xxl:gap-[134px]">
                            <!-- Content Left Block -->
                            <div class="jos order-2 mt-16 rounded-md md:order-1 md:mt-0" data-jos_animation="fade-up">
                                <div
                                    class="relative h-[494px] rounded-tl-[20px] rounded-tr-[20px] bg-[url('')] bg-cover bg-no-repeat">
                                    <img src="{{asset('front/assets/img/alertmail.png')}}" alt="Alerts by email and sms"
                                        width="526" height="495"
                                        class="absolute bottom-0 left-1/2 h-[564px] w-[526px] -translate-x-1/2" />
                                </div>
                            </div>
                            <!-- Content Left Block -->
                            <!-- Content Right Block -->
                            <div class="jos order-1 md:order-2" data-jos_animation="fade-right">
                                <!-- Section Content Block -->
                                <div class="mb-6">
                                    <h3
                                        class="font-clashDisplay text-4xl font-medium leading-[1.06] sm:text-[44px] lg:text-[56px] xl:text-[75px]">
                                      Remarkable automated alert system
                                  </h3>
                                </div>
                                <!-- Section Content Block -->
                                <div class="text-lg leading-[1.66]">
                                    <p class="mb-7 last:mb-0">
                                      OPMAN will let you know well in advance of any expiring competency<br> by email and by sms, giving you plenty of time to take action.
                                  </p>
                                    <ul
                                        class="mt-12 flex flex-col gap-y-6 font-clashDisplay text-[22px] font-medium leading-[1.28] tracking-[1px] lg:text-[28px]">
                                        <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet">
                                      Expiry Alerts by email and sms </li>
                                        <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet">
                                          Expired Competencies blocked from assignment
                                      </li>
                                        <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet">
                                      Expired Competency Archive </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Content Right Block -->
                        </div>
                    </div>
                    <!-- Section Container -->
                </div>
                <!-- Section Spacer -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Content Section Start :::... -->
            <section id="content-section-2">
                <!-- Section Spacer -->
                <div class="pb-20 md:pb-36 lg:pb-28 xl:pb-[220px]">
                    <!-- Section Container -->
                    <div class="global-container">
                        <div
                            class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-20 xl:grid-cols-[minmax(0,_1fr)_.8fr] xl:gap-28 xxl:gap-[134px]">
                            <!-- Content Right Block -->
                            <div class="jos order-2 mt-16 rounded-md md:mt-0" data-jos_animation="fade-up">
                                <div
                                    class="relative h-[494px] rounded-tl-[20px] rounded-tr-[20px] bg-[url({{asset('front/assets/img/place.png')}})] bg-cover bg-no-repeat">
                                    <img src="{{asset('front/assets/img/vault1.png')}}"
                                        width="494" height="494"
                                        class="absolute bottom-0 left-1/2 h-[564px] w-[494px] -translate-x-1/2" />
                                </div>
                            </div>
                            <!-- Content Right Block -->
                            <!-- Content Left Block -->

                            <div class="jos order-1" data-jos_animation="fade-right">
                                <!-- Section Content Block -->
                                <div class="mb-6">
                                    <h2
                                        class="font-clashDisplay text-4xl font-medium leading-[1.06] sm:text-[44px] lg:text-[56px] xl:text-[75px]">
                                    Safe and Secure </h2>
                                </div>
                                <!-- Section Content Block -->
                                <div class="text-lg leading-[1.66]">
                                    <p class="mb-7 last:mb-0">
                                      Your data encryption is performed with AES-256 in CTR mode with HMAC-SHA256 for integrity protection. The RSA key pair is randomly generated for each service. The key lengths are 256-bit for block encryption, 512-bit for integrity protection, and 3072-bits for the RSA key
                                  </p>
                                    <ul
                                        class="mt-12 flex flex-col gap-y-6 font-clashDisplay text-[22px] font-medium leading-[1.28] tracking-[1px] lg:text-[28px]">
                                        <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet"><strong>AES-256 in CTR mode</strong></li>
                                        <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet"><strong>HMAC-SHA256 for integrity protection</strong></li>
                                        <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet">Randomly generated RSA key pairs for each service </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Content Left Block -->
                        </div>
                    </div>
                    <!-- Section Container -->
                </div>
                <!-- Section Spacer -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Content Section Start :::... -->
            <section id="content-section-3">
                <!-- Section Spacer -->
                <div class="pb-20 md:pb-36 lg:pb-28 xl:pb-[150px]">
                    <!-- Section Container -->
                    <div class="global-container">
                        <div
                            class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-20 xl:grid-cols-[minmax(0,_.8fr)_1fr] xl:gap-28 xxl:gap-[134px]">
                            <!-- Content Left Block -->
                            <div class="jos order-2 mt-16 rounded-md md:order-1 md:mt-0" data-jos_animation="fade-up">
                                <div
                                    class="relative h-[494px] rounded-tl-[20px] rounded-tr-[20px] bg-[url('')] bg-cover bg-no-repeat">
                                    <img src="{{asset('front/assets/img/robot.png')}}" alt="th2-content-img-3.png"
                                        width="494" height="494"
                                        class="absolute bottom-0 left-1/2 h-[564px] w-[494px] -translate-x-1/2" />
                                </div>
                            </div>
                            <!-- Content Left Block -->
                            <!-- Content Right Block -->
                            <div class="jos order-1 md:order-2" data-jos_animation="fade-right">
                                <!-- Section Content Block -->
                                <div class="mb-6">
                                    <h4
                                        class="font-clashDisplay text-4xl font-medium leading-[1.06] sm:text-[44px] lg:text-[56px] xl:text-[75px]">Solution without disruption </h4>
                                </div>
                                <!-- Section Content Block -->
                                <div class="mb-12 text-lg leading-[1.66]">
                                    <p class="mb-7 last:mb-0">
                                        OPMAN purposely targets one disruptive issue faced by construction companies daily, after a one time data input OPMAN will take over and keep track of all competency expiry dates, sending you multiple alerts in good time so that you can action a solution and without you having to change  other established practices to achieve this. Also, our system is built in a way that should your company require additional solutions then they can be integrated, this is entirely possible.
                                    </p>
                                </div>
                                <!--<a href="https://www.example.com"
                                    class="button relative z-[1] inline-flex items-center gap-3 rounded-[50px] border-none bg-colorViolet py-[18px] text-white after:bg-colorOrangyRed hover:text-white">Try
                                    It Now
                                    <img src="assets/img/th-2/icon-white-long-arrow-right.svg"
                                        alt="icon-white-long-arrow-right" /></a>-->
                            </div>
                            <!-- Content Right Block -->
                        </div>
                    </div>
                    <!-- Section Container -->
                </div>
                <!-- Section Spacer -->
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Content Section Start :::... -->
          <section id="content-intregrates-section">
                <div class="relative z-[1] overflow-hidden bg-colorCodGray text-white">
                    <!-- Section Spacer -->
                    <div class="py-20 xl:py-[130px]">
                        <!-- Section Spacer -->
                        <div class="global-container">
                            <div
                                class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-20 xl:grid-cols-[minmax(0,_1fr)_.8fr] xl:gap-28 xxl:gap-[134px]">
                                <div class="jos">
                                    <!-- Section Content Block -->
                                    <div class="mb-6">
                                        <h2
                                            class="font-clashDisplay text-4xl font-medium leading-[1.06] text-white sm:text-[44px] lg:text-[56px] xl:text-[75px]">OPMAN <br />is watching!</h2>
                                    </div>
                                    <!-- Section Content Block -->
                                    <p class="mb-7 last:mb-0">
                                        OPMAN seamlessly scans all operative competencies, extending its scrutiny beyond internal staff to encompass subcontractor competencies as well! <br>
                                        Alo, to ensure compatibility with established procedures, users can effortlessly download a comprehensive set of all competencies, complete with an accompanying well known spreadsheet, with just a single click. </p>
                                    <ul
                                        class="my-12 flex flex-col gap-y-6 font-clashDisplay text-[22px] font-medium leading-[1.28] tracking-[1px] lg:text-[28px]">
                                      <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet">Comply with HSE everytime</li>
                                        <li
                                            class="relative pl-[35px] after:absolute after:left-[10px] after:top-3 after:h-[15px] after:w-[15px] after:rounded-[50%] after:bg-colorViolet">
                                            Reduce risk - reduce exposure
                                        </li>
                                    </ul>

                                    <!--<a href="https://www.example.com"
                                        class="button relative z-[1] inline-flex items-center gap-3 rounded-[50px] border-none bg-colorViolet py-[18px] text-white after:bg-colorOrangyRed hover:text-white">Explore
                                        Integrations
                                        <img src="assets/img/th-2/icon-white-long-arrow-right.svg"
                                            alt="icon-white-long-arrow-right" /></a>-->
                                </div>

                                <div
                                    class="flex flex-col gap-6 overflow-hidden rounded-[30px] bg-gradient-to-t from-[rgba(255,255,255,.1)] to-[rgba(0,0,0,0.5)] py-[124px]">
                                    <!-- Logo Horizontal Animation -->
                                    <div class="horizontal-slide-from-right-to-left flex w-[1161px] gap-x-6">
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-discord" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-github" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-mailchamp" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-mailchamp" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-skype" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-slack" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/redman.png')}}"
                                                alt="icon-flat-color-messenger" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-whatsapp" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-zendesk" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-zendesk" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-whatsapp" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-zendesk" />
                                        </div>
                                    </div>
                                    <!-- Logo Horizontal Animation -->

                                    <!-- Logo Horizontal Animation -->
                                    <div class="horizontal-slide-from-left-to-right flex w-[1161px] gap-x-6">
                                       <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-zendesk" />
                                      </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-whatsapp" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-zendesk" />
                                        </div> <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-discord" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-github" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-slack" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-slack" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                           <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-messenger" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-slack" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-snapchat" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-snapchat" />
                                        </div>
                                        <div
                                            class="flex h-[105px] w-[105px] items-center justify-center rounded-[10px] bg-white">
                                            <img src="{{asset('front/assets/img/th-2/icon-flat-color-discord.png')}}"
                                                alt="icon-flat-color-zendesk" />
                                        </div>
                                    </div>
                                    <!-- Logo Horizontal Animation -->
                                </div>
                            </div>
                        </div>
                        <!-- Section Spacer -->
                    </div>
                    <!-- Section Spacer -->

                    <div
                        class="absolute left-1/2 top-[80%] -z-[1] h-[1280px] w-[1280px] -translate-x-1/2 rounded-full bg-gradient-to-t from-[#5636C7] to-[#5028DD] blur-[250px]">
                    </div>
                </div>
            </section>
            <!--...::: Content Section End :::... -->

            <!--...::: Testimonial Section Start :::... -->
            <section id="testimonial-section">
                <!-- Section Spacer -->
                <div class="py-20 xl:py-[130px]">
                    <!-- Section Container -->
                    <div class="global-container">
                        <!-- Section Content Block -->
                        <div
                            class="jos mx-auto mb-10 text-center md:mb-16 md:max-w-xl lg:mb-20 lg:max-w-3xl xl:max-w-[856px]">
                            <h4
                                class="font-clashDisplay text-4xl font-medium leading-[1.06] sm:text-[44px] lg:text-[46px] xl:text-[55px]">
                                So what  can OPMAN do for me?</h4>
                        </div>
                        <!-- Section Content Block -->

                        <!-- Testimonial Carousel -->
                        <!-- Slider main container -->
                        <!-- Additional required wrapper -->
                                                            <!-- Slides -->
                                
                                    <div
                                        class="flex flex-col gap-x-16 md:flex-row lg:gap-x-28 items-center xxl:items-baseline xl:gap-x-[134px]">
                                        <div
                                            class="h-auto w-[300px] self-center overflow-hidden rounded-[10px] lg:w-[375px] xl:h-[494px] xl:w-[526px]">
                                            
                                            <p align="center">Combines all operative data into 1 simple display.<br />
                                                
                                            Alerts  in advance of a competency expiring.<br />
                                                
                                            See  valid competencies before assignment
                                            .<br /></p>
</ul>
                                        </div>
                                <div
                                            class="h-auto w-[300px] self-center overflow-hidden rounded-[10px] lg:w-[375px] xl:h-[494px] xl:w-[526px]">
                                            
                                            <p align="center">Track Operative Assigments.<br />
                                                
                                            Track SubContractor Competencies.<br />
                                                
                                            Track Training
                                            .<br /></p>
</ul>
                                        </div>
       
                                    </div>
                                
                         
                           

                           
                    
                        
                      
                    </div>
                  
                </div>
             
            </section>
          
            <!-- Separator -->

            <!-- Separator -->

            <!--...::: Blog Section Start :::... --><!--...::: Blog Section Start :::... -->

            <!--...::: FAQ Section Start :::... -->

            <!--...::: FAQ Section End :::... -->
        </main>

        <!--...::: Footer-2 Section Start :::... -->
        <footer id="footer-2" class="relative">
            <div
                class="absolute -top-[77px] left-1/2 z-10 h-[77px] w-full -translate-x-1/2 bg-[url({{asset('front/assets/img/arc-bottom-shape-1.svg')}})] bg-cover bg-center bg-no-repeat">
            </div>
            <div class="relative z-[1] overflow-hidden bg-black text-white">
                <!-- Section Container -->
                <div class="pb-10 pt-1 lg:pt-7 xl:pt-[68px]">
                    <!-- Footer Top -->
                    <div>
                        <!-- Section Container -->
                        <div class="global-container">
                            <!-- Section Content Block -->
                            <div
                                class="mx-auto mb-10 text-center md:mb-16 md:max-w-lg lg:mb-20 lg:max-w-xl xl:max-w-3xl">
                                <h2
                                    class="font-clashDisplay text-4xl font-medium leading-[1.06] text-white sm:text-[44px] lg:text-[56px] xl:text-[75px]">
                                    Let's get started and enjoy the power of OPMAN
                                </h2>
                                <div
                                class="flex flex-wrap items-center justify-center gap-5 text-center md:justify-between md:text-left">
                              

                                Request a demonstration
                                     <img src="{{asset('front/assets/img/th-2/email.png')}}" alt="icon-demo" width="200"
                                        height="50" />
                            </div>
                            </div>
                            <!-- Section Content Block -->
                            <!-- Footer Subscriber Form -->
                          
                            <!-- Footer Subscriber Form -->
                        </div>
                        <!-- Section Container -->
                    </div>
                    <!-- Footer Top -->

                    <!-- Footer Center -->
                    <div class="mt-16 xl:mt-20 xxl:mt-[100px]">
                        <!-- Section Container --><!-- Footer Center -->

                    <!-- Footer Separator -->

                    <!-- Footer Separator -->

                    <!-- Footer Bottom -->
                    <div>
                        <div class="global-container">
                            <div
                                class="flex flex-wrap items-center justify-center gap-5 text-center md:justify-between md:text-left">
                              

                                <p>&copy; Copyright 2024, All Rights Reserved OPMAN</p>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Bottom -->
                </div>
                <!-- Section Container -->
                <!-- Background Gradient -->
                <div
                    class="absolute left-1/2 top-[80%] -z-[1] h-[1280px] w-[1280px] -translate-x-1/2 rounded-full bg-gradient-to-t from-[#5636C7] to-[#5028DD] blur-[250px]">
                </div>
            </div>
        </footer>
        <!--...::: Footer-2 Section End :::... -->
    </div>

    <!--Vendor js-->
    <script src="{{asset('front/assets/js/vendors/counterup.js')}}" type="module"></script>
    <script src="{{asset('front/assets/js/vendors/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('front/assets/js/vendors/fslightbox.js')}}"></script>
    <script src="{{asset('front/assets/js/vendors/jos.min.js')}}"></script>
    <script src="{{asset('front/assets/js/vendors/menu.js')}}"></script>

    <!-- Main js -->
    <script src="{{asset('front/assets/js/main.js')}}"></script>
</body>

</html>
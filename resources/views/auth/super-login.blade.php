<x-app-layout>
    <style>
        #iframe_container{
            position: absolute;
            right: 0;
            top: 0;
            height: 100vh;
            width: 40%;
            overflow: hidden;
        }
        iframe{
            height: 2000px;
            position: absolute;
            width: 1800px;
            top: 0;
        }
        iframe>header{
            display: none;
        }
        iframe>#main{
            display: flex !important;
        }

    </style>
    <div class="auth-wrapper">
        <div class="auth-inner row m-0">
            <!-- Login-->
            <div class="d-flex col-lg-12 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-6 col-sm-8 col-md-6 col-lg-4 px-xl-2 mx-auto">
                    <!-- Brand logo-->
                    <a class="brand-logo" href="">
                        <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                    <!-- /Brand logo-->
                    <h2 class="card-title fw-bold mb-1 text-center">{{__('company-title')}}</h2>
                    <h3 class="card-text mb-1 text-center">LaborManager</h3>
                    <h3 class="card-text mb-2 text-center" id="current_time"></h3>
                    <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST" style="margin-top: 50px !important;">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="login-email">{{__('user-id')}}</label>
                            <input class="form-control" id="login-email" type="text" name="email" aria-describedby="login-email" autofocus="" tabindex="1" required/>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">{{__('password')}}</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="login-password" type="password" name="password" aria-describedby="login-password" tabindex="2" required/><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
{{--                        <div class="mb-1">--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3"/>--}}
{{--                                <label class="form-check-label" for="remember-me"> Remember Me</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <input class="form-check-input d-none" id="remember-me" type="checkbox" name="remember" checked/>--}}
                        <div class="d-flex mt-2">
                            <button class="btn btn-primary" tabindex="4" style="margin: auto">{{__('login')}}</button>
                        </div>

                    </form>
{{--                    <p class="text-center mt-2"><span>New on our platform?</span><a href="auth-register-cover.html"><span>&nbsp;Create an account</span></a></p>--}}

                </div>
            </div>
            <!-- /Login-->
        </div>
    </div>
{{--    <div id="iframe_container">--}}
{{--        <iframe src="http://www.labormanager.sakura.ne.jp/web/"></iframe>--}}
{{--    </div>--}}

</x-app-layout>

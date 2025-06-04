@extends('backend.layouts.noauth')
@section('content')

							<form class="form w-100" id="forgot-form">
								<!--begin::Heading-->



								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
									<!--end::Title-->
									<!--begin::Subtitle-->
									<div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
									<!--end::Subtitle=-->
								</div>
								<!--begin::Heading-->
								<!--begin::Login options-->
								
								<!--end::Separator-->
								<!--begin::Input group=-->
								<!--end::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Email-->
									<input type="text" placeholder="Email" name="forgot_email" autocomplete="off" class="form-control bg-transparent" data-fv-not-empty="true" />
									<!--end::Email-->
								</div>
								<!--end::Input group=-->

								<!--begin::Submit button-->
								<div class="d-flex flex-wrap justify-content-center pb-lg-0">
									<button type="submit" id="forgot-form-btn" class="btn btn-primary me-4">
										<span class="indicator-label">Submit</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<a href="{{route('login')}}" class="btn btn-light">Cancel</a>
								</div>



								<div id="login_msg"></div>

								<!--end::Submit button-->
								<!--begin::Sign up-->
<!-- 								<div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
								<a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html" class="link-primary">Sign up</a></div> -->
								<!--end::Sign up-->
							</form>
@endsection

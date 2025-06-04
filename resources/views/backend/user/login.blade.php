@extends('backend.layouts.noauth')
@section('content')

							<form class="form w-100" id="page-form">
								<!--begin::Heading-->



								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-dark fw-bolder mb-3">Sign In</h1>
									<!--end::Title-->
									<!--begin::Subtitle-->
									<!-- <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div> -->
									<!--end::Subtitle=-->
								</div>
								<!--begin::Heading-->
								<!--begin::Login options-->
								

								<!--end::Separator-->
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Email-->
									<input type="hidden" name="code" />


									<input type="text" placeholder="Email" name="user_email" autocomplete="off" class="form-control bg-transparent" data-fv-not-empty="true" />
									<!--end::Email-->
								</div>
								<!--end::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::Password-->
									<input type="password" placeholder="Password" name="user_password" autocomplete="off" class="form-control bg-transparent" />
									<!--end::Password-->
								</div>
								<!--end::Input group=-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div>
									@if(empty(tenant()))
										<!-- <a href="{{route('register')}}" class="link-primary">Register Now</a> -->
									@endif
										
									</div>
									<!--begin::Link-->
									<a href="{{route('request-password')}}" class="link-primary">Forgot Password ?</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" id="page-form-btn" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">Sign In</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>

								<div id="login_msg"></div>

								<!--end::Submit button-->
								<!--begin::Sign up-->
<!-- 								<div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
								<a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html" class="link-primary">Sign up</a></div> -->
								<!--end::Sign up-->
							</form>
@endsection

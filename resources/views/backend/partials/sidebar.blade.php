					<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
						<!--begin::Logo-->
						<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
							<!--begin::Logo image-->
							@if(!empty($settings->logo_img_path))
								@php
									if(tenant())
										$url = \Storage::url('site/' . $settings->logo_img_path);
									else	
										$url = global_asset('storage/site/' . $settings->logo_img_path);				
								@endphp
							<a href="javascript:void(0);">
								<img alt="Logo" src="{{$url}}" class="h-50px app-sidebar-logo-default" />
								<img alt="Logo" src="{{$url}}" class="h-20px app-sidebar-logo-minimize" />
							</a>
							@else
								<span class="text-white fs-4 fw-semibold">{{$settings->site_title}}</span>						
							@endif
							<!--end::Logo image-->
							<!--begin::Sidebar toggle-->
							<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
								<span class="svg-icon svg-icon-2 rotate-180">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
										<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<!--end::Sidebar toggle-->
						</div>
						<!--end::Logo-->
						<!--begin::sidebar menu-->
						<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
							<!--begin::Menu wrapper-->
							<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
								<!--begin::Menu-->
								<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
									<!--begin:Menu item-->
									<!--begin:Menu item-->


									<x-backend.left.dashboard/>								

						        @if(Auth::user()->getRoleNames()[0] == 'owner')

									<x-backend.left.companies/>								

									<x-backend.left.settings/>

								@endif

						        @if(Auth::user()->getRoleNames()[0] != 'owner')


						        	@if(Auth::user()->getRoleNames()[0] == 'manager')
									<div data-kt-menu-trigger="click" class="menu-item {{Nav::urlDoesContain('subcontractor', 'here show')}}
									{{Nav::urlDoesContain('team/edit', 'here show')}} menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<i class="fa-solid fa-people-group text-white"></i>
											</span>
											<span class="menu-title">Subcontractors</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion menu-active-bg">
											<x-backend.left.subcontractor-listing/>
										</div>
										<!--end:Menu sub-->
									</div>





										<x-backend.left.people-search/>
										<?php /*
										<x-backend.left.active-people/>
										<x-backend.left.inactive-people/>
										*/ ?>
										<x-backend.left.site-search/>								
										<x-backend.left.site-listing/>
										<x-backend.left.projects/>
										<x-backend.left.training/>

						        	@elseif(Auth::user()->getRoleNames()[0] == 'super_admin' || Auth::user()->getRoleNames()[0] == 'admin')

									<div data-kt-menu-trigger="click" class="menu-item {{Nav::urlDoesContain('people', 'here show')}}  menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<i class="fa-solid fa-users text-white"></i>
											</span>
											<span class="menu-title">People</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion menu-active-bg">
											<x-backend.left.people-search/>
											<?php /*
											<x-backend.left.active-people/>
											<x-backend.left.inactive-people/>
											*/ ?>

											<x-backend.left.add-people/>

										</div>
										<!--end:Menu sub-->
									</div>


									<div data-kt-menu-trigger="click" class="menu-item {{Nav::urlDoesContain('subcontractor', 'here show')}}
									{{Nav::urlDoesContain('team/edit', 'here show')}} menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<i class="fa-solid fa-people-group text-white"></i>
											</span>
											<span class="menu-title">Subcontractors</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion menu-active-bg">
											<x-backend.left.subcontractor-search/>	
											<x-backend.left.subcontractor-listing/>


										</div>
										<!--end:Menu sub-->
									</div>


									<div data-kt-menu-trigger="click" class="menu-item {{Nav::urlDoesContain('project', 'here show')}} menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<i class="fa-solid fa-screwdriver-wrench text-white"></i>
											</span>
											<span class="menu-title">Projects</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion menu-active-bg">
											<x-backend.left.projects/>	
											<x-backend.left.create-project/>
											<x-backend.left.project-archive/>

										</div>
										<!--end:Menu sub-->
									</div>





									<x-backend.left.admin/>								

									<div data-kt-menu-trigger="click" class="menu-item {{Nav::urlDoesContain('site', 'here show')}} menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<i class="fa-solid fa-city text-white"></i>
											</span>
											<span class="menu-title">Site</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion menu-active-bg">
											<x-backend.left.site-search/>	
											<x-backend.left.site-listing/>
											<x-backend.left.add-site/>


										</div>
										<!--end:Menu sub-->
									</div>


									<div data-kt-menu-trigger="click" class="menu-item {{Nav::urlDoesContain('subcontractor', 'here show')}}
										{{Nav::urlDoesContain('team/edit', 'here show')}} menu-accordion">
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
												<i class="fa-solid fa-people-group text-white"></i>
											</span>
											<span class="menu-title">Subcontractors</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<!--begin:Menu sub-->
										<div class="menu-sub menu-sub-accordion menu-active-bg">
											<x-backend.left.manage-subteams/>
											<x-backend.left.add-subcontractor/>
											<x-backend.left.add-suboperative/>


										</div>
										<!--end:Menu sub-->
									</div>

									

										<x-backend.left.manage-categories/>

										<x-backend.left.client/>
										<x-backend.left.training/>
										<x-backend.left.expired/>

									@endif



						        @if(Auth::user()->getRoleNames()[0] == 'super_admin')

									<x-backend.left.superadmin/>								


										<div data-kt-menu-trigger="click" class="menu-item {{Nav::urlDoesContain('user', 'here show')}} menu-accordion">
											<!--begin:Menu link-->
											<span class="menu-link">
												<span class="menu-icon">
													<i class="fa-solid fa-users-between-lines text-white"></i>
												</span>
												<span class="menu-title">Users</span>
												<span class="menu-arrow"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-accordion menu-active-bg">
												<x-backend.left.users-listing/>	
												<x-backend.left.add-user/>
											</div>
											<!--end:Menu sub-->
										</div>

										<x-backend.left.banned/>
										<x-backend.left.deactivated/>
										<x-backend.left.backup/>
										<x-backend.left.settings/>


									@endif






									<?php /*
									<x-backend.left.dashboard/>								
									<x-backend.left.companies/>								
									<x-backend.left.people-search/>
									<x-backend.left.site-search/>	
									<x-backend.left.subcontractor-search/>
									<x-backend.left.projects/>
									<x-backend.left.admin/>
									<x-backend.left.add-people/>
									<x-backend.left.site-listing/>
									<x-backend.left.add-subcontractor/>
									<x-backend.left.add-suboperative/>
									<x-backend.left.manage-subteams/>
									<x-backend.left.create-project/>
									<x-backend.left.manage-categories/>
									<x-backend.left.superadmin/>
									<x-backend.left.users-listing/>
									<x-backend.left.settings/>
									*/ ?>




								@endif


									<!--end:Menu item-->
								</div>
								<!--end::Menu-->
							</div>
							<!--end::Menu wrapper-->
						</div>
						<!--end::sidebar menu-->
						<!--begin::Footer-->

									<x-backend.left.logout/>								


						<!--end::Footer-->
					</div>
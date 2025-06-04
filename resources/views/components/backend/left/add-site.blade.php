@if(Auth::user()->hasPermissionTo('add site'))
									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('create-site')}}" href="{{route('create-site')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-plus text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Add Site</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif
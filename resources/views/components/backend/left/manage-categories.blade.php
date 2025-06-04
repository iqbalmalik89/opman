@if(Auth::user()->hasPermissionTo('view category listing'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::urlDoesContain('catego')}} {{Nav::urlDoesContain('cert')}}" href="{{route('categories')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-sitemap text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Manage Categories</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif
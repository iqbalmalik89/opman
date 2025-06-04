@if(Auth::user()->hasPermissionTo('view clients'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('clients')}}" href="{{route('clients')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												<i class="fa-solid  fa-user-tie text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Clients</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif
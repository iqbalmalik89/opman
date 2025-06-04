	

		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";
		var storageUrl = '{{$storageUrl ?? ''}}';
		</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{global_asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{global_asset('assets/js/scripts.bundle.js')}}"></script>
		<script src="{{global_asset('assets/js/intlTelInput.min.js')}}"></script>



		<script src="{{global_asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<script src="{{global_asset('assets/js/lightboxed.js?time=')}}1"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<script src="{{global_asset('assets/js/custom/printThis.js?v=')}}{{time()}}"></script>


		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{global_asset('assets/js/custom/backend.js?v=')}}{{time()}}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
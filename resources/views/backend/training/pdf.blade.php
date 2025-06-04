<!DOCTYPE html>
<html>
<head>
	<style>
	td {
  line-height: 1.5;
  /* 1 */
  -webkit-text-size-adjust: 100%;
  /* 2 */
  -moz-tab-size: 4;
  /* 3 */
  -o-tab-size: 4;
     tab-size: 4;
  /* 3 */
  font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  /* 4 */
  font-feature-settings: normal;
  /* 5 */
  font-variation-settings: normal;
  /* 6 */
}


	td
	{
		color: #1a1a1a;
	}

	.center-table
	{
		margin-left: auto;margin-right: auto;		
		border: 1px solid #ccc;
		padding: 40px;
	}

	tr td:first-child{
		width: 500px;
	}

	tr td:nth-child(2){
		width: 400px;
	}	


	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table class="center-table">
	<tbody>
			
		<tr>
			<td style="width: 50%;">Name</td>
			<td>Skill</td>
		</tr>
			
		<tr>
			<td style="font-size: 20px;padding-bottom: 30px;">{{$data->people->first_name}} {{$data->people->last_name}}</td>
			<td style="font-size: 20px;padding-bottom: 30px;">{{$data->skill->certification}}</td>
		</tr>

		<tr>
			<td>Address</td>
			<td>Course Provider</td>
		</tr>

		<tr>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->people->address1) ? "-" : $data->people->address1 }}</td>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->course_provider) ?  "-" : $data->course_provider}}</td>
		</tr>


		<tr>
			<td>Postcode</td>
			<td>Course Date</td>
		</tr>

		<tr>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->people->postcode) ?  "-" : $data->people->postcode }}</td>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->course_date) ? "-" : date('d/m/Y', strtotime($data->course_date)) }}</td>
		</tr>


		<tr>
			<td>D.O.B</td>
			<td>Course Location</td>
		</tr>

		<tr>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->people->dob) ? "-" : date('d/m/Y', strtotime($data->people->dob)) }}</td>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->course_location) ?  "-" : $data->course_location }}</td>
		</tr>

		<tr>
			<td>NI Number</td>
			<td></td>
		</tr>

		<tr>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->people->ni_number) ?  "-" : $data->people->ni_number }}</td>
			<td></td>
		</tr>

		<tr>
			<td>Mobile</td>
			<td></td>
		</tr>

		<tr>
			<td style="font-size: 20px;padding-bottom: 30px;">{{ empty($data->people->mobile) ?  "-" : $data->people->mobile }}</td>
			<td></td>
		</tr>
	</tbody>


	<!-- 	<tr>
			<td>
				<table style="width:200px;">
					<tr><td>Name</td></tr>
					<tr class="spaceUnder"><td>{{$data->people->first_name}} {{$data->people->last_name}}</td></tr>

					<tr><td>Address</td></tr>
					<tr class="spaceUnder"><td>{{$data->people->address1}}</td></tr>

					<tr><td>Postcode</td></tr>
					<tr class="spaceUnder"><td>{{$data->people->postcode}}</td></tr>

					<tr><td>D.O.B</td></tr>
					<tr class="spaceUnder"><td>{{date('d/m/Y', strtotime($data->people->dob))}}</td></tr>

					<tr><td>NI Number</td></tr>
					<tr class="spaceUnder"><td>{{$data->people->ni_number}}</td></tr>

					<tr><td>Mobile</td></tr>
					<tr class="spaceUnder"><td>{{$data->people->mobile}}</td></tr>
				</table>				
			</td>


			<td>
				<table>
					<tr><td>Skill</td></tr>
					<tr class="spaceUnder"><td>{{$data->skill->certification}}</td></tr>

					<tr><td>Course Provider</td></tr>
					<tr class="spaceUnder"><td>{{$data->skill->course_provider}}</td></tr>

					<tr><td>Course Date</td></tr>
					<tr class="spaceUnder"><td>{{date('d/m/Y', strtotime($data->course_date))}}</td></tr>

					<tr><td>Course Location</td></tr>
					<tr class="spaceUnder"><td>{{$data->skill->course_location}}</td></tr>
				</table>
			</td>
		</tr> -->
	</table>
</body>
</html>
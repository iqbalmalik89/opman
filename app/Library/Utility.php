<?php
  
namespace App\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\BasePermission;
use App\Models\User;
use App\Models\Postcodelatlng;
  
class Utility
{
	public static function getSuperAdmin() 
	{
		return User::role('super_admin')->first();
    }

    // public static function url()
    // {
    // 	return \Storage::url( "/storage/logo/");
    // }

	public static function haversineGreatCircleDistance($postcode1, $postcode2, $earthRadius = 6371000)
	{
		$postcode1Db = Postcodelatlng::where('postcode', $postcode1)->first();
		$postcode2Db = Postcodelatlng::where('postcode', $postcode2)->first();
		if(!empty($postcode1Db) && !empty($postcode2Db))
		{
			// convert from degrees to radians
			$latFrom = deg2rad($postcode1Db->latitude);
			$lonFrom = deg2rad($postcode1Db->longitude);
			$latTo = deg2rad($postcode2Db->latitude);
			$lonTo = deg2rad($postcode2Db->longitude);

			$latDelta = $latTo - $latFrom;
			$lonDelta = $lonTo - $lonFrom;

			$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
			cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
			return $angle * $earthRadius;			
		}
		else
		{
			return '';
		}

	}

	public static function paginator($data, $paginate, $limit) {

        $data['meta'] = [];
        $data['meta']['page'] = $paginate->currentPage();
        $data['meta']['pages'] =  $paginate->lastPage();
        $data['meta']['perpage'] = $limit;
        $data['meta']['total'] = $paginate->total();

        return $data;
    }

    public static function getPermissions($role = '')
    {
    	$permissions = [];
    	$json = json_decode(file_get_contents(storage_path('app/public/permissions.json')), true);

    	if(empty($role))
    	{
	    	foreach($json as $perm)
	    	{
	    		$permissions[] = $perm['permission'];
	    	}    		
    	}
    	elseif(!empty($role))
		{
	    	foreach($json as $perm)
	    	{
	    		if(!empty($perm[$role]))
		    		$permissions[] = $perm['permission'];
	    	}
		}




		return $permissions;

		// $permissions = ['view dashboard','people search','add people','update people','delete people','add people document','edit people document','view people document','delete people document','site search','add site','update site','delete site','people listing','site listing','subcontractor listing','add subcontractor','delete subcontractor','update subcontractor','view suboperatives of a subcontractor','update suboperative','add suboperative','delete suboperative','upload suboperative document','delete suboperative document','view suboperative document','add project','update project','delete project','change project status','view projects','view category listing','add category','update category','delete category','add certification','view certification','delete certification','update certification','view settings','update settings','view user listing','add user','update user','delete user','view subcontractor teams','add subcontractor team','edit subcontractor team','delete subcontractor team','view companies','add company','suspend company account','backup company data','backup all companies data', 'restore company data', 'add client', 'view clients', 'delete client', 'update client', 'add training', 'view training', 'delete training', 'update training'];

		// if($role == 'owner')
		// {
		// 	$permissions = ['view dashboard', 'view settings','update settings','view companies','add company','suspend company account','backup company data','backup all companies data'];
		// }
		// else if($role == 'super_admin')
		// {
		// 	$permissions = ['view dashboard','people search','add people','update people','delete people','add people document','edit people document','view people document','delete people document','site search','add site','update site','delete site','people listing','site listing','subcontractor listing','add subcontractor','delete subcontractor','update subcontractor','view suboperatives of a subcontractor','update suboperative','add suboperative','delete suboperative','upload suboperative document','delete suboperative document','view suboperative document','add project','update project','delete project','change project status','view projects','view category listing','add category','update category','delete category','add certification','view certification','delete certification','update certification','view settings','update settings','view user listing','add user','update user','delete user','view subcontractor teams','add subcontractor team','edit subcontractor team','delete subcontractor team',];

		// }
		// else if($role == 'admin')
		// {
		// 	$permissions = ['view dashboard','people search','add people','update people','delete people','add people document','view people document','edit people document','delete people document','site search','add site','update site','delete site','people listing','site listing','subcontractor listing','add subcontractor','delete subcontractor','update subcontractor','view suboperatives of a subcontractor','update suboperative','add suboperative','delete suboperative','upload suboperative document','delete suboperative document','view suboperative document','add project','update project','delete project','change project status','view projects','view category listing','add category','update category','delete category','add certification','view certification','delete certification','update certification','view subcontractor teams','add subcontractor team','edit subcontractor team','delete subcontractor team'];

		// }
		// else if($role == 'manager')
		// {
		// 	$permissions = ['view dashboard','people search','site search','view people document','people listing','view projects','view subcontractor teams','add subcontractor team','edit subcontractor team','delete subcontractor team'];

		// }

		// return $permissions;    	
    }

    public static function moveFile($agentImage, $folder)
    {
        if(!empty($agentImage))
        {
            $dir = storage_path('app/public/'.$folder.'/');
            $tmpPath = storage_path('app/public/tmp/'.$agentImage); 
            if(file_exists($tmpPath))
            {
                rename($tmpPath, $dir . $agentImage);
            }
        }

        return $agentImage;
    }


    public static function setCurrentpage($currentPage) {
        Paginator::currentPageResolver(function() use ($currentPage) {
            return $currentPage;
        });
    }
    
    public static function classActivePath($modules)
    {
        $class = '';
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        foreach ($modules as $key => $module) {
            if($module == $currentPath)
            {
                return 'kt-menu__item--here';
            }
            else
                $class = '';
        }
    }

    public static function classOpenPath($modules)
    {
        $class = '';
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        foreach ($modules as $key => $module) {
            if($module == $currentPath)
            {
                return 'kt-menu__item--open';
            }
            else
                $class = '';
        }
    }

    public static function obfuscateText($name, $char)
    {
    	if(Auth::check() && Auth::user()->hasRole('admin'))
    		return $name;

    	$nameArr = str_split(trim($name));
    	if(!empty($nameArr))
    	{
	    	$nameArrCount = count($nameArr);

	    	for($i = 1; $i < ($nameArrCount - 1); $i++)
	    	{
	    		$nameArr[$i] = $char;
	    	}
    	}

    	return implode('', $nameArr);

    }


    public static function classActiveSegment($segment, $value)
    {
        if(!is_array($value)) {
            return Request::segment($segment) == $value ? ' active' : '';
        }
        foreach ($value as $v) {
            if(Request::segment($segment) == $v) return ' active';
        }
        return '';
    }


	public static function getUserIp() 
    {
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';

	    if($ipaddress == '::1')
	    {
	    	$ipaddress = '119.160.119.253';
	    }

	    return $ipaddress;
	} 

	public static function isWeb()
	{
		return http_response_code()!==FALSE;
	}

	public static function setTimezone($timezone)
	{
        setcookie('timezone', $timezone, time() + 86400, '/');

        // settimezone
        if(Auth::check())
        {
            $user = Auth::user();
            $user->timezone = $timezone;
            $user->update();
        }

        return true;
	}

	public static function changeDateTz($dateTime, $toTimezone = '')
	{
		if(empty($toTimezone))
			$toTimezone = Self::getTimezone();

		return  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateTime, env('TIMEZONE'))->setTimezone($toTimezone);
	}

	public static function getTimezone()
	{
		if(Self::isWeb())
		{
			if(empty($_COOKIE['timezone']))
			{
				$ip = Self::getUserIp();
				$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
				$ipInfo = json_decode($ipInfo);
				$timezone = $ipInfo->timezone;	
				Self::setTimezone($timezone);
			}
			else
			{
				$timezone = $_COOKIE['timezone'];
			}

			return $timezone;			
		}
		else
		{
			return env('timezone');
		}
	}


	function encrypt(string $message, string $key): string
	{
	    if (mb_strlen($key, '8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
	        throw new \RangeException('Key is not the correct size (must be 32 bytes).');
	    }
	    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

	    $cipher = base64_encode(
	        $nonce.
	        sodium_crypto_secretbox(
	            $message,
	            $nonce,
	            $key
	        )
	    );
	    sodium_memzero($message);
	    sodium_memzero($key);
	    return $cipher;
	}

	function setSessionCookie($nonce='', $fingerprint='') 
	{
	  /* Encrypt the payload for the session cookie */
	  $payload = encrypt($nonce, $fingerprint);
	  logEvent('encrypted session cookie payload: ' . $payload);
	  /* Set the session cookie, validity of 5 minutes, secure, httponly */
	  setcookie('ddos', $payload, time() + 300, "", "", TRUE, TRUE);
	}

	public function getBrowserFingerprint()
	{
		  $client_ip = $this->getUserIp();
		  $useragent = $_SERVER['HTTP_USER_AGENT'];
		  $accept   = $_SERVER['HTTP_ACCEPT'];
		  // $charset  = $_SERVER['HTTP_ACCEPT_CHARSET'];
		  $encoding = $_SERVER['HTTP_ACCEPT_ENCODING'];
		  $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		  $data = '';
		  $data .= $client_ip;
		  $data .= $useragent;
		  $data .= $accept;
		  // $data .= $charset;
		  $data .= $encoding;
		  $data .= $language;
		  /* Apply SHA256 hash to the browser fingerprint */
		  $hash = hash('sha256', $data);
		  return $hash;
	}    

	public function isFingerprintValid($fingerprint="") {
	  /* Compare the provided browser fingerprint with the actual fingerprint */
	  if ($fingerprint === $this->getBrowserFingerprint()) {
	    return TRUE;
	  }  else {
	    exit;
	  }
	    return FALSE;
	}



	public static function flashMsg()
	{
		$html = '<div class="flash-message">';
		  foreach (['danger', 'warning', 'success', 'info'] as $msg)
		  {
		    if(\Session::has('alert-' . $msg))
		    {
			    $html = '<p class="alert alert-'.$msg.'">'.\Session::get('alert-' . $msg).'</p>';
		    }
		  }

		$html .= '</div>';
		return $html;
	}



	public static function getYearsDiff($startDate, $endDate)
	{
		if(empty($endDate))
			$endDate = date('Y-m-d');
		$interval = date_diff(date_create($endDate), date_create($startDate));

		echo $interval->format("%Y yr %M mo");
	}


	public static function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  }

	  return $text;
	}

	public static function getExtension($filename)
	{
		return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	}

	public static function dateFormats()
	{
		return ['MM/DD/YY', 'DD/MM/YY', 'YY/MM/DD'];
	}

	public static function logo($width)
	{
		$logo = \App\Services\SettingService::setting('logo');

		if(!empty($logo))
			echo '<img style="width: '.$width.'%;" alt="Logo" src="'.url('storage/asset').'/'.$logo.'" />';
		else
			echo '<img style="width: '.$width.'%;" alt="Logo" src="'.asset('assets/media/logos/logo.png?v=1').'" />';
	}


	public static function getPercentUpDown($old_number, $new_number) {

        if( $old_number != 0 ) {
            $percent = (($new_number - $old_number) / $old_number * 100);
        } else {
            $percent = $new_number * 100;
        }
        

        $class = 'text-success';
        $arrow = 'icon-arrow-button-up-2';
        if( $old_number > $new_number ) {
            $class = 'text-danger';
            $arrow = 'icon-arrow-button-down-2';
        } 
        
        $output = '<div class="views-percentage '.$class.'">
            <i class="houzez-icon '.$arrow.'"></i> '.round($percent, 1).'%
        </div>';

        return $output;
    }

	public static function getDocCategories()
	{
		$docTypes = ['general_info' => ['name' => 'General Info', 'roles' => []],
				'training_manual' => ['name' => 'Training Mannual', 'roles' => []],
				'contracts' => ['name' => 'Contracts', 'roles' => []],
				'rel' => ['name' => 'Real Estate License', 'roles' => []],
				//'competitors' => ['name' => 'Competitors', 'roles' => []],
				];

		return $docTypes;
	}

	public static function companyStatus()
	{
		$statuses = ['success' => 'Active', 'warning' => 'Suspended', 'danger' => 'Deleted'];

		return $statuses;
	}

	public static function getPrices()
	{
		return [10000, 20000, 50000, 60000, 100000, 200000, 350000, 500000, 1000000, 3000000];
	}

	public static function getProjectStatuses($status = '')
	{
		$statusArr = ['Planning' => 'primary',  'Active'=>'info', 'Complete'=>'success', 'Handover'=> 'danger', 'Archived'=> 'warning'];

		if(empty($status))
			return $statusArr;
		else
			return $statusArr[$status];
	}
	

	public static function getCountries($code = '')
	{
$countries =
 
array(
"AF" => "Afghanistan",
"AL" => "Albania",
"DZ" => "Algeria",
"AS" => "American Samoa",
"AD" => "Andorra",
"AO" => "Angola",
"AI" => "Anguilla",
"AQ" => "Antarctica",
"AG" => "Antigua and Barbuda",
"AR" => "Argentina",
"AM" => "Armenia",
"AW" => "Aruba",
"AU" => "Australia",
"AT" => "Austria",
"AZ" => "Azerbaijan",
"BS" => "Bahamas",
"BH" => "Bahrain",
"BD" => "Bangladesh",
"BB" => "Barbados",
"BY" => "Belarus",
"BE" => "Belgium",
"BZ" => "Belize",
"BJ" => "Benin",
"BM" => "Bermuda",
"BT" => "Bhutan",
"BO" => "Bolivia",
"BA" => "Bosnia and Herzegovina",
"BW" => "Botswana",
"BV" => "Bouvet Island",
"BR" => "Brazil",
"IO" => "British Indian Ocean Territory",
"BN" => "Brunei Darussalam",
"BG" => "Bulgaria",
"BF" => "Burkina Faso",
"BI" => "Burundi",
"KH" => "Cambodia",
"CM" => "Cameroon",
"CA" => "Canada",
"CV" => "Cape Verde",
"KY" => "Cayman Islands",
"CF" => "Central African Republic",
"TD" => "Chad",
"CL" => "Chile",
"CN" => "China",
"CX" => "Christmas Island",
"CC" => "Cocos (Keeling) Islands",
"CO" => "Colombia",
"KM" => "Comoros",
"CG" => "Congo",
"CD" => "Congo, the Democratic Republic of the",
"CK" => "Cook Islands",
"CR" => "Costa Rica",
"CI" => "Cote D'Ivoire",
"HR" => "Croatia",
"CU" => "Cuba",
"CY" => "Cyprus",
"CZ" => "Czech Republic",
"DK" => "Denmark",
"DJ" => "Djibouti",
"DM" => "Dominica",
"DO" => "Dominican Republic",
"EC" => "Ecuador",
"EG" => "Egypt",
"SV" => "El Salvador",
"GQ" => "Equatorial Guinea",
"ER" => "Eritrea",
"EE" => "Estonia",
"ET" => "Ethiopia",
"FK" => "Falkland Islands (Malvinas)",
"FO" => "Faroe Islands",
"FJ" => "Fiji",
"FI" => "Finland",
"FR" => "France",
"GF" => "French Guiana",
"PF" => "French Polynesia",
"TF" => "French Southern Territories",
"GA" => "Gabon",
"GM" => "Gambia",
"GE" => "Georgia",
"DE" => "Germany",
"GH" => "Ghana",
"GI" => "Gibraltar",
"GR" => "Greece",
"GL" => "Greenland",
"GD" => "Grenada",
"GP" => "Guadeloupe",
"GU" => "Guam",
"GT" => "Guatemala",
"GN" => "Guinea",
"GW" => "Guinea-Bissau",
"GY" => "Guyana",
"HT" => "Haiti",
"HM" => "Heard Island and Mcdonald Islands",
"VA" => "Holy See (Vatican City State)",
"HN" => "Honduras",
"HK" => "Hong Kong",
"HU" => "Hungary",
"IS" => "Iceland",
"IN" => "India",
"ID" => "Indonesia",
"IR" => "Iran, Islamic Republic of",
"IQ" => "Iraq",
"IE" => "Ireland",
"IL" => "Israel",
"IT" => "Italy",
"JM" => "Jamaica",
"JP" => "Japan",
"JO" => "Jordan",
"KZ" => "Kazakhstan",
"KE" => "Kenya",
"KI" => "Kiribati",
"KP" => "Korea, Democratic People's Republic of",
"KR" => "Korea, Republic of",
"KW" => "Kuwait",
"KG" => "Kyrgyzstan",
"LA" => "Lao People's Democratic Republic",
"LV" => "Latvia",
"LB" => "Lebanon",
"LS" => "Lesotho",
"LR" => "Liberia",
"LY" => "Libyan Arab Jamahiriya",
"LI" => "Liechtenstein",
"LT" => "Lithuania",
"LU" => "Luxembourg",
"MO" => "Macao",
"MK" => "Macedonia, the Former Yugoslav Republic of",
"MG" => "Madagascar",
"MW" => "Malawi",
"MY" => "Malaysia",
"MV" => "Maldives",
"ML" => "Mali",
"MT" => "Malta",
"MH" => "Marshall Islands",
"MQ" => "Martinique",
"MR" => "Mauritania",
"MU" => "Mauritius",
"YT" => "Mayotte",
"MX" => "Mexico",
"FM" => "Micronesia, Federated States of",
"MD" => "Moldova, Republic of",
"MC" => "Monaco",
"MN" => "Mongolia",
"MS" => "Montserrat",
"MA" => "Morocco",
"MZ" => "Mozambique",
"MM" => "Myanmar",
"NA" => "Namibia",
"NR" => "Nauru",
"NP" => "Nepal",
"NL" => "Netherlands",
"AN" => "Netherlands Antilles",
"NC" => "New Caledonia",
"NZ" => "New Zealand",
"NI" => "Nicaragua",
"NE" => "Niger",
"NG" => "Nigeria",
"NU" => "Niue",
"NF" => "Norfolk Island",
"MP" => "Northern Mariana Islands",
"NO" => "Norway",
"OM" => "Oman",
"PK" => "Pakistan",
"PW" => "Palau",
"PS" => "Palestinian Territory, Occupied",
"PA" => "Panama",
"PG" => "Papua New Guinea",
"PY" => "Paraguay",
"PE" => "Peru",
"PH" => "Philippines",
"PN" => "Pitcairn",
"PL" => "Poland",
"PT" => "Portugal",
"PR" => "Puerto Rico",
"QA" => "Qatar",
"RE" => "Reunion",
"RO" => "Romania",
"RU" => "Russian Federation",
"RW" => "Rwanda",
"SH" => "Saint Helena",
"KN" => "Saint Kitts and Nevis",
"LC" => "Saint Lucia",
"PM" => "Saint Pierre and Miquelon",
"VC" => "Saint Vincent and the Grenadines",
"WS" => "Samoa",
"SM" => "San Marino",
"ST" => "Sao Tome and Principe",
"SA" => "Saudi Arabia",
"SN" => "Senegal",
"CS" => "Serbia and Montenegro",
"SC" => "Seychelles",
"SL" => "Sierra Leone",
"SG" => "Singapore",
"SK" => "Slovakia",
"SI" => "Slovenia",
"SB" => "Solomon Islands",
"SO" => "Somalia",
"ZA" => "South Africa",
"GS" => "South Georgia and the South Sandwich Islands",
"ES" => "Spain",
"LK" => "Sri Lanka",
"SD" => "Sudan",
"SR" => "Suriname",
"SJ" => "Svalbard and Jan Mayen",
"SZ" => "Swaziland",
"SE" => "Sweden",
"CH" => "Switzerland",
"SY" => "Syrian Arab Republic",
"TW" => "Taiwan, Province of China",
"TJ" => "Tajikistan",
"TZ" => "Tanzania, United Republic of",
"TH" => "Thailand",
"TL" => "Timor-Leste",
"TG" => "Togo",
"TK" => "Tokelau",
"TO" => "Tonga",
"TT" => "Trinidad and Tobago",
"TN" => "Tunisia",
"TR" => "Turkey",
"TM" => "Turkmenistan",
"TC" => "Turks and Caicos Islands",
"TV" => "Tuvalu",
"UG" => "Uganda",
"UA" => "Ukraine",
"AE" => "United Arab Emirates",
"GB" => "United Kingdom",
"US" => "United States",
"UM" => "United States Minor Outlying Islands",
"UY" => "Uruguay",
"UZ" => "Uzbekistan",
"VU" => "Vanuatu",
"VE" => "Venezuela",
"VN" => "Viet Nam",
"VG" => "Virgin Islands, British",
"VI" => "Virgin Islands, U.s.",
"WF" => "Wallis and Futuna",
"EH" => "Western Sahara",
"YE" => "Yemen",
"ZM" => "Zambia",
"ZW" => "Zimbabwe"
);
	
	if(!empty($code))
	{
		if(isset($countries[$code]))
			return $countries[$code];
		else
			return '';
	}
	else
	{
		return $countries;		
	}


	}

	public static function directories()
	{
		return ['site',
				'profile-pic',
				'documents',
				'misc_docs',
				'suboperative-documents',
				'user-photos',
				'gross-status',
				'suboperative-pics',
				'zip',
				'tmp',
				'people-photos'];
	}



}


?>
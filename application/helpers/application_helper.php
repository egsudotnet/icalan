<?php
 
 
// 23-jan-13 00:00:00 
if (!function_exists('orclTimetoDate')) {

	function orclTimetoDate($date) {
		$arr = explode(' ', $date);
		$tgl = $arr[0];
		$tgl = explode('-', $tgl);
		$day = $tgl[0];
		$month = $tgl[1];
		$year = $tgl[2];

		$arrBulan = array('JAN' => '01', 'FEB' => '02', 'MAR' => '03',
			'APR' => '04', 'MAY' => '05', 'JUN' => '06', 'JUL' => '07', 'AUG' => '08',
			'SEP' => '09', 'OCT' => '10', 'NOV' => '11', 'DEC' => '12');
		return $day . "-" . $arrBulan[$month] . "-20" . $year;
	}

}

if (!function_exists('dateIndonesia')) {

	function dateIndonesia($date) {
		$arr = explode('-', $date);
		$tgl = $arr[0];
		$bulan = $arr[1];
		$tahun = $arr[2];

		$arrBulan = array('JAN' => 'Januari', 'FEB' => 'Februari', 'MAR' => 'Maret',
			'APR' => 'April', 'MAY' => 'Mei', 'JUN' => 'Juni', 'JUL' => 'Juli', 'AUG' => 'Agustus',
			'SEP' => 'September', 'OCT' => 'Oktober', 'NOV' => 'November', 'DEC' => 'Desember');
		return $tgl . "-" . $arrBulan[$bulan] . "-" . $tahun;
	}

}

//12-02-2013
if (!function_exists('dateIndonesiaLable')) {

	function dateIndonesiaLable($date) {
		$arr = explode('-', $date);
		$tgl = $arr[0];
		$bulan = $arr[1];
		$tahun = $arr[2];

		$arrBulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
			'04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
			'09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		return $tgl . " " . $arrBulan[$bulan] . " " . $tahun;
	}

}

/* membuat tanggal seperti inggris */
if (!function_exists('dateInggrisLable')) {

	function dateInggrisLable($date) {
		$arr = explode('-', $date);
		$tgl = $arr[0];
		$bulan = $arr[1];
		$tahun = $arr[2];

		$arrBulan = array('01' => 'January', '02' => 'February', '03' => 'March',
			'04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
			'09' => 'Septembr', '10' => 'October', '11' => 'November', '12' => 'December');
		return $tgl . " " . $arrBulan[$bulan] . " " . $tahun;
	}

}


if (!function_exists('getDayIndonesian')) {

	function getDayIndonesian($date) {
		$arr = explode('-', $date);
		$tgl = $arr[0];
		$bulan = $arr[1];
		$tahun = $arr[2];
		$today = date('N', strtotime($tahun . '/' . $bulan . '/' . $tgl));

		$arrHari = array(1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
		return $arrHari[$today];
	}

}

if (!function_exists('bulanIndonesia')) {

	function bulanIndonesia($bulan) {
		$bulan = intval($bulan);
		settype($bulan, 'string');
		$arrBulan = array('1' => 'Januari', '2' => 'Februari', '3' => 'Maret',
			'4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus',
			'9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		return $arrBulan[$bulan];
	}

}

if (!function_exists('arrayBulanIndonesia')) {

	function arrayBulanIndonesia($ret_print = 'return', $ret_type = 'assoc') {
		$bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
			'04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
			'09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
		$ret['array'] = array_values($bulan);
		$ret['assoc'] = $bulan;
		if ($ret_print == 'echo') {
			echo json_encode($ret[$ret_type]);
		} else {
			return $ret[$ret_type];
		}
	}

}

if (!function_exists('dateInternational')) {

	function dateInternational($date) {
		$arr = explode('-', str_replace('/', '-', $date));
		$tgl = $arr[0];
		$bulan = strtoupper($arr[1]);
		$tahun = $arr[2];

		$arrBulan = array('JANUARI' => 'JAN', 'FEBRUARI' => 'FEB', 'MARET' => 'MAR',
			'APRIL' => 'APR', 'MEI' => 'MAY', 'JUNI' => 'JUN', 'JULY' => 'JUL', 'AGUSTUS' => 'AUG',
			'SEPTEMBER' => 'SEP', 'OKTOBER' => 'OCT', 'NOVEMBER' => 'NOV', 'DESEMBER' => 'DES');

		$arrBulanAngka = array('01' => 'JAN', '02' => 'FEB', '03' => 'MAR',
			'04' => 'APR', '05' => 'MAY', '06' => 'JUN', '07' => 'JUL', '08' => 'AUG',
			'09' => 'SEP', '10' => 'OCT', '11' => 'NOV', '12' => 'DEC');

		if (substr($bulan, 0, 1) == '0' || substr($bulan, 0, 1) == '1') {
			return $tgl . "-" . $arrBulanAngka[$bulan] . "-" . substr($tahun, 2, 2);
		} else {
			return $tgl . "-" . $arrBulan[$bulan] . "-" . $tahun;
		}
	}

}
/*
 * reverse date from DD-MM-YYYY format to YYYY-MM-DD
 * 
 */
if (!function_exists('dateReverse')) {

	function dateReverse($date, $separator = '-') {
		$d = substr($date, 0, 2);
		$m = substr($date, 3, 2);
		$y = substr($date, 6, 4);

		return $y . $separator . $m . $separator . $d;
	}

}

if (!function_exists('formatUangKeDB')) {

	function formatUangKeDB($num) {
		$num = str_replace('.', '', $num);
		$num = str_replace(',', '.', $num);
		return $num;
	}

}


if (!function_exists('tglsekarang')) {

	function tglsekarang() {
		$today = date("d-m-Y");
		return $today;
	}

}

if (!function_exists('jamsekarang')) {

	function jamsekarang() {
		$jam = date("H:i:s");
		return $jam;
	}

} 
  
function buildTreeMulti(Array $data, $parent = 0) {
	$tree = array();
	foreach ($data as $d) {
		if ($d['PARENT'] == $parent) {
			$children = buildTreeMulti($data, $d['ID']);
			// set a trivial key
			if (!empty($children)) {
				$d['_CHILDREN'] = $children;
			}
			$tree[] = $d;
		}
	}
	return $tree;
}

function buildCheckboxTreeBonsaiJs(Array $data, $parent = 0) {
	$tree = array();
	foreach ($data as $d) {
		if ($d['parent'] == $parent) {
			$children = buildCheckboxTreeBonsaiJs($data, $d['value']);
			// set a trivial key
			if (!empty($children)) {
				$d['child'] = $children;
			} else {
				$d['child'] = '';
			}
			$tree[] = $d;
		}
	}
	return $tree;
}

function printTreeMulti($tree, $p = 0) {
	$return = '';
	foreach ($tree as $i => $t) {
		if (strlen($t['ID']) == 6) {
			$return .= '<li><input type="checkbox" name="' . $t['ID'] . '" class="canine" id="" /> <span>' . $t['NAME'] . ' - ' . $t['ID'] . '</span></li>';
		}
		if (isset($t['_CHILDREN'])) {
			//if ($t['PARENT'] == $p) { $return .= '<option>' . $t['NAME'] . '</option>'; }
			$return .= '<li class="parent-list" style="cursor: pointer;"><input type="checkbox" name="' . $t['ID'] . '" id="" class="canine parent" /> <span>' . $t['NAME'] . ' - ' . $t['ID'] . '</span> <i class="icon-caret-down"></i><ul>';
			$return .= printTreeMulti($t['_CHILDREN'], $t['PARENT']);
			$return .= '</ul>';
		}
	}
	return $return;
}

function buildTree(Array $data, $parent = 0) {
	$tree = array();
	foreach ($data as $d) {
		if ($d['PARENT'] == $parent) {
			$children = buildTree($data, $d['ID']);
			// set a trivial key
			if (!empty($children)) {
				$d['_CHILDREN'] = $children;
			}
			$tree[] = $d;
		}
	}
	return $tree;
}

function printTree($tree, $r = 0, $p = 0) {
	$dash = '';
	foreach ($tree as $i => $t) {
		if (strlen($t['PARENT']) == 1) {
			$dash = '';
		}
		if (strlen($t['PARENT']) == 2) {
			$dash = '&nbsp&nbsp&nbsp-&nbsp';
		}
		if (strlen($t['PARENT']) == 4) {
			$dash = '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-&nbsp';
		}
		//$dash = ($t['PARENT'] == 0) ? '&nbsp' : str_repeat('&nbsp&nbsp&nbsp-', $r) . '&nbsp&nbsp';
		//printf("\t<option value='%d'>%s%s</option>\n", $t['ID'], $dash, $t['NAME'] . ' - ' . $t['ID']);
		echo '<option value="' . $t['ID'] . '">' . $dash . $t['NAME'] . ' - ' . $t['ID'] . '</option>';
		if ($t['PARENT'] == $p) {
			// reset $r
			$r = 0;
		}
		if (isset($t['_CHILDREN'])) {
			printTree($t['_CHILDREN'], $r + 1, $t['PARENT']);
		}
	}
}
 
if (!function_exists('showDropdownListGroup')) {

	function showDropdownListGroup($groupId = '', $attribute = 'name="group" id="inputGrup"') {
		$ci = & get_instance();
		$ci->load->model('administrasi/master_model');
		$list_group = $ci->master_model->List_Group();

		if (!empty($list_group)) {
			echo '<select ' . $attribute . ' required>';
			echo '<option value="">...</option>';
			foreach ($list_group as $lg) {
				if ($lg->MG_ID == $groupId) {
					echo '<option value="' . $lg->MG_ID . '" selected=selected>' . $lg->MG_NAMEGROUP . '</option>';
				} else {
					echo '<option value="' . $lg->MG_ID . '">' . $lg->MG_NAMEGROUP . '</option>';
				}
			}
			echo '</select>';
		}
	}

}
      
if (!function_exists('treeToHTML')) {

	function treeToHTML($tree, $combined = false) {
		$ol = '<ol class="bonsai">';
		if (!empty($tree)) {
			foreach ($tree as $i => &$val) {
				$key = !is_numeric($i) ? $i : '';
				$attr = $btn = $addclass = '';
				if (!empty($val) && is_array($val)) {
					if (isset($val['id'])) {
						$attr .= ' data-id="' . $val['id'] . '"';
						unset($val['id']);
					}
					if (isset($val['nomor'])) {
						$attr .= ' data-nomor="' . $val['nomor'] . '"';
						unset($val['nomor']);
					}
					if (isset($val['tipe'])) {
						$attr .= ' data-tipe="' . $val['tipe'] . '"';
						unset($val['tipe']);
					}
					if (isset($val['kat_id'])) {
						$attr .= ' data-kat-id="' . $val['kat_id'] . '"';
						unset($val['kat_id']);
					}
					if (isset($val['url'])) {
						$attr .= ' data-url="' . $val['url'] . '"';
						unset($val['url']);
					}
					if (isset($val['status'])) {
						$attr .= ' data-status="' . $val['status'] . '"';
						unset($val['status']);
					}
					if (isset($val['click'])) {
						$attr .= ' data-click="' . $val['click'] . '"';
						unset($val['click']);
					}
					if (isset($val['title'])) {
						$attr .= ' title="' . $val['title'] . '"';
						unset($val['title']);
					}
					if (isset($val['class'])) {
						$addclass .= ' '. $val['class'];
						unset($val['class']);
					}
				}
				if (is_array($val) && count($val)) {
					if ($combined && isset($val[0]) && isset($val[0]['text'])) {
						$key = '<strong>' . $key . '</strong>';
						$ol .= '<li class="last-children ' . $addclass . '" ' . $attr . '><span class="branch">' . $key . ':&nbsp;';
						foreach ($val as $row) {
							if (!empty($row['text'])) {
								$ol .= '<span data-id="' . $row['id'] . '">' . $row['text'] . '&semi;&nbsp;</span>';
							}
						}
						$ol .= '</span></li>';
					} else if (isset($val['text'])) {
						$key = '<strong>' . $key . '</strong>';
						$ol .= '<li class="last-children ' . $addclass . '" ' . $attr . '><span class="branch">' . $key . ':&nbsp;' . $val['text'] . '</span></li>';
					} else {
						$ol .= '<li' . $attr . '><span class="branch">' . $key . '</span>' . treeToHTML($val, $combined) . '</li>';
					}
				} else if ($i == 'text') {
					$ol .= '<li class="last-children ' . $addclass . '" ' . $attr . '><span class="branch">' . $val . '</span></li>';
				} else if (empty($val) && $i !== 'id' && $i !== 'kat_id' && $i !== 'url') {
					$ol .= '<li class="last-children ' . $addclass . '" ' . $attr . '><span class="branch">' . $key . '</span></li>';
				} else if (!empty($val) && !in_array($i, array('id', 'nomor', 'tipe', 'kat_id', 'url'))) {
					if ($val == null)
						$val = '';
					$key = '<strong>' . $key . '</strong>';
					$ol .= '<li class="last-children ' . $addclass . '" ' . $attr . '><span class="branch">' . $key . ':&nbsp;' . $val . '</span></li>';
				}
			}
		}
		$ol .= '</ol>';
		return $ol;
	}

}

if (!function_exists('site_url_real')) {

	function site_url_real($uri = '') {
		$serverDomain  = 'http://';
		$serverDomain .= !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
		$serverDomain .="/";
		$ci = & get_instance();
		if ($uri == '')
		{
			return $serverDomain.$ci->config->item('index_page');
		}

		if ($ci->config->item('enable_query_strings') == FALSE)
		{
			$suffix = ($ci->config->item('url_suffix') == FALSE) ? '' : $ci->config->item('url_suffix');
			if (is_array($uri))
			{
				$uri = implode('/', $uri);
			}
			$uriString = trim($uri, '/');
			return $serverDomain.$ci->config->slash_item('index_page').$uriString.$suffix;
		}
		else
		{
			if (is_array($uri))
			{
				$i = 0;
				$str = '';
				foreach ($uri as $key => $val)
				{
					$prefix = ($i == 0) ? '' : '&';
					$str .= $prefix.$key.'='.$val;
					$i++;
				}
				$uri = $str;
			}
			return $serverDomain.$ci->config->item('index_page').'?'.$uri;
		}
	}
} 

if (!function_exists('pr')) {

	function pr($str, $die = true) {
		if ($str) {
			if (is_object($str) || is_array($str)) {
				echo "<pre>" . print_r($str, true) . "</pre>";
			} else {
				echo "<pre>$str</pre>";
			}
		}

		if ($die) {
			echo "---------------------------------------- die ----------------------------------------";
			die();
		}
	}

}

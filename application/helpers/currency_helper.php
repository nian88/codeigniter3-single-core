<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 function rupiah($uang,$rp=true){
		if ($rp==true) {
			$uang = "Rp ". number_format($uang,0,",",".");
		}else{
			$uang = number_format($uang,0,",",".");
		}
		return $uang;
	}
	function rupiah2($harga)
	{
		$a=(string)$harga; //membuat $harga menjadi string
		$len=strlen($a); //menghitung panjang string $a
	 
		if ( $len <=18 )
		{
			$ratril=$len-3-1;
			$ramil=$len-6-1;
			$rajut=$len-9-1; //untuk mengecek apakah ada nilai ratusan juta (9angka dari belakang)
			$juta=$len-12-1; //untuk mengecek apakah ada nilai jutaan (6angka belakang)
			$ribu=$len-15-1; //untuk mengecek apakah ada nilai ribuan (3angka belakang)
	 
			$angka='';
			for ($i=0;$i<$len;$i++)
			{
				if ( $i == $ratril )
				{
					$angka=$angka.$a[$i].".";
				}
				else if ($i == $ramil )
				{
					$angka=$angka.$a[$i].".";
				}
				else if ( $i == $rajut )
				{
					$angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 3angka dari depan
				}
				else if ( $i == $juta )
				{
					$angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 6angka dari depan
				}
				else if ( $i == $ribu )
				{
					$angka=$angka.$a[$i]."."; //meletakkan tanda titik setelah 9angka dari depan
				}
				else
				{
					$angka=$angka.$a[$i];
				}
			}
		}
		echo $angka.",-";
	}
	function terbilang($number)
	{
		$before_comma = trim(to_word($number));
		$after_comma = trim(comma($number));
		return ucwords($results = $before_comma . " Rupiah");
	}

	function to_word($number)
	{
		$words = "";
		$arr_number = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas");

		if($number<12)
		{
			$words = " ".$arr_number[$number];
		}
		else if($number<20)
		{
			$words = to_word($number-10)." belas";
		}
		else if($number<100)
		{
			$words = to_word($number/10)." puluh ".to_word($number%10);
		}
		else if($number<200)
		{
			$words = "seratus ".to_word($number-100);
		}
		else if($number<1000)
		{
			$words = to_word($number/100)." ratus ".to_word($number%100);
		}
		else if($number<2000)
		{
			$words = "seribu ".to_word($number-1000);
		}
		else if($number<1000000)
		{
			$words = to_word($number/1000)." ribu ".to_word($number%1000);
		}
		else if($number<1000000000)
		{
			$words = to_word($number/1000000)." juta ".to_word($number%1000000);
		}
		else if($number<1000000000000)
		{
			$words = to_word($number/1000000000)." milyar ".to_word($number%1000000000);
		}
		else
		{
			$words = "undefined";
		}
		return $words;
	}

	function comma($number)
	{
		$after_comma = stristr($number,',');
		$arr_number = array(
		"nol",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan");

		$results = "";
		$length = strlen($after_comma);
		$i = 1;
		while($i<$length)
		{
			$get = substr($after_comma,$i,1);
			$results .= " ".$arr_number[$get];
			$i++;
		}
		return $results;
	}
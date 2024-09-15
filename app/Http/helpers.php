<?php

function hello()
{
    return 'hello';
}

function birthday_day()
{
    for ($i = 1; $i <= 31; $i++) {
        $i2 = sprintf("%02d", $i); // ฟอร์แมตรูปแบบให้เป็น 00
        echo '<option value="' . $i2 . '">' . $i2 . '</option>';
    }
}

function birthday_month()
{
    $output = '';
    $output .= '
		</option><option value="01">ม.ค.</option><option value="02">ก.พ.</option><option value="03">มี.ค.</option><option value="04">เม.ย.</option><option value="05">พ.ค.</option><option value="06">มิ.ย.</option><option value="07">ก.ค.</option><option value="08">ส.ค.</option><option value="09">ก.ย.</option><option value="10">ต.ค.</option><option value="11">พ.ย.</option><option value="12">ธ.ค.</option>';
    echo $output;
}

function birthday_year()
{
    $xYear = date('Y'); // เก็บค่าปีปัจจุบันไว้ในตัวแปร
    for ($i = 0; $i <= 100; $i++) {
        echo '<option value="' . ($xYear - $i) . '">' . ($xYear - $i + 543) . '</option>';
    }
}

function formatDateThat($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute";
}

function formatDateThaiBirthday($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function createDateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function dateThai($int)
{
    $num = intval($int);
    $arr = [" ", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
    return $arr[$num];
}

function dateThaiShort($int)
{
    $num = intval($int);
    $arr = [" ", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ษ", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
    return $arr[$num];
}

function generateId()
{
    $mb = moreBytes(16);
    $unixTime = floor(time() / 1000);
    $res = $unixTime . $mb . 'ggg';
    $replace = preg_replace('/[a-zA-Z]/', '', $res);
    $get_int = gmp_intval(gmp_init($replace));
    return substr($get_int, 0, 16);
}

function moreBytes($len)
{
    $halfBytesIn35 = 7;
    $byte35 = pow(16, $halfBytesIn35);
    $bytes35 = str_pad(strval(((rand() * $byte35) | 0)), $halfBytesIn35, '0');
    $len *= 2;
    $builder = '';
    while ($len > 0) {
        $builder .= $bytes35;
        $len -= 7;
    }
    return substr($builder, 0, $len);
}

function findServiceType($type = NULL)
{
    $personnel_type = array(
        'service_unit' => 'หน่วยบริการ',
        'classroom' => 'ห้องเรียน',
        'parallel_school' => 'โรงเรียนคู่ขนาน',
        'hospital' => 'ศูนย์การเรียนสำหรับเด็กเจ็บป่วยเรื้อรัง'
    );
    if ($type) {
        return $personnel_type[$type];
    }
    return $personnel_type;
}

function findServiceImageType($type = NULL)
{
    $types = array(
        'banner' => 'รูปภาพแบนเนอร์ (1920 X 960)',
        'preview_1' => 'รูปภาพพรีวิว (630 X 460)',
        'preview_2' => 'รูปภาพพรีวิว 2 (630 X 460)',
        'general' => 'รูปภาพทั่วไป'
    );
    if ($type) {
        return $types[$type];
    }
    return $types;
}

?>
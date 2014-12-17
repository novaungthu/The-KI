<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Notification Bar error, success and warning Via Plus Strap UI
 * @reference By Ko Nay Htet Aung
 * @update to bootstrap 3
 */
if (!function_exists("notificationBar")) {

    function notificationBar($alert = array()) {
        if (isset($alert) && !empty($alert)) {
            $alert['class'] = !isset($alert['class']) || empty($alert['class']) ? 'error' : $alert['class'];
            switch ($alert['class']) {
                case 'success':
                    $class = 'alert-success';
                    break;
                case 'warning':
                    $class = 'alert-warning';
                    break;
                default:
                    $class = 'alert-danger';
                    break;
            }
            echo <<< HTML
            <div class="alert {$class} alert-dismissable" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{$alert['text']}</p>
           </div>
HTML;
        }
    }

}
if (!function_exists("char_limitter")) {

    function char_limitter($text = "", $size = 20) {
        if (empty($text) || strlen($text) < $size) {
            return $text;
        }
        $CI = &get_instance();
        $CI->load->helper('text');
        return character_limiter($text, $size);
    }

}
if (!function_exists("createStoreTypeString")) {

    function createStoreTypeString($store_type = "", $short_length = false) {
        if (empty($store_type)) {
            return "";
        }
        $store_type = explode(",", $store_type);
        $store_type_conts = json_decode(STORE_TYPE, TRUE);
        $storeListing = "";
        foreach ($store_type as $type) {
            $storeListing .=!empty($storeListing) ? ", " . $store_type_conts[$type] : $store_type_conts[$type];
        }
        if (strlen($storeListing) > 20 && $short_length) {
            $CI = &get_instance();
            $CI->load->helper("text");
            return ellipsize($storeListing, 20);
        }
        return $storeListing;
    }

}
if (!function_exists("generateWebsite")) {

    function generateWebsite($url = "") {
        if (empty($url))
            return "";
        $href = (strpos($url, "http://") === 0) || (strpos($url, "https://") === 0) || (strpos($url, "www.")) ? $url : "http://" . $url;
        if (strlen($url) > 15) {
            $CI = &get_instance();
            $CI->load->helper("text");
            $url = ellipsize($url, 15);
        }
        return "<a href='{$href}' target='_blank'>{$url}</a>";
    }

}


/*
 * PHP-Convert a timestamp into facebook post time representation
 * ref : http://itfeast.blogspot.in/2013/08/php-convert-timestamp-into-facebook.html
 * @param : creted : d-m-Y H:i:s
 */
if (!function_exists('faceBookTimeStamp')) {

    function faceBookTimeStamp($created) {
        if (empty($created))
            return "";
        $today = time();
        $createdday = strtotime($created); //mysql timestamp of when post was created  
        $datediff = abs($today - $createdday);
        $difftext = "";
        $years = floor($datediff / (365 * 60 * 60 * 24));
        $months = floor(($datediff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($datediff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor($datediff / 3600);
        $minutes = floor($datediff / 60);
        $seconds = floor($datediff);
//year checker  
        if ($difftext == "") {
            if ($years > 1)
                $difftext = $years . " years ago";
            elseif ($years == 1)
                $difftext = $years . " year ago";
        }
//month checker  
        if ($difftext == "") {
            if ($months > 1)
                $difftext = $months . " months ago";
            elseif ($months == 1)
                $difftext = $months . " month ago";
        }
//month checker  
        if ($difftext == "") {
            if ($days > 1)
                $difftext = $days . " days ago";
            elseif ($days == 1)
                $difftext = $days . " day ago";
        }
//hour checker  
        if ($difftext == "") {
            if ($hours > 1)
                $difftext = $hours . " hours ago";
            elseif ($hours == 1)
                $difftext = $hours . " hour ago";
        }
//minutes checker  
        if ($difftext == "") {
            if ($minutes > 1)
                $difftext = $minutes . " minutes ago";
            elseif ($minutes == 1)
                $difftext = $minutes . " minute ago";
        }
//seconds checker  
        if ($difftext == "") {
            if ($seconds > 1)
                $difftext = $seconds . " seconds ago";
            elseif ($seconds == 1)
                $difftext = $seconds . " second ago";
        }
        return $difftext;
    }

}
if (!function_exists('getPhotoLibrary')) {

    function getPhotoLibrary($image_crud) {
        $image_crud->set_primary_key_field('id');
        $image_crud->set_url_field('url');
        $image_crud->set_title_field('title');
        $image_crud->set_table('shop_photos')
                ->set_relation_field('shop_id')
                ->set_ordering_field('order')
                ->set_image_path("uploads" . "/" . date('Y') . "/" . date('m'));
        return $image_crud->render();
    }

}
if (!function_exists('showShopSchedule')) {

    function showShopSchedule($schedule) {
        $html = '<ul>';
        foreach ($schedule as $row) {
            switch ($row['schedule_type']) {
                case DATE_RANGE:
                    break;
                case ALL_DAY:
                case EACH_DAY:
                    $text = str_replace(",", " - ", $row["day_arrange"]) . " " . date("H:i", strtotime($row["start_time"])) . ((!empty($row['end_time'])) ? ' - ' . date('H:i', strtotime($row['end_time'])) : "");
                    break;
                case SP_DATE:
                    break;
            }
            $html = '<li>'
                    . $text
                    . '<span class="pull-right"><a href="" class="text-danger"><i class="fa fa-yelp"></i>Delete</a></span>'
                    . '</li>';

            echo $html;
        }
        $html = "</ul>";
        echo $html;
    }

}
if (!function_exists("showShpCategorySize")) {

    function showShopCategorySize($category) {
        $html = "";
        if(stripos($category['name'], 'lingerie') !== FALSE || stripos($category['name'], 'jewellery') !== FALSE ||stripos($category['name'], 'shoe') !== FALSE) {
            $html = '<span class="col-sm-3">Size: </span>' .$category['start_size'].'</span>'
                  . '<br /><span class="col-sm-offset-3">'.$category['other_size'].'</span>';

        } else {
            // Others are clothes
            $html = '<span class="col-sm-3">Size: </span>' .$category['start_size']." - ".$category['end_size']
                  . '<br /><span class="col-sm-offset-3">'.$category['petite'].'</span>';


        }
        echo $html;
        
    }

}
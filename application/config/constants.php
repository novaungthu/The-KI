<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */


/**
 * Custom Constant
 */
define("SITE_NAME", "The Ki");
define('EMAIL_CONTACT_ADDRESS', 'sithuaung@revotech.co');
define('EMAIL_CONTACT_NAME', 'Sithu@Revotech');

define('EMAIL_INFO_ADDRESS', 'novaungthu@gmail.com');
define('EMAIL_INFO_NAME', 'Me@Sithu');

define('EMAIL_SUBJECT_ACTIVATION_SENT', 'Ki : Activate your account');
define('EMAIL_SUBJECT_WELCOME', 'Welcome to Ki ');
define('EMAIL_SUBJECT_RESET_PASSWD_SENT', 'Ki : Reset Password');

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
define('SALT', 'abcdefghijklmnopqrstuvwxyz0123456789');
define("ADMIN", 1001);
define("SHOP_OWNER", 1002);

define("ACTIVE", 1);
define("INACTIVE", 2);
define("PENDING", 3);

define("YES", 1);
define("NO", 0);
// Store Types

define("BOUTIQUE", 100);
define("CATALOGUE", 200);
define("CHAIN", 300);
define("CONCESSION", 400);
define("D_STORE", 500);
define("TAILOR", 600);
define("STORE_TYPE", json_encode(
        array(BOUTIQUE => "Boutique" , CATALOGUE => "Catalogue", CHAIN => "Chain", CONCESSION => "Concession",
            D_STORE => "Department Store" , TAILOR => "Tailor")
));
// DAYS
define("MONDAY", "Monday");
define("TUESDAY", "Tuesday");
define("WEDNESDAY", "Wednesday");
define("THURSDAY", "Thursday");
define("FRIDAY", "Friday");
define("SATURDAY", "Saturday");
define("SUNDAY", "Sunday");

define("DATE_RANGE", 10);
define("ALL_DAY", 11);
define("EACH_DAY", 12);
define("SP_DATE", 13);

define("DAYS", json_encode(
                array(MONDAY => "Monday", TUESDAY => "Tuesday", WEDNESDAY => "Wednesday", THURSDAY => "Thursday", FRIDAY => "Friday", SATURDAY => "Saturday", SUNDAY => "Sunday")
));
// pagination config
define("RECORDS_PER_PAGE", 5);

// Review , Service , type
define("SHOP_REVIEW", 101);
define("SHOP_SERVICE", 102);
define("CATEGORY_REVIEW", 103);

define("REFER_CATEGORY", 10);
define("REFER_SHOP", 20);

// Price Point
// All except for wedding dress, lingerie and shoes:
define("UNDER_50", 1);
define("UNDER_100", 2);
define("OVER_100", 3);
define("PRICE_RANGE", json_encode(
        array(UNDER_50 => "Under 50", UNDER_100 => "Under 100", OVER_100 => "Over 100")
));

// Style list
define("STYLE", json_encode(
                array("Bohemian", "Casual", "Elegance", "Fashion Forward", "Glamorous", "Goth", "Trendy", "Vintage")
));
define("NOT_CLOTH", json_encode(array("jewellery", "lingerie", "shoes")));
// CLOTH TYPE
define("CLOTH_TYPE", json_encode(
                array("Bride", "Bridesmaid", "Designer", "Evening", "Evening Wardrobe", "Fancy Dress", "Hosiery", "Jewellery", "Intimates/Lingerie",
                    "Made to Order", "Maternity", "Occasion Wear", "Other", "Prom", "Shapewear", "Shoes", "Sports", "Swimwear", "Wholesaler")
));
// Result for all clothes type option except for: Jewellery , Lingerie, Shoes
define("CLOTH_SIZE", json_encode(
                range("18", "48", 2)
));
define("CLOTH_SIZE_2", json_encode(array(
    "Petite" , "Tall"
)));
// Lingerie Size
define("LINGERIE_SIZE_1", json_encode(
                range("28", "58", 2)
));
define("LINGERIE_SIZE_2", json_encode(array(
    "AA", "A", "B", "C", "D", "DD", "E", "F", "FF", "G", "GG", "H", "HH", "J", "JJ", "K", "KK", "L", "M", "N"
)));
// Shoe Size
define("SHOE_SIZE_1", json_encode(range("3", "17")));
define("SHOE_SIZE_2", json_encode(
                array("D", "E", "EE", "EEE", "EEEE", "EEEEE", "EEEEEE")
));
// Jewellery Size
define("JEWELLERY_SIZE", json_encode(
                array("P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "Z1", "Z2", "Z3", "Z4")
));
// Maximum Shop's PHOTO
define("MAX_PHOTO", 5);


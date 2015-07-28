<?php
ob_start();
session_start();

if( !defined( "__APP_PATH__" ) )
define( "__APP_PATH__", realpath( dirname( __FILE__ ) . "/" ) );
// require_once( __APP_PATH__ . "/inc/constants.php" ); 
  
//Code to convert from .svg to .png by jSon array
$result = '{
      "274:130":"000",
      "274:129":"000",
      "274:128":"000",
      "274:127":"000",
      "274:126":"000",
      "274:125":"000"
    }'; 
$data = json_decode($result, true);
do_graph("Equipment Count", 600, $data);

function do_graph($title, $width, $items) 
{
    $border = 50;             // border space around bars
    $caption_gap = 4;         // space between bar and its caption
    $bar_width = 20;          // width of each bar
    $bar_gap = 40;            // space between each bar
    $title_font_id = 5;       // font id for the main title
    $bar_caption_font_id = 5; // font id for each bar's title

    // Image height depends on the number of items
    $height = (2 * $border) + (count($items) * $bar_width) +
        ((count($items) - 1) * $bar_gap);

    // Find the horizontal distance unit for one item
    $unit = ($width - (2 * $border)) / max($items);

    // Create the image and add the title
    // $im = ImageCreate($width, $height);
    // if (!$im) {
    //     trigger_error("Cannot create image<br>\n", E_USER_ERROR);
    // }
    // $background_col = ImageColorAllocate($im, 255, 255, 255); // white
    // $bar_col = ImageColorAllocate($im, 0, 64, 128);           // blue
    // $letter_col = ImageColorAllocate($im, 0, 0, 0);           // black
    // ImageFilledRectangle($im, 0, 0, $width, $height, $background_col);
    // ImageString($im, $title_font_id, $border, 4, $title, $letter_col);

    // // Draw each bar and add a caption
    // $start_y = $border;
    // foreach ($items as $caption => $value) {
    //     $end_x = $border + ($value * $unit);
    //     $end_y = $start_y + $bar_width;
    //     ImageFilledRectangle($im, $border, $start_y, $end_x, $end_y, $bar_col);
    //     ImageString($im, $bar_caption_font_id, $border,
    //         $start_y + $bar_width + $caption_gap, $caption, $letter_col);
    //     $start_y = $start_y + ($bar_width + $bar_gap);
    // }

    // // Output the complete image.
    // // Any text, error message or even white space that appears before this
    // // (including any white space before the "<?php" tag) will corrupt the
    // // image data.  Comment out the "header" line to debug any issues.
    // header("Content-type: image/jpg");
    // ImageJpeg($im,__APP_PATH__.'/test.jpg');
    // ImageDestroy($im);
}


//Code to convert from .svg to .png by Image array
$fn2 = 'test.svg'; 
 
$im = new Imagick();
$svg = file_get_contents($usmap);
  
try
{
    
$im->readImageBlob($svg);

/*png settings*/
$im->setImageFormat("png24");
$im->resizeImage(720, 445, imagick::FILTER_LANCZOS, 1);  /*Optional, if you need to resize*/

/*jpeg*/
$im->setImageFormat("jpeg");
$im->adaptiveResizeImage(720, 445); /*Optional, if you need to resize*/

$im->writeImage(__APP_PATH__.'/js/testings.png');/*(or .jpg)*/
$im->clear();
$im->destroy();

} catch (Exception $ex) {
print_R($ex);
} 
?>



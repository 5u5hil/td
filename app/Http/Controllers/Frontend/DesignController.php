<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Session;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\SavedList;
use App\Models\User;
use Auth;

class DesignController extends Controller {

    public function index($slug) {


        $category = Category::findBySlug($slug);

        $sizes = array_flatten(Attribute::where("attr", "Shoe Size")->first()->attributeoptions()->select('option_name')->get()->toArray());

        $parts = scandir(public_path() . "/Frontend/shoes/" . $category->folder);
        $parts = array_diff($parts, array('.', '..'));
        
        $savedList = User::find(Session::get('user')->id)->savedlist;
        //print_r($savedList);
        return view(Config('constants.frontView') . '.design', compact('category', 'parts', 'sizes', 'savedList'));
    }

    public function getTextures() {
        $parts = scandir(public_path() . "/Frontend/shoes/" . $_REQUEST['shoe'] . "/" . $_REQUEST['part'] . "/textures");
        $parts = array_diff($parts, array('.', '..'));

        foreach ($parts as $key => $value) {
            echo "<ul class='colorpalatte'>";

            if (is_dir(public_path() . "/Frontend/shoes/" . $_REQUEST['shoe'] . "/" . $_REQUEST['part'] . "/textures/" . $value)) {
                echo "<li class='clearfix'>$value</li><br />";
                $ts = scandir(public_path() . "/Frontend/shoes/" . $_REQUEST['shoe'] . "/" . $_REQUEST['part'] . "/textures/" . $value);
                $ts = array_diff($ts, array('.', '..'));

                foreach ($ts as $k => $v) {
                    ?>
                    <li><a href="javascript:void(0);" style="width: 50px;display: block;height: 50px;background:url('<?= asset("public/Frontend/shoes/" . $_REQUEST['shoe'] . "/" . $_REQUEST['part'] . "/textures/$value/$v"); ?>')" onclick="change('<?= $_REQUEST['shoe'] ?>', '<?= $_REQUEST['part'] ?>', '<?= $value ?>', '<?= strtolower(str_replace(" ", "-", $value)) . "-" . basename($v, ".png"); ?>')" title="<?= ucwords(strtolower(basename($v, ".png"))); ?>"></a></li>
                    <?php
                }
            } else {
                ?> <li><a href="javascript:void(0);" style="width: 50px;display: block;height: 50px;background:url('<?= asset("public/Frontend/shoes/" . $_REQUEST['shoe'] . "/" . $_REQUEST['part'] . "/textures/$value"); ?>')" onclick="change('<?= $_REQUEST['shoe'] ?>', '<?= $_REQUEST['part'] ?>', '', '<?= basename($value, ".png"); ?>')" title="<?= ucwords(strtolower(basename($value, ".png"))); ?>"></a></li> <?php
            }
            echo "</ul>";
        }
    }

    public function construct() {
        $bpath = public_path() . "/Frontend/shoes/" . $_REQUEST['shoe'];
        $sole = $bpath . "/sole";
        $insole = $bpath . "/insole";
        $toesole = $bpath . "/toesole";
        $upper = $bpath . "/upper";
        $angle = $_REQUEST['angle'];
        $default = 'default';


        $spec = @$_REQUEST['spec'];
        $specSole = @$spec['sole'];
        $specInsole = @$spec['insole'];
        $specToesole = @$spec['toesole'];
        $specUpper = @$spec['upper'];
        $specUpperBack = isset($spec['upperback']) ? $spec['upperback'] : "closed";
        $specUpperToe = isset($spec['uppertoe']) ? $spec['uppertoe'] : "round";


        if (!isset($spec)) {

            $width = 660;
            $height = 540;

            $layers = array();

            //Sole
            if (is_file($sole . "/$default-$angle.png")) {
                $layers[] = imagecreatefrompng($sole . "/$default-$angle.png");
            }
            //Insole
            if (is_file($insole . "/$default-$angle.png")) {
                $layers[] = imagecreatefrompng($insole . "/$default-$angle.png");
            }
            //Toesole
            if (is_file($toesole . "/$default-$angle.png")) {
                $layers[] = imagecreatefrompng($toesole . "/$default-$angle.png");
            }

            //Upper
            if (is_file($upper . "/$specUpperBack-$specUpperToe/$default-$angle.png")) {
                $layers[] = imagecreatefrompng($upper . "/$specUpperBack-$specUpperToe/$default-$angle.png");
            }

            $image = imagecreatetruecolor($width, $height);


            imagealphablending($image, false);
            $transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
            imagefill($image, 0, 0, $transparency);
            imagesavealpha($image, true);

            imagealphablending($image, true);
            for ($i = 0; $i < count($layers); $i++) {
                imagecopy($image, $layers[$i], 0, 0, 0, 0, $width, $height);
            }
            imagealphablending($image, false);
            imagesavealpha($image, true);
            header('Content-Type: image/png');

            imagepng($image);
        } else {


            $width = 660;
            $height = 540;
            $layers = array();

            //Sole
            if ($specSole) {
                if (is_file($sole . "/$specSole-$angle.png")) {
                    $layers[] = imagecreatefrompng($sole . "/$specSole-$angle.png");
                }
            } else {
                if (is_file($sole . "/$default-$angle.png")) {
                    $layers[] = imagecreatefrompng($sole . "/$default-$angle.png");
                }
            }
            //Insole
            if ($specInsole) {
                if (is_file($insole . "/$specInsole-$angle.png")) {
                    $layers[] = imagecreatefrompng($insole . "/$specInsole-$angle.png");
                }
            } else {
                if (is_file($insole . "/$default-$angle.png")) {
                    $layers[] = imagecreatefrompng($insole . "/$default-$angle.png");
                }
            }
            //Toesole
            if ($specToesole) {
                if (is_file($toesole . "/$specToesole-$angle.png")) {
                    $layers[] = imagecreatefrompng($toesole . "/$specToesole-$angle.png");
                }
            } else {
                if (is_file($toesole . "/$default-$angle.png")) {
                    $layers[] = imagecreatefrompng($toesole . "/$default-$angle.png");
                }
            }

            //Upper
            if ($specUpper) {
                if (is_file($upper . "/$specUpperBack-$specUpperToe/$specUpper-$angle.png")) {
                    $layers[] = imagecreatefrompng($upper . "/$specUpperBack-$specUpperToe/$specUpper-$angle.png");
                }
            } else {
                if (is_file($upper . "/$specUpperBack-$specUpperToe/$default-$angle.png")) {
                    $layers[] = imagecreatefrompng($upper . "/$specUpperBack-$specUpperToe/$default-$angle.png");
                }
            }




            $image = imagecreatetruecolor($width, $height);


            imagealphablending($image, false);
            $transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
            imagefill($image, 0, 0, $transparency);
            imagesavealpha($image, true);

            imagealphablending($image, true);
            for ($i = 0; $i < count($layers); $i++) {
                imagecopy($image, $layers[$i], 0, 0, 0, 0, $width, $height);
            }
            imagealphablending($image, false);
            imagesavealpha($image, true);
            header('Content-Type: image/png');

            imagepng($image);
        }
    }

}

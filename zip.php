<?php
if(isset($_POST['unique-id'])){
    $file_id = str_replace(' ', '_', strtolower(preg_replace("/[^a-zA-Z_0-9 ]/", '',$_POST['unique-id'])));
}else{
    $file_id = 'unnamed';
}
$language = $_POST['language'];

$folder = $file_id."-".date('Ymdgis');
    //Create directory
mkdir($folder);
mkdir($folder.'/gfx');
mkdir($folder.'/gfx/interface');
mkdir($folder.'/gfx/interface/decisions');
mkdir($folder.'/interface');
mkdir($folder.'/common');
mkdir($folder.'/common/decision');
mkdir($folder.'/localisation');


$file_contents = '';
$lang_file_contents = 'l_'.$language.":\r\n";
$customGFX = "spriteTypes = { \r\n";

function checkImage($img, $id){
    if(strpos($img,"data:image/png;") !== false){
        $image = base64_decode(str_replace("data:image/png;base64,","",$img));
        file_put_contents($folder.'/gfx/interface/decisions/'.$id.'.png',$image);
        $img = new Imagick($folder.'/gfx/interface/decisions/'.$id.'.png'); //Load the uploaded image
        $img->setformat('tga'); //Set the format to tga
        $img->writeimage($folder.'/gfx/interface/decisions/GFX_'.$id.'.tga'); //Write/save the dds texture
        $icon = 'GFX_'.$id;
        $customGFX .= '##Icon For: '.$id.' \r\n SpriteType = { \r\n name = "'.$icon.'" \r\n texturefile = "gfx/interface/decisions/'.$icon.'.tga" \r\n }';
    }else{
        return $img;
    }

}

foreach($_POST['category'] as $category){
    $category_title = $category['title'];
    $category_id = strtolower(preg_replace("/[^a-zA-Z_0-9 ]/", '', $category_title));
    $category_image = checkImage($category['img'], $category_id);

    $lang_file_contents .= $category_id.':0 "'.$category_title.'"'."\r\n";

    if(!empty($category['catimg']) && !empty($category['catdesc'])){
        $category_desc_img = $category['catimg'];
        $category_desc = $category['catdesc'];
        $lang_file_contents .= $category_id.'_desc:0 "'.$category_desc.'"'."\r\n";
    }

    $file_contents .= $category_id." = {\r\n";

        foreach($category['decisions'] as $id => $decision){
            $decision_id = $id;
            $decision_title = $decision['name'];
            $decision_desc = $decision['desc'];
            $decision_image = checkImage($decision['img'], $decision_id);

            $lang_file_contents .= $decision_id.':0 "'.$decision_title.'"'."\r\n";
            $lang_file_contents .= $decision_id.'_desc:0 "'.$decision_desc.'"'."\r\n";
            
            $file_contents .= $decision_id." = {\r\n";

                $file_contents .= "icon = ".$decision_image."\r\n";

                $json = json_decode($decision['json']);
                $n = 0;

                $to_ignore = array('decision_description');

                $does_not_use_braces = array('cost','fire_only_once','days_remove', 'days_re_enable');
                foreach($json as $name => $value){
                    if(!in_array($name, $to_ignore)){
                        if(in_array($name, $does_not_use_braces)){
                            if($name == 'days_re_enable'){
                                if($json->fire_once !== 'yes'){
                                    if(!empty($value)){
                                        $file_contents .= $name.' = '.$value."\r\n";
                                    }
                                }
                            }else{
                                if(!empty($value)){
                                    $file_contents .= $name.' = '.$value."\r\n";
                                }
                            }
                        }else{
                            if(!empty($value)){
                                $file_contents .= $name." = {\r\n".$value."\r\n}";
                            }
                        }
                    }
                }
            $file_contents .= '}';
        }


    $file_contents .= '}';

}


$decisionfile = './'.$folder.'/common/decision/'.$file_id.".txt";
if (file_put_contents($decisionfile, $file_contents) !== false) {
    echo "File created (" . basename($focustreefile) . ")";
} else {
    echo "Cannot create file (" . basename($focustreefile) . ")";
}

$langfile = './'.$folder.'/localisation/'.$file_id."_l_".$lan.".yml";
$langfilecontent = chr(239) . chr(187) . chr(191) .$lang_file_contents;
if (file_put_contents($langfile, $langfilecontent) !== false) {
    echo "File created (" . basename($langfile) . ")";
} else {
    echo "Cannot create file (" . basename($langfile) . ")";
}

$customGFX .= " \r\n }";
$customgfxfile = $folder.'/interface/customicons-'.$file_id.'.gfx';
if (file_put_contents($customgfxfile, $customGFX) !== false) {
    echo "File created (" . basename($customgfxfile) . ")";
} else {
    echo "Cannot create file (" . basename($customgfxfile) . ")";
}


$zip_file_name = $file_id.'.zip';
$download_file = true;
//$delete_file_after_download= true; doesnt work!!
class FlxZipArchive extends ZipArchive{
    /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/
    public function addDir($location, $name){
        $this->addEmptyDir($name);
        $this->addDirDo($location, $name);
     } // EO addDir;
    /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann
     * @access private   **/
    private function addDirDo($location, $name){
        $name .= '/';
        $location .= '/';
        // Read all Files in Dir
        $dir = opendir ($location);
        while ($file = readdir($dir))
        {
            if ($file == '.' || $file == '..') continue;
            // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    } // EO addDirDo();
}
$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);
if($res === TRUE) {
    $za->addDir($folder, basename($folder));
    $za->close();
}
else  { echo 'Could not create a zip archive';}

if ($download_file){
    ob_get_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=" . basename($zip_file_name) . ";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . filesize($zip_file_name));
    readfile($zip_file_name);

    //deletes file when its done...
    //if ($delete_file_after_download) 
    //{ unlink($zip_file_name); }
}

//Delete directory
$dir = $folder;
unlink($zip_file_name);
array_map('unlink', glob("$folder/gfx/interface/decisions/*.*"));
array_map('unlink', glob("$folder/gfx/interface/*.*"));
array_map('unlink', glob("$folder/gfx/*.*"));
array_map('unlink', glob("$folder/common/decision/*.*"));
array_map('unlink', glob("$folder/common/*.*"));
array_map('unlink', glob("$folder/localisation/*.*"));
array_map('unlink', glob("$folder/interface/*.*"));
array_map('unlink', glob("$folder/*.*"));
rmdir($folder.'/common/decision');
rmdir($folder.'/common');
rmdir($folder.'/localisation');
rmdir($folder.'/gfx/interface/decisions');
rmdir($folder.'/gfx/interface');
rmdir($folder.'/gfx');
rmdir($folder.'/interface');
rmdir($folder);
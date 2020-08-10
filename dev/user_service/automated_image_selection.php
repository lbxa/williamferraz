<?php
/*
**  Automated Image Selection Service
**
**  Encapsulating all sevices based on automated image selection across the
**  entire website. Dependencies are minimized. Below algorithms will handle
**  all services related to the display of images to users. Based of responsive
**  design ensuring websites remians dynamic.
**
**  REQUIREMENTS:
**    - Needs to be prepended with an include to the SQL connection
**      (GLOBAL $database_connection)
**
**  Lucas Barbosa [17/05/2019] | All Rights Reserved (R)
*/

class Image_Controller {
    public function __construct($img_container = NULL) {
        self::$image_controller_inst++;
        $this->img_container = $img_container;
    }

    public function __destruct() {
        self::$image_controller_inst--;
    }

    public function set_img_container($img_container) {
        $this->img_container = $img_container;
    }

    public function get_img_container() {
        if (isset($this->img_container)) {
            return $this->img_container;
        } else {
            return false;
        }
    }

    public function set_broken_img_placeholder($broken_img_placeholder) {
        $this->broken_img_placeholder = $broken_img_placeholder;
    }

    public function get_img_count() {
        $img_count = 0;
        if ($img_handler = opendir($this->img_container)) {
            while (($img_entry = readdir($img_handler)) != false) {
                if (($img_entry != ".") && ($img_entry != "..") && ($img_entry != ".DS_store")) {
                    $img_count++;
                }
            }
        }
        closedir($img_handler);
        return $img_count;
    }

    public function format_img($img_file, $img_description) {
        $img_output = '<div class="card img-card">';
        $img_output .= '<img class="card-img-top" src="' . $img_file . '" alt="Card Image">';
        $img_output .= '<div class="card-body">';
        $img_output .= '<p class="card-text">' . $img_description . '</p>';
        $img_output .= '</div>';
        $img_output .= '</div>';

        return $img_output;
    }

    public function select_single($format_img = false) {
        $img_file_extensions = "*.{jpg,jpeg,png,gif}";
        $img_repo_arr = glob($this->img_container . $img_file_extensions, GLOB_BRACE);
        if (count($img_repo_arr) < 1) {
            if ($format_img == true) {
                return '<img src="' . $this->broken_img_placeholder . '" alt="Display Image" class="img-responsive img-fluid"/>';
            }
            return $this->broken_img_placeholder;
        }
        $rand_img = $img_repo_arr[array_rand($img_repo_arr)];
        // trim off "../" at beginning of file name
        $rand_img = ltrim(ltrim($rand_img, "."), "/");
        if ($format_img == true) {
            return '<img src="' . $rand_img . '" alt="Display Image" class="img-responsive img-fluid"/>';
        } else {
            return $rand_img;
        }
    }

    public function list_all($html_display = true) {
        $img_arr = array();
        $counter = 0;
        if ($img_handler = opendir($this->img_container)) {
            while (($img_entry = readdir($img_handler)) != false) {
                if (($img_entry != ".") && ($img_entry != "..") && ($img_entry != ".DS_Store")) {
                    // image file name will be used to search for the img description later
                    $curr_img = new Image();
                    $img_data = $curr_img->search($img_entry);

                    // maintain the right directory for all the photos
                    $img_entry = $this->img_container . $img_entry;
                    $img_desc = $img_data["img_description"];
                    $img_arr[$counter] = $this->format_img($img_entry, $img_desc);

                    if ($html_display == true) {
                        echo $this->format_img($img_entry, $img_desc);
                    }
                    $counter++;
                }
            }
        }
        closedir($img_handler);
        return $img_arr;
    }

    // intended for temporary use (3 column display)
    public function list_col_3x() {
        $all_imgs = $this->list_all(false);
        // return array of array: [[img,img,img,...], [img,img,img,...], [img,img,img,...]]
        // divide total number of imgs by 3 and round up + extra to last array/column
        // express the above divide with "#" partitions -> acting as EOLs
        $img_count = $this->get_img_count();
        $col_count = $img_count / 3;
        $img_offset = $img_count % 3;
        $partition = "#";

        // BUG: display breaks with just one or two images. Only works for 3+ images
        if ($img_offset > 0) {
            array_splice($all_imgs, ($col_count*1), 0, $partition);
            // add 2 extra photos to last 2 columns
            array_splice($all_imgs, ($col_count*2) + 1, 0, $partition);
            // add extra photo to last column
            array_splice($all_imgs, ($col_count*3) + 3, 0, $partition);
        } else {
            array_splice($all_imgs, ($col_count*1), 0, $partition);
            array_splice($all_imgs, ($col_count*2) + 1, 0, $partition);
            array_splice($all_imgs, ($col_count*3) + 2, 0, $partition);
        }

        return $all_imgs;
    }


    private static $image_controller_inst;
    protected $img_container;
    protected $broken_img_placeholder = "misc/broken_image_icon.gif";
}

?>

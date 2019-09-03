<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuItemModel extends Model
{
    public $table = 'menu_items';

    public function getFibonacyRecursive()
    {

    }


    public static function outputLevelCategories($input_categories, &$output_categories, $parent_id = 0, $lvl = 1)
    {

        if (count($input_categories) > 0) {
            foreach ($input_categories as $key => $category) {
                $category = (array)$category;
                if ($category['parent_id'] == $parent_id) {
                    $category['level'] = $lvl;
                    $output_categories[] = (array)$category;
                    unset($input_categories[$key]);

                    $new_parent_id = $category['id'];
                    $new_level = $lvl + 1;
                    self::outputLevelCategories($input_categories, $output_categories, $new_parent_id, $new_level);
                }
            }
        }


    }

    public static function outputLevelCategoriesExcept($input_categories, &$output_categories, $parent_id = 0, $lvl = 1, $except)
    {

        if (count($input_categories) > 0) {
            foreach ($input_categories as $key => $category) {
                if ($category['parent_id'] == $parent_id) {
                    $category['level'] = $lvl;
                    if ($category['id'] != $except) {
                        $output_categories[] = (array)$category;
                    }
                    unset($input_categories[$key]);


                    if ($category['id'] != $except) {
                        $new_parent_id = $category['id'];
                        $new_level = $lvl + 1;
                        self::outputLevelCategoriesExcept($input_categories, $output_categories, $new_parent_id, $new_level, $except);
                    }
                }
            }
        }


    }


    public static function getMenuItemRecursiveExcept($except)
    {
        $result = array();
        $source = MenuItemModel::all()->toArray();

        self::outputLevelCategoriesExcept($source, $result, 0, 1, $except);

        return $result;
    }

    public static function getMenuItemRecursive()
    {
        $result = array();
        $source = MenuItemModel::all()->toArray();

        self::outputLevelCategories($source, $result);

        return $result;
    }

    public static function getTypeOfMenuItem()
    {

        $types = array();
        $types[1] = 'Shop category';
        $types[2] = 'Shop product';
        $types[3] = 'Content category';
        $types[4] = 'Content post';
        $types[5] = 'Content page';
        $types[6] = 'Content tag';
        $types[7] = 'Custom Link';

        return $types;

    }

    public static function getMenuItemsByHeader()
    {
        $menu_header = DB::table('menu')->where('location', '1')->first();
        if (isset($menu_header->id)) {
            $source = DB::table('menu_items')->where('menu_id', $menu_header->id)->orderBy('sort', 'ASC')->get();
            $result = array();

            self::outputLevelCategories($source, $result);

            return $result;
        } else {
            $result = array();
        }

        return $result;
    }

    public static function getMenuItemsByFooter1()
    {
        $menu_footer1 = DB::table('menu')->where('location', '2')->first();
        if (isset($menu_footer1->id)) {
            $menu_items_footer1 = DB::table('menu_items')->where('menu_id', $menu_footer1->id)->get();
            $footer1 = array();
            self::outputLevelCategories($menu_items_footer1, $footer1);

            return $footer1;
        } else {
            $footer1 = array();
        }
        return $footer1;

    }

    public static function getMenuItemsByFooter2()
    {
        $menu_footer2 = DB::table('menu')->where('location', '3')->first();
        if (isset($menu_footer2->id)) {
            $menu_items_footer2 = DB::table('menu_items')->where('menu_id', $menu_footer2->id)->get();

            $footer2 = array();

            self::outputLevelCategories($menu_items_footer2, $footer2);


            return $footer2;
        } else {
            $footer2 = array();
        }

        return $footer2;
    }

    public static function getMenuItemsByFooter3()
    {
        $menu_footer3 = DB::table('menu')->where('location', '3')->first();

        if (isset($menu_footer3->id)) {
            $menu_items_footer3 = DB::table('menu_items')->where('menu_id', $menu_footer3->id)->get();

            $footer3 = array();

            self::outputLevelCategories($menu_items_footer3, $footer3);


            return $footer3;

        } else {
            $footer3 = array();
        }


        return $footer3;
    }


    public static function buildMenuHTML($input_categories, &$html, $parent_id = 0, $lvl = 1)
    {
        if (count($input_categories) > 0) {
            if ($lvl == 1) {
                $html .= "<ul class='nav navbar-nav'>";
            } elseif ($lvl == 2) {
                $html .= "<ul class=\"dropdown-menu multi\">
                                <div class=\"row\">
                                    <div class=\"col-sm-4\">
                                        <ul class=\"multi-column-dropdown\">";
            } else {
                //Không hiện
            }

            foreach ($input_categories as $key => $category) {
                if ($category['parent_id'] == $parent_id) {
                    $category['level'] = $lvl;
                    if ($category['type'] == 7) {
                        $menu_link = $category['link'];
                    } else {
                        $menu_link = url($category['link']);
                    }
                    if ($lvl == 1) {
                        $li_class = (isset($category['total']) && $category['total'] > 0) ? 'dropdown' : '';
                        $html .= ' <li class="' . $li_class . '"><a href="' . $menu_link . '" target="_blank" class="hyper"><span>';
                    } elseif ($lvl == 2) {
                        $html .= '<li><a href="' . $menu_link . '" target="_blank"><i class="fa fa-angle-right" aria-hidden="true"></i> ';
                    } else {

                    }
                    if ($lvl == 1 || $lvl == 2) {
                        $html .= $category['name'];
                    }
                    //phá hủy
                    unset($input_categories[$key]);
                    //phá hủy
                    //khởi tạo
                    $new_parent_id = $category['id'];
                    if ($lvl == 1 && (isset($category['total']) && $category['total'] > 0)) {
                        $html .= '<b class="caret"></b>';
                    }

                    $new_level = $lvl + 1;

                    self::buildMenuHTML($input_categories, $html, $new_parent_id, $new_level);
                    if ($lvl == 1) {
                        $html .= '</span> </a> </li>';
                    } elseif ($lvl == 2) {
                        $html .= '</a></li>';
                    } else {

                    }

                }
            }
            if ($lvl == 1) {
                $html .= "</ul>";
            } elseif ($lvl == 2) {
                $html .= "  </ul><div class=\"clearfix\"></div>
                                </div>
                            </ul>";
            } else {
                //Không hiện
            }
        }
    }

    public static function getMenuUlLi($source)
    {
        $html_menu = '';


        self::buildMenuHTML($source, $html_menu);

        return $html_menu;

    }

    public static function getMenuUlLiFooter1($menu_items_footer1)
    {
        $html_menu_f1 = '';

        self::buildMenuHTMLFooter($menu_items_footer1, $html_menu_f1);

        return $html_menu_f1;

    }

    public static function getMenuUlLiFooter2($menu_items_footer2)
    {
        $html_menu_f2 = '';


        self::buildMenuHTMLFooter($menu_items_footer2, $html_menu_f2);

        return $html_menu_f2;

    }

    public static function getMenuUlLiFooter3($menu_items_footer3)
    {
        $html_menu_f3 = '';


        self::buildMenuHTMLFooter($menu_items_footer3, $html_menu_f3);

        return $html_menu_f3;

    }


    public static function buildMenuHTMLFooter($input_categories, &$html, $parent_id = 0, $lvl = 1)
    {
        if (count($input_categories) > 0) {
                    if ($lvl == 1) {
                        $html .= "<ul>
                                       ";
                    } elseif ($lvl == 2) {
                        $html .= "<ul>
                                    <li>
                                        <ul class=\"multi-column-dropdown\">";
                    } else {//không hiện}
            foreach ($input_categories as $key => $category) {
            if ($category['parent_id'] == $parent_id) {
                        $category['level'] = $lvl;
                        if ($category['type'] == 7) {
                            $menu_link = $category['link'];
                        } else {
                            $menu_link = url($category['link']);
                        }
                        if ($lvl == 1) {
                            $li_class = (isset($category['total']) && $category['total'] > 0) ? 'dropdown' : '';
                            $html .= '<li class="' . $li_class . '">
                                        <a href="' . $menu_link . '" target="_blank" class="hyper">' ;
                        } elseif ($lvl == 2) {
                            $html .= '<li>
                                        <a href="' . $menu_link . '" target="_blank">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i> ';
                        } else {/*Không hiện*/
                        }

                        if ($lvl == 1 || $lvl == 2) {
                            $html .= $category['name'];
                        }
                        unset($input_categories[$key]);
                }
            }
                if ($lvl == 1) {
                $html .= "    </a></li>
                        </ul>";
                } elseif ($lvl == 2) {
                    $html .= "            </ul> 
                                    </li>
                                </ul>
                           ";
                } else {    /*không hiện*/
                }
                }
        }

    }

}

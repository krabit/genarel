<?php

namespace App\Providers;

use App\Model\Admin\ConfigModel;
use App\Model\Admin\MenuItemModel;
use App\Model\Admin\MenuModel;
use Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;


class   AppServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $items = ConfigModel::all();

        $config= array();
        $config[]='web_name';
        $config[]='header_logo';
        $config[]='footer_logo';
        $config[]='intro';
        $config[]='desc';

        $default = array();

        foreach ($items as $item){
            $key = $item->name;
            $default[$key] =$item->value;
        }

        foreach ($config as $item_config){
            if (!isset($default[$item_config])){
                $default[$item_config]='';
            }
        }

            $global_settings = $default;

           $menus_items_header = MenuItemModel::getMenuItemsByHeader();
           $menus_items_header_html = MenuItemModel::getMenuUlLi($menus_items_header);

           $menus_items_footer1 = MenuItemModel::getMenuItemsByFooter1();
            $menus_items_footer1_html = MenuItemModel::getMenuUlLiFooter1($menus_items_footer1);

            $menus_items_footer2 = MenuItemModel::getMenuItemsByFooter2();
            $menus_items_footer2_html = MenuItemModel::getMenuUlLiFooter2($menus_items_footer2);

            $menus_items_footer3 = MenuItemModel::getMenuItemsByFooter3();
            $menus_items_footer3_html = MenuItemModel::getMenuUlLiFooter3($menus_items_footer3);





        View::share('fe_global_settings', $global_settings);
        View::share('fe_menus_items_header', $menus_items_header);
        View::share('fe_menus_items_header_html', $menus_items_header_html);
        View::share('fe_menus_items_footer1', $menus_items_footer1);
        View::share('fe_menus_items_footer1_html', $menus_items_footer1_html);
        View::share('fe_menus_items_footer2', $menus_items_footer2);
        View::share('fe_menus_items_footer2_html', $menus_items_footer2_html);
        View::share('fe_menus_items_footer3', $menus_items_footer3);
        View::share('fe_menus_items_footer3_html', $menus_items_footer3_html);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

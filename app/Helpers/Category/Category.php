<?php

namespace App\Helpers\Category;

use App\Helpers\Container;

class Category
{

    public static string $tpl;

    public static function getMenu(string $tpl, string $cacheKey = '')
    {
        self::$tpl = $tpl;
        if ($cacheKey) {
            $menu_html = cache($cacheKey, '');
            if ($menu_html) {
                return $menu_html;
            }
        }
        $categories_data = self::getCategories();
        $categories_tree = self::getTree($categories_data);
        $menu_html = self::getHtml($categories_tree);
        if ($cacheKey) {
            cache([$cacheKey => $menu_html], now()->addDay());
        }
        return $menu_html;
    }

    public static function getTree($data): array
    {
        $categories_tree = [];
        foreach ($data as $id => &$category) {
            if (!$category['parent_id']) {
                $categories_tree[$id] = &$category;
                continue;
            }
            $categories_tree[$category['parent_id']]['children'][$id] = &$category;
        }

        return $categories_tree;
    }

    public static function getHtml(array $tree, $tab = ''): string
    {
        $str = '';
        foreach ($tree as $id => $item) {
            $str .= self::item2Tpl($item, $tab, $id);
        }
        return $str;
    }

    public static function item2Tpl($item, $tab, $id): string
    {
//        ob_start();
//        echo view(self::$tpl, ['item' => $item, 'tab' => $tab, 'id' => $id]);
//        return ob_get_clean();
        return view(self::$tpl, compact('item', 'tab', 'id'))->render();

    }

    public static function getCategories()
    {
        $categories_data = Container::get('categories_data');
        if (!$categories_data) {
            $categories_data = \App\Models\Category::all()->keyBy('id')->toArray();
            Container::set('categories_data', $categories_data);
        }

        return $categories_data;
    }

}

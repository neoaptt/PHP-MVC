<?php
/**
 * when writing an action you have a few things you can pass to the view to control it.
 * $_REQUEST variables are untouched, so you can use them like regular.
 * Use $pdo = db::getPDO(); to get a database connection. It's already included
 * return nothing if you don't need to change anything. It will default to
 * /views/{Controller}/{action}?{request}
 * return [
 *     'page_layout' => '/abosolute/path/to/pageLayout'
 *          if no layout is specified, then is defaults to
 *          /views/_shared/_layout.php
 *          if you wanted a custom nav bar or need a different layout for one page
 *          you can specify it here and change what layout you use.
 *     'page_title' => 'page title in meta tags'
 *     'page_description' => 'page description in meta tags for SEO'
 *     'page_path' => '/abosolute/path/to/view'
 *          if no view is specified, then it defaults to
 *          /views/{controller}/{action}.php
 *     'page_css' => array ('/abosolute/path/to/css1','/abosolute/path/to/css2')
 *     'page_scripts' => array ('/abosolute/path/to/javascript1','/abosolute/path/to/javascript2')
 * ]
 * How Models work
 * /models/{controller}/{action}Model.php
 * It will be included on the page and can be used in the action of the controller
 * and on the view page.
 * When loading CSS and Javscript order matters. The first one in the array
 * are the first ones to get loaded.
 */
class home {
    public function index() {
        $index = new \home\index();
        $r = $index->getDBstuff();
        return [
            'ourVar'=>$r
        ];
    }
    public function test() {
    }
}

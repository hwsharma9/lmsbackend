<?php

namespace App\View\Composers;

use App\Http\Services\MenuTree;
use App\Models\AdminMenu;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $menus;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        $menus_data = AdminMenu::without(['child'])
            ->with(['permission.databaseRoute'])
            ->orderBy('s_order', 'asc')
            ->get();
        $menus = MenuTree::tree($menus_data, 0);
        $this->menus = $menus;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menus', json_decode(json_encode($this->menus)));
    }
}

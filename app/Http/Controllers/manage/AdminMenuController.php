<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\AdminMenu;
use App\Models\Permission;
use App\View\Components\AdminMenuTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $menus = AdminMenu::where('p_menu_id', 0)->orderBy('s_order', 'asc')->get();
        $permissions = Permission::all();
        return view('admin.menus.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = AdminMenu::create($request->validated());
        $menus = AdminMenu::where('p_menu_id', 0)->get();
        $html = view('components.admin-menu-tree', ['menus' => $menus, 'class' => "dd-list"]);
        return ['success' => 'Menu Created successfully', 'status' => true, 'data' => $menu, 'html' => $html];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminMenu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(AdminMenu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminMenu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminMenu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminMenu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, AdminMenu $menu)
    {
        $menu->fill($request->validated());
        $menu->save();
        // $menus = AdminMenu::where('p_menu_id', 0)->get();
        // $html = view('components.admin-menu-tree', ['menus' => $menus, 'class' => "dd-list"]);
        // $html = new AdminMenuTree($menus, "dd-list");
        // $html = $html->render();
        return [
            'success' => 'Menu updated successfully',
            'status' => true,
            'data' => $menu->refresh(),
            // 'html' => $html->render()
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminMenu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminMenu $menu)
    {
        $ids = $this->getChildNode($menu->child->toArray(), $menu->id);
        $ids = explode(',', $ids);
        AdminMenu::whereIn('id', $ids)->delete();
        $menu->delete();
        return ['status' => TRUE, 'message' => 'Record successfully deleted.'];
    }

    public function updateAll(Request $request)
    {
        $array = parseJsonArray(json_decode($request->data));
        if ($this->menuUpdateAll('admin_menus', $array)) {
            return true;
        } else {
            return false;
        }
    }

    function menuUpdateAll($tbl = "", $readbleArray = array())
    {

        // $this->db->trans_begin();

        $ParentId = array();
        if (trim($tbl) != "" && count($readbleArray) > 0) {
            $i = 0;
            foreach ($readbleArray as $row) {
                $i++;
                if ($row['parentID'] == 0 && $row['id'] != 1) {
                    $ParentId[] = $row['id'];
                } else {
                    $ParentId[] = $row['parentID'];
                }
                DB::table($tbl)->where(['id' => $row['id']])->update(['p_menu_id' => $row['parentID'], 's_order' => $i]);
                // $this->db->update($tbl, array('p_menu_id' => $row['parentID'], 's_order' => $i), array('id' => $row['id']));
            } //end foreach loop

            $ParentId = array_unique($ParentId);
            DB::table($tbl)->where('id', '!=', 1)->update(['class_id' => null]);
            // $this->db->where(array('id!=' => 1));
            // $this->db->update($tbl, array('class_id' => NULL));

            DB::table($tbl)->whereIn('id', $ParentId)->update(['class_id' => 'title']);
            // $this->db->where_in('id', $ParentId);
            // $this->db->update($tbl, array('class_id' => 'title'));
            //print_r($this->db->last_query());

        } //end if	
        return TRUE;
        // if ($this->db->trans_status() === FALSE) {
        //     $this->db->trans_rollback();
        //     return FALSE;
        // } else {
        //     $this->db->trans_commit();
        //     return TRUE;
        // }
    }

    function getChildNode($list = array(), $parent_id = NULL, $parent_id_name = "p_menu_id", $id_name = "id")
    {
        $result = "";
        if ($parent_id != NULL) {
            foreach ($list as $cat) {
                if ($cat[$parent_id_name] == $parent_id) {
                    $current_id = $cat[$id_name];
                    $result .= "," . $current_id;
                    $result .= $this->getChildNode($list, $current_id, $parent_id_name, $id_name);
                }
            }
        }
        return trim($result, ',');
    }
}

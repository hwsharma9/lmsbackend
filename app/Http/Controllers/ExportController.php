<?php

namespace App\Http\Controllers;

use App\Http\Services\MenuTree;
use App\Models\AdminMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    // public function exportTable($table)
    // {
    //     $records = DB::table($table)->get()->toArray();
    //     echo "<pre>";
    //     if (count($records)) {
    //         $columns = array_keys((array) $records[0]);
    //         $count = 0;
    //         $query = '';
    //         $seeders = '';
    //         foreach ($records as $record) {
    //             if ($count == 0) {
    //                 $query .= 'insert into ' . $table . '(' . implode(', ', $columns) . ') values<br>';
    //             }
    //             $values = array_values((array) $record);
    //             $str = implode(', ', $values);
    //             $query .= '(' . $str . ')';
    //             $seeders .= '[' . $str . ']';
    //             $count++;
    //             if ($count == 100 || $count == count($records)) {
    //                 $count = 0;
    //                 $query .= ';';
    //             } else {
    //                 $query .= ',';
    //             }
    //             $query .= '<br>';
    //             $seeders .= ',<br>';
    //         }
    //         echo $query . '<br><br><br><br>';
    //         echo $seeders;
    //     }
    // }

    public function exportTable($table)
    {
        $records = DB::table($table)->get();
        if ($records) {
            $columns = array_keys((array) $records[0]);
            // $columns = DB::getSchemaBuilder()->getColumnListing($table);
            $row_counter_stopper = request()->has('row_counter_stopper') ? request()->get('row_counter_stopper') : 500;
            $row_counter = 0;
            $query = '';
            $seeders = [];
            foreach ($records as $key => $record) {
                if ($row_counter == 0) {
                    $query .= 'insert into ' . $table . ' (' . implode(',', $columns) . ') values<br>';
                }
                $array = (array) $record;
                $query .= "(";
                $count = 1;
                $data_string = '';
                $row_data = [];
                foreach ($array as $name => $value) {
                    if (in_array($name, ['created_at', 'updated_at'])) {
                        $data_string .= "'" . date('Y-m-d H:i:s', strtotime($value)) . ((count($array) == $count) ? "'" : "',");
                        // $data_string .= "'" . date('Y-m-d H:i:s') . ((count($array) == $count) ? "'" : "',");
                        $row_data[$name] = "'" . date('Y-m-d H:i:s', strtotime($value)) . "'";
                    } else {
                        if (is_int($value)) {
                            $data_string .= $value . ((count($array) == $count) ? "" : ",");
                            $row_data[$name] = $value;
                        } else {
                            if ($value == "") {
                                $data_string .= 'NULL' . ((count($array) == $count) ? "" : ",");
                                $row_data[$name] = 'NULL';
                            } else {
                                $data_string .= "'" . addslashes($value) . ((count($array) == $count) ? "'" : "',");
                                $row_data[$name] = "'" . addslashes($value) . "'";
                            }
                        }
                    }
                    $count++;
                }
                // dd($columns, explode(',', $data_string), $row_data);
                $seeders[] = array_combine($columns, $row_data);
                $query .= $data_string;
                $query .= ($row_counter == ($row_counter_stopper - 1) || (count($records) == ($key + 1)) ? ");" : "),") . "<br>";
                $row_counter++;
                if ($row_counter == $row_counter_stopper) {
                    $row_counter = 0;
                }
            }
            echo "<pre>";
            print_r($query);
            echo "<br><br><br>";
            $seed_string = '';
            foreach ($seeders as $key => $seeds) {
                $seed_string .= "[<br>";
                $count = 0;
                foreach ($seeds as $key_name => $value) {
                    $seed_string .= "\t'" . $key_name . "'" . ' => ' . $value . (($count == count($seeds) - 1) ? "" : ", ") . '</br>';
                    if ($count == count($seeds)) {
                        $count = 0;
                    }
                    $count++;
                }
                $seed_string .= "],<br>";
            }
            echo $seed_string;
            echo "</pre>";
        }
    }

    public function tree()
    {
        $menus = AdminMenu::without(['child'])->with('permission.databaseRoute')->orderBy('s_order', 'asc')->get();
        $menu_data = collect(MenuTree::tree($menus, 0));
        return $menu_data->pluck('permission.databaseRoutes.route');
    }
}

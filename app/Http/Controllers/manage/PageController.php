<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Page::query()->withTrashed();
            return DataTables::of($data)
                ->addIndexColumn('id')
                ->editColumn('updated_at', function ($row) {
                    return date('Y-m-d', strtotime($row['updated_at']));
                })
                ->editColumn('status', function ($row) {
                    return PublishStatus($row['status']);
                })
                ->editColumn('is_default', function ($row) {
                    return DefaultStatus($row['is_default']);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-primary" href="' . route('manage.permissions.edit', ['permission' => $row['id']]) . '"><i class="fas fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'is_default'])
                ->make(true);
        }
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $validated = $request->validated();
        Page::create($validated);
        return redirect()->route('manage.pages.index')
            ->with('success', 'Page created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->fill($request->validated());
        $page->save();
        return redirect()->route('manage.pages.edit', ['page' => $page->id])
            ->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }

    /*public function getPages(Request $request)
    {
        // ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Page::withTrashed()
            ->select('count(*) as allcount')->count();
        $totalRecordswithFilter = Page::withTrashed()
            ->select('count(*) as allcount')
            ->where('title_en', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Page::withTrashed()
            ->orderBy($columnName, $columnSortOrder)
            ->where('title_en', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "data" => $records
        );
        return $response;
    }*/
}

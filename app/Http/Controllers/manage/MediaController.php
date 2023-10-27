<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\traits\FileUpload;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MediaController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Media::query()
                ->with(['creator', 'editor', 'upload']);
            return DataTables::of($data)
                ->addIndexColumn('id')
                ->addColumn('action', function ($row) {
                    $btn = '<form id="delete-form-' . $row['id'] . '" mehod="POST">' . method_field('DELETE') . csrf_field() . '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button></form>';
                    // $btn = `
                    //     <form id='delete-form-{$row['id']}' mehod="POST">
                    //         {csrf_token()}
                    //         <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{$row['id']}').submit();"><i class="fas fa-trash"></i></button>
                    //     </form>
                    // `;
                    return $btn;
                })
                ->editColumn('updated_at', function ($row) {
                    return date('Y-m-d', strtotime($row['updated_at']));
                })
                ->editColumn('created_by', function ($row) {
                    return $row['creator']['first_name'] . ' ' . $row['creator']['last_name'];
                })
                ->editColumn('updated_by', function ($row) {
                    return $row['editor']['first_name'] . ' ' . $row['editor']['last_name'];
                })
                ->editColumn('link', function ($row) {
                    return asset(Storage::url($row['upload']['folder'] . '/' . $row['upload']['original_name']));
                })
                ->rawColumns(['action', 'created_by', 'updated_by', 'link'])
                ->make(true);
        }
        return view('admin.medias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaRequest $request)
    {
        if ($request->hasFile('file')) {
            $folder = 'media';
            $path = $this->UploadFile($request->file('file'), $folder);
            if (!empty($path)) {
                $media = Media::create($request->validated());
                $media->upload()->create([
                    'folder' => $folder,
                    'file_path' => $path,
                    'original_name' => $request->file('file')->getClientOriginalName(),
                ]);
            }
        }
        return back()->with('image_uploaded', 'Profile Image Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaRequest  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}

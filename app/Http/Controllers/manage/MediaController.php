<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $data = Media::query()->withTrashed()
                ->with(['creator', 'editor', 'upload']);
            return DataTables::of($data)
                ->addIndexColumn('id')
                ->addColumn('action', function ($row) {
                    $action = view('components.list-actions', [
                        'actions' => [
                            'edit' => 'manage.medias.edit',
                            'delete' => 'manage.medias.destroy',
                        ],
                        'model' => $row
                    ]);
                    $action = $action->render();

                    return $action;
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
                    // return Storage::url($row['upload']['folder'] . '/' . $row['upload']['original_name']);
                    return $row['upload']['original_name'];
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
    public function destroy(Media $media, Request $request)
    {
        $upload = $media->upload;
        $message = $upload->original_name  . " Restored successully!";
        if ($request->has('restore') && $request->restore == 1) {
            $media->restore();
        } else {
            if ($media->deleteOrFail() === false) {
                return response(
                    ["message" => "Couldn't delete the media with id {$media->id}", "action" => false],
                    Response::HTTP_BAD_REQUEST
                );
            }
            $message = $upload->original_name  . " softly deleted successully!";
        }

        return response(["message" => $message, "action" => true], Response::HTTP_OK);
    }
}

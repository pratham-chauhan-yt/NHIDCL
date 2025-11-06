<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

abstract class MasterCrudController extends Controller
{
    /**
     * Model class name (to be defined in child controller).
     */
    protected $model;

    /**
     * View file name (to be defined in child controller).
     */
    protected $view;

    /**
     * Column name to display & validate (to be defined in child controller).
     */
    protected $field;

    /**
     * Route title (to be defined in child controller).
     */
    protected $title;

    /**
     * Route prefix (to be defined in child controller).
     */
    protected $routePrefix;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model::where(function ($q) {
                $q->where('is_deleted', false)
                    ->orWhereNull('is_deleted');
            })
                ->orderBy($this->field, 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteUrl = route("{$this->routePrefix}.destroy", Crypt::encrypt($row->id));
                    return '
                        <button class="btn btn-primary btn-sm" onclick="formContainer(true,\'' . Crypt::encrypt($row->id) . '\')">Edit</button>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm deletedata" data-id="' . Crypt::encrypt($row->id) . '" onclick="confirmDelete(\'' . $row->id . '\')">Delete</a>
                        <form id="delete-form-' . $row->id . '" action="' . $deleteUrl . '" method="POST" style="display:none;">
                            ' . csrf_field() . method_field('DELETE') . '
                        </form>';
                })
                ->editColumn($this->field, fn($row) => $row->{$this->field})
                ->editColumn('created_at', fn($row) => $row->created_at->format('d-m-Y'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view($this->view, ['header' => true, 'sidebar' => true]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                $this->field => 'required|max:100',
            ]);
            $validated['is_deleted'] = false;
            $this->model::create($validated);

            return response()->json(['message' => "{$this->title} created successfully"]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong');
            return redirect()->route("{$this->routePrefix}.index")
                ->withInput()
                ->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->model::find(Crypt::decrypt($id));

            if ($item) {
                return response()->json([$this->field => $item->{$this->field}]);
            }

            return response()->json(['message' => 'Not found'], 404);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong');
            return redirect()->route("{$this->routePrefix}.index")
                ->withInput()
                ->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                $this->field => 'required|max:100'
            ]);

            $this->model::where('id', Crypt::decrypt($id))
                ->update([$this->field => $request->{$this->field}]);

            return response()->json(['message' => "{$this->title} updated successfully"]);
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong');
            return redirect()->route("{$this->routePrefix}.index")
                ->withInput()
                ->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $item = $this->model::where('id', $decryptedId)->first();

            if (!$item) {
                Alert::error('Error', "{$this->title} not found");
                return redirect()->route("{$this->routePrefix}.index");
            }

            $this->model::where('id', $decryptedId)
                ->update(['is_deleted' => true, 'updated_by' => Auth::id()]);

            Alert::success('Success', "{$this->title} deleted successfully");
            return redirect()->route("{$this->routePrefix}.index");
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong');
            return redirect()->route("{$this->routePrefix}.index")
                ->withInput()
                ->withErrors(['msg' => $e->getMessage()]);
        }
    }
}

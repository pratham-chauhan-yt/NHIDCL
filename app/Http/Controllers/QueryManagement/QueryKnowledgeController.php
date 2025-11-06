<?php

namespace App\Http\Controllers\QueryManagement;

use App\Http\Requests\DocumentManagement\ShareRequest;
use App\Models\User;
use App\Services\FileService;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\NhidclApplicationStatus;
use App\Models\QueryManagement\QmsKnowledgeBase;
use App\Models\QueryManagement\QmsQueryDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class QueryKnowledgeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:qms-dashboard|qms-add-query|qms-knowladge-base-query|qms-raised-query'])
            ->only(['create', 'store', 'index', 'show', 'destroy']);
        $this->middleware(function ($request, $next) {
            session(['moduleName' => 'Query Management System']);
            return $next($request);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $query = QmsKnowledgeBase::with(['createdBy:id,name,email'])->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d-m-Y') : '-';
                })
                ->addColumn('created_by', function ($row) {
                    return $row->createdBy ? $row->createdBy->name . '(' . $row->createdBy->email . ')' : '-';
                })
                ->addColumn('action', function ($row) {
                    $viewRoute = route('qms.view-knowledge-base-query', Crypt::encrypt($row->id));
                    $editRoute = route('qms.edit-knowledge-base-query', Crypt::encrypt($row->id));
                    return '
                    <a href=" ' . $viewRoute . '" class="btn btn-sm btn-primary">View</a>
                    <a href="' . $editRoute . '" class="btn btn-sm btn-warning">Edit</a>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $header = true;
        $sidebar = true;
        return view("query-management.knowledge-base-query", compact("header", "sidebar"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:150',
                'meta_title' => 'required|string|max:60',
                'description' => 'required|string|max:250',
                'meta_description' => 'required|string|max:160',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors()->all())->withInput();
            }

            $inputs = $request->all();
            $knowladgebaseId = $inputs['konwladgebase_id'];
            if (isset($knowladgebaseId)) {
                $knowladgebaseQuery = QmsKnowledgeBase::find($knowladgebaseId);
                if (!$knowladgebaseQuery) {
                    Alert::error('Error', 'Data not found');
                    return redirect()->back()->withInput();
                }
                $knowladgebaseQuery->update([
                    'title' => $inputs['title'],
                    'meta_title' => $inputs['meta_title'],
                    'description' => $inputs['description'],
                    'meta_description' => $inputs['meta_description'],
                    'image' => $inputs['knowledgebase_file'],
                ]);
                Alert::success('Success', 'Knowledge base Query has been updated successfully');
            } else {
                $query = QmsKnowledgeBase::create([
                    'title' => $inputs['title'],
                    'meta_title' => $inputs['meta_title'],
                    'description' => $inputs['description'],
                    'meta_description' => $inputs['meta_description'],
                    'image' => $inputs['knowledgebase_file'],
                    'created_by' => user_id(),
                ]);
                $yearSuffix = Carbon::now()->format('y');
                $queryId = str_pad($query->id, 2, '0', STR_PAD_LEFT);
                // Update query_id
                $query->query_id = "NHIDCL-KBQ-" . $yearSuffix . "-" . $queryId;
                $query->save();
                Alert::success('Success', 'Knowledge base Query has been created successfully');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function view($id)
    {
        $kbId = Crypt::decrypt($id);
        $data = QmsKnowledgeBase::with(['createdBy:id,name,email'])->where('id', $kbId)->first();
        $header = true;
        $sidebar = true;
        return view("query-management.view-knowledgebase-query", compact("header", "sidebar", "data"));
    }

    public function edit($id)
    {
        $kbId = Crypt::decrypt($id);
        $data = QmsKnowledgeBase::with(['createdBy:id,name,email'])->where('id', $kbId)->first();
        $header = true;
        $sidebar = true;
        return view("query-management.edit-knowledge-base-query", compact("header", "sidebar", "data"));
    }
}

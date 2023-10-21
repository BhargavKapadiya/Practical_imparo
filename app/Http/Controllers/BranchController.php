<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Branch;
use App\Models\Image;
use DataTables;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Business::select('branches.id','businesses.name as name', 'branches.name as branch_name')->leftjoin('branches', 'branches.business_id', '=', 'businesses.id')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('branch.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>'
                .'<a href="'.route('branch.delete',$row->id).'" class="edit btn btn-danger btn-sm">Delete</a>'
                .'<a href="'.route('branch.view',$row->id).'" class="edit btn btn-success btn-sm">View</a>';
                return $btn;
                
            })
            ->addColumn('image', function($row){
                $images = Image::where('branch_id',$row->id)->get();
                $logo = '';
                foreach($images as $image){
                    $url = url('/uploads/image').'/'.$image->image;
                    $logo .= '<img src="'.$url.'" width="100" height="100">';
                }
                return $logo;
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }
        return view('branch/index');
    }
    public function create(){
        $business = Business::all();
        return view('branch/create',compact('business'));
    }

    public function store(Request $request){
        if($request->method() == "POST"){

            $request->validate([
                'name' => 'required',
                'business' => 'required',
                'days' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

            $businessObj = new Branch();
            $businessObj->name = $request->name;
            $businessObj->business_id = $request->business;
            $businessObj->working_days = implode(",",$request->days);
            $businessObj->working_hrs = date('Y-m-d H:i:s',strtotime($request->start_time));
            $businessObj->end_time = date('Y-m-d H:i:s',strtotime($request->end_time));
            $businessObj->save();

            if(@$businessObj->id){
                $branch_id = $businessObj->id;
                foreach($request->image as $img){
                    if($request->has('image')){
                        $file = $img;
                        $filename = time().'_image'.$request->id.'.'.$file->getClientOriginalExtension();
                        $file->move('uploads/image',$filename);

                        $businessObj = new Image();
                        $businessObj->branch_id = $branch_id    ;
                        $businessObj->image = $filename;
                        $businessObj->save();
                    }
                }
            }
        }
        return redirect(route('branch.index'))->withInput()->with('success',"Branch created successfully");

    }

    public function edit($id){
        $data = Branch::find($id);
        $business = Business::all();
        return view('branch/edit',compact('data','business'));
    }

    public function update(Request $request){
        if($request->method() == "POST"){

            $request->validate([
                'name' => 'required',
                'business' => 'required',
                'days' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

            $businessObj = Branch::find($request->id);
            $businessObj->name = $request->name;
            $businessObj->business_id = $request->business;
            $businessObj->working_days = implode(",",$request->days);
            $businessObj->working_hrs = date('Y-m-d H:i:s',strtotime($request->start_time));
            $businessObj->end_time = date('Y-m-d H:i:s',strtotime($request->end_time));
            $businessObj->save();
        }
        return redirect(route('branch.index'))->withInput()->with('success',"Branch updated successfully");
    }

    public function view($id, Request $request){
        $business = Business::all();
        $data = Branch::find($id);
        return view('branch/view',compact('data','business'));
    }

    public function destroy($id){

        if($id){
            $businessObj = Branch::find($id);
            $businessObj->delete();
        }
        return redirect(route('branch.index'))->withInput()->with('success',"Branch Deleted successfully");

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Business::select('*');

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('home.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>'
                .'<a href="'.route('home.delete',$row->id).'" class="edit btn btn-danger btn-sm">Delete</a>';
                return $btn;
                
            })
            ->addColumn('logo', function($row){
                $url = url('/uploads/logo').'/'.$row->logo;
                $logo = '<img src="'.$url.'" width="100" height="100">';
                return $logo;
                
            })
            ->rawColumns(['action','logo'])
            ->make(true);
        }
        return view('home/home');
    }

    public function create(){
        return view('home/create');
    }
    
    public function store(Request $request){
        
        if($request->method() == "POST"){

            $request->validate([
                'name' => 'required',
                'logo' => 'required',
                'email' => 'required|email|unique:businesses'
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'logo.required' => 'Logo is required'
            ]);

            $businessObj = new Business();
            $businessObj->name = $request->name;
            $businessObj->email = $request->email;
            if($request->has('logo')){

                $file = $request->file('logo');
                $filename = time().'_logo'.$request->id.'.'.$file->getClientOriginalExtension();
                $file->move('uploads/logo',$filename);
                $businessObj->logo = $filename;
            }
            $businessObj->save();
        }
        return redirect(route('home'))->withInput()->with('success',"Business created successfully");
    }

    public function edit($id){
        $data = Business::find($id);
        return view('home/edit',compact('data'));
    }

    public function update(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:businesses,email,'.$request->id
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);

        $businessObj = Business::find($request->id);
        $businessObj->name = $request->name;
        $businessObj->email = $request->email;
        if($request->has('logo')){

            $file = $request->file('logo');
            $filename = time().'_logo'.$request->id.'.'.$file->getClientOriginalExtension();
            $file->move('uploads/logo',$filename);
            $businessObj->logo = $filename;
        }
        $businessObj->save();
        return redirect(route('home'))->withInput()->with('success',"Business updated successfully");
    }

    public function destroy($id){

        if($id){
            $businessObj = Business::find($id);
            $businessObj->delete();
        }
        return redirect(route('home'))->withInput()->with('success',"Business Deleted successfully");

    }


}

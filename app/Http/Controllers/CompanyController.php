<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserDocument;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\Not;

class CompanyController extends Controller
{
    //
    public function login(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;
            if ($user->status == 0) {
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect('/login');
            }
        }
        return view('auth.super-login');
    }

    public function manageEmployee(){
        return view('admin.employee-manage');
    }
    public function tableEmployee(Request $request){
        $status = $request->status;
        $contact = $request->contact;
        $company_id = Auth::user()->company_id;
        if (isset($status)){
            $data = User::where('role', 'employee')->where('status', $status)->where('contact', 'like', '%' . $contact . '%')->where('company_id', $company_id)->get();
        }
        else{
            $data = User::where('role', 'employee')->where('contact', 'like', '%' . $contact . '%')->where('company_id', $company_id)->get();
        }

        return view('admin.employee-table', compact('data'));
    }
    public function addEmployee(){
        $ex = true;
        $code = 0;
        while($ex){
            $code = rand(100000, 999999);
            $c_user = User::where('user_code', $code)->first();
            if(!isset($c_user)) {
                $ex = false;
            }
        }
        return view('admin.employee-add', compact('code'));
    }
    public function editEmployee($id){
        $user = User::find($id);
        return view('admin.employee-add', compact('user'));
    }
    public function saveEmployee(Request $request){
        $id = $request->id;

        if(!isset($id)){
            $company_id = Auth::user()->company_id;
            $data = [
                'role' => 'employee',
                'user_code' => $request->user_code,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'post_code' => $request->post_code,
                'address' => $request->address,
                'contact' => $request->contact,
                'department' => $request->department,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'company_id' => $company_id
            ];
            $user = User::create($data);
            $user->givePermissionTo('employee');
        }
        else{
            if(isset($request->password)){
                $data = [
                    'user_code' => $request->user_code,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'department' => $request->department,
                    'status' => $request->status,
                    'remarks' => $request->remarks
                ];
            }
            else{
                $data = [
                    'user_code' => $request->user_code,
                    'name' => $request->name,
                    'email' => $request->email,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'department' => $request->department,
                    'status' => $request->status,
                    'remarks' => $request->remarks
                ];
            }
            User::find($id)->update($data);
        }
        return response()->json(['status' => true]);
    }
    public function deleteEmployee(Request $request){
        $id = $request->id;
        User::where('id', $id)->delete();
        UserDocument::where('user_id', $id)->delete();
        return response()->json(['status' => true]);
    }

    public function manageNoti(){
        return view('admin.noti-manage');
    }
    public function tableNoti(Request $request){
        $status = $request->status;
        $report_date = $request->report_date;
        $company_id = Auth::user()->company_id;
        if(isset($report_date)){
            $start_date = date('Y-m-d', strtotime($report_date)) . ' 00:00:00';
            $end_date = date('Y-m-d', strtotime($report_date)) . ' 23:59:59';
            if(isset($status)){
                $data = Notification::where('status', $status)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->where('company_id', $company_id)->get();
            }
            else{
                $data = Notification::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->where('company_id', $company_id)->get();
            }
        }
        else{
            if (isset($status)){
                $data = Notification::where('status', $status)->where('company_id', $company_id)->get();
            }
            else{
                $data = Notification::where('company_id', $company_id)->get();
            }
        }

        return view('admin.noti-table', compact('data'));
    }
    public function addNoti(){
        return view('admin.noti-add');
    }
    public function editNoti($id){
        $data = Notification::find($id);
        return view('admin.noti-add', compact('data'));
    }
    public function saveNoti(Request $request){
        $id = $request->id;
        $company_id = Auth::user()->company_id;
        if(!isset($id)){
            $data = [
                'title' => $request->title,
                'status' => $request->status,
                'content' => $request->detail,
                'company_id' => $company_id
            ];
            Notification::create($data);
        }
        else{
            $data = [
                'title' => $request->title,
                'status' => $request->status,
                'content' => $request->detail,
            ];
            Notification::find($id)->update($data);
        }
        return response()->json(['status' => true]);
    }
    public function deleteNoti(Request $request){
        $id = $request->id;
        Notification::where('id', $id)->delete();
        return response()->json(['status' => true]);
    }

    public function manageDoc(){
        return view('admin.doc-manage');
    }
    public function tableDoc(Request $request){
        $name = $request->name;
        $company_id = Auth::user()->company_id;
        $docs = Document::where('name', 'like', '%' . $name . '%')->where('company_id', $company_id)->get()->toArray();
        $data = [];
        foreach ($docs as $doc){
            $tmp = array();
            $tmp['id'] = $doc['id'];
            $tmp['doc_code'] = $doc['doc_code'];
            $tmp['name'] = $doc['name'];
            $tmp['url'] = $doc['url'];
            $tmp['dist_date'] = date('Y/m/d', strtotime($doc['created_at']));
            $tmp['dist'] = User::where('role', 'employee')->where('company_id', $company_id)->get()->count();
            $tmp['view'] = UserDocument::with('user')->whereHas('user', function ($query) use ($company_id){
                $query->where('company_id', $company_id);
            })->where('doc_id', $doc['id'])->where('type', 1)->get()->count();
            $tmp['agree'] = UserDocument::with('user')->whereHas('user', function ($query) use ($company_id){
                $query->where('company_id', $company_id);
            })->where('doc_id', $doc['id'])->where('type', 2)->get()->count();
            $tmp['unread'] = $tmp['dist'] - $tmp['view']-  $tmp['agree'];
            array_push($data, $tmp);
        }

        return view('admin.doc-table', compact('data'));
    }
    public function addDoc(){
        $ex = true;
        $code = 0;
        while($ex){
            $code = rand(100000, 999999);
            $c_doc = Document::where('doc_code', $code)->first();
            if(!isset($c_doc)) {
                $ex = false;
            }
        }
        return view('admin.doc-add', compact('code'));
    }
    public function editDoc($id){
        $doc = Document::find($id);
        $company_id = Auth::user()->company_id;
        $data = array();
        $data['id'] = $doc->id;
        $data['doc_code'] = $doc->doc_code;
        $data['name'] = $doc->name;
        $data['url'] = $doc->url;
        $data['file_name'] = $doc->file_name;
        $data['viewer'] = '';
        $data['agree'] = '';
        $data['unread'] = '';

        $user_ids = [];
        $viewer = UserDocument::with('user')->where('doc_id', $doc->id)->where('type', 1)->get();
        foreach ($viewer as $index => $item){
            if($index != count($viewer) - 1){
                $data['viewer'] = $data['viewer'] . $item->user->name . ', ';
            }
            else{
                $data['viewer'] = $data['viewer'] . $item->user->name;
            }
            array_push($user_ids, $item->user_id);
        }
        $agree = UserDocument::with('user')->where('doc_id', $doc->id)->where('type', 2)->get();
        foreach ($agree as $index => $item){
            if($index != count($agree) - 1){
                $data['agree'] = $data['agree'] . $item->user->name . ', ';
            }
            else{
                $data['agree'] = $data['agree'] . $item->user->name;
            }
            array_push($user_ids, $item->user_id);
        }

        $unread = User::where('role', 'employee')->where('company_id', $company_id)->whereNotIn('id', $user_ids)->get();
        foreach ($unread as $index => $item){
            if($index != count($unread) - 1){
                $data['unread'] = $data['unread'] . $item->name . ', ';
            }
            else{
                $data['unread'] = $data['unread'] . $item->name;
            }
        }

        return view('admin.doc-add', compact('data'));
    }
    public function saveDoc(Request $request){
        $id = $request->id;
        $company_id = Auth::user()->company_id;
        if(!isset($id)){
            if($request->hasFile('file')){
                $file = $request->file('file');
                $filename = uniqid('file_', true) . '.' . $file->getClientOriginalExtension();
                $originalName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/upload/';
                //$destinationPath = storage_path('app/public');
                $file->move($destinationPath, $filename);
                $path = '/public/upload/' . $filename;
                $data = [
                    'doc_code' => $request->doc_code,
                    'name' => $request->name,
                    'url' => $filename,
                    'company_id' => $company_id,
                    'file_name' => $originalName
                ];
                Document::create($data);
            }
        }
        else{
            if($request->hasFile('file')){
                $file = $request->file('file');
                $filename = uniqid('file_', true) . '.' . $file->getClientOriginalExtension();
                $originalName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/upload/';
                $file->move($destinationPath, $filename);
                $path = '/public/upload/' . $filename;
                $data = [
                    'doc_code' => $request->doc_code,
                    'name' => $request->name,
                    'url' => $filename,
                    'file_name' => $originalName
                ];

            }
            else{
                $data = [
                    'doc_code' => $request->doc_code,
                    'name' => $request->name
                ];
            }
            Document::find($id)->update($data);
        }
        return response()->json(['status' => true]);
    }
    public function deleteDoc(Request $request){
        $id = $request->id;
        Document::where('id', $id)->delete();
        UserDocument::where('doc_id', $id)->delete();
        return response()->json(['status' => true]);
    }
    public function downloadDoc($id){
        $doc = Document::find($id);
        if(isset($doc)){
            $file_name = $doc->file_name . '.pdf';
            $file = public_path().'/upload/'.$doc->url;
            if(file_exists($file)){
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
                return response()->download($file, $file_name, $headers);
            }
        }

        return redirect('404');

    }
}

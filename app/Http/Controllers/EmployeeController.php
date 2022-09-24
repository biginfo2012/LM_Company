<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Notification;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    //
    public function dashboard(){
        $user_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        $view = UserDocument::where('user_id', $user_id)->where('type', 1)->get()->count();
        $agree = UserDocument::where('user_id', $user_id)->where('type', 2)->get()->count();
        $doc = Document::where('company_id', $company_id)->count();
        $unread = $doc - $view - $agree;

        $noti = Notification::where('status', 2)->where('company_id', $company_id)->orderBy('created_at', 'desc')->take(5)->get();
        return view('user.dashboard', compact('view', 'agree', 'unread', 'noti'));
    }

    public function checkDoc(){
        return view('user.check-doc');
    }
    public function tableDoc(Request $request){
        $name = $request->name;
        $type = $request->type;
        $user_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        if(isset($type)){
            if($type != 0){
                $doc = UserDocument::with('doc')->whereHas('doc', function ($query) use ($name, $company_id) {
                    $query->where('name', 'like', '%' . $name . "%")->where('company_id', $company_id);
                })->where('type', $type)->where('user_id', $user_id)->get();
                $data = [];
                foreach ($doc as $item){
                    $tmp = array();
                    $tmp['id'] = $item->doc_id;
                    $tmp['name'] = $item->doc->name;
                    $tmp['created_at'] = $item->created_at;
                    array_push($data, $tmp);
                }
            }
            else{
                $doc_id = UserDocument::with('doc')->whereHas('doc', function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    })->where('user_id', $user_id)->get()->pluck('id')->toArray();
                $data = Document::where('name', 'like', '%' . $name . "%")->where('company_id', $company_id)->whereNotIn('id', $doc_id)->get()->toArray();
            }
        }
        else{
            $data = Document::where('name', 'like', '%' . $name . "%")->where('company_id', $company_id)->get()->toArray();
        }
        return view('user.doc-table', compact('data'));
    }
    public function detailDoc($id){
        $data = Document::find($id);
        $u_doc = UserDocument::where('user_id', Auth::user()->id)->where('doc_id', $id)->get()->first();
        $type = 0;
        if (isset($u_doc)){
            $type = $u_doc->type;
        }
        return view('user.doc-detail', compact('data', 'type'));
    }
    public function changeDoc(Request $request){
        $doc_id = $request->id;
        $type = $request->type;
        $user_id = Auth::user()->id;
        $data = [
            'user_id' => $user_id,
            'doc_id' => $doc_id
        ];
        UserDocument::updateOrCreate($data, ['type' => $type]);
        return response()->json(['status' => true]);
    }

    public function getDocument($id)
    {
        $document = Document::find($id);

        $filePath = '/public/'. $document->url;

        // file not found
        if( ! Storage::exists($filePath) ) {
            abort(404);
        }

        $pdfContent = Storage::get($filePath);

        // for pdf, it will be 'application/pdf'
        $type       = Storage::mimeType($filePath);
        $fileName   = $filePath;

        return Response::make($pdfContent, 200, [
            'Content-Type'        => $type,
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ]);
    }

    public function checkNoti(){
        return view('user.check-noti');
    }
    public function tableNoti(Request $request){
        $company_id = Auth::user()->company_id;
        $data = Notification::where('company_id', $company_id)->where('status', 2)->orderBy('created_at', 'desc')->get();
        return view('user.noti-table', compact('data'));
    }
    public function detailNoti($id){
        $data = Notification::find($id);
        return view('user.noti-detail', compact('data'));
    }

    public function myPage(){
        return view('user.my-page');
    }

    public function inquiry(){
        return view('user.inquiry');
    }
}

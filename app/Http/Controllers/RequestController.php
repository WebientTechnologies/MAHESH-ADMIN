<?php

namespace App\Http\Controllers;
use App\Models\Request ;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Request::with('member', 'head')
            ->where('column_name', 'Business Image')
            ->get();
            foreach ($requests as $request) {
                if ($request->old_value === 'blank image' || $request->old_value === null) {
                    $request->old_value_link = null;
                } else {
                    $request->old_value_link = Storage::disk('s3')->temporaryUrl($request->old_value, now()->addMinutes(10));
                }
        
                $request->new_value_link = Storage::disk('s3')->temporaryUrl($request->new_value, now()->addMinutes(10));
            }
        //dd(compact('requests'));
        return view('requests.index', compact('requests'));
    }

    public function update(HttpRequest $request, $id)
    {
        $requestModel = Request::findOrFail($id);
        $requestModel->status = $request->status;
        $requestModel->save();

        return redirect()->route('requests.index')->with('success', 'Request status updated successfully.');
    }
}

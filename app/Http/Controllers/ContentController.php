<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Content;
use App\MedicineContent;
use Session;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::all();
        $str = "";
      
        foreach($contents as $content) {
            // $array = unserialize($medicine->medicineContent);
            // $medicineContent = implode(',', $array);
            $contentId = $content->id;
            $contentName = ucwords($content->contentName);
            $contentUses = str_limit(ucfirst($content->uses), 60, '...');
            $contentHowItWorks = str_limit(ucfirst($content->howItWorks), 60, '...');
            $contentSideEffects = str_limit(ucfirst($content->sideEffects), 60, '...');
            $contentPrescription = $content->prescription;
            if(!$contentPrescription)
                $contentPrescription = 'No';
            else if($contentPrescription)
                $contentPrescription = 'Yes';

            $editRoute = route('content.edit', ['id' => $contentId, 'admin' => 'admin',]);
            $detailRoute = route('content.detail', ['id' => $contentId, 'admin' => 'admin']);

            $str .= "<tr>
                        <td>$contentId</td>
                        <td>$contentName</td>
                        <td>$contentUses</td>
                        <td>$contentHowItWorks</td>
                        <td>$contentSideEffects</td>
                        <td>$contentPrescription</td>
                        <td><a href='$detailRoute' class='btn btn-primary btn-sm'>Details</a></td>
                        <td><a class='btn btn-success btn-sm' href='$editRoute'>Edit</a></td>
                    </tr>";
        }

        return view('admins.contents.view')->with(['str' => $str]);
    }

    /**
     * Display a specific content in detail
     * @return \Illuminate\Http\Response
     * @param Request
     */

     public function contentDetail(Request $request, $id) {

        $id = $request->route()->parameter('id');
        $content = Content::find($id);
        return view('admins.contents.contentDetail')->with(['content' => $content]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.contents.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contentName' => 'required|string|unique:contents',
            'uses' => 'required|string',
            'howItWorks' => 'required|string',
            'sideEffects' => 'required|string',
            'prescription' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('content.add', ['admin' => 'admin'])->withErrors($validator)->withInput($request->all());
        }

        // If validation okay, then create and save data
        $content = new Content;
        $content->contentName = $request->input('contentName');
        $content->uses = $request->input('uses');
        $content->howItWorks = $request->input('howItWorks');
        $content->sideEffects = $request->input('sideEffects');
        $content->prescription = $request->input('prescription');

        $content->save();
        
        return redirect()->route('content.view', ['admin' => 'admin'])->with('success', 'Content Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $id = $request->route()->parameter('id');
        $content = Content::find($id);
        return view('admins.contents.edit')->with(['content' => $content]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->route()->parameter('id');
        
        $validator = Validator::make($request->all(), [
            'contentName' => 'required|string|unique:contents,contentName,'.$id,
            'uses' => 'required|string',
            'howItWorks' => 'required|string',
            'sideEffects' => 'required|string',
            'prescription' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('content.edit', ['admin' => 'admin', 'id' => $id])->withErrors($validator);
        }


        // If validation okay, then create and save data
        $content = Content::find($id);
        $content->contentName = $request->input('contentName');
        $content->uses = $request->input('uses');
        $content->howItWorks = $request->input('howItWorks');
        $content->sideEffects = $request->input('sideEffects');
        $content->prescription = $request->input('prescription');

        $content->save();
        
        return redirect()->route('content.view', ['admin' => 'admin'])->with('success', 'Content Updated');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->route()->parameter('id');
        $content = Content::find($id);
        $content->delete();
        return redirect()->route('content.deleteView', ['admin' => 'admin'])->with('success', 'Content Removed');
    }

    public function showDeleteView() {
        $contents = Content::all();
        $str = "";
      
        foreach($contents as $content) {
            $contentId = $content->id;
            $contentName = ucwords($content->contentName);
            $contentUses = str_limit(ucfirst($content->uses), 60, '...');
            $contentHowItWorks = str_limit(ucfirst($content->howItWorks), 60, '...');
            $contentSideEffects = str_limit(ucfirst($content->sideEffects), 60, '...');
            $contentPrescription = $content->prescription;
            if(!$contentPrescription)
                $contentPrescription = 'No';
            else if($contentPrescription)
                $contentPrescription = 'Yes';

            $deleteRoute = route('content.delete.submit', ['id' => $contentId, 'admin' => 'admin',]);
            $detailRoute = route('content.detail', ['id' => $contentId, 'admin' => 'admin']);

            $token = Session::token();
            $str .= "<tr>
                        <td>$contentId</td>
                        <td>$contentName</td>
                        <td>$contentUses</td>
                        <td>$contentHowItWorks</td>
                        <td>$contentSideEffects</td>
                        <td>$contentPrescription</td>
                        <td><a href='$detailRoute' class='btn btn-primary btn-sm'>Details</a></td>
                        <td><form action='$deleteRoute' method='post'>
                                <input type='hidden' name='_token' value='$token'>             
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='submit' class='btn btn-danger btn-sm' value='Delete'>
                            </form>
                        </td>
                    </tr>";
        }
        return view('admins.contents.delete')->with(['str' => $str,]);
    }
}

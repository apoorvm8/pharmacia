<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Medicine;
use App\Content;
use App\MedicineContent;
use Session;
use DB;

// use Validator;

class MedicineController extends Controller
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
        $medicines = Medicine::all();
        $str = "";
      
        foreach($medicines as $medicine) {
            // $array = unserialize($medicine->medicineContent);
            // $medicineContent = implode(',', $array);
            $medicineId = $medicine->id;
            $medicineName = strtoupper($medicine->medicineName);
            $medicineManufacturer = ucwords($medicine->manufacturer);
            $medicineType = ucfirst($medicine->medicineType);
            $medicineRemark = $medicine->remark;
            $medicineContent = $medicine->medicineContent;
            $medicineCost = $medicine->cost;
            $medicineStock = $medicine->stock;
            $editRoute = route('medicine.edit', ['id' => $medicineId, 'admin' => 'admin',]);
            $detailRoute = route('medicine.detail', ['id' => $medicineId, 'admin' => 'admin',]);

            $str .= "<tr>
                        <td>$medicineId</td>
                        <td>$medicineName</td>
                        <td>$medicineManufacturer</td>
                        <td>$medicineType</td>
                        <td>$medicineRemark</td>
                        <td>$medicineContent</td>
                        <td>$medicineCost</td>
                        <td>$medicineStock</td>
                        <td><a href='$detailRoute' class='btn btn-primary btn-sm'>Details</a></td>
                        <td><a class='btn btn-success btn-sm' href='$editRoute'>Edit</a></td>
                    </tr>";
        }
        return view('admins.medicines.view')->with(['str' => $str]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contents = Content::all();
        return view('admins.medicines.add')->with(['contents' => $contents]);
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
            'medicineName' => 'required|string|unique:medicines',
            'manufacturer' => 'required|string',
            'medicineType' => 'required|string',
            'medicineContent' => 'required|array|min:1',
            'remark' => 'required|string',
            'cost' => 'required',
            'stock' => 'required',
            'discount' => 'numeric',
        ]);

        if($validator->fails()) {
            return redirect()->route('medicine.add', ['admin' => 'admin'])->withErrors($validator)->withInput($request->all());
        }
        $medicineContentArray = [];
        $medicineContentIds = $request->input('medicineContent');
        foreach($medicineContentIds as $medicineContentId) {
            $content = Content::find($medicineContentId);
            $contentName =  $content->contentName;
            $medicineContentArray[] = $contentName; 
        }

        $medicineContent = implode(',', $medicineContentArray);//serialize($request->input('medicineContent')
        // $medicineContent = serialize($medicineContent);

        // If validation okay, then create and save data
        $medicine = new Medicine;
        $medicine->medicineName = $request->input('medicineName');
        $medicine->manufacturer = $request->input('manufacturer');
        $medicine->medicineType = $request->input('medicineType');
        $medicine->medicineContent = ucwords($medicineContent, ',');
        $medicine->remark = $request->input('remark');
        $medicine->cost = $request->input('cost');
        $medicine->stock = $request->input('stock');
        $medicine->discount = $request->input('discount');
        $medicine->save();
        $medicineId = DB::getPdo()->lastInsertId();

        foreach($medicineContentIds as $medicineContentId) {
            DB::transaction(function() use ($medicineId, $medicineContentId) {
                $medicineContentTable = new MedicineContent;
                $medicineContentTable->medicineId = $medicineId;
                $medicineContentTable->contentId = $medicineContentId;
                $medicineContentTable->save();
            });
        }
      
        
        return redirect()->route('medicine.add', ['admin' => 'admin'])->with('success', 'Medicine Record Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $id = $request->route()->parameter('id');
        $medicine = Medicine::find($id);
        $medicineContent = $medicine->medicineContent;
       
        
        $results = DB::table('medicines')->join('medicine_contents', function($join) use($id) {
            $join->on('medicines.id', '=', 'medicine_contents.medicineId')->where('medicines.id', '=', $id);
        })->join('contents', 'medicine_contents.contentId', '=', 'contents.id')->get();

        $commonContents = Medicine::where('medicineContent', $medicineContent)->where('id', '!=', $id)->get();
       
        $commonContentsCount = $commonContents->count();
    
       
        // die(print_r($commonContents));
        return view('admins.medicines.medicineDetail')->with(['medicine' => $medicine, 'results' => $results, 'commonContents' => $commonContents, 'commonContentsCount' => $commonContentsCount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->route()->parameter('id');
        $medicine = Medicine::find($id);
        $contents = Content::all();
        $contentIds = [];
        
        foreach($contents as $content) {
            $medicineContent = MedicineContent::where('medicineId', $medicine->id)->where('contentId', $content->id)->first();
            if($medicineContent == null) {
                continue;
            }
            $contentIds[] = $medicineContent->contentId;
        }
      
        // die(print_r($contentIds));
        return view('admins.medicines.edit')->with(['medicine' => $medicine, 'contents' => $contents, 'contentIds' => $contentIds]);
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
            'medicineName' => 'required|string|unique:medicines,medicineName,'.$id,
            'manufacturer' => 'required|string',
            'medicineType' => 'required|string',
            'medicineContent' => 'required|array|min:1',
            'remark' => 'required|string',
            'cost' => 'required',
            'stock' => 'required',
            'discount' => 'numeric',
        ]);

        if($validator->fails()) {
            return redirect()->route('medicine.edit', ['admin' => 'admin', 'id' => $id])->withErrors($validator);
        }

        $medicineContentArray = [];
        $medicineContentIds = $request->input('medicineContent');
        foreach($medicineContentIds as $medicineContentId) {
            $content = Content::find($medicineContentId);
            $contentName =  $content->contentName;
            $medicineContentArray[] = $contentName; 
        }

        $medicineContent = implode(',', $medicineContentArray);

        // If validation okay, then create and save data
        $medicine = Medicine::find($id);
        $medicine->medicineName = $request->input('medicineName');
        $medicine->manufacturer = $request->input('manufacturer');
        $medicine->medicineType = $request->input('medicineType');
        $medicine->medicineContent = ucwords($medicineContent, ',');
        $medicine->remark = $request->input('remark');
        $medicine->cost = $request->input('cost');
        $medicine->stock = $request->input('stock');
        $medicine->discount = $request->input('discount');
        $medicine->save();
        // Delete all the records of a medicines content
        // die($id);
        $medicineContentTables = MedicineContent::where('medicineId', $id)->get();
        foreach($medicineContentTables as $medicineContentTable) {
            $medicineContentTable->delete();
        }
        
        // Now insert the new record
        foreach($medicineContentIds as $medicineContentId) {
            DB::transaction(function() use ($id, $medicineContentId) {
                $medicineContentTable = new MedicineContent;
                $medicineContentTable->medicineId = $id;
                $medicineContentTable->contentId = $medicineContentId;
                $medicineContentTable->save();
            });
        }

        return redirect()->route('medicine.view', ['admin' => 'admin'])->with('success', 'Medicine Record Updated');
        // die($id);
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
        $medicine = Medicine::find($id);
        $medicine->delete();

        $medicineContentTables = MedicineContent::where('medicineId', $id)->get();
        foreach($medicineContentTables as $medicineContentTable) {
            $medicineContentTable->delete();
        }

        return redirect()->route('medicine.deleteView', ['admin' => 'admin'])->with('success', 'Medicine Record Removed');
    }

    public function showDeleteView() {
        $medicines = Medicine::all();
        $str = "";
      
        foreach($medicines as $medicine) {
            // $array = unserialize($medicine->medicineContent);
            // $medicineContent = implode(',', $array);
            $medicineId = $medicine->id;
            $medicineName = strtoupper($medicine->medicineName);
            $medicineManufacturer = ucwords($medicine->manufacturer);
            $medicineType = ucfirst($medicine->medicineType);
            $medicineRemark = $medicine->remark;
            $medicineContent = $medicine->medicineContent;
            $medicineCost = $medicine->cost;
            $medicineStock = $medicine->stock;
            $deleteRoute = route('medicine.delete.submit', ['id' => $medicineId, 'admin' => 'admin',]);
            $detailRoute = route('medicine.detail', ['id' => $medicineId, 'admin' => 'admin',]);

            $token = Session::token();
            $str .= "<tr>
                        <td>$medicineId</td>
                        <td>$medicineName</td>
                        <td>$medicineManufacturer</td>
                        <td>$medicineType</td>
                        <td>$medicineRemark</td>
                        <td>$medicineContent</td>
                        <td>$medicineCost</td>
                        <td>$medicineStock</td>
                        <td><a href='$detailRoute' class='btn btn-primary btn-sm'>Details</a></td>
                        <td><form action='$deleteRoute' method='post'>
                                <input type='hidden' name='_token' value='$token'>             
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='submit' class='btn btn-danger btn-sm' value='Delete'>
                            </form>
                        </td>
                    </tr>";
        }
        return view('admins.medicines.delete')->with(['str' => $str]);
    }
}

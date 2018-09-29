<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use DB;
use App\Medicine;
use App\MedicineContent;
use App\Content;
use App\Order;
use App\DetailOrder;
use Auth;

class PassportUsersController extends Controller
{
    /**
     * This method will update the users gst and drug no. along with their images
     */
    public function uploadGstDrug(Request $request) {
        $validator = Validator::make($request->all(), [
            'gstNo' => 'nullable|unique:users',
            'gstImage' => 'image|nullable|max:5999',
            'drugNo' => 'nullable|unique:users',
            'drugImage' => 'image|nullable|max:5999',
        ]);

        
        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200); 
        }
      

        $user = Auth::user();
        if($user != null) {
            // Handle gst image upload
            if($request->hasFile('gstImage')) {
                // Get filename with the extension
                $fileNameWithExt = $request->file('gstImage')->getClientOriginalName();

                // Get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just extension
                $extension = $request->file('gstImage')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                $nameOfFolder = $user->retailerName . "_" . $user->id;
                $nameOfFolder = strtolower($nameOfFolder);
                $path = $request->file('gstImage')->storeAs("public/users/$nameOfFolder", $fileNameToStore);
            }
            
            if($request->hasFile('gstImage')) {
                $user->gstNoImage = $fileNameToStore;
            }

            // Handle drug image upload
            if($request->hasFile('drugImage')) {
                // Get filename with the extension
                $fileNameWithExt = $request->file('drugImage')->getClientOriginalName();

                // Get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just extension
                $extension = $request->file('drugImage')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                $nameOfFolder = $user->retailerName . "_" . $user->id;
                $nameOfFolder = strtolower($nameOfFolder);
                $path = $request->file('drugImage')->storeAs("public/users/$nameOfFolder", $fileNameToStore);
            }

            if($request->hasFile('drugImage')) {
                $user->drugNoImage = $fileNameToStore;
            }
            // die($request->input('gstNo'));
            $user->gstNo = $request->input('gstNo');
            $user->drugNo = $request->input('drugNo');

            $user->save();
            $response = [
                'status' => 1,
                'data' => null,
                'message' => 'Fields updated successfully',
            ];

            return response()->json($response, 200); 
        } else {
            $response = [
                'status' => -1,
                'data' => null,
                'message' => 'No such user found in record',
            ];

            return response()->json($response, 401);    
        }

    }

    /**
     * This function will retrieve all of the medicines along with their contents
     */
    public function getAllMedicines() {

        $medicines = Medicine::all(['id', 'medicineName']);
        $contents = [];
        $i = 0;
        $finalMedicine = [];
        foreach($medicines as $medicine) {
            $medicineContent = DB::table('medicines')->join('medicine_contents', function($join) use($medicine) {
                $join->on('medicines.id', '=', 'medicine_contents.medicineId')->where('medicines.id', '=', $medicine->id);
            })->join('contents', 'medicine_contents.contentId', '=', 'contents.id')->get(['contentName']);
            $medicineContent = $medicineContent->toArray(); 
            $contents[] = $medicineContent;
            $finalMedicine[] = ['id' => $medicine->id, 'medicineName' => $medicine->medicineName, 'content' => $contents[$i]];
            $i++;
        }
    
 
        $response = [
            'status' => 1,
            'data' => [
                'medicines' => $finalMedicine,
            ],
        ];

        return response()->json($response, 200);
    }

    /**
     * This function will fetch a single medicine based on the id provided.
     */
    public function getSingleMedicine(Request $request) {
    
       
        // Extract the id from request.
        $id = $request->route()->parameter('id');

        $medicine = Medicine::find($id);
        if($medicine == null) {
            $response = [
                'status' => -3,
                'data' => null,
                'message' => 'Record not found.',
            ];

            return response()->json($response, 200);
        } else {
            // Get the full details of medicine through join
            $medicineContent = $medicine->medicineContent;

            $results = DB::table('medicines')->join('medicine_contents', function($join) use($id) {
                $join->on('medicines.id', '=', 'medicine_contents.medicineId')->where('medicines.id', '=', $id);
            })->join('contents', 'medicine_contents.contentId', '=', 'contents.id')->get(['contentName', 'uses', 'howItWorks', 'sideEffects', 'prescription']);

            $resultsArray = $results->toArray(); 
            foreach($resultsArray as $element) {
                $element->uses = strip_tags($element->uses);
                $element->howItWorks = strip_tags($element->howItWorks);
                $element->sideEffects = strip_tags($element->sideEffects);
            }

            $commonContents = Medicine::where('medicineContent', $medicineContent)->where('id', '!=', $id)->take(4)->get(['id', 'medicineName', 'manufacturer']);

            $commonContentsArray = $commonContents->toArray();
            $commonContentsCount = $commonContents->count();

            $finalMedicine[] = ['id' => $medicine->id, 'medicineName' => $medicine->medicineName, 'manufacturer' => $medicine->manufacturer, 'remark'=> $medicine->remark, 'content' => $resultsArray, 'substituentMedicine' => $commonContents];

            $response = [
                'status' => 1,
                'data' => [
                    'medicine' => $finalMedicine,
                ],
            ];
    
            return response()->json($response, 200);
        }
    }

    /**
    *  This is the function for the orders 
    */
    public function order(Request $request) {
        if($request->expectsJson()) {
            $totalAmount = 0;

            $id = $request->json("userId");
            $products = $request->json("product");
            $address = $request->json("address");
            $order = new Order;
            $order->userId = $id;
            $order->houseNo = $address["houseNo"];
            $order->streetName = $address["streetName"];
            $order->city = $address["city"];
            $order->state = $address["state"];
            $order->pincode = $address["pincode"];
            $order->landmark = $address["landmark"];
            $order->save();

            $orderId = DB::getPdo()->lastInsertId();

            // Detail Order
            foreach($products as $product) {
                $detailOrder = new DetailOrder;
                $medicine = Medicine::find($product["productId"]);

                $detailOrder->orderId = $orderId;
                $detailOrder->productId = $product["productId"];
                // Calculate the cost after discount.
                $rate = ($medicine->cost - ($medicine->cost * ($medicine->discount/100))) * $product["quantity"];
                $detailOrder->rate = $rate;
                $detailOrder->quantity = $product["quantity"];
                $totalAmount += $detailOrder->rate;
                $detailOrder->save();
            }

            $order = Order::find($orderId);
            $order->totalAmount = $totalAmount;
            $order->save();

        } else {
        }
    }
}

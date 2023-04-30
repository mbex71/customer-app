<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionContextPass;
use App\Models\Customer;
use PhpParser\Node\Stmt\TryCatch;

class CustomerController extends Controller
{
    public function index()
    {
        $title = 'List Customer';
        $listCustomers = Customer::all();
        $genders = ['Male' => 'Male', 'Female' => 'Female'];
        return view('pages.customer.index', compact('title', 'listCustomers', 'genders'));
    }

    public function ajaxCustomer(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Custom search filter 
        $searchGender = $request->get('searchGender');
        
        // Total records
        $records = Customer::select('count(*) as allcount');

        ## Add custom filter conditions
        if(!empty($searchGender)){
            $records->where('gender', 'like', '%'.$searchGender.'%');
        }
        $totalRecords = $records->count();

        // Total records with filter
        $records = Customer::select('count(*) as allcount')->where('gender', 'like', '%'.$searchGender.'%');

        ## Add custom filter conditions
        if(!empty($searchGender)){
            $records->where('gender', 'like', '%'.$searchGender.'%');
        }
        $totalRecordswithFilter = $records->count();

        // Fetch records
        $records = Customer::orderBy($columnName, $columnSortOrder)
            ->where('gender', 'like', '%'.$searchValue.'%');
        ## Add custom filter conditions
        if(!empty($searchGender)){
            $records->where('gender', 'like', '%'.$searchGender.'%');
        }
        $data_customer = $records->skip($start)
            ->take($rowperpage)
            ->get();

        $no = $start;
        $data_arr = array();
        foreach($data_customer as $row_customer){
            $no++;

            $id = $row_customer->id;
            $gender = $row_customer->gender;
            $age = $row_customer->age;
            $income = $row_customer->income;
            $spending_score = $row_customer->spending_score;
            $profession = $row_customer->profession;
            $work_experience = $row_customer->work_experience;
            $family_size = $row_customer->family_size;
            
            $data_arr[] = array(
                "id" => $no,
                "gender" => $gender,
                "age" => $age,
                "income" => $income,
                "spending_score" => $spending_score,
                "profession" => $profession,
                "work_experience" => $work_experience,
                "family_size" => $family_size,
                "aksi" => '',
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function create()
    {
        $title = 'Add Customer';
        return view('pages.customer.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $customer = new Customer();
            $customer->gender = $request->input('gender');
            $customer->age = $request->input('age');
            $customer->income = $request->input('income');
            $customer->spending_score = $request->input('spending_score');
            $customer->profession = $request->input('profession');
            $customer->work_experience = $request->input('work_experience');
            $customer->family_size = $request->input('family_size');
            $customer->save();
    
            return redirect('customer')->with('success', 'Customer added successfully.');
    
        } catch (\Exception $th) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to add customer. ' . $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $title = 'Edit Customer';
        $customer = Customer::find($id);
        return view('pages.customer.edit', compact('title', 'customer'));
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::find($id);
            $customer->gender = $request->input('gender');
            $customer->age = $request->input('age');
            $customer->income = $request->input('income');
            $customer->spending_score = $request->input('spending_score');
            $customer->profession = $request->input('profession');
            $customer->work_experience = $request->input('work_experience');
            $customer->family_size = $request->input('family_size');
            $customer->save();
    
            return redirect('customer')->with('success', 'Customer updated successfully.');
    
        } catch (\Exception $th) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update customer. ' . $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return redirect('customer')->with('success', 'Data deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete data!. Error : '.$th->getMessage());
        }
    
    }

}

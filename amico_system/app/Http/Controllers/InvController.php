<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use res\js\asset_information;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class InvController extends Controller
{
    public function showDashboard()
    {
        // $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $output->writeln(request('password'));

        $number = request('number');

        $role = DB::table('users')
            ->where('contact_no', $number)
            ->select('role')
            ->first(); //retrieve the first record (row) that matches the query criteria

        // Access the "role" property of the $role object and convert it to a string
        $roleAsString = $role->role;

        if ($roleAsString == "admin") {
            return redirect("admin/asset_info");
        } else if ($roleAsString == "employee") {
            return redirect("employee/asset_info");
        } else {
        }
    }


    public function uploadCsvFile(Request $request)
    {
        // dd('Reached uploadCsvFile method'); // Add this line

        // Validate the uploaded file
        $request->validate([
            'csvFile' => 'required|mimes:csv', // Validation rule
        ]);

        // Store the file in the designated folder
        $request->file('csvFile')->storeAs('public/files', 'new.csv');


        $csvData = [];

        try {
            $filePath = 'public/files/new.csv';

            // Open the file for reading
            $handle = fopen(storage_path('app/' . $filePath), 'r');

            if ($handle !== false) {
                $index = 0;
                $csvData = [];

                while (($data = fgetcsv($handle)) !== false) {
                    if ($index >= 7) {
                        // Process each row of data
                        $csvData[] = $data;
                    }
                    $index = $index + 1;
                }

                fclose($handle);
            } else {
                // Error opening the file
                Log::error('Error opening CSV file');
            }
        } catch (\Exception $e) {
            // Handle any other exceptions that may occur
            Log::error('An exception occurred: ' . $e->getMessage());
        }



        $csvData = (array)$csvData;
        Log::info($csvData);

        for ($num = 0; $num < sizeof($csvData); $num++) {
            DB::insert(
                'insert into receiving_report 
                ( po_no, serial_no, funded_by, rs_no) 
                values (?,?,?,?)',
                [$csvData[$num][15], $csvData[$num][8], $csvData[$num][19], $csvData[$num][22]]
            );
        }
        return redirect("employee/receiving_repo");


        // Log::info('File path: ' . $path); // Log the file path

        // // Check if the file exists in the storage
        // if (Storage::disk('public')->exists($path)) {
        //     // File has been successfully captured
        //     Log::info('File captured successfully.');
        //     return back()->with('success', 'File uploaded successfully.');
        // } else {
        //     // File not found, handle the error
        //     Log::error('Failed to capture the file.');
        //     return back()->with('error', 'Failed to capture the file.');
        // }

        // $this->addToTable();
    }

    // public function addToTable()
    // {
    //     $dataFromController = 'Your data here';
    //     return view('asset_info', compact('dataFromController'));
    // }


    // public function showReceiving(){
    //     $results = DB::select('select * from receiving_report');
    //     Log::info(count((array)$results));
    //     $results = (array)$results;
    //     Log::info($results);
    //     if(){
    //         return view('emp/receiving_repo', compact('results')); 
    //     }else if (){
    //         return view('emp/receiving_repo', compact('results')); 
    //     }
    // }

    public function addEntry(Request $request)
    {
        Log::info($request->input('model'));
        DB::insert(
            'INSERT INTO receiving_report 
            (rr_no, rr_date, po_no, po_date, asset_desc, funded_by, rs_no, rs_date, doc_no, date_rec, 
            from_loc, from_don, date_acq, user_id, serial_no, unit, brand, model, qty, req_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $request->input('rrNumber'),
                \DateTime::createFromFormat('Y-m-d', $request->input('rrDate')) // Convert the string to a DateTime object
                    ->format('Y-m-d'), // Format the DateTime object
                $request->input('poNo'),
                \DateTime::createFromFormat('Y-m-d', $request->input('poDate')) // Convert the string to a DateTime object
                    ->format('Y-m-d'), // Format the DateTime object
                $request->input('assetDesc'),
                $request->input('fundedBy'),
                $request->input('rsNo'),
                \DateTime::createFromFormat('Y-m-d', $request->input('rsDate')) // Convert the string to a DateTime object
                    ->format('Y-m-d'), // Format the DateTime object
                $request->input('docNo'),
                \DateTime::createFromFormat('Y-m-d', $request->input('dateRec')) // Convert the string to a DateTime object
                    ->format('Y-m-d'), // Format the DateTime object)
                $request->input('location'),
                $request->input('donator'),
                \DateTime::createFromFormat('Y-m-d', $request->input('dateAcq')) // Convert the string to a DateTime object
                    ->format('Y-m-d'), // Format the DateTime object
                $request->input('receivedBy'),
                $request->input('serialNo'),
                $request->input('unit'),
                $request->input('brand'),
                $request->input('model'),
                $request->input('qty'),
                'pending'
            ]
        );

        if ($request->input('user') === 'admin') {
            return redirect("admin/receiving_repo");
        } else {
            return redirect("employee/receiving_repo");
        }
    }

    public function acceptRequest(Request $request)
    {
        $number = $request->input('serial_no');

        DB::table('receiving_report')
            ->where('serial_no', $number)
            ->update(['req_status' => 'accepted']);

        return redirect("admin/pending");
    }

    public function declineRequest(Request $request)
    {
        $number = $request->input('serial_no');

        DB::table('receiving_report')
            ->where('serial_no', $number)
            ->update(['req_status' => 'declined']);

        return redirect("admin/pending");
    }

    public function editAsset(Request $request)
    {
        $number = $request->input('serial_no');

        if ($request->input('user_id') != null) {
            DB::table('receiving_report')
                ->where('serial_no', $number)
                ->update([
                    'rr_no' => $request->input('rr_no'),
                    'rs_date' => $request->input('rs_date'),
                    'doc_no' => $request->input('doc_no'),
                    'date_rec' => $request->input('date_rec'),
                    'from_loc' => $request->input('from_loc'),
                    'from_don' => $request->input('from_don'),
                    'date_acq' => $request->input('date_acq'),
                    'user_id' => $request->input('user_id')
                ]);
        } else {
            DB::table('receiving_report')
                ->where('serial_no', $number)
                ->update([
                    'rr_no' => $request->input('rr_no'),
                    'rr_date' => $request->input('rr_date'),
                    'po_no' => $request->input('po_no'),
                    'po_date' => $request->input('po_date'),
                    'serial_no' => $request->input('serial_no'),
                    'asset_desc' => $request->input('asset_desc'),
                    'funded_by' => $request->input('funded_by'),
                    'rs_no' => $request->input('rs_no')
                ]);
        }


        if ($request->input('user') === 'admin') {
            return redirect("admin/receiving_repo");
        } else {
            if ($request->input('req_status') === 'pending') {
                return redirect("employee/pending");
            } else {
                return redirect("employee/receiving_repo");
            }
        }
    }
}

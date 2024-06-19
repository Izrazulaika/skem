<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penalty;
use App\Models\BorrowRecord;
use Illuminate\Support\Facades\Auth;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::with('borrowRecord.student', 'borrowRecord.borrowItems.book')->get();

        return view('penalties.index', compact('penalties'));
    }

    public function create(Request $request)
    {
        $lateBorrowRecords = BorrowRecord::where('borrow_status', 'In Borrowed')
            ->where('borrow_end_date', '<', now())
            ->get();

        return view('penalties.create', compact('lateBorrowRecords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'borrow_record_id' => 'required|exists:borrow_records,id',
            'amount' => 'required|numeric|min:0',
            'remark' => 'nullable|string',
            'status' => 'required|string|in:Pending,Paid,Waived',
        ]);

        $penalty = new Penalty();
        $penalty->borrow_record_id = $request->borrow_record_id;
        $penalty->amount = $request->amount;
        $penalty->remark = $request->remark;
        $penalty->status = $request->status;
        $penalty->save();

        return redirect()->route('penalties.index')->with('success', 'Penalty created successfully.');
    }

    public function edit(Penalty $penalty)
    {
        return view('penalties.edit', compact('penalty'));
    }

    public function update(Request $request, Penalty $penalty)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'remark' => 'required|string|max:255',
            'status' => 'required|in:Pending,Paid,Waived',
        ]);

        $penalty->update($request->all());

        return redirect()->route('penalties.index')->with('success', 'Penalty updated successfully.');
    }

    public function destroy(Penalty $penalty)
    {
        $penalty->delete();
        return redirect()->route('penalties.index')->with('success', 'Penalty deleted successfully.');
    }

    public function parentIndex()
    {
        // Get the current authenticated user (assuming it's the parent)
        $parent = Auth::user();

        // Retrieve all students associated with the parent
        $students = $parent->students;
        // Initialize an empty array to store penalties
        $penalties = [];

        // Retrieve penalties for each student
        foreach ($students as $student) {
            // Retrieve borrow records for the current student
            $borrowRecords = $student->borrowRecords;

            // Loop through each borrow record
            foreach ($borrowRecords as $borrowRecord) {
                // Retrieve penalties associated with the current borrow record
                $borrowPenalties = $borrowRecord->penalties;

                // Loop through each penalty and add borrowRecord data
                foreach ($borrowPenalties as $penalty) {
                    // Add borrowRecord data to the penalty
                    $penalty->load('borrowRecord.student', 'borrowRecord.borrowItems.book');

                    // Merge penalty into the main array
                    $penalties[] = $penalty->toArray();
                }
            }
        }

        // Pass penalties data to the view
        return view('penalties.view', compact('penalties'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\BorrowItem;
use App\Models\Penalty;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $borrowRecords = BorrowRecord::with('student', 'borrowItems.book')->paginate(6);
        $page = $borrowRecords->currentPage();
        return view('borrow.index', compact('borrowRecords', 'page'));
    }


    public function create()
    {
        return view('borrow.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if($request->input('book_ids') === null) {
            return redirect()->back()->with('error', 'Failed to create borrow record. Please select book to borrow.');
        }
        try {
            // Start a transaction
            \DB::beginTransaction();

            // Generate unique reference number
            $refNumber = BorrowRecord::generateUniqueRefNumber();

            // Create a new borrow record
            $borrowRecord = BorrowRecord::create([
                'ref_number' => $refNumber,
                'student_id' => $request->input('sid'),
                'borrow_start_date' => $request->input('borrow_date'),
                'borrow_end_date' => $request->input('due_date'),
                'borrow_status' => 'In Borrowed',
            ]);

            // Create borrow items
            foreach ($request->input('book_ids') as $bookId) {
                BorrowItem::create([
                    'borrow_record_id' => $borrowRecord->id,
                    'book_id' => $bookId,
                ]);
            }

            // Commit the transaction
            \DB::commit();

            return redirect()->route('borrow.create')->with('success', 'New borrow record created successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction on error
            \DB::rollBack();
            Log::error('Failed to create borrow record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create borrow record. Please try again.');
        }
    }

    public function searchStudent(Request $request)
    {
        $studentId = $request->input('student_id');
        $student = Student::where('student_id', $studentId)->with('parent')->first();

        if ($student) {
            return response()->json([
                'success' => true,
                'student' => $student,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No student found.',
            ]);
        }
    }

    public function listBooks(Request $request)
    {
        $standard = $request->input('standard');
        $books = Book::join('categories', 'books.category_id', '=', 'categories.id')
        ->where('categories.name', '=', $standard)
        ->select('books.*', 'categories.name as category_name')
        ->get();
        return response()->json($books);
    }

    public function edit(BorrowRecord $borrow)
    {
        $borrow = $borrow->load('student.parent.userDetail', 'borrowItems.book.category');
        $parentDetail = $borrow->student->parent->userDetail;

        return view('borrow.edit', compact('borrow', 'parentDetail'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'borrow_start_date' => 'required|date',
            'borrow_end_date' => 'required|date|after:borrow_start_date',
            'borrow_status' => 'required|string',
        ]);

        try {
            // Find the borrow record
            $borrowRecord = BorrowRecord::findOrFail($id);

            // Check if the borrow status is being updated to "Returned"
            if ($request->input('borrow_status') === 'Returned') {
                // Check if the record exists in the penalty table with status "Pending"
                $existingPenalty = Penalty::where('borrow_record_id', $id)->where('status', 'Pending')->exists();
                if ($existingPenalty) {
                    return redirect()->back()->with('error', 'This borrow record not yet clear the penalties!');
                }
            }

            // Update the borrow record
            $borrowRecord->update([
                'borrow_start_date' => $request->input('borrow_start_date'),
                'borrow_end_date' => $request->input('borrow_end_date'),
                'borrow_status' => $request->input('borrow_status'),
            ]);

            return redirect()->route('borrow.index')->with('success', 'Borrow record updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update borrow record. Please try again.');
        }
    }

    public function destroy(BorrowRecord $borrow)
    {
        $borrow->delete();

        return redirect()->route('borrow.index')->with('success', 'Borrow record deleted successfully.');
    }
}

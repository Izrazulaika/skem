<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Student;
use App\Models\BorrowRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Initialize variables to store data
        $totalBooks = Book::count();
        $totalStudents = Student::count();
        $booksInBorrowed = 0;
        $booksLateReturn = 0;

        // Check the role of the logged-in user
        if ($user->role === 'parent') {
            // If the user is a parent, count the borrowed records of students under the parent account
            $studentIds = $user->students()->pluck('id');
            $booksInBorrowed = BorrowRecord::whereIn('student_id', $studentIds)
                ->where('borrow_status', 'In Borrowed')
                ->count();

            $booksLateReturn = BorrowRecord::whereIn('student_id', $studentIds)
                ->where('borrow_status', 'In Borrowed')
                ->where('borrow_end_date', '<', Carbon::now())
                ->count();
        } else {
            // If the user is not a parent, count all borrowed records
            $booksInBorrowed = BorrowRecord::where('borrow_status', 'In Borrowed')->count();
            $booksLateReturn = BorrowRecord::where('borrow_status', 'In Borrowed')
                ->where('borrow_end_date', '<', Carbon::now())
                ->count();
        }

        return view('dashboard', compact('totalBooks', 'totalStudents', 'booksInBorrowed', 'booksLateReturn'));
    }
}

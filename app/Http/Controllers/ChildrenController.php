<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\BorrowItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $students = $user->students()->orderBy('standard', 'asc')->paginate(6);
        $page = $students->currentPage();
        return view('children.index', compact('students', 'page'));
    }

    public function parentRecord()
    {
        $user = Auth::user();
        $borrowRecords = BorrowRecord::whereIn('student_id', $user->students->pluck('id'))
                                         ->with('student', 'borrowItems.book')
                                         ->paginate(6);
        $page = $borrowRecords->currentPage();
        return view('children.parentRecord', compact('borrowRecords', 'page'));
    }

    public function edit(BorrowRecord $borrow)
    {
        $borrow = $borrow->load('student.parent.userDetail', 'borrowItems.book.category');
        $parentDetail = $borrow->student->parent->userDetail;

        return view('children.recordDetail', compact('borrow', 'parentDetail'));
    }

}


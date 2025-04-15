<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EbookController extends Controller
{
    /**
     * Display a listing of available ebooks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the authenticated student
        $student = Auth::guard('online')->user();
        
        // Logic to get all available ebooks for the student
        // This is a placeholder - implement actual ebooks retrieval logic
        $ebooks = [
            [
                'id' => 1,
                'title' => 'English Grammar in Use',
                'author' => 'Raymond Murphy',
                'description' => 'A self-study reference and practice book for intermediate learners of English',
                'cover' => 'english-grammar-in-use.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Advanced English Vocabulary',
                'author' => 'John Smith',
                'description' => 'Expand your vocabulary with advanced English terms and expressions',
                'cover' => 'advanced-vocabulary.jpg'
            ],
        ];
        
        return view('online.ebooks.index', compact('ebooks'));
    }

    /**
     * Display the specified ebook.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Get the authenticated student
        $student = Auth::guard('online')->user();
        
        // Logic to get specific ebook by ID
        // This is a placeholder - implement actual ebook retrieval logic
        $ebook = null; // Replace with actual ebook retrieval
        
        return view('online.ebooks.show', compact('ebook'));
    }
} 
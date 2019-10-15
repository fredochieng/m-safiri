<?php

namespace App\Http\Controllers;
use App\Models\Reviews\Review;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $data['reviews'] = Review::getReviews();
        return view('reviews.index')->with($data);
    }

}

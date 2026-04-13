<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatternHistory;

class PatternHistoryController extends Controller
{
    public function store(Request $request){
        
        $request->validate([
            'pattern' => 'required|exists:patterns,id',
        ]);

        $latestPattern = PatternHistory::latest()->first();

        if(!$latestPattern || $latestPattern->pattern_id != $request->pattern){
            PatternHistory::create([
                'pattern_id' => $request->pattern,
            ]);

            return redirect()->back()
            ->with('success', 'Pattern has been successfully changed');
        }

        return redirect()->back();
    }
}

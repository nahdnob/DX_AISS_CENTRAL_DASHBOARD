<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MarqueeText;

class MarqueeTextController extends Controller{
	
	public function update(Request $request){

		$request->validate([
			'text' => 'required|string|max:255',
		]);

		$marquee = MarqueeText::first();

		if (!$marquee) {
			$marquee = new MarqueeText();
		}

		$marquee->text = $request->text;
		$marquee->save();

		return response()->json(['success' => true, 'message' => 'Teks berhasil diperbarui!']);
	}
}

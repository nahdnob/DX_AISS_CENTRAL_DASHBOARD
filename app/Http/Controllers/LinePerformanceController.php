<?php

namespace App\Http\Controllers;

use App\Models\LinePerformance;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

class LinePerformanceController extends Controller
{
	public static function index() {
		
		$currentYear = now()->year;
			$lastYear 	 = $currentYear - 1;
		$months = [
				'December', 'January', 'February', 'March', 'April', 
				'May', 'June', 'July', 'August', 'September', 'October', 'November'
		];

		$linePerformance = LinePerformance::where(function($query) use ($currentYear, $lastYear) {
									$query->where('year', $lastYear)
										->where('month', 'December')
										->orWhere(function($q) use ($currentYear) {
																					$q->where('year', $currentYear)
																						->whereIn('month', [
																							'January', 'February', 'March', 'April',
																							'May', 'June', 'July', 'August',
																							'September', 'October', 'November'
																						]);
										});
								})
								->orderByRaw("FIELD(month, '" . implode("','", $months) . "') asc")
								->get();
		return $linePerformance;
	}

	public function search(Request $request)
	{
		$q     = $request->q;
		$group = $request->group;

		$query = LinePerformance::query();

		if ($q) {
			$query->where(function ($q2) use ($q) {
				$q2->where('month', 'like', "%$q%")
				->orWhere('year', 'like', "%$q%");
			});
		}

		if ($group === 'month') {
			$query->selectRaw('month, SUM(target) as target, SUM(actual) as actual')
				->groupBy('month');
		}

		if ($group === 'year') {
			$query->selectRaw('year, SUM(target) as target, SUM(actual) as actual')
				->groupBy('year');
		}

		if ($group === 'month_year') {
			$query->selectRaw('month, year, SUM(target) as target, SUM(actual) as actual')
				->groupBy('month', 'year');
		}

		return response()->json($query->get());
	}

	public function create(){ 	

		return view('components.line-performance.create');
	}

	public function store(Request $request):RedirectResponse{
		//validate form
		$request->validate([
			'line-performance-month'  => 'required|string',
			'line-performance-year'   => 'required|string',
			'line-performance-target' => 'required|regex:/^\d+(\.\d{1,2})?$/',
			'line-performance-actual' => 'required|regex:/^\d+(\.\d{1,2})?$/',
		]);

		$targetValue = str_replace(',', '.', $request->input('line-performance-target'));
		$actualValue = str_replace(',', '.', $request->input('line-performance-actual'));

		//create product
		LinePerformance::create([
			'month'         => $request->input('line-performance-month'),
			'year'          => $request->input('line-performance-year'),
			'target'        => $targetValue,
			'actual'        => $actualValue
		]);

		//redirect to dashboard
		return redirect()->route('dashboards.index')->with(['success' => 'Data Berhasil Disimpan!']);
	}

	public function edit(string $id)
	{
		//get product by ID
		$linep = LinePerformance::findOrFail($id);

		//return JSON response
		return response()->json($linep);
	}

	public function update(Request $request, $id):RedirectResponse{
		
		// Validasi input
		$request->validate([
			'linePerformanceEditMonth'  => 'required|string',
			'linePerformanceEditYear'   => 'required|string',
			'linePerformanceEditTarget' => 'required|regex:/^\d+(\.\d{1,2})?$/',
			'linePerformanceEditActual' => 'required|regex:/^\d+(\.\d{1,2})?$/',
		]);
		

		// Mengambil produk berdasarkan ID dan memperbarui datanya
		$linep = LinePerformance::findOrFail($id);

		$targetValue = str_replace(',', '.', $request->input('linePerformanceEditTarget'));
		$actualValue = str_replace(',', '.', $request->input('linePerformanceEditActual'));

		$linep->update([
			'month'  => $request->input('linePerformanceEditMonth'),
			'year'   => $request->input('linePerformanceEditYear'),
			'target' => $targetValue,
			'actual' => $actualValue,
		]);

		// Redirect atau mengembalikan respon setelah update
		return redirect()->route('products.index')->with('success', 'Data updated successfully.');
	}

	public function destroy($id){
		
		$linePerformance = LinePerformance::findOrFail($id);
    $linePerformance->delete();

    return redirect()->route('dashboard.index')->with('success', 'Data berhasil dihapus.');
	}
}

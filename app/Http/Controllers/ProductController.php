<?php

namespace App\Http\Controllers;

//import model
use App\Models\Product;
use App\Models\LinePerformance;
use App\Models\Ncd;

use Carbon\Carbon;

//import return type View
use Illuminate\View\View;

class ProductController extends Controller
{

  public static function index(): View {

    // Mendapatkan isi file
    $productIn        = ProductController::products_in();
    $productOut       = ProductController::products_out();
    $products         = ProductController::products_show(); // Menggunakan array_reverse() jika diperlukan
    $bestRecord       = ProductController::best_record();
    $linePerformances = LinePerformance::orderBy('year', 'desc')
    ->orderByRaw("FIELD(month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December') DESC")
    ->paginate(4);
    $marqueeText      = MarqueeTextController::index();

    // Kirim kedua kumpulan data ke view
    return view('dashboard', [
      'products'         => $products,
      'best_record'      => $bestRecord,
      'linePerformances' => $linePerformances,  // Data performa lini dari database
      'title'            => 'LINE 2', // Sesuaikan judulnya
      'marqueeText'      => $marqueeText,
    ]);
  }

  public static function fetchProductsTable() {
    $productIn  = self::products_in();
    $productOut = self::products_out();
    $products   = self::products_show();
    return view('partials.products-table', compact('products'));
  }

  public static function time_1($currentTime){
    $currentTime->modify('-1 day'); // Mengurangi 1 hari dari waktu saat ini
    $day        = $currentTime->format('d');
    $month      = $currentTime->format('n');
    $year       = $currentTime->format('Y');
    $filePath   = '\\\192.168.2.5\\Users\\ADMIN\\Documents\\Pokayoke\\DATA\\' . $year . '\\' . $month . '\\' . $day . '\\NIGHT\\PRODUCTION DATA\\Data Scan.txt';
    return $filePath;
  }

  public static function time_2(){
    // Mendapatkan tahun, bulan, dan hari saat ini
    $year     = date('Y'); // Mendapatkan tahun sekarang (2024)
    $month    = date('n'); // Mendapatkan bulan sekarang (tanpa leading zero, misalnya '9')
    $day      = date('d'); // Mendapatkan hari sekarang (tanpa leading zero, misalnya '27')
    $filePath = '\\\192.168.2.5\\Users\\ADMIN\\Documents\\Pokayoke\\DATA\\' . $year . '\\' . $month . '\\' . $day . '\\DAY\\PRODUCTION DATA\\Data Scan.txt';
    return $filePath;
  }

  public static function time_3(){
    $year     = date('Y');
    $month    = date('n');
    $day      = date('d');
    $filePath = '\\\192.168.2.5\\Users\\ADMIN\\Documents\\Pokayoke\\DATA\\' . $year . '\\' . $month . '\\' . $day . '\\NIGHT\\PRODUCTION DATA\\Data Scan.txt';
    return $filePath;
  }

  public static function time_4($currentTime){
    $currentTime->modify('-1 day');
    $day        = $currentTime->format('d');
    $month      = $currentTime->format('n');
    $year       = $currentTime->format('Y');
    $filePath   = '\\\192.168.2.1\\Users\\User\\Documents\\IGS\\' . $year . '\\' . $month . '\\' . $day . '\\NIGHT\\KANBAN DATA\\Data.txt';
    return $filePath;
  }

  public static function time_5(){
    $year     = date('Y');
    $month    = date('n');
    $day      = date('d');
    $filePath = '\\\192.168.2.1\\Users\\User\\Documents\\IGS\\' . $year . '\\' . $month . '\\' . $day . '\\DAY\\KANBAN DATA\\Data.txt';
    return $filePath;
  }

  public static function time_6(){
    $year     = date('Y');
    $month    = date('n');
    $day      = date('d');
    $filePath = '\\\192.168.2.1\\Users\\User\\Documents\\IGS\\' . $year . '\\' . $month . '\\' . $day . '\\NIGHT\\KANBAN DATA\\Data.txt';
    return $filePath;
  }

  public static function time_in_check(){
    $currentTime = new \DateTime();
    $currentHourMinute = $currentTime->format('H:i'); // Format waktu menjadi jam dan menit (contoh: 14:30)

    // Definisikan batasan waktu
    $midnight = new \DateTime('00:00');
    $morning  = new \DateTime('07:30');
    $evening  = new \DateTime('20:30');
    $endOfDay = new \DateTime('23:59');

    // Periksa waktu dan lakukan perintah berdasarkan rentang waktu
    if ($currentHourMinute >= $midnight->format('H:i') && $currentHourMinute < $morning->format('H:i')) {
      // Jika jam antara 00:00 dan 07:30
      return self::time_1($currentTime); // Ganti dengan perintah/fungsi yang diinginkan

    } elseif ($currentHourMinute >= $morning->format('H:i') && $currentHourMinute < $evening->format('H:i')) {
      // Jika jam antara 07:30 dan 20:30
      return self::time_2(); // Ganti dengan perintah/fungsi yang diinginkan

    } elseif ($currentHourMinute >= $evening->format('H:i') && $currentHourMinute <= $endOfDay->format('H:i')) {
      // Jika jam antara 20:30 dan 00:00
      return self::time_3(); // Ganti dengan perintah/fungsi yang diinginkan
    }
  }

  public static function time_out_check(){
    $currentTime       = new \DateTime();
    $currentHourMinute = $currentTime->format('H:i');
    $midnight          = new \DateTime('00:00');
    $morning           = new \DateTime('07:30');
    $evening           = new \DateTime('20:30');
    $endOfDay          = new \DateTime('23:59');

    if ($currentHourMinute >= $midnight->format('H:i') && $currentHourMinute < $morning->format('H:i')) {
      return self::time_4($currentTime);

    } elseif ($currentHourMinute >= $morning->format('H:i') && $currentHourMinute < $evening->format('H:i')) {
      return self::time_5();

    } elseif ($currentHourMinute >= $evening->format('H:i') && $currentHourMinute <= $endOfDay->format('H:i')) {
      return self::time_6();
    }
  }

  public static function products_in() {
    //$filePath = self::time_in_check();
    $filePath = 'C:\bon&\data_in.txt';
    //dd($filePath);

    if (file_exists($filePath)){
      $content  = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $lastLine = end ($content); // Mengambil baris terakhir

      if ($lastLine){
        $subLastLine = preg_split('/[\t\s]+/', $lastLine); // Memisahkan berdasarkan tab dan spasi
        $timeIn      = isset($subLastLine[0])  ? trim($subLastLine[0])          : null;
        $partNumber  = isset($subLastLine[3])  ? substr($subLastLine[3], 0, 13) : null;
        $pcbId       = isset($subLastLine[9])  ? trim($subLastLine[9])          : null;
        $status      = isset($subLastLine[11]) ? trim($subLastLine[11])         : null;
        $product     = Product::orderBy('created_at', 'desc')->first();
        $qty         = 2;

        if (!$product && $status == 'OK' || ($product && $product->pcb_id != $pcbId && $status == 'OK')){
          while ($qty > 0){
            Product::create([
              'time_in'     => $timeIn,
              'part_number' => $partNumber,
              'pcb_id'      => $pcbId,
              'qty_in'      => 1,
            ]);
            $qty --;
          }
  
        } else {
          return [];
        }

      } else {
        echo "<script>console.error('Data tidak ditemukan: {$lastLine}');</script>";
        return [];
      }

    } else {
      echo "<script>console.error('File tidak ditemukan: {$filePath}');</script>";
      return [];
    }
  }

  public static function products_out(){
    //$filePath = self::time_out_check();
    $filePath = 'B:\bon&\data_out.txt';
    //dd($filePath);

    if (file_exists($filePath)) {
      $content     = file ($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $lastLine    = end  ($content);

      if ($lastLine){
        $subLastLine = preg_split('/[\t\s]+/', $lastLine);
        $timeOut     = isset($subLastLine[0]) ? trim($subLastLine[0]) : null;

        if ($timeOut) {
          $timeOut = str_replace('.', ':', $timeOut); // Ubah format waktu dari 2.03.16 menjadi 2:03:16
        }

        $qty         = isset($subLastLine[6])  ? trim($subLastLine[6])          : null;
        $partNumber  = isset($subLastLine[9])  ? substr($subLastLine[9], 0, 13) : null;
        $kanbanId    = isset($subLastLine[14]) ? trim($subLastLine[14])         : null;
        $status      = isset($subLastLine[17]) ? trim($subLastLine[17])         : null;
        $product     = Product::where('qty_out', 1)->orderBy('updated_at', 'desc')->first();

        if (!$product){
          while ($qty > 0){ 
            $product = Product::where  ('qty_out', 0)        // Filter berdasarkan qty_out = 0
                              ->where  ('part_number', $partNumber)
                              ->orderBy('created_at', 'asc') // Urutkan berdasarkan yang terlama (asc)
                              ->first  ();                   // Ambil data pertama

            if ($product && $status == 'OK'){ 
              $product -> time_out  = $timeOut;
              $product -> kanban_id = $kanbanId;
              $product -> qty_out   = 1;
              $product -> save();
              $qty --;

            } else {
              return [];
            }
          }

        } else {
          if ($product->kanban_id != $kanbanId && $status == 'OK'){
            while ($qty > 0){
              $product = Product::where  ('qty_out', 0)        // Filter berdasarkan qty_out = 0
                                ->where  ('part_number', $partNumber)
                                ->orderBy('created_at', 'asc') // Urutkan berdasarkan yang terlama (asc)
                                ->first  ();                   // Ambil data pertama

              if ($product && $status == 'OK'){
                $product -> time_out = $timeOut;
                $product -> kanban_id = $kanbanId;
                $product -> qty_out  = 1;
                $product -> save();
                $qty --;
    
              } else {
                return[];
              }
            }
          }
        }

      } else {
        echo "<script>console.error('Data tidak ditemukan: {$lastLine}');</script>";
        return [];
      }

    } else {
      echo "<script>console.error('File tidak ditemukan: {$filePath}');</script>";
      return [];
    }
  }

  public static function products_show(){
    $products = ProductController::products_show_status();
    $grouped  = [];

    if (empty($products)) {
      return $grouped;
    }

    $currentPartNumber  = $products[0]['part_number'];
    $currentTimeIn      = $products[0]['time_in'];
    $currentDate        = $products[0]['created_at'];
    $currentStatus      = $products[0]['status'];
    $currentCount       = 1;

    for ($i = 1; $i < count($products); $i++) {
      if ($products[$i]['part_number'] !== $currentPartNumber || $products[$i]['status'] !== $currentStatus) {
        // Simpan produk dengan part number dan status sebelumnya ke dalam grouped
        $grouped[] = [
          'part_number' => $currentPartNumber,
          'quantity'    => $currentCount,
          'time_in'     => $currentTimeIn,
          'created_at'  => $currentDate,
          'status'      => $currentStatus
        ];

        // Reset variabel untuk produk baru
        $currentPartNumber  = $products[$i]['part_number'];
        $currentTimeIn      = $products[$i]['time_in'];
        $currentDate        = $products[$i]['created_at'];
        $currentStatus      = $products[$i]['status'];
        $currentCount       = 1; // Reset hitungan ke 1 untuk produk baru

      } else {
        // Jika part number dan status sama, tambahkan quantity
        $currentCount++;
      }
    }

    // Tambahkan produk terakhir yang sedang diproses ke dalam grouped array
    $grouped[] = [
      'part_number' => $currentPartNumber,
      'quantity'    => $currentCount,
      'time_in'     => $currentTimeIn,
      'created_at'  => $currentDate,
      'status'      => $currentStatus
    ];

    return $grouped;
  }

  public static function products_show_status(){
    $products = Product::where('qty_out', 0)->OrderBy('created_at', 'desc')->get();
    $grouped  = [];
    $count    = 1;

    if (empty($products)) {
      return $grouped;
    }

    foreach ($products as $product) {
      $partNumber = $product['part_number'];
      $quantity   = $product['quantity']; 
      $timeIn     = $product['time_in'];
      $date       = $product['created_at'];
      $id         = $product['id'];

      // Tentukan status berdasarkan nilai $count
      if ($count <= 100) {
        $status = 'SUB ASSY';
      } elseif ($count > 100 && $count <= 340) {
        $status = 'PREHEAT';
      } elseif ($count > 340 && $count <= 580) {
        $status = 'HARDENING';
      } elseif ($count > 580 && $count <= 700) {
        $status = 'INSPECTION';
      }  else {
        $currentProduct = Product::where('qty_out', 0)->where('id', $id)->first();

        if ($currentProduct) {
          $latestProduct = Product::where('qty_out', 0)
                                  ->orderBy('created_at', 'desc')
                                  ->select('created_at')
                                  ->first();

          if ($latestProduct) {
            // Parse waktu untuk perhitungan
            $latestTime  = \Carbon\Carbon::parse($latestProduct->created_at);
            $currentTime = \Carbon\Carbon::parse($currentProduct->created_at);
            // Hitung selisih waktu dalam jam
            $timeDiff    = $currentTime->diffInHours($latestTime);

            if ($timeDiff > 24) {
              $currentProduct->qty_out = -1;
              $currentProduct->save();

            } else {
              $status = 'INSPECTION';
            }
          }
        }
      }
        
      // Tambahkan data produk yang sudah diproses ke dalam array $grouped
      $grouped[] = [
        'part_number' => $partNumber,
        'quantity'    => $quantity,
        'time_in'     => $timeIn,
        'created_at'  => $date,
        'status'      => $status
      ];

      $count += 1;

    }
    return $grouped;
  }

  public static function best_record()
  {
      $dates = Ncd::pluck('date');

      $lastDay = Ncd::orderBy('date', 'desc')->value('date');

      if (!$lastDay) {
        return null;
      }

      $lastDay = Carbon::parse($lastDay);
      $today   = Carbon::now();

      // ⬇️ Hitung SELISIH HARI KERJA (Senin–Jumat)
      $daysDifference = $lastDay->diffInWeekdays($today);

      return [
        'dates'     => $dates,
        'last_day'  => $lastDay,
        'day_count' => (int) $daysDifference,
      ];
  }

}
<x-layout>
  <x-slot:title>
    <span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-200 to-red-700 italic">AISS </span>
    <span class="font-semibold">{{ $title }}</span>
  </x-slot:title>
  <div class="mx-auto max-w-7xl px-4 py-4">
    <div class="w-full flex flex-col gap-4 sm:flex-row">
      <div class="w-[500px] flex flex-col gap-3">
        <div class=" w-full flex flex-row gap-4">
          <!-- Best Record -->
          <div class="flex items-center justify-center">
            <div class="w-full p-4 bg-yellow-50 border border-2 border-yellow-200 rounded-lg shadow-lg dark:border-red-700">
              <div class="flex flex-row items-center justify-center">
                <svg class="w-[35px] h-[35px] md:w-[50px] md:h-[50px]" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M39.37 18.432c0 3.058-.906 5.862-2.466 8.203a14.728 14.728 0 0 1-10.079 6.367c-.717.127-1.455.19-2.214.19-.759 0-1.497-.063-2.214-.19a14.728 14.728 0 0 1-10.078-6.368 14.692 14.692 0 0 1-2.467-8.202c0-8.16 6.6-14.76 14.76-14.76s14.759 6.6 14.759 14.76Z" stroke="rgb(234 88 12)" stroke-width="3.473" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="m44.712 38.17-3.431.83a2.063 2.063 0 0 0-1.539 1.572l-.728 3.122c-.09.384-.281.734-.554 1.012a2.068 2.068 0 0 1-.992.564c-.375.09-.768.073-1.134-.052a2.078 2.078 0 0 1-.938-.653l-9.92-11.64-9.92 11.661a2.078 2.078 0 0 1-.938.653 2.038 2.038 0 0 1-1.134.052 2.067 2.067 0 0 1-.992-.563 2.137 2.137 0 0 1-.554-1.012l-.728-3.123a2.13 2.13 0 0 0-.55-1.01 2.06 2.06 0 0 0-.988-.562L6.24 38.19a2.073 2.073 0 0 1-.956-.533 2.14 2.14 0 0 1-.563-.953 2.175 2.175 0 0 1-.015-1.113c.091-.366.276-.7.536-.97l8.11-8.284a14.672 14.672 0 0 0 4.307 4.281 14.34 14.34 0 0 0 5.634 2.134 12.29 12.29 0 0 0 2.183.191c.749 0 1.477-.063 2.184-.19 4.138-.617 7.694-3.017 9.94-6.416l8.11 8.285c1.144 1.147.583 3.165-.998 3.547Zm-18.03-26.532 1.227 2.507c.167.34.603.68.998.743l2.226.383c1.414.233 1.747 1.296.727 2.336l-1.726 1.764c-.29.297-.457.87-.353 1.295l.499 2.188c.395 1.721-.5 2.4-1.996 1.487l-2.08-1.253a1.434 1.434 0 0 0-1.372 0l-2.08 1.253c-1.497.892-2.392.234-1.996-1.487l.499-2.188c.083-.403-.063-.998-.354-1.295l-1.726-1.764c-1.019-1.04-.686-2.081.728-2.336l2.225-.383c.375-.063.811-.403.977-.743l1.227-2.507c.604-1.36 1.685-1.36 2.35 0Z" stroke="rgb(234 88 12)" stroke-width="3.473" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <p class="font-bold text-3xl sm:text-4xl lg:text-5xl leading-9 text-primary ml-2">{{ $best_record['day_count'] }}</p>
              </div>
              <p class="font-semibold text-lg leading-6 mt-3 text-center">BEST RECORD</p>
              <p class="font-medium text-sm text-center text-gray-400">No Claim since </p>
              <a href="javascript:void(0)" id="openCardClaim">
                <p class="font-bold text-sm text-center text-blue-600">{{ $best_record['last_day']->format('d M Y') }}</p>
              </a>
            </div>
          </div>
          <!-- Calender -->
          <div class="bg-gray-100 flex items-center justify-center h-60 rounded-lg">
            <div class="w-full h-full">
              <div class="bg-white shadow-lg rounded-lg overflow-hidden h-full flex flex-col">
                <div class="flex items-center justify-between px-4 py-2 bg-gray-700">
                  <button id="prevMonth" class="text-white text-[10px]">Previous</button>
                  <h2 id="currentMonth" class="text-white text-[10px]"></h2>
                  <button id="nextMonth" class="text-white text-[10px]">Next</button>
                </div>
                <div class="grid grid-cols-7 gap-2 p-2 flex-grow overflow-auto" id="calendar">
                  <!-- Calendar Days Go Here -->
                </div>
                <div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                  <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>
                  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                      <div class="flex justify-between items-center pb-3">
                          <p class="text-2xl font-bold">Selected Date</p>
                          <button id="closeModal" class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
                      </div>
                      <div id="modalDate" class="text-xl font-semibold"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Line Performance -->
        <div class="w-[425px] bg-white rounded-lg shadow-lg flex flex-col">
          <div class="w-full max-w-2xl mx-auto">
            <header class="px-2 py-2 bg-gray-700 rounded-t-lg border-b border-gray-100 flex justify-between items-center">
              <div class="flex flex-row gap-2">
                <h2 class="font-semibold text-white text-sm">LINE PERFORMANCE</h2>
                <span class="font-semibold text-white text-sm">'{{date('y')}}</span>
              </div>
              <!-- Modal Add - Line Performance -->
              <a href="javascript:void(0)" id="openAddLinePerformance">
                <svg class="w-6 h-6 text-gray-400 dark:text-white hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
              </a>
            </header>
            <div class="relative overflow-x-auto">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-2 py-2">Month</th>
                    <th scope="col" class="px-2 py-2">Target</th>
                    <th scope="col" class="px-2 py-2">Actual</th>
                    <th scope="col" class="px-2 py-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                @forelse ($linePerformances as $linePerformance)
                  <tr class="odd:bg-white even:bg-gray-50 odd:dark:bg-gray-900 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{\Carbon\Carbon::parse($linePerformance->month)->format('M')}} '{{substr($linePerformance->year, -2)}}</th>
                    <td class="px-4 py-2 font-semibold text-xs">{{ $linePerformance->target }}%</td>
                    <td class="px-4 py-2 font-semibold text-xs {{ $linePerformance->actual >= $linePerformance->target ? : 'text-red-500' }}">{{ $linePerformance->actual }}%</td>
                    <td class="px-4 py-2">
                      <a href="javascript:void(0)" onclick="openEditLinePerformance({{ $linePerformance->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                  </tr>
                @empty
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <!-- Line Performance - Footer -->
          <div class="relative overflow-hidden bg-white rounded-b-lg shadow-md dark:bg-gray-800">
            <nav class="flex flex-col items-start justify-between p-1 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
              <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing
                <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                  of 
                <span class="font-semibold text-gray-900 dark:text-white">1000</span>
              </span>
              <ul class="inline-flex items-stretch -space-x-px">
                <li>
                  <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Previous</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                </li>
                <li>
                  <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                </li>
                <li>
                  <a href="#" aria-current="page" class="z-10 flex items-center justify-center px-3 py-2 text-sm leading-tight border text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                </li>
                <li>
                  <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                </li>
                <li>
                  <a href="#" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                </li>
                <li>
                  <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Next</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="w-full">
        <!-- WORK IN PROGRESS -->
        <div class="h-[515px] bg-white shadow-lg rounded-lg border-red-300 dark:border-gray-600 overflow-auto">
          <div id="tampil">
            @include('partials.products-table', ['products' => $products])
          </div>
        </div>
      </div>
    </div>

    <footer class="relative">
      <div class="container mx-auto px-4 pt-1">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
          <div class="w-full md:w-6/12 px-4 mx-auto text-center">
            <div class="text-base text-gray-500  py-1">Dibuat dengan
              <span class="text-gray-900">IKHLAS</span> by
              <span class="text-red-700">b&</span>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <div class="fixed bottom-0 left-0 right-0 bg-[#fff333] text-white text-3xl w-[100%] h-10 pt-1">
      <div id="animate-marquee" contenteditable="true" class="text-red-500 whitespace-nowrap animate-marquee">
        {{ $marqueeText->text ?? 'Klik di sini untuk mengedit teks berjalan ini.' }}
      </div>
    </div>

    <div id="myCardClaim" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
      <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>
      <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
          <div class="flex justify-between items-center pb-3">
            <div></div>
            <button id="closeCardClaim" class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
          </div>
          @include('components.card-profile.index')
        </div>
      </div>
    </div>

    <!-- Modal Line Performance - Add -->
    <div id="myCardProfile" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
      <div class="relative top-44 mx-auto px-6 py-6 text-center border w-96 shadow-lg rounded-md bg-white lg:mt-0 xl:px-10">
        <button id="closeCardProfile" class="modal-close absolute top-2 right-2 px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>  
        @include('components.card-profile.index')
      </div>
    </div>

    <!-- Modal Line Performance - Add -->
    <div id="myAddLinePerformance" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <button id="closeAddLinePerformance" class="modal-close absolute top-2 right-2 px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>  
        @include('components.line-performance.create')
      </div>
    </div>

    <!-- Modal Line Performance - Edit -->
    <div id="myEditLinePerformance" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <button onclick="hideEditLinePerformance()" class="modal-close absolute top-2 right-2 px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">&times;</button>       
        @isset($linePerformance)
          @include('components.line-performance.edit', ['id' => $linePerformance->id])
        @endisset
      </div>
    </div>

  </div>
  
  <script>
    document.getElementById('animate-marquee').addEventListener('blur', function() {
      let newText = this.innerText;

      fetch("{{ route('marqueeText.update') }}", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ text: newText })
      })
      .then(response => response.json())
      .then(data => {
        console.log(data);
        if (data.success) {
          alert(data.message);
        } else {
          alert('Gagal memperbarui teks.');
        }
      })
      .catch(error => console.error('Error:', error));
    });
  </script>
  <script>
    // Fungsi untuk memperbarui waktu setiap detik
    function updateClock() {
      const now = new Date();
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      const timeString = `${hours}:${minutes}:${seconds}`;

      // Format tanggal (dd/mm/yyyy)
      const day = String(now.getDate()).padStart(2, '0');
      const month = String(now.getMonth() + 1).padStart(2, '0'); // +1 karena bulan dimulai dari 0
      const year = now.getFullYear();
      const dateString = `${day}/${month}/${year}`;

      document.getElementById("current-time").textContent = timeString;
      document.getElementById("current-date").textContent = dateString;
    }

    // Panggil fungsi updateClock setiap 1 detik
    setInterval(updateClock, 1000);
    updateClock(); // Panggil segera saat halaman dimuat
  </script>
  <style>
    @keyframes marquee {
      from { transform: translateX(100%); }
      to { transform: translateX(-100%); }
    }
    .animate-marquee {
      display: inline-block;
      animation: marquee 15s linear infinite;
      white-space: nowrap; /* Menghindari pemotongan teks */
    }
  </style>
  <script>
    document.getElementById('marqueeText').addEventListener('click', function() {
      // Fokuskan elemen untuk mempermudah pengeditan
      this.focus();
    });
  </script>
  <script>CKEDITOR.replace('animate-marquee');</script>
  <script>
    function showModal()
    {
      const modal = document.getElementById('myCardClaim');
      modal.classList.remove('hidden');
    }
    function hideModal()
    {
      const modal = document.getElementById('myCardClaim');
      modal.classList.add('hidden');
    }
    document.getElementById('openCardClaim').addEventListener('click', showModal);
    document.getElementById('closeCardClaim').addEventListener('click', hideModal);
  </script>
  <script>
    function showModal()
    {
      const modal = document.getElementById('myCardProfile');
      modal.classList.remove('hidden');
    }
    function hideModal()
    {
      const modal = document.getElementById('myCardProfile');
      modal.classList.add('hidden');
    }
    document.getElementById('openCardProfile').addEventListener('click', showModal);
    document.getElementById('closeCardProfile').addEventListener('click', hideModal);
  </script>
  <script>
    // Function to show the modal
    function showModal() {
      const modal = document.getElementById('myAddLinePerformance');
      modal.classList.remove('hidden');
    }
    // Function to hide the modal
    function hideModal() {
      const modal = document.getElementById('myAddLinePerformance');
      modal.classList.add('hidden');
    }
    // Add event listener to open modal button
    document.getElementById('openAddLinePerformance').addEventListener('click', showModal);
    // Add event listener to close modal button
    document.getElementById('closeAddLinePerformance').addEventListener('click', hideModal);
  </script>
  <script>
    function openEditLinePerformance(linepId) {
    console.log('Requesting data for linep ID:', linepId);

    fetch(`/linePerformance/edit/${linepId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Data tidak ditemukan atau terjadi kesalahan pada server.');
        }
        return response.json();
      })
      .then(data => {
        console.log('Data fetched successfully:', data);

        document.getElementById("linePerformanceEditMonth").value = data.month;
        document.getElementById("linePerformanceEditYear").value = data.year;
        document.getElementById("linePerformanceEditTarget").value = data.target;
        document.getElementById("linePerformanceEditActual").value = data.actual;
        const modalElement = document.getElementById("myEditLinePerformance");

        document.getElementById("editLinePerformanceForm").setAttribute('action', `/linePerformance/update/${linepId}`);
        document.getElementById("deleteLinePerformanceForm").setAttribute('action', `/linePerformance/destroy/${linepId}`);

        // Tampilkan modal
        if (modalElement) {
          modalElement.classList.remove('hidden'); // Hapus kelas `hidden` untuk menampilkan modal
        } else {
          console.error('Modal element not found');
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        alert('Gagal memuat data. Silakan coba lagi.');
      });
    }

    // Fungsi untuk menutup modal
    function hideEditLinePerformance() {
      const modalElement = document.getElementById("myEditLinePerformance");
      if (modalElement) {
        modalElement.classList.add('hidden'); // Tambahkan kelas `hidden` untuk menyembunyikan modal
      }
    }
  </script>
  <script>
    // Function to generate the calendar for a specific month and year
    function generateCalendar(year, month) {
      const calendarElement = document.getElementById('calendar');
      const currentMonthElement = document.getElementById('currentMonth');
      
      // Create a date object for the first day of the specified month
      const firstDayOfMonth = new Date(year, month, 1);
      const daysInMonth = new Date(year, month + 1, 0).getDate();
      
      // Clear the calendar
      calendarElement.innerHTML = '';

      // Set the current month text
      const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      currentMonthElement.innerText = `${monthNames[month]} ${year}`;
      
      // Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
      const firstDayOfWeek = firstDayOfMonth.getDay();

      // Create headers for the days of the week
      const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      daysOfWeek.forEach(day => {
        const dayElement = document.createElement('div');
        dayElement.className = 'text-center font-semibold text-[10px]';
        dayElement.innerText = day;
        calendarElement.appendChild(dayElement);
      });

      // Create empty boxes for days before the first day of the month
      for (let i = 0; i < firstDayOfWeek; i++) {
        const emptyDayElement = document.createElement('div');
        calendarElement.appendChild(emptyDayElement);
      }

      const ncdDates = @json($best_record['dates']);

      // Parsing tanggal dari ncdDates yang dikirim dari controller
      const parsedNcdDates = ncdDates.map(date => new Date(date));

      // Skrip untuk kalender
      for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'text-center py-1 border cursor-pointer text-[10px]';
        dayElement.innerText = day;

        // Membuat objek tanggal untuk hari ini
        const thisDate = new Date(year, month, day);

        // Memeriksa apakah tanggal ini adalah hari ini
        const currentDate = new Date();
        if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
          dayElement.classList.add('bg-cyan-400', 'text-white'); // Menandai hari saat ini
        }

        // Memeriksa apakah tanggal ini ada di dalam `parsedNcdDates` untuk memberinya warna merah
        if (parsedNcdDates.some(ncdDate => 
          ncdDate.getFullYear() === thisDate.getFullYear() &&
          ncdDate.getMonth() === thisDate.getMonth() &&
          ncdDate.getDate() === thisDate.getDate()
        )) {
          dayElement.classList.add('bg-red-500', 'text-white'); // Menandai tanggal dari database
        }

        // Memeriksa apakah thisDate lebih kecil dari hari ini dan bukan salah satu dari `parsedNcdDates`
        if (thisDate < currentDate && !parsedNcdDates.some(ncdDate => 
          ncdDate.getFullYear() === thisDate.getFullYear() &&
          ncdDate.getMonth() === thisDate.getMonth() &&
          ncdDate.getDate() === thisDate.getDate()
        )) {
          dayElement.classList.add('bg-green-400', 'text-white'); // Menandai tanggal yang tidak sama dan lebih kecil dari hari ini
        }
        calendarElement.appendChild(dayElement);
      }
    }

    // Initialize the calendar with the current month and year
    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    generateCalendar(currentYear, currentMonth);

    // Event listeners for previous and next month buttons
    document.getElementById('prevMonth').addEventListener('click', () => {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      generateCalendar(currentYear, currentMonth);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      generateCalendar(currentYear, currentMonth);
    });

    // Function to show the modal with the selected date
    function showModal(selectedDate) {
      const modal = document.getElementById('myModal');
      const modalDateElement = document.getElementById('modalDate');
      modalDateElement.innerText = selectedDate;
      modal.classList.remove('hidden');
    }

    // Function to hide the modal
    function hideModal() {
      const modal = document.getElementById('myModal');
      modal.classList.add('hidden');
    }

    // Event listener for date click events
    const dayElements = document.querySelectorAll('.cursor-pointer');
    dayElements.forEach(dayElement => {
      dayElement.addEventListener('click', () => {
        const day = parseInt(dayElement.innerText);
        const selectedDate = new Date(currentYear, currentMonth, day);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = selectedDate.toLocaleDateString(undefined, options);
        showModal(formattedDate);
      });
    });

    // Event listener for closing the modal
    document.getElementById('closeModal').addEventListener('click', () => {
      hideModal();
    });
  </script>
  <script>
    $(document).ready(function(){
    setInterval(function(){
      $.ajax({
        url: '{{ route("products.fetchTable") }}',
        method: 'GET',
        success: function(data) {
          $('#tampil').html(data);
        },
        error: function(xhr, status, error) {
          console.log("Error: " + xhr.status + " " + xhr.statusText);
        }
      });
    }, 10000); // Refresh setiap 3 detik
    });
  </script>
	<script>
		//message with sweetalert
		@if(session('success'))
			Swal.fire({
				icon: "success",
				title: "BERHASIL",
				text: "{{ session('success') }}",
				showConfirmButton: false,
				timer: 2000
			});
		@elseif(session('error'))
			Swal.fire({
				icon: "error",
				title: "GAGAL!",
				text: "{{ session('error') }}",
				showConfirmButton: false,
				timer: 2000
			});
		@endif
	</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-layout>
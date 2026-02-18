<div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded border border-gray-200">
  <header class="px-2 py-3.5 border-b border-gray-100 flex justify-between items-center">
    <h2 class="font-semibold text-gray-800 text-base">LINE PERFORMANCE<br>
      <span class="font-semibold text-gray-800 text-base">'{{ date('y') }}</span>
    </h2>

    <!-- Tombol Pemicu Modal Line Performance - Add -->
    <a href="javascript:void(0)" id="openAddLinePerformance">
      <svg class="w-6 h-6 text-gray-400 dark:text-white hover:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
      </svg>
    </a>
  </header>
  <div class="w-full max-w-full">
    <table class="table-fixed w-full">
      <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-100 h-6">
        <tr>
          <th class="w-1/4 pl-2">
            <div class="font-semibold text-center text-xs">MONTH</div>
          </th>
          <th class="w-1/4 pl-2">
            <div class="font-semibold text-center text-xs">TARGET</div>
          </th>
          <th class="w-1/4 pl-2">
            <div class="font-semibold text-center text-xs">ACTUAL</div>
          </th>
          <th class="w-1/4 pl-2">
            <div class="font-semibold text-center text-xs">EDIT</div>
          </th>
        </tr>
      </thead>
      <tbody class="text-sm divide-y divide-gray-100">

        @php
          $emptyRows = 12 - $lineps->count();
        @endphp

        @forelse ($lineps as $linep)

        <tr class="h-9">
          <td class="w-1/4 pl-3 whitespace-normal">
            <div class="text-sm text-left font-medium">{{ \Carbon\Carbon::parse($linep->month)->format('M') }}</div>
          </td>
          <td class="w-1/4 pl-2 whitespace-normal">
            <div class="text-xs text-center font-semibold">{{ $linep->target }} %</div>
          </td>
          <td class="w-1/4 pl-2 whitespace-normal">
            <div class="text-xs font-semibold {{ $linep->actual >= $linep->target ? 'text-black' : 'text-red-500' }} text-center">{{ $linep->actual }} %</div>
          </td>
          <td class="w-1/4 pl-5 whitespace-normal">
            
            <!-- Tombol Pemicu Modal Line Performance - Edit -->
            <a href="javascript:void(0)" onclick="openEditLinePerformance({{ $linep->id }})">
              <svg class="text-gray-400 hover:text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
              </svg>
            </a>
          </td>
        </tr>

        @empty
          @for ($i = 0; $i < 12; $i++)

        <tr>
          <td class="p-1 whitespace-normal">
            <div class="text-[10px] text-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">
            <div class="text-[10px] text-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">
            <div class="text-[10px] text-green-500 text-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">
            <div class="flex items-center justify-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">&nbsp;</td>
        </tr>

          @endfor
        @endforelse

        {{-- Menampilkan sisa baris kosong jika data kurang dari 12 --}}
        @for ($i = 0; $i < $emptyRows; $i++)

        <tr>
          <td class="p-1 whitespace-normal">
            <div class="text-[10px] text-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">
            <div class="text-[10px] text-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">
            <div class="text-[10px] text-green-500 text-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">
            <div class="flex items-center justify-center">&nbsp;</div>
          </td>
          <td class="p-1 whitespace-normal">&nbsp;</td>
        </tr>

        @endfor

      </tbody>
    </table>
  </div>
</div>
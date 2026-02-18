@if (count($products) > 0)

<table class="w-full min-w-max table-auto text-left">
	<thead>
		<tr>
			<th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
				<p class="antialiased font-sans text-base text-blue-gray-900 flex items-center justify-between gap-2 font-bold leading-none opacity-70">PART NUMBER
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
					</svg>
				</p>
			</th>
			<th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
				<p class="antialiased font-sans text-base text-blue-gray-900 flex items-center justify-between gap-2 font-bold leading-none opacity-70">TIME IN
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
					</svg>
				</p>
			</th>
			<th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
				<p class="antialiased font-sans text-base text-blue-gray-900 flex items-center justify-between gap-2 font-bold leading-none opacity-70">QTY IN
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
					</svg>
				</p>
			</th>
			<th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
				<p class="antialiased font-sans text-base text-blue-gray-900 flex items-center justify-between gap-2 font-bold leading-none opacity-70">STATUS
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
					</svg>
				</p>
			</th>
			<th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
				<p class="antialiased font-sans text-base text-blue-gray-900 flex items-center justify-between gap-2 font-bold leading-none opacity-70">ESTIMATE
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
					</svg>
				</p>
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($products as $product)
			<tr>
				<td class="p-4 border-b border-blue-gray-50">
					<div class="flex items-center gap-3">
						<div class="flex flex-col">
							<p class="block antialiased font-sans text-lg leading-normal text-blue-gray-900 font-normal">{{ $product['part_number'] }}</p>
						</div>
					</div>
				</td>
				<td class="p-4 border-b border-blue-gray-50">
					<div class="flex items-center gap-3">
						<div class="flex flex-col">
							<p class="block antialiased font-sans text-lg leading-normal text-blue-gray-900 font-normal">{{ \Carbon\Carbon::parse($product['time_in'])->format('H:i:s') }}</p>
							<p class="block antialiased font-sans text-xs leading-normal text-blue-gray-900 font-normal opacity-70">Date: {{ \Carbon\Carbon::parse($product['time_in'])->format('j F Y') }}</p>
						</div>
					</div>
				</td>
				<td class="p-4 border-b border-blue-gray-50">
					<div class="flex flex-col">
						<p class="block antialiased font-sans text-center text-lg leading-normal text-blue-gray-900 font-normal">{{ $product['quantity'] }}</p>
					</div>
				</td>
				<td class="p-4 border-b border-blue-gray-50">
					<div class="w-max">
						@php
							$bgColorClass  = match($product['status']) {

								'SUB ASSY'   => 'bg-green-500/20 text-green-600',
								'PREHEAT'    => 'bg-yellow-500/20 text-yellow-600',
								'HARDENING'  => 'bg-orange-500/20 text-orange-600',
								'INSPECTION' => 'bg-blue-500/20 text-blue-600',
								'HILANG' => 'bg-blue-500/20 text-blue-600',
								default      => 'bg-gray-500/20 text-gray-600',
							};
						@endphp
						<div class="relative grid items-center font-sans font-bold uppercase whitespace-nowrap select-none {{ $bgColorClass }} py-1 px-2 text-xs rounded-md" style="opacity: 1;">
							<span class="">{{$product['status']}}</span>
						</div>
					</div>
				</td>
				<td class="p-4 border-b border-blue-gray-50">
					<div class="flex items-center gap-3">
						<div class="flex flex-col">
							<p class="block antialiased font-sans text-lg leading-normal text-blue-gray-900 font-normal">{{ \Carbon\Carbon::parse($product['time_in'])->add(new DateInterval('PT4H'))->format('H:i') }}</p>
							<p class="block antialiased font-sans text-xs leading-normal text-blue-gray-900 font-normal opacity-70">Date: {{$product['created_at']->add(new DateInterval('PT4H'))->format('j F Y') }}</p>
						</div>
					</div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-danger text-center text-red-600">
	TIDAK ADA PRODUK DI WIP!
</div>
@endif
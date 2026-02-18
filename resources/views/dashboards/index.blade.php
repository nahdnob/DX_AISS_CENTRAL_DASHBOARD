@extends('layouts.app')

@section('content')
	@php
		$pageTitle = '
			<span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-200 to-red-700 italic">AISS </span>
			<span class="font-semibold">'.$title.'</span>
		';
	@endphp
	<div class="mx-auto max-w-7xl px-4 py-4">
		<div class="w-full flex flex-col gap-4 sm:flex-row">
			<div class="w-[500px] flex flex-col gap-3">
				{{-- Best Records --}}
				<div class="w-full flex justify-center">
					<!-- Outer Card -->
					<div class="min-w-80 w-auto p-1 rounded-[28px] bg-gradient-to-r from-yellow-300 via-orange-400 to-yellow-300 shadow-xl">
						<!-- Inner Card -->
						<div class="w-full p-5 bg-yellow-50 rounded-3xl">
							<div class="flex items-center justify-center gap-2">
								<svg class="w-[50px] h-[50px] md:w-[75px] md:h-[75px]" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M39.37 18.432c0 3.058-.906 5.862-2.466 8.203a14.728 14.728 0 0 1-10.079 6.367c-.717.127-1.455.19-2.214.19-.759 0-1.497-.063-2.214-.19a14.728 14.728 0 0 1-10.078-6.368 14.692 14.692 0 0 1-2.467-8.202c0-8.16 6.6-14.76 14.76-14.76s14.759 6.6 14.759 14.76Z" stroke="rgb(234 88 12)" stroke-width="3.473" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="m44.712 38.17-3.431.83a2.063 2.063 0 0 0-1.539 1.572l-.728 3.122c-.09.384-.281.734-.554 1.012a2.068 2.068 0 0 1-.992.564c-.375.09-.768.073-1.134-.052a2.078 2.078 0 0 1-.938-.653l-9.92-11.64-9.92 11.661a2.078 2.078 0 0 1-.938.653 2.038 2.038 0 0 1-1.134.052 2.067 2.067 0 0 1-.992-.563 2.137 2.137 0 0 1-.554-1.012l-.728-3.123a2.13 2.13 0 0 0-.55-1.01 2.06 2.06 0 0 0-.988-.562L6.24 38.19a2.073 2.073 0 0 1-.956-.533 2.14 2.14 0 0 1-.563-.953 2.175 2.175 0 0 1-.015-1.113c.091-.366.276-.7.536-.97l8.11-8.284a14.672 14.672 0 0 0 4.307 4.281 14.34 14.34 0 0 0 5.634 2.134 12.29 12.29 0 0 0 2.183.191c.749 0 1.477-.063 2.184-.19 4.138-.617 7.694-3.017 9.94-6.416l8.11 8.285c1.144 1.147.583 3.165-.998 3.547Zm-18.03-26.532 1.227 2.507c.167.34.603.68.998.743l2.226.383c1.414.233 1.747 1.296.727 2.336l-1.726 1.764c-.29.297-.457.87-.353 1.295l.499 2.188c.395 1.721-.5 2.4-1.996 1.487l-2.08-1.253a1.434 1.434 0 0 0-1.372 0l-2.08 1.253c-1.497.892-2.392.234-1.996-1.487l.499-2.188c.083-.403-.063-.998-.354-1.295l-1.726-1.764c-1.019-1.04-.686-2.081.728-2.336l2.225-.383c.375-.063.811-.403.977-.743l1.227-2.507c.604-1.36 1.685-1.36 2.35 0Z" stroke="rgb(234 88 12)" stroke-width="3.473" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
								<p class="text-6xl font-extrabold">
									{{ $best_record['day_count'] }}
								</p>
							</div>
							<p class="text-3xl font-extrabold italic text-center tracking-wide">BEST RECORD</p>
							<p class="text-base font-medium text-center text-gray-400">No Claim since</p>
							<a href="javascript:void(0)" id="openCardClaim" class="block text-sm font-bold text-center text-orange-600 hover:underline">
								{{ $best_record['last_day']->format('d M Y') }}
							</a>
						</div>
					</div>
				</div>
				<!-- Modal Line Performance - Edit -->
				<div class="mt-4 w-full flex flex-col">
					<!-- Judul Utama -->
					<div class="w-full flex justify-center items-center mb-4">
						<p class="text-xl font-bold uppercase">Line Performance</p>
					</div>
					<!-- 3 Kolom -->
					<div class="w-full grid grid-cols-1 md:grid-cols-3 gap-4">
						@foreach ($linePerformances as $item)
							<!-- Kolom 1 -->
							<div class="flex flex-col items-center border rounded-lg shadow-lg p-4">
								<p class="mb-2 font-bold uppercase">{{ date('M', strtotime($item->month)) }} '{{ substr($item->year, -2) }}</p>
								<img src="{{ $item->target > $item->actual ? asset('img/sad2.png') : asset('img/smile.png') }}" alt="Line A" class="w-36 h-32 object-contain mt-2 mb-3">
								<p class="text-xl font-bold {{ $item->target > $item->actual ? 'text-red-600' : 'text-green-600' }}">{{ $item->actual }}%</p>
							</div>
						@endforeach
					</div>
				</div>
			</div>

			{{-- <div class="w-full">
				<!-- WORK IN PROGRESS -->
				<div class="h-[515px] bg-white shadow-lg rounded-lg border-red-300 dark:border-gray-600 overflow-auto">
					<div id="tampil">
						@include('dashboards.partials.product-table', ['products' => $products])
					</div>
				</div>
			</div> --}}

			{{-- Still working on this part... --}}
			<div class="w-full">
				<div class="h-[515px] bg-white shadow-lg rounded-lg overflow-hidden">
					<div id="default-carousel" class="relative w-full h-full" data-carousel="slide" data-carousel-interval="15000">
						<!-- Carousel wrapper -->
						<div class="relative h-full overflow-hidden">
							<!-- Item 1 : TABLE -->
							<div class="hidden h-full duration-700 ease-in-out" data-carousel-item>
								<div class="h-full overflow-auto p-3">
									@include('dashboards.partials.product-table', [
										'products' => $products
									])
								</div>
							</div>
							<!-- Item 2 : contoh lain -->
							<div class="hidden h-full duration-700 ease-in-out" data-carousel-item>
								<div class="h-full  flex items-center justify-center">
									<div class="h-full overflow-auto p-2">
										<form id="pattern-form" method="POST" action="" class="flex gap-4 items-center">
											@csrf
											<select name="pattern" class="bg-white border border-gray-400 text-gray-700 font-semibold text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block p-2.5">
												@foreach ($patterns as $pattern)
													<option value="{{ $pattern->id }}" {{ $patternId == $pattern->id ? 'selected' : '' }}>
														{{ $pattern->name }}
													</option>
												@endforeach
											</select>
											<button data-popover-target="popover-applypat-right" data-popover-placement="right" type="submit" class="bg-slate-400 font-bold text-white text-md px-5 py-2.5 rounded-md hover:brightness-110 transition">APPLY</button>
											<div data-popover id="popover-applypat-right" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
												<div class="px-3 py-1 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
													<h3 class="font-semibold text-gray-900 dark:text-white">Apply Pattern</h3>
												</div>
												<div class="px-3 py-1">
													<p>Pilih pattern yang ingin diterapkan</p>
												</div>
												<div data-popper-arrow></div>
											</div>
										</form>
										{{-- Average Chart --}}
										<div class="flex bg-white p-4 my-4 rounded-md h-[420px] w-[850px]">
											<canvas id="chart_main"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Indicators -->
						<div class="absolute z-30 flex -translate-x-1/2 bottom-3 left-1/2 space-x-3">
							<button data-carousel-slide-to="0" class="w-3 h-3 rounded-full bg-gray-300"></button>
							<button data-carousel-slide-to="1" class="w-3 h-3 rounded-full bg-gray-300"></button>
						</div>
						<!-- Prev -->
						<button data-carousel-prev
							class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4">
							<span class="text-gray-500 text-2xl">‹</span>
						</button>
						<!-- Next -->
						<button data-carousel-next
							class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4">
							<span class="text-gray-500 text-2xl">›</span>
						</button>

					</div>

				</div>
			</div>

		</div>
		{{-- Still working on this part... --}}

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
		<div class="fixed bottom-0 left-0 right-0 h-10 pt-1 bg-[#fff333] text-white text-3xl w-full">
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
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.4.0/dist/chartjs-plugin-annotation.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

	<script> // Main Chart

        let chart_main    = null;
		let chartRendered = false;

		// DATA (nanti dari backend / AJAX)
		const tactTime     = 20;
		const dataAverage  = @json(array_map(fn($v) => round($v, 2), $cycleTimeData['average']));
		const dataMax      = @json(array_map(fn($v) => round($v, 2), $cycleTimeData['max']));
		const dataMin      = @json(array_map(fn($v) => round($v, 2), $cycleTimeData['min']));
		const paretoLabels = @json($cycleTimeData['sensor']);

		const bgColors = dataAverage.map(v =>
			v > tactTime ? 'rgba(239,68,68,0.5)' : 'rgba(74,222,128,0.5)'
		);
		const bdColors = dataAverage.map(v =>
			v > tactTime ? 'rgba(239,68,68,1)' : 'rgba(22,163,74,0.5)'
		);

		// annotation
		const verticalAnnotations = {};
		paretoLabels.forEach((_, i) => {
			const label = 'POS ' + (i + 1);

			verticalAnnotations['v_' + i] = {
				type: 'line',
				xMin: label,
				xMax: label,
				yMin: dataMin[i],
				yMax: dataMax[i],
				borderColor: 'rgba(54,162,235,1)',
				borderWidth: 2,
				borderDash: [5,5]
			};
		});

        // Fungsi untuk merender ulang chart dengan data baru
        function renderParetoChart(data) {
            if (!chart_main) return;

            const bgColors = data.mainAverages.map(v => v > data.tactTime ? 'rgba(239, 68, 68, 0.5)' : 'rgba(74, 222, 128, 0.5)');
            const bdColors = data.mainAverages.map(v => v > data.tactTime ? 'rgba(239, 68, 68, 1)' : 'rgba(22, 163, 74, 0.5)');

            chart_main.data.labels                      = data.mainLabels.map((name, index) => 'POS ' + (index + 1));
            chart_main.data.datasets[0].data            = data.mainAverages.map(v => parseFloat(v).toFixed(1));
            chart_main.data.datasets[0].backgroundColor = bgColors;
            chart_main.data.datasets[0].borderColor     = bdColors;

            chart_main.update();
        }

		function initMainChart() {
			const ctx = document.getElementById('chart_main').getContext('2d');

			chart_main = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: paretoLabels.map((_, i) => 'POS ' + (i + 1)),
					datasets: [{
						label: 'Cycle Time (second)',
						data: dataAverage,
						backgroundColor: bgColors,
						borderColor: bdColors,
						borderWidth: 3
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						x: {
                            ticks: {
                                font: {
                                    size: 12,
                                    weight: 'normal'
                                },
                                color: '#000'
                            },
                        },
						y: {
							beginAtZero: true,
							max: Math.max(...dataMax) + 5,
							title: {
                                display: true,
                                text: 'Second',
                                font: { size: 12 }
                            },
							ticks: { stepSize: 4 }
						}
					},
					plugins: {
						datalabels: {
                            anchor: 'center',
                            align: 'center',
                            color: '#000',
                            font: {
                                size: 12,
                                weight: 'normal'
                            },
                            formatter: function(value) {
                                return value + 's';
                            }
                        },
						annotation: {
							annotations: {
								tactLine: {
									type: 'line',
									xMin: -0.5,
									xMax: dataAverage.length - 0.5,
									yMin: tactTime,
									yMax: tactTime,
									borderColor: 'rgba(255,99,132,1)',
									borderWidth: 2,
									label: {
										enabled: false,
										content: 'Standard Limit : ' + tactTime + 's'
									}
								},
								...verticalAnnotations
							}
						}
					}
				},
				plugins: [ChartDataLabels]
			});
		}

		document.addEventListener('DOMContentLoaded', () => {
			initMainChart();

			// paksa resize setelah layout settle
			setTimeout(() => {
				if (chart_main) {
					chart_main.resize();
				}
			}, 300);
		});
    </script>
	<script> // Handling Modal
		const LinePerformanceModal = {

			// ===== ELEMENT =====
			btnCreate : document.getElementById('line-performance-btn-create'),
			overlay   : document.getElementById('line-performance-modal-overlay'),
			content   : document.getElementById('line-performance-modal-create'),
			form      : document.getElementById('line-performance-form'),
			btnSubmit : document.getElementById('lp-submit'),
			btnDelete : document.getElementById('lp-delete'),
			btnReset  : document.getElementById('lp-reset'),
			inputId   : document.getElementById('lp-id'),

			search    : document.getElementById('lp-search'),
			group     : document.getElementById('lp-group'),
			tbody     : document.getElementById('line-performance-tbody'),

			timer	 : null,

			// ===== OPEN CREATE =====
			open() {
				// Tampilkan overlay & content
				this.overlay.classList.remove('hidden');
				this.content.classList.remove('hidden');

				// 🔥 RESET KE STATE AWAL (WAJIB)
				this.content.classList.add('opacity-0', 'scale-95');
				this.content.classList.remove('opacity-100', 'scale-100');
				this.overlay.classList.add('opacity-0');

				// Force reflow
				void this.content.offsetWidth;

				// 🔥 MULAI ANIMASI MASUK
				this.overlay.classList.remove('opacity-0');
				this.content.classList.remove('opacity-0', 'scale-95');
				this.content.classList.add('opacity-100', 'scale-100');
			},

			// ===== EDIT =====
			edit(id) {
				fetch(`/linePerformance/edit/${id}`)
					.then(res => res.json())
					.then(data => {

						// isi form
						document.getElementById('lp-id').value = id;
						document.getElementById('line-performance-month').value  = data.month;
						document.getElementById('line-performance-year').value   = data.year;
						document.getElementById('line-performance-target').value = data.target;
						document.getElementById('line-performance-actual').value = data.actual;

						// ubah action form ke UPDATE
						this.form.action = `/linePerformance/update/${id}`;

						// method PUT
						if (!document.getElementById('lp-method')) {
							const m = document.createElement('input');
							m.type  = 'hidden';
							m.name  = '_method';
							m.id    = 'lp-method';
							m.value = 'PUT';
							this.form.appendChild(m);
						}

						// tombol
						this.btnSubmit.textContent = 'Save';
						this.btnDelete?.classList.remove('hidden');
						this.btnReset.classList.remove('hidden');

						// scroll ke form
						form.scrollIntoView({ behavior: 'smooth' });
					});
			},

			// ===== DELETE =====
			delete() {
				const id = this.inputId.value;
				if (!id || !confirm('Delete this data?')) return;

				fetch(`/linePerformance/destroy/${id}`, {
					method: 'DELETE',
					headers: {
						'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
					}
				}).then(() => location.reload());
			},

			reset() {
				this.form.reset();
				this.form.action = "{{ route('linePerformance.store') }}";

				document.getElementById('lp-method')?.remove();
				this.inputId.value = '';

				this.btnSubmit.textContent = 'Submit';
				this.btnDelete.classList.add('hidden');
				this.btnReset.classList.add('hidden');
			},


			// ===== CLOSE =====
			close() {
				// Animasi keluar content
				this.content.classList.remove('opacity-100', 'scale-100');
				this.content.classList.add('opacity-0', 'scale-95');

				// Animasi overlay
				this.overlay.classList.add('opacity-0');

				setTimeout(() => {
					// Sembunyikan semuanya
					this.content.classList.add('hidden');
					this.overlay.classList.add('hidden');

					// Reset class
					this.content.classList.remove('opacity-0', 'scale-95');
					this.overlay.classList.remove('opacity-0');
				}, 300);
			},

			/* ===============================
			TABLE
			================================ */
			loadData() {
				const q     = this.search.value;
				const group = this.group.value;

				fetch(`/linePerformance/search?q=${q}&group=${group}`)
					.then(r => r.json())
					.then(d => this.renderTable(d, group));
			},

			renderTable(data, group) {
				this.tbody.innerHTML = '';

				data.forEach(row => {
					const grouped = group !== '';

					this.tbody.innerHTML += `
						<tr class="border-b">
							<td>${row.month ?? '-'}</td>
							<td>${row.year ?? '-'}</td>
							<td>${row.target}</td>
							<td>${row.actual}</td>
							<td>
								${!grouped && row.id
									? `<button onclick="LinePerformanceModal.edit(${row.id})"
										class="text-blue-600 hover:underline">Edit</button>`
									: `<span class="text-gray-400">-</span>`
								}
							</td>
						</tr>
					`;
				});
			},

			// ===== BIND =====
			bind() {
				this.btnCreate?.addEventListener('click', () => this.open());
				this.btnDelete?.addEventListener('click', () => this.delete());
    			this.btnReset?.addEventListener('click', () => this.reset());

				this.overlay?.addEventListener('click', (e) => {
					if (e.target === this.overlay) this.close();
				});

				this.search?.addEventListener('input', () => {
					clearTimeout(this.timer);
					this.timer = setTimeout(() => this.loadData(), 300);
				});

				this.group?.addEventListener('change', () => this.loadData());
			}
		};

		// INIT
		document.addEventListener('DOMContentLoaded', () => {
			LinePerformanceModal.bind();
			LinePerformanceModal.loadData();
		});
	</script>
	<script>
		document.addEventListener('click', function (e) {

			// hanya tangkap pagination link
			if (e.target.tagName === 'A' && e.target.closest('#line-performance-pagination')) {
				e.preventDefault();

				const url = e.target.getAttribute('href');
				if (!url) return;

				fetch(url, {
					headers: { 'X-Requested-With': 'XMLHttpRequest' }
				})
				.then(res => res.text())
				.then(html => {

					// parse HTML response
					const parser = new DOMParser();
					const doc = parser.parseFromString(html, 'text/html');

					// replace table
					const newTable = doc.getElementById('line-performance-table-wrapper');
					document.getElementById('line-performance-table-wrapper').innerHTML =
						newTable.innerHTML;

					// replace pagination
					const newPagination = doc.getElementById('line-performance-pagination');
					document.getElementById('line-performance-pagination').innerHTML =
						newPagination.innerHTML;
				});
			}

		});
	</script>
	<script>
		document.getElementById('animate-marquee')?.addEventListener('blur', function() {
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
					document.activeElement.blur();
				} else {
					alert('Gagal memperbarui teks.');
				}
			})
			.catch(error => console.error('Error:', error));
		});
	</script>
	<script> // Date and Time Display
		// Fungsi untuk memperbarui waktu setiap detik
		function clock() {
			const now 		 = new Date();
			const hours 	 = String(now.getHours()).padStart(2, '0');
			const minutes 	 = String(now.getMinutes()).padStart(2, '0');
			const seconds 	 = String(now.getSeconds()).padStart(2, '0');
			const timeString = `${hours}:${minutes}:${seconds}`;

			// Format tanggal (dd/mm/yyyy)
			const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
			const dateString = now.toLocaleDateString('id-ID', options);

			document.getElementById("current-time").textContent = timeString;
			document.getElementById("current-date").textContent = dateString;
		}

		// Panggil fungsi updateClock setiap 1 detik
		setInterval(clock, 1000);
		clock(); // Panggil segera saat halaman dimuat
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {

			const labels           = @json($labels);
			const actualData       = @json($actual);
			const minusOeeData     = @json($minusOee);
			const allowedTimeData  = @json($allowedTime);

			const canvas = document.getElementById('stackedBarChart');

			if (!canvas) {
				console.error('Canvas stackedBarChart tidak ditemukan');
				return;
			}

			Chart.register(ChartDataLabels);

			new Chart(canvas, {
				type: 'bar',
				data: {
					labels: labels,
					datasets: [
						{
							label: 'OEE',
							data: actualData,
							backgroundColor: '#2196F3',
							datalabels: {
								display: true,
								anchor: 'center',
								align: 'center',
								color: '#fff',
								font: {
									weight: 'bold',
									size: 16
								},
								formatter: (value) => value + '%'
							}
						},
						{
							label: 'Minus OEE',
							data: minusOeeData,
							backgroundColor: '#FF0000',
							datalabels: {
								display: false
							}
						},
						{
							label: 'Allowed Time',
							data: allowedTimeData,
							backgroundColor: '#4CAF50',
							datalabels: {
								display: false
							}
						}
					]
				},
				options: {
					responsive: true,
					plugins: {
						legend: {
							position: 'top'
						}
					},
					scales: {
						x: {
							stacked: true
						},
						y: {
							stacked: true,
							beginAtZero: true,
							max: 120,
							title: {
								display: true,
								text: '%'
							}
						}
					}
				},
				plugins: [ChartDataLabels]
			});

		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {

			setInterval(function () {

				fetch('{{ route("products.fetchTable") }}', {
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					}
				})
				.then(res => res.text())
				.then(html => {
					document.getElementById('tampil').innerHTML = html;
				})
				.catch(err => console.error('Auto refresh error:', err));

			}, 10000);

		});
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
		document.getElementById('marqueeText')?.addEventListener('click', function() {
		// Fokuskan elemen untuk mempermudah pengeditan
		this.focus();
		});
	</script>
	<script>CKEDITOR.replace('animate-marquee');</script>
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
	<script>
		document.addEventListener('DOMContentLoaded', () => {

			console.log('AUTO REFRESH ACTIVE');

			setInterval(() => {
				console.log('FETCHING...');

				fetch('{{ route("products.fetchTable") }}')
					.then(res => res.text())
					.then(html => {
						const el = document.getElementById('tampil');
						if (!el) {
							console.error('#tampil tidak ditemukan');
							return;
						}
						el.innerHTML = html;
					})
					.catch(err => console.error(err));

			}, 10000);

		});
	</script>
@endsection
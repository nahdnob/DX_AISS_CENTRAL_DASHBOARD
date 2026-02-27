@extends('layouts.app')

@section('header')
	<h1 class="text-4xl font-bold tracking-tight text-gray-900 text-center">
		<span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-200 to-red-700 italic">AISS</span>
		<span class="font-semibold">{{ $title }}</span>
	</h1>
@endsection

@section('content')
	<div class="mx-auto max-w-7xl px-4 py-4">
		<div class="w-full flex flex-col gap-4 sm:flex-row">
			<div class="w-[500px] flex flex-col gap-3">
				{{-- Best Records --}}
				<div class="w-full flex justify-center">
					<x-dashboard.best-record
						:day-count="$best_record['day_count']"
						:last-day="$best_record['last_day']"
					/>
				</div>
				<!-- Modal Line Performance - Edit -->
				<div class="mt-4 w-full flex flex-col">
					<x-dashboard.line-performance
						:items="$linePerformances"
					/>
				</div>
			</div>

			{{-- Still working on this part... --}}
			<div class="w-full">
				<div class="h-[515px] bg-white shadow-lg rounded-lg overflow-hidden">
					<div id="default-carousel" class="relative w-full h-full" data-carousel="static">
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
										<form id="pattern-form" method="POST" action="{{ route('pattern-histories.store') }}" class="flex gap-4 items-center">
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
						@auth
							<!-- Indicators -->
							<div class="absolute z-30 flex -translate-x-1/2 bottom-3 left-1/2 space-x-3">
								<button data-carousel-slide-to="0" class="w-3 h-3 rounded-full bg-gray-300"></button>
								<button data-carousel-slide-to="1" class="w-3 h-3 rounded-full bg-gray-300"></button>
							</div>
							<!-- Prev -->
							<button data-carousel-prev class="group absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4">
								<svg class="w-6 h-6 text-gray-300 group-hover:text-gray-800 dark:text-white transition-colors duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
								</svg>
							</button>
							<!-- Next -->
							<button data-carousel-next class="group absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4">
								<svg class="w-6 h-6 text-gray-300 group-hover:text-gray-800 dark:text-white transition-colors duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
								</svg>
							</button>
						@endauth
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
					{{-- @include('components.card-profile.index') --}}
				</div>
			</div>
		</div>
		@auth
			<x-ui.modal id="profile-modal" maxWidth="max-w-md">
				<x-ui.profile-card
					:name="Auth::user()->name"
					:email="Auth::user()->email"
					:verified="Auth::user()->email_verified_at !== null"
					:npk="Auth::user()->npk"
					:image="Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/images/profile-blank.jpg')"
				/>
			</x-ui.modal>
		@endauth
		<x-ui.modal id="login-modal" maxWidth="max-w-lg">
			<x-auth.login-form />
		</x-ui.modal>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.4.0/dist/chartjs-plugin-annotation.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
	<script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function () {

			const toggle = document.getElementById("ct-view-toggle");
			const carouselEl = document.getElementById("default-carousel");

			if (!carouselEl) return;

			let autoSlide = null;

			function startAutoSlide() {
				if (autoSlide) return;

				autoSlide = setInterval(() => {
					const nextBtn = carouselEl.querySelector('[data-carousel-next]');
					nextBtn?.click();
				}, 15000);

				console.log("AUTO SLIDE START");
			}

			function stopAutoSlide() {
				clearInterval(autoSlide);
				autoSlide = null;
				console.log("AUTO SLIDE STOP");
			}

			// Default: OFF (tidak jalan)
			stopAutoSlide();

			if (toggle) {
				toggle.addEventListener("change", function () {
					if (this.checked) {
						startAutoSlide();
					} else {
						stopAutoSlide();
					}
				});
			}
		});
	</script>
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
				this.form.action = "{{ route('line-performance.store') }}";

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
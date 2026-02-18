<div class="mt-6 rounded-lg h-[70%]">
	<div class="bg-gray-100 flex items-center justify-center h-full">
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
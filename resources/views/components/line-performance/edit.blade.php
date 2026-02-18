<div class="bg-white rounded-lg p-6">
  <form id="editLinePerformanceForm" method="POST">
    @csrf
    @method('PUT')
    <div class="columns-2">

      <!-- input select month -->
      <label for="linePerformanceEditMonth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Month</label>
      <select name="linePerformanceEditMonth" id="linePerformanceEditMonth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('month') is-invalid @enderror">
          <option value="{{ old('month', $linePerformance->month) }}">{{ $linePerformance->month }}</option>
          <option value="January"   {{ old('month') == 'January'   ? 'selected' : '' }}>January</option>
          <option value="February"  {{ old('month') == 'February'  ? 'selected' : '' }}>February</option>
          <option value="March"     {{ old('month') == 'March'     ? 'selected' : '' }}>March</option>
          <option value="April"     {{ old('month') == 'April'     ? 'selected' : '' }}>April</option>
          <option value="May"       {{ old('month') == 'May'       ? 'selected' : '' }}>May</option>
          <option value="June"      {{ old('month') == 'June'      ? 'selected' : '' }}>June</option>
          <option value="July"      {{ old('month') == 'July'      ? 'selected' : '' }}>July</option>
          <option value="August"    {{ old('month') == 'August'    ? 'selected' : '' }}>August</option>
          <option value="September" {{ old('month') == 'September' ? 'selected' : '' }}>September</option>
          <option value="October"   {{ old('month') == 'October'   ? 'selected' : '' }}>October</option>
          <option value="November"  {{ old('month') == 'November'  ? 'selected' : '' }}>November</option>
          <option value="December"  {{ old('month') == 'December'  ? 'selected' : '' }}>December</option>
      </select>
      <!-- error message month -->
      @error('month')
      <div class="alert alert-danger mt-2">
        {{ $message }}
      </div>
      @enderror

      <!-- input select year -->
      <label for="linePerformanceEditYear" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
      <select name="linePerformanceEditYear" id="linePerformanceEditYear" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('year') is-invalid @enderror">
        <option value="{{ old('year', $linePerformance->year) }}">{{ $linePerformance->year }}</option>
        @for ($year = 2024; $year <= date('Y')+50; $year++)
        <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endfor
      </select>
      <!-- error message year -->
      @error('year')
      <div class="alert alert-danger mt-2">
        {{ $message }}
      </div>
      @enderror
    </div>

    <!-- input number target -->
    <div class="py-1">
      <label for="linePerformanceEditTarget" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Target</label>
      <input type="text" name="linePerformanceEditTarget" id="linePerformanceEditTarget" value="{{ old('target', $linePerformance->target) }}" class="@error('target') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="100%">
      <!-- error message target -->
      @error('target')
      <div class="alert alert-danger mt-2">
        {{ $message }}
      </div>
      @enderror
    </div>

    <!-- input number actual -->
    <div class="py-1">
      <label for="linePerformanceEditActual" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Actual</label>
      <input type="text" name="linePerformanceEditActual" id="linePerformanceEditActual" value="{{ old('actual', $linePerformance->actual) }}" class="@error('actual') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="100%">
      <!-- error message actual -->
      @error('actual')
      <div class="alert alert-danger mt-2">
        {{ $message }}
      </div>
      @enderror
    </div>
      
    <!-- button submit -->
    <div class="mt-8 flex space-x-4">
      <button type="submit" class="w-full bg-blue-700 hover:bg-blue-900 text-white font-medium py-3 rounded-lg focus:outline-none">Update</button>
    </div>
  </form>
  <!-- Form Delete -->
  <form id="deleteLinePerformanceForm" method="POST" class="mt-4">
    @csrf
    @method('DELETE')
    <div class="flex justify-end space-x-4">
      <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="w-full bg-red-700 hover:bg-red-900 text-white font-medium py-2 px-4 rounded-lg focus:outline-none">Delete</button>
    </div>
  </form>
</div>
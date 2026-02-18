import 'flowbite'

import Alpine from 'alpinejs'
import $ from 'jquery'
import Swal from 'sweetalert2'

import Chart from 'chart.js/auto'
import ChartDataLabels from 'chartjs-plugin-datalabels'

// expose global
window.Alpine = Alpine
window.$ = $
window.jQuery = $
window.Swal = Swal
window.Chart = Chart
window.ChartDataLabels = ChartDataLabels

Alpine.start()

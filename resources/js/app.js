// Third Party Libraries
import 'flowbite'

import Alpine from 'alpinejs'
import $ from 'jquery'
import Swal from 'sweetalert2'

import Chart from 'chart.js/auto'
import ChartDataLabels from 'chartjs-plugin-datalabels'

// Handmade Modules
import Modal from './modal'
import Toast from './toast'

// Global Expose
window.Alpine = Alpine
window.$ = $
window.jQuery = $
window.Swal = Swal
window.Chart = Chart
window.ChartDataLabels = ChartDataLabels
window.Toast = Toast

// Register Chart plugin (penting)
Chart.register(ChartDataLabels)

// Initialize Custom Scripts
document.addEventListener("DOMContentLoaded", () => {
    Modal.init()
})

// Start Alpine
Alpine.start()
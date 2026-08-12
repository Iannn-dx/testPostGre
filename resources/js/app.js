import './bootstrap';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

window.Alpine = Alpine;
Alpine.start();

function initFeedbackChart() {
    const canvas = document.getElementById('feedback-chart');

    if (!canvas) {
        return;
    }

    const labels = JSON.parse(canvas.dataset.labels || '[]');
    const values = JSON.parse(canvas.dataset.values || '[]');

    new Chart(canvas, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Feedback submissions',
                    data: values,
                    borderColor: '#0f766e',
                    backgroundColor: 'rgba(15, 118, 110, 0.12)',
                    pointBackgroundColor: '#0f766e',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 5,
                    fill: true,
                    tension: 0.35,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    backgroundColor: '#171717',
                    titleColor: '#fafafa',
                    bodyColor: '#fafafa',
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label(context) {
                            return `${context.parsed.y} submissions`;
                        },
                    },
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: '#a3a3a3',
                        font: {
                            size: 11,
                        },
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f5f5f5',
                    },
                    ticks: {
                        color: '#a3a3a3',
                        font: {
                            size: 11,
                        },
                        precision: 0,
                    },
                },
            },
        },
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFeedbackChart);
} else {
    initFeedbackChart();
}

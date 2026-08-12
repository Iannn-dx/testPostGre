import './bootstrap';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

window.Alpine = Alpine;
Alpine.start();

const chartPalette = {
    line: {
        borderColor: '#0f766e',
        backgroundColor: 'rgba(15, 118, 110, 0.12)',
        pointBackgroundColor: '#0f766e',
    },
    bar: {
        borderColor: '#0f766e',
        backgroundColor: 'rgba(15, 118, 110, 0.85)',
    },
};

function initDashboardCharts() {
    document.querySelectorAll('.dashboard-chart').forEach((canvas) => {
        if (!(canvas instanceof HTMLCanvasElement) || canvas.dataset.chartInitialized === 'true') {
            return;
        }

        const type = canvas.dataset.chartType || 'line';
        const labels = JSON.parse(canvas.dataset.labels || '[]');
        const values = JSON.parse(canvas.dataset.values || '[]');
        const datasetLabel = canvas.dataset.datasetLabel || 'Count';
        const tooltipSuffix = canvas.dataset.tooltipSuffix || '';
        const colors = chartPalette[type] ?? chartPalette.line;

        const dataset = {
            label: datasetLabel,
            data: values,
            borderColor: colors.borderColor,
            backgroundColor: colors.backgroundColor,
            borderWidth: type === 'bar' ? 0 : 2,
            borderRadius: type === 'bar' ? 6 : 0,
        };

        if (type === 'line') {
            Object.assign(dataset, {
                pointBackgroundColor: colors.pointBackgroundColor,
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 5,
                fill: true,
                tension: 0.35,
            });
        }

        new Chart(canvas, {
            type,
            data: {
                labels,
                datasets: [dataset],
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
                                const suffix = tooltipSuffix || (type === 'bar' ? ' ratings' : ' submissions');

                                return `${context.parsed.y}${suffix}`;
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

        canvas.dataset.chartInitialized = 'true';
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDashboardCharts);
} else {
    initDashboardCharts();
}

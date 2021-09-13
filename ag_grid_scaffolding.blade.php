
<script>

var columnDefs = [
    { field: 'date', chartDataType: 'category' },
    { field: 'spend', chartDataType: 'category' },

    { headerName: 'date', field: 'date', type: 'measure' },
    { headerName: 'spend', field: 'spend', type: 'measure' },
];

var chartRef;

var gridOptions = {
    columnDefs: columnDefs,
    defaultColDef: {
        editable: true,
        sortable: true,
        flex: 1,
        minWidth: 150,
        filter: true,
        resizable: true
    },
    columnTypes: {
        measure: {
            chartDataType: 'series',
            cellClass: 'number',
            valueFormatter: numberCellFormatter,
            cellRenderer: 'agAnimateShowChangeCellRenderer'
        }
    },
    animateRows: true,
    enableCharts: true,
    suppressAggFuncInHeader: true,
    getRowNodeId: function(data) { return data.trade; },
    onFirstDataRendered: function(params) {
        var createRangeChartParams = {
            cellRange: {
                columns: ['date', 'spend']
            },
            chartType: 'groupedColumn',
            chartContainer: document.querySelector('#myChart'),
            suppressChartRanges: true,
            aggFunc: 'sum'
        };

        chartRef = params.api.createRangeChart(createRangeChartParams);
    },
    chartThemes: ['ag-pastel-dark'],
    chartThemeOverrides: {
        common: {
            legend: {
                position: 'bottom',
            }
        },
        column: {
            axes: {
                number: {
                    label: {
                        formatter: yAxisLabelFormatter
                    }
                },
                category: {
                    label: {
                        rotation: 0,
                    },
                },
            },
            series: {
                tooltip: {
                    renderer: tooltipRenderer
                }
            }
        },
        line: {
            series: {
                tooltip: {
                    renderer: tooltipRenderer
                }
            }
        }

    },
    getChartToolbarItems: function() {
        return []; // hide toolbar items
    }
};

function createChart(type) {
    // destroy existing chart
    if (chartRef) {
        chartRef.destroyChart();
    }

    var params = {
        cellRange: {
            columns: ['date', 'spend']
        },
        chartContainer: document.querySelector('#myChart'),
        chartType: type,
        suppressChartRanges: true,
        aggFunc: 'sum'
    };

    chartRef = gridOptions.api.createRangeChart(params);
}

function numberCellFormatter(params) {
    return Math.floor(params.value).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

function yAxisLabelFormatter(params) {
    var n = params.value;
    if (n < 1e3) return n;
    if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(1) + "K";
    if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(1) + "M";
    if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(1) + "B";
    if (n >= 1e12) return +(n / 1e12).toFixed(1) + "T";
}

function tooltipRenderer(params) {
    var value = '$' + params.datum[params.yKey].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    var title = params.title || params.yName;
    return '<div style="padding: 5px"><b>' + title + '</b>: ' + value + '</div>';
}

// after page is loaded, create the grid
document.addEventListener("DOMContentLoaded", function() {
    var eGridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(eGridDiv, gridOptions);
});

var worker;
(function startWorker() {
    worker = new Worker(__basePath + 'dataUpdateWorker.js');
    worker.onmessage = function(e) {
        if (e.data.type === 'setRowData') {
            gridOptions.api.setRowData(e.data.records);
        }
        if (e.data.type === 'updateData') {
            gridOptions.api.applyTransactionAsync({ update: e.data.records });
        }
    };

    worker.postMessage('start');
})();

function onStartLoad() {
    worker.postMessage('start');
}

function onStopMessages() {
    worker.postMessage('stop');
}

</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.phoenix.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="./style/style.css">
    <title>Home</title>
</head>

<body>
    <div id="content-container">
        @foreach ($data as $single_data)
            {!! $single_data->content !!}
        @endforeach
    </div>

    <form class=" h-screen" action="{{ URL('store/test') }}" method="POST" class="h-96">
        @csrf
        <textarea class=" h-full" id="editor" name="content"></textarea>
        <button class="btn bg-indigo-300 p-2" type="submit">submit</button>
    </form>

    <input type="hidden" id="chart-data-storage" name="chart-data-storage" value="">



    
    <script src="https://cdn.tiny.cloud/1/ue9g0tgt8w86xz5ivio0rvmpotqhejdah9vfsy4ufzglykvz/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
    <script src="./js/script.js"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'code',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code | insertChart',
            setup: function(editor) {
                editor.ui.registry.addButton('insertChart', {
                    text: 'Insert Chart',
                    onAction: function() {
                        editor.windowManager.open({
                            title: 'Insert Chart Data',
                            body: {
                                type: 'panel',
                                items: [{
                                        type: 'input',
                                        name: 'chartTitle',
                                        label: 'Chart Title'
                                    },
                                    {
                                        type: 'input',
                                        name: 'labels',
                                        label: 'Labels (comma-separated)'
                                    },
                                    {
                                        type: 'input',
                                        name: 'data',
                                        label: 'Data (comma-separated)'
                                    }
                                ]
                            },
                            buttons: [{
                                text: 'Insert',
                                type: 'submit',
                                primary: true
                            }],
                            onSubmit: function(dialog) {

                                chartId = null;
                                var data = dialog.getData();
                                var labelsArray = data.labels.split(',');
                                var dataArray = data.data.split(',');

                                // Create a unique ID for the chart
                                var chartId = 'myChart' + Math.random();


                                // Generate the chart placeholder
                                var chartTemplate = `
                                    <div id="${chartId}" class="chart-container" data-title="${data.chartTitle}" data-labels='${JSON.stringify(labelsArray)}' data-data='${JSON.stringify(dataArray)}'>
                                    </div>
                                `;

                                editor.insertContent(chartTemplate);
                                data = null;
                                dialog.close();
                                // console.log(document.getElementById(chartId));

                                // Reinitialize charts whenever the editor's content changes
                                initializeCharts();
                                storeChartData()
                                chartId = null;
                            }
                        });
                    }
                });
                editor.on('Change', function(e) {
                    storeChartData();
                });
                editor.on('Undo', function() {
                    reinitializeCharts(); // Reinitialize charts after undo
                });
            }
        });
        var chartsInitialized = {};

        function initializeCharts() {
            const iframe = document.querySelector('#editor_ifr'); // Ensure this selector matches your TinyMCE iframe ID
            if (!iframe) {
                // console.error('TinyMCE iframe not found');
                return;
            }

            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

            iframeDoc.querySelectorAll('.chart-container').forEach(function(container) {
                // console.log('Processing container:', container.id);


                var chartId = container.id;
                if (chartsInitialized[chartId]) {
                    // console.log(`Chart with ID ${chartId} is already initialized.`);
                    return;
                }

                // Create a canvas element inside the container if not present
                var canvas = container.querySelector('canvas');
                if (!canvas) {
                    canvas = document.createElement('canvas');
                    canvas.id = 'canvas-' + chartId;
                    container.appendChild(canvas);
                }

                // Extract chart data from the container attributes
                var chartTitle = container.getAttribute('data-title');
                var labels = JSON.parse(container.getAttribute('data-labels'));
                var data = JSON.parse(container.getAttribute('data-data'));

                // Store chart data in the chartsInitialized object
                chartsInitialized[chartId] = {
                    title: chartTitle,
                    labels: labels,
                    data: data
                };

                // Initialize the Chart.js chart
                var ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: chartTitle,
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        }

        function storeChartData() {
            document.querySelectorAll('.chart-container').forEach(function(container) {
                var chartId = container.id;

                chartsInitialized[chartId] = {
                    title: container.getAttribute('data-title'),
                    labels: JSON.parse(container.getAttribute('data-labels')),
                    data: JSON.parse(container.getAttribute('data-data'))
                };
            });
            document.getElementById('chart-data-storage').value = JSON.stringify(chartsInitialized);
        }

        function reinitializeCharts() {

            var storedData = document.getElementById('chart-data-storage').value;
            var chartData = JSON.parse(storedData);

            //             console.log(chartData);
            // // 

            for (var chartId in chartData) {

                if (chartData.hasOwnProperty(chartId)) {
                    console.log(chartId);

                    var container = document.getElementById(chartId);
                    if (!container) {
                        container = document.createElement('div');
                        container.id = chartId;
                        container.className = 'chart-container';
                        document.body.appendChild(container); // App

                    } else {
                        destroyOldChart(container);
                        container.setAttribute('data-title', chartData[chartId].title);
                        container.setAttribute('data-labels', JSON.stringify(chartData[chartId].labels));
                        container.setAttribute('data-data', JSON.stringify(chartData[chartId].data));

                        initializeChart(container);
                    }
                }
            }
        }

        function destroyOldChart(container) {
            var canvas = container.querySelector('canvas');
            if (canvas && canvas.chart) {
                canvas.chart.destroy(); // Destroy the old chart instance
            }
        }



        document.addEventListener('DOMContentLoaded', function() {

           



        })
    </script>

</body>

</html>

$(document).ready(function () {

    $("#result").click(function () {
        var artist = $("#artist").val();
        var song = $("#song").val();

        $.post(
            "get.php", {
            artist: artist,
            song: song
        },
            function (data, status) {
                console.log(data);

                const response = JSON.parse(data);

                var deezer = [];
                response.data.forEach((obj) => {
                    const streamObj = {
                        x: new Date(obj[0]),
                        y: parseInt(obj[1])
                    };
                    deezer.push(streamObj);
                });

                var tidal = [];
                response.data.forEach((obj) => {
                    const streamObj = {
                        x: new Date(obj[0]),
                        y: parseInt(obj[2])
                    };
                    tidal.push(streamObj);
                });

                var napster = [];
                response.data.forEach((obj) => {
                    const streamObj = {
                        x: new Date(obj[0]),
                        y: parseInt(obj[3])
                    };
                    napster.push(streamObj);
                });

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Streaming Counter"
                    },
                    axisX: {
                        valueFormatString: "DD MMM,YY"
                    },
                    axisY: {
                        title: "Streaming",
                        suffix: " "
                    },
                    legend: {
                        cursor: "pointer",
                        fontSize: 16,
                        itemclick: toggleDataSeries
                    },
                    toolTip: {
                        shared: true
                    },
                    data: [{
                        name: "Deezer",
                        type: "line",
                        showInLegend: true,
                        dataPoints: deezer
                    },
                    {
                        name: "Tidal",
                        type: "line",
                        showInLegend: true,
                        dataPoints: tidal
                    },
                    {
                        name: "Napster",
                        type: "line",
                        showInLegend: true,
                        dataPoints: napster
                    }
                    ]
                });
                chart.render();

                function toggleDataSeries(e) {
                    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    } else {
                        e.dataSeries.visible = true;
                    }
                    chart.render();
                }

            }
        );


    });
});
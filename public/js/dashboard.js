var objDashboard = new Object();

function populateDbArrived() {
    $.ajax({
        url: 'dbArrived',
        data: {
            'condition': objDashboard,
        },
        contentType: "application/json",
        success: function (data) {
            $("#dbArrived").text(data);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populateDbProcessed() {
    $.ajax({
        url: 'dbProcessed',
        data: {
            condition: objDashboard
        },
        success: function (data) {
            $("#dbProcessed").text(data);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populateDbInProgress() {
    $.ajax({
        url: 'dbInProgress',
        data: {
            condition: objDashboard
        },
        success: function (data) {
            $("#dbInProgress").text(data);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populatePrEfficiency() {
    $.ajax({
        url: 'prEfficiency',
        data: {
            condition: objDashboard
        },
        success: function (data) {
            $("#prEfficiency").text(data);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populatefltProduct() {
    $.ajax({
        url: 'fltProduct',
        success: function (data) {
            $("#fltProduct").empty();
            for (i = 0; i < data.length; i++) {
                $("#fltProduct").append("<option value='" + data[i].producto + "'>" + data[i].producto + "</option>");
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populatefltYear() {
    $.ajax({
        url: 'fltYear',
        success: function (data) {
            $("#fltYear").empty();
            for (i = 0; i < data.length; i++) {
                $("#fltYear").append("<option value='" + data[i].año + "'>" + data[i].año + "</option>");
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populatefltMonth() {
    $.ajax({
        url: 'fltMonth',
        data: {
            condi: "where producto = 'sobordos'"
        },
        success: function (data) {
            $("#fltMonth").empty();
            for (i = 0; i < data.length; i++) {
                $("#fltMonth").append("<option value='" + data[i].mes + "'>" + data[i].mes + "</option>");
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populatefltCountry() {
    $.ajax({
        url: 'fltCountry',
        success: function (data) {
            $("#fltCountry").empty();
            for (i = 0; i < data.length; i++) {
                $("#fltCountry").append("<option value='" + data[i].pais + "'>" + data[i].pais + "</option>");
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populateGphCountryMaxMonth() {
    var options = {
        chart: {
            renderTo: 'gphCountryMaxMonth',
            type: 'column'
        },

        title: {
            text: 'Maximo periodo por intercambio y pais'
        },

        xAxis: {
            categories: [],
            crosshair: true
        },

        yAxis: {
            min: 0,
            title: {
                text: 'Mes'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>';
            }
        },

        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },

        series: [{
            name: "expo",
            data: []
        },{
            name: "impo",
            data: []
        }]
    };

    $.ajax({
        url: 'maxMonthCountry',
        data: {
            condition: objDashboard
        },
        success: function (data) {
            let datos = jQuery.parseJSON(data);
            let i;
            for (i = 0; i < datos.length; i++) {

                options.xAxis.categories.push(datos[i].pais);
                options.series[0].data.push(parseInt(datos[i].max_per_expo));
                options.series[1].data.push(parseInt(datos[i].max_per_impo));
            }
            var chart = new Highcharts.Chart(options);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populateGphCantDbMonth() {
    var options = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            renderTo: "gphCantDbMonth"
        },
        title: {
            text: 'Participación bases por mes'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Bases',
            colorByPoint: true,
            data: []
        }]
    };

    $.ajax({
        url: 'cantMonth',
        data: {
            condition: objDashboard
        },
        success: function (data) {
            let datos = jQuery.parseJSON(data);
            let i;
            for (i = 0; i < datos.length; i++) {
                var obj = {name: datos[i].mes, y: parseInt(datos[i].cant)};
                options.series[0].data.push(obj);
            }

            var chart = new Highcharts.Chart(options);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });
}

function populateGphTopAnalyst() {
    var options = {
        chart: {
            renderTo: "gphTopAnalyst"
        },
        title: {
            text: 'Efectividad por analista'
        },
        xAxis: {
            categories: []
        },
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}%',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Efectividad',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: 'Cantidad',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} number',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        series: [{
            type: 'column',
            name: 'Asignadas',
            data: []
        }, {
            type: 'column',
            name: 'Cargadas',
            data: []
        }, {
            type: 'spline',
            name: '%',
            data: [],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[5],
                fillColor: 'white'
            }
        }]
    };

    $.ajax({
        url: 'efecAnalyst',
        data: {
            condition: objDashboard
        },
        success: function (data) {
            let datos = jQuery.parseJSON(data);
            let i;
            for (i = 0; i < datos.length; i++) {
                options.xAxis.categories.push(datos[i].analista);
                options.series[0].data.push(parseInt(datos[i].asignadas));
                options.series[1].data.push(parseInt(datos[i].cargadas));
                options.series[2].data.push(parseInt(datos[i].porc));
            }
            var chart = new Highcharts.Chart(options);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }
    });


}

function fnResetFlt(){
    delete objDashboard['product'];
    delete objDashboard['year'];
    delete objDashboard['month'];
    delete objDashboard['country'];
    populatefltProduct();
    populatefltYear();
    populatefltMonth();
    populatefltCountry();
    populateScreen();
}

function populateScreen() {
    populateDbArrived();
    populateDbProcessed();
    populateDbInProgress();
    populatePrEfficiency();
    populateGphCountryMaxMonth();
    populateGphCantDbMonth();
    populateGphTopAnalyst();
}

$(document).ready(function () {

    populatefltProduct();
    populatefltYear();
    populatefltMonth();
    populatefltCountry();
    populateScreen();

    $("#fltProduct").change(function (e) {
        var val = $("#fltProduct").val();
        var result = "";
        if (val != null) {
            for (var i = 0; i < val.length; i++) {
                result = result + "'" + val[i] + "',";
            }
            result = result.substr(0, result.length - 1);
            if (result != "")
                objDashboard.product = "producto in (" + result + ")";
            else
                delete objDashboard['product'];
        }
        populateScreen();
    });

    $("#fltYear").change(function (e) {
        var val = $("#fltYear").val();
        var result = "";
        if (val != null) {
            for (var i = 0; i < val.length; i++) {
                result = result + "'" + val[i] + "',";
            }
            result = result.substr(0, result.length - 1);
            if (result != "")
                objDashboard.year = "año in (" + result + ")";
            else
                delete objDashboard['year'];
        }
        populateScreen();
    });

    $("#fltMonth").change(function (e) {
        var val = $("#fltMonth").val();
        var result = "";
        if (val != null) {
            for (var i = 0; i < val.length; i++) {
                result = result + "'" + val[i] + "',";
            }
            result = result.substr(0, result.length - 1);
            if (result != "")
                objDashboard.month = "mes in (" + result + ")";
            else
                delete objDashboard['month'];
        }
        populateScreen();
    });

    $("#fltCountry").change(function (e) {
        var val = $("#fltCountry").val();
        var result = "";
        if (val != null) {
            for (var i = 0; i < val.length; i++) {
                result = result + "'" + val[i] + "',";
            }
            result = result.substr(0, result.length - 1);
            if (result != "")
                objDashboard.country = "pais in (" + result + ")";
            else
                delete objDashboard['country'];
        }
        populateScreen();
    });
});

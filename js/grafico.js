// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.



//FUNCION DEL GRAFICO
function drawChart() {
    // Create the data table

    let data2 = new google.visualization.DataTable();
    let hiddens = $('.products').attr('id')[2];
    debugger;
    let arrayFilas=[];


    data2.addColumn('string', 'Producto');
    data2.addColumn('number', 'Cantidad');
    for (var x = 0; x < hiddens.length; x++)
    {
        //arrayFilas.push($('.products').attr('id'),);

    }

    data2.addRows(arrayFilas);

    //let h = $("#chart_div").height();
    //let w = $("#chart_div").width();
    let h=15;
    let w=15;
    let options = {
        'title':'Estadisticas de uso:',
        pieHole:0.3,
        'width':w,
        'height':h
    };



    var chart = new google.visualization.PieChart($('#chart_div'));
    chart.draw(data2, options);
}
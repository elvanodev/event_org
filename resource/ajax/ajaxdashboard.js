$(document).ready(function () {
    onchangefilterdashboard();
});

function onchangefilterdashboard() {
    $(document).ready(function () {
        getdashboardchart();
    });
}

function creategrafh(element, indexAxis, xdata, ydata, title) {
    const data = {
      labels: xdata,
      datasets: [
        {
          label: title,
          data: ydata
        },
      ]
    };
    new Chart(element, {
        type: 'bar',
        data: data,
        options: {
            indexAxis: indexAxis,
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            responsive: true,
            plugins: {
                legend: {
                  position: 'right',
                },
                title: {
                  display: true,
                  text: title
                }
              }
        }
    });
}

function getdashboardchart() {
    $(document).ready(function () {
        edeventfilter = $("#edeventfilter").find(":selected").val();
        $.ajax({
            url: getBaseURL() + "index.php/ctrevents/geteventchart/",
            data: "edeventfilter=" + edeventfilter,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                if (json.listgrafik != '') {
                    const listgrafik = json.listgrafik;
                    let xdata = Object.keys(listgrafik);
                    let ydata = Object.values(listgrafik);
                    ydata = ydata.map(function (a) {
                        a = Number(a);
                        return a;
                    });
                    $("#dashboardchart").html('<canvas id="eventchart"></canvas>');
                    const element = document.getElementById('eventchart');
                    creategrafh(element, 'x', xdata, ydata, 'Event Chart');
                } else {
                    $("#dashboardchart").html("No data available!");
                }
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                console.log("Error juga" + xmlHttpRequest.responseText);
            }
        });
    });
}
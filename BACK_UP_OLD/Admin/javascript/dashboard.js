$(document).ready(function () {
  const reloadDashBoard = () => {
    var date = $("#db-sort").val();

    $.ajax({
      type: "GET",
      url: "../backend/Controller/get.php",
      data: {
        SubmitType: "GetDashboard",
        date: date,
      },
      success: function (response) {
        var data = JSON.parse(response);
        console.log(data);

        var mappedData = $.map(data, function (item) {
          // Convert numeric hour to 12-hour format with AM/PM
          var hour = item.time % 12 === 0 ? 12 : item.time % 12;
          var ampm = item.time < 12 || item.time === 24 ? "AM" : "PM";

          // Format the time as 'h:mm AM/PM'
          var formattedTime = hour + ":00 " + ampm;

          return { y: item.total_visit, label: formattedTime };
        });

        options.data[0].dataPoints = mappedData;

        console.log(options);
        if (data.length > 0) {
          $("#chartContainer").CanvasJSChart(options);
        } else {
          $("#chartContainer").html("<h3 class='text-center'>No Visit</h3>");
        }
      },
    });
  };

  var options = {
    animationEnabled: true,
    theme: "light1",
    title: {
      text: "ISABELAPP",
    },
    axisY2: {
      prefix: "",
      lineThickness: 1,
      interval: 5,
    },
    toolTip: {
      shared: true,
    },
    legend: {
      verticalAlign: "top",
      horizontalAlign: "center",
    },
    data: [
      {
        type: "column",
        showInLegend: true,
        name: "Visits",
        axisYType: "secondary",
        color: "#198754 ",
        dataPoints: [],
      },
    ],
  };

  $("#db-sort").change(function (e) {
    e.preventDefault();
    reloadDashBoard();
  });

  reloadDashBoard();
});

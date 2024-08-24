const reloadDashBoard = () => {
  var date = $(".db-sort").val();
  var inputDate = new Date(date);

  // Get English month name
  var monthName = inputDate.toLocaleString('en-US', { month: 'long' });



  var formattedDate;

  // Check if the input is a valid date
  if (!isNaN(inputDate.getTime())) {
      var options = { year: 'numeric', month: 'long', day: 'numeric' };
      formattedDate = inputDate.toLocaleDateString('en-US', options);
      // console.log(formattedDate);
  } else {
      console.log('Invalid date format');
      return; // Exit the function if date is invalid
  }

  // Initialize options object
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
              name: `Visits as of ${formattedDate}`,
              axisYType: "secondary",
              color: "#198754",
              dataPoints: [],
          },
      ],
  };

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

        // Check if data has the expected structure
        if (data && data.data && Array.isArray(data.data)) {
            var mappedData = $.map(data.data, function (item) {
                // Convert numeric hour to 12-hour format with AM/PM
                var hour = item.time % 12 === 0 ? 12 : item.time % 12;
                var ampm = item.time < 12 || item.time === 24 ? "AM" : "PM";

                // Format the time as 'h:mm AM/PM'
                var formattedTime = hour + ":00 " + ampm;

                return { y: item.total_visit, label: formattedTime };
            });

            options.data[0].dataPoints = mappedData;

            if (data.data.length > 0) {
                $("#chartContainer").CanvasJSChart(options);
            } else {
                $("#chartContainer").html("<h3 class='text-center'>No Visit</h3>");
            }
        } else {
            console.log('Unexpected data structure from the server');
        }

        // Handle monthly data
        if (data && data.dataPermonth && Array.isArray(data.dataPermonth)) {
            var monthlyMappedData = $.map(data.dataPermonth, function (item) {
                return { y: item.total_visitsPerDay, label: item.day_of_month.toString() };
            });

            // Create options for monthly chart
            var monthlyOptions = {
              animationEnabled: true,
              theme: "light2",
              title: {
                  text: `Monthly Visits For the month of ${monthName}`,
                  fontSize: 30 // Adjust the font size as needed
              },
              axisX: {
                  title: "Day of Month"
                  
              },
              axisY: {
                  title: "Total Visits"
              },
              data: [{
                  type: "line",
                  dataPoints: monthlyMappedData
              }]
          };
          
          

            if (data.dataPermonth.length > 0) {
                $("#chartContainerPerMonth").CanvasJSChart(monthlyOptions);
            } else {
                $("#chartContainerPerMonth").html("<h3 class='text-center'>No Visit</h3>");
            }
        } else {
            console.log('Unexpected monthly data structure from the server');
        }
    },
});



};

$(".db-sort").change(function (e) {
  e.preventDefault();
  reloadDashBoard();
});

reloadDashBoard();

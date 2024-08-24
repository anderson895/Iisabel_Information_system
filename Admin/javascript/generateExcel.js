// Kapag pindutin ang pindutan ng "Export"
document.querySelector('.btn.btn-success').addEventListener('click', function () {
    // Ikuha ang lahat ng mga hanay ng table
    var rows = document.querySelectorAll('#myTable tr');
    // Lumikha ng isang array upang magtipon ng data para sa bawat hanay
    var csv = [];
    // Para sa bawat hanay sa table, ikalap ang data
    for (var i = 0; i < rows.length; i++) {
        var row = [],
            cols = rows[i].querySelectorAll('td, th');
        // Para sa bawat kolum, kunin ang teksto at idagdag sa array na ito
        for (var j = 0; j < cols.length; j++) {
            // Check if the current column has a child with class "rateValue"
            var rateValue = cols[j].querySelector('.rateValue');
            if (rateValue !== null) {
                row.push(rateValue.value); // Push the value of the hidden input
            } else {
                row.push(cols[j].innerText); // Push the text content
            }
        }
        // Ilagay ang array ng hanay sa CSV array
        csv.push(row.join(","));
    }
    // Lumikha ng isang data URI para sa CSV string
    var csvContent = csv.join("\n");
    // Lumikha ng isang hyperlink para sa pag-download
    var link = document.createElement("a");
    link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent);
    link.download = "data.csv";
    // Itago ang hyperlink, i-click ito, at pagkatapos ay alisin ito
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
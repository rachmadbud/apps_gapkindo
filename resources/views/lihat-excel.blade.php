<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lihat Excel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        td,
        th {
            border: 1px solid #333;
            padding: 6px 10px;
        }

        table {
            border-collapse: collapse;
            width: auto;
            /* PENTING */
            width: 100%;
        }

        td,
        th {
            border: 1px solid #333;
            padding: 6px 10px;
        }

        td:nth-child(1),
        th:nth-child(1) {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Preview File Excel</h2>

    <div id="output"></div>

    <script>
        const fileUrl = "{{ $fileUrl }}";

        fetch(fileUrl)
            .then(res => res.arrayBuffer())
            .then(data => {
                const workbook = XLSX.read(data, {
                    type: "array"
                });
                const output = document.getElementById("output");

                workbook.SheetNames.forEach(sheetName => {
                    const sheet = workbook.Sheets[sheetName];
                    const rows = XLSX.utils.sheet_to_json(sheet, {
                        header: 1
                    });

                    output.innerHTML += `<h3>Sheet: ${sheetName}</h3>`;
                    output.innerHTML += createTable(rows);
                });
            });

        function createTable(data) {
            let table = "<table>";
            data.forEach(row => {
                table += "<tr>";
                row.forEach(cell => {
                    table += `<td>${cell ?? ""}</td>`;
                });
                table += "</tr>";
            });
            table += "</table>";
            return table;
        }

        function createTable(data) {
            let table = "<table>";

            data.forEach(row => {
                if (row.every(cell => cell === undefined || cell === "")) return;

                table += "<tr>";
                row.forEach(cell => {
                    table += `<td>${cell ?? ""}</td>`;
                });
                table += "</tr>";
            });

            table += "</table>";
            return table;
        }
    </script>

</body>

</html>

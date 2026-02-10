<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Excel Laravel</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Data Excel dari Server</h2>
    <table id="table"></table>

    <script>
        fetch('/excel-data')
            .then(res => res.json())
            .then(rows => {
                let html = '';

                rows.forEach((row, index) => {
                    html += '<tr>';
                    for (let key in row) {
                        const tag = index === 0 ? 'th' : 'td';
                        html += `<${tag}>${row[key] ?? ''}</${tag}>`;
                    }
                    html += '</tr>';
                });

                document.getElementById('table').innerHTML = html;
            });
    </script>

</body>

</html>

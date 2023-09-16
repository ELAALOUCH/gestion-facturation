
<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
    <style>
        /* Styles CSS pour le PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            background-color: #f2f2f2;
            padding: 10px;
        }

        h1 {
            font-size: 24px;
            margin: 0;
        }

        .table-container {
            width: 100%;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .adresse {
            max-width: 150px;
            word-wrap: break-word;
        }

        .site {
            max-width: 150px;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des clients</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>CODE CLIENT</th>
                    <th>ICE</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Site Web</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->code_client }}</td>
                        <td>{{ $customer->ice }}</td>
                        <td>{{ $customer->nom }}</td>
                        <td>{{ $customer->telephone }}</td>
                        <td class="adresse">{{ $customer->adresse }}</td>
                        <td>{{ $customer->ville }}</td>
                        <td class="site">{{ $customer->site_web }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

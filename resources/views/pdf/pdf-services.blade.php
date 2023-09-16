<!DOCTYPE html>
<html>
<head>
    <title>Liste des services</title>
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des services</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Nom du Fournisseur</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->nom }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->type }}</td>
                        <td>{{ $service->supplier->nom ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Fournisseurs</title>
    <style>
        /* Styles CSS pour le PDF */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Liste des Fournisseurs</h1>

    <table>
        <thead>
            <tr>
                <th>ICE</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Site Web</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->ice }}</td>
                    <td>{{ $supplier->nom }}</td>
                    <td>{{ $supplier->telephone }}</td>
                    <td>{{ $supplier->adresse }}</td>
                    <td>{{ $supplier->ville }}</td>
                    <td>{{ $supplier->site_web }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

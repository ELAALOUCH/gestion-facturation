<!DOCTYPE html>
<html>
<head>
    <title>Liste des produits</title>
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

        .designation {
            max-width: 150px;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Liste des produits</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Désignation</th>
                    <th>Categorie</th>
                    <th>Stock</th>
                    <th>Stock Alert</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>

                        <td class="designation">{{ $product->designation }}</td>
                        <td>{{$product->category->categorie ?? ''}}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->stock_alert }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

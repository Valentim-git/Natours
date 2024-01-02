<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natours</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
    <!-- Adicione o link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #495057;
            text-align: center;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .spot-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(33.33% - 16px);
            box-sizing: border-box;
        }

        .spot-image {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .spot-info {
            margin-top: 12px;
        }

        .spot-title {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 8px;
        }

        .spot-description {
            color: #555;
            margin-bottom: 8px;
        }

        .spot-price {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">

        @foreach ($spots as $spot)
        <div class="spot-container">
            <img class="spot-image" src="{{ asset('storage/images/' . $spot->path) }}" alt="{{ $spot->name }}">
            <div class="spot-info">
                <h3 class="spot-title">{{ $spot->name }}</h3>
                <p class="spot-description">Descrição: {{ $spot->description }}</p>
                <p class="spot-price">Preço: {{ $spot->cost }}€</p>

                <!-- Adicione o botão para acessar o show de cada spot -->
                <a href="{{ url('/spots/show/' . $spot->id) }}" class="btn btn-primary">Reservar</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Adicione o link para o JavaScript do Bootstrap, se necessário -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
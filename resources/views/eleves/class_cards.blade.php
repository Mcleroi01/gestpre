<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte d'Élève</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .contenaire {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 2em;
        }

        .card {
            width: 320px;
            height: 500px;
            padding: 1.5em;
            background: linear-gradient(145deg, #ffffff, #e0e0e0);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin: 20px;
            border: 2px solid #1e88e5;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            text-align: center;
            font-weight: bold;
            font-size: 1.5em;
            color: #fff;
            background-color: #1e88e5;
            padding: 12px;
            border-radius: 12px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .school-logo {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            background-color: white;
            margin: 0 auto 10px;
        }

        .school-name {
            font-size: 1.1em;
            color: #ffeb3b;
            margin-bottom: 5px;
        }

        .qr-code {
            display: flex;
            justify-content: center;
            margin: 15px 0;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-info {
            text-align: center;
            margin-top: 15px;
            color: #212121;
        }

        .card-info p {
            margin: 8px 0;
        }

        .text-title {
            font-weight: bold;
            font-size: 1.3em;
            color: #1565c0;
        }

        .text-body {
            font-size: 1em;
            color: #333;
        }

        .divider {
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #1e88e5, transparent);
            margin: 10px 0;
        }

        .card-footer {
            text-align: center;
            padding: 15px 0;
            border-top: 1px solid #1e88e5;
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: rgba(30, 136, 229, 0.1);
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .footer-text {
            font-size: 0.9em;
            color: #444;
        }

        /*Button hover effects */
        .card-button {
            padding: 0.5em 1em;
            cursor: pointer;
            border: 1px solid #fff;
            border-radius: 30px;
            background-color: #ff8c00;
            color: white;
            transition: background-color 0.3s ease-in-out;
        }

        .card-button:hover {
            background-color: #ffc107;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="contenaire">
        @foreach ($eleves as $eleve)
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <!-- Logo de l'école (optionnel) -->
                    <div class="school-logo"></div>
                    <p class="school-name">Institut Supérieur Pédagogique de la Gombe</p>
                    <p>Carte d'Élève</p>
                </div>

                <!-- QR Code -->
                <div class="qr-code">
                    {!! $qrCodes[$eleve->id] !!}
                </div>

                <!-- Information Élève -->
                <div class="card-info">
                    <p class="text-title">{{ $eleve->nom }} {{ $eleve->prenom }}</p>
                    <p class="text-body">Classe : {{ optional($eleve->classeScolaire)->nom }}</p>
                    <p class="text-body">Section : {{ optional($eleve->classeScolaire->section)->nom }}</p>
                    <p class="text-body">Cycle : {{ optional($eleve->classeScolaire->section->cycle)->nom }}</p>
                </div>

                <!-- Divider -->
                <div class="divider"></div>

                <!-- Footer -->
                <div class="card-footer">
                    <p class="footer-text">ID Élève: {{ $eleve->id }}</p>
                    <p class="footer-text">Année Scolaire: {{ date('Y') }}</p>
                </div>
            </div>

            <div class="page-break"></div>
        @endforeach
    </div>
</body>

</html>

{{-- resources/views/presences/index.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR Code</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-center text-2xl font-bold text-gray-800">Scanner QR Code</h1>
            <div id="reader" style="width: 100%;"></div>
            <p class="mt-4 text-center text-gray-600">Scannez le QR code pour marquer la présence.</p>
        </div>
    </div>

    <script>
        const html5QrCode = new Html5Qrcode("reader");

        function onScanSuccess(qrCodeMessage) {
            // Traiter le QR code scanné
            console.log("QR Code scanné: ", qrCodeMessage);

            // Rediriger vers la page de confirmation avec l'ID de l'élève
            window.location.href = `/presences/confirm/${qrCodeMessage}`;
        }

        function onScanError(errorMessage) {
            // En cas d'erreur de scan
            console.warn(`Erreur de scan: ${errorMessage}`);
        }

        html5QrCode.start(
            { facingMode: "environment" }, // Utiliser la caméra arrière
            { fps: 10, qrbox: 250 } // Paramètres de scan
        ).catch(err => {
            console.error("Erreur lors du démarrage de la caméra : ", err);
        });
    </script>
</body>

</html>

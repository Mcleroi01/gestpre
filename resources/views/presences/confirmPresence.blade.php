{{-- resources/views/confirmPresence.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Inclure le CSS de ton application --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-center text-2xl font-bold text-gray-800">Confirmation de Présence</h1>

            <div class="mt-5">
                <p class="text-gray-700">Nom: <strong class="text-gray-900">{{ $eleve->nom }}
                        {{ $eleve->prenom }}</strong></p>
                <p class="text-gray-700">Classe: <strong
                        class="text-gray-900">{{ optional($eleve->classeScolaire)->nom }}</strong></p>
                <p class="text-gray-700">Date: <strong class="text-gray-900">{{ now()->toDateString() }}</strong></p>
            </div>

            <form action="{{ route('presences.store', $eleve->id) }}" method="POST" id="confirmationForm">
                @csrf
                <p class="text-gray-700 mt-4">Êtes-vous sûr de vouloir marquer cette personne comme présente ?</p>
                <div class="flex justify-between mt-6">
                    <a href="{{ url()->previous() }}"
                        class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-600 transition">Annuler</a>
                    <button type="button" id="confirmButton"
                        class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition">Confirmer</button>
                </div>
            </form>

            {{-- @if (session('error'))
                <div class="mt-4 text-red-600">{{ session('error') }}</div>
            @endif --}}
        </div>
    </div>

    <script>
        document.getElementById('confirmButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Confirmer la présence',
                text: "Êtes-vous sûr de vouloir marquer cette personne comme présente ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, confirmer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire si l'utilisateur confirme
                    document.getElementById('confirmationForm').submit();
                }
            });
        });


        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ session('error') }}',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
            });
        @endif
    </script>
</body>

</html>

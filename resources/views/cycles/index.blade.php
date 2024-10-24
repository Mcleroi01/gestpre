<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Liste des Cycles, Sections et Classes</h1>
    </div>


    <table id="search-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Cycle
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Section
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Classe
                    </span>
                </th>

                <th>
                    <span class="flex items-center">
                        Action
                    </span>
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($cycles as $cycleKey => $cycle)
                @foreach ($cycle->sections as $sectionKey => $section)
                    @foreach ($section->classes as $classeKey => $classe)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $cycle->nom }}
                            </td>
                            <td>{{ $section->nom }}</td>
                            <td class="border px-4 py-2">{{ $classe->nom }}</td>
                            <td class="border px-4 py-2">
                                @php
                                    // Crée un ID unique en combinant les clés des cycles, sections et classes
                                    $dropdownId = 'dropdownDots' . $cycleKey . $sectionKey . $classeKey;
                                    $buttonId = 'dropdownMenuIconButton' . $cycleKey . $sectionKey . $classeKey;
                                @endphp

                                <button id="{{ $buttonId }}" data-dropdown-toggle="{{ $dropdownId }}"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 4 15">
                                        <path
                                            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="{{ $dropdownId }}"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="{{ $buttonId }}">
                                        <li>
                                            <a href="{{ route('classe.eleves', $classe->id) }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Voir
                                                les élèves</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                                        </li>
                                    </ul>
                                    <div class="py-2">
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Separated
                                            link</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach

        </tbody>
    </table>

    @section('scripts')
        <script>
            if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#search-table", {
                    searchable: true,
                    sortable: false
                });
            }
        </script>

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
    @endsection


</x-app-layout>

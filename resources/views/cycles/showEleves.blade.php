<x-app-layout>
    @if (Session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">

                <span class="font-medium">{{ $error }}</span>

            </div>
        @endforeach
    @endif

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
            data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                    data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Apprenant</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Presence</button>
            </li>

        </ul>
    </div>
    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel"
            aria-labelledby="profile-tab">
            <div class="container">
                <a href="{{ route('eleves.generateClassCards', $classe->id) }}"
                    class="px-3 mt-10 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Générer
                    les cartes de tous les élèves</a>



                @if ($classe->eleves->isEmpty())
                    <p>Aucun élève inscrit dans cette classe.</p>
                @else
                    <table class="min-w-full bg-white" id="search-table">
                        <thead>
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nom</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">prenom</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">postnom</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classe->eleves as $eleve)
                                <tr>
                                    <td class="text-left py-3 px-4">{{ $eleve->nom }}</td>
                                    <td class="text-left py-3 px-4">{{ $eleve->prenom }}</td>
                                    <td class="text-left py-3 px-4">{{ $eleve->postnom }}</td>
                                    <td class="text-left py-3 px-4">
                                        <a href="#" class="text-blue-500 hover:underline">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel"
            aria-labelledby="dashboard-tab">
            <div class="overflow-x-auto">
                <table class="table-auto w-full mt-4" id="presence">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Prénom</th>
                            @foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'] as $jour)
                                @php
                                    // Calcul de la date du jour spécifique de la semaine en cours
                                    $date = now()
                                        ->startOfWeek()
                                        ->addDays(
                                            array_search($jour, [
                                                'lundi',
                                                'mardi',
                                                'mercredi',
                                                'jeudi',
                                                'vendredi',
                                                'samedi',
                                            ]),
                                        )
                                        ->format('d/m/Y');
                                @endphp
                                <th class="px-4 py-2">{{ ucfirst($jour) }} <br> <span
                                        class="text-sm text-gray-500">{{ $date }}</span></th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eleves as $eleve)
                            <tr>
                                <td class="border px-4 py-2 sticky left-0 bg-white">{{ $eleve->nom }}</td>
                                <td class="border px-4 py-2 sticky left-0 bg-white">{{ $eleve->prenom }}</td>
                                @foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'] as $jour)
                                    @php
                                        $date = now()
                                            ->startOfWeek()
                                            ->addDays(
                                                array_search($jour, [
                                                    'lundi',
                                                    'mardi',
                                                    'mercredi',
                                                    'jeudi',
                                                    'vendredi',
                                                    'samedi',
                                                ]),
                                            );
                                        $presence = $eleve->presences
                                            ? $eleve->presences->firstWhere('date', $date->toDateString())
                                            : null;
                                    @endphp
                                    <td class="border px-4 py-2">
                                        @if ($presence && $presence->present)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>

    </div>




    @section('scripts')
        <script>
            if (document.querySelectorAll("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#search-table", {
                    searchable: true,
                    sortable: false
                });
            }


            if (document.querySelectorAll("presence") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#presence", {
                    searchable: true,
                    sortable: false
                });
            }
        </script>
    @endsection
</x-app-layout>

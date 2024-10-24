<x-app-layout>


    <div class=" mt-10 bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl text-royalblue font-semibold text-center relative pb-2">
            Inscription d'un Élève
            <span class="absolute left-0 top-2.5 w-5 h-5 rounded-full bg-royalblue"></span>
            <span class="absolute right-0 top-2.5 w-5 h-5 rounded-full bg-royalblue animate-pulse"></span>
        </h1>

        <form action="{{ route('eleves.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <div class="flex flex-col">
                <label for="nom" class="relative">
                    <input type="text" name="nom" id="nom"
                        class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-royalblue w-full"
                        required>
                    <span class="absolute left-3 top-3 text-gray-500 text-sm">Nom</span>
                </label>
            </div>

            <div class="flex flex-col">
                <label for="prenom" class="relative">
                    <input type="text" name="prenom" id="prenom"
                        class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-royalblue w-full"
                        required>
                    <span class="absolute left-3 top-3 text-gray-500 text-sm">Prénom</span>
                </label>
            </div>

            <div class="flex flex-col">
                <label for="postnom" class="relative">
                    <input type="text" name="postnom" id="postnom"
                        class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-royalblue w-full">
                    <span class="absolute left-3 top-3 text-gray-500 text-sm">Postnom</span>
                </label>
            </div>

            <div class="flex flex-col">
                <label for="sexe" class="relative">
                    <select name="sexe" id="sexe"
                        class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-royalblue w-full"
                        required>
                        <option value="Masculin">Masculin</option>
                        <option value="Féminin">Féminin</option>
                    </select>
                    <span class="absolute left-3 top-3 text-gray-500 text-sm">Sexe</span>
                </label>
            </div>

            <div class="flex flex-col">
                <label for="adresse" class="relative">
                    <input type="text" name="adresse" id="adresse"
                        class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-royalblue w-full">
                    <span class="absolute left-3 top-3 text-gray-500 text-sm">Adresse</span>
                </label>
            </div>

            <div class="flex flex-col">
                <label for="classe_scolaire_id" class="relative">
                    <select name="classe_scolaire_id" id="classe_scolaire_id"
                        class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-royalblue w-full"
                        required>
                        @foreach ($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }} {{ $classe->section->nom }}</option>
                        @endforeach
                    </select>
                    <span class="absolute left-3 top-3 text-gray-500 text-sm">Classe</span>
                </label>
            </div>

            <button type="submit"
                class="bg-royalblue text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">Inscrire</button>
        </form>

        
    </div>


</x-app-layout>

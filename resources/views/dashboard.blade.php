<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="scripts">
        <script>
            const cashflows = {!! json_encode($cashflows) !!};
            const quarters = ['Q1', 'Q2', 'Q3', 'Q4'];

            function rupiah(value) {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(value);
            }
        </script>
        @vite('resources/js/dashboard.ts')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-stretch w-full overflow-auto p-1">
                        <select name="year" id="year"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 me-2">
                        </select>

                        <div class="flex">
                            <label for="credit" class="p-2.5">Kredit</label>
                            <input type="text" id="credit" name="credit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 me-2"
                                readonly>
                        </div>
                        <div class="flex">
                            <label for="debit" class="p-2.5">Debit</label>
                            <input type="text" id="debit" name="debit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 me-2"
                                readonly>
                        </div>
                        <div class="flex">
                            <label for="balance" class="p-2.5">Saldo</label>
                            <input type="text" id="balance" name="balance"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 me-2"
                                readonly>
                        </div>
                    </div>
                    <div>
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

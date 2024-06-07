<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Cashflows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="mb-5">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                        Judul
                    </label>
                    <input type="text" id="title" name="title" value="{{ $cashflow['title'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Tidak ada judul . . ." readonly />
                </div>

                <div class="mb-5">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                        Nominal
                    </label>
                    <input type="text" id="amount" name="amount" value="{{ $cashflow['amount'] }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Tidak ada nominal . . ." readonly />
                </div>

                <div class="mb-5">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900">
                        Jenis
                    </label>
                    <input type="text" id="type" name="type"
                        value="{{ $cashflow['type'] ? 'Kredit' : 'Debit' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Tidak ada jenis . . ." readonly />
                </div>

                <div class="mb-5">
                    <label for="info" class="block mb-2 text-sm font-medium text-gray-900">
                        Keterangan
                    </label>
                    <textarea id="info" name="info" rows="5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Tidak ada keterangan . . ." readonly>{{ $cashflow['info'] }}</textarea>
                </div>

                <div class="flex justify-end">
                    <form action="{{ route('cashflows.destroy', ['cashflow' => $cashflow['id']]) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                            Hapus
                        </button>
                    </form>

                    <a href="{{ route('cashflows.edit', ['cashflow' => $cashflow['id']]) }}"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                        Ubah
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

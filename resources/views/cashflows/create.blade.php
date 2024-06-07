<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Cashflows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('cashflows.store') }}" method="post">
                    @csrf

                    <div class="mb-5">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                            Judul
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan judul . . ." />
                        @error('title')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                            Nominal
                        </label>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan nominal . . ." />
                        @error('amount')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900">
                            Jenis
                        </label>
                        <select id="type" name="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option hidden value>Pilih jenis . . .</option>
                            <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Debit</option>
                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Kredit</option>
                        </select>
                        @error('type')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="info" class="block mb-2 text-sm font-medium text-gray-900">
                            Keterangan
                        </label>
                        <textarea id="info" name="info" rows="5"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan keterangan . . .">{{ old('info') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Tambah
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

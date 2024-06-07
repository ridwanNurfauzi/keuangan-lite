<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cashflows') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-4 flex justify-center">
                    <a type="button" href="{{ route('cashflows.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                        Tambah
                    </a>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Tanggal</th>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Nominal</th>
                                    <th scope="col" class="px-6 py-3">Jenis</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($cashflows))
                                    @foreach ($cashflows as $cashflow)
                                        <tr class="border-b">
                                            <td scope="col" class="px-6 py-3">
                                                {{ date_format($cashflow['created_at'], 'd-m-Y') }}
                                            </td>
                                            <td scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $cashflow['title'] }}</td>
                                            <td scope="col" class="px-6 py-3">
                                                {{ 'Rp ' . number_format($cashflow['amount'], 2, ',', '.') }}
                                            </td>
                                            <td scope="col" class="px-6 py-3">
                                                {{ $cashflow['type'] ? 'Kredit' : 'Debit' }}
                                            </td>
                                            <td scope="col" class="px-6 py-3">
                                                <div class="flex">
                                                    <a href="{{ route('cashflows.show', ['cashflow' => $cashflow['id']]) }}"
                                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                                        Lihat
                                                    </a>
                                                    <a href="{{ route('cashflows.edit', ['cashflow' => $cashflow['id']]) }}"
                                                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                                        Ubah
                                                    </a>
                                                    <form
                                                        action="{{ route('cashflows.destroy', ['cashflow' => $cashflow['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="delete">
                                                        <button type="submit"
                                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">Mohon maaf terjadi kesalahan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

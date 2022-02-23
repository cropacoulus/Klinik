<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Dokter
    </h2>
</x-slot>
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!---- Modal Create ---->
                <div x-data="{ open: false }">
                    <button @click="open = true" id="addModalDokter" wire:click="resetFields()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Dokter</button>
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg py-2 px-4 rounder my-4" placeholder="Search" wire:model="search">
                    <div  x-show="open" wire:ignore.self aria-hidden="true" tabindex="1" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" id="addDokterModal">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <!-- This element is to trick the browser into centering the modal contents. -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                            
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div class="flex justify-end p-2">
                                    <button @click="open = false" type="button" id="closeModalDokter" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                    </button>
                                </div>
                                <form>
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="">
                                            <div class="mb-4">
                                                <label for="formID" class="block text-gray-700 text-sm font-bold mb-2">ID Dokter:</label>
                                                <input type="text" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formID" wire:model="iddokter">
                                                @error('iddokter') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="formName" class="block text-gray-700 text-sm font-bold mb-2">Nama Dokter:</label>
                                                <input type="text" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formName" wire:model="namadokter">
                                                @error('namadokter') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="formJenkel" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
                                                <label for="laki-laki" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"><input type="radio" name="jk" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" wire:model="jk" value="laki-laki" aria-labelledby="laki-laki" aria-describedby="laki-laki"> Laki-Laki</label>
                                                <label for="perempuan" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"><input type="radio" name="jk" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" wire:model="jk" value="perempuan" aria-labelledby="perempuan" aria-describedby="perempuan"> Perempuan</label>
                                                @error('jk')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="formTanggallahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir:</label>
                                                <input type="date" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formTanggallahir" wire:model="tanggallahir">
                                                @error('tanggallahir') 
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="formPhone" class="block text-gray-700 text-sm font-bold mb-2">No Hp:</label>
                                                <input type="text" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formPhone" wire:model="nohp">
                                                @error('nohp') <span class="text-red-500">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="formEmail" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                                <input type="email" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formEmail" wire:model="email">
                                                @error('email') 
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="formAlamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Alamat:</label>
                                                <textarea id="formAlamat" name="alamat" rows="4" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="alamat"></textarea>
                                                @error('alamat') 
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="formTarif" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Tarif Dokter:</label>
                                                <input type="text" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formTarif" wire:model="tarifdokter">
                                                @error('tarifdokter') 
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                            <button wire:click.prevent="store()" @click="open = false" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Save
                                            </button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---- Modal Create ---->
                
                
                @if($isModal)
                    @include('livewire.dokter.update')
                @endif
 
                <table class="md:table-fixed min-w-full divide-y divide-gray-200 border-collapse border border-slate-400">
                    <thead class="bg-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">ID Dokter</th>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Nama Dokter</th>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Jenis Kelamin</th>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Tanggal Lahir</th>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">No Hp</th>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Email</th>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Alamat</th>
                            <th scope="col" class="py-3 px-6 text-md font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Tarif</th>
                            <th scope="col" class="relative py-3 px-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody  class="bg-white divide-y divide-gray-200">
                        @foreach ($dokters as $row)
                            <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $row->iddokter }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $row->namadokter }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $row->jk }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $row->tanggallahir }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $row->nohp }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $row->email }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $row->alamat }}</td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $row->tarifdokter }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 inline-flex items-center justify-center p-2 rounded-md " id="update">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 inline-flex items-center justify-center p-2 rounded-md ">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $dokters->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
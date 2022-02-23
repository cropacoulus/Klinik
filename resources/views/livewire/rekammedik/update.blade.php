<div wire:ignore.self aria-hidden="true" tabindex="1"  class=" fixed z-10 inset-0 overflow-y-auto ease-out duration-400" id="updatePasienModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="flex justify-end p-2">
                <button type="button" wire:click="closeModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="formID" class="block text-gray-700 text-sm font-bold mb-2">ID Rekammedik:</label>
                            <input type="text" disabled class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formID" wire:model="idrekammedik">
                            @error('idrekammedik') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="formPasien" class="block text-gray-700 text-sm font-bold mb-2">Nama Pasien:</label>
                            <select name="idpasien" wire:model="pasien_id" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">--SELECT PASIEN--</option>
                                @foreach ($pasiens as $pas)
                                    <option value="{{ $pas->id }}">{{ $pas->namapasien }}</option>
                                @endforeach
                            </select>
                            @error('idpasien') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="formDokter" class="block text-gray-700 text-sm font-bold mb-2">Nama Dokter:</label>
                            <select name="iddokter" wire:model="dokter_id" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">--SELECT DOKTER--</option>
                                @foreach ($dokters as $dok)
                                    <option value="{{ $dok->id }}">{{ $dok->namadokter }}</option>
                                @endforeach
                            </select>
                            @error('iddokter')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="formTanggalberobat" class="block text-gray-700 text-sm font-bold mb-2">Tanggal berobat</label>
                            <input type="date" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formTanggalberobat" wire:model="tanggalberobat">
                            @error('tanggalberobat') 
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="formDiagnosa" class="block text-gray-700 text-sm font-bold mb-2">Diagnosa Dokter:</label>                                               
                            <textarea class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="formDiagnosa" rows="10" wire:model="diagnosadokter"></textarea>
                            @error('stok') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
    
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="update()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Save
                        </button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

namespace App\Http\Livewire;

use App\Models\Obat;
use App\Models\Resep;
use Livewire\Component;
use App\Models\Rekammedik;
use Livewire\WithPagination;

class Kasirs extends Component
{
    public $search, $paging, $pilihan = [];
    public $isModal = 0;
    use WithPagination;

    public function mount()
    {
        $this->pilihan = collect();
        $this->paging = 5;
    }

    public function render()
    {
        if($this->search){
            $reseps = Resep::with('rekammedik')
            ->where(function ($query){
                $query->where('idresep', 'like', "%$this->search%")
                ->orWhere('tanggalresep', 'like', "%$this->search%")
                // ->orWhere('namapasien', 'like', "%$this->search%")
                // ->orWhere('namadokter', 'like', "%$this->search%")
                // ->orWhere('diagnosadokter', 'like', "%$this->search%")
                // ->orWhere('namaobat', 'like', "%$this->search%")
                ->orWhere('dosis', 'like', "%$this->search%");
            })->orderBy('idresep', 'asc')->paginate($this->paging);
        }else{
            $reseps = Resep::orderBy('idresep', 'asc')->paginate($this->paging);
        }
        $rekams = Rekammedik::orderBy('idrekammedik', 'asc')->get();
        $obats = Obat::orderBy('idobat', 'asc')->get();
        return view('livewire.kasir.kasirs', compact('reseps', 'rekams', 'obats'));
    }

    public function getId()
    {
        if(!$this->pilihan){
            dd($this->pilihan);
        }else{
            // $res = Resep::query()->whereIn('id', $this->pilihan)->get();
            dd($this->pilihan);
        }
    }
}

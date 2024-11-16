<?php

namespace App\Livewire\Svo;

use App\Models\SvoTrebItem;
use Livewire\Component;

class TrebsDataTableLower extends Component
{

    public $upup = [];
    public $up_id  ;
    public $up_uroven ;
    public $data = [];
    public $data_row;
    public $data_head;
    public $show_podrobnee = false;

    public $loading_details = [];

    public function mount()
    {
//        if ($this->upup['children_count'] > 0) {
        if (empty($this->up_id)) {
            $this->data = SvoTrebItem::query()
//                ->whereId($this->upup['id'])
                ->whereUroven(1)
                ->withCount('children') // Подсчёт связанных записей
                ->get()
                ->toArray();
        } else {
            $this->data = SvoTrebItem::query()
                ->whereUp_id($this->up_id)
                ->whereUroven($this->up_uroven + 1)
                ->withCount('children') // Подсчёт связанных записей
                ->get()
                ->toArray();
        }
    }

    public function switchPodrobnee($id)
    {

        if (!isset($this->show_podrobnee[$id])) {
            $this->show_podrobnee[$id] = true;
        } else {
            $this->show_podrobnee[$id] = !$this->show_podrobnee[$id];
        }

    }

    public function render()
    {
        return view('livewire.svo.trebs-data-table-lower');
    }
}

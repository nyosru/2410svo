<?php

namespace App\Livewire\Svo;

use App\Models\SvoTrebItem;
use Livewire\Component;

class TrebsDataTableLower extends Component
{

    public $upup = [];
    public $up_id;
    public $up_uroven;
    public $data = [];
    public $data_row;
    public $data_head;
    public $show_podrobnee = false;
    public $show_for_ul = false;
    public $show_analogi = [];

    public $loading_details = [];

    public function mount()
    {
//        if ($this->upup['children_count'] > 0) {
        if (empty($this->up_id)) {
            $this->data = SvoTrebItem::query()
                ->with('photoLoaded')
//                ->whereId($this->upup['id'])
                ->whereUroven(1)
                ->withCount('children') // Подсчёт связанных записей
                ->get()
                ->toArray();
        } else {
            $this->data = SvoTrebItem::query()
                ->with('photoLoaded')
                ->whereUp_id($this->up_id)
                ->whereUroven($this->up_uroven + 1)
                ->withCount('children') // Подсчёт связанных записей
                ->get()
                ->toArray();
        }
    }

    public function switchAnalogi($id){
        if (!isset($this->show_analogi[$id])) {
            $this->show_analogi[$id] = true;
        } else {
            $this->show_analogi[$id] = !$this->show_analogi[$id];
        }
    }

    public function switchForUl($id)
    {
        if (!isset($this->show_for_ul[$id])) {
            $this->show_for_ul[$id] = true;
        } else {
            $this->show_for_ul[$id] = !$this->show_for_ul[$id];
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

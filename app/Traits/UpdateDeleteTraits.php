<?php

namespace App\Traits;

trait UpdateDeleteTraits {
    public $deleteId;
    public $model;
    public $deleteModal = false;

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function setDeleteId($id)
    {
        $this->deleteId = $id;
        $this->openDeleteModal();
    }

    public function openDeleteModal()
    {
        $this->deleteModal = true;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', 'modal-backdrop fade show')");
    }

    public function closeDeleteModal()
    {
        $this->deleteModal = false;
        $this->js("document.getElementById('js-display-modal').setAttribute('class', '')");
    }

    public function deleteAction()
    {
        if ($this->deleteId !== null) {
            $this->model::where('id', $this->deleteId)->delete();
        }
        $this->closeDeleteModal();
        session()->flash('success', 'Data telah dihapus!');
        $this->js('location.reload()');
    }
}
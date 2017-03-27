<?php

namespace LaravelEnso\Core\app\Classes\StructureManager;

use LaravelEnso\Core\app\Models\Menu;
use LaravelEnso\Core\app\Models\PermissionsGroup;

class StructureDestroyer
{
    private $permissionsGroup;
    private $menu;

    public function destroy()
    {
        \DB::transaction(function () {
            if ($this->permissionsGroup) {
                $this->permissionsGroup->permissions->each->delete();
                $this->permissionsGroup->delete();
            }

            if ($this->menu) {
                $this->menu->delete();
            }
        });
    }

    public function setPermissionsGroup($permissionsGroup)
    {
        $this->permissionsGroup = new PermissionsGroup($permissionsGroup);
    }

    public function setMenu($menu)
    {
        $this->menu = new Menu($menu);
    }
}

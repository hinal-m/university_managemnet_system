<?php

namespace App\Repositories;

use App\Interfaces\CollegeInterface;
use App\Models\College;
use Illuminate\Support\Facades\Hash;

class CollegeRepository implements CollegeInterface
{
    public function all()
    {
        return College::all();
    }

    public function store(array $data)
    {
        $collge = new College();
        $collge->name = $data['name'];
        $collge->email = $data['email'];
        $collge->address = $data['address'];
        $collge->contact_no = $data['contact'];
        $collge->status = '1';
        $logo = uploadFile($data['logo'], 'college');
        $collge->logo = $logo;
        $collge->password = Hash::make($data['password']);
        $save = $collge->save();
        return $save;
    }

    public function update(array $data)
    {
        $college = College::find($data['id']);
        $college->name = $data['name'];
        $college->email = $data['email'];
        $college->address = $data['address'];
        $college->contact_no = $data['contact'];
        $college->status = '1';
        if (isset($data['logo'])) {
            $image = $college->getRawOriginal('logo');
            if (file_exists(public_path('storage/college/' . $image))) {
                @unlink(public_path('storage/college/' . $image));
            }
            $images = uploadFile($data['logo'], 'college');
            $college->logo = $images;
        } else {
            $images = $college->getRawOriginal('logo');
        }
        $save = $college->save();
        return $save;
    }

    public function delete(array $data)
    {
        $category = College::find($data['id']);
        $category->delete();
        return $category;
    }
}

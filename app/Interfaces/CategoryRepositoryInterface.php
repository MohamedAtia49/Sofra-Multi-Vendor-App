<?php
namespace App\Interfaces;
interface CategoryRepositoryInterface
{
    public function all($model);
    public function create($nameView);
    public function store($model,array $request);
    public function edit($model,$id);
    public function update($model,$id,array $request);
    public function destroy($model,$id);
}

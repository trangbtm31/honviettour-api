<?php
namespace Honviettour\Contracts;

interface ServiceInterface {
    public function search($request);
    public function create($request);
    public function update($request, $model);
}
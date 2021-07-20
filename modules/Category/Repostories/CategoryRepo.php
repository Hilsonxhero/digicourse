<?php


namespace Category\Repostories;


use Category\Models\Category;

class CategoryRepo
{
    public function all()
    {
        return Category::all();
    }

    public function allExceptById($id)
    {
        return Category::all()->filter(function ($item) use ($id) {
            return $item->id != $id;
        });
    }

    public function store($values)
    {
        return Category::query()->create([
            'name' => $values->name,
            'slug' => $values->slug,
            'parent_id' => $values->parent_id
        ]);

    }

    public function update($values, $category)
    {
        return $category->update([
            'name' => $values->name,
            'slug' => $values->slug,
            'parent_id' => $values->parent_id
        ]);

    }

    public function destroy($category)
    {
        return $category->delete();
    }

    public function tree()
    {
        return Category::query()->where('parent_id', null)->with('sub')->get();
    }

}

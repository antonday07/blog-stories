<?php

namespace App\Traits;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


trait CategoryTagList {

    public function createCategory($arrCat, $post) {

        $titles = Category::all()->pluck('title')->toArray();
        foreach ($arrCat as $cat) {
            $catItem = explode(':', $cat); // turn into another array contain id and title
         //   dd($catItem);
            if (in_array($catItem[0], $titles)) {
                $post->category_post()->updateOrCreate([
                    'post_id' => $post->id,
                    'category_id' => (int) $catItem[1]
                ]);

            } else {
                $newCategory = new Category();
                $newCategory->title = $catItem[0];
                $newCategory->slug = Str::slug($catItem[0], '-');
                $newCategory->content = Str::random(40);
                $newCategory->timestamps = true;
                $newCategory->save();

                $post->category_post()->updateOrCreate([
                    'post_id' => $post->id,
                    'category_id' => $newCategory->id
                ]);
            }

        }
    }

    public function createTag($arrTag, $post) {
        $titles = Tag::all()->pluck('title')->toArray();

        foreach ($arrTag as $newTag) {
            $tagItem = explode(':', $newTag); // turn into another array contain id and title

            if (in_array($tagItem[0], $titles)) {
                $post->post_tag()->updateOrCreate([
                    'post_id' => $post->id,
                    'tag_id' => (int) $tagItem[1]
                ]);

            } else {
                $tag = new Tag();
                $tag->title = $tagItem[0];
                $tag->slug = Str::slug($tagItem[0], '-');
                $tag->content = Str::random(40);
                $tag->timestamps = true;
                $tag->save();


                $post->post_tag()->updateOrCreate([
                    'post_id' => $post->id,
                    'tag_id' => (int) $tag->id
                ]);

            }

        }
    }
}

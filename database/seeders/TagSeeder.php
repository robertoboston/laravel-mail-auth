<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['HTML','CSS','Javascript','VueJs','PHP','Laravel']; 

        foreach($tags as $tag){
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag-> slug = Tag::generateSlug($newTag->name);

            $newTag->save();
        }
    }
}

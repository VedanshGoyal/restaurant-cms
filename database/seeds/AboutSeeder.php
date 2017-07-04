<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about')->delete();

        About::create([
            'title' => 'Restaurant CMS',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel velit erat. Nullam at lacus dolor. Vestibulum sed diam sit amet sapien placerat fermentum. Sed posuere pharetra volutpat. Praesent vel magna eget tellus eleifend feugiat vel feugiat purus. Nam non sapien convallis, porta massa ut, egestas elit. Duis ac consequat enim. Phasellus est purus, pretium et vestibulum eget, dignissim et orci. Aenean sodales interdum pharetra. Vivamus ultricies elementum orci, vel bibendum elit mattis eu. Duis sit amet accumsan lacus. Integer in tellus nunc. Vestibulum vulputate orci nec ullamcorper congue. Nullam fermentum orci ac quam efficitur sagittis. Donec aliquam efficitur urna sed dignissim.
            
            Vestibulum hendrerit tellus id tortor sodales, non congue magna lacinia. Donec id nisi ac urna lacinia tristique. Nullam cursus tincidunt rutrum. Fusce pretium elit vel lectus sodales accumsan. In nibh sem, ullamcorper a porttitor sed, dictum at purus. Etiam molestie risus dui, eu malesuada dui tristique vel. Nam luctus sit amet ante at dignissim. Praesent hendrerit maximus justo, in hendrerit augue vehicula sit amet. Etiam non ex feugiat, consequat dui eu, tempus urna. Vivamus facilisis odio quis tincidunt fringilla. Aenean quis erat sed ipsum commodo placerat at id nibh. Fusce vel dui purus. Proin pharetra tempus magna eget scelerisque. Morbi sit amet nisi at enim tristique porta. Nunc cursus non enim et accumsan.',
        ]);
    }
}

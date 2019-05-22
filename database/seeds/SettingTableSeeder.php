<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'attribute_key'               => 'language_code',
            'attribute_value'             => 'en',
            'description'                 => 'Language short code',
            'is_active'                   => 1,
        ]);

        Setting::create([
            'attribute_key'               => 'country',
            'attribute_value'             => 'turkey',
            'description'                 => 'Country name',
            'is_active'                   => 1,
        ]);

        Setting::create([
            'attribute_key'               => 'city',
            'attribute_value'             => 'Istanbul',
            'description'                 => 'City name',
            'is_active'                   => 1,
        ]);

        Setting::create([
            'attribute_key'               => 'title',
            'attribute_value'             => 'Bazarc',
        ]);

        Setting::create([
            'attribute_key'               => 'description',
            'attribute_value'             => 'description',
        ]);

        Setting::create([
            'attribute_key'               => 'keywords',
            'attribute_value'             => 'keywords',
        ]);

        Setting::create([
            'attribute_key'               => 'timezone',
            'attribute_value'             => 'Europe/Istanbul',
        ]);

        Setting::create([
            'attribute_key'               => 'logo',
            'attribute_value'             => 'logo.jpg',
        ]);

        Setting::create([
            'attribute_key'               => 'abstract_text',
            'attribute_value'             => 'abstract_text ler ',
        ]);

        Setting::create([
            'attribute_key'               => 'footer_text',
            'attribute_value'             => 'site alt yazısı',
        ]);

        Setting::create([
            'attribute_key'               => 'contact',
            'attribute_value'             => '',
        ]);

        Setting::create([
            'attribute_key'               => 'copyright',
            'attribute_value'             => 'copyright yazısı',
        ]);

        Setting::create([
            'attribute_key'               => 'slogan',
            'attribute_value'             => 'Sloganımız',
        ]);

        /*
         * user_registration_type alanı "0" yani Setting::PUBLIC olmalı.
         * Çünkü sistem seeder işlemi yaptığında user oluştururken farklı bir değer varsa status alanını "1" yapmıyor bundan dolayı da kullanıcı giriş yapamıyor.
         * */
        Setting::create([
            'attribute_key'               => 'registration_type',
            'attribute_value'             => (int) 1,
        ]);

        Setting::create([
            'attribute_key'               => 'user_contract',
            'attribute_value'             => 'user_contract',
        ]);

        Setting::create([
            'attribute_key'               => 'user_default_role',
            'attribute_value'             => 1,
        ]);

        //$url = \Illuminate\Support\Facades\Route::current()->domain();
        Setting::create([
            'attribute_key'               => 'url',
            'attribute_value'             => 'http://www.bazarc.test',
        ]);

        Setting::create([
            'attribute_key'               => 'google_recaptcha_site_key',
            'attribute_value'             => '6Leo2RsUAAAAAJtI0Mc6lqd2Nme25F2xLg3r5CER',
        ]);

        Setting::create([
            'attribute_key'               => 'google_recaptcha_secret_key',
            'attribute_value'             => '6Leo2RsUAAAAAEPPstzkGLtPV3W8IDsaYjtdIIib',
        ]);

        Setting::create([
            'attribute_key'               => 'head_code',
            'attribute_value'             => 'head codes ',
        ]);

        Setting::create([
            'attribute_key'               => 'footer_code',
            'attribute_value'             => 'footer codes',
        ]);

        Setting::create([
            'attribute_key'               => 'facebook',
            'attribute_value'             => 'face account',
        ]);

        Setting::create([
            'attribute_key'               => 'facebook_embed_code',
            'attribute_value'             => ''
        ]);

        Setting::create([
            'attribute_key'               => 'twitter',
            'attribute_value'             => 'twitter account',
        ]);

        Setting::create([
            'attribute_key'               => 'twitter_embed_code',
            'attribute_value'             => '<a class="twitter-timeline" href="https://twitter.com/RecaiCansiz">Tweets by RecaiCansiz</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>',
        ]);

        Setting::create([
            'attribute_key'               => 'instagram',
            'attribute_value'             => 'instagram account',
        ]);

        Setting::create([
            'attribute_key'               => 'instagram_embed_code',
            'attribute_value'             => '<!-- SnapWidget --><iframe src="https://snapwidget.com/embed/335198" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:500px; height:125px"></iframe>',
        ]);

        Setting::create([
            'attribute_key'               => 'addthis',
            'attribute_value'             => 'addthis account js',
        ]);

        Setting::create([
            'attribute_key'               => 'disqus',
            'attribute_value'             => '',
        ]);

        Setting::create([
            'attribute_key'               => 'sitemap_count',
            'attribute_value'             => '20',
        ]);

        Setting::create([
            'attribute_key'               => 'allow_photo_formats',
            'attribute_value'             => 'jpg,tiff,gif,png',
        ]);

        Setting::create([
            'attribute_key'               => 'allow_video_formats',
            'attribute_value'             => 'video/avi,video/mpeg,video/quicktime,avi,mov,mp4,3gp,3gp2,wmv,flv',
        ]);

        Setting::create([
            'attribute_key'               => 'latitude',
            'attribute_value'             => '41.0082',
        ]);

        Setting::create([
            'attribute_key'               => 'longitude',
            'attribute_value'             => '28.9784',
        ]);

        //profile permissions
        Permission::create(['name' => 'index-setting']);
        Permission::create(['name' => 'show-any-setting']);
        Permission::create(['name' => 'show-setting']);
        Permission::create(['name' => 'edit-setting']);
        Permission::create(['name' => 'create-setting']);
        Permission::create(['name' => 'store-setting']);
        Permission::create(['name' => 'edit-any-setting']);
        Permission::create(['name' => 'update-any-setting']);
        Permission::create(['name' => 'update-setting']);
        Permission::create(['name' => 'delete-setting']);
        Permission::create(['name' => 'delete-any-setting']);
    }
}

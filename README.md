# GuestBook-laravel6
## laravel 6
laravel 6 版本發布於 2019年9月3日，雖然還未到非常穩定，但是在許多部份和 5 已經有很大的區別，所以我跳過 laravel 5 直接學習 laravel 6

laravel 5 和 laravel 6 最大的區別應該是 laravel 6 中增加了一個新的 lazycollection ，它可以在讀取資料時不一次讀取完，而是一筆一筆的讀取，這樣可以大大的減少內存的使用量，是還滿不錯的功能

- - -
## 準備環境
安裝 laravel
`composer global require laravel/installer`
查看 laravel 版本
`laravel --version`
新增專案
`laravel new 專案名稱`
如果專案內沒有 vender 資料夾和 autoload.php
`composer update --no-scripts`
`composer update`
生成一個 APP_KEY
`php artisan key:generate`
設定 .env 檔
`DB_DATABASE=laravel`
`DB_USERNAME=root`
`DB_PASSWORD=`

- - -
## Blade
在 laravel 中，blade 是一個非常方便的東西，只需要創建一次，並在其他的 blade 中直接 `@extends` 就能使用了，而且在主 blade 中使用 `@yield`，就能在這個位置插入想顯示的東西
例如：
``````PHP
# page.blade.php
<div>
    <p>Good!<p>
    @yield('content')
</div>
``````

``````PHP
# index.blade.php
@extends('page')
@section('content')
    <p>Hello!<p>
@endsection
``````

所有的 blade 都放在 resources/views 裡，而在設定 route 時也會直接到這裡來找適合的檔案

## route
設定 route 的地方在 routes/web.php

- - -
## laravel 開發流程
laravel 的開發流程算是滿重要的，如何才能非常順利的開發，其實是有步驟，我對於 laravel 的理解步驟是這樣：
1. 創建基本 table
2. 創建 Model
3. 創建內建的會員系統
4. 創建 Controller
5. 配合 Controller 開發前端頁面

laravel 的增加功能步驟：
1. 增加 table 或是增加 table 的欄位
2. 修改 Model 中，對其他 Model 的關係
3. 創建 Controller 或增加 Controller 中的 function
4. 配合功能開發前端頁面

<strong>當然以上的步驟也可以先開發前端頁面，不過到頭來都是要配合</strong>

- - -
## 創建基本 table
創建 table 我們使用 laravel 中的指令
`php artisan make:migration create_(tables)_table`
<strong>這邊要注意 tables 是名稱，而且要使用複數</strong>

創建好的檔案會放在 database/migrations 中，這時我們就可以打開這個檔案，我們就能看到以下的程式碼
```php
Schema::create('tables', function (Blueprint $table) {
    $table->bigIncrements('id'); // 自增長的主鍵
    $table->string('欄位名稱', 255); // 依需求增加欄位
    ...
    $table->softDeletes(); // 軟刪除功能
    $table->timestamps(); // 自動建立創建和更新資料的時間
});
```

設定好後使用指令 `php artisan migrate`，就可以直接在資料庫中建立 table 了

## 創建 Model
創建 Model 我們使用 laravel 中的指令
`php artisan make:model Table`
<strong>這邊要使用跟 table 一樣的名字，而且需要大寫開頭和單數</strong>

創建好的檔案會放在 app 中，我們打開來輸入一些資訊
```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 軟刪除

class Table extends Model
{
    use SoftDeletes; // 軟刪除
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '欄位名稱', '欄位名稱', '欄位名稱' // 會使用到的欄位
    ];
    
    // 這邊可以加入與其他 table 的關係，就像是外鍵設定
}
```
<strong>這邊要注意，如果在 table 中有使用軟刪除，這邊就一定也要加入軟刪除的設置，否則會報錯</strong>

## 創建會員系統
先安裝產生畫面的套件
`composer require laravel/ui`
利用套件產生基本畫面
`php artisan ui vue --auth`

創建完我們就能在 resources/views 中看到有關會員的 blade 了
如果要直接使用的話，在 resources/views/layouts/app.blade.php 中的 css 載入路徑要改成
`<link href="{{ asset('css/paging.css') }}" rel="stylesheet" type="text/css" media="screen" />`
否則有可能會造成 css 沒有讀取到的情況

## 創建 Controller
創建 Controller 使用 laravel 的指令
`php artisan make:controller TableController --resource --model=Table`
<strong>這邊 Table 也是要用大寫，而且可以直接使用 --model 連接對應的 Model</strong>
創建完後檔案會在 app/Http/Controllers 中，現在我們來看裡面有什麼
```php
namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }
    ...
```
在這邊我們可以看到在一個 TableController 中有 7 個 function
在了解這些功能前，我們先到 routes/web.php 中設定 route
在 web.php 中加入
`Route::resource('tables', 'TableController');`
這個 route 代表，當訪問 /tables 時，都會轉到 TableController 中執行各種功能

1. index - 訪問 /tables 會執行
2. create - 訪問 /tables/create 會執行
3. store - 在 create 中提交 post 時會執行
4. show - 訪問 /tables/id 會執行
5. edit - 訪問 /tables/id/edit 會執行
6. update - 在 edit 中提交 post 時會執行
7. destroy - 在 edit 中指定 post 時會執行

所以我們在看到上面的各個會發生的情況，就能了解我們在前端需要準備 4 個 blade
那我們就在 resources/views 中創建 tables 資料夾，並在裡面創建 4 個 blade

resources

```
resources
    └── views
          └── tables
                 ├── index.blade.php
                 ├── create.blade.php
                 ├── show.blade.php
                 └── edit.blade.php
```

那在 TableController 中的各個 function 中我們處理完要傳到前端的資料後，就能 return 這幾個 blade 和資料了
Ex : `return view('tables.index', ['tables' => Table::all()]);`

## 開發前端頁面
在前端的部份，後端傳來的資料會是一個 array 或是一個對象，複數我們通常會用 `@foreach($tables as $table)` 來做一些重複性的顯示，裡面我們就可以直接使用 {{ $table->欄位名稱 }} 來獲取資料，單數就直接使用

- - -
## 移至 CentOS
開發完後移至 CentOS 中的注意事項
1. 先修改 .env 裡的 DB 資訊
2. mysql 密碼不能有 #
3. 在資料庫中創建 DB
4. 執行指令 `php artisan migrate` 創建 table
5. 確認伺服器的根目錄
6. 開啟瀏覽器測試是否成功

- - -
## 2020/01/08 更新
在 index 的部份增加 LIVE 功能
- 使用 Wowza 後台和 GoCoder APP 直播軟體

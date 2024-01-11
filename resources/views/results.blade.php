<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>画面のレイアウト</title>
  <link rel="stylesheet" href="{{ asset('css/results.css') }}">
</head>
<body>
  <div class="header">
    <div class="search-bar">
      <input type="text" placeholder="検索">
      <button><img src="https://i.imgur.com/6Z4d5Jj.png" alt="マイク"></button>
    </div>
    <div class="user-profile">
      <img src="https://i.imgur.com/7b3Yw2K.png" alt="ユーザー">
    </div>
  </div>
  <div class="result-message">
    <h2>{{ $count }}件のスーパーがヒットしました。</h2>
  </div>
  <hr>
  <br>
  <div class="ice-cream-photo">
    <img src="{{ asset('images/' . $category->title . '/' . $img->image) }}" width="300" height="300">
  </div>
  <div class="shop-list">
  @foreach($results as $result)
    <div class="shop-list-item">
      <div class="shop-list-item-info">
        <div class="shop-list-item-name">スーパー名：{{ $result->s_name }}</div>
        <div class="shop-list-item-price">価格：{{ $result->price }}</div>
        <div class="shop-list-item-address">住所：{{ $result->address }}</div>
        <div class="shop-list-item-hours">開店時間：{{ $result->open_time }}</div>
        <div class="shop-list-item-hours">開店時間：{{ $result->close_time }}</div>
        <br>
    </div>
    </div>
    @endforeach
    </div>
</body>
</html>
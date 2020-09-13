@extends('layouts.app')

@section('title' , 'Muscle+')


@section('content')
<div class="container">
  <div class="welcome">
    <div class="logos">
      <div class="logo">
        <img src="{{url('images/logo.png')}}" alt="">
      </div>
      <div id="catch">
        <p>筋トレの成果を、</p>
        <p>見えるものに。</p>
      </div>
    </div>
    <div class="intro">
      <div class="row">
        <div class="col-md-4">
          <h3>モチベーションが続く</h3>
          <p>筋トレ仲間の記録は、あなたのモチベーションアップにつながります。今すぐ記録を始めましょう！</p>
        </div>
        <div class="col-md-4">
          <h3>筋トレ仲間と情報共有</h3>
          <p>筋トレのやり方や、おすすめのジム、プロテインなどの情報を共有しましょう。</p>
        </div>
        <div class="col-md-4">
          <h3>鍛えた部位の可視化</h3>
          <p>鍛える部位は、偏りがちです。グラフで可視化することで、偏りのない筋トレを行いましょう。</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

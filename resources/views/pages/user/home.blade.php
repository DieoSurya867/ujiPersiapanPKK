@extends('layouts.perpus')

@section('content')
    <section class="blogs" id="blogs">
        <h1 class="heading"><span>our blogs</span></h1>

        <div class="swiper blogs-slider">
            <div class="swiper-wrapper">

                @forelse($artikel as $item)
                    <div class="swiper-slide box">
                        <div class="image">
                            <img src={{ asset('storage/' . $item->foto) }} alt="" />
                        </div>
                        <div class="content">
                            <h3>{{ $item->judul }}</h3>
                            <h4>{{ $item->created_at }}</h4>
                            <p>
                                {{ $item->isi }}
                            </p>
                            <a href="#" class="btn">read more</a>
                        </div>
                    </div>
                @empty
                    <div class="col-3 mb-5">
                        <h5>Artikel Sedang Kosong</h5>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection

@extends('layouts.main_home')

@section('home_content')

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">

                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up">
                @foreach ($images as $row)

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{$row->image }}"
                             class="img-fluid" alt="">
                        <div class="portfolio-info"><h4>App 1</h4>
                            <p>App</p>
                            <a href="{{ $row->image }}"
                               data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i
                                        class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Portfolio Section -->

@endsection
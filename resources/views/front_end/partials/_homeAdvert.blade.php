<div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($adverts as $index => $advert)
            <li data-target="#header-carousel" data-slide-to="{{ $index }}"
                class="{{ $index === 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>

    <div class="carousel-inner">
        @foreach ($adverts as $index => $advert)
            <div class="carousel-item position-relative {{ $index === 0 ? 'active' : '' }}" style="height: 430px;">
                <img class="position-absolute w-100 h-100"
                    src="{{ $advert->image ? asset('storage/' . $advert->image) : asset('../assets/img/profile-img.jpg') }}"
                    alt="{{ $advert->name }}" style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                            {{ $advert->name }}
                        </h1>
                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                            {{ $advert->description }}
                        </p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                            href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

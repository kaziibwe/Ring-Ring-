<div class="container-fluid py-5">

    <div class="row px-xl-5">

        <div class="col">

            <div class="owl-carousel vendor-carousel">
                @foreach ($bottomSideAdverts as $sideAdvert)
                    <div class="bg-light p-4">

                        <img src="{{ $sideAdvert->image ? asset('storage/' . $sideAdvert->image) : asset('../assets/img/profile-img.jpg') }}"
                            alt="">
                    </div>
                @endforeach

            </div>

        </div>

    </div>

</div>

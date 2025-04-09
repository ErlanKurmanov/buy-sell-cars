{{-- It's my Favourite section --}}
<x-app-layout>
    <main>
        <!-- New Cars -->
        <section>
            <div class="container">


                <h2>My Favourite Cars</h2>
                <div class="car-items-listing">
                    @foreach($cars as $car)
                        <x-car-item :$car :isInWatchlist="true"/>
                    @endforeach
                </div>

                {{ $cars->onEachSide(1)->links() }}
            </div>
        </section>
        <!--/ New Cars -->
    </main>
</x-app-layout>

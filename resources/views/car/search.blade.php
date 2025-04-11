<x-app-layout>
    <main>
        <!-- Found Cars -->
        <section>
            <div class="container">
                <div class="sm:flex items-center justify-between mb-medium">
                    <div class="flex items-center">
                        <button class="show-filters-button flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" style="width: 20px">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                            </svg>
                            Filters
                        </button>
                        <h2>Define your search criteria</h2>
                    </div>

                    <select class="sort-dropdown">
                        <option value="">Order By</option>
                        <option value="price">Price Asc</option>
                        <option value="-price">Price Desc</option>
                    </select>
                </div>
                <div class="search-car-results-wrapper">
                    <div class="search-cars-sidebar">
                        <div class="card card-found-cars">
                            <p class="m-0">Found <strong></strong> cars</p>

                            <button class="close-filters-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px">
                                    <path fill-rule="evenodd"
                                          d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                          clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <!-- Find a car form -->
                        <section class="find-a-car">
                            <form action="{{route('cars.search')}}" method="GET" class="find-a-car-form card flex p-medium">
                                <div class="find-a-car-inputs">

                                    <div class="form-group">
                                        <label class="mb-medium">Maker</label>
                                        <select id="makerSelect" name="maker_id">
                                            <option value="">Maker</option>
                                            @foreach ($makers as $maker)
                                                <option value="{{$maker->id}}">{{$maker->name}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="mb-medium">Model</label>
                                        <select id="modelSelect" name="model_id">
                                            <option value="">Model</option>                    
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-medium">Type</label>
                                        <select name="car_type_id">
                                            <option value="">Type</option>
                                            @foreach ($carTypes as $carType)
                                                <option value="{{$carType->id}}">{{$carType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Year</label>
                                        <div class="flex gap-1">
                                            <input type="number" placeholder="Year From" name="year_from" />
                                            <input type="number" placeholder="Year To" name="year_to" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Price</label>
                                        <div class="flex gap-1">
                                            <input type="number" placeholder="Price From" name="price_from" />
                                            <input type="number" placeholder="Price To" name="price_to" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Mileage</label>
                                        <div class="flex gap-1">
                                            <select name="mileage">
                                                <option value="">Any Mileage</option>
                                                @for ($i = 10000; $i<=300000; $i+=10000)
                                                    <option value="{{$i}}">{{number_format($i)}} or less</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Region</label>
                                        <select id="stateSelect" name="state_id">
                                            <option value="">Region</option>
                                            @foreach ($regions as $region )
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-medium">City</label>
                                        <select id="citySelect" name="city_id">
                                            <option value="">City</option>                     
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Fuel Type</label>
                                        <select name="fuel_type_id">
                                            <option value="">Fuel Type</option>
                                            @foreach ($fuelTypes as $fuelType)
                                                <option value="{{$fuelType->id}}"> {{$fuelType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button type="button" class="btn btn-find-a-car-reset">
                                        Reset
                                    </button>
                                    <button class="btn btn-primary btn-find-a-car-submit">
                                        Search
                                    </button>
                                </div>

                                
                            </form>
                        </section>
                        <!--/ Find a car form -->
                    </div>
                    @if ($cars->count() > 0)
                    @endif
                        <div class="search-cars-results">
                            <div class="car-items-listing">
                                @foreach($cars as $car)
                                    <x-car-item :$car/>
                                @endforeach
                            </div>
                            {{ $cars->onEachSide(1)->links() }}

                        </div>
                </div>
            </div>
        </section>
        <!--/ Found Cars -->
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
                // Changing models list depending on maker
            document.getElementById('makerSelect').addEventListener('change', function() {
            const makerId = this.value; // Get selected country ID
            const modelDropdown = document.getElementById('modelSelect'); // Get city dropdown
        
            // Make AJAX request to fetch cities for the selected country
            fetch(`/models/${makerId}`)
                .then(response => response.json())
                .then(data => {
                // Clear existing options
                modelDropdown.innerHTML = '<option value="">Model</option>';
                // Add new options for cities
                data.models.forEach(model => {
                    modelDropdown.innerHTML += `<option value="${model.id}">${model.name}</option>`;
                    
                });
                })
                .catch(error => console.error('Error fetching model:', error));
            });

            // Changing city depending on region
            document.getElementById('stateSelect').addEventListener('change', function() {
                const regionId = this.value; // Get selected country ID
                const cityDropdown = document.getElementById('citySelect'); // Get city dropdown
        
            // Make AJAX request to fetch cities for the selected country
            fetch(`/cities/${regionId}`)
                .then(response => response.json())
                .then(data => {
                // Clear existing options
                cityDropdown.innerHTML = '<option value="">City</option>';
                // Add new options for cities
                data.cities.forEach(city => {
                    cityDropdown.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    
                });
                })
                .catch(error => console.error('Error fetching model:', error));
            });

            //Button reset
            const resetButton = document.querySelector('.btn-find-a-car-reset');
            if (resetButton) {
                resetButton.addEventListener('click', function() {
                    const form = this.closest('form');
                    form.reset();
                })
            }

            // Show/hide filters on mobile
            // const showFiltersButton = document.querySelector('.show-filters-button');
            // const closeFiltersButton = document.querySelector('.close-filters-button');
            // const searchCarsSidebar = document.querySelector('.search-cars-sidebar');
            
            // if (showFiltersButton && closeFiltersButton && searchCarsSidebar) {
            //     showFiltersButton.addEventListener('click', function() {
            //         searchCarsSidebar.classList.add('show');
            //     });
                
            //     closeFiltersButton.addEventListener('click', function() {
            //         searchCarsSidebar.classList.remove('show');
            //     });
            // }
        });
      </script>
</x-app-layout>

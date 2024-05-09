<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Nhân Viên') }}</h2>
        </div>
        <div class="row card-body">
            <!-- Fullname -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Họ và tên') }}:</label>
                    <x-input name="fullname" :value="$employee->fullname" :required="true"
                             placeholder="{{ __('Họ và tên') }}" />
                </div>
            </div>
            <!-- Email -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Email') }}:</label>
                    <x-input-email name="email" :value="$employee->email" :required="true" />
                </div>
            </div>
            <!-- Phone -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số điện thoại') }}:</label>
                    <x-input-phone name="phone" :value="$employee->phone" :required="true" />
                </div>
            </div>
            <!-- Address -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Địa chỉ') }}:</label>
                    <x-input name="address" :value="$employee->address" :placeholder="__('Địa chỉ')" />
                </div>
            </div>
            <!-- Password (optional change) -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mật khẩu') }}:</label>
                    <x-input-password name="password" />
                </div>
            </div>
            <!-- Password Confirmation -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                    <x-input-password name="password_confirmation"
                                      data-parsley-equalto="input[name='password']"
                                      data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                </div>
            </div>
            <!-- Gender -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giới tính') }}:</label>
                    <x-select name="gender" :required="true">
                        <x-select-option value="" :title="__('Chọn Giới tính')" />
                        @foreach ($gender as $key => $value)
                            <x-select-option :option="$employee->gender->value" :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- Roles -->
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vai Trò') }}:</label>
                    <x-select name="roles" :required="true">
                        <x-select-option value="" :title="__('Chọn Vai Trò')" />
                        @foreach ($roles as $key => $value)
                            <x-select-option :option="$employee->roles->value" :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- Driver Specific Options -->
            <div id="driver-options" class="col-12" style="{{ $employee->roles->value === App\Enums\Employee\EmployeeRole::Driver ? '' : 'display: none;'}}">
                <h3>{{ __('Driver Specific Options') }}</h3>
                <!-- Driver's License Number -->
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Số giấy phép lái xe') }}:</label>
                        <x-input name="license_number" :value="$employee->license_number"
                                 placeholder="{{ __('Nhập số giấy phép lái xe') }}" />
                    </div>
                </div>
                <!-- Vehicle Type -->
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Phương tiện vận chuyển') }}:</label>
                        <x-input name="vehicle_type" :value="$employee->vehicle_type"
                                 placeholder="{{ __('Phương tiện vận chuyển') }}" />
                    </div>
                </div>
                @if ($employee->roles->value === App\Enums\Employee\EmployeeRole::Driver && $ratings)
                    <div class="card mt-3">
                        <div class="card-header">{{ __('Driver Ratings') }}</div>
                        <ul class="list-group list-group-flush">
                            @forelse ($ratings as $rating)
                                <li class="list-group-item">
                                    {{ __('Rating: ') }}{{ $rating->rating }}/5
                                    <br>
                                    {{ __('Review: ') }}{{ $rating->review }}
                                    <br>
                                    {{ __('Rated by: ') }}{{ $rating->user->fullname }}
                                </li>
                            @empty
                                <li class="list-group-item">{{ __('No ratings available') }}</li>
                            @endforelse
                        </ul>
                    </div>
                @endif
                @php
                    $averageRating = $employee->driverRatings()->avg('rating') ?? 0;

                    if ($averageRating < 3) {
                        $backgroundColor = '#FF5722';
                    } elseif ($averageRating >= 3 && $averageRating < 4) {
                        $backgroundColor = '#FFC107';
                    } else {
                        $backgroundColor = '#4CAF50';
                    }
                @endphp

                <div class="rating-circle" style="width: 200px; height: 200px; border-radius: 50%; background-color: {{ $backgroundColor }}; display: flex; align-items: center; justify-content: center; flex-direction: column; color: white; font-size: 24px; margin: 20px;">
                    <span style="font-size: 12px;">Điểm Trung Bình</span>
                    <span style="font-size: 20px;">{{ number_format($averageRating, 1) }}</span>
                </div>
                <!DOCTYPE html>
                <html lang="">
                <head>
                    <title>Driver Location</title>
                    <script src="https://maps.googleapis.com/maps/api/js?key={{$apiKey}}"></script>
                    <style>
                        #map {
                            height: 400px;
                            width: 100%;
                        }
                    </style>
                </head>
                <body>
                <div id="map"></div>
                <script>
                    let map, marker;

                    function initMap() {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            let currentLocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            map = new google.maps.Map(document.getElementById('map'), {
                                center: currentLocation,
                                zoom: 15
                            });

                            marker = new google.maps.Marker({
                                position: currentLocation,
                                map: map,
                                title: 'Địa chỉ hiện tại'
                            });

                            // To update location every 5 seconds
                            setInterval(() => updateLocation(), 5000);
                        });
                    }

                    function updateLocation() {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            let newLocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            marker.setPosition(newLocation);
                            map.panTo(newLocation);

                            // Send this new location to the server
                            fetch('admin/employee/update-location', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify(newLocation)
                            })
                                .then(response => response.json())
                                .then(data => console.log('Location updated successfully', data))
                                .catch(error => console.error('Error updating location', error));
                        }, function(error) {
                            console.error('Geolocation error:', error);
                        });
                    }


                    window.onload = initMap;
                </script>
                </body>
                </html>


            </div>
        </div>
    </div>
</div>

<script>
    function initDriverTrackingMap() {
        var myLocation = {lat: 10.833700, lng: 106.662460};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: myLocation
        });

        var marker = new google.maps.Marker({
            position: myLocation,
            map: map,
            draggable: true
        });

        marker.addListener('dragend', function() {
            console.log(marker.getPosition().toUrlValue());
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('map')) {
            initDriverTrackingMap();
        }

        const roleSelect = document.querySelector('[name="roles"]');
        const driverOptions = document.getElementById('driver-options');

        roleSelect.addEventListener('change', function () {
            driverOptions.style.display = parseInt(this.value) === {{ App\Enums\Employee\EmployeeRole::Driver }} ? 'block' : 'none';
        });
    });
</script>




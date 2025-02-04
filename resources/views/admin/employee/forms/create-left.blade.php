<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Nhân Viên') }}</h2>
        </div>
        <div class="row card-body">
            <!-- Fullname -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Họ và tên') }}:</label>
                    <x-input name="fullname" :value="old('fullname')" :required="true"
                             placeholder="{{ __('Họ và tên') }}" />
                </div>
            </div>
            <!-- email -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Email') }}:</label>
                    <x-input-email name="email" :value="old('email')" :required="true" />
                </div>
            </div>
            <!-- phone -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số điện thoại') }}:</label>
                    <x-input-phone name="phone" :value="old('phone')" :required="true" />
                </div>
            </div>
            <!-- address -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Địa chỉ') }}:</label>
                    <x-input name="address" :value="old('address')" :placeholder="__('Địa chỉ')" />
                </div>
            </div>
            <!-- new password -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mật khẩu') }}:</label>
                    <x-input-password name="password" :required="true" />
                </div>
            </div>
            <!-- new password confirmation-->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Xác nhận mật khẩu') }}:</label>
                    <x-input-password name="password_confirmation" :required="true"
                                      data-parsley-equalto="input[name='password']"
                                      data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                </div>
            </div>
            <!-- gender -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giới tính') }}:</label>
                    <x-select name="gender" :required="true">
                        <x-select-option value="" :title="__('Chọn Giới tính')" />
                        @foreach ($gender as $key => $value)
                            <x-select-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- Role selection dropdown -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Vai trò') }}:</label>
                    <select id="role-select" name="roles" class="form-control" required>
                        <option value="">{{ __('Chọn Vai Trò') }}</option>
                        @foreach ($roles as $key => $value)
                            <option value="{{ $key }}">{{ __($value) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Hidden section for drivers -->
            <div id="driver-options" style="display: none;" class="col-12">
                <h3>{{ __('Driver Specific Options') }}</h3>
                <!-- Driver's License Number -->
                <div class="mb-3">
                    <label class="control-label">{{ __('Số giấy phép lái xe') }}:</label>
                    <x-input name="license_number" :value="old('license_number')" required
                             placeholder="{{ __('Nhập số giấy phép lái xe') }}" />
                </div>
                <!-- Vehicle Type -->
                <div class="mb-3">
                    <label class="control-label">{{ __('Phương tiện vận chuyển') }}:</label>
                    <x-input name="vehicle_type" :value="old('vehicle_type')" required
                             placeholder="{{ __('Phương tiện vận chuyển ') }}" />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role-select');
        const driverOptions = document.getElementById('driver-options');

        // Check if the driver option should be displayed initially
        if (roleSelect.value === '2') { // Assuming '2' is the value for drivers
            driverOptions.style.display = 'block';
        }

        roleSelect.addEventListener('change', function() {
            if (this.value === '2') { // Assuming '2' is the value for drivers
                driverOptions.style.display = 'block';
            } else {
                driverOptions.style.display = 'none';
            }
        });
    });
</script>

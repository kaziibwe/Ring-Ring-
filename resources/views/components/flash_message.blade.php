@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif




@if (session()->has('danger'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
        {{ session('danger') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif




@if (session()->has('front_success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="alert alert-success" role="alert">
        {{ session('front_success') }}
    </div>
@endif



@if (session()->has('modal_message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 10000)" x-show="show"
        class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
        {{ session('modal_message') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



{{-- @if (session()->has('front_success'))

 <div x-data="{show:true}" x-init="setTimeout(() =>show =false,3000)" x-show="show"  class="alert alert-primary" role="alert">
    {{ session('front_success') }}
  </div> --}}

@extends('admin.admin_master')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Product Details</h4>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 class="mb-3">Product Images</h5>
                            <div class="d-flex flex-wrap">
                                @forelse ($product->images as $image)
                                <img src="{{ asset($image->image) }}" alt="Product Image" class="me-2 mb-2" width="100" height="75" style="object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                                @empty
                                <p class="text-danger">No Image Available for This Product</p>
                                @endforelse
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->

    </div>
    <!-- content -->
@endsection

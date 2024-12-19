@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Purchase Order</h4>
                        
                        <form id="purchaseOrderForm" method="POST" action="{{ route('purchaseOrder.store') }}">
                            @csrf
                            <!-- Header Inputs -->
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" name="date" class="form-control" required>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="supplier_name">Supplier Name</label>
                                    <select id="supplier_name" name="supplier_name" class="form-control" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                     <label for="supplier_name">Supplier Name</label>                                    
                                     <select id="familyDropdown" name="product_family" class="form-select select2" aria-label="Default select example">
                                        <option selected="">Select Family</option>
                                        @foreach($familys as $family)
                                            <option value="{{ $family->family }}">{{ $family->family }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                
                                <div class="col-md-3">
                                    <label for="product">Product</label>
                                    <select id="productDropdown" name="product" class="form-select select2" aria-label="Default select example">
                                        <option selected="">Select Product</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" id="addProduct" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                            
                            <!-- Second Section: Product List -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <table class="table table-bordered" id="productTable">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Product rows will be dynamically added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success">Create Purchase Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Add Product Button Click
        $('#addProduct').on('click', function () {
            // Get values from the header inputs
            let productDropdown = $('#productDropdown');
            let productId = productDropdown.val();
            let productText = productDropdown.find('option:selected').text(); 
            let unit = productDropdown.find('option:selected').data('unit');
            let quantity = 1; // Default quantity
            let price = 0; // Default price
            let description = productText;
            let total = 0; // Default total
            

            // Create a new row in the product table
            let newRow = `
                <tr>
                    <td>${productId} <input type="hidden" name="products[]" value="${$('#product').val()}"></td>
                    <td><input type="number" name="quantities[]" value="${quantity}" class="form-control quantity" required></td>
                    <td><input type="text" name="units[]" value="${unit}" class="form-control" required></td>
                    <td><input type="number" name="prices[]" value="${price}" class="form-control price" required></td>
                    <td>${description}</td>
                    <td class="total">${total}</td>
                    <td><button type="button" class="btn btn-danger removeProduct">Remove</button></td>
                </tr>
            `;

            // Append the new row to the table body
            $('#productTable tbody').append(newRow);
        });

        // Remove Product Button Click
        $(document).on('click', '.removeProduct', function () {
            $(this).closest('tr').remove();
        });

        // Update Total on Quantity or Price Change
        $(document).on('input', '.quantity, .price', function () {
            let row = $(this).closest('tr');
            let quantity = row.find('.quantity').val();
            let price = row.find('.price').val();
            let total = quantity * price;

            row.find('.total').text(total.toFixed(2));
        });

        $('#familyDropdown').on('change', function () {
        let family = $(this).val();
        let productDropdown = $('#productDropdown');

        // Clear the existing options in the Product dropdown
        productDropdown.html('<option selected="">Select Product</option>');

        if (family) {
            // Make AJAX request to fetch products by family
            $.ajax({
                url: `/products-by-family/${family}`,
                type: 'GET',
                dataType: 'json',
                success: function (products) {
                    // Populate Product dropdown with the fetched products
                    $.each(products, function (key, product) {
                        productDropdown.append(`<option value="${product.id}" data-unit="${product.unit}"> ${product.description} </option>`);
                    });
                },
                error: function () {
                    alert('Unable to fetch products. Please try again later.');
                },
            });
        }
    });

    $('#myForm').validate({
            rules: {
                code: {
                    required : true,
                }, 
                description: {
                    required : true,
                }, 
                product_family: {
                    required : true,
                }, 
                product_unit: {
                    required : true,
                },  
                taxRateCode_Product: {
                    required : true,
                }, 
                profile_image: {
                    required : true,
                }, 
                },
            messages :{
                code: {
                    required : 'Please Enter Supplier Code.',
                }, 
                description: {
                    required : 'Please Enter Product Description.',
                }, 
                product_family: {
                    required : 'Please Enter Product Family.',
                }, 
                product_unit: {
                    required : 'Please Enter Product Unit.',
                },  
                taxRateCode_Product: {
                    required : 'Please Enter Tax Rate Code.',
                }, 
                profile_image: {
                    required : 'Please Enter Image Product.',
                }, 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    }); 
</script>

@endsection

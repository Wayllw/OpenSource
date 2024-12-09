@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Product</h4><br><br>
                        <form method="post" action="{{route('product.store')}}" id="myForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Product Code</label>
                                <div class="form-group col-sm-10">
                                    <input name="code" class="form-control" type="number">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Product Description</label>
                                <div class="form-group col-sm-10">
                                    <input id="description" name="description" class="form-control" type="text">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Family</label>
                                <select id="product_family" name="product_family" class="form-select select2" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($families as $prod)
                                        <option iOption= "" value="{{$prod->family}}">{{$prod->family}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Unit</label>
                                <select id="product_unit" name="product_unit" class="form-select select2" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($unitMesures as $prod)
                                        <option iOption= "" value="{{$prod->unit}}">{{$prod->unit}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Postal Code</label>
                                <div class="form-group col-sm-2">
                                    <select id="produt_taxRate" name="produt_taxRate" class="form-select select2" aria-label="Default select example">
                                        <option selected=""></option>
                                        @foreach($taxRates as $prod)
                                        <option iTaxDescription= "{{$prod->descriptionTaxRate}} - {{$prod->taxRate}}%" value="{{$prod->taxRateCode}}">{{$prod -> taxRateCode}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="example-text-input" id="ibLocation" name="IbTaxDescription" class="col-sm-8 col-form-label"></label>
                            </div>
                            <!-- end row -->
                            <div class="form-group row mb-3">
                                <div class="col-sm-10">
                                    <input name="profile_image" class="form-control" type="file" id="image">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="form-group row mb-3">
                                <label for="example-text-input" class="col-sm-1 col-form-label">IMG Product</label>
                                <div class="col-sm-11">
                                    <img id="showImage" class="rounded avatar-lg" src="{{url('upload/no_image.jpg')}}" alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="form-group row mb-3">
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){

        $('#showImage').click(function(){
            $('#image').click();
        })

        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = funcion(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })

        $("#product_taxRateCode").change(function(){
            $("lbTaxDescription").text("");
            $("lbTaxDescription").text($("#product_taxRateCode option:selected").attr("data-taxRate"));
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
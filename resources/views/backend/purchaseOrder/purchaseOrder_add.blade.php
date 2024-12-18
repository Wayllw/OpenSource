@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Purchase Order</h4><br><br>
                        <form method="post" action="{{route('product.store')}}" id="myForm" enctype="multipart/form-data"> 
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Puchase Order</th>
                                        <th>Date</th> 
                                        <th>Supplier Name</th> 
                                        <th>Family</th>  
                                        <th>Product</th>  
                                        <th>Action</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>  
                                            <div class="form-group col-sm-10">
                                                <input name="code" class="form-control" type="number">
                                            </div>
                                        </td>

                                        <td> 
                                            <div class="form-group col-sm-10">
                                                <input id="date" name="date" class="form-control" type="date">
                                            </div> 
                                        </td> 

                                        <td> 
                                            <select id="product_family" name="product_family" class="form-select select2" aria-label="Default select example">
                                                @foreach($suppliers as $pOrd)
                                                <option iOption= "" value="{{$pOrd->supplier}}">{{$pOrd->supplier}}</option>
                                                @endforeach
                                            </select>
                                        </td> 

                                        <td> 
                                            <select id="product_family" name="product_family" class="form-select select2" aria-label="Default select example">
                                            @foreach($familys as $pOrd)
                                                <option iOption= "" value="{{$pOrd->family}}">{{$pOrd->family}}</option>
                                            @endforeach
                                            </select>    
                                        </td>

                                        <td> 
                                            <select id="product_family" name="product_family" class="form-select select2" aria-label="Default select example">
                                                @foreach($products as $pOrd)
                                                <option iOption= "" value="{{$pOrd->product}}">{{$pOrd->product}}</option>
                                                @endforeach
                                            </select>
                                        </td> 

                                        <td>
                                            <div class="form-group row mb-3">
                                                <input type="button" class="btn btn-info waves-effect waves-light" value="Add">
                                            </div>                                      
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Div dos conteudos do produto -->
                            <div>


                            <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Code</label>
                                    <select id="product_unit" name="product_unit" class="form-select select2" aria-label="Default select example">
                                        @foreach($products as $prod)
                                        <option iOption= "" value="{{$prod->code}}">{{$prod->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Quantidade</label>
                                    <div class="form-group col-sm-10">
                                        <input id="quantity" name="quantity" class="form-control" type="number">
                                    </div>
                                </div>
                                <!-- end row -->

                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Unit</label>
                                    <select id="product_unit" name="product_unit" class="form-select select2" aria-label="Default select example">
                                        @foreach($unitMeasures as $prod)
                                        <option iOption= "" value="{{$prod->unitMeasure}}">{{$prod->unitMeasure}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Preço Por Unidade</label>
                                    <div class="form-group col-sm-10">
                                        <input id="quantity" name="quantity" class="form-control" type="number">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Descrição</label>
                                    <div class="form-group col-sm-10">
                                        <input id="quantity" name="quantity" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Total</label>
                                    <div class="form-group col-sm-10">
                                        
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="form-group row mb-3">
                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
                                </div>
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
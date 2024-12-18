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
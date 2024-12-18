@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Products All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <a href="{{route('purchaseOrder.add')}}" class="btn btn-secondary btn-rounded waves-effect waves-light" style="float:right;">Add Product</a>
                    <br><br>
                        <h4 class="card-title">Products All Data </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Supplier Name</th> 
                                    <th>P Order Num</th> 
                                    <th>Date</th>  
                                    <th>Observation</th>   
                                </tr>
                            </thead>
                            <tbody> 
                        	   @foreach($purchaseOrderCs as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item['supplierLink']['name']}} </td> 
                                        <td> {{ $item->pONumber }} </td> 
                                        <td> {{ $item->pODate }} </td> 
                                        <td> {{ $item->POObservation }} </td> 
                                        <td> {{ $item['codeRateLink']['taxRate']}} </td> 
                                        <td>
                                            <a href="{{route('purchaseOrder.edit',$item->id)}}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                            <a href="{{route('purchaseOrder.delete',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->                    
    </div> <!-- container-fluid -->             
</div>
 

@endsection
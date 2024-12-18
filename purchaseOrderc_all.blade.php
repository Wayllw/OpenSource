@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">PurchaseOrderC All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('purchaseorderc.add') }}" class="btn btn-secondary
                        btn-rounded waves-effect waves-light" style="float:right;">Add PurchaseOrderC</a> <br><br>
                        <h4 class="card-title">PurchaseOrderC All Data </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Ln</th>
                                    <th>PurchaseOrderC Nova</th>
                                    <th>Discount</th>
                                    <th>pODate</th>
                                    <th>pOnumber</th>
                                    <th>pOObservation</th>
                                    <th>status</th>
                                    <th>supplierCode</th>
                                    <th>total</th>

                                </tr>
                            </thead>
                            <tbody>
                        	   @foreach($purchaseOrderc as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item->nova }} </td>
                                        <td> {{ $item->discount }} </td>
                                        <td> {{ $item->pODate }} </td>
                                        <td> {{ $item->pOnumber }} </td>
                                        <td>
                                        <td> {{ $item->pOObservation }} </td>
                                       <td> {{ $item->status }} </td>
                                       <td> {{ $item->supplierCode }} </td>
                                       <td> {{ $item->total }} </td>
                                        <td>
                                            <a href="{{ route('purchaseorderc.edit', $item->id) }}"
                                            class="btn btn-info sm" title="Edit Data">
                                            <i class="fas fa-edit"></i> </a>
                                            <a href="{{ route('purchaseorderc.delete', $item->id) }}"
                                            class="btn btn-danger sm" title="Delete Data" id="delete">
                                            <i class="fas fa-trash-alt"></i> </a>
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

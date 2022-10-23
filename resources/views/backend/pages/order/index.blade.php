@extends('backend.layouts.app')

@section('title', 'Order Management')

@push('third_party_stylesheets')
    <link href="{{ asset('assets/backend/js/DataTable/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('page_css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">
                            <h4>View Order</h4>
                        </span>
                        <span class="float-right">
                            {{-- <a href="{{ route('order.create') }}" class="btn btn-info">Add new Order</a> --}}
                        </span>
                    </div>
                    <div class="card-body">
                        @include('backend.partial.flush-message')

                        <div class="table table-responsive">
                            <table id="table" class="table-responsive">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Order No.</th>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>Address</th>
                                        <th>Quantity</th>
                                        <th>Shiping Charge</th>
                                        <th>Amount</th>                                        <th>Ordered Time</th>
                                        {{-- <th>Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $key => $order)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->first_name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->address1 }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->shipping->price }}</td>
                                            <td>TK{{ number_format($order->total_amount, 2) }}
                                            </td>
                                            <td>{{ $order->created_at->diffForHumans() }}</td>
                                            {{-- <td>
                                                @if ($order->status == 'new')
                                                    <span class="badge badge-primary">{{ $order->status }}</span>
                                                @elseif($order->status == 'process')
                                                    <span class="badge badge-warning">{{ $order->status }}</span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge badge-success">{{ $order->status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td class="text-middle py-0 align-middle">
                                                <div class="btn-group">
                                                    <a href="{{ route('product.edit', $order->id) }}"
                                                        class="btn btn-dark btnEdit"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('product.destroy', $order->id) }}"
                                                        class="btn btn-danger btnDelete"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@push('third_party_scripts')
    <script src="{{ asset('assets/backend/js/DataTable/datatables.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdfHtml5',
                        title: 'Orders',
                        download: 'open',
                        orientation: 'potrait',
                        pagesize: 'LETTER',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7,8]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2,3,4,5,6,7,8]
                        }
                    }, 'pageLength'
                ]
            });
        });
    </script>
@endpush

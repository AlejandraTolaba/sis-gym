@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4>Nueva Venta</h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('sales.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_id">Productos</label>
                                        <select id="products_id" name='products_id[]' data-placeholder="Seleccione producto o productos" multiple="multiple" class="form-control select2 shadow-sm @if($errors->first('product_id')) is-invalid @endif" >
                                            <!-- <option selected>{{''}}</option> -->
                                            @if ( !$products->isEmpty() )
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}_{{$product->code}}_{{$product->name}}_{{$product->stock}}_{{$product->price}}" {{old('product_id') == $product->id ? 'selected' : ''}}>{{$product->code}} - {{$product->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{ $errors->first('product_id', ':message') }} </strong>
                                        </span>
                                    </div>
                                      
                                    <div class="form-group d-none" id="products_table">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-sm" id="table">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Producto</th>
                                                        <th>Stock</th>
                                                        <th width="100px">Cantidad</th>
                                                        <th>Precio</th>
                                                        <!-- <th>Subtotal</th> -->
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center" id="resultsTableBody">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="method_of_payment_id">Forma de pago</label>
                                        <select id="method_of_payment_id" name='method_of_payments_id' data-placeholder="Seleccione forma de pago" class="form-control select2 shadow-sm @if($errors->first('method_of_payment_id')) is-invalid @endif" >
                                            <!-- <option selected>{{''}}</option> -->
                                            @if ( !$methods_of_payment->isEmpty() )
                                                @foreach ($methods_of_payment as $method_of_payment)
                                                    <option value="{{$method_of_payment->id}}" {{old('method_of_payment_id') == $method_of_payment->id ? 'selected' : ''}}>{{$method_of_payment->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{ $errors->first('method_of_payment_id', ':message') }} </strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center mt-2">
                                        <!-- <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a> -->
                                        <a href="{{asset('/')}}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script src="{{asset('js/add_product.js')}}"></script> -->
@endpush
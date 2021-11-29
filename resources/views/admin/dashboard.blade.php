@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div id="crypto-stats-3" class="row">
                    <div class="col-xl-3 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc BTC warning font-large-2" title="BTC"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h4></h4>
                                            <h6 class="text-muted"></h6>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4>1</h4>
                                            <h6 class="success darken-4"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="btc-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc ETH blue-grey lighten-1 font-large-2" title="ETH"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h4></h4>
                                            <h6 class="text-muted"></h6>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4></h4>
                                            <h6 class="success darken-4"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="eth-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h4></h4>
                                            <h6 class="text-muted"></h6>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4></h4>
                                            <h6 class="danger"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="xrp-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><i class="cc XRP info font-large-2" title="XRP"></i></h1>
                                        </div>
                                        <div class="col-5 pl-2">
                                            <h4></h4>
                                            <h6 class="text-muted"></h6>
                                        </div>
                                        <div class="col-5 text-right">
                                            <h4></h4>
                                            <h6 class="danger"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <canvas id="xrp-chartjs" class="height-75"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Candlestick Multi Level Control Chart -->

                <!-- Sell Orders & Buy Order -->
{{--                <div class="row match-height">--}}
{{--                    <div class="col-12 col-xl-8">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4 class="card-title">{{__('translate-admin/index.latest orders')}}</h4>--}}
{{--                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                                <div class="heading-elements">--}}
{{--                                    <p class="text-muted"></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-content">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-de mb-0">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>{{__('translate-admin/index.order number')}}</th>--}}
{{--                                            <th>{{__('translate-admin/index.customer')}}</th>--}}
{{--                                            <th>{{__('translate-admin/index.price')}}</th>--}}
{{--                                            <th>{{__('translate-admin/index.status order')}}</th>--}}
{{--                                            <th>{{__('translate-admin/index.payment_method')}}</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @isset($orders)--}}
{{--                                            @foreach($orders as $order)--}}
{{--                                                <tr class="bg-success bg-lighten-5">--}}
{{--                                                    <td>{{$order->id}}</td>--}}
{{--                                                    <td><i class="cc BTC-alt"></i>{{$order->customer->name}}</td>--}}
{{--                                                    <td>{{$order->total_price}}$</td>--}}
{{--                                                    <td> {{$order->status}}</td>--}}
{{--                                                    <td>{{$order->payment_method == 1 ? 'Visa' : 'Master Card'}}</td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endisset--}}

{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-xl-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4 class="card-title">{{__('translate-admin/index.latest rating')}}</h4>--}}
{{--                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                                <div class="heading-elements">--}}
{{--                                    <p class="text-muted"></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-content">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-de mb-0">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>{{__('translate-admin/index.customer')}}</th>--}}
{{--                                            <th>{{__('translate-admin/index.product')}}</th>--}}
{{--                                            <th>{{__('translate-admin/index.rating')}}</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        <tr class="bg-danger bg-lighten-5">--}}
{{--                                            <td>Ibrahim Essam</td>--}}
{{--                                            <td><i class="cc BTC-alt"></i>جوال آيفون 7+</td>--}}
{{--                                            <td>5</td>--}}
{{--                                        </tr>--}}

{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!--/ Sell Orders & Buy Order -->
                <!-- Active Orders -->

                <!-- Active Orders -->
            </div>
        </div>
    </div>
@endsection

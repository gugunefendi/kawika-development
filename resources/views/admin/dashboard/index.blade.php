@extends('admin.layouts.app')

@section('list-notif')
<ul>
    @foreach ($total_notification as $notification)
        <li id="notification-{{ $notification->id }}" onclick="markNotificationAsRead({{ $notification->id }})">Order Baru Telah Di Buat</li>
    @endforeach
</ul>
@endsection

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-orange">
                    <div class="card-title">Order Today</div>
                    <div class="card-content">
                        @php
                            $today = \Carbon\Carbon::today()->toDateString();
                        @endphp
                        {{ \DB::table('orders')->whereDate('created_at', $today)->count() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-blue">
                    <div class="card-title">All Order</div>
                    <div class="card-content">
                        {{ \DB::table('orders')->count() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-green">
                    <div class="card-title">Revenue</div>
                    <div class="card-content">Rp 1.000.000</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-purple">
                    <div class="card-title">On Delivery</div>
                    <div class="card-content">5</div>
                </div>
            </div>
            <div class="col-md-12">
                @foreach ($notifications as $notification)
                    <div id="notification-{{ $notification->id }}">
                        @unless ($notification->read)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {!! $notification->message !!}
                                
                                <button onclick="markNotificationAsRead({{ $notification->id }})" class="btn btn" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endunless
                    </div>
                @endforeach       
            </div>
            <div class="col-md-12">
                <div id="order-chart-container" style="height: 400px;"></div>
            </div>
        </div>

      </main>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        var total_notifications = '{{ $total_notification->count() }}';
        $('#badge-notif').text(total_notifications);
        function markNotificationAsRead(notificationId) {
            fetch("{{ route('mark-notification-as-read') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    id: notificationId
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationElement = document.getElementById('notification-' + notificationId);
                    notificationElement.remove();
                    location.reload();
                }
            })
            .catch(error => console.error(error));
        }

        function fetchData() {
            fetch('admin/order-chart-data')
                .then(response => response.json())
                .then(data => drawChart(data))
                .catch(error => console.error(error));
        }

        function drawChart(data) {
            Highcharts.chart('order-chart-container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Order per Hari'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Order'
                    }
                },
                series: [{
                    name: 'Jumlah Order',
                    data: data.map(row => [Date.parse(row.date), row.total])
                }]
            });
        }

        fetchData();
    </script>
@endsection
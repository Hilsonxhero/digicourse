<x-slot name="script">
    <script>
        c3.generate({
            bindto: '#chart-employment', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1', @foreach($dates as $date => $value) @if($day = $summery->where("date",$date)->first()) {{$day->totalAmount}}, @else 0, @endif @endforeach],
                    ['data2', @foreach($dates as $date => $value) @if($day = $summery->where("date",$date)->first()) {{$day->totalSiteShare}}, @else 0, @endif @endforeach],
                    ['data3', @foreach($dates as $date => $value) @if($day = $summery->where("date",$date)->first()) {{$day->totalSellerShare}}, @else 0, @endif @endforeach],
                    // ['data2', 5, 15, 27, 15, 21, 25,12],
                    // ['data3', 17, 18, 21, 8, 30, 29,20]
                ],
                type: 'line', // default type of chart
                colors: {
                    'data1': '#2dd8ff', // orange
                    'data2': '#007FFF', // blue
                    'data3': '#9367B4', // green
                },
                names: {
                    // name of each serie
                    'data1': 'تراکنش موفق',
                    'data2': 'درآمد سایت',
                    'data3': 'درآمد مدرس'
                }
            },
            axis: {
                x: {
                    type: 'category',
                    // name of each category
                    categories: [@foreach($dates as $date => $value) '{{getJalalieFromFormat($date)}}', @endforeach]
                },
            },
            legend: {
                show: true, //hide legend
            },
            padding: {
                bottom: 20,
                top: 0
            },
        });
    </script>
    <script>
        c3.generate({
            bindto: '#chart-donut', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    ['data1', {{$last30DaysBenefit}}],
                    ['data2', {{$last30DaysSellerBenefit}}]
                ],
                type: 'donut', // default type of chart
                colors: {
                    'data1': '#6574cd', // indigo
                    'data2': '#939edc', // indigo light
                },
                names: {
                    // name of each serie
                    'data1': 'درصد سایت',
                    'data2': 'درصد مدرس'
                }
            },
            axis: {},
            legend: {
                show: true, //hide legend
            },
            padding: {
                bottom: 20,
                top: 0
            },
        });
    </script>
</x-slot>

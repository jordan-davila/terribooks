<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png">
    <link rel="manifest" href="../site.webmanifest">
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
          crossorigin="anonymous">
    <title>Territory Phone PDF Export</title>
    <style>
        @page { margin: 0px; }
        html { -webkit-print-color-adjust: exact; }
        .row {
            display: grid;
            grid-template-columns: 70px 60px 1fr;
            grid-gap: 5px;
            font-size: 10px;
        }
        .row .col {
            display: flex;
            align-items: center;
            border-right: 1px solid #eee;
        }
        .row .col:last-child { border-right: none; }
    </style>
</head>

<body>
    <div class="page-container">
        @foreach ($spreadsheets as $spreadsheet)
            <div class="spreadsheet py-5 px-8" style="page-break-after: always;">
                <div class="page-header flex justify-between items-center text-xs font-bold uppercase mb-2 text-gray-300">
                    <div class="territory-info flex justify-start items-center flex-1 float-left w-1/2">
                        <span class="text-indigo-600">{{ $territory->code }}&nbsp;</span>
                        <span>{{ $territory->city->name }} {{ $territory->order }}</span>
                    </div>
                    <div class="page-info flex justify-end items-center flex-1 float-right w-1/2">
                        <span class="text-indigo-600 mr-2">
                            PG {{ $spreadsheet["page"] }} OF {{ count($spreadsheets) }}
                        </span>
                        <span>{{ \Carbon\Carbon::now()->toFormattedDateString() }}</span>
                    </div>
                </div>
                <div class="phone-list border border-gray-100 border-solid text-gray-700">
                    <div
                        class="row header px-4 h-6 grid border-b border-gray-100 border-solid text-xxs uppercase"
                        style="grid-template-columns: 180px 1fr 140px 60px 1fr"
                    >
                        <div class="col flex items-center">Name</div>
                        <div class="col flex items-center">Address</div>
                        <div class="col flex items-center">Phone</div>
                        <div class="col flex items-center">Symbol</div>
                        <div class="col flex items-center">Observations</div>
                    </div>

                    @foreach ($spreadsheet["businesses"] as $business)
                        <div
                            class="row grid px-4 h-6 border-b border-gray-100 border-solid last:border-b-0 text-xxs w-full even:bg-gray-50"
                            style="grid-template-columns: 180px 1fr 140px 60px 1fr;"
                        >
                            <div class="col flex items-center">
                                {{ $business["name"] }}
                            </div>
                            <div class="col flex items-center">
                                @if ($business["street_name"])
                                    {{ $business["number"] . " " . $business["street_name"] }}
                                @endif
                            </div>
                            <div class="col flex items-center">
                                {{ $business["phone"] }}
                            </div>
                            <div class="col flex items-center"></div>
                            <div class="col flex justicenter items-center">
                                {{ $business["observations"] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <newpage>
        @endforeach
    </div>
</body>

</html>

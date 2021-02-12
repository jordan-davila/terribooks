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
    <title>Territory Field PDF Export</title>
    <style>
        @page { margin: 0px; }
        html { -webkit-print-color-adjust: exact; }
        .card { width: 10cm; height: 15cm; }
        .row {
            display: grid;
            grid-template-columns: 70px 60px 1fr;
            grid-gap: 5px;
            height: 19.2px;
            font-size: 10px;
        }
        .row .text {
            display: flex;
            align-items: center;
            border-right: 1px solid #eee;
        }
        .row .text:last-child { border-right: none; }
    </style>
</head>

<body>
    <div class="page-container">
        @foreach ($spreadsheets as $spreadsheet)
            <div class="spreadsheet p-8 flex justify-between" style="page-break-after: always;">
                @foreach ($spreadsheet as $card)
                    <div class="card text-xs border border-dashed border-gray-200 p-4 text-gray-300">
                        @if (!$card["empty"])
                            <div class="spreadsheet-info w-full uppercase font-bold mb-5">
                                <div class="territory-info flex justify-start items-center flex-1 float-left w-1/2">
                                    <span class="text-indigo-600">{{ $territory->code }}&nbsp;</span>
                                    <span>{{ $territory->city->name }} {{ $territory->order }}</span>
                                </div>
                                <div class="page-info flex justify-end items-center flex-2 float-right w-1/2">
                                    <span class="text-indigo-600 mr-2">
                                        PG {{ $card["page"] }} OF {{ $total_cards }}
                                    </span>
                                    <span>{{ \Carbon\Carbon::now()->toFormattedDateString() }}</span>
                                </div>
                            </div>
                            <div class="page-info w-full flex justify-between uppercase font-semibold mb-3">
                                <div class="street-info text-gray-800 flex items-center">
                                    {{ $card["street_name"] }}
                                    @if ($grouped && $card["type"] === "even")
                                        <div class="h-3 w-3 rounded-full border-2 border-solid border-gray-300 bg-white ml-2"></div>
                                    @elseif ($grouped && $card["type"] === "odd")
                                        <div class="h-3 w-3 rounded-full border-2 border-solid border-gray-300 bg-gray-300 ml-2"></div>
                                    @endif
                                </div>
                                <div class="symbol-info">
                                    NC | NH | H | M | N
                                </div>
                            </div>
                            <div class="row-list border border-solid border-gray-100 text-gray-700">
                                <div class="row px-3 even:bg-gray-100">
                                    <div class="text">#</div>
                                    <div class="text">SYMBOL</div>
                                    <div class="text">OBSERVATIONS</div>
                                </div>
                                @foreach ($card["rows"] as $row)
                                    <div class="row px-3 w-full text-xxs even:bg-gray-100">
                                        <div class="text">{{ $row["number"] }}</div>
                                        <div class="text"></div>
                                        <div class="text">{{ $row["observations"] }}</div>
                                    </div>
                                    @foreach ($row["apartments"] as $apartment)
                                        <div class="row px-3 w-full text-xxs even:bg-gray-100">
                                            <div class="text justify-end pr-3">{{ $apartment["number"] }}</div>
                                            <div class="text"></div>
                                            <div class="text">{{ $apartment["observations"] }}</div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        @else
                        <div class="empty-page w-full h-full uppercase font-bold mb-5 border border-gray-100 border-dashed flex flex-col items-center justify-center">
                            <div class="title-empty text-gray-700 text-sm mb-px">
                                Empty Page
                            </div>
                            <div class="subtitle-empty text-gray-300 text-xs">
                                This page intentionally left blank
                            </div>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</body>

</html>

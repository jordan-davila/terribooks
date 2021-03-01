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
    <title>Territory Assignment Record PDF Export</title>
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
        @foreach ($spreadsheets as $page => $spreadsheet)
            <div class="spreadsheet p-8" style="page-break-after: always;">
                <div class="page-info mb-4 uppercase text-xs font-bold flex justify-between text-gray-300">
                    <div class="congregation-info">
                        <span class="text-indigo-700">{{ $congregation->name }}</span>
                        <span>{{ " - " . $type . " Ministry" }}</span>
                    </div>
                    <div class="date-page">
                        <span class="text-indigo-700">{{ "PG " . ($page + 1) ." OF " . count($spreadsheets) }}</span>
                        {{ \Carbon\Carbon::now()->toFormattedDateString() }}
                    </div>
                </div>
                <div class="list-container w-full grid grid-cols-5 border border-gray-200">
                    @foreach ($spreadsheet as $column)
                        <div class="column flex flex-col flex-1 w-full border-r border-gray-200 last:border-r-0">
                            <div class="territory-info h-10 border-b border-gray-200 p-2 flex items-center">
                                <div class="font-bold text-sm">{{ $column["territory"]["code"] }}</div>
                            </div>
                            @foreach ($column["assignments"] as $assignment)
                                <div class="assignment-info flex flex-col items-center justify-center border-b border-gray-200 text-xxs h-12 px-1 last:border-b-0">
                                    @if ($assignment["id"] != null)
                                        <div class="publisher-name text-center font-semibold">
                                            {{ $assignment["publisher"]["name"] }}
                                        </div>
                                        <div class="dates flex justify-center items-center w-full">
                                            <div class="date-in w-14">
                                                @if ($assignment["date_in"])
                                                    {{ \Carbon\Carbon::parse($assignment["date_in"])->format("m/d/Y") }}
                                                @endif
                                            </div>
                                            <div class="dash mx-1">-</div>
                                            <div class="date-out w-14">
                                                @if ($assignment["date_out"])
                                                {{ \Carbon\Carbon::parse($assignment["date_out"])->format("m/d/Y") }}
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>

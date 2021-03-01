<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Business;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TerritoryResource;
use VerumConsilium\Browsershot\Facades\PDF;

class TerritoryExportBusinessController extends Controller
{
    public function makeSpreadSheet($streets, $maxrows = 30, $index = 0)
    {
        $spreadsheets[$index] = ["page" => $index + 1, "businesses" => []];

        foreach ($streets as $street) {
            foreach ($street->businesses as $phone) {
                if (count($spreadsheets[$index]["businesses"]) < $maxrows) {
                    $spreadsheets[$index]["businesses"][] = $phone->toArray() + ["street_name" => $phone->street->name];
                } else {
                    $index++;
                    $spreadsheets[$index] = ["page" => $index + 1, "businesses" => []];
                }
            }
        }

        foreach ($spreadsheets as $index => $spreadsheet) {
            if (count($spreadsheet["businesses"]) < $maxrows) {
                $difference = $maxrows - count($spreadsheet["businesses"]);
                for ($i = 0; $i < $difference; $i++) {
                    $spreadsheets[$index]["businesses"][] = new Business();
                }
            }
        }

        return $spreadsheets;
    }

    public function download(Territory $territory)
    {
        return PDF::loadView("export.business", [
            "territory" => $territory,
            "spreadsheets" => $this->makeSpreadSheet($territory->streets),
        ])
            ->format("Letter")
            ->landscape()
            ->inline($territory->code . "_Business.pdf");
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Phone;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TerritoryResource;
use VerumConsilium\Browsershot\Facades\PDF;

class TerritoryExportPhoneController extends Controller
{
    public function makeSpreadSheet($streets, $maxrows = 30, $index = 0)
    {
        $spreadsheets[$index] = ["page" => $index + 1, "phones" => []];

        foreach ($streets as $street) {
            foreach ($street->phones as $phone) {
                if (count($spreadsheets[$index]["phones"]) < $maxrows) {
                    $spreadsheets[$index]["phones"][] = $phone->toArray() + ["street_name" => $phone->street->name];
                } else {
                    $index++;
                    $spreadsheets[$index] = ["page" => $index + 1, "phones" => []];
                }
            }
        }

        foreach ($spreadsheets as $index => $spreadsheet) {
            if (count($spreadsheet["phones"]) < $maxrows) {
                $difference = $maxrows - count($spreadsheet["phones"]);
                for ($i = 0; $i < $difference; $i++) {
                    $spreadsheets[$index]["phones"][] = new Phone();
                }
            }
        }

        return $spreadsheets;
    }

    public function download(Territory $territory)
    {
        return PDF::loadView("export.phone", [
            "territory" => $territory,
            "spreadsheets" => $this->makeSpreadSheet($territory->streets),
        ])
            ->format("Letter")
            ->landscape()
            ->inline($territory->code . "_Phone.pdf");
    }
}

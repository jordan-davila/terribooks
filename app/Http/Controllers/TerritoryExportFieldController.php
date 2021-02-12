<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Territory;
use Illuminate\Http\Request;
use VerumConsilium\Browsershot\Facades\PDF;

class TerritoryExportFieldController extends Controller
{
    public $cards;
    public $maxrows = 24;

    public function makeCards(Territory $territory, $grouped = true, $maxrows = 24)
    {
        $this->fillCardsWithHouses($territory, $grouped, $maxrows);
        $this->fillCardsWithEmptyRows($maxrows);
        $this->fillSpreadsheetWithEmptyCards();
        $this->orderCards();
        return array_chunk($this->cards, 2);
    }

    public function fillCardsWithHouses(Territory $territory, $grouped, $maxrows)
    {
        $indexer = -1; // Because loop starts incrementing this value
        $card = [
            "street_name" => null,
            "page" => null,
            "empty" => false,
            "type" => null,
            "rowcount" => 0,
            "rows" => [],
        ];

        // Assign street-houses to card and limit by $maxrows
        $card_group = $grouped ? $this->groupCards($territory->streets) : $territory->streets;

        foreach ($card_group as $street) {
            $indexer++;
            $this->cards[$indexer] = $card;
            $this->cards[$indexer]["street_name"] = $street["name"];
            $this->cards[$indexer]["page"] = $indexer + 1;
            $this->cards[$indexer]["type"] = $street["type"];

            foreach ($street["houses"] as $house) {
                if ($this->cards[$indexer]["rowcount"] + $house->apartment_count + 1 <= $maxrows) {
                    $this->cards[$indexer]["rows"][] = $house->toArray();
                    $this->cards[$indexer]["rowcount"] += $house->apartment_count + 1;
                } else {
                    $indexer++;
                    $this->cards[$indexer] = $card;
                    $this->cards[$indexer]["street_name"] = $street["name"];
                    $this->cards[$indexer]["page"] = $indexer + 1;
                    $this->cards[$indexer]["type"] = $street["type"];
                    $this->cards[$indexer]["rowcount"] += $house->apartment_count + 1;
                    $this->cards[$indexer]["rows"][] = $house->toArray();
                }
            }
        }
    }

    public function groupCards($streets)
    {
        $card_group = [];

        foreach ($streets as $street) {
            // Declare two clones of each street. One for odd and another for even
            $odd_houses = $even_houses = $street->toArray();
            $odd_houses["houses"] = $even_houses["houses"] = [];
            $odd_houses += ["type" => "odd"];
            $even_houses += ["type" => "even"];

            if (count($street->houses) != 0) {
                foreach ($street->houses as $house) {
                    intval($house->number) % 2 == 0 ? ($even_houses["houses"][] = $house) : ($odd_houses["houses"][] = $house);
                }
                count($odd_houses["houses"]) == 0 ?: ($card_group[] = $odd_houses);
                count($even_houses["houses"]) == 0 ?: ($card_group[] = $even_houses);
            } else {
                $card_group[] = $street->toArray();
            }
        }

        return $card_group;
    }

    public function fillCardsWithEmptyRows($maxrows)
    {
        foreach ($this->cards as $index => $card) {
            if ($card["rowcount"] < $maxrows) {
                $difference = $maxrows - $card["rowcount"];
                for ($i = 0; $i < $difference; $i++) {
                    $this->cards[$index]["rows"][] = ["number" => null, "apartments" => [], "observations" => null];
                }
            }
        }
    }

    public function fillSpreadsheetWithEmptyCards()
    {
        $difference = 4 - (count($this->cards) % 4);
        if ($difference === 4) {
            return;
        }
        for ($i = 0; $i < $difference; $i++) {
            $this->cards[] = ["empty" => true, "page" => null];
        }
    }

    public function orderCards()
    {
        $ordered = [];
        $index = 0;
        $iteration = 0;

        foreach ($this->cards as $card) {
            if ($iteration === 5) {
                $iteration = 1;
            }
            if ($iteration === 0) {
                $index = 0;
            }
            if ($iteration === 1) {
                $index += 2;
            }
            if ($iteration === 2) {
                $index += 1;
            }
            if ($iteration === 3) {
                $index -= 2;
            }
            if ($iteration === 4) {
                $index += 3;
            }
            if ($index <= count($this->cards)) {
                $ordered[] = $this->cards[$index];
            }
            $iteration++;
        }

        $this->cards = $ordered;
    }

    public function download(Territory $territory, Request $request)
    {
        $grouped = $request->has("grouped") ? $request->input("grouped") : false;
        return PDF::loadView("export.field", [
            "territory" => $territory,
            "grouped" => $grouped,
            "spreadsheets" => $this->makeCards($territory, $grouped),
            "total_cards" => count($this->cards),
        ])
            ->format("Letter")
            ->inline($territory->code . "_Field.pdf");
    }
}

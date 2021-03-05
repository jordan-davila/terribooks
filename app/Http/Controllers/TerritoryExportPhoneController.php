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
use PhpOffice\PhpSpreadsheet\IOFactory;

class TerritoryExportPhoneController extends Controller
{
    public function excel(Territory $territory)
    {
        // Read File
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load("exports/phone_template.xlsx");
        $worksheet = $spreadsheet->getActiveSheet();

        // Add Date
        $date = $territory->updated_at->format("M d, Y");
        foreach ($territory->phones as $row => $phone) {
            // +2 Because $row starts at 0
            $row = $row + 2;
            $worksheet->setCellValue("A" . $row, $phone->name);
            $worksheet->setCellValue("B" . $row, $phone->address);
            $worksheet->setCellValue("C" . $row, $phone->phone);
            // $worksheet->setCellValue('D' . $row, $phone->symbol);
            $worksheet->setCellValue("E" . $row, $phone->observations);
        }

        // Set Header / Footer
        $total_pages = round($row / 37);
        $header = '&L&"Calibri (Body),Bold"&K5D49FE' . $territory->code . "&K01+000 &K333333" . $territory->name . '&R&"Calibri (Body),Bold"&K5D49FEPAGE 1 OF ' . $total_pages . "&K333333 | " . \Carbon\Carbon::now()->toFormattedDateString();
        $worksheet->getHeaderFooter()->setOddHeader($header);
        $worksheet->getHeaderFooter()->setEvenHeader($header);
        //set the header first, so the result will be treated as an xlsx file.
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //make it an attachment so we can define filename
        header('Content-Disposition: attachment;filename="' . $territory->code . "_Phone.xlsx" . '"');
        //create IOFactory object
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        //save into php output
        $writer->save("php://output");
    }

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

    public function pdf(Territory $territory)
    {
        return PDF::loadView("export.phone", [
            "territory" => $territory,
            "spreadsheets" => $this->makeSpreadSheet($territory->streets),
        ])
            ->format("Letter")
            ->landscape()
            ->inline($territory->code . "_Phone.pdf");
    }

    public function download(Territory $territory, Request $request)
    {
        $type = $request->has("type") ? $request->input("type") : "pdf";
        return $type == "excel" ? $this->excel($territory) : $this->pdf($territory);
    }
}

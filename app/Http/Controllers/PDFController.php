<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

// use setasign\Fpdi\Fpdi;

class PDFController extends Controller
{
    /** * Write code on Method * * @return response() */ public function index()
    {
        $filePath = public_path("Gmail.pdf");
        $outputFilePath = public_path("sample_output.pdf");
        $this->fillPDFFile($filePath, $outputFilePath);
        return response()->file($outputFilePath);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fillPDFFile($file, $outputFilePath)
    {

        $val = '2::57.9|30.6,1::32.0|73.5,3::147|32.0';

        $part = explode(',', $val);

        $mk = [];

        foreach ($part as $item) {

            $e = explode('::', $item);
            $page = $e[0];
            $dimention = explode('|', $e[1]);

            $x = $dimention[0];
            $y = $dimention[1];
            $mk[] =  [
                'page' => $page,
                'x' => $x,
                'y' => $y,
            ];
        }

        $data = $mk;
        if (count($data) !== 0) {
            foreach ($data as $value) {

                echo $value['page'];
            }
        }




        // dd($data);

        // $list[] = end($parts);
        if (count($data) !== 0) {
            $fpdi = new Fpdi('L', 'mm', 'Letter');
            $count = $fpdi->setSourceFile($file);

            for ($i = 1; $i <= $count; $i++) {


                $template = $fpdi->importPage($i);
                $size = $fpdi->getTemplateSize($template);
                $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
                $fpdi->useTemplate($template);


                foreach ($data as $value) {

                    if ($i == $value['page']) {
                        $fpdi->SetFont("helvetica", "", 8);
                        $fpdi->SetTextColor(153, 0, 153);
                        // $fpdi->SetXY($data->x, $data->y);
                        $left = $value['x'];
                        $top = $value['y'];
                        $text = "itsolutionstuff.com";
                        $text = "THIS IS THE TEXT ON PAGE ".$value['page'];
                        $fpdi->Text($left, $top, $text);
                        // $fpdi->Write(60, 'A simple concatenation demo with FPDI');


                        // $fpdi->Image("https://www.itsolutionstuff.com/assets/images/footer-logo.png", 40, 90);
                    }
                }
            }
        }

        // return view('pages.document.index')->with([
        //     'output' => $fpdi->Output('', 'I'),
        //     // 'permissions' => $permissions,

        // ]);

        return $fpdi->Output($outputFilePath, 'F');
    }
}

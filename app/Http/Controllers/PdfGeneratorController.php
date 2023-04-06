<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Image;
use App\Models\User;
use PDF;

class PdfGeneratorController extends Controller
{
    //
    public function pdfView()
    {
        $property = Property::all();
        return view('Pdf.pdf_view', compact('property'));
    }
    public function pdfConvert()
    {
        $data = [
            'imagePath'    => public_path('img/profile.png'),
            'name'         => 'John Doe',
            'address'      => 'USA',
            'mobileNumber' => '000000000',
            'email'        => 'john.doe@email.com'
        ];
        $pdf = PDF::loadView('resume', $data);
        return $pdf->stream('resume.pdf');
    }
}

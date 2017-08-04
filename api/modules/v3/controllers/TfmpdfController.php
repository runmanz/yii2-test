<?php
namespace app\modules\v3\controllers;

use Dompdf\Dompdf;
use Yii;
use yii\web\Controller;
use mPDF;

class TfmpdfController extends Controller
{
    public function actionIndex()
    {
        $html = "<div style='margin: 100px;'>Hello world!</div>";
        $mpdf = new mPDF('c');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetWatermarkText('Teach for the Future');
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->showWatermarkText = true;
        $mpdf->WriteHTML($html);
        $mpdf->AddPage();

        $mpdf->SetWatermarkImage('tiger.wmf', 1, '', array(160,10));
        $mpdf->showWatermarkImage = true;

        $mpdf->WriteHTML('<h2>Using a Watermark as a Header</h2>');
        $mpdf->WriteHTML($html);
        $mpdf->AddPage();

        $mpdf->SetWatermarkImage('tiger.wmf', 0.15, 'F');

        $mpdf->WriteHTML('<h2>Using a Watermark Image as Background</h2>');
        $mpdf->WriteHTML($html);

        $mpdf->Output();
        exit;
    }
    public function actionPdf(){
        $dompdf = new Dompdf();
    }
}